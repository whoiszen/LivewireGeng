<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Renter;

class RoomFactory extends Factory
{
    public function definition(): array
    {
        return [
            'room_number' => 'R-' . $this->faker->unique()->numberBetween(100, 999),
            'capacity' => $this->faker->numberBetween(1, 6),
            'price' => $this->faker->randomFloat(2, 1500, 10000),
            'renter_id' => $this->faker->optional()->randomElement([null, Renter::factory()]),
        ];
    }
}
