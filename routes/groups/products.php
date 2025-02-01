<?php

use App\Modules\Product\Infrastructure\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'product',
    'as' => 'product.',
    'controller' => ProductController::class,
], function () {
    Route::get('/get-list', 'getList')->name('list.client');
    Route::get('/get-product/{id}', 'getProduct')->name('get.by.id');

    Route::group([
        'middleware' => ['auth:sanctum', 'ability:admin'],
    ], function () {
        Route::get('/get-list-admin', 'getAdminList')->name('list.admin');
        Route::post('/create-product', 'createProduct')->name('create');
        Route::put('/update-product', 'updateProduct')->name('update.put');
        Route::delete('/delete-product', 'deleteProduct')->name('delete');
    });
});
