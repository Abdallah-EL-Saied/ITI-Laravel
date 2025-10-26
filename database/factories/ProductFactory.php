<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    protected $model = \App\Models\Product::class;

    public function definition()
    {
        return [
            'category_id' => Category::inRandomOrder()->first()?->id,
            'name' => $this->faker->words(3, true),
            'description' => $this->faker->paragraphs(2, true),
            'price' => $this->faker->randomFloat(2, 10, 999.99),
            'stock_quantity' => $this->faker->numberBetween(0, 100),
            'is_active' => $this->faker->boolean(80),
            'image' => null,
        ];
    }
}
