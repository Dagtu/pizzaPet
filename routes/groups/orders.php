<?php

use App\Modules\Order\Infrastructure\Http\Controllers\OrderAdminController;
use App\Modules\Order\Infrastructure\Http\Controllers\OrderClientController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'order',
    'as' => 'order.client.',
    'middleware' => ['auth:sanctum'],
    'controller' => OrderClientController::class,
], function () {
    Route::post('/create-order', 'create')->name('create');
});

Route::group([
    'prefix' => 'order',
    'as' => 'order.admin.',
    'middleware' => ['auth:sanctum', 'ability:admin'],
    'controller' => OrderAdminController::class,
], function () {
    Route::post('/complete-order', 'completeOrder')->name('complete');
});
