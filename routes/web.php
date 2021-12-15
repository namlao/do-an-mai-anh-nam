<?php

use App\Http\Controllers\Admin\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SlideController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Auth;
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

//Route::any('/ckfinder/connector', '\CKSource\CKFinderBridge\Controller\CKFinderController@requestAction')
//    ->name('ckfinder_connector');
//
//Route::any('/ckfinder/browser', '\CKSource\CKFinderBridge\Controller\CKFinderController@browserAction')
//    ->name('ckfinder_browser');

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Auth::routes(['verify' => true]);


Route::group(['prefix'=>'admin','middleware'=>'auth'], function () {
    Route::get('/', [HomeController::class, 'index'])->name('admin.home');

    Route::resource('category',CategoryController::class);
    Route::resource('product',ProductController::class);
    Route::resource('slider',SlideController::class);
    Route::resource('setting',SettingController::class);
    Route::resource('user',UserController::class);

});




