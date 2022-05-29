<?php

namespace App\Providers;
use View;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Auth;
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
            $view->with('user', $user);
        });
    }
}
