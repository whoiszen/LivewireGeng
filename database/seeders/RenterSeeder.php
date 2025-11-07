<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Renter;

class RenterSeeder extends Seeder
{
    public function run(): void
    {
        Renter::factory(10)->create();
    }
}
