<?php

use App\Http\Controllers\CoachAuthController;   // ← přesný import
use App\Http\Controllers\CoachProfileController;   // pro update profilu
use App\Http\Controllers\CoachCourseController;
use App\Http\Controllers\CoachLessonController;

use App\Http\Controllers\StudentAuthController;
use App\Http\Controllers\StudentCourseController;
use App\Http\Controllers\StudentProfileController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'home');

/* ==================  COACH  ================== */
Route::prefix('coach')->name('coach.')->group(function () {

    // === Authentication (login/logout) ===
    Route::view('login', 'coach.auth.login')->name('login.show');
    Route::post('login', [CoachAuthController::class, 'login'])->name('login');
    Route::post('logout', [CoachAuthController::class, 'logout'])->name('logout');

    // === Ochranná zóna pro přihlášené kouče ===
    Route::middleware('auth:coach')->group(function () {
         // --- Dashboard (seznam kurzů, které kouč vyučuje) ---
        Route::get('dashboard', [CoachCourseController::class, 'index'])
            ->name('dashboard');

        // --- Create & Store ---
        Route::get('courses/create', [CoachCourseController::class, 'create'])
            ->name('courses.create');
        Route::post('courses', [CoachCourseController::class, 'store'])
            ->name('courses.store');

        // --- Manage / Detail kurzu ---
        Route::get('courses/{course}/manage', [CoachCourseController::class, 'manage'])
            ->name('courses.manage');

        // Open courses
        Route::get('open-courses', [CoachCourseController::class, 'openCourses'])
             ->name('open');

        // Detail lekce
         Route::get('lessons/{lesson}', [CoachLessonController::class, 'show'])
              ->name('lessons.show');

        // Edit course (zobrazení formuláře s hodnotami)
         Route::get('courses/{course}/edit', [CoachCourseController::class, 'edit'])
              ->name('courses.edit');

         // Update course (zpracování PUT/PATCH)
         Route::put('courses/{course}', [CoachCourseController::class, 'update'])
              ->name('courses.update');


        // Profile settings
        Route::get('profile', [CoachProfileController::class, 'show'])->name('profile');
        Route::put('profile', [CoachProfileController::class, 'update'])->name('profile.update');
    });
});


/* ==================  STUDENT  ================== */
Route::prefix('student')->name('student.')->group(function () {

    Route::middleware('guest:student')->group(function () {
        Route::view('login', 'student.auth.login')->name('login.show');
        Route::get('register', [StudentAuthController::class,'showRegister'])->name('register.show');
        Route::post('login',    [StudentAuthController::class,'login'])->name('login');
        Route::post('register', [StudentAuthController::class,'register'])->name('register');
    });

    Route::middleware('auth:student')->group(function () {
        Route::view('dashboard', 'student.dashboard')->name('dashboard');
        Route::post('logout', [StudentAuthController::class,'logout'])->name('logout');
        Route::get('dashboard', [StudentAuthController::class, 'dashboard'])
            ->name('dashboard');
        Route::get('open-courses', [StudentCourseController::class, 'index'])
            ->name('open');
        Route::post('courses/{course}/enroll', [StudentCourseController::class, 'enroll'])
            ->name('courses.enroll');
        Route::get('profile',  [StudentProfileController::class, 'show'])
            ->name('profile');
        Route::put('profile', [StudentProfileController::class, 'update'])
            ->name('profile.update');
    });
});
