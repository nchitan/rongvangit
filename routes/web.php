<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

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

Route::get('/linkstorage', function () {
    Artisan::call('storage:link');
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/guideline', function () {
    return view('guideline');
});
Route::get('/about', function () {
    return view('about');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('send', [HomeController::class,'sendNotification']);

Route::get('/foo', function () {
    Artisan::call('storage:link');
});

 Route::get('/clear-cache', function() {
 $exitCode = Artisan::call('cache:clear');
 return 'Application cache cleared';
 });
 
  Route::get('/route-cache', function() {
 $exitCode = Artisan::call('route:cache');
return 'Routes cache cleared';
 });
 
   Route::get('/route-list', function() {
 $exitCode = Artisan::call('route:list');
return 'Routes cache cleared';
 });