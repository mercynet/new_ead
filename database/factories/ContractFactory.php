<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class ContractFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => $this->faker->randomNumber(),
            'model_type' => $this->faker->word(),
            'model_id' => $this->faker->randomNumber(),
            'price' => $this->faker->randomNumber(),
            'renovation_tries' => $this->faker->randomNumber(),
            'notify_period' => $this->faker->randomNumber(),
            'notify_period_type' => $this->faker->word(),
            'is_recurring' => $this->faker->boolean(),
            'active' => $this->faker->boolean(),
            'limit_date' => Carbon::now(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'deleted_at' => Carbon::now(),
        ];
    }
}
