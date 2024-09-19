<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use Illuminate\Http\Request;
use Inertia\Inertia;

class LessonController extends Controller
{
    /**
     * Display the specified lesson.
     *
     * @param  \App\Models\Lesson  $lesson
     * @return \Inertia\Response
     */
    public function show(Lesson $lesson)
    {
        // Load associated course with necessary fields
        $lesson->load(['course' => function ($query) {
            $query->select('id', 'name');
        }]);

        return Inertia::render('Lessons/Show', [
            'lesson' => $lesson,
        ]);
    }
}
