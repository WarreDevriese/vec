<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course;

class CourseSeeder extends Seeder
{
    public function run()
    {
        Course::create([
            'field_id' => 1, // Adjust based on your Field IDs
            'user_id' => 1,   // Adjust based on your User IDs
            'name' => 'Quantum Mechanics',
            'description' => 'An introduction to quantum mechanics.',
            'status' => 'approved',
        ]);

        // Add more courses as needed
    }
}
