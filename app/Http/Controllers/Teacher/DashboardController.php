<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Inertia\Inertia;
use App\Models\Course;

class DashboardController extends Controller
{
    /**
     * Display the teacher's dashboard.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        // Fetch courses created by the authenticated teacher, including related fields
        $courses = Course::where('user_id', auth()->id())
            ->with('field')
            ->get();

        return Inertia::render('Teacher/Dashboard', [
            'courses' => $courses,
        ]);
    }
}
