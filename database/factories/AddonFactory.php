<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class AddonFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'price' => $this->faker->randomNumber(),
            'identifier' => $this->faker->word(),
            'purchase_code' => $this->faker->word(),
            'version' => $this->faker->word(),
            'description' => $this->faker->text(),
            'active' => $this->faker->boolean(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
