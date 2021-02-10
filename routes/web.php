<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;

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


//UI

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';


//Books
Route::GET('/', [BookController::class, 'index'])->name('book.index');//will be default/starting page


Route::GET('/book/manage', [BookController::class, 'manageMenu'])->name('booksManageMenu');
Route::POST('/book', [BookController::class, 'create'])->name('book.store');
Route::GET('/book/{id}', [BookController::class,'show'])->name('book.show');
Route::PUT('/book/{id}', [BookController::class, 'update'])->name('book.edit');
Route::PUT('/book/{id}/edit', [BookController::class, 'edit'])->name('book.update');
Route::DELETE('/book/{id}', [BookController::class, 'destroy'])->name('book.destroy');



//Users


//Admin


