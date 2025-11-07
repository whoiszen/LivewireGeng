<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\Renter;
use App\Models\Room;
use App\Models\PaymentMethod;

class RentalTransactionFactory extends Factory
{
    public function definition(): array
    {
        $start = $this->faker->dateTimeBetween('-1 month', 'now');
        $end = (clone $start)->modify('+' . rand(5, 30) . ' days');

        return [
            'user_id' => User::factory(),
            'renter_id' => Renter::factory(),
            'room_id' => Room::factory(),
            'paymethod_id' => PaymentMethod::factory(),
            'start_date' => $start,
            'end_date' => $end,
            'total_amount' => $this->faker->randomFloat(2, 2000, 50000),
            'status' => $this->faker->randomElement(['active', 'completed', 'overdue']),
        ];
    }
}
