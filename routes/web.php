<?php

use App\Http\Controllers\CoachAuthController;   // ← přesný import
use App\Http\Controllers\StudentAuthController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'home');

/* ==================  COACH  ================== */
Route::prefix('coach')->name('coach.')->group(function () {

    Route::middleware('guest:coach')->group(function () {
        Route::get('login',    [CoachAuthController::class,'showLogin'])->name('login.show');
        Route::get('register', [CoachAuthController::class,'showRegister'])->name('register.show');
        Route::post('login',    [CoachAuthController::class,'login'])->name('login');
        Route::post('register', [CoachAuthController::class,'register'])->name('register');
    });

    Route::middleware('auth:coach')->group(function () {
        Route::view('dashboard', 'coach.dashboard')->name('dashboard');
        Route::post('logout', [CoachAuthController::class,'logout'])->name('logout');
    });
});

/* ==================  STUDENT  ================== */
Route::prefix('student')->name('student.')->group(function () {

    Route::middleware('guest:student')->group(function () {
        Route::get('login',    [StudentAuthController::class,'showLogin'])->name('login.show');
        Route::get('register', [StudentAuthController::class,'showRegister'])->name('register.show');
        Route::post('login',    [StudentAuthController::class,'login'])->name('login');
        Route::post('register', [StudentAuthController::class,'register'])->name('register');
    });

    Route::middleware('auth:student')->group(function () {
        Route::view('dashboard', 'student.dashboard')->name('dashboard');
        Route::post('logout', [StudentAuthController::class,'logout'])->name('logout');
    });
});
