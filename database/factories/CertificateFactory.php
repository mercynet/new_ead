<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class CertificateFactory extends Factory
{
    public function definition(): array
    {
        return [
            'certificate_template_id' => $this->faker->randomNumber(),
            'user_id' => $this->faker->randomNumber(),
            'grade' => $this->faker->randomNumber(),
            'file' => $this->faker->word(),
            'model_type' => $this->faker->word(),
            'model_id' => $this->faker->randomNumber(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
