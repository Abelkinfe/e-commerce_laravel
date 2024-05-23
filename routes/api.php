<?php

use App\Http\Controllers\CardlistController;
use App\Http\Controllers\EditController;
use App\Http\Controllers\GetsellproductController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\NavbarController;
use App\Http\Controllers\PaymentformController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\User;
use App\Http\Controllers\UserAuth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Content;
use App\Http\Controllers\Register;

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

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('register', [Register::class, 'register']);
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout']);
Route::middleware(['auth:sanctum'])->put('/edit', [EditController::class, 'update']);
Route::middleware(['auth:sanctum'])->post('sellproduct', [ProductController::class, 'store']);
Route::middleware(['auth:sanctum'])->get('getproduct', [GetsellproductController::class, 'getproducts']);
Route::middleware(['auth:sanctum'])->post('paymentform', [PaymentformController::class, 'paymentform']);
Route::get('/subcategory/{categoryId}', [SubcategoryController::class, 'subcategory']);
Route::get('/cardlist', [CardlistController::class, 'cardlist']);
