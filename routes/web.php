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
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// ------------------------------
// Landing Page
// ------------------------------
Route::get('/', [HomeController::class, 'index'])->name('home');

// ------------------------------
// Admin Routes (Manage Tracks and Fields)
// ------------------------------
Route::middleware(['auth', 'admin'])->group(function () {
    // Tracks Management Routes
    Route::resource('tracks', TrackController::class)->except(['show']);

    // Fields Management Routes
    Route::resource('fields', FieldController::class)->except(['show']);
});

// ------------------------------
// Teacher Routes (Manage Courses and Lessons)
// ------------------------------
Route::middleware(['auth', 'teacher'])->group(function () {
    // Courses Management Routes
    Route::resource('courses', TeacherCourseController::class)->except(['show']);

    // Lessons Management Routes
    Route::resource('lessons', TeacherLessonController::class)->except(['show']);
});

// ------------------------------
// Dashboard Route
// ------------------------------
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// ------------------------------
// Authenticated Routes (Profile Management)
// ------------------------------
Route::middleware('auth')->group(function () {
    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ------------------------------
// Student Routes (Publicly Accessible)
// ------------------------------
Route::get('/tracks/{track}', [TrackController::class, 'show'])->name('tracks.show');
Route::get('/fields/{field}', [FieldController::class, 'show'])->name('fields.show');
Route::get('/courses/{course}', [StudentCourseController::class, 'show'])->name('courses.show');
Route::get('/lessons/{lesson}', [StudentLessonController::class, 'show'])->name('lessons.show');

// ------------------------------
// Authentication Routes
// ------------------------------
require __DIR__ . '/auth.php';
