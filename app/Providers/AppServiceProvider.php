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
        \App\Attack::observe( new \App\Observers\AttackObserver );
        \App\Defence::observe( new \App\Observers\DefenceObserver );
        \App\Risk::observe( new \App\Observers\RiskObserver );
        \App\Tree::observe( new \App\Observers\TreeObserver );
        \App\User::observe( new \App\Observers\UserObserver );
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
