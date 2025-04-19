<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\EvaluationController;
use App\Models\User;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application.
|
*/

// 1) Landing Page
Route::get('/', [LandingController::class, 'index'])
     ->name('landing');

/*
|-------------------------------------
| Teacher Evaluation Routes
|-------------------------------------
|
| These routes handle displaying and
| storing evaluations for a given teacher.
| We bind the {teacher} parameter to a
| User model, ensuring it's a real user.
|
*/

// 2) Show the evaluation form
Route::get('/teacher/{teacher}/evaluate', [EvaluationController::class, 'create'])
     // Using implicit model binding: {teacher} → App\Models\User
     ->name('evaluation.create');

// 3) Process the submitted form
Route::post('/teacher/{teacher}/evaluate', [EvaluationController::class, 'store'])
     ->name('evaluation.store');
