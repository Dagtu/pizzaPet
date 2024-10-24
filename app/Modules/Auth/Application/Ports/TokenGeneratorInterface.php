<?php

namespace App\Modules\Auth\Application\Ports;

use App\Modules\Auth\Domain\Entities\AuthenticatableInterface;

interface TokenGeneratorInterface
{
    public function generateToken(AuthenticatableInterface $user, array $abilities = []): string;
}
