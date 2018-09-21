<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use \App\Type_products;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('layout.menu', function($menu){
            // 'menu'  is the name of file which will receive this data
            $loai_sp = Type_products::all();
           
            $menu->with('loai_sp', $loai_sp);
        });
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
