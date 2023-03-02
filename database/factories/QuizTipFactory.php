<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class QuizTipFactory extends Factory
{
    public function definition(): array
    {
        return [
            'quiz_id' => $this->faker->randomNumber(),
            'name' => $this->faker->name(),
            'active' => $this->faker->boolean(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'deleted_at' => Carbon::now(),
        ];
    }
}
