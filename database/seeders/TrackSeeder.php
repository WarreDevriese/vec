<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Track;

class TrackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Track::create([
            'name' => 'Science',
            'description' => 'Science Track',
        ]);

        Track::create([
            'name' => 'Arts',
            'description' => 'Arts Track',
        ]);
    }
}
