<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class PlanHistoryFactory extends Factory
{
    public function definition(): array
    {
        return [
            'plan_id' => $this->faker->randomNumber(),
            'plan_name' => $this->faker->name(),
            'plan_price' => $this->faker->randomNumber(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'deleted_at' => Carbon::now(),
        ];
    }
}
