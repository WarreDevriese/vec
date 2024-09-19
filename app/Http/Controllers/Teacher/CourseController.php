<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Course;
use App\Models\Field;

class CourseController extends Controller
{
    /**
     * Display a listing of the teacher's courses.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        // Fetch courses created by the authenticated teacher, including related fields
        $courses = Course::where('user_id', auth()->id())
            ->with('field')
            ->get();

        return Inertia::render('Teacher/Courses/Index', [
            'courses' => $courses,
        ]);
    }

    /**
     * Show the form for creating a new course.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        // Fetch all fields to populate a dropdown in the course creation form
        $fields = Field::all();

        return Inertia::render('Teacher/Courses/Create', [
            'fields' => $fields,
        ]);
    }

    /**
     * Store a newly created course in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validate incoming request data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'field_id' => 'required|exists:fields,id',
        ]);

        // Create a new course associated with the authenticated teacher
        $course = Course::create([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'field_id' => $validated['field_id'],
            'user_id' => auth()->id(),
            'status' => 'pending', // Default status
        ]);

        // Redirect to the courses index with a success message
        return redirect()->route('courses.index')->with('success', 'Course created successfully.');
    }

    /**
     * Display the specified course.
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
     * Show the form for editing the specified course.
     *
     * @param  \App\Models\Course  $course
     * @return \Inertia\Response
     */
    public function edit(Course $course)
    {
        // Ensure the authenticated teacher owns the course
        if ($course->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        // Fetch all fields to populate a dropdown in the course editing form
        $fields = Field::all();

        return Inertia::render('Teacher/Courses/Edit', [
            'course' => $course,
            'fields' => $fields,
        ]);
    }

    /**
     * Update the specified course in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Course $course)
    {
        // Ensure the authenticated teacher owns the course
        if ($course->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        // Validate incoming request data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'field_id' => 'required|exists:fields,id',
        ]);

        // Update the course with validated data
        $course->update($validated);

        // Redirect to the courses index with a success message
        return redirect()->route('courses.index')->with('success', 'Course updated successfully.');
    }

    /**
     * Remove the specified course from storage.
     *
     * @param  \App\Models\Course  $course
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Course $course)
    {
        // Ensure the authenticated teacher owns the course
        if ($course->user_id !== auth()->id()) {
            abort(403, 'Unauthorized action.');
        }

        // Delete the course
        $course->delete();

        // Redirect to the courses index with a success message
        return redirect()->route('courses.index')->with('success', 'Course deleted successfully.');
    }
}
