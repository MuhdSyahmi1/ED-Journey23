<?php

namespace App\Http\Controllers;

use App\Models\ChatSession;
use App\Services\AcademicAdvisorService;
use App\Services\OllamaService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AcademicAdvisorController extends Controller
{
    protected AcademicAdvisorService $advisorService;
    protected OllamaService $ollamaService;

    public function __construct(AcademicAdvisorService $advisorService, OllamaService $ollamaService)
    {
        $this->advisorService = $advisorService;
        $this->ollamaService = $ollamaService;
    }

    /**
     * Display the Academic Advisor chat interface
     */
    public function index()
    {
        // Check if Ollama is available
        if (!$this->ollamaService->isAvailable()) {
            return view('user.academic-advisor-offline');
        }

        // Get or create user's chat session
        $session = $this->advisorService->getOrCreateSession(Auth::id());
        
        // Load messages for display
        $messages = $session->messages()->orderBy('created_at')->get();

        return view('user.academic-advisor', [
            'session' => $session,
            'messages' => $messages
        ]);
    }

    /**
     * Send a message to the academic advisor
     */
    public function sendMessage(Request $request)
    {
        $request->validate([
            'message' => 'required|string|max:1000',
            'session_id' => 'required|exists:chat_sessions,session_id',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120' // 5MB max
        ]);

        try {
            $session = ChatSession::where('session_id', $request->session_id)
                ->where('user_id', Auth::id())
                ->firstOrFail();

            $imagePath = null;
            if ($request->hasFile('image')) {
                $imagePath = $request->file('image')->store('chat-images', 'public');
            }

            // Process the message
            $assistantMessage = $this->advisorService->processUserMessage(
                $session, 
                $request->message, 
                $imagePath ? storage_path('app/public/' . $imagePath) : null
            );

            // Check if it's an AJAX request
            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => $assistantMessage->message,
                    'timestamp' => $assistantMessage->created_at->diffForHumans(),
                    'session_id' => $session->session_id
                ]);
            }
            
            // For non-AJAX requests, redirect back
            return redirect()->route('user.academic-advisor')
                ->with('success', 'Message sent successfully!');

        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'error' => 'Failed to process message: ' . $e->getMessage()
                ], 500);
            }
            
            return redirect()->route('user.academic-advisor')
                ->with('error', 'Failed to process message: ' . $e->getMessage());
        }
    }

    /**
     * Get chat messages for a session
     */
    public function getMessages(Request $request)
    {
        $request->validate([
            'session_id' => 'required|exists:chat_sessions,session_id'
        ]);

        $session = ChatSession::where('session_id', $request->session_id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $messages = $session->messages()
            ->orderBy('created_at')
            ->get()
            ->map(function ($message) {
                return [
                    'id' => $message->id,
                    'role' => $message->role,
                    'message' => $message->message,
                    'timestamp' => $message->created_at->diffForHumans(),
                    'has_image' => !empty($message->metadata['image_path'] ?? null)
                ];
            });

        return response()->json([
            'success' => true,
            'messages' => $messages,
            'session_completed' => $session->completed
        ]);
    }

    /**
     * Complete the session and get final recommendation
     */
    public function completeSession(Request $request)
    {
        $request->validate([
            'session_id' => 'required|exists:chat_sessions,session_id'
        ]);

        try {
            $session = ChatSession::where('session_id', $request->session_id)
                ->where('user_id', Auth::id())
                ->firstOrFail();

            if ($session->completed) {
                return response()->json([
                    'success' => false,
                    'error' => 'Session already completed'
                ]);
            }

            // Complete the session and get recommendation
            $this->advisorService->completeSession($session);

            return response()->json([
                'success' => true,
                'redirect' => route('user.academic-advisor.results', $session->session_id)
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => 'Failed to complete session: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Show the results of the academic advisor session
     */
    public function results(string $sessionId)
    {
        $session = ChatSession::where('session_id', $sessionId)
            ->where('user_id', Auth::id())
            ->where('completed', true)
            ->with('messages')
            ->firstOrFail();

        $schoolNames = [
            'SBS' => 'School of Business',
            'SICT' => 'School of ICT',
            'SHS' => 'School of Health Sciences', 
            'SSE' => 'School of Science & Engineering',
            'SPC' => 'School of Petrochemical'
        ];

        return view('user.academic-advisor-results', compact('session', 'schoolNames'));
    }

    /**
     * Start a new session (reset conversation)
     */
    public function newSession()
    {
        // Mark any existing incomplete sessions as abandoned
        ChatSession::where('user_id', Auth::id())
            ->where('completed', false)
            ->update(['completed' => true]); // Mark as completed to hide them

        // Create new session
        $session = $this->advisorService->createSession(Auth::id());
        $this->advisorService->getOrCreateSession(Auth::id()); // This will add welcome message

        return redirect()->route('user.academic-advisor');
    }

    /**
     * Get session progress/status
     */
    public function getProgress()
    {
        $session = ChatSession::where('user_id', Auth::id())
            ->where('completed', true)
            ->latest()
            ->first();

        return response()->json([
            'completed' => !is_null($session),
            'progress' => $session ? 100 : 0,
            'completed_at' => $session ? $session->completed_at : null,
            'recommended_school' => $session ? $session->recommended_school : null
        ]);
    }
}