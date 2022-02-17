<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

// // Create product
Route::get('product/create/', 'ProductController@create')->name('product.create');
Route::get('products', 'ProductController@index')->name('product.index');
Route::post('product/store', 'ProductController@store')->name('product.store');
Route::put('product/{id}/edit', 'ProductController@edit')->name('product.edit');
Route::get('product/{id}/destroy', 'ProductController@destroy')->name('product.destroy');
Auth::routes();

// Route::resource('products', ProductController::class);

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
