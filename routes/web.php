<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\SlidersController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\DashboardAdminController;
use App\Http\Controllers\Admin\SellerController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Seller\DashboardSellerController;
use App\Http\Controllers\Admin\ProductAdminController;
use App\Http\Controllers\Admin\ProductGalleriesController;
use App\Http\Controllers\Admin\ProfileAdminController;
use App\Http\Controllers\Admin\TransactionsController;
use App\Http\Controllers\Admin\VerificationController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryProductsController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\Seller\ProductGalleryController;
use App\Http\Controllers\Seller\ProductSellerController;
use App\Http\Controllers\Customer\DashboardCustomerController;
use App\Http\Controllers\Customer\OpenStoreController;
use App\Http\Controllers\DetailProductsController;
use App\Http\Controllers\RewardsController;
use App\Http\Controllers\Seller\TransactionSellerController;
use App\Http\Controllers\TransactionController;
use App\Models\Cart;

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
Route::get('/semua-kategori-produk', [CategoryProductsController::class, 'index'])->name('all-category');
Route::get('/detail-produk/{slug}', [DetailProductsController::class, 'index'])->name('detail');
Route::get('/penghargaan', [RewardsController::class, 'index'])->name('reward');
Route::post('/details/{id}', [DetailProductsController::class, 'add'])->name('detail-add');
Route::get('/payment/success', [CheckoutController::class, 'callback']);
Route::post('/payment/success', [CheckoutController::class, 'callback']);

//Google
Route::get('/auth/callback', [LoginController::class, 'handlerProviderCallback']);
Route::get('/auth/redirect', [LoginController::class, 'redirectToProvider']);


// midtrans
Route::post('/checkout/callback', [CheckoutController::class, 'callback'])->name('midtrans-callback');

Route::prefix('/pages/dashboard/admin')
        ->middleware(['auth', 'admin'])
        ->group(function(){
                Route::get('/', [DashboardAdminController::class, 'index'])->name('dashboard-admin');
                Route::post('/product/admin/upload', [ProductAdminController::class, 'uploadGallery'])->name('upload-product-gallery');
                Route::get('/pages/admin/transaksi-seller', [TransactionsController::class, 'index'])->name('transaction-seller');

                Route::resource('upload', ProductGalleriesController::class);
                Route::resource('sliders', SlidersController::class);
                Route::resource('category', CategoryController::class);
                Route::resource('seller', SellerController::class);
                Route::resource('products-admin', ProductAdminController::class);
                Route::resource('customer', CustomerController::class);
                Route::resource('profile', ProfileAdminController::class);
                Route::resource('verification', VerificationController::class);
        });

Route::prefix('/pages/dashboard/seller')
        ->middleware(['auth', 'seller'])
        ->group(function(){
                Route::get('/', [DashboardSellerController::class, 'index'])->name('dashboard-seller');
                Route::resource('products-seller', ProductSellerController::class);
                Route::resource('transaction-seller', TransactionSellerController::class);
});

Route::prefix('/pages/dashboard/customer')
        ->middleware(['auth', 'customer'])
        ->group(function(){
            Route::get('/', [DashboardCustomerController::class, 'index'])->name('dashboard-customer');
            Route::resource('open-store', OpenStoreController::class);
});


Route::group(['middleware' => ['auth']], function(){
        // Route::get('/keranjang/pembayaran', [CartController::class, 'payout'])->name('cart-payout');
        Route::get('/keranjang', [CartController::class, 'index'])->name('cart');
        Route::post('/keranjang', [CartController::class, 'updateQuantity'])->name('cart-update');
        Route::delete('/cart/{id}', [CartController::class, 'delete'])->name('cart-delete');
        Route::post('/checkout', [CheckoutController::class, 'process'])->name('checkout');
        Route::get('/transaksi', [TransactionController::class, 'index'])->name('transaction');
});
Auth::routes();
