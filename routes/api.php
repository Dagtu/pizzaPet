<?php

use App\modules\product\Infrastructure\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(ProductController::class)
    ->group(function () {
        Route::get('/getAdminList', 'getAdminList');
        Route::get('/getUserList', 'getUserList');
        Route::patch('/updateProduct', 'updateProduct');
        Route::delete('/deleteProduct', 'deleteProduct');
        Route::post('/createProduct', 'createProduct');
    });
