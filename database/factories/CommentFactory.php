<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\Courses\Lesson;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Comment>
 */
class CommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'comment_id' => Comment::inRandomOrder()->first()->id ?? null,
            'comment' => fake()->paragraphs(3, true),
            'activated_at' => now()->addDays(fake()->randomDigitNotNull()),
            'commentable_id' => Lesson::inRandomOrder()->first()->id,
            'commentable_type' => Lesson::class
        ];
    }
}
