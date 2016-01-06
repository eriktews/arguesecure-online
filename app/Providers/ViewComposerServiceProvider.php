<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer(['layout.header','layout.menu'], 'App\Http\ViewComposers\TreeListComposer');
        
        view()->composer('layout.header', 'App\Http\ViewComposers\HeaderComposer');
        view()->composer('layout.menu', 'App\Http\ViewComposers\MenuComposer');
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
