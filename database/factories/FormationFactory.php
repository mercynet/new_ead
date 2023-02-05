<?php

namespace Database\Factories;

use App\Models\Formation;
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
            'name' => $name,
            'slug' => Str::slug($name),
            'description' => fake()->paragraph(5),
            'is_fifo' => fake()->boolean(),
            'active' => fake()->boolean(),
        ];
    }
}
