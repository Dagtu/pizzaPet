<?php

namespace Database\Factories;

use App\Modules\Cart\Infrastructure\Models\Cart;
use App\Modules\Product\Infrastructure\Models\Product;
use App\Modules\User\Infrastructure\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

class CartFactory extends Factory
{
    protected $model = Cart::class;

    public function definition(): array
    {
        return [
            'client_id' => Client::factory(),
            'product_id' => Product::factory(),
            'quantity' => $this->faker->randomNumber(),
        ];
    }
}
