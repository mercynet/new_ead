<?php

namespace Database\Seeders;

use App\Models\Course;
use App\Models\Formation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
