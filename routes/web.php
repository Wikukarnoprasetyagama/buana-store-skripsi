<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\SlidersController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\DashboardAdminController;
use App\Http\Controllers\Admin\MembersController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\ProductAdminController;
use App\Http\Controllers\Admin\ProductGalleriesController;
use App\Http\Controllers\Admin\ProfileAdminController;
use App\Http\Controllers\Admin\TransactionAdminController;
use App\Http\Controllers\Admin\VerificationController;
use App\Http\Controllers\AllProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryProductsController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\Member\OpenStoreController;
use App\Http\Controllers\DetailProductsController;
use App\Http\Controllers\Member\DashboardController;
use App\Http\Controllers\Member\MyTransactionController;
use App\Http\Controllers\Member\PdfCustomerController;
use App\Http\Controllers\Member\ProductController;
use App\Http\Controllers\Member\ProfileCustomerController;
use App\Http\Controllers\Member\ProfileSellerController;
use App\Http\Controllers\Member\TransactionCustomerController;
use App\Http\Controllers\Member\TransactionSellerController;
use App\Http\Controllers\RewardsController;
use App\Http\Controllers\TransactionController;

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
Route::get('/semua-produk', [AllProductController::class, 'index'])->name('all-product');
Route::get('/detail-produk/{slug}', [DetailProductsController::class, 'index'])->name('detail');
Route::get('/hadiah', [RewardsController::class, 'index'])->name('reward');
Route::post('/details/{id}', [DetailProductsController::class, 'add'])->name('detail-add');
Route::get('/kategori/{id}', [CategoryProductsController::class, 'detail'])->name('categories-detail');
// Route::get('/payment/success', [CheckoutController::class, 'callback']);
Route::post('/payment/success', [CheckoutController::class, 'callback']);
Route::get('/debug-sentry', function () {
    throw new Exception('My first Sentry error!');
});
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
                Route::get('/cetak-laporan-transaksi', [TransactionAdminController::class, 'print_transaction'])->name('pdf-transaction');

                Route::resource('upload', ProductGalleriesController::class);
                Route::resource('sliders', SlidersController::class);
                Route::resource('category', CategoryController::class);
                Route::resource('member', MembersController::class);
                Route::resource('products-admin', ProductAdminController::class);
                Route::resource('customer', CustomerController::class);
                Route::resource('profile', ProfileAdminController::class);
                Route::resource('verification', VerificationController::class);
                Route::resource('transaction-member', TransactionAdminController::class);
        });

// seller
Route::prefix('/pages/dashboard/seller')
        ->middleware(['auth', 'seller'])
        ->group(function(){
                Route::get('/', [DashboardController::class, 'index'])->name('dashboard-seller');
                Route::get('/pages/dashboard/seller/products-seller/checkSlug', [ProductController::class, 'checkSlug']);
                Route::get('/cetak-laporan-transaksi', [TransactionSellerController::class, 'cetak_pdf'])->name('pdf-transaction-seller');
                Route::get('/cetak-laporan-transaksi-saya', [TransactionSellerController::class, 'my_pdf'])->name('pdf-my-transaction');
                Route::get('/pages/dashboard/seller/product-seller/delete/{id}', [ProductController::class, 'deleteGallery'])->name('delete-gallery-product');
                Route::get('/pages/dashboard/seller/product-seller/{id}', [ProductController::class, 'edit'])->name('gallery-product');
                Route::post('/pages/dashboard/seller/products-seller/upload', [ProductController::class, 'uploadGallery'])->name('update-product-gallery');

                Route::resource('products-seller', ProductController::class);
                Route::resource('transaction-seller', TransactionSellerController::class);
                Route::resource('my-transaction', MyTransactionController::class);
                Route::resource('profile-seller', ProfileSellerController::class);
});

// customer
Route::prefix('/pages/dashboard/customer')
        ->middleware(['auth', 'customer'])
        ->group(function(){
            Route::get('/', [DashboardController::class, 'index'])->name('dashboard-customer');
            Route::get('/cetak-laporan-transaksi', [TransactionCustomerController::class, 'cetak_pdf'])->name('pdf-transaction-customer');
            Route::resource('open-store', OpenStoreController::class);
            Route::resource('transaction-customer', TransactionCustomerController::class);
            Route::resource('profile-customer', ProfileCustomerController::class);
});


Route::group(['middleware' => ['auth']], function(){
        Route::get('/keranjang', [CartController::class, 'index'])->name('cart');
        Route::post('/keranjang', [CartController::class, 'updateQuantity'])->name('cart-update');
        Route::delete('/cart/{id}', [CartController::class, 'delete'])->name('cart-delete');
        Route::post('/checkout', [CheckoutController::class, 'process'])->name('checkout');
});
Auth::routes();
