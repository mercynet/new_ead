<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Coupon>
 */
class CouponFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'discount_type' => fake()->randomElement(),
            'total' => fake()->randomFloat(2),
            'count_utilization' => fake()->randomDigitNotZero(),
            'count_user' => fake()->randomDigitNotZero(),
            'name' => fake()->word(),
            'code' => fake()->randomKey(),
            'active' => fake()->boolean(),
            'date_from' => fake()->dateTime(),
            'date_to' => fake()->dateTime(),
        ];
    }
}
