<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\RentalTransaction;
use App\Models\Addon;

class RentalAddonFactory extends Factory
{
    public function definition(): array
    {
        $quantity = $this->faker->numberBetween(1, 5);
        $price = $this->faker->randomFloat(2, 50, 500);
        return [
            'rental_transaction_id' => RentalTransaction::factory(),
            'addon_id' => Addon::factory(),
            'quantity' => $quantity,
            'subtotal' => $price * $quantity,
        ];
    }
}
