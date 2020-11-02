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

Route::get('/', 'App\Http\Controllers\LandingPageController@index')->name('landing-page');
Route::get('/shop', 'App\Http\Controllers\ShopController@index')->name('shop.index');
Route::get('/shop/{product}', 'App\Http\Controllers\ShopController@show')->name('shop.show');
Route::get('/dashboard', function () {
    return view('backend.layouts.main');
});

Route::get('/cart', 'App\Http\Controllers\CartController@index')->name('cart.index');
Route::post('/cart/{product}', 'App\Http\Controllers\CartController@store')->name('cart.store');
Route::patch('/cart/{product}', 'App\Http\Controllers\CartController@update')->name('cart.update');
Route::delete('/cart/{product}', 'App\Http\Controllers\CartController@destroy')->name('cart.destroy');



Route::resource('/dashboard/product','App\Http\Controllers\ProductController');

Route::resource('/dashboard/productImage','App\Http\Controllers\ProductImageController');