<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WarehousesController;
use Illuminate\Support\Facades\Route;

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

// Route::name('website.')->group(function(){
//     Route::view('/', 'website.index')->name('index');
// });

Route::middleware(['auth'])->name('dashboard.')->group(function(){
    Route::view('/', 'dashboard.index')->name('index');
    Route::prefix('users')->name('users.')->group(function () {
        Route::get('/', [UserController::class, 'index'])->name('index')->middleware('permission:view admin dashboard');
        Route::get('/create', [UserController::class, 'create'])->name('create')->middleware('permission:view admin dashboard');
        Route::post('/', [UserController::class, 'store'])->name('store');
        Route::get('/{user:username}', [UserController::class, 'show'])->name('show');
        Route::get('/{user:username}/edit', [UserController::class, 'edit'])->name('edit');
        Route::match(['put', 'patch'],'/{user:username}', [UserController::class, 'update'])->name('update');
        Route::delete('/{user:username}', [UserController::class, 'destroy'])->name('destroy')->middleware('permission:delete user profile');;
    });
    Route::prefix('warehouses')->name('warehouses.')->group(function () {
        Route::get('/', [WarehousesController::class, 'index'])->name('index')->middleware('permission:view admin dashboard|view company dashboard');
        Route::get('/create', [WarehousesController::class, 'create'])->name('create')->middleware('permission:view admin dashboard|view company dashboard');
        Route::post('/', [WarehousesController::class, 'store'])->name('store');
        Route::get('/{warehouse:warehouse_name}', [WarehousesController::class, 'show'])->name('show');
        Route::get('/edit/{warehouse:warehouse_name}', [WarehousesController::class, 'edit'])->name('edit');
        Route::match(['put', 'patch'],'/{warehouse:warehouse_name}', [WarehousesController::class, 'update'])->name('update')->middleware('permission:view admin dashboard|view company dashboard');
        Route::delete('/{warehouse:warehouse_name}', [WarehousesController::class, 'destroy'])->name('destroy')->middleware('permission:view admin dashboard|view company dashboard');
             Route::prefix('products')->name('products.')->group(function () {
                Route::get('/{warehouse}', [ProductsController::class, 'index'])->name('index')->middleware('permission:view admin dashboard|view company dashboard');
                Route::get('/create/{warehouse}', [ProductsController::class, 'create'])->name('create')->middleware('permission:view admin dashboard|view company dashboard');
                Route::post('/', [ProductsController::class, 'store'])->name('store');
                Route::get('/{product:slug}', [ProductsController::class, 'show'])->name('show');
                Route::get('/edit/{product:slug}/{warehouse}', [ProductsController::class, 'edit'])->name('edit');
                Route::match(['put', 'patch'],'/{product:slug}', [ProductsController::class, 'update'])->name('update')->middleware('permission:view admin dashboard|view company dashboard');
                Route::delete('/{product}', [ProductsController::class, 'destroy'])->name('destroy')->middleware('permission:view admin dashboard|view company dashboard');
            });
    });
    Route::prefix('suppliers')->name('suppliers.')->group(function () {
        Route::get('/', [SupplierController::class, 'index'])->name('index')->middleware('permission:view admin dashboard|view company dashboard');
        Route::get('/create', [SupplierController::class, 'create'])->name('create')->middleware('permission:view admin dashboard|view company dashboard');
        Route::post('/', [SupplierController::class, 'store'])->name('store');
        Route::get('/{supplier:username}', [SupplierController::class, 'show'])->name('show');
        Route::get('/edit/{supplier:username}', [SupplierController::class, 'edit'])->name('edit');
        Route::match(['put', 'patch'],'/{supplier:username}', [SupplierController::class, 'update'])->name('update')->middleware('permission:view admin dashboard|view company dashboard');
        Route::delete('/{supplier}', [SupplierController::class, 'destroy'])->name('destroy')->middleware('permission:view admin dashboard|view company dashboard');
    });
    Route::prefix('category')->name('category.')->group(function () {
        Route::get('/', [CategoryController::class, 'index'])->name('index')->middleware('permission:view admin dashboard|view company dashboard');
        Route::get('/create', [CategoryController::class, 'create'])->name('create')->middleware('permission:view admin dashboard|view company dashboard');
        Route::post('/', [CategoryController::class, 'store'])->name('store');
        Route::get('/edit/{category:slug}', [CategoryController::class, 'edit'])->name('edit');
        Route::match(['put', 'patch'],'/{category:slug}', [CategoryController::class, 'update'])->name('update')->middleware('permission:view admin dashboard|view company dashboard');
        Route::delete('/{category}', [CategoryController::class, 'destroy'])->name('destroy')->middleware('permission:view admin dashboard|view company dashboard');
    });
});


require __DIR__.'/auth.php';
