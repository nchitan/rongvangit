<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// Route::prefix('admin')->group(function () {
//     Route::get('/login', 'Auth\LoginController@create')->name('admin.login');

//     Route::get('/login', 'Auth\LoginController@store');
//     Route::middleware('auth:admin')->group(function () {
//         Route::get('/index', 'AdminDashboardController@index');
//     });
// });


use Modules\Admin\Http\Controllers\AdminController;
use Modules\Admin\Http\Controllers\Auth\LoginController;
use Modules\Admin\Http\Controllers\Auth\AdminPaswordControler;
use Modules\Admin\Http\Controllers\Ajax\AdminAjaxController;
use Illuminate\Support\Facades\Route;


Route::prefix('/admin')->group(function () {
    Route::get('/login', [LoginController::class, 'create'])->name('admin.login');
    //Route::get('/login', 'LoginController@create')->name('admin.login');
    Route::post('/login', [LoginController::class, 'store']);
    Route::get('/logout', [LoginController::class, 'destroy']);
    Route::get('/profile', [LoginController::class, 'profile']);
    Route::post('/updatePassword', [AdminPaswordControler::class, 'update']);

    

    Route::middleware('auth:admin')->group(function () {
        Route::get('/user', [AdminController::class, 'user']);
        Route::get('/userReport', [AdminController::class, 'userReport']);
        Route::get('/userBanList', [AdminController::class, 'userBanList']);
        Route::get('/item', [AdminController::class, 'itemlist']);
        Route::get('/itemReport', [AdminController::class, 'itemReport']);
        Route::get('/index', [AdminController::class, 'index']);

        Route::post('/banUser', [AdminAjaxController::class, 'banUser']);
        Route::post('/banItem', [AdminAjaxController::class, 'banItem']);
    });
});

