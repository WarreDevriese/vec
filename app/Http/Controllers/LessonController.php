<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LessonController extends Controller
{
    public function show(\App\Models\Course $course)
    {
        $course->load('lessons');

        return \Inertia\Inertia::render('Courses/Show', [
            'course' => $course,
        ]);
    }
}
