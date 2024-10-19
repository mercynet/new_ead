<?php

namespace Database\Factories;

use App\Models\Addon;
use App\Models\Courses\Course;
use App\Models\Plan;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Price>
 */
class PriceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'priceable_id' => fake()->numberBetween(1, 100),
            'priceable_type' => fake()
                ->randomElement([
                    Course::class,
                    Plan::class,
                    Addon::class,
                ]),
            'price' => fake()->randomFloat(2, 0, 1000),
        ];
    }
}
