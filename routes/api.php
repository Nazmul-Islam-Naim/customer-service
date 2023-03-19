<?php

use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//Authentication
Route::group(['prefix'=>'auth'],function(){
    Route::post('/register',[UserController::class,'register']);
    Route::post('/login',[UserController::class,'login']);
    Route::group(['middleware'=>['auth:api']],function(){
        Route::post('/profile',[UserController::class,'profile']);
        Route::put('/update',[UserController::class,'update']);
        Route::post('/logout',[UserController::class,'logout']);

        Route::apiResource('customers',CustomerController::class);
    });
});

