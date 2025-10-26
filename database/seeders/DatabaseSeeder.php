<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $this->call(CategorySeeder::class);

        $categories = Category::all();

        Product::factory()->count(30)->make()->each(function ($product) use ($categories) {
            $product->category_id = $categories->random()->id;
            $product->save();
        });
    }
}
