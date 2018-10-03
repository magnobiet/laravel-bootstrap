<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::defaultView('pagination::bootstrap-4');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

        if ($this->app->environment('staging') || $this->app->environment('production')) {

            $this->app->register(\Rollbar\Laravel\RollbarServiceProvider::class);

        } else {

            $this->app->register(\KKomelin\TranslatableStringExporter\Providers\ExporterServiceProvider::class);
            $this->app->register(\Laracasts\Generators\GeneratorsServiceProvider::class);

        }

    }
}
