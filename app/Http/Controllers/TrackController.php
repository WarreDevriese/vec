<?php

namespace App\Http\Controllers;

use App\Models\Track;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TrackController extends Controller
{
    // Show the form to create a new track
    public function create()
    {
        return Inertia::render('Tracks/Create');
    }

    // Store the new track in the database
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        Track::create($validated);

        return redirect()->route('home')->with('success', 'Track created successfully.');
    }
}
