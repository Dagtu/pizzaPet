<?php

use App\Modules\Auth\Infrastructure\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')
    ->controller(AuthController::class)
    ->group(function () {
        Route::post('/login-client', 'loginClient')->name('login.client');
        Route::post('/login-admin', 'loginAdmin')->name('login.admin');
        Route::middleware('auth:sanctum')->delete('/logout', 'logout')->name('logout');
    });

