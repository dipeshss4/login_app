<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::group(['prefix' => 'user'], function(){
    Route::post('/userLogin',[\App\Http\Controllers\Auth\RestLoginController::class,'login']);

    Route::post('/register',[\App\Http\Controllers\Auth\RestLoginController::class,'register']);
    Route::get('logout',[\App\Http\Controllers\Auth\RestLoginController::class,'logout'])->middleware('auth:api');
    Route::get('userDashboard', [\App\Http\Controllers\user\UserRestDashboard::class,'index'])->name('user.dashboard')->middleware('auth:api');

});

Route::group(['prefix' => 'admin'], function(){
    Route::post('/login', [\App\Http\Controllers\Auth\AdminRestLoginController::class,'login'])->name('admin.login-api');
    Route::get('logout', [\App\Http\Controllers\Auth\AdminRestLoginController::class,'logout'])->name('admin.logout')->middleware('auth:admin-api');
    Route::get('adminDashboard', [\App\Http\Controllers\admin\AdminRestDashboard::class,'index'])->name('admin.dashboard')->middleware('auth:admin-api');
});




