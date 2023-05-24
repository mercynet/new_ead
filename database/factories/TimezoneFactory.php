<?php

namespace Database\Factories;

use App\Models\Timezone;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class TimezoneFactory extends Factory
{
    protected $model = Timezone::class;

    public function definition(): array
    {
        return [
            'code' => fake()->word(),
            'name' => fake()->name(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'deleted_at' => Carbon::now(),
        ];
    }
}
