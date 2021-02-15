<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\View\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        /*View()->composer('layouts.leftbar', function ($view) {

            $count_not_approved = 69;

            $view->with('count_not_approved', $count_not_approved);
        } );*/
    }
}
