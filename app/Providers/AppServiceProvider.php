<?php

namespace App\Providers;

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
        //
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

        }

    }
}
