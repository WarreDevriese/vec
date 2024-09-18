<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FieldController extends Controller
{
    public function show(\App\Models\Field $field)
    {
        $field->load('courses');

        return \Inertia\Inertia::render('Fields/Show', [
            'field' => $field,
        ]);
    }
}
