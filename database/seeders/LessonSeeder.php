<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lesson;

class LessonSeeder extends Seeder
{
    public function run()
    {
        Lesson::create([
            'course_id' => 1, // Adjust based on your Course IDs
            'title' => 'Introduction to Quantum Mechanics',
            'text_content' => '<p>This lesson covers the basics of quantum mechanics...</p>',
            'status' => 'approved',
        ]);

        // Add more lessons as needed
    }
}
