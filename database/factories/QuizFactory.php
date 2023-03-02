<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class QuizFactory extends Factory
{
    public function definition(): array
    {
        return [
            'group_id' => $this->faker->randomNumber(),
            'category_id' => $this->faker->randomNumber(),
            'order' => $this->faker->randomNumber(),
            'question' => $this->faker->word(),
            'video' => $this->faker->word(),
            'exibition_type' => $this->faker->word(),
            'format_type' => $this->faker->word(),
            'question_type' => $this->faker->word(),
            'level' => $this->faker->word(),
            'is_free' => $this->faker->boolean(),
            'allow_remake' => $this->faker->boolean(),
            'active' => $this->faker->boolean(),
            'published_at' => Carbon::now(),
            'date_from' => Carbon::now(),
            'date_to' => Carbon::now(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
