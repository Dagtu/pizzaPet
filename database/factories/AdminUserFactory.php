<?php

namespace Database\Factories;

use App\Modules\Auth\Domain\Enums\Abilities;
use App\Modules\User\Infrastructure\Models\AdminUser;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

class AdminUserFactory extends Factory
{
    protected $model = AdminUser::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'email' => fake()->unique()->safeEmail(),
            'password' => Hash::make('password'),
            'role' => Abilities::Admin->value,
            'isActive' => fake()->boolean(),
        ];
    }
}
