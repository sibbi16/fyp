<?php

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
        Route::get('/', [WarehousesController::class, 'index'])->name('index')->middleware('permission:view admin dashboard');
        Route::get('/create', [WarehousesController::class, 'create'])->name('create')->middleware('permission:view admin dashboard');
        Route::post('/', [WarehousesController::class, 'store'])->name('store');
        Route::get('/{warehouse:warehouse_name}', [WarehousesController::class, 'show'])->name('show');
        Route::get('/{warehouse:warehouse_name}/edit', [WarehousesController::class, 'edit'])->name('edit');
        Route::match(['put', 'patch'],'/{warehouse:warehouse_name}', [WarehousesController::class, 'update'])->name('update');
        Route::delete('/{warehouse:name}', [WarehousesController::class, 'destroy'])->name('destroy')->middleware('permission:delete user profile');;
    });
});


require __DIR__.'/auth.php';
