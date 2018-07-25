<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class menu extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
      View::composer([
                      'home',
                      'menus.menu',
                      'menus.iconos',
                      'menus.permisos',
                      'usuarios.users',
                      'cargar',
                      'cotizar',
                      ]
                      ,'App\Http\ViewComposers\MenuComposer');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
