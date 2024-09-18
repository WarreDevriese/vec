<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Inertia\Inertia;
use App\Models\Course;

class DashboardController extends Controller
{
    public function index()
    {
        $courses = auth()->user()->courses()->with('field')->get();
        return Inertia::render('Teacher/Dashboard', [
            'courses' => $courses,
        ]);
    }
}
