<?php

use App\Modules\Order\Infrastructure\Http\Controllers\OrderAdminController;
use App\Modules\Order\Infrastructure\Http\Controllers\OrderClientController;
use Illuminate\Support\Facades\Route;

Route::prefix('order')
    ->controller(OrderClientController::class)
    ->middleware(['auth:sanctum'])
    ->group(function () {
        Route::post('/create-order', 'create')->name('order.client.create');
    });

Route::prefix('order')
    ->controller(OrderAdminController::class)
    ->middleware(['auth:sanctum', 'ability:admin'])
    ->group(function () {
        Route::post('/complete-order', 'completeOrder')->name('order.admin.complete');
    });
