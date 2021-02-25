<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BookController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\RatingController;

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

Route::get('books',[BookController::class,'index']);
Route::get('books/{book}',[BookController::class,'show']);
//
Route::get('books/{book}/comments',[CommentController::class,'index']);
Route::post('books/{book}/comments',[CommentController::class,'store'])->middleware('auth:sanctum');
//
Route::get('books/{book}/ratings',[RatingController::class,'index']);
Route::post('books/{book}/ratings',[RatingController::class, 'store'])->middleware('auth:sanctum');



