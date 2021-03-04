<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookPostRequest;
use App\Mail\BookReportMail;
use App\Models\Author;
use App\Models\Book;

use App\Models\Genre;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BookController extends Controller
{

    public function search(Request $request)
    {
        $search = $request->input('search_criteria');

        $searched_books = Book::with('authors', 'genres')
            ->where('status', 1)
            ->whereHas('authors', function ($query) use ($search) {
                $query->where('fullname', 'LIKE', "%{$search}%")
                    ->orWhere('title', 'LIKE', "%{$search}%");
            })->simplePaginate();


        $cookie = Cookie::make('search_cookie', $search);

        return Response::view('home', [
            'books' => $searched_books
        ])->withCookie($cookie);
    }

    public function index()
    {
        $books = Book::with('authors', 'genres')
            ->where('status', 1)
            ->simplePaginate();

        return view('home', [
            'books' => $books
        ]);
    }

    public function manageMenu()
    {
        //fetch books that belong to the logged in account
        $books = Book::where('user_id', Auth::id())
            ->simplePaginate();

        return view('book/manage', [
            'books' => $books
        ]);
    }

    public function show($id)
    {
        $book = Book::with('comments.user')->findOrFail($id);

        return view('book.show', [
            'book' => $book
        ]);
    }

    public function destroy($id)
    {
        $book = Book::find($id);

        $book->delete();//Will Cascade children

        return back()->with('status', 'Book deleted!');
    }

    public function create()
    {
        return view('book/create');
    }

    public function edit($id)
    {
        $book = Book::find($id);

        $this->authorize('update', $book); // automatically will throw 403 if false
        return view('book.edit', compact('book'));

    }

    public function update(BookPostRequest $request, Book $book)
    {
        $book->update($request->validated());

        $book->save();

        //detach all authors
        $book->authors()->detach();

        $authors_array = explode(',', $request->authors);

        foreach ($authors_array as $author) {
            $author_db = Author::firstOrCreate([
                'fullname' => Str::of($author)->ltrim()
            ]);

            $book->authors()->attach($author_db);
        }

        //detach genres
        $book->genres()->detach();

        //this can be simplified as 'Sync' ???
        if ($request->genres != null) {
            foreach ($request->genres as $genre) {
                $genre_db = Genre::where('name', $genre)->first();
                $book->genres()->attach($genre_db);

            }
        }

        return redirect()->route('book.index')
            ->with('status', 'Book modified!');
    }

    public function store(BookPostRequest $request)
    {
        $book = Book::create([
            'title' => $request->title,
            'description' => $request->description,
            'cover' => $request->cover,
            'price' => $request->price,
            'discount' => $request->discount,
            'user_id' => Auth()->user()->id,
        ]);

        //if admin creates a book, it is confirmed straight away
        if (auth()->user()->getUserLevel() == 'admin') {
            $book->status = 1;
        }

        //authors
        $authors_array = explode(',', $request->authors);

        foreach ($authors_array as $author) {
            $author_db = Author::firstOrCreate([
                'fullname' => Str::of($author)->ltrim()
            ]);

            $book->authors()->attach($author_db);
        }

        foreach ($request->genres as $genre) {
            $genre_db = Genre::where('name', $genre)->first();
            $book->genres()->attach($genre_db);
        }

        //image upload
        if (request()->hasFile('cover')) {
            $file = $request->file('cover');
            $storagePath = Storage::disk('public')->put('/images/books/', $file);
            $path = '/images/books/' . basename($storagePath);
            $book->update(['cover' => $path]);
        }

        return redirect()->route('booksManageMenu')
            ->with('status', 'Book created!');
    }

    public function report(Request $request, Book $book)
    {
        $details = [
            'title' => $book->title,
            'user_name' => auth()->user()->name,
            'user_email' => auth()->user()->email,
            'complaint' => $request->input('complaint')
        ];

        Mail::to('support@bookstore.lt')->send(new BookReportMail($details));

        return redirect()->route('book.show', ['id' => $book->id])
            ->with('status', 'Book reported!');

    }

}
