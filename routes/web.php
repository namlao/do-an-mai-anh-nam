<?php

use App\Http\Controllers\Admin\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SlideController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\BillController;
//use App\Http\Controllers\Admin\StorageController;
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






Route::group(['prefix'=>'admin'], function () {
    Auth::routes();
    Auth::routes(['verify' => true]);
    Route::group(['prefix'=>'/','middleware'=>'auth'],function (){
        Route::get('/', [HomeController::class, 'index'])->name('admin.home');

        Route::resource('category',CategoryController::class);
        Route::resource('product',ProductController::class);
        Route::resource('slider',SlideController::class);
        Route::resource('setting',SettingController::class);
        Route::resource('user',UserController::class);
        Route::resource('role',RoleController::class);
        Route::resource('bill',BillController::class);

        Route::post('status/{id}',[BillController::class,'status'])->name('status');
//    Route::resource('storage',StorageController::class);

//    Route::group(['prefix'=>'etsy'],function (){
//
//        Route::get('connect',[\App\Http\Controllers\Admin\EtsyApiController::class,'connect'])->name('etsy.connect');
//        Route::post('connect',[\App\Http\Controllers\Admin\EtsyApiController::class,'postConnect'])->name('etsy.postConnect');
//
//        Route::get('getoauth',[\App\Http\Controllers\Admin\EtsyApiController::class,'getoauth'])->name('etsy.getoauth');
//
//        Route::get('/',[\App\Http\Controllers\Admin\EtsyApiController::class,'index'])->name('etsy.index')->middleware('api');
//        Route::get('add/{id}',[\App\Http\Controllers\Admin\EtsyApiController::class,'add'])->name('etsy.add')->middleware('api');
//        Route::post('add/{id}',[\App\Http\Controllers\Admin\EtsyApiController::class,'postAdd'])->name('etsy.postAdd');
//
//
//    });

        Route::get('permission',[PermissionController::class,'index'])->name('permission.index');
        Route::post('permission',[PermissionController::class,'add'])->name('permission.add');

    });


});

// route frontend

Route::get('login',[\App\Http\Controllers\FrontendController::class,'loginCustomer'])->name('customer.login')->middleware(\App\Http\Middleware\LogedIn::class);
Route::post('login',[\App\Http\Controllers\FrontendController::class,'postCustomLogin'])->name('customer.postCustomLogin');
Route::get('logout',[\App\Http\Controllers\FrontendController::class,'logoutCustomer'])->name('customer.logout');

Route::get('register',[\App\Http\Controllers\FrontendController::class,'registerCustom'])->name('customer.register')->middleware(\App\Http\Middleware\LogedIn::class);
Route::post('register',[\App\Http\Controllers\FrontendController::class,'postRegisterCustom'])->name('customer.postRegister');

//Route::get('forget',[]);

Route::group(['prefix'=> '/'],function (){
    Route::get('', [\App\Http\Controllers\FrontendController::class,'index'])->name('index');

    Route::get('shop/', [\App\Http\Controllers\FrontendController::class,'shop'])->name('shop');
    Route::get('category/{id}', [\App\Http\Controllers\FrontendController::class,'categoryId'])->name('category');

    Route::get('cart', [\App\Http\Controllers\ShoppingCartController::class,'index'])->name('cart.index');
    Route::get('addCart/{id}', [\App\Http\Controllers\ShoppingCartController::class,'addCart'])->name('cart.add');
    Route::get('update', [\App\Http\Controllers\ShoppingCartController::class,'update'])->name('cart.update');
    Route::get('removeCart/{rowId}', [\App\Http\Controllers\ShoppingCartController::class,'removeCart'])->name('cart.remove');

    Route::get('product/{id}',[\App\Http\Controllers\FrontendController::class,'product'])->name('item');
    Route::get('checkout', [\App\Http\Controllers\ShoppingCartController::class,'checkout'])->name('cart.checkout');
    Route::post('checkout', [\App\Http\Controllers\ShoppingCartController::class,'postCheckout'])->name('cart.postCheckout');
    Route::get('success', [\App\Http\Controllers\ShoppingCartController::class,'success']);
//    Route::get('jsonProvince', [\App\Http\Controllers\ShoppingCartController::class,'jsonProvince'])->name('cart.jsonProvince');
    Route::post('jsonDistrictInProvince', [\App\Http\Controllers\ShoppingCartController::class,'jsonDistrictInProvince'])->name('cart.jsonDistrictInProvince');
    Route::post('jsonWardInDistrict', [\App\Http\Controllers\ShoppingCartController::class,'jsonWardInDistrict'])->name('cart.jsonWardInDistrict');




});
