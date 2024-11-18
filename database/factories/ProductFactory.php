<?php

namespace Database\Factories;

use App\Modules\Product\Domain\Enums\ProductTypes;
use App\Modules\Product\Infrastructure\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'type' => fake()->randomElement([ProductTypes::Dessert, ProductTypes::Drink, ProductTypes::Pizza]),
            'is_active' => fake()->boolean(),
            'price' => fake()->randomFloat(),
            'image_url' => fake()->imageUrl(),
            'description' => fake()->sentence()
        ];
    }
}
