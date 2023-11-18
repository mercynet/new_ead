<?php

namespace Database\Factories;

use App\Models\Courses\Course;
use App\Models\Courses\CourseModule;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Courses\Lesson>
 */
class LessonFactory extends Factory
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
            'course_id' => Course::factory(),
            'course_module_id' => CourseModule::factory(),
            'name' => $name,
            'slug' => Str::slug($name),
            'summary' => fake()->words(5, true),
            'description' => fake()->paragraphs(2, true),
            'is_free' => fake()->boolean(10),
            'is_commentable' => fake()->boolean(),
            'video_type' => fake()->words(3, true),
            'video_path' => fake()->url(),
            'video_duration' => fake()->time('i'),
            'video_downloadable' => fake()->boolean(10),
            'active' => fake()->boolean(),
            'order' => fake()->randomDigitNotNull(),
            'image_featured' => fake()->image(),
            'meta_description' => fake()->sentence(),
            'meta_keywords' => fake()->sentence(),
            'started_at' => fake()->dateTime(),
            'ended_at' => now()->addYear(),
        ];
    }
}
