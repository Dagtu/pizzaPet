<?php

namespace App\Modules\Auth\Application\Services;

use App\Modules\Auth\Application\Ports\TokenGeneratorInterface;
use App\Modules\Auth\Domain\Entities\AuthenticatableInterface;

class SanctumTokenGenerator implements TokenGeneratorInterface
{
    const DEFAULT_TOKEN_NAME = 'auth_token';

    public function generateToken(AuthenticatableInterface $user, array $abilities = []): string
    {
        return $user->createToken(self::DEFAULT_TOKEN_NAME, $abilities);
    }
}
