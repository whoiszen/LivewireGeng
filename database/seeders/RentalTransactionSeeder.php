<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RentalTransaction;
use App\Models\User;
use App\Models\Renter;
use App\Models\Room;
use App\Models\PaymentMethod;

class RentalTransactionSeeder extends Seeder
{
    public function run(): void
    {
        $userIds = User::pluck('id')->toArray();
        $renterIds = Renter::pluck('id')->toArray();
        $roomIds = Room::pluck('id')->toArray();
        $paymentIds = PaymentMethod::pluck('id')->toArray();

        foreach (range(1, 10) as $i) {
            RentalTransaction::factory()->create([
                'user_id' => fake()->randomElement($userIds),
                'renter_id' => fake()->randomElement($renterIds),
                'room_id' => fake()->randomElement($roomIds),
                'paymethod_id' => fake()->randomElement($paymentIds),
            ]);
        }
    }
}
