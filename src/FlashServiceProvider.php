<?php

namespace Zaichaopan\Flash;

use Illuminate\Support\ServiceProvider;

class FlashServiceProvider extends ServiceProvider
{
    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('flash', function ($app) {
            return $this->app->make('Zaichaopan\Flash\Flash');
        });
    }
}
