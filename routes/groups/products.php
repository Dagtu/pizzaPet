<?php

use App\Modules\Product\Infrastructure\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::prefix('product')
    ->controller(ProductController::class)
    ->group(function () {
        Route::get('/get-list', 'getList')->name('product.list.client');
        Route::get('/get-product/{id}', 'getProduct')->name('product.get.by.id');
    });

Route::prefix('product')
    ->controller(ProductController::class)
    ->middleware(['auth:sanctum', 'ability:admin'])
    ->group(function () {
        Route::get('/get-list-admin', 'getAdminList')->name('product.list.admin');
        Route::post('/create-product', 'createProduct')->name('product.create');
        Route::put('/update-product', 'updateProduct')->name('product.update.put');
        Route::delete('/delete-product', 'deleteProduct')->name('product.delete');
    });
