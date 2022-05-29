<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SizeController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ImageProductController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
// Route::group(['prefix' => 'admin'], function () {
//     // category
//     // Route::resource('/category' , CategoryController::class);
//     // // size
//     // Route::resource('/size' , SizeController::class);
//     // // product
//     // Route::resource('/product' , ProductController::class);
//     // // image product
//     // Route::resource('/image_product' , ImageProductController::class);
// });

// Route::group(['namespace' => 'Admin', 'prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'auth'], function () {
    
    
//     Route::get('/', 'DashboardController@index')->name('dashboards.index');
    
//     Route::resource('permissions', 'PermissionController');
//     Route::get('roles/get-permission', 'RoleController@getPermission')->name('roles.getPermission');
//     Route::resource('roles', 'RoleController');

//     Route::resource('departments', 'DepartmentController');
//     Route::resource('treatment_types', 'TreatmentTypeController');
//     Route::resource('users', 'UserController');

//     Route::get('/instructions/demo', 'InstructionController@demo')->name('instructions.demo');
//     Route::get('/instructions/{instruction}/history/{key}', 'InstructionController@history')->name('instructions.history');
//     Route::resource('/instructions', 'InstructionController');

//     Route::get('/forms/demo', 'FormController@demo')->name('forms.demo');
//     Route::get('/forms/{form}/history/{key}', 'FormController@history')->name('forms.history');
//     Route::resource('/forms', 'FormController');
// });