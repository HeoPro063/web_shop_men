<?php 
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\DetailController;
use App\Http\Controllers\Frontend\AuthController as AuthFrontend;
use App\Http\Controllers\Frontend\UserController;
use App\Http\Controllers\Frontend\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::group(['middleware' => 'check.auth.user'], function () {
    
});

Route::post('add-product-cart/{id}',[DetailController::class , 'addInCart']);
Route::group(['prefix' => 'user', 'as' => 'user.' ], function () {
    Route::get('/login', [AuthFrontend::class, 'index'])->name('login');
    Route::get('/logout', [AuthFrontend::class, 'logout'])->name('logout');
    Route::post('/post-login', [AuthFrontend::class, 'postLogin'])->name('post.login');
    Route::get('/my-profile', [UserController::class, 'myProfile'])->name('my.profile');
});