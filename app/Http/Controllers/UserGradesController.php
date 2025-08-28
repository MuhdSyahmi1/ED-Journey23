<?php

namespace App\Http\Controllers;

use App\Models\OcrResult;
use App\Models\StudentGrade;
use App\Models\HntecResult;
use App\Services\GradeExtractionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Process;

class UserGradesController extends Controller
{
    public function __construct(
        private GradeExtractionService $gradeExtractionService
    ) {}

    public function index()
    {
        $user = auth()->user();
        
        // Get all OCR results for this user grouped by type
        $oLevelResults = OcrResult::where('user_id', $user->id)
            ->where('ocr_type', 'o_level')
            ->with('studentGrades')
            ->latest()
            ->first();

        $aLevelResults = OcrResult::where('user_id', $user->id)
            ->where('ocr_type', 'a_level')
            ->with('studentGrades')
            ->latest()
            ->first();

        $hntecResults = HntecResult::where('user_id', $user->id)
            ->whereHas('ocrResult', function($query) {
                $query->where('ocr_type', 'hntec');
            })
            ->latest()
            ->get();

        // Get statistics for each type
        $oLevelStatistics = $this->gradeExtractionService->getGradeStatistics($user->id, 'o_level');
        $aLevelStatistics = $this->gradeExtractionService->getGradeStatistics($user->id, 'a_level');
        $hntecStatistics = $this->gradeExtractionService->getGradeStatistics($user->id, 'hntec');

        return view('user.upload-result', compact(
            'oLevelResults', 
            'aLevelResults', 
            'hntecResults',
            'oLevelStatistics',
            'aLevelStatistics',
            'hntecStatistics'
        ));
    }

    public function upload(Request $request)
    {
        $request->validate([
            'grade_type' => 'required|in:o_level,a_level,hntec',
            'grade_sheet' => 'required|file|mimes:jpg,jpeg,png,pdf|max:5120', // 5MB max
        ]);

        try {
            $user = auth()->user();
            
            // Store the uploaded file
            $file = $request->file('grade_sheet');
            $filename = time() . '_' . $file->getClientOriginalName();
            $path = $file->storeAs('grade_sheets', $filename, 'public');

            // Perform OCR
            $fullPath = Storage::disk('public')->path($path);
            
            // Handle different file types
            if ($file->getClientOriginalExtension() === 'pdf') {
                // For PDF files, you might need to convert to image first
                // This is a simplified approach - you might need ImageMagick
                $text = $this->extractTextFromPdf($fullPath);
            } else {
                // For image files
                $text = $this->extractTextFromImage($fullPath);
            }

            // Save OCR result
            $ocrResult = OcrResult::create([
                'user_id' => $user->id,
                'filename' => $path,
                'text' => $text,
                'ocr_type' => $request->grade_type,
                'confidence_data' => []
            ]);

            // Extract grades
            $grades = $this->gradeExtractionService->extractGrades($ocrResult);

            if (empty($grades)) {
                return redirect()->back()->with('error', 'No grades could be detected in the uploaded image. Please ensure the image is clear and contains visible grades.');
            }

            return redirect()->back()->with('success', count($grades) . ' grades extracted successfully!');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error processing your grade sheet: ' . $e->getMessage());
        }
    }

    private function extractTextFromImage(string $path): string
    {
        try {
            // Use system Tesseract command directly
            $result = Process::run([
                'tesseract',
                $path,
                'stdout',
                '-l',
                'eng'
            ]);

            if (!$result->successful()) {
                throw new \Exception('Tesseract command failed: ' . $result->errorOutput());
            }

            return $result->output();
        } catch (\Exception $e) {
            throw new \Exception('OCR processing failed: ' . $e->getMessage());
        }
    }

    private function extractTextFromPdf(string $path): string
    {
        // For PDF files, we need a different approach
        // This is a simplified version - in production, you might want to convert PDF to images first
        try {
            $result = Process::run([
                'tesseract',
                $path,
                'stdout',
                '-l',
                'eng'
            ]);

            if (!$result->successful()) {
                throw new \Exception('Tesseract PDF command failed: ' . $result->errorOutput());
            }

            return $result->output();
        } catch (\Exception $e) {
            throw new \Exception('PDF OCR processing failed: ' . $e->getMessage());
        }
    }
}
