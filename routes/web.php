<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//Type_person_model 
Route::prefix('admin_products')->group(function () {
	Route::get('/Type_person/grid', 'Type_personController@grid');
	Route::put('/Type_person/{id}/recover', 'Type_personController@recover');
	Route::resource('/Type_person','Type_personController');
});

//Person_model 
Route::prefix('admin_products')->group(function () {
	Route::get('/Person/grid', 'PersonController@grid');
	Route::put('/Person/{id}/recover', 'PersonController@recover');
	Route::resource('/Person','PersonController');
});

//Category_product_model 
Route::prefix('admin_products')->group(function () {
	Route::get('/Category_product/grid', 'Category_productController@grid');
	Route::put('/Category_product/{id}/recover', 'Category_productController@recover');
	Route::resource('/Category_product','Category_productController');
});

//Store_model 
Route::prefix('admin_products')->group(function () {
	Route::get('/Store/grid', 'StoreController@grid');
	Route::put('/Store/{id}/recover', 'StoreController@recover');
	Route::resource('/Store','StoreController');
});

//Product_model 
Route::prefix('admin_products')->group(function () {
	Route::get('/Product/grid', 'ProductController@grid');
	Route::put('/Product/{id}/recover', 'ProductController@recover');
	Route::resource('/Product','ProductController');
});

//Cart_model 
Route::prefix('admin_products')->group(function () {
	Route::get('/Cart/grid', 'CartController@grid');
	Route::put('/Cart/{id}/recover', 'CartController@recover');
	Route::resource('/Cart','CartController');
});

//Orders_model 
Route::prefix('admin_products')->group(function () {
	Route::get('/Orders/grid', 'OrdersController@grid');
	Route::put('/Orders/{id}/recover', 'OrdersController@recover');
	Route::resource('/Orders','OrdersController');
});

//Orders_products_model 
Route::prefix('admin_products')->group(function () {
	Route::get('/Orders_products/grid', 'Orders_productsController@grid');
	Route::put('/Orders_products/{id}/recover', 'Orders_productsController@recover');
	Route::resource('/Orders_products','Orders_productsController');
});

