<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookPostRequest;
use App\Models\Author;
use App\Models\Book;

use App\Models\Genre;
use Faker\Provider\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class BookController extends Controller
{
    public function index(){
        $books = Book::with('authors','genres')->where('status',1)->simplePaginate();

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

        $book = Book::with('comments.user')->findOrFail($id);

        return view('book.show',[
            'book' => $book
        ]);
    }

    public function destroy($id){

        $book = Book::find($id);

        $book->delete();//Will Cascade children

        return redirect()->route('booksManageMenu');
    }

    public function create(){
        return view('book/create');
    }

    public function edit($id)
    {
        $book = Book::find($id);

        return view('book.edit',[
            'book' => $book
        ]);
    }

    public function update(BookPostRequest $request,Book $book)
    {
        //one ugly looking method...

        $book->title=$request->title;
        $book->description=$request->description;
        $book->price=$request->price;
        $book->discount=$request->discount;
        $book->title=$request->title;

        $book->save();

        //delete existing data from pivot table
        DB::table('author_book')->where('book_id', '=', $book->id)->delete();

        $authors_array = explode(',', $request->authors);

        foreach($authors_array as $author)
        {
            $author_db = Author::firstOrCreate([
                'fullname' => Str::of($author)->ltrim()
            ]);

            DB::table('author_book')->insert([
                'author_id' => $author_db->id,
                'book_id' => $book->id
            ]);
        }

        //delete genres authors and add new ones
        DB::table('book_genre')->where('book_id', '=', $book->id)->delete();

        //genres (Can this not be in a for-loop ???)
        if($request->genres != null) {
            foreach ($request->genres as $genre) {
                $genre_id = Genre::where('name', $genre)->first();
                $book->genres()->attach($genre_id);

            }
        }

        return redirect()->route('booksManageMenu');
    }

    public function store(BookPostRequest $request)
    {

        $book = new Book();
        $book->title=$request->title;
        $book->description=$request->description;
        $book->cover=$request->cover;
        $book->price=$request->price;
        $book->discount=$request->discount;

        //if admin creates a book, it is confirmed straight away
        if(Auth::user()->getUserLevel() == 'admin')
        {
            $book->status=1;
        }

        $book->user_id=Auth::id();

        $book->save();

        //authors
        $authors_array = explode(',', $request->authors);

        foreach($authors_array as $author)
        {
            $author_db = Author::firstOrCreate([
                'fullname' => Str::of($author)->ltrim()
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
