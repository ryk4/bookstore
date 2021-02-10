<?php

namespace App\Http\Controllers;

use App\Models\Book;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    public function index(){
        $books = Book::all();

        return view('home', [
            'books' => $books
        ]);
    }

    public function manageMenu(){
        //fetch books that belong to the logged in account

        $books = Book::where('user_id',Auth::id())->get();

        return view ('book/manage',[
            'books' => $books
        ]);
    }

    public function show($id){

        $book = Book::find($id);

        return view('book/show_book',[
            'book' => $book
        ]);
    }

    public function destroy($id){

        $book = Book::find($id);

        $book->delete();//Will Cascade children

        return redirect()->route('booksManageMenu');
    }

    public function create(){
        return view('book/add_books');
    }
}
