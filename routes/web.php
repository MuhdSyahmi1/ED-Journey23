<?php
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\UserQuestionnaireController;
use App\Http\Controllers\UserFeedbackController;
use App\Http\Controllers\AdminController; // Add this import
use App\Http\Controllers\StaffController;
use App\Http\Controllers\CaseReportController;
use App\Http\Controllers\AdmissionUserProfileController;
use App\Http\Controllers\OLevelSubjectController;
use App\Http\Controllers\ALevelSubjectController;
use App\Http\Controllers\HntecProgrammeController;
use App\Http\Controllers\DiplomaProgrammeController;
use App\Http\Controllers\UserGradesController;
use App\Http\Controllers\UserRecommendationController;
use App\Http\Controllers\HecasInfoController;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::get('/', function () {
    return view('index');
})->name('home');

// Role-based Dashboards (with lowercase role checks)
Route::middleware(['auth', 'verified'])->group(function () {
    // Legacy dashboard route (redirect based on role)
    Route::get('/dashboard', function () {
        $user = auth()->user();
        
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif ($user->role === 'staff') {
            return redirect()->route('staff.dashboard');
        } else {
            return redirect()->route('user.dashboard');
        }
    })->name('dashboard');
});

// Admin routes using controller (REPLACE your current admin routes with these)
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/manage-account', [AdminController::class, 'manageAccount'])->name('manage-account');
    Route::post('/create-manager', [AdminController::class, 'createManager'])->name('create-manager');
    Route::put('/update-manager/{id}', [AdminController::class, 'updateManager'])->name('update-manager');
    Route::delete('/delete-manager/{id}', [AdminController::class, 'deleteManager'])->name('delete-manager');
    Route::patch('/toggle-manager-status/{id}', [AdminController::class, 'toggleManagerStatus'])->name('toggle-manager-status');
    Route::get('/feedback', [AdminController::class, 'feedback'])->name('feedback');
    Route::post('/reply-feedback/{id}', [AdminController::class, 'replyFeedback'])->name('reply-feedback');
    Route::patch('/update-feedback-status/{id}', [AdminController::class, 'updateFeedbackStatus'])->name('update-feedback-status');
    Route::get('/dashboard-data', [AdminController::class, 'getDashboardData'])->name('dashboard-data'); 
});

// Staff-specific routes
Route::middleware(['auth'])->group(function () {
    // Staff Dashboard - Role-based routing
    Route::get('/staff/dashboard', function () {
        if (auth()->user()->role !== 'staff') {
            abort(403, 'Unauthorized');
        }
        
        $user = auth()->user();
        
        // Route to role-specific dashboard based on manager_type
        switch ($user->manager_type) {
            case 'program':
                return view('staff.program.dashboard');
            case 'admission':
                return view('staff.admission.dashboard');
            case 'news_events':
                return view('staff.news-events.dashboard');
            case 'moderators':
                return view('staff.moderators.dashboard');
            case 'data_analytics':
                return view('staff.data-analytics.dashboard');
            default:
                // Fallback to generic staff dashboard
                return view('staff.dashboard');
        }
    })->name('staff.dashboard');

    // Staff Course Management
    Route::get('/staff/course-management', function () {
        if (auth()->user()->role !== 'staff') {
            abort(403, 'Unauthorized');
        }
        return view('staff.CourseManagement');
    })->name('staff.course-management');

    // Staff Feedback Center
    Route::get('/staff/feedback-center', function () {
        if (auth()->user()->role !== 'staff') {
            abort(403, 'Unauthorized');
        }
        return view('staff.FeedbackCenter');
    })->name('staff.feedback-center');

    // Staff Profile Information
    Route::get('/staff/profile-information', function () {
        if (auth()->user()->role !== 'staff') {
            abort(403, 'Unauthorized');
        }
        return view('staff.ProfileInformation');
    })->name('staff.profile-information');
});

