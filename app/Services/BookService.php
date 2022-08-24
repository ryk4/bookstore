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
    public function getAllPaginated(string $searchCriteria = null): Paginator
    {
        return Book::with('authors', 'genres')
            ->where('status', '=', Book::STATUS_IS_ACTIVE)
            ->when($searchCriteria, function ($query) use ($searchCriteria) {
                $query->where(function ($query) use ($searchCriteria) {
                    $query->whereHas('authors', function ($query) use ($searchCriteria) {
                        $query->where('fullname', 'LIKE', "%{$searchCriteria}%");
                    })->orWhere('title', 'LIKE', "%{$searchCriteria}%");
                });
            })->simplePaginate();
    }

    public function getAllBelongingToAuthUserPaginated(int $paginate = 40): Paginator
    {
        return auth()->user()->books()->simplePaginate($paginate);
    }

    public function getWithComments(Book $book): Book
    {
        return Book::with('comments.user')->find($book->id);;
    }

    public function store(Request $request): Book
    {
        $book = Book::create([
            'title' => $request->title,
            'description' => $request->description,
            'cover' => $request->cover,
            'price' => $request->price,
            'discount' => $request->discount,
            'user_id' => Auth()->user()->id,
        ]);

        if (auth()->user()->isAdmin()) {
            $book->status = 1;
        }

        self::attachAuthors($book, $request->authors);

        self::attachNewGenresAndDetachOld($book, $request->genres);

        if (request()->hasFile('cover')) {
            $file = $request->file('cover');
            $storagePath = Storage::disk('public')->put('/images/books/', $file);
            $path = '/images/books/' . basename($storagePath);
            $book->cover = $path;
        }

        self::saveChangesToDatabase($book);

        return $book;
    }

    public function update(Book $book, Request $request): Book
    {
        $book->update($request->validated());

        self::attachAuthors($book, $request->authors);

        self::attachNewGenresAndDetachOld($book, $request->genres);

        self::saveChangesToDatabase($book);

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

    private function attachNewGenresAndDetachOld(Book $book, $genres): void
    {
        $book->genres()->detach();

        if ($genres !== null) {
            foreach ($genres as $genre) {
                $genre_db = Genre::where('name', $genre)->first();
                $book->genres()->attach($genre_db);
            }
        }
    }

    private function saveChangesToDatabase(Book $book): void
    {
        $book->save();
    }
}
