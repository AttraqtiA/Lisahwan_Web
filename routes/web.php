<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;

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

Route::post('/carts/add/{product_id}', [CartController::class, 'store']); // INSERT TO CART
Route::delete('/carts/delete/{cartdetail_id}', [CartController::class, 'destroy']); // DELETE CART
Route::get('/carts/edit/{product_id}', [CartController::class, 'edit']); // EDIT CART
Route::patch('/carts/update/{product_id}', [CartController::class, 'update']); // UPDATE CART
Route::get('/checkout', [OrderController::class, 'index']); // CHECKOUT PAGE
Route::post('/checkout/payment', [OrderController::class, 'store']); // PAYMENT PAGE
Route::get('/orderhistory', [OrderController::class, 'show_orderhistory']); // ORDER HISTORY PAGE
Route::get('/products', [ProductController::class, 'index']); // PRODUCTS PAGE
Route::get('/products/{product_id}', [ProductController::class, 'show']); // ORDERDETAIL PAGE

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
