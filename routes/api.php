<?php

use App\Http\Controllers\Mobile\AuthController;
use App\Http\Controllers\Mobile\CategoryController;
use App\Http\Controllers\Mobile\OrderController;
use App\Http\Controllers\Mobile\ProductController;
use Illuminate\Http\Request;
use App\Models\User;
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
Route::post('/register',[AuthController::class,'store']);
Route::post('/login',[AuthController::class,'login']);
Route::get('/test',[AuthController::class,'index']);
Route::get('/categories',[CategoryController::class,'index']);
Route::get('/products',[ProductController::class,'index']);
Route::get('/products/{category}',[ProductController::class,'showProducts']);

Route::prefix('orders')->name('dashboard.orders.')->group(function () {
    Route::get('/', [OrderController::class, 'index'])->name('index');
    Route::post('/', [OrderController::class, 'store'])->name('store')->middleware('auth:sanctum');
    Route::match(['put', 'patch'],'/complete-order{order}', [OrderController::class, 'completeOrder'])->name('complete-order');
    Route::get('/{order}', [OrderController::class, 'show'])->name('show');
    // Route::get('/edit/{product:slug}', [AllProductsController::class, 'edit'])->name('edit');
    // Route::delete('/{product}', [AllProductsController::class, 'destroy'])->name('destroy')->middleware('permission:view admin dashboard');
});

Route::middleware('auth:sanctum')->group(function(){
    Route::post('/logout',[AuthController::class,'destroy']);
});
