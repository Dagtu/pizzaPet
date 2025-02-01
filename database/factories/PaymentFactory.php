<?php

namespace Database\Factories;

use App\Modules\Order\Infrastructure\Models\Order;
use App\Modules\Payment\Domain\Enums\PaymentStatuses;
use App\Modules\Payment\Domain\Enums\PaymentTypes;
use App\Modules\Payment\Infrastructure\Models\Payment;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class PaymentFactory extends Factory
{
    protected $model = Payment::class;

    public function definition(): array
    {
        return [
            'time' => Carbon::now(),
            'status' => $this->faker->randomElement([PaymentStatuses::Pending, PaymentStatuses::Success, PaymentStatuses::Failed]),
            'type' => $this->faker->randomElement([PaymentTypes::Cash, PaymentTypes::Card]),
            'order_id' => Order::factory(),
        ];
    }
}
