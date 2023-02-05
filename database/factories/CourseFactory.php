<?php

namespace Database\Factories;

use App\Enums\CourseLevel;
use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Course>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function definition()
    {
        $name = fake()->words(3, true);
        return [
            'order' => fake()->randomDigitNotNull(),
            'level' => fake()->randomElement(CourseLevel::toArray()),
            'name' => $name,
            'slug' => Str::slug($name),
            'summary' => fake()->words(15, true),
            'description' => fake()->paragraphs(3, true),
            'pre_requisites' => fake()->paragraphs(3, true),
            'target' => fake()->words(5, true),
            'image_featured' => fake()->image(),
            'image_cover' => fake()->image(),
            'is_fifo' => fake()->boolean(),
            'active' => fake()->boolean(),
            'meta_description' => $name,
            'meta_keywords' => fake()->words(5, true),
            'started_at' => now(),
            'ended_at' => now()->addYear(),
        ];
    }
}
