<?php

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

// User-specific routes
Route::middleware(['auth'])->group(function () {
    // User Dashboard
    Route::get('/user/dashboard', function () {
        if (auth()->user()->role !== 'user') {
            abort(403, 'Unauthorized');
        }
        return view('user.dashboard');
    })->name('user.dashboard');

    // User School
    Route::get('/user/school', function () {
        if (auth()->user()->role !== 'user') {
            abort(403, 'Unauthorized');
        }
        return view('user.School');
    })->name('user.school');

    // User Help
    Route::get('/user/help', function () {
        if (auth()->user()->role !== 'user') {
            abort(403, 'Unauthorized');
        }
        return view('user.Help');
    })->name('user.help');

    // User Feedback
    Route::get('/user/feedback', function () {
        if (auth()->user()->role !== 'user') {
            abort(403, 'Unauthorized');
        }
        return view('user.Feedback');
    })->name('user.feedback');
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