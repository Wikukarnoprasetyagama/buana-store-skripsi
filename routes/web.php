<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\SlidersController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardAdminController;
use App\Http\Controllers\Admin\SellerController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Seller\DashboardSellerController;
use App\Http\Controllers\Seller\ProductController;
use App\Http\Controllers\Seller\ProductGalleryController;
use App\Http\Controllers\User\DashboardUserController;

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

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/auth/callback', [LoginController::class, 'handlerProviderCallback']);
Route::get('/auth/redirect', [LoginController::class, 'redirectToProvider']);


Route::prefix('admin')
        ->middleware(['auth', 'admin'])
        ->group(function(){
            Route::get('/', [DashboardAdminController::class, 'index'])->name('dashboard-admin');

                Route::resource('sliders', SlidersController::class);
                Route::resource('category', CategoryController::class);
                Route::resource('seller', SellerController::class);
                Route::resource('user', UserController::class);
        });

Route::prefix('seller')
        ->middleware(['auth', 'seller'])
        ->group(function(){
                Route::get('/', [DashboardSellerController::class, 'index'])->name('dashboard-seller');
                Route::resource('products', ProductController::class);
                Route::resource('products-galleries', ProductGalleryController::class);
});

Route::prefix('user')
        ->middleware(['auth', 'user'])
        ->group(function(){
            Route::get('/', [DashboardUserController::class, 'index'])->name('dashboard-user');
});

Auth::routes();
