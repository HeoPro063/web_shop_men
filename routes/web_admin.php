<?php 
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AuthController as AuthAdmin;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ColorController;
use App\Http\Controllers\Admin\SizeController;
use App\Http\Controllers\Admin\PromotionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ImageProductController;


Route::group(['prefix' => 'admin', 'as' => 'admin.' ], function () {
    Route::get('/' , [DashboardController::class, 'index'])->name('index');
    Route::post('/post-login-admin', [AuthAdmin::class, 'logIn'])->name('post.login');
    Route::group(['middleware' => 'check.auth.user'],  function (){
        Route::get('/dashboard' , [DashboardController::class, 'home'])->name('home');
        Route::get('/logout' , [AuthAdmin::class, 'logout'])->name('logout');

        // category
        Route::get('/list-category' , [CategoryController::class, 'viewList']);
        Route::resource('/category' , CategoryController::class);

        // color
        Route::get('/list-color' , [ColorController::class, 'viewList']);
        Route::resource('/color' , ColorController::class);

        // size
        Route::get('/list-size' , [SizeController::class, 'viewList']);
        Route::resource('/size' , SizeController::class);

        // promotion
        Route::get('/list-promotion' , [PromotionController::class, 'viewList']);
        Route::get('/active-promotion/{id}' , [PromotionController::class, 'activeItem']);
        Route::resource('/promotion' , PromotionController::class);

        // role
        Route::get('/list-role' , [RoleController::class, 'viewList']);
        Route::resource('/role' , RoleController::class);

        // product
        Route::get('/list-product' , [ProductController::class, 'viewList']);
        Route::resource('/product' , ProductController::class);

        Route::resource('/image-product' , ImageProductController::class);
    });
});

