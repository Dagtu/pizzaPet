<?php

namespace App\Providers;

use App\Modules\Auth\Application\Ports\AuthRepositoryInterface;
use App\Modules\Auth\Application\Ports\TokenGeneratorInterface;
use App\Modules\Auth\Application\Services\SanctumTokenGenerator;
use App\Modules\Auth\Infrastructure\Repositories\LaravelAuthenticationRepository;
use App\Modules\Product\Domain\Repositories\ProductRepositoryInterface;
use App\Modules\Product\Infrastructure\Repositories\ProductRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);
        $this->app->bind(AuthRepositoryInterface::class, LaravelAuthenticationRepository::class);
        $this->app->bind(TokenGeneratorInterface::class, SanctumTokenGenerator::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
