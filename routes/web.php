<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::prefix('admin')->group(function() {
    Route::get('/login',[\App\Http\Controllers\Auth\AdminLoginController::class,'showLoginForm'])->name('admin.login');
    Route::post('/login', [\App\Http\Controllers\Auth\AdminLoginController::class,'login'])->name('admin.login.submit');
    Route::get('logout/', [\App\Http\Controllers\Auth\AdminLoginController::class,'logout'])->name('admin.logout');
    Route::get('/', [\App\Http\Controllers\Auth\AdminController::class,'index'])->name('admin.dashboard');
}) ;
