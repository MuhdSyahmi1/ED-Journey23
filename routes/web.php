<?php

use App\Http\Controllers\StaffController;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::get('/', function () {
    return view('index');
})->name('home');

// Role-based Dashboards (with lowercase role checks)
Route::middleware(['auth', 'verified'])->group(function () {
    // Admin Dashboard
    Route::get('/admin/dashboard', function () {
        // Check role manually in the route (lowercase)
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized');
        }
        return view('admin.dashboard');
    })->name('admin.dashboard');

    // Staff Dashboard
    Route::get('/staff/dashboard', function () {
        // Check role manually in the route (lowercase)
        if (auth()->user()->role !== 'staff') {
            abort(403, 'Unauthorized');
        }
        return view('staff.dashboard');
    })->name('staff.dashboard');

    // User Dashboard
    Route::get('/user/dashboard', function () {
        // Check role manually in the route (lowercase)
        if (auth()->user()->role !== 'user') {
            abort(403, 'Unauthorized');
        }
        return view('user.dashboard');
    })->name('user.dashboard');

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

// Admin-specific routes
Route::middleware(['auth'])->group(function () {
    // Admin Manage Account - connects to your ManageAccount.blade.php
    Route::get('/admin/manage-account', function () {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized');
        }
        return view('admin.ManageAccount');
    })->name('admin.manage-account');

    // Admin Feedback
    Route::get('/admin/feedback', function () {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized');
        }
        return view('admin.feedback');
    })->name('admin.feedback');

    // Staff creation routes
    Route::get('/staff/create', function() {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized');
        }
        return app(StaffController::class)->showCreateForm();
    })->name('staff.create');
    
    Route::post('/staff/create', function() {
        if (auth()->user()->role !== 'admin') {
            abort(403, 'Unauthorized');
        }
        return app(StaffController::class)->createStaff(request());
    })->name('staff.store');
});

// Staff-specific routes
Route::middleware(['auth'])->group(function () {
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