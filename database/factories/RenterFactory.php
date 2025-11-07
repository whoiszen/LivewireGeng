<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class RenterFactory extends Factory
{
    public function definition(): array
    {
        return [
            'firstname' => $this->faker->firstName(),
            'lastname' => $this->faker->lastName(),
            'email' => $this->faker->unique()->safeEmail(),
            'contact' => $this->faker->phoneNumber(),
        ];
    }
}
