<?php

namespace App\Providers;

use App\Services\RBKParser;
use Illuminate\Support\ServiceProvider;

class RBKParserProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(RBKParser::class, function ($app) {
            return new RBKParser();
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
