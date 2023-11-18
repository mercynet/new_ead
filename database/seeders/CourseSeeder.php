<?php

namespace Database\Seeders;

use App\Models\Courses\Course;
use App\Models\Courses\Formation;
use Illuminate\Database\Seeder;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Course::factory()->count(10)
            ->has(Formation::factory())
            ->create();
    }
}
