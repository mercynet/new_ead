<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class DiscountRuleFactory extends Factory
{
    public function definition(): array
    {
        return [
            'amount' => $this->faker->randomNumber(),
            'name' => $this->faker->name(),
            'active' => $this->faker->boolean(),
            'discount_type' => $this->faker->boolean(),
            'date_from' => Carbon::now(),
            'date_to' => Carbon::now(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
