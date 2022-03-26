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

Route::apiResource('/buyers', 'Buyer\BuyerController', ['only' => ['index', 'show']]);
Route::apiResource('/users', 'User\UserController', ['except' => ['create', 'edit']]);
Route::apiResource('/categories', 'Category\CategoryController', ['only' => ['index', 'show']]);
Route::apiResource('/products', 'Product\ProductController', ['only' => ['index', 'show']]);
Route::apiResource('/sellers', 'Seller\SellerController', ['only' => ['index', 'show']]);
Route::apiResource('/transactions', 'Transaction\TransactionController', ['except' => ['create', 'edit']]);


