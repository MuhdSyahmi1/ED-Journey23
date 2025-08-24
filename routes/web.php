<?php
use App\Http\Controllers\UserFeedbackController;
use App\Http\Controllers\AdminController; // Add this import
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
    // Staff Dashboard
    Route::get('/staff/dashboard', function () {
        if (auth()->user()->role !== 'staff') {
            abort(403, 'Unauthorized');
        }
        return view('staff.dashboard');
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
    Route::get('/user/upload-result', function () {
        if (auth()->user()->role !== 'user') {
            abort(403, 'Unauthorized');
        }
        return view('user.upload-result');
    })->name('user.upload-result');

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

    // Remove or comment out the old school route since it's not in the new navigation
    Route::get('/user/school', function () {
      if (auth()->user()->role !== 'user') {
          abort(403, 'Unauthorized');
        }
         return view('user.School');
    })->name('user.school');

    // sict page
    Route::get('/user/school/sict', function () {
        if (auth()->user()->role !== 'user') {
            abort(403, 'Unauthorized');
        }
        return view('user.school.sict'); // create this Blade view
    })->name('sict');

    // sse page
    Route::get('school/sse', function () {
        if (auth()->user()->role !== 'user') {
            abort(403, 'Unauthorized');
        }
        return view('user.school.sse'); // create this Blade view
    })->name('sse');

     // sbs page
    Route::get('school/sbs', function () {
        if (auth()->user()->role !== 'user') {
            abort(403, 'Unauthorized');
        }
        return view('user.school.sbs'); // create this Blade view
    })->name('sbs');

    // shs page
    Route::get('/user/school/shs', function () {
        if (auth()->user()->role !== 'user') {
            abort(403, 'Unauthorized');
        }
        return view('user.school.shs'); // create this Blade view
    })->name('shs');

    // spc page
    Route::get('/user/school/spc', function () {
        if (auth()->user()->role !== 'user') {
            abort(403, 'Unauthorized');
        }
        return view('user.school.spc'); // create this Blade view
    })->name('spc');
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