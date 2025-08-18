<?php

use App\Http\Controllers\StaffController;
use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::get('/', function () {
    return view('index'); // CHANGED FROM 'welcome' TO 'index'
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__.'/auth.php';

// Admin-only routes
Route::middleware(['auth', 'role:Admin'])->group(function () {
    Route::get('/staff/create', [StaffController::class, 'showCreateForm'])->name('staff.create');
    Route::post('/staff/create', [StaffController::class, 'createStaff'])->name('staff.store');
});