<?php

namespace App\Providers;

use App\Services\Tags\ProviderFactory;
use App\Services\Tags\LinesProviderFactory;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ProviderFactory::class, LinesProviderFactory::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
    }
}
