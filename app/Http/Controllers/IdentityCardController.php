<?php

namespace App\Http\Controllers;

use App\Services\IdentityCardExtractionService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class IdentityCardController extends Controller
{
    public function __construct(
        private IdentityCardExtractionService $icExtractionService
    ) {}

    public function upload(Request $request): JsonResponse
    {
        try {
            // Validate the uploaded file
            $request->validate([
                'ic_file' => 'required|file|mimes:jpg,jpeg,png,pdf|max:10240', // Max 10MB
            ]);

            $user = auth()->user();
            $file = $request->file('ic_file');

            // Process the IC through OCR
            $result = $this->icExtractionService->processICUpload($file, $user->id);

            return response()->json([
                'success' => $result['success'],
                'message' => 'IC processed successfully',
                'data' => $result['data'],
                'confidence' => $result['confidence'],
                'fields_extracted' => $result['fields_extracted'],
                'debug_ocr_text' => $result['debug_ocr_text'] ?? 'No OCR text available'
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid file uploaded',
                'errors' => $e->errors()
            ], 422);

        } catch (\Exception $e) {
            \Log::error('IC OCR processing failed', [
                'user_id' => auth()->id(),
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to process IC. Please try again or upload a clearer image.',
                'error' => config('app.debug') ? $e->getMessage() : null
            ], 500);
        }
    }

    public function getExtractionHistory(Request $request): JsonResponse
    {
        try {
            $user = auth()->user();
            
            $history = \App\Models\OcrResult::where('user_id', $user->id)
                ->where('ocr_type', 'identity_card')
                ->orderBy('created_at', 'desc')
                ->take(5)
                ->get()
                ->map(function ($result) {
                    return [
                        'id' => $result->id,
                        'created_at' => $result->created_at->format('M d, Y H:i'),
                        'confidence_data' => json_decode($result->confidence_data, true),
                        'fields_extracted' => count(array_filter(json_decode($result->confidence_data, true) ?? []))
                    ];
                });

            return response()->json([
                'success' => true,
                'history' => $history
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to retrieve extraction history'
            ], 500);
        }
    }
}