<?php

use App\Http\Controllers\Mobile\AuthController;
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



Route::middleware('auth:sanctum')->group(function(){
    Route::post('/logout',[AuthController::class,'destroy']);
});
