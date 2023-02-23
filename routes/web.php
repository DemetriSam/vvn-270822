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


Route::get('/admin', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::group([
    'prefix' => 'admin',
    'middleware' => ['auth', 'role:admin'],
], function ($router) {
    Route::get('/users', [Controllers\UsersController::class, 'index'])
        ->name('users.index');
    //Категории
    Route::resource('categories', Controllers\CategoryController::class);
    Route::get('/categories/{id}/delete', [Controllers\CategoryController::class, 'delete'])
        ->name('categories.delete');

    //Характеристики
    Route::resource('properties', Controllers\PropertyController::class);
    Route::get('/properties/{id}/delete', [Controllers\PropertyController::class, 'delete'])
        ->name('properties.delete');

    //Значения характеристик
    Route::resource('property_values', Controllers\PropertyController::class);
    Route::get('/property_values/{id}/delete', [Controllers\PropertyController::class, 'delete'])
        ->name('property_values.delete');

    //Оттенки коврового покрытия
    Route::resource('colors', Controllers\ColorController::class);
    Route::get('/colors/{id}/delete', [Controllers\ColorController::class, 'delete'])
        ->name('colors.delete');

    //Коллекции
    Route::resource('pr_collections', Controllers\PrCollectionController::class);
    Route::get('/pr_collections/{id}/delete', [Controllers\PrCollectionController::class, 'delete'])
        ->name('pr_collections.delete');
    Route::post('/pr_collections/id/update/properties', [Controllers\PrCollectionController::class, 'updateProperties'])
        ->name('pr_collections.update.properties');

    //Цвета
    Route::resource('pr_cvets', Controllers\PrCvetController::class);
    Route::get('/pr_cvets/{id}/delete', [Controllers\PrCvetController::class, 'delete'])
        ->name('pr_cvets.delete');
    //Рулоны
    Route::resource('pr_rolls', Controllers\PrRollController::class);
    Route::get('/pr_rolls/{id}/delete', [Controllers\PrRollController::class, 'delete'])
        ->name('pr_rolls.delete');

    //Загрузка файлов для обновления остатков
    Route::post('/upload/excel/', [Controllers\PrRollController::class, 'uploadExcelFile'])
        ->name('upload.excel');
    Route::get('/upload/excel/', [Controllers\PrRollController::class, 'renderUploadForm'])
        ->name('upload.form');
    Route::get('/upload/excel/check', [Controllers\PrRollController::class, 'renderCheckPage'])
        ->name('upload.check');
    Route::post('/upload/excel/check', [Controllers\PrRollController::class, 'checkAgain'])
        ->name('upload.check');
    Route::get('/upload/excel/edit', [Controllers\PrRollController::class, 'renderEditForm'])
        ->name('upload.edit');
    Route::post('/upload/update-db', [Controllers\PrRollController::class, 'updateDatabase'])
        ->name('upload.update.db');
});



require __DIR__ . '/auth.php';

//Главная
Route::get('/', [Controllers\Controller::class, 'index'])->name('index');

//Избранное
Route::get('/favorites', [Controllers\Controller::class, 'favorites'])->name('favorites');

Route::get('/test', fn () => 'test');


//Страница отфильтрованных по цвету
Route::get('/{category:slug}/colors/{color:slug}', [Controllers\Controller::class, 'color'])
    ->name('catalog.color');

//Страница продукта
Route::get('/carpets/{pr_cvet}', [Controllers\PrCvetController::class, 'show'])
    ->name('carpets.product');

Route::get('/cinovki/{pr_cvet}', [Controllers\PrCvetController::class, 'show'])
    ->name('cinovki.product');

//Открыть чат в воцапе
Route::get('/whatsapp', fn () => redirect()->to('https://wa.me/79035649165')->send())->name('whatsapp');

//Страницы каталога
Route::get('/{category:slug}', [Controllers\Controller::class, 'catalog'])
    ->name('catalog');

//Форма вызова дизайнера
Route::put('/request/mesurement', [Controllers\MeteringFormController::class, 'sendRequest'])
    ->name('request.mesurement');
