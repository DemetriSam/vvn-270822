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

Route::get('categories', 'CategoryController@index')->name('category.index');
Route::get('categories', 'CategoryController@create')->name('category.create');
Route::get('categories', 'CategoryController@store')->name('category.store');
