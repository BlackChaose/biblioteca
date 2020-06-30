<?php

namespace BlackChaose\Biblioteca;

use Illuminate\Support\ServiceProvider;

class BibliotecaServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
        $this->app->make('BlackChaose\Biblioteca\Controllers\BibliotecaController');
        $this->app->make('BlackChaose\Biblioteca\Models\Biblioteca');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/routes.php');
        $this->loadMigrationsFrom(__DIR__.'/Migrations');
        $this->loadViewsFrom(__DIR__.'/Views/biblioteca', 'BlackChaose\Biblioteca');
        $this->publishes([
            __DIR__.'/Views/biblioteca' => resource_path('/views/vendor/biblioteca'),
            __DIR__.'/assets' => resource_path('/assets')
        ]);
    }
}
