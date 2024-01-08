<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CurrencyFactory extends Factory
{
    public function definition(): array
    {
        return [
            'active' => fake()->boolean(),
            'symbol_first' => fake()->boolean(),
            'order' => fake()->randomDigitNotZero(),
            'name' => fake()->sentence(),
            'code' => fake()->randomKey(),
            'symbol' => fake()->currencyCode(),
            'precision' => 2,
            'thousands' => '.',
            'decimal' => ',',
        ];
    }
}
