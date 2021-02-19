<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\Book\CommentController;
use App\Http\Controllers\Book\RatingController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Admin\AdminController;
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




//API
/*
 *
 * To be added later as it will cause code duplication between api and UI functions. The actual logic would
 * need to be moved elsewhere, then both UI and API controllers would be referencing that logic.
 *
 * Not sure of the best way to do this yet, so will only get to do it, once everything else is completed.
 *
 */


require __DIR__.'/auth.php';

Route::GET('/', [BookController::class, 'index'])->name('book.index');//will be default/starting page


//Book
Route::group(['prefix' => 'book'],function(){
    Route::group(['middleware' => 'checkRole:normal'], function(){
        Route::POST('/', [BookController::class, 'store'])->name('book.store');
        Route::GET('/create', [BookController::class, 'create'])->name('book.create');
        Route::GET('/manage', [BookController::class, 'manageMenu'])->name('booksManageMenu');
        Route::GET('/{id}/edit', [BookController::class, 'edit'])->name('book.edit');
        Route::PUT('/{book}', [BookController::class, 'update'])->name('book.update');
        Route::DELETE('/{id}', [BookController::class, 'destroy'])->name('book.destroy');

        //Book ratings and comments
        Route::POST('/{book}/rating', [RatingController::class, 'store'])->name('book.rating.store');
        Route::POST('/{book}/comment', [CommentController::class, 'store'])->name('book.comment.store');
    });

    Route::GET('/{id}', [BookController::class,'show'])->name('book.show');
    Route::POST('/search', [BookController::class, 'search'])->name('book.search');
});

//User (including admins)
Route::group(['prefix' => 'user/settings','middleware' => 'checkRole:normal'],function(){
    Route::GET('/', [UserController::class, 'index'])->name('user.index');
    Route::PUT('/{user}', [UserController::class, 'update'])->name('user.update');
});

//Admin
Route::group(['prefix' => 'admin/books','middleware' => 'checkRole:admin'],function(){
    Route::GET('/', [AdminController::class, 'index'])->name('admin.book.index');
    Route::GET('/manage', [AdminController::class, 'manage_menu_admin'])->name('manage_menu_admin');
    Route::PUT('/{book}/approve', [AdminController::class, 'approve'])->name('admin.book.approve');
});



