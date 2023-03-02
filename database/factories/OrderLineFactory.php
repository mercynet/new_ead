<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class OrderLineFactory extends Factory
{
    public function definition(): array
    {
        return [
            'model_type' => $this->faker->word(),
            'model_id' => $this->faker->randomNumber(),
            'model_name' => $this->faker->name(),
            'model_price' => $this->faker->randomNumber(),
            'model_discount' => $this->faker->randomNumber(),
            'model_quantity' => $this->faker->randomNumber(),
            'model_details' => $this->faker->words(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

            'order_id' => Order::factory(),
        ];
    }
}
