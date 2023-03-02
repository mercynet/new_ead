<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class QuizResultUserFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => $this->faker->randomNumber(),
            'quiz_id' => $this->faker->randomNumber(),
            'model_type' => $this->faker->word(),
            'model_id' => $this->faker->randomNumber(),
            'result' => $this->faker->randomNumber(),
            'time' => Carbon::now(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'deleted_at' => Carbon::now(),
        ];
    }
}
