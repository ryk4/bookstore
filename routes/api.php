<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BookController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\RatingController;
use App\Http\Controllers\Api\UserControlller;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//User API
Route::get('/user/status',[UserControlller::class,'status'])
    ->middleware('auth:sanctum');; //is this good for validating in Vue if user isLoggedIn ???

//Book
Route::group(['prefix' => 'books'],function(){
    Route::get('/',[BookController::class,'index']);
    Route::get('/{book}',[BookController::class,'show']);

    Route::get('{book}/comments',[CommentController::class,'index']);
    Route::get('{book}/ratings',[RatingController::class,'index']);

    Route::group(['middleware' => 'auth:sanctum'],function(){
        Route::post('{book}/comments',[CommentController::class,'store']);
        Route::post('{book}/ratings',[RatingController::class, 'store']);
    });
});



