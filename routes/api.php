<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::get('/home', 'Api\HomeApi@home');
Route::get('/product/{slug}', 'Api\ProductApi@detail');
Route::post('make-review/{slug}', 'Api\ReviewApi@review');
Route::post('add-tocart/{slug}', 'Api\CartApi@addToCart');
Route::get('get-cart', 'Api\CartApi@getCart');

Route::post('/update-cart-qty', 'Api\CartApi@updateCartQty');
Route::post('/remove-cart', 'Api\CartApi@removeCart');
Route::post('/checkout', 'Api\CartApi@checkout');
Route::get('/order', 'Api\CartApi@order');
Route::post('/change-password', 'Api\AuthApi@changePassword');
