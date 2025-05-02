<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\StudentDashboardController;
use App\Http\Controllers\SupervisorDashboardController;
use App\Http\Controllers\TeacherDashboardController;
use App\Http\Controllers\StudentFeedbackController;

// Authentication Routes
Route::get('/', [AuthController::class, 'showLoginForm'])->name('login'); 
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Dashboard Routes (Middleware applied for authentication)
Route::middleware(['auth'])->group(function () {
    Route::get('/student/dashboard', [StudentDashboardController::class, 'index'])->name('student.dashboard');
    Route::get('/teacher/dashboard', [TeacherDashboardController::class, 'index'])->name('teacher.dashboard');
    Route::get('/supervisor/dashboard', [SupervisorDashboardController::class, 'index'])->name('supervisor.dashboard');
    Route::get('/admin/redirector', [AdminDashboardController::class, 'index'])->name('admin.redirector');
    Route::post('/admin/redirector', [AdminDashboardController::class, 'redirect'])->name('admin.redirector');

    // Student Feedback Routes
    Route::get('/feedback', [StudentFeedbackController::class, 'index'])->name('feedback.index');
    Route::post('/feedback', [StudentFeedbackController::class, 'store'])->name('feedback.store');

    // Profile & Settings
    Route::get('/profile/edit', fn() => view('profile-edit'))->name('profile.edit');
    Route::get('/settings', fn() => view('settings'))->name('settings');

    // Notifications
    Route::get('/notifications', fn() => view('notifications'))->name('notifications.index');
    Route::get('/notifications/{notification}', fn() => view('notification-detail'))->name('notifications.show');
});

// General Dashboard & Views
Route::get('/dashboard', fn() => view('dashboard'))->name('dashboard');
Route::get('/completed', fn() => view('completed-feedback'))->name('completed');
Route::get('/to-evaluate', fn() => view('to-evaluate'))->name('to-evaluate');

// Instructor & Feedback Routes
Route::get('/instructor/{id}', fn($id) => view('student.instructor-detail', ['id' => $id]))->name('instructor.show');
Route::get('/feedback/create/{instructor}', fn($instructor) => view('student.feedback-form', ['instructor' => $instructor]))->name('feedback.create');
Route::post('/feedback/store', fn() => redirect()->route('dashboard')->with('success', 'Feedback submitted successfully!'))->name('feedback.store');
