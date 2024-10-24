<?php

namespace App\Modules\Auth\Application\Ports;

use App\Modules\Auth\Domain\Entities\AuthenticatableInterface;

interface AuthRepositoryInterface
{
    public function findByEmail(string $email, string $password, string $guard): ?AuthenticatableInterface;

    public function findByPhone(string $phone, string $password, string $guard): ?AuthenticatableInterface;
}
