<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Field;

class FieldSeeder extends Seeder
{
    public function run()
    {
        Field::create([
            'track_id' => 1, // Adjust based on your Track IDs
            'name' => 'Physics',
            'description' => 'Physics Field',
        ]);

        Field::create([
            'track_id' => 2,
            'name' => 'Painting',
            'description' => 'Painting Field',
        ]);

        // Add more fields as needed
    }
}
