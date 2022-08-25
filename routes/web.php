<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\Book\CommentController;
use App\Http\Controllers\Book\RatingController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\ApiController;

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
    Route::resource('books', BookController::class)->only(['create', 'store', 'edit', 'update', 'destroy']);

    Route::group(['prefix' => 'books', 'as' => 'books.'], function () {
        Route::get('/my-books', [\App\Http\Controllers\User\BookController::class, 'index'])->name('my-books.index');
        Route::post('/{book}/report', [BookController::class, 'report'])->name('report');
        Route::post('/search', [BookController::class, 'search'])->name('search');
    });
});

Route::resource('books', BookController::class)->only(['index', 'show']);

Route::group(['prefix' => 'user/settings', 'middleware' => 'checkRole:normal'], function () {
    Route::get('/', [UserController::class, 'index'])->name('user.index');
    Route::put('/', [UserController::class, 'update'])->name('user.update');
    Route::get('/api', [ApiController::class, 'show'])->name('api.show');
    Route::post('/api', [ApiController::class, 'store'])->name('api.store');
});

Route::group(['prefix' => 'admin/books', 'middleware' => 'checkRole:admin'], function () {
    Route::get('/', [\App\Http\Controllers\Admin\BookController::class, 'index'])->name('admin.books.index');
    Route::post('/{book}/approve', [\App\Http\Controllers\Admin\BookController::class, 'approve'])->name(
        'admin.books.approve'
    );
});



