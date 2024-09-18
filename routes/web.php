<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Teacher\DashboardController;
use App\Http\Controllers\Teacher\CourseController as TeacherCourseController;
use App\Http\Controllers\Teacher\LessonController as TeacherLessonController;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\TrackController;
use App\Http\Controllers\FieldController;
use App\Http\Controllers\CourseController as StudentCourseController;
use App\Http\Controllers\LessonController as StudentLessonController;

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Landing page
Route::get('/', [HomeController::class, 'index'])->name('home');

// Student routes
Route::get('/tracks/{track}', [TrackController::class, 'show'])->name('tracks.show');
Route::get('/fields/{field}', [FieldController::class, 'show'])->name('fields.show');
Route::get('/courses/{course}', [StudentCourseController::class, 'show'])->name('courses.show');
Route::get('/lessons/{lesson}', [StudentLessonController::class, 'show'])->name('lessons.show');

// Dashboard route
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Authenticated routes
Route::middleware('auth')->group(function () {
    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Teacher routes (accessible only to users with 'teacher' role)
Route::middleware(['auth', 'teacher'])->group(function () {
    // Courses
    Route::resource('courses', TeacherCourseController::class);

    // Lessons
    Route::resource('lessons', TeacherLessonController::class);
});

// Admin routes (if applicable)
Route::middleware(['auth', 'admin'])->group(function () {
    // Admin routes here
});

// Authentication routes
require __DIR__ . '/auth.php';
