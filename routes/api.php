<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::get('items',[\App\Http\Controllers\ItemsController::class,'getAllItems']);
Route::post('add-to-cart',[\App\Http\Controllers\CartController::class,'addToCart']);
Route::get('get-cart-items',[\App\Http\Controllers\CartController::class,'getCartItems']);
Route::delete('delete-cart-item/{cart_item_id}',[\App\Http\Controllers\CartController::class,'deleteCartItem']);
Route::post('update-cart-data',[\App\Http\Controllers\CartController::class,'updateCartData']);
Route::post('checkout', [\App\Http\Controllers\CheckoutController::class,'checkout']);
