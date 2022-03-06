<?php

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
});


require __DIR__.'/auth.php';
