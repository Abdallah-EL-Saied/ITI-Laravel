<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create main user with password 123456789
        User::factory()->create([
            'name' => 'Abdallah Elsaied',
            'email' => 'abdallahalsabaa.pu.2021@gmail.com',
            'password' => Hash::make('123456789'), // hashed password
        ]);


        // Other random users
        User::factory(5)->create();

        // Seed categories and products
        $this->call([
            CategorySeeder::class,
            ProductSeeder::class,
        ]);
    }
}
