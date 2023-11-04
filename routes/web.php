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

        Route::get('/welcome', function () {
            return view('welcome');
        });


        Route::get('/admin', function () {
            return view('dashboard');
        })->middleware(['auth'])->name('admin.index');
        Route::get('/admin', [Controllers\SiteInfoController::class, 'index'])->middleware(['auth'])->name('dashboard');
        Route::patch('/admin', [Controllers\SiteInfoController::class, 'update'])->middleware(['auth'])->name('site_info.update');
        Route::get('/admin/add-param', [Controllers\SiteInfoController::class, 'create'])->middleware(['auth'])->name('site_info.create');
        Route::post('/admin', [Controllers\SiteInfoController::class, 'store'])->middleware(['auth'])->name('site_info.store');
        Route::get('/admin/delete-param', [Controllers\SiteInfoController::class, 'delete'])->middleware(['auth'])->name('site_info.delete');
        Route::delete('/admin/delete-param', [Controllers\SiteInfoController::class, 'destroy'])->middleware(['auth'])->name('site_info.destroy');
        Route::get('/admin/phpinfo', function () {
            return view('phpinfo');
        })->middleware(['auth'])->name('phpinfo');

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
            Route::get('/pr_cvets/{pr_cvet}/delete', [Controllers\PrCvetController::class, 'delete'])
                ->name('pr_cvets.delete');
            Route::get('/pr_cvets/{pr_cvet}/publish', [Controllers\PrCvetController::class, 'publish'])
                ->name('pr_cvets.publish');
            Route::get('/pr_cvets/{pr_cvet}/retract', [Controllers\PrCvetController::class, 'retract'])
                ->name('pr_cvets.retract');
            //Рулоны
            Route::resource('pr_rolls', Controllers\PrRollController::class);
            Route::get('/pr_rolls/{id}/delete', [Controllers\PrRollController::class, 'delete'])
                ->name('pr_rolls.delete');

            //Страницы
            Route::resource('pages', Controllers\PageController::class);
            Route::get('/pages/{id}/delete', [Controllers\PageController::class, 'delete'])
                ->name('pages.delete');
            Route::get('/pages/{page}/publish', [Controllers\PageController::class, 'publish'])
                ->name('pages.publish');
            Route::get('/pages/{page}/retract', [Controllers\PageController::class, 'retract'])
                ->name('pages.retract');

            //Загрузка файлов для обновления остатков
            Route::post('/upload/excel/', [Controllers\PrRollController::class, 'uploadExcelFile'])
                ->name('upload.excel');
            Route::get('/upload/excel/', [Controllers\PrRollController::class, 'renderUploadForm'])
                ->name('upload.form');
            Route::get('/upload/excel/check', [Controllers\PrRollController::class, 'renderCheckPage'])
                ->name('upload.check.get');
            Route::post('/upload/excel/check', [Controllers\PrRollController::class, 'checkAgain'])
                ->name('upload.check');
            Route::get('/upload/excel/edit', [Controllers\PrRollController::class, 'renderEditForm'])
                ->name('upload.edit');
            Route::post('/upload/update-db', [Controllers\PrRollController::class, 'updateDatabase'])
                ->name('upload.update.db');

            //Загрузка картинок для статей
            Route::post('/pictures/store/for/{page}', [Controllers\PageController::class, 'storepic'])
                ->name('pictures.store');
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


        //Произвольная страница
        Route::get('/{page:slug}', [Controllers\PageController::class, 'show'])
            ->name('page');

        //Форма вызова дизайнера
        Route::put('/request/mesurement', [Controllers\MeteringFormController::class, 'sendRequest'])
            ->name('request.mesurement');
