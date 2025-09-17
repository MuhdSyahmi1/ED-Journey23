<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class OllamaService
{
    protected string $baseUrl;
    protected string $model;
    protected int $timeout;

    public function __construct()
    {
        $this->baseUrl = config('services.ollama.base_url', 'http://localhost:11434');
        $this->model = config('services.ollama.model', 'moondream2');
        $this->timeout = config('services.ollama.timeout', 60);
    }

    public function chat(string $message, array $context = []): array
    {
        try {
            $response = Http::timeout($this->timeout)
                ->post("{$this->baseUrl}/api/generate", [
                    'model' => $this->model,
                    'prompt' => $message,
                    'context' => $context,
                    'stream' => false,
                    'options' => [
                        'temperature' => 0.7,
                        'top_p' => 0.9,
                    ]
                ]);

            if ($response->successful()) {
                $data = $response->json();
                return [
                    'success' => true,
                    'response' => $data['response'] ?? '',
                    'context' => $data['context'] ?? [],
                ];
            }

            return [
                'success' => false,
                'error' => 'Ollama API returned error: ' . $response->status(),
                'response' => '',
                'context' => [],
            ];

        } catch (\Exception $e) {
            Log::error('Ollama Service Error', [
                'message' => $e->getMessage(),
                'prompt' => $message,
            ]);

            return [
                'success' => false,
                'error' => 'Failed to connect to Ollama: ' . $e->getMessage(),
                'response' => '',
                'context' => [],
            ];
        }
    }

    public function analyzeImage(string $imagePath, string $prompt = "Describe this image"): array
    {
        try {
            $imageData = base64_encode(file_get_contents($imagePath));
            
            $response = Http::timeout($this->timeout)
                ->post("{$this->baseUrl}/api/generate", [
                    'model' => $this->model,
                    'prompt' => $prompt,
                    'images' => [$imageData],
                    'stream' => false,
                    'options' => [
                        'temperature' => 0.3, // Lower temperature for more accurate OCR
                    ]
                ]);

            if ($response->successful()) {
                $data = $response->json();
                return [
                    'success' => true,
                    'response' => $data['response'] ?? '',
                    'context' => $data['context'] ?? [],
                ];
            }

            return [
                'success' => false,
                'error' => 'Ollama API returned error: ' . $response->status(),
                'response' => '',
                'context' => [],
            ];

        } catch (\Exception $e) {
            Log::error('Ollama Image Analysis Error', [
                'message' => $e->getMessage(),
                'image_path' => $imagePath,
            ]);

            return [
                'success' => false,
                'error' => 'Failed to analyze image: ' . $e->getMessage(),
                'response' => '',
                'context' => [],
            ];
        }
    }

    public function isAvailable(): bool
    {
        try {
            $response = Http::timeout(5)->get("{$this->baseUrl}/api/tags");
            return $response->successful();
        } catch (\Exception $e) {
            return false;
        }
    }

    public function getAvailableModels(): array
    {
        try {
            $response = Http::timeout(10)->get("{$this->baseUrl}/api/tags");
            
            if ($response->successful()) {
                $data = $response->json();
                return $data['models'] ?? [];
            }
            
            return [];
        } catch (\Exception $e) {
            Log::error('Failed to get Ollama models', ['error' => $e->getMessage()]);
            return [];
        }
    }
}