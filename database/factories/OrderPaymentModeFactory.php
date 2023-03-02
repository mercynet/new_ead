<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class OrderPaymentModeFactory extends Factory
{
    public function definition(): array
    {
        return [
            'amount' => $this->faker->randomNumber(),
            'discount' => $this->faker->randomNumber(),
            'price' => $this->faker->randomNumber(),
            'product_discount' => $this->faker->randomNumber(),
            'product_price' => $this->faker->randomNumber(),
            'total' => $this->faker->randomNumber(),
        ];
    }
}
