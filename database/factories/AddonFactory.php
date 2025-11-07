<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class AddonFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory(), // Creates a user if none exists
            'name' => ucfirst($this->faker->word()),
            'price' => $this->faker->randomFloat(2, 50, 5000),
            'description' => $this->faker->sentence(6),
            'status' => $this->faker->randomElement(['active', 'inactive']),
            'created_at' => $this->faker->date(),
        ];
    }
}
