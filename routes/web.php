<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\Settings\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Settings\ApiTokenController;

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

require __DIR__ . '/auth.php';

Route::get('/', function () {
    return redirect()->route('books.index');
});

Route::group(['middleware' => 'checkRole:normal'], function () {
    Route::resource('books', \App\Http\Controllers\User\BookController::class)->only(
        ['create', 'store', 'edit', 'update', 'destroy']
    );

    Route::group(['prefix' => 'books', 'as' => 'books.'], function () {
        Route::get('/my-books', [\App\Http\Controllers\User\BookController::class, 'index'])->name('my-books.index');
        Route::post('/{book}/report', [BookController::class, 'report'])->name('report');
        Route::post('/search', [BookController::class, 'search'])->name('search');
    });
});

Route::resource('books', BookController::class)->only(['index', 'show']);

Route::group(['prefix' => 'user/', 'as' => 'user.', 'middleware' => 'checkRole:normal'], function () {
    Route::resource('settings', UserController::class)->only(['index', 'update']);
    Route::resource('api-settings', ApiTokenController::class)->only(['index', 'store']);
});

Route::group(['prefix' => 'admin/books', 'as' => 'admin.', 'middleware' => 'checkRole:admin'], function () {
    Route::get('/', [\App\Http\Controllers\Admin\BookController::class, 'index'])->name('books.index');
    Route::post('/{book}/approve', [\App\Http\Controllers\Admin\BookController::class, 'approve'])->name(
        'books.approve'
    );
});



