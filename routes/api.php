<?php

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('/register',[UserController::class,'register']);
Route::post('/login',[UserController::class,'login']);

Route::group(['middleware' => 'auth:sanctum'],function(){
    Route::get('/logout',[UserController::class,'logout']);
    Route::get('/me',[UserController::class,'me']);

});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
