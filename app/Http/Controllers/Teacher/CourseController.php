<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courses = Course::where('user_id', auth()->id())->with('field')->get();

        return Inertia::render('Teacher/Courses/Index', [
            'courses' => $courses,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Fetch fields to populate a dropdown
        $fields = Field::all();

        return Inertia::render('Teacher/Courses/Create', [
            'fields' => $fields,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'field_id' => 'required|exists:fields,id',
        ]);

        $course = Course::create([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'field_id' => $validated['field_id'],
            'user_id' => auth()->id(),
            'status' => 'pending',
        ]);

        return redirect()->route('courses.index')->with('success', 'Course created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Course $course)
    {
        // Ensure the teacher owns the course
        if ($course->user_id !== auth()->id()) {
            abort(403);
        }

        $fields = Field::all();

        return Inertia::render('Teacher/Courses/Edit', [
            'course' => $course,
            'fields' => $fields,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Course $course)
    {
        // Ensure the teacher owns the course
        if ($course->user_id !== auth()->id()) {
            abort(403);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'field_id' => 'required|exists:fields,id',
        ]);

        $course->update($validated);

        return redirect()->route('courses.index')->with('success', 'Course updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Course $course)
    {
        // Ensure the teacher owns the course
        if ($course->user_id !== auth()->id()) {
            abort(403);
        }

        $course->delete();

        return redirect()->route('courses.index')->with('success', 'Course deleted successfully.');
    }
}
