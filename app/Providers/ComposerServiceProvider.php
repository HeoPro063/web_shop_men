<?php

namespace App\Providers;
use View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Library\Cart;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
        View::composer(['frontend.include.header'], function ($view) {
            $user = Auth::check() ? Auth::user() : null;
            $oldCart = Session::has('cart') ? Session::get('cart'):null;
            $cart = new Cart($oldCart);
            $dataCart = $cart->getCart();
            $view->with(['user'=> $user, 'dataCart' => $dataCart]);
        });
    }
}
