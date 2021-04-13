<?php

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

Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => ['auth']], function() {
   Route::get('dashboard', 'DashboardController@index')->name('dashboard');
   Route::resource('categories', 'CategoryController');
   Route::resource('products', 'ProductController');

   Route::get('products/{productID}/images', 'ProductController@images');
   Route::get('products/{productID}/add_image', 'ProductController@add_image');
   Route::post('products/images/{productID}', 'ProductController@upload_image');
   Route::delete('products/images/{productID}', 'ProductController@remove_image');
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
