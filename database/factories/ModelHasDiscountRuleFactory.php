<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class ModelHasDiscountRuleFactory extends Factory
{
    public function definition(): array
    {
        return [
            'discount_rule_id' => $this->faker->randomNumber(),
            'model_type' => $this->faker->word(),
            'model_id' => $this->faker->randomNumber(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
