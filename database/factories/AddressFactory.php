<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class AddressFactory extends Factory
{
    public function definition(): array
    {
        return [
            'zip_code' => $this->faker->postcode(),
            'address' => $this->faker->address(),
            'number' => $this->faker->word(),
            'complement' => $this->faker->word(),
            'district' => $this->faker->word(),
            'city' => $this->faker->city(),
            'state' => $this->faker->word(),
            'country' => $this->faker->country(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'user_id' => User::factory(),
        ];
    }
}
