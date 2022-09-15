<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;

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

Route::get('/categories', [Controllers\CategoryController::class, 'index'])->name('category.index');
Route::get('/categories/create', [Controllers\CategoryController::class, 'create'])->name('category.create');
Route::post('/categories', [Controllers\CategoryController::class, 'store'])->name('category.store');
Route::get('/categories/{id}/edit', [Controllers\CategoryController::class, 'edit'])->name('category.edit');
Route::patch('/categories/{id}', [Controllers\CategoryController::class, 'update'])->name('category.update');

Route::get('/categories/{id}/delete', [Controllers\CategoryController::class, 'delete'])->name('category.delete');
Route::delete('/categories/{id}', [Controllers\CategoryController::class, 'destroy'])->name('category.destroy');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';


//Коллекции
Route::get('/pr_collections', [Controllers\PrCollectionController::class, 'index'])->name('pr_collection.index');
Route::get('/pr_collections/create', [Controllers\PrCollectionController::class, 'create'])->name('pr_collection.create');
Route::post('/pr_collections', [Controllers\PrCollectionController::class, 'store'])->name('pr_collection.store');

//Цвета 
Route::get('/pr_cvets', [Controllers\PrCvetController::class, 'index'])->name('pr_cvet.index');
Route::get('/pr_cvets/create', [Controllers\PrCvetController::class, 'create'])->name('pr_cvet.create');
Route::post('/pr_cvets', [Controllers\PrCvetController::class, 'store'])->name('pr_cvet.store');
Route::get('/pr_cvets/{id}', [Controllers\PrCvetController::class, 'show'])->name('pr_cvet.show');

Route::get('/test_swiper', function () {
    return view('test_swiper');
});

//Страницы каталога
Route::get('/carpets', [Controllers\Controller::class, 'carpets'])->name('carpets');
Route::get('/cinovki', [Controllers\Controller::class, 'cinovki'])->name('cinovki');

//Главная
Route::get('/index', [Controllers\Controller::class, 'index'])->name('index');

//Избранное
Route::get('/favorites', [Controllers\Controller::class, 'favorites'])->name('favorites');