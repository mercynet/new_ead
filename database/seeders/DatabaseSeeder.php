<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(FormationSeeder::class);
        $this->call(CourseSeeder::class);
        $this->call(CourseModuleSeeder::class);
        $this->call(LessonSeeder::class);
        $this->call(BannerSeeder::class);
        $this->call(CommentSeeder::class);
        $this->call(PermissionsSeeder::class);
    }
}
