<?php

namespace App\Http\Controllers;

use App\Models\Book;

use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(){
        $books = Book::all();



        return view('home', [
                'books' => $books
        ]);
    }

    public function manageMenu(){
        return view ('book/manage');
    }

    public function show($id){

        $book = Book::find($id);

        //dd($authors);

        return view('book/show_book',[
            'book' => $book
        ]);
    }

    public function destroy(){

        //delete book
    }
}
