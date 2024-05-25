<?php

use App\Http\Controllers\Api\ApiLoginController;
use App\Http\Controllers\Api\ProductController;
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


Route::POST('login',[ApiLoginController::class,'login']);


Route::middleware('auth:sanctum')->group(function () {
    Route::POST('update/fcm',[ApiLoginController::class,'update_token']);
    Route::get('/get_category',[ProductController::class, 'category']); 
    Route::POST('/getProductByCategory',[ProductController::class, 'getProductsByCategory']);
    Route::get('/getProductDetails/{id}' , [ProductController::class ,'getProductDetails']);

});

Route::get('/user', function (Request $request) {
    return $request->user();

});
