<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class PlanFactory extends Factory
{
    public function definition(): array
    {
        return [
            'order' => $this->faker->randomNumber(),
            'name' => $this->faker->name(),
            'slug' => $this->faker->slug(),
            'color' => $this->faker->word(),
            'description' => $this->faker->text(),
            'price' => $this->faker->randomNumber(),
            'active' => $this->faker->boolean(),
            'is_test' => $this->faker->boolean(),
            'is_commissioned' => $this->faker->boolean(),
            'is_promotional' => $this->faker->boolean(),
            'is_showcase' => $this->faker->boolean(),
            'is_featured' => $this->faker->boolean(),
            'countdown_limit' => Carbon::now(),
            'published_at' => Carbon::now(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'deleted_at' => Carbon::now(),
        ];
    }
}
