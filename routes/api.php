<?php

use App\Http\Controllers\BuyerController;
use App\Http\Controllers\BuyerTransctionController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\SellerProductController;
use App\Http\Controllers\TransactionCategoryController;
use App\Http\Controllers\TransactionsController;
use App\Http\Controllers\TransactionSellerController;
use App\Http\Controllers\UserController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->name('api.v1.')->group(function () {
    Route::resource('users', UserController::class);
    Route::resource('buyers', BuyerController::class);
    Route::resource('sellers', SellerController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('products', ProductsController::class);
    Route::resource('transactions', TransactionsController::class);
    Route::resource('transactions.categories', TransactionCategoryController::class);
    Route::resource('transactions.seller',TransactionSellerController::class);
    Route::resource('seller.products', SellerProductController::class);
    Route::resource('buyers.transactions', BuyerTransctionController::class);



//    ->only(['index', 'show', 'create', 'store']);

});



