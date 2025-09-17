<?php

namespace App\Services;

use App\Models\ChatSession;
use App\Models\ChatMessage;
use Illuminate\Support\Str;

class AcademicAdvisorService
{
    protected OllamaService $ollama;
    
    protected array $schools = [
        'SBS' => 'School of Business',
        'SICT' => 'School of ICT', 
        'SHS' => 'School of Health Sciences',
        'SSE' => 'School of Science & Engineering',
        'SPC' => 'School of Petrochemical'
    ];

    public function __construct(OllamaService $ollama)
    {
        $this->ollama = $ollama;
    }

    public function createSession(int $userId): ChatSession
    {
        return ChatSession::create([
            'user_id' => $userId,
            'session_id' => Str::uuid(),
            'context' => [],
            'completed' => false,
        ]);
    }

    public function getOrCreateSession(int $userId): ChatSession
    {
        $session = ChatSession::where('user_id', $userId)
            ->where('completed', false)
            ->latest()
            ->first();

        if (!$session) {
            $session = $this->createSession($userId);
            $this->addWelcomeMessage($session);
        }

        return $session;
    }

    protected function addWelcomeMessage(ChatSession $session): void
    {
        ChatMessage::create([
            'chat_session_id' => $session->id,
            'role' => 'assistant',
            'message' => "Hello! I'm your Academic Advisor, here to help you find the perfect educational path. 🎓\n\nI can help you choose from our 5 schools:\n• School of Business (SBS)\n• School of ICT (SICT)\n• School of Health Sciences (SHS)\n• School of Science & Engineering (SSE)\n• School of Petrochemical (SPC)\n\nTell me, what subjects or career areas interest you most? You can also upload any academic documents (transcripts, certificates) and I'll analyze them to provide better recommendations!"
        ]);
    }

    public function processUserMessage(ChatSession $session, string $message, ?string $imagePath = null): ChatMessage
    {
        // Save user message
        $userMessage = ChatMessage::create([
            'chat_session_id' => $session->id,
            'role' => 'user',
            'message' => $message,
            'metadata' => $imagePath ? ['image_path' => $imagePath] : null
        ]);

        // Process image if provided
        $imageAnalysis = null;
        if ($imagePath) {
            $imageAnalysis = $this->ollama->analyzeImage($imagePath, $this->getImageAnalysisPrompt());
        }

        // Generate AI response
        $aiResponse = $this->generateAIResponse($session, $message, $imageAnalysis);
        
        // Save AI message
        $assistantMessage = ChatMessage::create([
            'chat_session_id' => $session->id,
            'role' => 'assistant',
            'message' => $aiResponse['response'],
        ]);

        // Update session context
        $session->update([
            'context' => $aiResponse['context'] ?? $session->context ?? []
        ]);

        return $assistantMessage;
    }

    protected function generateAIResponse(ChatSession $session, string $userMessage, ?array $imageAnalysis = null): array
    {
        $conversationHistory = $this->buildConversationHistory($session);
        
        $systemPrompt = $this->buildSystemPrompt($imageAnalysis);
        $fullPrompt = $systemPrompt . "\n\nConversation History:\n" . $conversationHistory . "\n\nUser: " . $userMessage . "\n\nAssistant:";

        $context = $session->context ?? [];
        
        return $this->ollama->chat($fullPrompt, $context);
    }

    protected function buildSystemPrompt(?array $imageAnalysis = null): string
    {
        $systemPrompt = "You are an Academic Advisor for ED-Journey, helping students choose the right educational path. Your ONLY role is to recommend programmes from these 5 schools:

• School of Business (SBS) - Business, accounting, finance, entrepreneurship, marketing
• School of ICT (SICT) - Programming, software development, cybersecurity, data science, web design
• School of Health Sciences (SHS) - Medicine, nursing, healthcare, medical technology
• School of Science & Engineering (SSE) - Engineering, physics, chemistry, mathematics, technical fields
• School of Petrochemical (SPC) - Chemical engineering, oil & gas, process engineering

Guidelines:
1. Ask engaging questions to understand the student's interests, strengths, and career goals
2. Provide personalized recommendations based on their responses
3. Be encouraging and supportive
4. Only discuss these 5 schools - do not mention other institutions
5. Keep responses conversational but informative
6. If you have enough information, provide a school recommendation with detailed reasoning

";

        if ($imageAnalysis && $imageAnalysis['success']) {
            $systemPrompt .= "Image Analysis: The user has uploaded an image. Here's what I can see: " . $imageAnalysis['response'] . "\n\nUse this information to provide better recommendations.\n";
        }

        return $systemPrompt;
    }

    protected function buildConversationHistory(ChatSession $session): string
    {
        $messages = $session->messages()->orderBy('created_at')->get();
        $history = "";
        
        foreach ($messages as $message) {
            $role = $message->role === 'user' ? 'User' : 'Assistant';
            $history .= "{$role}: {$message->message}\n";
        }
        
        return $history;
    }

    protected function getImageAnalysisPrompt(): string
    {
        return "Analyze this image carefully. If it's an academic document (transcript, certificate, ID card, etc.), extract all text and important information. If it's a photo or other type of image, describe what you see. Focus on any educational or academic content that might help with school recommendations.";
    }

    public function checkForRecommendation(ChatSession $session): ?array
    {
        $messages = $session->messages()->get();
        $messageCount = $messages->count();
        
        // If we have enough conversation (at least 6 messages including welcome)
        if ($messageCount >= 6) {
            return $this->generateFinalRecommendation($session);
        }
        
        return null;
    }

    protected function generateFinalRecommendation(ChatSession $session): array
    {
        $conversationHistory = $this->buildConversationHistory($session);
        
        $prompt = "Based on this entire conversation, provide a final school recommendation. Choose the ONE best school from: SBS, SICT, SHS, SSE, or SPC. 

Respond in this exact JSON format:
{
    \"recommended_school\": \"[SCHOOL_CODE]\",
    \"confidence\": [0-100],
    \"reasoning\": \"Detailed explanation of why this school fits best\",
    \"school_scores\": {
        \"SBS\": [0-100],
        \"SICT\": [0-100], 
        \"SHS\": [0-100],
        \"SSE\": [0-100],
        \"SPC\": [0-100]
    }
}

Conversation History:
" . $conversationHistory;

        $response = $this->ollama->chat($prompt, []);
        
        if ($response['success']) {
            try {
                $data = json_decode($response['response'], true);
                if ($data && isset($data['recommended_school'])) {
                    return $data;
                }
            } catch (\Exception $e) {
                // Fallback - parse response manually or return default
            }
        }
        
        // Fallback recommendation
        return [
            'recommended_school' => 'SICT',
            'confidence' => 70,
            'reasoning' => 'Based on our conversation, this seems like a good fit.',
            'school_scores' => [
                'SBS' => 60,
                'SICT' => 85, 
                'SHS' => 40,
                'SSE' => 70,
                'SPC' => 50
            ]
        ];
    }

    public function completeSession(ChatSession $session): void
    {
        $recommendation = $this->generateFinalRecommendation($session);
        
        $session->update([
            'recommended_school' => $recommendation['recommended_school'],
            'school_scores' => $recommendation['school_scores'],
            'user_preferences' => [
                'confidence' => $recommendation['confidence'],
                'reasoning' => $recommendation['reasoning']
            ],
            'completed' => true,
            'completed_at' => now()
        ]);
    }
}