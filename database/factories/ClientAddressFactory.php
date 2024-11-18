<?php

namespace Database\Factories;

use App\Modules\User\Infrastructure\Models\Client;
use App\Modules\User\Infrastructure\Models\ClientAddress;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClientAddressFactory extends Factory
{
    protected $model = ClientAddress::class;

    public function definition(): array
    {
        return [
            'region' => $this->faker->city(),
            'city' => $this->faker->city(),
            'street' => $this->faker->streetName(),
            'house_number' => $this->faker->randomNumber(),
            'apartment' => $this->faker->randomNumber(),
            'client_id' => Client::factory(),
        ];
    }
}
