<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Track;

class HomeController extends Controller
{
    public function index()
    {
        $tracks = Track::with('fields')->get();

        return Inertia::render('Home', [
            'tracks' => $tracks,
        ]);
    }
}
