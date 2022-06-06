<?php 
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\DetailController;
use App\Http\Controllers\Frontend\AuthController as AuthFrontend;
use App\Http\Controllers\Frontend\UserController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\CategoryController;
use App\Http\Controllers\Frontend\CheckoutController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/category', [CategoryController::class, 'index'])->name('category');
Route::get('/category-search', [CategoryController::class, 'search'])->name('category');

Route::get('/detail/{id}', [DetailController::class, 'detail'])->name('detail');

Route::group(['middleware' => 'check.auth.user'], function () {
    
});


Route::get('/login', [AuthFrontend::class, 'index'])->name('login');
Route::post('/post-login', [AuthFrontend::class, 'postLogin'])->name('post.login');
Route::get('/register', [AuthFrontend::class, 'register'])->name('register');

Route::get('/email/confirm', [AuthFrontend::class, 'confirm'])->name('confirm');
Route::get('/email/password', [AuthFrontend::class, 'password'])->name('password');
Route::get('/check-accoutn-view-comfirm', [AuthFrontend::class, 'checkAccount'])->name('check.account');
Route::get('/check-accout-view-passowrd', [AuthFrontend::class, 'checkPassword'])->name('check.account');
Route::get('/register-done', [AuthFrontend::class, 'registerDone'])->name('registerDone');
Route::post('/check-email', [AuthFrontend::class, 'checkEmail'])->name('check.email');
Route::post('/check-token', [AuthFrontend::class, 'checkToken'])->name('check.token');
Route::post('/register-password', [AuthFrontend::class, 'RegisterPassword'])->name('register.password');
Route::post('/post-register', [AuthFrontend::class, 'postRegister'])->name('post.register');
Route::get('/logout', [AuthFrontend::class, 'logout'])->name('logout');
Route::get('/my-profile', [UserController::class, 'myProfile'])->name('my.profile');


Route::group(['prefix' => 'home'], function () {
    Route::get('/get-data-new', [HomeController::class, 'getDataNew']);
});
Route::post('/post-add-cart', [DetailController::class, 'postAddCart'])->name('post.add.cart');
Route::get('/get-delete-cart', [DetailController::class, 'getDeleteCart'])->name('get.delete.cart');
Route::get('/checkout', [CheckoutController::class, 'getCheckout'])->name('get.checkout');

