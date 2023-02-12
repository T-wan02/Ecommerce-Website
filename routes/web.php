<?php

use App\Models\Product;
use App\Models\ProductOrder;
use App\Models\User;
use GuzzleHttp\Middleware;
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

// auth
Route::group(['middleware' => ['RedirectIfAuth']], function () {
    Route::get('/login', 'AuthController@showLogin');
    Route::post('/login', 'AuthController@postLogin');

    Route::get('/register', 'AuthController@showRegister');
    Route::post('/register', 'AuthController@postRegister');
});

Route::group(['middleware' => ['RedirectIfNotAuth']], function () {
    Route::get('/logout', 'AuthController@logout');
    Route::get('/profile', 'PageController@showProfile');
});

Route::get('/authLogin', function () {
    $user = User::find(1);
    auth()->login($user);
    return auth()->user();
});

Route::get('/product/{slug}', 'ProductController@detail');

Route::get('/', 'PageController@home');
Route::get('/product', 'PageController@allProduct');

Route::get('/admin/login', 'ADmin\PageController@showLogin');
Route::post('/admin/login', 'ADmin\PageController@login');

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['Admin']], function () {
    Route::get('/', 'PageController@showDashboard');
    Route::post('/logout', 'PageController@logout');

    Route::resource('/category', 'CategoryController');
    Route::resource('/brand', 'BrandController');
    Route::resource('/color', 'ColorController');
    Route::resource('/product', 'ProductController');
    Route::resource('/income', 'IncomeController');
    Route::resource('/outcome', 'OutcomeController');

    Route::post('product-upload', 'ProductController@upload');
    Route::get('create-product-add/{slug}', 'ProductController@createProductAdd');
    Route::post('create-product-add/{slug}', 'ProductController@storeProductAdd');
    Route::get('product_transaction', 'ProductController@productTransaction');
    Route::get('create-product-remove/{slug}', 'ProductController@createProductRemove');
    Route::post('create-product-remove/{slug}', 'ProductController@storeProductRemove');

    Route::get('/order-list', 'OrderController@all');
    Route::get('/change-order', 'OrderController@changeOrderList');
});

Route::get('/locale/{locale}', function ($locale) {
    // return $locale;

    session()->put('locale', $locale);
    return redirect()->back()->with('success', 'Language switched');
});
