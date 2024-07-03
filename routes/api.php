<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\CardlistController;
use App\Http\Controllers\DetailforController;
use App\Http\Controllers\DetailpayController;
use App\Http\Controllers\EditController;
use App\Http\Controllers\GetsellproductController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\NavbarController;
use App\Http\Controllers\PaymentformController;
use App\Http\Controllers\PayproductdetailController;
use App\Http\Controllers\ProductcardController;
use App\Http\Controllers\ProductcardlistController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductlinkController;
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
Route::middleware(['auth:sanctum'])->get('productcard', [ProductcardController::class, 'productcard']);
Route::middleware(['auth:sanctum'])->get('productcardlist', [ProductcardlistController::class, 'Productcardlist']);
Route::middleware(['auth:sanctum'])->get('/productlink', [ProductlinkController::class, 'productlink']);
Route::post('address', [AddressController::class, 'address']);
Route::get('/detailfor/{category_id}', [DetailforController::class, 'detailfor']);
Route::middleware(['auth:sanctum'])->post('/transactions/initialize', [DetailpayController::class, 'initializeTransaction']);
Route::get('/paydetailproduct/{id}', [PayproductdetailController::class, 'paydetail']);