<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 🔹 Create Admin user
        User::updateOrCreate(
            ['email' => 'abdallahalsabaa.pu.2021@gmail.com'],
            [
                'name' => 'Abdallah Elsaied',
                'password' => Hash::make('123456789'),
                'role' => 'admin',
                'email_verified_at' => now(),
            ]
        );

        // 🔹 Create Manager user
        User::updateOrCreate(
            ['email' => 'elsaiedalsabaa.a@gmail.com'],
            [
                'name' => 'Elsaied',
                'password' => Hash::make('123456789'),
                'role' => 'manager',
                'email_verified_at' => now(),
            ]
        );

        // 🔹 Create random clients
        User::factory(5)->create([
            'role' => 'client',
        ]);

        // 🔹 Seed categories and products
        $this->call([
            CategorySeeder::class,
            ProductSeeder::class,
        ]);
    }
}