// Staff Admission Management routes
Route::middleware(['auth'])->prefix('staff/admission')->name('staff.admission.')->group(function () {
    Route::get('/applications', [\App\Http\Controllers\AdmissionController::class, 'applications'])->name('applications');
    Route::get('/application/{id}', [\App\Http\Controllers\AdmissionController::class, 'showApplication'])->name('application');
    Route::post('/application/{id}/status', [\App\Http\Controllers\AdmissionController::class, 'updateApplicationStatus'])->name('application.update-status');
    Route::post('/bulk-update', [\App\Http\Controllers\AdmissionController::class, 'bulkUpdateStatus'])->name('bulk-update');
    
    // Quota Management routes
    Route::get('/quotas', [\App\Http\Controllers\AdmissionController::class, 'quotas'])->name('quotas');
    Route::post('/quota/{id}', [\App\Http\Controllers\AdmissionController::class, 'updateQuota'])->name('quota.update');
    Route::post('/bulk-update-quotas', [\App\Http\Controllers\AdmissionController::class, 'bulkUpdateQuotas'])->name('bulk-update-quotas');
    
    // Appeal Management routes
    Route::get('/appeals', [\App\Http\Controllers\AdmissionController::class, 'appeals'])->name('appeals');
    Route::get('/appeal/{id}', [\App\Http\Controllers\AdmissionController::class, 'showAppeal'])->name('appeal');
    Route::post('/appeal/{id}/status', [\App\Http\Controllers\AdmissionController::class, 'updateAppealStatus'])->name('appeal.update-status');
});

