<?php

namespace Database\Factories;

use App\Models\Users\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class OrderTransactionFactory extends Factory
{
    public function definition(): array
    {
        return [
            'order_id' => $this->faker->randomNumber(),
            'status' => $this->faker->word(),
            'comment' => $this->faker->word(),
            'user_notified' => $this->faker->boolean(),
            'admin_notified' => $this->faker->boolean(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'status_description' => $this->faker->text(),

            'user_id' => User::factory(),
        ];
    }
}
