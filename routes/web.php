<?php

use Illuminate\Support\Facades\Route;
use AvtoDev\JsonRpc\RpcRouter;
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

/** Routes for login, logout, register */
Auth::routes();
/** WEB routes get, post, ... */
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/shop', [App\Http\Controllers\ShopController::class, 'list'])->middleware(['auth'])->name('shop');
Route::get('/product/{slug}', [App\Http\Controllers\ShopController::class, 'product'])->name('product.show');
Route::get('/cart', [App\Http\Controllers\CartController::class, 'index'])->name('cart.show');
Route::get('/cart/add/{pid}', [App\Http\Controllers\CartController::class, 'add'])->name('cart.addLink');
Route::get('/cart/delete', [App\Http\Controllers\CartController::class, 'emptyCart'])->name('cart.delete');
Route::get('/checkout', [App\Http\Controllers\CheckoutController::class, 'checkout'])->name('checkout');
Route::get('/orders', [App\Http\Controllers\OrderController::class, 'list'])->name('orders');
Route::get('/checkout/success/{orderId}', [App\Http\Controllers\CheckoutController::class, 'checkoutSuccess'])->name('checkout.success');
Route::get('/invoice/{orderId}', [App\Http\Controllers\CheckoutController::class, 'getInvoice'])->name('getInvoice');
Route::post('/checkout', [App\Http\Controllers\CheckoutController::class, 'pay'])->name('pay');

/** Register /rpc route */
Route::post('/rpc', 'AvtoDev\JsonRpc\Http\Controllers\RpcController')
    ->middleware(['isAuthorized'])
    ->name('rpc');
/** RPC Routes */
RpcRouter::on('sum_array_values', 'App\Http\Controllers\Rpc\JsonRpcController@_sum');
RpcRouter::on('show_full_request', 'App\Http\Controllers\Rpc\JsonRpcController@_showInfo');
RpcRouter::on('getProducts', 'App\Http\Controllers\Rpc\JsonRpcController@_list');
RpcRouter::on('getProduct', 'App\Http\Controllers\Rpc\JsonRpcController@_byId');
RpcRouter::on('getCart', 'App\Http\Controllers\Rpc\JsonRpcController@_cart');
RpcRouter::on('getOrders', 'App\Http\Controllers\Rpc\JsonRpcController@_orders');
