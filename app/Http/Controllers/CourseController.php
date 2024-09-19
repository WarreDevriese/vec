<?php

namespace App\Http\Controllers;

use App\Models\Course;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CourseController extends Controller
{
    /**
     * Display the specified course along with its associated lessons.
     *
     * @param  \App\Models\Course  $course
     * @return \Inertia\Response
     */
    public function show(Course $course)
    {
        // Load associated lessons and field with necessary fields
        $course->load([
            'lessons' => function ($query) {
                $query->select('id', 'title', 'text_content', 'video_url', 'course_id', 'status');
            },
            'field' => function ($query) {
                $query->select('id', 'name');
            }
        ]);

        return Inertia::render('Courses/Show', [
            'course' => $course,
        ]);
    }
}
