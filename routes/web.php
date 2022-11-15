<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;
use App\Http\Controllers\UsersController;

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

Route::get('/welcome', function () {
    return view('welcome');
});


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::group([
    'prefix' => 'admin',
    'middleware' => ['auth','role:admin'],
    ], function ($router) {
        Route::resource('users', Controllers\UsersController::class);

        //Категории
        Route::resource('categories', Controllers\CategoryController::class);
        Route::get('/categories/{id}/delete', [Controllers\CategoryController::class, 'delete'])->name('categories.delete');

        //Характеристики
        Route::resource('properties', Controllers\PropertyController::class);
        Route::get('/properties/{id}/delete', [Controllers\CategoryController::class, 'delete'])->name('properties.delete');

        //Коллекции
        Route::resource('pr_collections', Controllers\PrCollectionController::class);

        //Цвета
        Route::resource('pr_cvets', Controllers\PrCvetController::class);

});



require __DIR__.'/auth.php';


//Страницы каталога
Route::get('/carpets', [Controllers\Controller::class, 'carpets'])->name('carpets');
Route::get('/cinovki', [Controllers\Controller::class, 'cinovki'])->name('cinovki');

//Главная
Route::get('/', [Controllers\Controller::class, 'index'])->name('index');

//Избранное
Route::get('/favorites', [Controllers\Controller::class, 'favorites'])->name('favorites');