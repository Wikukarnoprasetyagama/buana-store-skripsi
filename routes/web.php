<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SlidersController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Seller\SellerDashboardController;
use App\Http\Controllers\User\UserDashboardController;
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

Route::get('/', [HomeController::class, 'index'])->name('home');


Route::prefix('admin')
        ->middleware(['auth', 'admin'])
        ->group(function(){
            Route::get('/', [DashboardController::class, 'index'])->name('dashboard-admin');

                Route::resource('sliders', SlidersController::class);
                Route::resource('category', CategoryController::class);
        });

Route::prefix('seller')
        ->middleware(['auth', 'seller'])
        ->group(function(){
            Route::get('/', [SellerDashboardController::class, 'index'])->name('dashboard-seller');
});

Route::prefix('user')
        ->middleware(['auth', 'user'])
        ->group(function(){
            Route::get('/', [UserDashboardController::class, 'index'])->name('dashboard-user');
});

Auth::routes();
