<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Inertia\Inertia;
use App\Models\Course;

class DashboardController extends Controller
{
    public function index()
    {
        // Fetch courses created by the authenticated teacher
        $courses = Course::where('user_id', auth()->id())->with('field')->get();

        return Inertia::render('Teacher/Dashboard', [
            'courses' => $courses,
        ]);
    }
}
