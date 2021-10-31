<?php

use App\Http\Controllers\Admin\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;
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
Auth::routes(['verify' => true]);


Route::group(['prefix'=>'admin','middleware'=>'auth'], function () {
    Route::get('/', [HomeController::class, 'index'])->name('admin.home');

    Route::resource('category',CategoryController::class);
});




