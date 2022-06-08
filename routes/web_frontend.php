<?php 
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\DetailController;
use App\Http\Controllers\Frontend\AuthController as AuthFrontend;
use App\Http\Controllers\Frontend\UserController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\CategoryController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\AddressController;
use App\Http\Controllers\Frontend\PromotionController;
use App\Http\Controllers\Frontend\OrderController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/category', [CategoryController::class, 'index'])->name('category');
Route::get('/promotion', [PromotionController::class, 'index'])->name('category');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/get-data-header', [HomeController::class, 'getHeaderCategory']);
Route::get('/category-search', [CategoryController::class, 'search'])->name('category');

Route::get('/detail/{id}', [DetailController::class, 'detail'])->name('detail');

Route::group(['middleware' => 'check.auth.user'], function () {
    Route::group(['prefix' => 'my-profile'], function () {
        Route::get('/', [UserController::class, 'myProfile'])->name('my.profile');
        Route::post('/add-avatar', [UserController::class, 'postAvatar'])->name('post.avatar');
        Route::get('/get-data-user', [UserController::class, 'getDataMyprofile']);
        Route::post('/save-data-user', [UserController::class, 'saveDataMyprofile']);
        Route::post('/change-password', [UserController::class, 'saveChangePassword']);
        Route::get('/get-address-province', [AddressController::class, 'getDataProvince']);
        Route::get('/get-address-districts', [AddressController::class, 'getDataDistricts']);
        Route::get('/get-address-wards', [AddressController::class, 'getDataWards']);
        Route::post('/add-more-address', [AddressController::class, 'addMoreAddress']);
        Route::get('/get-data-address-user', [AddressController::class, 'getDataAddress']);
        Route::post('/post-checkout', [CheckoutController::class, 'postCheckout']);
        Route::get('/getdata-order', [OrderController::class, 'getOrder']);
    });
    Route::get('/checkout', [CheckoutController::class, 'getCheckout'])->name('get.checkout');
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


Route::group(['prefix' => 'home'], function () {
    Route::get('/get-data-new', [HomeController::class, 'getDataNew']);
});
Route::post('/post-add-cart', [DetailController::class, 'postAddCart'])->name('post.add.cart');
Route::get('/get-delete-cart', [DetailController::class, 'getDeleteCart'])->name('get.delete.cart');

