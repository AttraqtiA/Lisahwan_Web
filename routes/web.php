<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\Owner\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use App\Http\Controllers\Member\CartController as MemberCartController;
use App\Http\Controllers\Owner\OrderController as OwnerOrderController;
use App\Http\Controllers\Member\OrderController as MemberOrderController;
use App\Http\Controllers\Owner\ProductController as OwnerProductController;
use App\Http\Controllers\Member\ProductController as MemberProductController;
use App\Http\Controllers\Member\WishlistController as MemberWishlistController;
use App\Http\Controllers\Member\TestimonyController as MemberTestimonyController;

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


//====================================== BISA DIAKSES SEMUA ROLE ======================================
Route::get('/', [ProductController::class, 'home']); // HOME PAGE (CHECKED)
Route::get('/products', [ProductController::class, 'index'])->name('products'); // PRODUCTS PAGE (CHECKED)
Route::get('/gallery', [GalleryController::class, 'index']); // GALLERY PAGE (CHECKED)
Route::get('/contactus', function () {
    $data = [
        "TabTitle" => "Kontak Lisahwan",
        "active_4" => "text-yellow-500 rounded md:bg-transparent md:p-0",
    ];
    return view('contact', $data);
});// CONTACT PAGE (CHECKED)
//=====================================================================================================


//=================================== BISA DIAKSES ROLE ADMIN SAJA ===================================
Route::group([
    'middleware' => 'admin',
    'prefix' => 'admin',
    'as' => 'admin.'
], function () {
    Route::get('/admin', [AdminOrderController::class, 'index'])->name('admin');
    Route::put('/admin/update/{order}', [AdminOrderController::class, 'updateToday'])->name('admin.update');

    Route::get('/order_history', [AdminOrderController::class, 'history'])->name('order_history');
    Route::put('/order_history/update/{order}', [AdminOrderController::class, 'updateHistory'])->name('order_history.update');
});
//====================================================================================================


//=================================== BISA DIAKSES ROLE MEMBER SAJA ===================================
Route::group([
    'middleware' => 'member',
    'prefix' => 'member',
    'as' => 'member.'
], function () {
    Route::get('/products/{product_id}', [MemberProductController::class, 'show'])->name('products.show'); // ORDERDETAIL PAGE (CHECKED)

    Route::post('/carts/add/{product_id}', [MemberCartController::class, 'store'])->name('carts.add'); // INSERT TO CART (CHECKED)
    Route::delete('/carts/delete/{cartdetail_id}', [MemberCartController::class, 'destroy'])->name('carts.destroy'); // DELETE CART (CHECKED)
    Route::get('/carts/edit/{product_id}', [MemberCartController::class, 'edit'])->name('carts.edit'); // EDIT CART (CHECKED)
    Route::patch('/carts/update/{product_id}', [MemberCartController::class, 'update'])->name('carts.update'); // UPDATE CART (CHECKED)

    Route::get('/checkout', [MemberOrderController::class, 'index'])->name('checkout'); // CHECKOUT PAGE (CHECKED)
    Route::post('/checkout/payment', [MemberOrderController::class, 'store'])->name('checkout.store'); // CREATE ORDER (CHECKED)
    Route::get('/orderhistory', [MemberOrderController::class, 'show_orderhistory'])->name('orderhistory'); // ORDER HISTORY PAGE (CHECKED)
    Route::patch('/orderhistory/{order_id}', [MemberOrderController::class, 'update'])->name('orderhistory.update'); // CHANGE ACCEPT_BY_CUSTOMER STATUS (CHECKED)

    Route::post('/testimony/{product_id}', [MemberTestimonyController::class, 'store'])->name('testimony.store'); // CREATE TESTIMONY (CHECKED)
    Route::patch('/testimony/{product_id}', [MemberTestimonyController::class, 'update'])->name('testimony.update'); // UPDATE TESTIMONY (CHECKED)
    Route::delete('/testimony/{testimony_id}', [MemberTestimonyController::class, 'destroy'])->name('testimony.destroy'); // UPDATE TESTIMONY (CHECKED)

    Route::get('/wishlist', [MemberWishlistController::class, 'index'])->name('wishlist'); // WISHLIST PAGE (CHECKED)
    Route::post('/wishlist/{product_id}', [MemberWishlistController::class, 'store'])->name('wishlist.store'); // INSERT PRODUCT TO WISHLIST (CHECKED)
});
//=====================================================================================================


//=================================== BISA DIAKSES ROLE OWNER SAJA ====================================
Route::group([
    'middleware' => 'owner',
    'prefix' => 'owner',
    'as' => 'owner.'
], function () {
    Route::get('/admin', [OwnerOrderController::class, 'index'])->name('admin');
    Route::put('/admin/update/{order}', [OwnerOrderController::class, 'updateToday'])->name('admin.update');

    Route::get('/order_history', [OwnerOrderController::class, 'history'])->name('order_history');
    Route::put('/order_history/update/{order}', [OwnerOrderController::class, 'updateHistory'])->name('order_history.update');

    Route::get('/admin_products', [OwnerProductController::class, 'admin_products'])->name('admin_products');
    Route::post('/admin_products', [OwnerProductController::class, 'store'])->name('admin_products.store');
    Route::get('/admin_products/detail/{product}', [OwnerProductController::class, 'detail'])->name('admin_products.detail');
    Route::put('/admin_products/update/{product}', [OwnerProductController::class, 'update'])->name('admin_products.update');
    Route::put('/admin_products/updateImage/{product}', [OwnerProductController::class, 'updateImage'])->name('admin_products.updateImage');
    Route::put('/admin_products/addStock/{product}', [OwnerProductController::class, 'addStock'])->name('admin_products.addStock');
    Route::delete('/admin_products/destroy/{product}', [OwnerProductController::class, 'destroy'])->name('admin_products.destroy');

    Route::get('/admin_users', [UserController::class, 'index'])->name('admin_users');
});
//====================================================================================================


Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
