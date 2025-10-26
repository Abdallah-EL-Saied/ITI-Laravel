<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Electronics', 'description' => 'Electronic gadgets and devices'],
            ['name' => 'Clothing', 'description' => 'Men and women clothing'],
            ['name' => 'Books', 'description' => 'Books and literature'],
            ['name' => 'Home & Garden', 'description' => 'Furniture and home products'],
            ['name' => 'Sports', 'description' => 'Sporting goods and equipment'],
            ['name' => 'Toys', 'description' => 'Toys for kids'],
        ];

        foreach ($categories as $cat) {
            Category::create($cat);
        }
    }
}
