<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;

use App\Models\User;

Route::get('/', [AuthController::class, 'showLoginForm'])->name('login'); // ✅ Default page shows login
Route::post('/login', [AuthController::class, 'login']); // ✅ Handles login submission
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');


 //for student dashboard
 Route::get('/student-dashboard', [DashboardController::class, 'studentDashboard'])->middleware('auth')->name('student.dashboard');
