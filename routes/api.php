<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Type_personController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\Orders_productsController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\Category_productController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('type_persons')->group(function () {
    Route::get('/', [Type_personController::class, 'getAll']);
    Route::get('/{id}', [Type_personController::class, 'getSingle']);
    Route::post('/', [Type_personController::class, 'storeApi']);
    Route::put('/{id}', [Type_personController::class, 'update']);
    Route::delete('/{id}', [Type_personController::class, 'destroy']);
    Route::post('/{id}/recover', [Type_personController::class, 'recover']);
});

Route::prefix('stores')->group(function () {
    Route::get('/', [StoreController::class, 'getAll']);
    Route::get('/{id}', [StoreController::class, 'getSingle']);
    Route::post('/', [StoreController::class, 'storeApi']);
    Route::put('/{id}', [StoreController::class, 'update']);
    Route::delete('/{id}', [StoreController::class, 'destroy']);
    Route::post('/{id}/recover', [StoreController::class, 'recover']);
});

Route::prefix('products')->group(function () {
    Route::get('/', [ProductController::class, 'getAll']);
    Route::get('/{id}', [ProductController::class, 'getSingle']);
    Route::post('/', [ProductController::class, 'storeApi']);
    Route::put('/{id}', [ProductController::class, 'update']);
    Route::delete('/{id}', [ProductController::class, 'destroy']);
    Route::post('/{id}/recover', [ProductController::class, 'recover']);
});

Route::prefix('persons')->group(function () {
    Route::get('/', [PersonController::class, 'getAll']);
    Route::get('/{id}', [PersonController::class, 'getSingle']);
    Route::post('/', [PersonController::class, 'storeApi']);
    Route::put('/{id}', [PersonController::class, 'update']);
    Route::delete('/{id}', [PersonController::class, 'destroy']);
    Route::post('/{id}/recover', [PersonController::class, 'recover']);
});

Route::prefix('orders')->group(function () {
    Route::get('/', [OrdersController::class, 'getAll']);
    Route::get('/{id}', [OrdersController::class, 'getSingle']);
    Route::post('/', [OrdersController::class, 'storeApi']);
    Route::put('/{id}', [OrdersController::class, 'update']);
    Route::delete('/{id}', [OrdersController::class, 'destroy']);
    Route::post('/{id}/recover', [OrdersController::class, 'recover']);
    Route::get('/person/{personId}', [OrdersController::class, 'getOrdersByPersonId']);
});

Route::prefix('orders_products')->group(function () {
    Route::get('/', [Orders_productsController::class, 'getAll']);
    Route::get('/{id}', [Orders_productsController::class, 'getSingle']);
    Route::post('/', [Orders_productsController::class, 'storeApi']);
    Route::put('/{id}', [Orders_productsController::class, 'update']);
    Route::delete('/{id}', [Orders_productsController::class, 'destroy']);
    Route::post('/{id}/recover', [Orders_productsController::class, 'recover']);
});

Route::prefix('carts')->group(function () {
    Route::get('/', [CartController::class, 'getAll']);
    Route::get('/{id}', [CartController::class, 'getSingle']);
    Route::post('/', [CartController::class, 'storeApi']);
    Route::put('/{id}', [CartController::class, 'update']);
    Route::delete('/{id}', [CartController::class, 'destroy']);
    Route::post('/{id}/recover', [CartController::class, 'recover']);
    Route::post('/{id}/end', [CartController::class, 'endCart']);
});

Route::prefix('category_products')->group(function () {
    Route::get('/', [Category_productController::class, 'getAll']);
    Route::get('/{id}', [Category_productController::class, 'getSingle']);
    Route::post('/', [Category_productController::class, 'storeApi']);
    Route::put('/{id}', [Category_productController::class, 'update']);
    Route::delete('/{id}', [Category_productController::class, 'destroy']);
    Route::post('/{id}/recover', [Category_productController::class, 'recover']);
});