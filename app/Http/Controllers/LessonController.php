<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LessonController extends Controller
{
    public function show(\App\Models\Lesson $lesson)
    {
        return \Inertia\Inertia::render('Lessons/Show', [
            'lesson' => $lesson,
        ]);
    }
}
