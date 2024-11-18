<?php

namespace Database\Factories;

use App\Modules\Courier\Domain\Enums\CourierStatuses;
use App\Modules\Courier\Infrastructure\Models\Courier;
use Illuminate\Database\Eloquent\Factories\Factory;

class CourierFactory extends Factory
{
    protected $model = Courier::class;

    public function definition(): array
    {
        return [
            'phone' => $this->faker->phoneNumber(),
            'name' => $this->faker->name(),
            'last_name' => $this->faker->lastName(),
            'location_id' => $this->faker->randomNumber(),
            'is_active' => $this->faker->boolean(),
            'status' => CourierStatuses::Pending->value
        ];
    }
}
