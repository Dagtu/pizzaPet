<?php

namespace App\Providers;

use App\Modules\Auth\Application\Ports\AuthRepositoryInterface;
use App\Modules\Auth\Application\Ports\TokenGeneratorInterface;
use App\Modules\Auth\Application\Services\SanctumTokenGenerator;
use App\Modules\Auth\Infrastructure\Repositories\LaravelAuthenticationRepository;
use App\Modules\Courier\Application\Repositories\CourierRepositoryInterface;
use App\Modules\Courier\Infrastructure\Repositories\CourierRepository;
use App\Modules\Order\Application\Repositories\OrderRepositoryInterface;
use App\Modules\Order\Infrastructure\Repositories\OrderRepository;
use App\Modules\Payment\Application\Contracts\BankGatewayInterface;
use App\Modules\Payment\Application\Repositories\PaymentRepositoryInterface;
use App\Modules\Payment\Infrastructure\Gateway\BankGateway;
use App\Modules\Payment\Infrastructure\Repositories\PaymentRepository;
use App\Modules\Product\Application\Repositories\ProductRepositoryInterface;
use App\Modules\Product\Infrastructure\Repositories\ProductRepository;
use App\Modules\User\Application\Repositories\ClientRepositoryInterface;
use App\Modules\User\Infrastructure\Repositories\ClientRepository;
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
        $this->app->bind(OrderRepositoryInterface::class, OrderRepository::class);
        $this->app->bind(PaymentRepositoryInterface::class, PaymentRepository::class);
        $this->app->bind(CourierRepositoryInterface::class, CourierRepository::class);
        $this->app->bind(BankGatewayInterface::class, BankGateway::class);
        $this->app->bind(ClientRepositoryInterface::class, ClientRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
