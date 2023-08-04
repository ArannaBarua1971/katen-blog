<?php

namespace App\Providers;

use App\Models\Catagory;
use Illuminate\Support\ServiceProvider;

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
        $navAllow = ['homepage', 'postDetails', 'allcatagoryPost', 'allsubcatagoryPost'];

        foreach ($navAllow as $postion) {
            view()->composer('layouts/Frontend/'.$postion, function ($view) {
                return $view->with('catagories', Catagory::with('subcatagories')->get());
            });
        }
    }
}
