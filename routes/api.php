<?php

use App\Http\Controllers\BuyerController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\TransactionsController;
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
   Route::resource('buyers', BuyerController::class);
   Route::resource('sellers', SellerController::class);
   Route::resource('categories', CategoriesController::class);
   Route::resource('products', ProductsController::class);
   Route::resource('transactions', TransactionsController::class);

//    ->only(['index', 'show', 'create', 'store']);

});
