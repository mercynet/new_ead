<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class FormationHistoryFactory extends Factory
{
    public function definition(): array
    {
        return [
            'formation_id' => $this->faker->randomNumber(),
            'formation_name' => $this->faker->name(),
            'formation_price' => $this->faker->randomNumber(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'deleted_at' => Carbon::now(),
        ];
    }
}
