<?php

namespace App\Modules\Auth\Domain\Entities;

interface AuthenticatableInterface
{
    public function createToken(string $name, array $abilities = []);
}