// Staff Program Management routes
Route::middleware(['auth'])->prefix('staff/program')->name('staff.program.')->group(function () {
    Route::get('/programme-management', function () {
        if (auth()->user()->role !== 'staff' || !auth()->user()->isProgramManager()) {
            abort(403, 'Unauthorized');
        }
        return view('staff.program.programme-management');
    })->name('programme-management');
    
    // Individual School routes
    Route::get('/school/{school}', function ($school) {
        if (auth()->user()->role !== 'staff' || !auth()->user()->isProgramManager()) {
            abort(403, 'Unauthorized');
        }
        
        // Validate school parameter
        $validSchools = ['business', 'health', 'ict', 'engineering', 'petrochemical'];
        if (!in_array($school, $validSchools)) {
            abort(404);
        }
        
        return view('staff.program.school', compact('school'));
    })->name('school');
    
    // School-specific programme routes
    Route::get('/school/{school}/programmes', function ($school) {
        if (auth()->user()->role !== 'staff' || !auth()->user()->isProgramManager()) {
            abort(403, 'Unauthorized');
        }
        
        // Validate school parameter
        $validSchools = ['business', 'health', 'ict', 'engineering', 'petrochemical'];
        if (!in_array($school, $validSchools)) {
            abort(404);
        }
        
        return view('staff.program.schools.' . $school . '.programmes', compact('school'));
    })->name('school.programmes');
    
    // Entry requirements routes
    Route::get('/school/{school}/programmes/{programmeId}/entry-requirements/hntec', function ($school, $programmeId) {
        if (auth()->user()->role !== 'staff' || !auth()->user()->isProgramManager()) {
            abort(403, 'Unauthorized');
        }
        
        // Validate school parameter
        $validSchools = ['business', 'health', 'ict', 'engineering', 'petrochemical'];
        if (!in_array($school, $validSchools)) {
            abort(404);
        }
        
        return view('staff.program.schools.' . $school . '.entry-requirements.hntec', compact('school', 'programmeId'));
    })->name('school.programmes.hntec');
    
    Route::get('/school/{school}/programmes/{programmeId}/entry-requirements/olevel', function ($school, $programmeId) {
        if (auth()->user()->role !== 'staff' || !auth()->user()->isProgramManager()) {
            abort(403, 'Unauthorized');
        }
        
        // Validate school parameter
        $validSchools = ['business', 'health', 'ict', 'engineering', 'petrochemical'];
        if (!in_array($school, $validSchools)) {
            abort(404);
        }
        
        return view('staff.program.schools.' . $school . '.entry-requirements.olevel', compact('school', 'programmeId'));
    })->name('school.programmes.olevel');
    
    // API Routes for programme management
    Route::prefix('api/school/{school}')->name('api.school.')->group(function () {
        // School programme API routes
        Route::get('/programmes', [App\Http\Controllers\SchoolProgrammeController::class, 'index'])->name('programmes.index');
        Route::post('/programmes', [App\Http\Controllers\SchoolProgrammeController::class, 'store'])->name('programmes.store');
        Route::put('/programmes/{programme}', [App\Http\Controllers\SchoolProgrammeController::class, 'update'])->name('programmes.update');
        Route::delete('/programmes/{programme}', [App\Http\Controllers\SchoolProgrammeController::class, 'destroy'])->name('programmes.destroy');
        Route::delete('/programmes/bulk', [App\Http\Controllers\SchoolProgrammeController::class, 'bulkDestroy'])->name('programmes.bulk-destroy');
        Route::get('/programmes/available', [App\Http\Controllers\SchoolProgrammeController::class, 'getAvailableProgrammes'])->name('programmes.available');
        Route::get('/programmes/statistics', [App\Http\Controllers\SchoolProgrammeController::class, 'getStatistics'])->name('programmes.statistics');
        
        // HNTec requirements API routes
        Route::get('/programmes/{programmeId}/hntec', [App\Http\Controllers\ProgrammeHntecRequirementController::class, 'index'])->name('programmes.hntec.index');
        Route::post('/programmes/{programmeId}/hntec', [App\Http\Controllers\ProgrammeHntecRequirementController::class, 'store'])->name('programmes.hntec.store');
        Route::put('/programmes/{programmeId}/hntec/{requirement}', [App\Http\Controllers\ProgrammeHntecRequirementController::class, 'update'])->name('programmes.hntec.update');
        Route::delete('/programmes/{programmeId}/hntec/{requirement}', [App\Http\Controllers\ProgrammeHntecRequirementController::class, 'destroy'])->name('programmes.hntec.destroy');
        Route::delete('/programmes/{programmeId}/hntec/bulk', [App\Http\Controllers\ProgrammeHntecRequirementController::class, 'bulkDestroy'])->name('programmes.hntec.bulk-destroy');
        Route::get('/programmes/{programmeId}/hntec/available', [App\Http\Controllers\ProgrammeHntecRequirementController::class, 'getAvailableHntecProgrammes'])->name('programmes.hntec.available');
        Route::get('/programmes/{programmeId}/hntec/statistics', [App\Http\Controllers\ProgrammeHntecRequirementController::class, 'getStatistics'])->name('programmes.hntec.statistics');
        
        // Alternative route patterns for frontend compatibility
        Route::get('/programmes/{programmeId}/available-hntec-programmes', [App\Http\Controllers\ProgrammeHntecRequirementController::class, 'getAvailableHntecProgrammes'])->name('programmes.available-hntec-programmes');
        Route::get('/programmes/{programmeId}/hntec-requirements', [App\Http\Controllers\ProgrammeHntecRequirementController::class, 'index'])->name('programmes.hntec-requirements.index');
        Route::post('/programmes/{programmeId}/hntec-requirements', [App\Http\Controllers\ProgrammeHntecRequirementController::class, 'store'])->name('programmes.hntec-requirements.store');
        Route::put('/programmes/{programmeId}/hntec-requirements/{requirement}', [App\Http\Controllers\ProgrammeHntecRequirementController::class, 'update'])->name('programmes.hntec-requirements.update');
        Route::delete('/programmes/{programmeId}/hntec-requirements/{requirement}', [App\Http\Controllers\ProgrammeHntecRequirementController::class, 'destroy'])->name('programmes.hntec-requirements.destroy');
        Route::delete('/programmes/{programmeId}/hntec-requirements/bulk-delete', [App\Http\Controllers\ProgrammeHntecRequirementController::class, 'bulkDestroy'])->name('programmes.hntec-requirements.bulk-destroy');
        Route::get('/programmes/{programmeId}/hntec-statistics', [App\Http\Controllers\ProgrammeHntecRequirementController::class, 'getStatistics'])->name('programmes.hntec-statistics');
        
        // O Level requirements API routes
        Route::get('/programmes/{programmeId}/olevel', [App\Http\Controllers\ProgrammeOlevelRequirementController::class, 'index'])->name('programmes.olevel.index');
        Route::post('/programmes/{programmeId}/olevel', [App\Http\Controllers\ProgrammeOlevelRequirementController::class, 'store'])->name('programmes.olevel.store');
        Route::put('/programmes/{programmeId}/olevel/{requirement}', [App\Http\Controllers\ProgrammeOlevelRequirementController::class, 'update'])->name('programmes.olevel.update');
        Route::delete('/programmes/{programmeId}/olevel/{requirement}', [App\Http\Controllers\ProgrammeOlevelRequirementController::class, 'destroy'])->name('programmes.olevel.destroy');
        Route::delete('/programmes/{programmeId}/olevel/bulk', [App\Http\Controllers\ProgrammeOlevelRequirementController::class, 'bulkDestroy'])->name('programmes.olevel.bulk-destroy');
        Route::get('/programmes/{programmeId}/olevel/available', [App\Http\Controllers\ProgrammeOlevelRequirementController::class, 'getAvailableOLevelSubjects'])->name('programmes.olevel.available');
        Route::get('/programmes/{programmeId}/olevel/statistics', [App\Http\Controllers\ProgrammeOlevelRequirementController::class, 'getStatistics'])->name('programmes.olevel.statistics');
        
        // Alternative route patterns for O-Level frontend compatibility
        Route::get('/programmes/{programmeId}/available-olevel-subjects', [App\Http\Controllers\ProgrammeOlevelRequirementController::class, 'getAvailableOLevelSubjects'])->name('programmes.available-olevel-subjects');
        Route::get('/programmes/{programmeId}/olevel-requirements', [App\Http\Controllers\ProgrammeOlevelRequirementController::class, 'index'])->name('programmes.olevel-requirements.index');
        Route::post('/programmes/{programmeId}/olevel-requirements', [App\Http\Controllers\ProgrammeOlevelRequirementController::class, 'store'])->name('programmes.olevel-requirements.store');
        Route::put('/programmes/{programmeId}/olevel-requirements/{requirement}', [App\Http\Controllers\ProgrammeOlevelRequirementController::class, 'update'])->name('programmes.olevel-requirements.update');
        Route::delete('/programmes/{programmeId}/olevel-requirements/{requirement}', [App\Http\Controllers\ProgrammeOlevelRequirementController::class, 'destroy'])->name('programmes.olevel-requirements.destroy');
        Route::delete('/programmes/{programmeId}/olevel-requirements/bulk-delete', [App\Http\Controllers\ProgrammeOlevelRequirementController::class, 'bulkDestroy'])->name('programmes.olevel-requirements.bulk-destroy');
        Route::get('/programmes/{programmeId}/olevel-statistics', [App\Http\Controllers\ProgrammeOlevelRequirementController::class, 'getStatistics'])->name('programmes.olevel-statistics');
    });
    
    // Program Manager Feedback route
    Route::get('/feedback', function () {
        if (auth()->user()->role !== 'staff' || !auth()->user()->isProgramManager()) {
            abort(403, 'Unauthorized');
        }
        
        // Get all feedback with user information - same as StaffController
        $allFeedback = \App\Models\Feedback::with(['user', 'repliedByUser'])
            ->orderBy('created_at', 'desc')
            ->get();
        
        // Group feedback by status for easy filtering
        $pendingFeedback = $allFeedback->where('status', 'pending');
        $inProgressFeedback = $allFeedback->where('status', 'in-progress');
        $solvedFeedback = $allFeedback->where('status', 'solved');
        
        // Get feedback statistics
        $stats = [
            'total' => $allFeedback->count(),
            'pending' => $pendingFeedback->count(),
            'in_progress' => $inProgressFeedback->count(),
            'solved' => $solvedFeedback->count(),
            'high_priority' => $allFeedback->where('priority', 'high')->count(),
        ];
        
        return view('staff.feedback', compact(
            'allFeedback', 
            'pendingFeedback', 
            'inProgressFeedback', 
            'solvedFeedback', 
            'stats'
        ));
    })->name('feedback');
    
    // Program Manager Feedback action routes
    Route::post('/reply-feedback/{id}', function (\Illuminate\Http\Request $request, $id) {
        if (auth()->user()->role !== 'staff' || !auth()->user()->isProgramManager()) {
            abort(403, 'Unauthorized');
        }
        
        $request->validate([
            'admin_reply' => 'required|string|min:10',
            'status' => 'required|in:pending,in-progress,solved'
        ]);
        
        $feedback = \App\Models\Feedback::findOrFail($id);
        
        $feedback->update([
            'admin_reply' => $request->admin_reply,
            'status' => $request->status,
            'replied_by' => auth()->id(),
            'replied_at' => now(),
            'resolved_at' => $request->status === 'solved' ? now() : null,
        ]);
        
        $statusText = match($request->status) {
            'pending' => 'marked as pending',
            'in-progress' => 'marked as in progress',
            'solved' => 'marked as solved',
        };
        
        return redirect()->route('staff.program.feedback')
            ->with('success', "Feedback replied to and {$statusText}!");
    })->name('reply-feedback');
    
    Route::patch('/update-feedback-status/{id}', function (\Illuminate\Http\Request $request, $id) {
        if (auth()->user()->role !== 'staff' || !auth()->user()->isProgramManager()) {
            abort(403, 'Unauthorized');
        }
        
        $request->validate([
            'status' => 'required|in:pending,in-progress,solved'
        ]);
        
        $feedback = \App\Models\Feedback::findOrFail($id);
        
        $feedback->update([
            'status' => $request->status,
            'resolved_at' => $request->status === 'solved' ? now() : null,
        ]);
        
        return response()->json(['success' => true]);
    })->name('update-feedback-status');
});

