<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PaymentMethodFactory extends Factory
{
    public function definition(): array
    {
        return [
            'method_name' => $this->faker->randomElement(['Cash', 'GCash', 'Bank Transfer']),
        ];
    }
}
