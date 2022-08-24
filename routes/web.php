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

    Route::get('/my-books', [BookController::class, 'userBooks'])->name('my-books.index');
    Route::post('/{book}/report', [BookController::class, 'report'])->name('book.report');
    Route::post('/search', [BookController::class, 'search'])->name('books.search');
});

Route::resource('books', BookController::class)->only(['index', 'show']);

Route::group(['prefix' => 'user/settings', 'middleware' => 'checkRole:normal'], function () {
    Route::get('/', [UserController::class, 'index'])->name('user.index');
    Route::put('/', [UserController::class, 'update'])->name('user.update');
    Route::get('/api', [ApiController::class, 'show'])->name('api.show');
    Route::post('/api', [ApiController::class, 'store'])->name('api.store');
});

Route::group(['prefix' => 'admin/books', 'middleware' => 'checkRole:admin'], function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.book.index');
    Route::get('/manage', [AdminController::class, 'manage_menu_admin'])->name('manage_menu_admin');
    Route::put('/{book}/approve', [AdminController::class, 'approve'])->name('admin.book.approve');
});