Route::middleware(['auth'])->group(function () {
    // Staff Case Report routes (for admission managers)
    Route::middleware(['auth'])->prefix('staff')->name('staff.')->group(function () {
        Route::get('/case-reports', [CaseReportController::class, 'index'])->name('case-reports');
        Route::patch('/case-report/{caseReport}/status', [CaseReportController::class, 'updateStatus'])->name('case-report.update-status');
        
        // Staff Feedback routes
        Route::get('/feedback', [StaffController::class, 'feedback'])->name('feedback');
        Route::post('/reply-feedback/{id}', [StaffController::class, 'replyFeedback'])->name('reply-feedback');
        Route::patch('/update-feedback-status/{id}', [StaffController::class, 'updateFeedbackStatus'])->name('update-feedback-status');
    });

    // Staff Admission User Profile routes
    Route::middleware(['auth'])->prefix('staff/admission')->name('staff.admission.')->group(function () {
        Route::get('/user-profile', [AdmissionUserProfileController::class, 'index'])->name('user-profile');
        Route::get('/user-profile/{id}', [AdmissionUserProfileController::class, 'show'])->name('user-profile.show');
        Route::post('/user-profile/{id}/verify', [AdmissionUserProfileController::class, 'verify'])->name('user-profile.verify');
        Route::post('/user-profile/{id}/reject', [AdmissionUserProfileController::class, 'reject'])->name('user-profile.reject');
        Route::get('/user-profile/{id}/view-ic', [AdmissionUserProfileController::class, 'viewIC'])->name('user-profile.view-ic');
        
        // Report Data routes
        Route::get('/report-data', [AdmissionUserProfileController::class, 'reportData'])->name('report-data');
        Route::get('/report-data/pdf', [AdmissionUserProfileController::class, 'generatePdfReport'])->name('report-data.pdf');
        
        // Programme Management route
        Route::get('/programme-management', function () {
            if (auth()->user()->role !== 'staff' || !auth()->user()->isAdmissionManager()) {
                abort(403, 'Unauthorized');
            }
            return view('staff.admission.programme-management');
        })->name('programme-management');
        
        // O Level Subjects routes
        Route::get('/olevel-subjects', [OLevelSubjectController::class, 'index'])->name('olevel-subjects');
        Route::post('/olevel-subjects', [OLevelSubjectController::class, 'store'])->name('olevel-subjects.store');
        Route::put('/olevel-subjects/{oLevelSubject}', [OLevelSubjectController::class, 'update'])->name('olevel-subjects.update');
        Route::delete('/olevel-subjects/{oLevelSubject}', [OLevelSubjectController::class, 'destroy'])->name('olevel-subjects.destroy');
        
        // A Level Subjects routes
        Route::get('/alevel-subjects', [ALevelSubjectController::class, 'index'])->name('alevel-subjects');
        Route::post('/alevel-subjects', [ALevelSubjectController::class, 'store'])->name('alevel-subjects.store');
        Route::put('/alevel-subjects/{aLevelSubject}', [ALevelSubjectController::class, 'update'])->name('alevel-subjects.update');
        Route::delete('/alevel-subjects/{aLevelSubject}', [ALevelSubjectController::class, 'destroy'])->name('alevel-subjects.destroy');
        
        // HNTEC Programmes routes
        Route::get('/hntec-programmes', [HntecProgrammeController::class, 'index'])->name('hntec-programmes');
        Route::post('/hntec-programmes', [HntecProgrammeController::class, 'store'])->name('hntec-programmes.store');
        Route::put('/hntec-programmes/{hntecProgramme}', [HntecProgrammeController::class, 'update'])->name('hntec-programmes.update');
        Route::delete('/hntec-programmes/{hntecProgramme}', [HntecProgrammeController::class, 'destroy'])->name('hntec-programmes.destroy');
        
        // Diploma Programmes routes
        Route::get('/diploma-programmes', [DiplomaProgrammeController::class, 'index'])->name('diploma-programmes');
        Route::post('/diploma-programmes', [DiplomaProgrammeController::class, 'store'])->name('diploma-programmes.store');
        Route::put('/diploma-programmes/{diplomaProgramme}', [DiplomaProgrammeController::class, 'update'])->name('diploma-programmes.update');
        Route::delete('/diploma-programmes/{diplomaProgramme}', [DiplomaProgrammeController::class, 'destroy'])->name('diploma-programmes.destroy');
        
        // View Student Results routes for case reports
        Route::get('/view-results/{userId}', function ($userId) {
            if (auth()->user()->role !== 'staff' || !auth()->user()->isAdmissionManager()) {
                abort(403, 'Unauthorized');
            }
            
            $user = \App\Models\User::findOrFail($userId);
            
            // Get OCR results with grades for O-Level and A-Level
            $oLevelResults = \App\Models\OcrResult::where('user_id', $userId)
                ->where('ocr_type', 'o_level')
                ->with('studentGrades')
                ->latest()
                ->first();
                
            $aLevelResults = \App\Models\OcrResult::where('user_id', $userId)
                ->where('ocr_type', 'a_level')
                ->with('studentGrades')
                ->latest()
                ->first();
                
            // Get HNTEC results using the HntecResult model
            $hntecResults = \App\Models\HntecResult::where('user_id', $userId)
                ->with('ocrResult')
                ->get();
            
            // Get case report for this user if it exists
            $caseReport = \App\Models\CaseReport::where('user_id', $userId)->first();
            
            return view('staff.admission.view-results', compact(
                'user',
                'oLevelResults', 
                'aLevelResults', 
                'hntecResults',
                'caseReport'
            ));
        })->name('view-results');
        
        // Update student grades routes
        Route::post('/update-grade/{gradeId}', function (\Illuminate\Http\Request $request, $gradeId) {
            if (auth()->user()->role !== 'staff' || !auth()->user()->isAdmissionManager()) {
                abort(403, 'Unauthorized');
            }
            
            $request->validate([
                'grade_type' => 'required|in:student_grade,hntec_result',
                'subject' => 'required|string',
                'grade' => 'required|string', 
                'syllabus' => 'nullable|string',
            ]);
            
            // Update based on grade type
            if ($request->grade_type === 'hntec_result') {
                $grade = \App\Models\HntecResult::findOrFail($gradeId);
                $grade->update([
                    'programme' => $request->subject,
                    'cgpa' => floatval($request->grade),
                ]);
            } else {
                $grade = \App\Models\StudentGrade::findOrFail($gradeId);
                $grade->update([
                    'subject' => $request->subject,
                    'grade' => $request->grade,
                    'syllabus' => $request->syllabus,
                ]);
            }
            
            return response()->json(['success' => true, 'message' => 'Grade updated successfully']);
        })->name('update-grade');
        
        // Update case report status
        Route::patch('/case-report-status/{caseReportId}', function (\Illuminate\Http\Request $request, $caseReportId) {
            if (auth()->user()->role !== 'staff' || !auth()->user()->isAdmissionManager()) {
                abort(403, 'Unauthorized');
            }
            
            $request->validate([
                'status' => 'required|in:pending,in progress,solved'
            ]);
            
            $caseReport = \App\Models\CaseReport::findOrFail($caseReportId);
            $caseReport->update(['status' => $request->status]);
            
            return response()->json(['success' => true, 'message' => 'Status updated successfully']);
        })->name('case-report-status');
    });
});

