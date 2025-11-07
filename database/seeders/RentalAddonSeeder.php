<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RentalAddon;
use App\Models\RentalTransaction;
use App\Models\Addon;

class RentalAddonSeeder extends Seeder
{
    public function run(): void
    {
        $rentalIds = RentalTransaction::pluck('id')->toArray();
        $addonIds = Addon::pluck('id')->toArray();

        foreach ($rentalIds as $rentalId) {
            $count = rand(1, 3);

            for ($i = 0; $i < $count; $i++) {
                $quantity = rand(1, 5);
                $addon = fake()->randomElement($addonIds);
                $price = rand(50, 300);

                RentalAddon::create([
                    'rental_transaction_id' => $rentalId,
                    'addon_id' => $addon,
                    'quantity' => $quantity,
                    'subtotal' => $quantity * $price,
                ]);
            }
        }
    }
}
