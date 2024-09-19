<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Lesson;
use App\Models\Course;

class LessonController extends Controller
{
    /**
     * Display a listing of the teacher's lessons.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        // Fetch lessons associated with the teacher's courses, including related courses
        $lessons = Lesson::whereHas('course', function ($query) {
                $query->where('user_id', auth()->id());
            })
            ->with('course')
            ->get();

        return Inertia::render('Teacher/Lessons/Index', [
            'lessons' => $lessons,
        ]);
    }

    /**
     * Show the form for creating a new lesson.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        // Fetch courses owned by the authenticated teacher to associate with the lesson
        $courses = Course::where('user_id', auth()->id())->get();

        return Inertia::render('Teacher/Lessons/Create', [
            'courses' => $courses,
        ]);
    }

    /**
     * Store a newly created lesson in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validate incoming request data
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'text_content' => 'nullable|string',
            'video_url' => 'nullable|url',
            'course_id' => 'required|exists:courses,id',
        ]);

        // Ensure the teacher owns the course associated with the lesson
        $course = Course::where('id', $validated['course_id'])
            ->where('user_id', auth()->id())
            ->firstOrFail();

        // Create the lesson
        Lesson::create([
            'title' => $validated['title'],
            'text_content' => $validated['text_content'],
            'video_url' => $validated['video_url'],
            'course_id' => $validated['course_id'],
            'status' => 'pending', // Default status
        ]);

        // Redirect to the lessons index with a success message
        return redirect()->route('lessons.index')->with('success', 'Lesson created successfully.');
    }

    /**
     * Display the specified lesson.
     *
     * Note: This method is excluded from resource routes and may not be used.
     *
     * @param  int  $id
     * @return void
     */
    public function show($id)
    {
        // Typically handled by student routes; may not be needed here
    }

    /**
     * Show the form for editing the specified lesson.
     *
     * @param  \App\Models\Lesson  $lesson
     * @return \Inertia\Response
     */
    public function edit(Lesson $lesson)
    {
        // Ensure the authenticated teacher owns the lesson's course
        if ($lesson->course->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        // Fetch courses owned by the teacher to associate with the lesson
        $courses = Course::where('user_id', auth()->id())->get();

        return Inertia::render('Teacher/Lessons/Edit', [
            'lesson' => $lesson,
            'courses' => $courses,
        ]);
    }

    /**
     * Update the specified lesson in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Lesson  $lesson
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Lesson $lesson)
    {
        // Ensure the authenticated teacher owns the lesson's course
        if ($lesson->course->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        // Validate incoming request data
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'text_content' => 'nullable|string',
            'video_url' => 'nullable|url',
            'course_id' => 'required|exists:courses,id',
        ]);

        // Ensure the teacher owns the course associated with the lesson
        $course = Course::where('id', $validated['course_id'])
            ->where('user_id', auth()->id())
            ->firstOrFail();

        // Update the lesson with validated data
        $lesson->update([
            'title' => $validated['title'],
            'text_content' => $validated['text_content'],
            'video_url' => $validated['video_url'],
            'course_id' => $validated['course_id'],
        ]);

        // Redirect to the lessons index with a success message
        return redirect()->route('lessons.index')->with('success', 'Lesson updated successfully.');
    }

    /**
     * Remove the specified lesson from storage.
     *
     * @param  \App\Models\Lesson  $lesson
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Lesson $lesson)
    {
        // Ensure the authenticated teacher owns the lesson's course
        if ($lesson->course->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        // Delete the lesson
        $lesson->delete();

        // Redirect to the lessons index with a success message
        return redirect()->route('lessons.index')->with('success', 'Lesson deleted successfully.');
    }
}
