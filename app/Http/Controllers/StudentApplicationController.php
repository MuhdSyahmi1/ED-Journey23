<?php

namespace App\Http\Controllers;

use App\Models\StudentApplication;
use App\Models\SchoolProgramme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class StudentApplicationController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'programmes' => 'required|array|min:1|max:2',
            'programmes.*' => 'required|integer|exists:school_programmes,id',
        ]);

        $user = Auth::user();

        // Check if user already has applications
        $existingApplications = StudentApplication::where('user_id', $user->id)->count();
        if ($existingApplications > 0) {
            throw ValidationException::withMessages([
                'programmes' => 'You have already submitted your applications.'
            ]);
        }

        // Validate programme selections (must be unique)
        $programmes = array_unique($request->programmes);
        if (count($programmes) !== count($request->programmes)) {
            throw ValidationException::withMessages([
                'programmes' => 'You cannot apply for the same programme twice.'
            ]);
        }

        // Check if programmes are valid and user is qualified
        $recommendations = $this->getUserRecommendations();
        $qualifiedProgrammeIds = $this->getQualifiedProgrammeIds($recommendations);

        foreach ($programmes as $programmeId) {
            if (!in_array($programmeId, $qualifiedProgrammeIds)) {
                throw ValidationException::withMessages([
                    'programmes' => 'You can only apply for programmes you are qualified for.'
                ]);
            }
        }

        // Create applications in transaction
        DB::transaction(function () use ($user, $programmes) {
            foreach ($programmes as $index => $programmeId) {
                StudentApplication::create([
                    'user_id' => $user->id,
                    'school_programme_id' => $programmeId,
                    'preference_rank' => $index + 1,
                    'applied_at' => now(),
                ]);
            }
        });

        return redirect()->route('user.application-submitted')
            ->with('success', 'Your applications have been submitted successfully!');
    }

    public function applicationSubmitted()
    {
        $applications = StudentApplication::where('user_id', Auth::id())
            ->with(['schoolProgramme.diplomaProgramme'])
            ->orderBy('preference_rank')
            ->get();

        // Redirect to recommendations if no applications found
        if ($applications->isEmpty()) {
            return redirect()->route('user.recommendations')
                ->with('error', 'No applications found. Please submit your applications first.');
        }

        return view('user.application-submitted', compact('applications'));
    }

    public function myApplications()
    {
        $applications = StudentApplication::where('user_id', Auth::id())
            ->with(['schoolProgramme.diplomaProgramme', 'reviewer'])
            ->orderBy('preference_rank')
            ->get();

        return view('user.my-applications', compact('applications'));
    }

    public function getUserApplications()
    {
        return StudentApplication::where('user_id', Auth::id())
            ->with(['schoolProgramme.diplomaProgramme'])
            ->orderBy('preference_rank')
            ->get();
    }

    private function getUserRecommendations()
    {
        // Use the same logic from UserRecommendationController
        $userRecommendationController = new \App\Http\Controllers\UserRecommendationController();
        $reflection = new \ReflectionMethod($userRecommendationController, 'analyzeRequirements');
        $reflection->setAccessible(true);

        $user = Auth::user();
        
        // Get student's qualifications (simplified version)
        $studentGrades = \App\Models\StudentGrade::where('user_id', $user->id)->with('ocrResult')->get();
        $hntecResults = \App\Models\HntecResult::where('user_id', $user->id)
            ->whereHas('ocrResult', function($query) {
                $query->where('ocr_type', 'hntec');
            })
            ->get();

        $oLevelGrades = $studentGrades->filter(function($grade) {
            return ($grade->ocrResult && $grade->ocrResult->ocr_type === 'o_level') ||
                   $grade->qualification === 'O-Level';
        })->keyBy('subject');
        
        $aLevelGrades = $studentGrades->filter(function($grade) {
            return ($grade->ocrResult && $grade->ocrResult->ocr_type === 'a_level') ||
                   $grade->qualification === 'A-Level';
        })->keyBy('subject');

        $programmes = SchoolProgramme::with([
            'diplomaProgramme',
            'oLevelRequirements.oLevelSubject',
            'hntecRequirements.hntecProgramme'
        ])
        ->where('is_active', 1)
        ->get();

        return $reflection->invoke($userRecommendationController, $programmes, $oLevelGrades, $aLevelGrades, $hntecResults);
    }

    private function getQualifiedProgrammeIds(array $recommendations): array
    {
        $qualifiedIds = [];
        
        // Get IDs from qualified programmes
        foreach ($recommendations['qualified'] as $item) {
            $qualifiedIds[] = $item['programme']->id;
        }
        
        // Get IDs from non-tailored qualified programmes
        foreach ($recommendations['non_tailored_qualified'] as $item) {
            $qualifiedIds[] = $item['programme']->id;
        }
        
        return $qualifiedIds;
    }
}