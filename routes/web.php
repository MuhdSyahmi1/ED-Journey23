<?php
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\UserQuestionnaireController;
use App\Http\Controllers\UserFeedbackController;
use App\Http\Controllers\AdminController; // Add this import
use App\Http\Controllers\StaffController;
use App\Http\Controllers\CaseReportController;
use App\Http\Controllers\AdmissionUserProfileController;
use App\Http\Controllers\OLevelSubjectController;
use App\Http\Controllers\UserGradesController;
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
        return view('user.recommendations');
    })->name('user.recommendations');

    // NEW: HECAS Information Route
    Route::get('/user/hecas-info', function () {
        if (auth()->user()->role !== 'user') {
            abort(403, 'Unauthorized');
        }
        return view('user.hecas-info');
    })->name('user.hecas-info');

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