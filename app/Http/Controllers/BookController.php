<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;

use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

    public function store(Request $request)
    {

        $book = new Book();
        $book->title=$request->title;
        $book->description=$request->description;
        $book->cover=$request->cover;
        $book->price=$request->price;
        $book->discount=$request->discount;

        $book->user_id=Auth::id();

        $book->save();


        //authors
        $authors_array = explode(',', $request->authors);

        //cannot use saveMany(), as I cannot have duplicate authors.
        foreach($authors_array as $author)
        {
            $author_db = Author::firstOrCreate([
                'fullname' => $author
            ]);

            DB::table('author_book')->insert([
                'author_id' => $author_db->id,
                'book_id' => $book->id
            ]);
        }

        //genres (Can this not be in a for-loop ???)
        foreach($request->genres as $genre)
        {
            $genre_id = Genre::where('name',$genre)->first();
            $book->genres()->attach($genre_id);

        }

        //image upload
        if(request()->hasFile('cover'))
        {
            $file = $request->file('cover');
            $name = '/images/books/' . uniqid() . '.' . $file->extension();
            $file->storePubliclyAs('public', $name);
            $book->update(['cover' => $name]);
        }

        return redirect()->route('booksManageMenu');
    }
}
