<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class PlanServiceFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'model_type' => $this->faker->word(),
            'description' => $this->faker->text(),
            'type' => $this->faker->word(),
            'show_description' => $this->faker->text(),
            'show_count_left' => $this->faker->boolean(),
            'active' => $this->faker->boolean(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'deleted_at' => Carbon::now(),
        ];
    }
}
