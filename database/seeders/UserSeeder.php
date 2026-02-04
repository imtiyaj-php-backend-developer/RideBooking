<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Admin (Single)
        User::create([
            'uid' => (string) Str::uuid(),
            'name' => 'Admin User',
            'role' => 'admin',
            'latitude' => null,
            'longitude' => null,
        ]);

        // Passengers (Multiple)
        User::factory()
            ->count(10)
            ->create([
                'role' => 'passenger',
            ]);

        // Drivers (Multiple)
        User::factory()
            ->count(10)
            ->create([
                'role' => 'driver',
            ]);
    }
}
