<?php

namespace Database\Seeders;

use App\Models\Courses\CourseModule;
use Illuminate\Database\Seeder;

class CourseModuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CourseModule::factory()->count(5)->create();
    }
}
