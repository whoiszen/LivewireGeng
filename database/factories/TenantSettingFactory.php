<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Renter;

class TenantSettingFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => Renter::factory(),
            'allow_notifications' => $this->faker->boolean(80),
            'theme_preference' => $this->faker->randomElement(['light', 'dark']),
        ];
    }
}
