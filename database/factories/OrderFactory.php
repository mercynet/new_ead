<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class OrderFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => $this->faker->randomNumber(),
            'reference' => $this->faker->word(),
            'total' => $this->faker->randomNumber(),
            'discount' => $this->faker->randomNumber(),
            'paid' => $this->faker->randomNumber(),
            'commission' => $this->faker->randomNumber(),
            'status' => $this->faker->word(),
            'observations' => $this->faker->word(),
            'paid_at' => Carbon::now(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'coupon_id' => $this->faker->randomNumber(),
            'status_description' => $this->faker->text(),
        ];
    }
}
