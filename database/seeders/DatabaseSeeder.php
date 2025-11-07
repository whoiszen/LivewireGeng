<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            PropertySeeder::class,
            RenterSeeder::class,
            TenantSettingSeeder::class,
            RoomSeeder::class,
            PaymentMethodSeeder::class,
            AddonSeeder::class,
            RentalTransactionSeeder::class,
            RentalAddonSeeder::class,
        ]);
        
    }
}
