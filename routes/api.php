<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\MainController;
use \App\Http\Controllers\Api\AuthController;
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



Route::group(['prefix' => 'v1'],function(){
    Route::get('settings',[MainController::class,'settings']);
    Route::get('governorates',[MainController::class,'governorates']);
    Route::get('cities',[MainController::class,'cities']);
    Route::post('register',[AuthController::class,'register']);
    Route::post('login',[AuthController::class,'login']);
    Route::post('reset-password',[AuthController::class,'ResetPassword']);
    Route::post('new-password',[AuthController::class,'password']);
    Route::group(['middleware' => 'auth:api'],function(){
        Route::post('profile',[MainController::class,'profile']);
        Route::post('posts',[MainController::class,'posts']);
        Route::post('post-favourite',[MainController::class,'postFavourite']);
        Route::post('my-favourites',[MainController::class,'myFavourites']);
        Route::post('donation-request/create',[MainController::class,'donationRequestCreate']);
        Route::post('contacts/create',[MainController::class,'contacts']);
    });
});
