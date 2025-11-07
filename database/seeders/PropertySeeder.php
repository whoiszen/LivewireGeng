<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Property;
use App\Models\User;

class PropertySeeder extends Seeder
{
    public function run(): void
    {
        $userIds = User::pluck('id')->toArray();

        Property::factory(10)->create([
            'user_id' => fake()->randomElement($userIds),
        ]);
    }
}
