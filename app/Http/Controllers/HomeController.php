<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Track;

class HomeController extends Controller
{
    public function index()
    {
        $tracks = Track::all();
        return Inertia::render('Home', [
            'tracks' => $tracks,
        ]);
    }
}
