<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class PlanCycleFactory extends Factory
{
    public function definition(): array
    {
        return [
            'plan_id' => $this->faker->randomNumber(),
            'period_access' => $this->faker->randomNumber(),
            'period_type' => $this->faker->word(),
            'is_recurring' => $this->faker->boolean(),
            'discount' => $this->faker->randomNumber(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'deleted_at' => Carbon::now(),
        ];
    }
}
