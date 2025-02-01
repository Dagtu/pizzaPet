<?php

namespace Database\Factories;

use App\Modules\Order\Domain\Enums\OrderStatuses;
use App\Modules\Order\Infrastructure\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition(): array
    {
        return [
            'time' => Carbon::now(),
            'clientId' => $this->faker->randomNumber(),
            'clientAddressId' => $this->faker->address(),
            'clientPhoneId' => $this->faker->phoneNumber(),
            'status' => $this->faker->randomElement([OrderStatuses::PendingPayment, OrderStatuses::Delivered]),
            'courierId' => $this->faker->randomNumber(),
            'comment' => $this->faker->word(),
            'totalPrice' => $this->faker->randomFloat(),
        ];
    }
}
