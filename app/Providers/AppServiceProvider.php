<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use \App\Type_products;
use Session;
use \App\Cart;

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

        view()->composer('layout.header', function($view){
            if(Session('cart')){
                $oldCart = Session::get('cart');
                $cart = new Cart($oldCart);

                $view->with(['cart'=>Session::get('cart'), 'prod_cart'=>$cart->items, 'amount'=>$cart->amount, 'total'=>$cart->total]);
            }
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