Route::middleware(['auth'])->group(function () {
    // Existing user routes...
    Route::get('/user/dashboard', function () {
        if (auth()->user()->role !== 'user') {
            abort(403, 'Unauthorized');
        }
        return view('user.dashboard');
    })->name('user.dashboard');

    // NEW: Profile Management Routes
    Route::get('/user/profile', function () {
        if (auth()->user()->role !== 'user') {
            abort(403, 'Unauthorized');
        }
        return view('user.profile');
    })->name('user.profile');

    // NEW: Questionnaire Route
    Route::get('/user/questionnaire', function () {
        if (auth()->user()->role !== 'user') {
            abort(403, 'Unauthorized');
        }
        return view('user.questionnaire');
    })->name('user.questionnaire');

    // NEW: Upload Result Route
    Route::get('/user/upload-result', [UserGradesController::class, 'index'])->name('user.upload-result');

    // NEW: Recommendations Route
    Route::get('/user/recommendations', function () {
        if (auth()->user()->role !== 'user') {
            abort(403, 'Unauthorized');
        }
        return app(UserRecommendationController::class)->index();
    })->name('user.recommendations');

    // NEW: Student Application Routes
    Route::post('/user/applications', [\App\Http\Controllers\StudentApplicationController::class, 'store'])->name('user.applications.store');
    Route::get('/user/application-submitted', [\App\Http\Controllers\StudentApplicationController::class, 'applicationSubmitted'])->name('user.application-submitted');
    Route::get('/user/my-applications', [\App\Http\Controllers\StudentApplicationController::class, 'myApplications'])->name('user.my-applications');

    // NEW: Student Appeal Routes
    Route::get('/user/appeals/create/{applicationId}', [\App\Http\Controllers\StudentAppealController::class, 'create'])->name('user.appeals.create');
    Route::post('/user/appeals/{applicationId}', [\App\Http\Controllers\StudentAppealController::class, 'store'])->name('user.appeals.store');
    Route::get('/user/appeals/{appealId}', [\App\Http\Controllers\StudentAppealController::class, 'show'])->name('user.appeals.show');
    Route::get('/user/my-appeals', [\App\Http\Controllers\StudentAppealController::class, 'index'])->name('user.my-appeals');

    // NEW: HECAS Information Routes
    Route::get('/user/hecas-info', [HecasInfoController::class, 'index'])->name('user.hecas-info');
    Route::post('/user/hecas-info', [HecasInfoController::class, 'store'])->name('user.hecas-info.store');

    // NEW: Favourites Route
    Route::get('/user/favourites', function () {
        if (auth()->user()->role !== 'user') {
            abort(403, 'Unauthorized');
        }
        return view('user.favourites');
    })->name('user.favourites');

// User feedback routes
    Route::get('/user/feedback', [UserFeedbackController::class, 'index'])->name('user.feedback');
    Route::post('/user/feedback', [UserFeedbackController::class, 'store'])->name('user.feedback.store');
    Route::get('/user/feedback/{id}', [UserFeedbackController::class, 'show'])->name('user.feedback.show');

    Route::get('/user/help', function () {
        if (auth()->user()->role !== 'user') {
            abort(403, 'Unauthorized');
        }
        return view('user.Help');
    })->name('user.help');

    // School routes - REPLACE your existing school routes with these
    Route::get('/user/school', function () {
        if (auth()->user()->role !== 'user') {
            abort(403, 'Unauthorized');
        }
        return view('user.School');
    })->name('user.school');

    // Add this route alias so route('school') works
    Route::get('/school', function () {
        if (auth()->user()->role !== 'user') {
            abort(403, 'Unauthorized');
        }
        return view('user.School');
    })->name('school');

    // Individual School Pages - Fixed with consistent naming
    Route::get('/user/school/sse', function () {
        if (auth()->user()->role !== 'user') {
            abort(403, 'Unauthorized');
        }
        return view('user.school.sse');
    })->name('sse');

    Route::get('/user/school/sbs', function () {
        if (auth()->user()->role !== 'user') {
            abort(403, 'Unauthorized');
        }
        return view('user.school.sbs');
    })->name('sbs');

    Route::get('/user/school/shs', function () {
        if (auth()->user()->role !== 'user') {
            abort(403, 'Unauthorized');
        }
        return view('user.school.shs');
    })->name('shs');

    Route::get('/user/school/sict', function () {
        if (auth()->user()->role !== 'user') {
            abort(403, 'Unauthorized');
        }
        return view('user.school.sict');
    })->name('sict');

    Route::get('/user/school/spc', function () {
        if (auth()->user()->role !== 'user') {
            abort(403, 'Unauthorized');
        }
        return view('user.school.spc');
    })->name('spc');

    // Profile routes
    Route::get('/user/profile', [UserProfileController::class, 'index'])->name('user.profile');
    Route::post('/user/profile', [UserProfileController::class, 'store'])->name('user.profile.store');
    Route::get('/user/profile/progress', [UserProfileController::class, 'getProgress'])->name('user.profile.progress');
    Route::get('/user/profile/download-ic', [UserProfileController::class, 'downloadIC'])->name('user.profile.download-ic');
    Route::get('/user/profile/view-ic', [UserProfileController::class, 'viewIC'])->name('user.profile.view-ic');

     // Questionnaire routes
    Route::get('/user/questionnaire', [UserQuestionnaireController::class, 'index'])->name('user.questionnaire');
    Route::get('/user/questionnaire/retake', [UserQuestionnaireController::class, 'retake'])->name('user.questionnaire.retake');
    Route::post('/user/questionnaire', [UserQuestionnaireController::class, 'store'])->name('user.questionnaire.store');
    Route::get('/user/questionnaire/results', [UserQuestionnaireController::class, 'results'])->name('user.questionnaire.results');
    Route::get('/user/questionnaire/progress', [UserQuestionnaireController::class, 'getProgress'])->name('user.questionnaire.progress');

    // Case Report routes (for users)
    Route::post('/user/case-report', [CaseReportController::class, 'store'])->name('user.case-report.store');

    // Grades routes (for users)
    Route::post('/user/grades/upload', [UserGradesController::class, 'upload'])->name('user.grades.upload');

    // Identity Card OCR routes (for users)
    Route::post('/user/profile/scan-ic', [App\Http\Controllers\IdentityCardController::class, 'upload'])->name('user.profile.scan-ic');
    Route::get('/user/profile/ic-history', [App\Http\Controllers\IdentityCardController::class, 'getExtractionHistory'])->name('user.profile.ic-history');
});

// Settings routes
Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

// Debug route (remove this after testing)
Route::get('/debug-user', function() {
    if (auth()->check()) {
        $user = auth()->user();
        dd([
            'user_id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'role' => $user->role,
            'role_type' => gettype($user->role),
            'role_length' => strlen($user->role),
        ]);
    } else {
        dd('Not logged in');
    }
})->middleware('auth');

require __DIR__.'/auth.php';