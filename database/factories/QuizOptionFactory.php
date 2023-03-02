<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class QuizOptionFactory extends Factory
{
    public function definition(): array
    {
        return [
            'quiz_id' => $this->faker->randomNumber(),
            'option' => $this->faker->word(),
            'value' => $this->faker->randomNumber(),
            'is_correct' => $this->faker->boolean(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'deleted_at' => Carbon::now(),
        ];
    }
}
