<?php

namespace App\Services;

use App\Models\Author;
use App\Models\Book;
use App\Models\Genre;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BookService
{
    public function getAllPaginated(): Paginator
    {
        return Book::with('authors', 'genres')
            ->where('status', 1)
            ->simplePaginate();
    }

    public function getWithComments(Book $book): Book
    {
        return Book::with('comments.user')->find($book->id);;
    }

    public function create(Request $request): Book
    {
        $book = Book::create([
            'title'       => $request->title,
            'description' => $request->description,
            'cover'       => $request->cover,
            'price'       => $request->price,
            'discount'    => $request->discount,
            'user_id'     => Auth()->user()->id,
        ]);

        //if admin creates a book, it is confirmed straight away
        if (auth()->user()->getUserLevel() == 'admin') {
            $book->status = 1;
        }

        self::attachAuthors($book, $request->authors);

        foreach ($request->genres as $genre) {
            $genre_db = Genre::where('name', $genre)->first();
            $book->genres()->attach($genre_db);
        }

        //image upload
        if (request()->hasFile('cover')) {
            $file        = $request->file('cover');
            $storagePath = Storage::disk('public')->put('/images/books/', $file);
            $path        = '/images/books/'.basename($storagePath);
            $book->update(['cover' => $path]);
        }

        return $book;
    }

    public function update(Book $book, Request $request): Book
    {
        $book->update($request->validated());

        $book->save();

        self::attachAuthors($book, $request->authors);

        //detach genres
        $book->genres()->detach();

        if ($request->genres != null) {
            foreach ($request->genres as $genre) {
                $genre_db = Genre::where('name', $genre)->first();
                $book->genres()->attach($genre_db);
            }
        }

        return $book;
    }

    public function delete(Book $book): void
    {
        $book->delete();
    }

    private function attachAuthors(Book $book, $authors): void
    {
        $book->authors()->detach();

        $authors_array = explode(',', $authors);

        foreach ($authors_array as $author) {
            $author_db = Author::firstOrCreate([
                'fullname' => Str::of($author)->ltrim(),
            ]);

            $book->authors()->attach($author_db);
        }
    }
}
