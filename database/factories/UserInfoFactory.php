<?php

namespace Database\Factories;

use App\Models\Users\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class UserInfoFactory extends Factory
{
    public function definition(): array
    {
        return [
            'document' => $this->faker->word(),
            'identity_registry' => $this->faker->word(),
            'avatar' => $this->faker->word(),
            'birth_date' => Carbon::now(),
            'gender' => $this->faker->word(),
            'where_know_us' => $this->faker->word(),
            'source' => $this->faker->word(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),

            'user_id' => User::factory(),
        ];
    }
}
