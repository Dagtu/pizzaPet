<?php

namespace App\Modules\Auth\Infrastructure\Adapters;

use App\Modules\Auth\Application\Exceptions\NotSupportedException;
use App\Modules\Auth\Domain\Entities\AuthenticatableInterface;
use Illuminate\Contracts\Auth\Authenticatable as LaravelAuthenticatable;

class LaravelUserAdapter implements AuthenticatableInterface
{
    private LaravelAuthenticatable $laravelUser;

    public function __construct(LaravelAuthenticatable $laravelUser)
    {
        $this->laravelUser = $laravelUser;
    }

    /**
     * @throws NotSupportedException
     */
    public function createToken(string $name, array $abilities = []): string
    {
        if (method_exists($this->laravelUser, 'createToken')) {
            return $this->laravelUser->createToken($name, $abilities)->plainTextToken;
        }

        throw new NotSupportedException('User model does not support token creation', 500);
    }
}
