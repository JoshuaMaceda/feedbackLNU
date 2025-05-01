<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\StudentDashboardController;
use App\Http\Controllers\SupervisorDashboardController;
use App\Http\Controllers\TeacherDashboardController;

use App\Models\User;

Route::get('/', [AuthController::class, 'showLoginForm'])->name('login'); 
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('student/dashboard', [StudentDashboardController::class, 'index'])->name('student.dashboard');
    Route::get('teacher/dashboard', [TeacherDashboardController::class, 'index'])->name('teacher.dashboard');
    Route::get('supervisor/dashboard', [SupervisorDashboardController::class, 'index'])->name('supervisor.dashboard');
    Route::get('admin/redirector', [AdminDashboardController::class, 'index'])->name('admin.redirector');
});

//para admin
Route::post('/admin/redirector', [AdminDashboardController::class, 'redirect'])->name('admin.redirector');

// Student Feedback Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/feedback', [StudentFeedbackController::class, 'index'])->name('feedback.index');
    Route::post('/feedback', [StudentFeedbackController::class, 'store'])->name('feedback.store');
    
    // Profile and notification routes
    Route::get('/profile/edit', function() {
        // Your profile edit logic
    })->name('profile.edit');
    
    Route::get('/settings', function() {
        // Your settings logic
    })->name('settings');
    
    Route::get('/notifications', function() {
        // Your notifications index logic
    })->name('notifications.index');
    
    Route::get('/notifications/{notification}', function() {
        // Your notification show logic
    })->name('notifications.show');
});