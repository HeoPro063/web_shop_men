<?php 
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AuthController as AuthAdmin;


Route::group(['prefix' => 'admin', 'as' => 'admin.' ], function () {
    Route::get('/' , [DashboardController::class, 'index'])->name('index');
    Route::post('/post-login-admin', [AuthAdmin::class, 'logIn'])->name('post.login');

    Route::group(['middleware' => 'check.auth.user'],  function (){
        Route::get('/dashboard' , [DashboardController::class, 'home'])->name('home');
        Route::get('/logout' , [AuthAdmin::class, 'logout'])->name('logout');
    });
});

