<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TrackController extends Controller
{
    public function show(\App\Models\Track $track)
    {
        $track->load('fields');

        return \Inertia\Inertia::render('Tracks/Show', [
            'track' => $track,
        ]);
    }
}
