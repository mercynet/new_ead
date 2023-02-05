<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\CourseModule;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<CourseModule>
 */
class CourseModuleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $name = fake()->words(5, true);
        return [
            'course_id' => Course::factory(),
            'name' => $name,
            'slug' => Str::slug($name),
        ];
    }
}
