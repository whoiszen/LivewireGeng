<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PaymentMethod;

class PaymentMethodSeeder extends Seeder
{
    public function run(): void
    {
        $methods = ['Cash', 'GCash', 'Bank Transfer'];

        foreach ($methods as $method) {
            PaymentMethod::create(['method_name' => $method]);
        }
    }
}

