<?php

namespace App\Http\Controllers;

use App\Models\Field;
use Illuminate\Http\Request;
use Inertia\Inertia;

class FieldController extends Controller
{
    /**
     * Display the specified field along with its associated courses.
     *
     * @param  \App\Models\Field  $field
     * @return \Inertia\Response
     */
    public function show(Field $field)
    {
        // Load associated courses with necessary fields
        $field->load(['courses' => function ($query) {
            $query->select('id', 'name', 'description', 'field_id', 'status');
        }]);

        return Inertia::render('Fields/Show', [
            'field' => $field,
        ]);
    }
}
