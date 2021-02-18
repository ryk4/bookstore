<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\Book\CommentController;
use App\Http\Controllers\Book\RatingController;
use App\Http\Controllers\UserController;

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
 * RK
 * To be added later as it will cause code duplication between api and UI functions. The actual logic would
 * need to be moved elsewhere, then both UI and API controllers would be referencing that logic.
 *
 * Not sure of the best way to do this yet, so will only get to do it, once everything else is completed.
 *
 */



require __DIR__.'/auth.php';



//Book
Route::GET('/', [BookController::class, 'index'])->name('book.index');//will be default/starting page
Route::GET('/book/manage', [BookController::class, 'manageMenu'])->name('booksManageMenu')->middleware('auth');;
Route::POST('/book', [BookController::class, 'store'])->name('book.store');
Route::GET('/book/create', [BookController::class, 'create'])->name('book.create')->middleware('checkRole:normal');;
Route::GET('/book/{id}', [BookController::class,'show'])->name('book.show');
Route::GET('/book/{id}/edit', [BookController::class, 'edit'])->name('book.edit')->middleware('auth');;
Route::PUT('/book/{book}', [BookController::class, 'update'])->name('book.update')->middleware('auth');
Route::DELETE('/book/{id}', [BookController::class, 'destroy'])->name('book.destroy')->middleware('auth');

Route::POST('/search', [BookController::class, 'search'])->name('book.search');


//Book.Comment
Route::POST('/book/{book}/comment', [CommentController::class, 'store'])->name('book.comment.store');

//Book.rating
Route::POST('/book/{book}/rating', [RatingController::class, 'store'])->name('book.rating.store');


//Users (including admins)
Route::GET('/user/settings', [UserController::class, 'index'])->name('user.index')->middleware('auth');;
Route::PUT('/user/settings/{user}', [UserController::class, 'update'])->name('user.update')->middleware('auth');;


//Admin
Route::GET('/admin/books', [\App\Http\Controllers\Admin\AdminController::class, 'index'])->name('admin.book.index')->middleware('checkRole:admin');
Route::PUT('/admin/books/{book}/approve', [\App\Http\Controllers\Admin\AdminController::class, 'approve'])->name('admin.book.approve')->middleware('checkRole:admin');





