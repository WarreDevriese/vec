<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LessonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lessons = Lesson::whereHas('course', function ($query) {
            $query->where('user_id', auth()->id());
        })->with('course')->get();

        return Inertia::render('Teacher/Lessons/Index', [
            'lessons' => $lessons,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Fetch courses owned by the teacher
        $courses = Course::where('user_id', auth()->id())->get();

        return Inertia::render('Teacher/Lessons/Create', [
            'courses' => $courses,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'text_content' => 'nullable|string',
            'video_url' => 'nullable|url',
            'course_id' => 'required|exists:courses,id',
        ]);

        // Ensure the teacher owns the course
        $course = Course::where('id', $validated['course_id'])->where('user_id', auth()->id())->firstOrFail();

        Lesson::create($validated);

        return redirect()->route('lessons.index')->with('success', 'Lesson created successfully.');
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
    public function edit(Lesson $lesson)
    {
        // Ensure the teacher owns the lesson's course
        if ($lesson->course->user_id !== auth()->id()) {
            abort(403);
        }

        $courses = Course::where('user_id', auth()->id())->get();

        return Inertia::render('Teacher/Lessons/Edit', [
            'lesson' => $lesson,
            'courses' => $courses,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Lesson $lesson)
    {
        // Ensure the teacher owns the lesson's course
        if ($lesson->course->user_id !== auth()->id()) {
            abort(403);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'text_content' => 'nullable|string',
            'video_url' => 'nullable|url',
            'course_id' => 'required|exists:courses,id',
        ]);

        $lesson->update($validated);

        return redirect()->route('lessons.index')->with('success', 'Lesson updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lesson $lesson)
    {
        // Ensure the teacher owns the lesson's course
        if ($lesson->course->user_id !== auth()->id()) {
            abort(403);
        }

        $lesson->delete();

        return redirect()->route('lessons.index')->with('success', 'Lesson deleted successfully.');
    }
}
