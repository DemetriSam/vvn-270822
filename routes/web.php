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
        Route::get('/categories/{id}/delete', [Controllers\CategoryController::class, 'delete'])->name('category.delete');

        //Коллекции
        Route::get('/pr_collections', [Controllers\PrCollectionController::class, 'index'])->name('pr_collection.index');
        Route::get('/pr_collections/create', [Controllers\PrCollectionController::class, 'create'])->name('pr_collection.create');
        Route::post('/pr_collections', [Controllers\PrCollectionController::class, 'store'])->name('pr_collection.store');

        //Цвета 
        Route::get('/pr_cvets', [Controllers\PrCvetController::class, 'index'])->name('pr_cvet.index');
        Route::get('/pr_cvets/create', [Controllers\PrCvetController::class, 'create'])->name('pr_cvet.create');
        Route::post('/pr_cvets', [Controllers\PrCvetController::class, 'store'])->name('pr_cvet.store');
        Route::get('/pr_cvets/{id}', [Controllers\PrCvetController::class, 'show'])->name('pr_cvet.show');

});



require __DIR__.'/auth.php';


//Страницы каталога
Route::get('/carpets', [Controllers\Controller::class, 'carpets'])->name('carpets');
Route::get('/cinovki', [Controllers\Controller::class, 'cinovki'])->name('cinovki');

//Главная
Route::get('/index', [Controllers\Controller::class, 'index'])->name('index');

//Избранное
Route::get('/favorites', [Controllers\Controller::class, 'favorites'])->name('favorites');