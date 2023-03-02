<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class CourseHistoryFactory extends Factory
{
    public function definition(): array
    {
        return [
            'course_id' => $this->faker->randomNumber(),
            'course_name' => $this->faker->name(),
            'course_price' => $this->faker->randomNumber(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'deleted_at' => Carbon::now(),
        ];
    }
}
