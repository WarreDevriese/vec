<?php

namespace App\Http\Controllers;

use App\Models\Track;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TrackController extends Controller
{
    /**
     * Display the specified track along with its associated fields.
     *
     * @param  \App\Models\Track  $track
     * @return \Inertia\Response
     */
    public function show(Track $track)
    {
        // Load associated fields with necessary fields
        $track->load(['fields' => function ($query) {
            $query->select('id', 'name', 'description', 'track_id');
        }]);

        return Inertia::render('Tracks/Show', [
            'track' => $track,
        ]);
    }
}
