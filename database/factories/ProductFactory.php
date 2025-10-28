<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        $category = Category::inRandomOrder()->first();
        $user_id = $category?->user_id ?? User::inRandomOrder()->first()?->id;

        return [
            'category_id' => $category?->id,
            'user_id' => $user_id,
            'name' => $this->faker->words(3, true),
            'description' => $this->faker->paragraph(),
            'price' => $this->faker->randomFloat(2, 10, 999.99),
            'stock_quantity' => $this->faker->numberBetween(0, 100),
            'is_active' => $this->faker->boolean(80),
            'image' => null,
        ];
    }
}
