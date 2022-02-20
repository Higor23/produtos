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
    return view('auth.login');
});
    Route::middleware(['auth'])->group(function () {
    
    // Products
    Route::get('product/create/', 'ProductController@create')->name('product.create');
    Route::get('products', 'ProductController@index')->name('product.index');
    Route::post('product/store', 'ProductController@store')->name('product.store');
    Route::get('product/{id}/edit', 'ProductController@edit')->name('product.edit');
    Route::post('product/update/{id}', 'ProductController@update')->name('product.update');
    Route::get('product/{id}/destroy', 'ProductController@destroy')->name('product.destroy');
    Route::post('product/search', 'ProductController@search')->name('product.search');

    // Tags
    Route::get('tag/create/', 'TagController@create')->name('tag.create');
    Route::get('tags', 'TagController@index')->name('tag.index');
    Route::post('tag/store', 'TagController@store')->name('tag.store');
    Route::get('tag/{id}/edit', 'TagController@edit')->name('tag.edit');
    Route::post('tag/update/{id}', 'TagController@update')->name('tag.update');
    Route::get('tag/{id}/destroy', 'TagController@destroy')->name('tag.destroy');
    Route::post('tag/search', 'TagController@search')->name('tag.search');
});

Auth::routes();

