<?php

namespace App\Http\Controllers;

use App\Models\Track;
use Illuminate\Http\Request;
use Inertia\Inertia;

class HomeController extends Controller
{
    /**
     * Display the home page with a list of available tracks.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        // Fetch all tracks with necessary fields
        $tracks = Track::select('id', 'name', 'description')->get();

        return Inertia::render('Home', [
            'tracks' => $tracks,
        ]);
    }
}
