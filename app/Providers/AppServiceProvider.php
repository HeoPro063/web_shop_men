<?php

namespace App\Providers;

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
        $this->app->singleton(\App\Repositories\Category\CategoryRepositoryInterface::class,
        \App\Repositories\Category\CategoryRepository::class);
        $this->app->singleton(\App\Repositories\Size\SizeRepositoryInterface::class,
        \App\Repositories\Size\SizeRepository::class);
        $this->app->singleton(\App\Repositories\Product\ProductRepositoryInterface::class,
        \App\Repositories\Product\ProductRepository::class);
        $this->app->singleton(\App\Repositories\ImageProduct\ImageProductRepositoryInterface::class,
        \App\Repositories\ImageProduct\ImageProductRepository::class);
        $this->app->singleton(\App\Repositories\Color\ColorRepositoryInterface::class,
        \App\Repositories\Color\ColorRepository::class);
        $this->app->singleton(\App\Repositories\Role\RoleRepositoryInterface::class,
        \App\Repositories\Role\RoleRepository::class);
        $this->app->singleton(\App\Repositories\Promotion\PromotionRepositoryInterface::class,
        \App\Repositories\Promotion\PromotionRepository::class);
    }

    /**
     * Bootstrap any application services.
     *  
     * @return void
     */
    public function boot()
    {
        //
    }
}
