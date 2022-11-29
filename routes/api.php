<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('/register',[UserController::class,'register']);
Route::post('/login',[UserController::class,'login']);

Route::group(['middleware' => 'auth:sanctum'],function(){
    Route::get('/logout',[UserController::class,'logout']);
    Route::get('/me',[UserController::class,'me']);
    Route::get('/checkIslogged',[UserController::class,'checkIslogged']);
});

//admin routes
Route::middleware(['auth:sanctum','isAdmin'])->group(function(){
    Route::get('/checkIsAdmin',[UserController::class,'isAdmin']);
   
    //category routing
    Route::group(['prefix' => 'category'],function(){
        Route::post('/store',[CategoryController::class,'store']);
        Route::put('/update',[CategoryController::class,'update']);
        Route::get('/',[CategoryController::class,'index']);
        Route::delete('/{id}',[CategoryController::class,'destroy']);
    });

});


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
