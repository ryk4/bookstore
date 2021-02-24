<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\BookController;


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
//Route::get('api/v1/books/{book}/comments');
//Route::post('api/v1/books/{book}/comments');
//
//Route::get('api/v1/books/{book}/ratings');
//Route::post('api/v1/books/{book}/ratings');



