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

Route::resource('products','ProductsController');

Route::resource('orders','OrdersController');

Route::resource('useraccounts','UserAccountsController');

Route::resource('topups','TopupsController');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/admin', 'HomeController@admin')->name('admin');

Route::get('/userorders', 'OrdersController@userorders')->name('userorders');

Route::get('/orders/purchase/{product}', 'OrdersController@buyproduct')->name('orders.buyproduct');

