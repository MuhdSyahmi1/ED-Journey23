<?php

namespace App\Http\Controllers;

use App\Models\StudentApplication;
use App\Models\SchoolProgramme;
use App\Models\StudentAppeal;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class AdmissionController extends Controller
{
    /**
     * Display list of student applications for review
     */
    public function applications(Request $request)
    {
        // Only admission managers can access
        if (!Auth::user()->isAdmissionManager()) {
            abort(403, 'Unauthorized access');
        }

        $query = StudentApplication::with([
            'user.userProfile',
            'user.caseReport' => function($query) {
                $query->where('status', '!=', 'solved');
            },
            'schoolProgramme.diplomaProgramme',
            'reviewer'
        ])
        ->whereHas('user.userProfile', function($q) {
            $q->where('verification_status', 'verified');
        })
        ->orderBy('applied_at', 'desc');

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by school
        if ($request->filled('school')) {
            $query->whereHas('schoolProgramme', function($q) use ($request) {
                $q->where('school', $request->school);
            });
        }

        // Filter by programme
        if ($request->filled('programme')) {
            $query->where('school_programme_id', $request->programme);
        }

        // Search by student name or email
        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('user', function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $applications = $query->paginate(20);

        // Get filter options
        $schools = SchoolProgramme::select('school')->distinct()->pluck('school');
        $programmes = SchoolProgramme::with('diplomaProgramme')->get();

        // Get statistics
        $stats = $this->getApplicationStatistics();

        return view('staff.admission.applications', compact('applications', 'schools', 'programmes', 'stats'));
    }

    /**
     * Show detailed view of a specific application
     */
    public function showApplication($id)
    {
        if (!Auth::user()->isAdmissionManager()) {
            abort(403, 'Unauthorized access');
        }

        $application = StudentApplication::with([
            'user.userProfile',
            'schoolProgramme.diplomaProgramme',
            'schoolProgramme.oLevelRequirements.oLevelSubject',
            'schoolProgramme.hntecRequirements.hntecProgramme',
            'reviewer'
        ])
        ->whereHas('user.userProfile', function($q) {
            $q->where('verification_status', 'verified');
        })
        ->findOrFail($id);

        // Get student's qualifications
        $studentGrades = \App\Models\StudentGrade::where('user_id', $application->user_id)
            ->with('ocrResult')
            ->get();

        $hntecResults = \App\Models\HntecResult::where('user_id', $application->user_id)
            ->whereHas('ocrResult', function($query) {
                $query->where('ocr_type', 'hntec');
            })
            ->get();

        // Analyze qualifications for this programme
        $qualificationAnalysis = $this->analyzeStudentQualifications($application, $studentGrades, $hntecResults);

        // Get all student applications for context
        $allApplications = StudentApplication::where('user_id', $application->user_id)
            ->with('schoolProgramme.diplomaProgramme')
            ->orderBy('preference_rank')
            ->get();

        return view('staff.admission.application-detail', compact(
            'application', 
            'studentGrades', 
            'hntecResults', 
            'qualificationAnalysis',
            'allApplications'
        ));
    }

    /**
     * Update application status (Accept/Reject/Waitlist)
     */
    public function updateApplicationStatus(Request $request, $id)
    {
        if (!Auth::user()->isAdmissionManager()) {
            abort(403, 'Unauthorized access');
        }

        $request->validate([
            'status' => 'required|in:accepted,rejected,waitlisted',
            'review_notes' => 'nullable|string|max:1000'
        ]);

        $application = StudentApplication::whereHas('user.userProfile', function($q) {
            $q->where('verification_status', 'verified');
        })->findOrFail($id);

        // Check if programme has quota and enforce it for acceptances
        if ($request->status === 'accepted') {
            $acceptedCount = StudentApplication::where('school_programme_id', $application->school_programme_id)
                ->where('status', 'accepted')
                ->count();

            $quota = $application->schoolProgramme->admission_quota ?? 999; // Default high if no quota set

            if ($acceptedCount >= $quota) {
                throw ValidationException::withMessages([
                    'status' => 'Cannot accept more students. Programme quota (' . $quota . ') has been reached.'
                ]);
            }
        }

        DB::transaction(function() use ($application, $request) {
            $application->update([
                'status' => $request->status,
                'review_notes' => $request->review_notes,
                'reviewed_at' => now(),
                'reviewed_by' => Auth::id(),
            ]);

            // If accepting, consider rejecting other applications from same student with lower preference
            if ($request->status === 'accepted') {
                $this->handleAcceptanceConsequences($application);
            }
        });

        return redirect()->back()->with('success', 'Application status updated successfully.');
    }

    /**
     * Bulk update application statuses
     */
    public function bulkUpdateStatus(Request $request)
    {
        if (!Auth::user()->isAdmissionManager()) {
            abort(403, 'Unauthorized access');
        }

        $request->validate([
            'application_ids' => 'required|array',
            'application_ids.*' => 'exists:student_applications,id',
            'status' => 'required|in:accepted,rejected,waitlisted',
            'review_notes' => 'nullable|string|max:1000'
        ]);

        $updated = 0;
        $errors = [];

        DB::transaction(function() use ($request, &$updated, &$errors) {
            foreach ($request->application_ids as $id) {
                try {
                    $application = StudentApplication::whereHas('user.userProfile', function($q) {
                        $q->where('verification_status', 'verified');
                    })->findOrFail($id);

                    // Check quota for acceptances
                    if ($request->status === 'accepted') {
                        $acceptedCount = StudentApplication::where('school_programme_id', $application->school_programme_id)
                            ->where('status', 'accepted')
                            ->count();

                        $quota = $application->schoolProgramme->admission_quota ?? 999;

                        if ($acceptedCount >= $quota) {
                            $errors[] = "Cannot accept {$application->user->name} - Programme quota reached";
                            continue;
                        }
                    }

                    $application->update([
                        'status' => $request->status,
                        'review_notes' => $request->review_notes,
                        'reviewed_at' => now(),
                        'reviewed_by' => Auth::id(),
                    ]);

                    if ($request->status === 'accepted') {
                        $this->handleAcceptanceConsequences($application);
                    }

                    $updated++;
                } catch (\Exception $e) {
                    $errors[] = "Failed to update application #{$id}: " . $e->getMessage();
                }
            }
        });

        $message = "Updated {$updated} applications successfully.";
        if (!empty($errors)) {
            $message .= " Errors: " . implode(', ', $errors);
        }

        return redirect()->back()->with('success', $message);
    }

    /**
     * Get application statistics for dashboard
     */
    private function getApplicationStatistics(): array
    {
        return [
            'total' => StudentApplication::count(),
            'pending' => StudentApplication::where('status', 'pending')->count(),
            'accepted' => StudentApplication::where('status', 'accepted')->count(),
            'rejected' => StudentApplication::where('status', 'rejected')->count(),
            'waitlisted' => StudentApplication::where('status', 'waitlisted')->count(),
            'today' => StudentApplication::whereDate('applied_at', today())->count(),
        ];
    }

    /**
     * Analyze student qualifications against programme requirements
     */
    private function analyzeStudentQualifications($application, $studentGrades, $hntecResults): array
    {
        // Use the same analysis logic from UserRecommendationController
        $userRecommendationController = new \App\Http\Controllers\UserRecommendationController();
        $reflection = new \ReflectionMethod($userRecommendationController, 'analyzeProgrammeRequirements');
        $reflection->setAccessible(true);

        $oLevelGrades = $studentGrades->filter(function($grade) {
            return ($grade->ocrResult && $grade->ocrResult->ocr_type === 'o_level') ||
                   $grade->qualification === 'O-Level';
        })->keyBy('subject');
        
        $aLevelGrades = $studentGrades->filter(function($grade) {
            return ($grade->ocrResult && $grade->ocrResult->ocr_type === 'a_level') ||
                   $grade->qualification === 'A-Level';
        })->keyBy('subject');

        return $reflection->invoke(
            $userRecommendationController, 
            $application->schoolProgramme, 
            $oLevelGrades, 
            $aLevelGrades, 
            $hntecResults
        );
    }

    /**
     * Handle consequences when a student is accepted
     */
    private function handleAcceptanceConsequences($acceptedApplication): void
    {
        // If student is accepted for their 1st choice, consider what to do with 2nd choice
        if ($acceptedApplication->preference_rank === 1) {
            $secondChoice = StudentApplication::where('user_id', $acceptedApplication->user_id)
                ->where('preference_rank', 2)
                ->where('status', 'pending')
                ->first();

            if ($secondChoice) {
                // Optionally auto-reject 2nd choice, or leave it for manual review
                // For now, we'll leave it as is to allow admission managers to decide
            }
        }
    }

    /**
     * Display quota management page
     */
    public function quotas(Request $request)
    {
        if (!Auth::user()->isAdmissionManager()) {
            abort(403, 'Unauthorized access');
        }

        $query = SchoolProgramme::with(['diplomaProgramme'])
            ->where('is_active', 1);

        // Filter by school
        if ($request->filled('school')) {
            $query->where('school', $request->school);
        }

        $programmes = $query->get();

        // Calculate quota utilization for each programme
        $quotaData = [];
        foreach ($programmes as $programme) {
            $totalApplications = StudentApplication::where('school_programme_id', $programme->id)->count();
            $acceptedApplications = StudentApplication::where('school_programme_id', $programme->id)
                ->where('status', 'accepted')
                ->count();
            $pendingApplications = StudentApplication::where('school_programme_id', $programme->id)
                ->where('status', 'pending')
                ->count();

            $quota = $programme->admission_quota ?? 0;
            $available = max(0, $quota - $acceptedApplications);
            $utilizationPercentage = $quota > 0 ? round(($acceptedApplications / $quota) * 100, 1) : 0;

            $quotaData[] = [
                'programme' => $programme,
                'quota' => $quota,
                'total_applications' => $totalApplications,
                'accepted' => $acceptedApplications,
                'pending' => $pendingApplications,
                'available' => $available,
                'utilization_percentage' => $utilizationPercentage,
                'status' => $this->getQuotaStatus($quota, $acceptedApplications, $pendingApplications)
            ];
        }

        // Sort by utilization percentage descending
        usort($quotaData, fn($a, $b) => $b['utilization_percentage'] <=> $a['utilization_percentage']);

        // Get filter options
        $schools = SchoolProgramme::select('school')->distinct()->pluck('school');

        return view('staff.admission.quotas', compact('quotaData', 'schools'));
    }

    /**
     * Update programme quota
     */
    public function updateQuota(Request $request, $id)
    {
        if (!Auth::user()->isAdmissionManager()) {
            abort(403, 'Unauthorized access');
        }

        $request->validate([
            'admission_quota' => 'required|integer|min:0|max:1000'
        ]);

        $programme = SchoolProgramme::findOrFail($id);

        // Check if new quota is less than current accepted students
        $acceptedCount = StudentApplication::where('school_programme_id', $programme->id)
            ->where('status', 'accepted')
            ->count();

        if ($request->admission_quota < $acceptedCount) {
            throw ValidationException::withMessages([
                'admission_quota' => "Cannot set quota below current accepted students ({$acceptedCount}). Please reject some applications first."
            ]);
        }

        $programme->update([
            'admission_quota' => $request->admission_quota
        ]);

        return redirect()->back()->with('success', 'Programme quota updated successfully.');
    }

    /**
     * Bulk update quotas
     */
    public function bulkUpdateQuotas(Request $request)
    {
        if (!Auth::user()->isAdmissionManager()) {
            abort(403, 'Unauthorized access');
        }

        $request->validate([
            'quotas' => 'required|array',
            'quotas.*.programme_id' => 'required|exists:school_programmes,id',
            'quotas.*.quota' => 'required|integer|min:0|max:1000'
        ]);

        $updated = 0;
        $errors = [];

        DB::transaction(function() use ($request, &$updated, &$errors) {
            foreach ($request->quotas as $quotaData) {
                try {
                    $programme = SchoolProgramme::findOrFail($quotaData['programme_id']);
                    
                    // Check if new quota is valid
                    $acceptedCount = StudentApplication::where('school_programme_id', $programme->id)
                        ->where('status', 'accepted')
                        ->count();

                    if ($quotaData['quota'] < $acceptedCount) {
                        $errors[] = "{$programme->diplomaProgramme->name}: Cannot set quota below {$acceptedCount} accepted students";
                        continue;
                    }

                    $programme->update(['admission_quota' => $quotaData['quota']]);
                    $updated++;
                } catch (\Exception $e) {
                    $errors[] = "Programme #{$quotaData['programme_id']}: " . $e->getMessage();
                }
            }
        });

        $message = "Updated {$updated} programme quotas successfully.";
        if (!empty($errors)) {
            $message .= " Errors: " . implode(', ', $errors);
        }

        return redirect()->back()->with('success', $message);
    }

    /**
     * Get quota status based on utilization
     */
    private function getQuotaStatus(int $quota, int $accepted, int $pending): array
    {
        if ($quota == 0) {
            return ['status' => 'no_quota', 'color' => 'gray', 'text' => 'No Quota Set'];
        }

        $utilizationPercentage = ($accepted / $quota) * 100;
        $availableSlots = $quota - $accepted;

        if ($accepted >= $quota) {
            return ['status' => 'full', 'color' => 'red', 'text' => 'Full'];
        } elseif ($utilizationPercentage >= 90) {
            return ['status' => 'nearly_full', 'color' => 'orange', 'text' => 'Nearly Full'];
        } elseif ($utilizationPercentage >= 70) {
            return ['status' => 'high', 'color' => 'yellow', 'text' => 'High Demand'];
        } elseif ($utilizationPercentage >= 40) {
            return ['status' => 'moderate', 'color' => 'blue', 'text' => 'Moderate'];
        } else {
            return ['status' => 'low', 'color' => 'green', 'text' => 'Available'];
        }
    }

    /**
     * Display appeals management page
     */
    public function appeals(Request $request)
    {
        if (!Auth::user()->isAdmissionManager()) {
            abort(403, 'Unauthorized access');
        }

        $query = StudentAppeal::with([
            'user.userProfile',
            'studentApplication.schoolProgramme.diplomaProgramme',
            'reviewer'
        ])->orderBy('created_at', 'desc');

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Search by student name or email
        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('user', function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $appeals = $query->paginate(20);

        // Get statistics
        $stats = $this->getAppealStatistics();

        return view('staff.admission.appeals', compact('appeals', 'stats'));
    }

    /**
     * Show detailed view of a specific appeal
     */
    public function showAppeal($id)
    {
        if (!Auth::user()->isAdmissionManager()) {
            abort(403, 'Unauthorized access');
        }

        $appeal = StudentAppeal::with([
            'user.userProfile',
            'studentApplication.schoolProgramme.diplomaProgramme',
            'reviewer'
        ])->findOrFail($id);

        return view('staff.admission.appeal-detail', compact('appeal'));
    }

    /**
     * Update appeal status
     */
    public function updateAppealStatus(Request $request, $id)
    {
        if (!Auth::user()->isAdmissionManager()) {
            abort(403, 'Unauthorized access');
        }

        $request->validate([
            'status' => 'required|in:pending,under_review,approved,rejected',
            'admin_response' => 'nullable|string|max:1000'
        ]);

        $appeal = StudentAppeal::findOrFail($id);

        DB::transaction(function() use ($appeal, $request) {
            $appeal->update([
                'status' => $request->status,
                'admin_response' => $request->admin_response,
                'reviewed_at' => now(),
                'reviewed_by' => Auth::id(),
            ]);

            // If appeal is approved, update the original application status
            if ($request->status === 'approved') {
                $appeal->studentApplication->update([
                    'status' => 'accepted',
                    'review_notes' => 'Accepted via appeal process',
                    'reviewed_at' => now(),
                    'reviewed_by' => Auth::id(),
                ]);
            }
        });

        return redirect()->back()->with('success', 'Appeal status updated successfully.');
    }

    /**
     * Get appeal statistics for dashboard
     */
    private function getAppealStatistics(): array
    {
        return [
            'total' => StudentAppeal::count(),
            'pending' => StudentAppeal::where('status', 'pending')->count(),
            'under_review' => StudentAppeal::where('status', 'under_review')->count(),
            'approved' => StudentAppeal::where('status', 'approved')->count(),
            'rejected' => StudentAppeal::where('status', 'rejected')->count(),
            'today' => StudentAppeal::whereDate('created_at', today())->count(),
        ];
    }
}