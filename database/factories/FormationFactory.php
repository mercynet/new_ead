<?php

namespace Database\Factories;

use App\Models\Courses\Formation;
use App\Models\Users\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Formation>
 */
class FormationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->sentence(5);
        return [
            'user_id' => User::inRandomOrder()->first(),
            'name' => $name,
            'slug' => Str::slug($name),
            'description' => fake()->paragraph(5),
            'price' => fake()->randomDigitNotZero(),
            'points' => fake()->randomNumber(),
            'access_months' => fake()->randomDigitNotZero(),
            'is_fifo' => fake()->boolean(),
            'active' => fake()->boolean(),
        ];
    }
}
