<?php

use App\Http\Controllers\CatalogueController;
use App\Http\Controllers\PreuebaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ShoppingCart\ShoppingCartController;
use App\Http\Controllers\ShoppingCart\ShoppingCartProductController;

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

/*
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
*/

Route::resource('shopping-carts', 'ShoppingCart\ShoppingCartController', ['only' => [
    'index',
    'show'
]]);

Route::get('shopping-carts-totals/{shoppingCart}', [ShoppingCartController::class, 'totals'])
    ->name('shopping-carts.totals');

Route::resource('shopping-carts.products', 'ShoppingCart\ShoppingCartProductController', ['only' => [
    'index',
    'update',
    'destroy'
]]);

Route::post('shopping-carts/{shoppingCart}/products/{product}', [ShoppingCartProductController::class, 'store'])
    ->name('shopping-carts.products.store');

Route::resource('products', 'Product\ProductController', ['only' => ['index']]);

Route::resource('categories.products', 'Category\CategoryProductController', ['only' => [
    'store'
]]);

Route::get('catalogue/', [CatalogueController::class, 'index'])->name('catalogue');

Route::resource('shopping-carts.transactions', 'ShoppingCart\ShoppingCartTransactionController', ['only' => 'store']);

Route::resource('categories', 'Category\CategoryController', ['only' => [
    'index',
    'show'
]]);
