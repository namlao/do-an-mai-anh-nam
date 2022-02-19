<?php

use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\FrontendController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SlideController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\BillController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\BrandController;
//use App\Http\Controllers\Admin\StorageController;
use App\Http\Controllers\Api\LazadaController;
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
        Route::get('sync/{product}',[ProductController::class,'sync'])->name('product.sync');
        Route::resource('slider',SlideController::class);
        Route::resource('setting',SettingController::class);
        Route::resource('user',UserController::class);
        Route::resource('role',RoleController::class);
        Route::resource('bill',BillController::class);
        Route::resource('brand',BrandController::class);

        //        Route::resource('comment',CommentController::class)->except('create','show','edit','update');
        Route::get('comment', [CommentController::class,'index'])->name('comment.index');
        Route::delete('destroy/{comment}', [CommentController::class,'destroy'])->name('comment.destroy');

        Route::post('status/{id}',[BillController::class,'status'])->name('status');
        //    Route::resource('storage',StorageController::class);

        Route::get('permission',[PermissionController::class,'index'])->name('permission.index');
        Route::post('permission',[PermissionController::class,'add'])->name('permission.add');


        //API lazada
        Route::group(['prefix'=>'lazada'],function (){

            Route::get('authorize',[LazadaController::class,'templateAuthorize'])->name('lazada.templateAuthorize');
            Route::post('authorize',[LazadaController::class,'LaOpAuthorize'])->name('lazada.authorize');
            Route::get('token',[LazadaController::class,'getToken'])->name('lazada.getToken');
            Route::get('refresh',[LazadaController::class,'refresh'])->name('lazada.refresh');
            Route::get('/',[LazadaController::class,'index'])->name('lazada.index');
            Route::get('status/{item_id}/{status}',[LazadaController::class,'status'])->name('lazada.status');
            Route::get('remove/{item_id}',[LazadaController::class,'remove'])->name('lazada.remove');
            Route::get('restore/{item_id}',[LazadaController::class,'restore'])->name('lazada.restore');
        });
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

    Route::get('account',[\App\Http\Controllers\FrontendController::class,'account'])->name('customer.account');
    Route::get('password',[\App\Http\Controllers\FrontendController::class,'accountPassword'])->name('customer.accountPassword');
    Route::get('info',[\App\Http\Controllers\FrontendController::class,'accountInfo'])->name('customer.accountInfo');
    Route::get('address',[\App\Http\Controllers\FrontendController::class,'accountAddress'])->name('customer.accountAddress');

    Route::get('', [\App\Http\Controllers\FrontendController::class,'index'])->name('index');

    //Hiển thị sản phẩm
    Route::get('shop/', [\App\Http\Controllers\FrontendController::class,'shop'])->name('shop');
    Route::get('category/{id}', [\App\Http\Controllers\FrontendController::class,'categoryId'])->name('category');

    // chi tiết sản phẩm
    Route::get('product/{id}',[\App\Http\Controllers\FrontendController::class,'product'])->name('item');


    // Giỏ hàng
    Route::get('cart', [\App\Http\Controllers\ShoppingCartController::class,'index'])->name('cart.index');
    Route::get('addCart/{id}', [\App\Http\Controllers\ShoppingCartController::class,'addCart'])->name('cart.add');
    Route::get('update', [\App\Http\Controllers\ShoppingCartController::class,'update'])->name('cart.update');
    Route::post('removeCart/{rowId}', [\App\Http\Controllers\ShoppingCartController::class,'removeCart'])->name('cart.remove');

    // thanh toán
    Route::get('checkout', [\App\Http\Controllers\ShoppingCartController::class,'checkout'])->name('cart.checkout');
    Route::post('checkout', [\App\Http\Controllers\ShoppingCartController::class,'postCheckout'])->name('cart.postCheckout');
    Route::get('success', [\App\Http\Controllers\ShoppingCartController::class,'success']);
//    Route::get('jsonProvince', [\App\Http\Controllers\ShoppingCartController::class,'jsonProvince'])->name('cart.jsonProvince');
    Route::post('jsonDistrictInProvince', [\App\Http\Controllers\ShoppingCartController::class,'jsonDistrictInProvince'])->name('cart.jsonDistrictInProvince');
    Route::post('jsonWardInDistrict', [\App\Http\Controllers\ShoppingCartController::class,'jsonWardInDistrict'])->name('cart.jsonWardInDistrict');

    // Các page khác
    Route::get('privacy-policy',[\App\Http\Controllers\FrontendController::class,'privacy_policy'])->name('privacy-policy');
    Route::get('faq',[\App\Http\Controllers\FrontendController::class,'faq'])->name('faq');
    Route::get('about',[\App\Http\Controllers\FrontendController::class,'about'])->name('about');
    Route::get('contact',[\App\Http\Controllers\FrontendController::class,'contact'])->name('contact');
    Route::get('terms-conditions',[\App\Http\Controllers\FrontendController::class,'terms_conditions'])->name('terms-conditions');

    // CHức năng ajax (filter, lọc sắp xếp)
    Route::get('sort/{id}',[\App\Http\Controllers\AjaxController::class,'shopSort'])->name('shopSort');
    Route::get('{id}/categorySort/{sort}',[\App\Http\Controllers\AjaxController::class,'categorySort'])->name('sort');
    Route::get('showShop/{limit}',[\App\Http\Controllers\AjaxController::class,'showShop'])->name('showShop');
    Route::get('{id}/categoryShow/{sort}',[\App\Http\Controllers\AjaxController::class,'categoryShow'])->name('categoryShow');
    Route::get('filterStockShop/{id}',[\App\Http\Controllers\AjaxController::class,'filterStockShop'])->name('filterStockShop');
    Route::get('{category}/filterStockCategory/{id}',[\App\Http\Controllers\AjaxController::class,'filterStockCategory'])->name('filterStockCategory');
    Route::get('filterPriceShop/{id}',[\App\Http\Controllers\AjaxController::class,'filterPriceShop'])->name('filterPriceShop');
    Route::get('{category}/filterPriceCategory/{id}',[\App\Http\Controllers\AjaxController::class,'filterPriceCategory'])->name('filterPriceCategory');

    Route::get('search',[\App\Http\Controllers\FrontendController::class,'getSearch'])->name('getSearch');

    //comment
    Route::post('product/{id}/comment', [CommentController::class,'store'])->name('comment.store');

});
