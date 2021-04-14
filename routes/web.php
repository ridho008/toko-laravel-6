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

   Route::resource('attributes', 'AttributeController');
   Route::get('attributes/{attributID}/options', 'AttributeController@options');
   Route::get('attributes/{attributID}/add-option', 'AttributeController@add_option');
   Route::post('attributes/options/{attributID}', 'AttributeController@store_option');
   Route::delete('attributes/options/{attributID}', 'AttributeController@remove_option');
   Route::get('attributes/options/{attributID}/edit', 'AttributeController@edit_option');
   Route::put('attributes/options/{attributID}', 'AttributeController@update_option');
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
