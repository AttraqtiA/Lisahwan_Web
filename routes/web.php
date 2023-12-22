<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\TestimonyController;
use App\Http\Controllers\WishlistController;

use App\Http\Controllers\Owner\UserController;
use App\Http\Controllers\Owner\ProductController as OwnerProductController;
use App\Http\Controllers\Owner\OrderDetailController as OwnerOrderDetailController;
use App\Http\Controllers\Owner\OrderController as OwnerOrderController;

use App\Http\Controllers\Admin\OrderDetailController as AdminOrderDetailController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::get('/', [ProductController::class, 'best_seller']); // halaman HOME
Route::get('/products', [ProductController::class, 'index'])->name('products'); // halaman PRODUCTS
Route::get('/products/{product_id}', [ProductController::class, 'show']); // halaman ORDERDETAIL
Route::get('/gallery', [GalleryController::class, 'index']); // halaman Gallery

Route::view('/contactus', 'contact');

// Route::group([
//     'middleware' => 'member',
//     'prefix' => 'member',
//     'as' => 'member.'
// ], function (){

Route::post('/carts/add/{product_id}', [CartController::class, 'store']); // INSERT TO CART
Route::delete('/carts/delete/{cartdetail_id}', [CartController::class, 'destroy']); // DELETE CART
Route::get('/carts/edit/{product_id}', [CartController::class, 'edit']); // EDIT CART
Route::patch('/carts/update/{product_id}', [CartController::class, 'update']); // UPDATE CART

Route::get('/checkout', [OrderController::class, 'index']); // CHECKOUT PAGE
Route::post('/checkout/payment', [OrderController::class, 'store']); // CREATE ORDER
Route::get('/orderhistory', [OrderController::class, 'show_orderhistory']); // ORDER HISTORY PAGE
Route::patch('/orderhistory/{order_id}', [OrderController::class, 'update']); // CHANGE ACCEPT_BY_CUSTOMER STATUS

Route::post('/testimony/{product_id}', [TestimonyController::class, 'store']); // CREATE TESTIMONY
Route::patch('/testimony/{product_id}', [TestimonyController::class, 'update']); // UPDATE TESTIMONY
Route::delete('/testimony/{product_id}', [TestimonyController::class, 'destroy']); // UPDATE TESTIMONY]

Route::get('/wishlist', [WishlistController::class, 'index']); // WISHLIST PAGE
Route::post('/wishlist/{product_id}', [WishlistController::class, 'store']); // INSERT PRODUCT TO WISHLIST

// Kalau mau akses lewat link atas, ada 'prefix' yang perlu diinclude, kyk /!!owner!!/admin_products
Route::group([
    'middleware' => 'owner',
    'prefix' => 'owner',
    'as' => 'owner.'
], function () {
    // Route::get('/admin', [OwnerOrderDetailController::class, 'index'])->middleware('auth')->name('admin');
    Route::get('/admin', [OwnerOrderController::class, 'index'])->middleware('auth')->name('admin');
    Route::put('/admin/update/{order}', [OwnerOrderController::class, 'update'])->middleware('auth')->name('admin.update');

    Route::get('/order_history', [OwnerOrderController::class, 'history'])->middleware('auth')->name('order_history');
    Route::put('/order_history/update/{order}', [OwnerOrderController::class, 'update'])->middleware('auth')->name('order_history.update');

    Route::get('/admin_products', [OwnerProductController::class, 'admin_products'])->middleware('auth')->name('admin_products');
    Route::post('/admin_products', [OwnerProductController::class, 'store'])->middleware('auth')->name('admin_products.store');
    Route::get('/admin_products/detail/{product}', [OwnerProductController::class, 'detail'])->middleware('auth')->name('admin_products.detail');
    Route::put('/admin_products/update/{product}', [OwnerProductController::class, 'update'])->middleware('auth')->name('admin_products.update');
    Route::put('/admin_products/updateImage/{product}', [OwnerProductController::class, 'updateImage'])->middleware('auth')->name('admin_products.updateImage');
    Route::put('/admin_products/addStock/{product}', [OwnerProductController::class, 'addStock'])->middleware('auth')->name('admin_products.addStock');
    Route::delete('/admin_products/destroy/{product}', [OwnerProductController::class, 'destroy'])->middleware('auth')->name('admin_products.destroy');

    Route::get('/admin_users', [UserController::class, 'index'])->middleware('auth')->name('admin_users');
});

Route::group([
    'middleware' => 'admin',
    'prefix' => 'admin',
    'as' => 'admin.'
], function () {
    // Route::get('/admin', [AdminOrderDetailController::class, 'index'])->middleware('auth')->name('admin');
    Route::get('/admin', [AdminOrderController::class, 'index'])->middleware('auth')->name('admin');
    Route::put('/admin/update/{order}', [OwnerOrderController::class, 'update'])->middleware('auth')->name('admin.update');

    Route::get('/order_history', [AdminOrderController::class, 'history'])->middleware('auth')->name('order_history');
    Route::put('/order_history/update/{order}', [AdminOrderController::class, 'update'])->middleware('auth')->name('order_history.update');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
