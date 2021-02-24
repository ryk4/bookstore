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

Route::get('/', [BookController::class, 'index'])->name('book.index');//will be default/starting page


//Book
Route::group(['prefix' => 'book'],function(){
    Route::group(['middleware' => 'checkRole:normal'], function(){
        Route::post('/', [BookController::class, 'store'])->name('book.store');
        Route::get('/create', [BookController::class, 'create'])->name('book.create');
        Route::get('/manage', [BookController::class, 'manageMenu'])->name('booksManageMenu');
        Route::get('/{id}/edit', [BookController::class, 'edit'])->name('book.edit');
        Route::put('/{book}', [BookController::class, 'update'])->name('book.update');
        Route::delete('/{id}', [BookController::class, 'destroy'])->name('book.destroy');
        Route::post('/{book}/report', [BookController::class, 'report'])->name('book.report');


        //Book ratings and comments
        Route::post('/{book}/rating', [RatingController::class, 'store'])->name('book.rating.store');
        Route::post('/{book}/comment', [CommentController::class, 'store'])->name('book.comment.store');
    });

    Route::get('/{id}', [BookController::class,'show'])->name('book.show');
    Route::post('/search', [BookController::class, 'search'])->name('book.search');
});

//User (including admins)
Route::group(['prefix' => 'user/settings','middleware' => 'checkRole:normal'],function(){
    Route::get('/', [UserController::class, 'index'])->name('user.index');
    Route::put('/', [UserController::class, 'update'])->name('user.update');
});

//Admin
Route::group(['prefix' => 'admin/books','middleware' => 'checkRole:admin'],function(){
    Route::get('/', [AdminController::class, 'index'])->name('admin.book.index');
    Route::get('/manage', [AdminController::class, 'manage_menu_admin'])->name('manage_menu_admin');
    Route::put('/{book}/approve', [AdminController::class, 'approve'])->name('admin.book.approve');
});



