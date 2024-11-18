<?php

namespace App\Modules\Auth\Infrastructure\Repositories;

use App\Modules\Auth\Application\Ports\AuthRepositoryInterface;
use App\Modules\Auth\Domain\Entities\AuthenticatableInterface;
use Illuminate\Support\Facades\Auth;
use App\Modules\Auth\Infrastructure\Adapters\LaravelUserAdapter;

class LaravelAuthenticationRepository implements AuthRepositoryInterface
{
    public function findByEmail(string $email, string $password, string $guard = null): ?AuthenticatableInterface
    {
        if (Auth::guard($guard)->attempt(['email' => $email, 'password' => $password])) {
            $laravelUser = Auth::guard($guard)->user();
            return new LaravelUserAdapter($laravelUser);
        }

        return null;
    }

    public function findByPhone(string $phone, string $password, string $guard = null): ?AuthenticatableInterface
    {
        if (Auth::guard($guard)->attempt(['phone' => $phone, 'password' => $password])) {
            $laravelUser = Auth::guard($guard)->user();
            return new LaravelUserAdapter($laravelUser);
        }

        return null;
    }
}
