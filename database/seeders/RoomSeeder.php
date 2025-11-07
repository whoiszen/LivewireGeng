<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Room;
use App\Models\Renter;

class RoomSeeder extends Seeder
{
    public function run(): void
    {
        $renterIds = Renter::pluck('id')->toArray();

        Room::factory(15)->create([
            'renter_id' => fake()->optional()->randomElement($renterIds),
        ]);
    }
}
