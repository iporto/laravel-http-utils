<?php

namespace IPorto\HttpUtils;

use Illuminate\Support\ServiceProvider;

class HttpUtilsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('http-utils', function ($app) {
            return new HttpUtils();
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}