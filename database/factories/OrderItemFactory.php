<?php

namespace Database\Factories;

use App\Modules\Order\Infrastructure\Models\Order;
use App\Modules\Order\Infrastructure\Models\OrderItem;
use App\Modules\Product\Infrastructure\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderItemFactory extends Factory
{
    protected $model = OrderItem::class;

    public function definition(): array
    {
        return [
            'quantity' => $this->faker->randomNumber(),
            'price' => $this->faker->randomFloat(),
            'total_price' => $this->faker->randomFloat(),
            'product_id' => Product::factory(),
            'order_id' => Order::factory(),
        ];
    }
}
