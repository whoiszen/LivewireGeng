<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TenantSetting;
use App\Models\User;

class TenantSettingSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();

        foreach ($users as $user) {
            TenantSetting::factory()->create([
                'user_id' => $user->id,
            ]);
        }
    }
}
