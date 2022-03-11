<?php

use App\Http\Controllers\UserController;
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
});


require __DIR__.'/auth.php';
