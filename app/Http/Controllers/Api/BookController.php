<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BookResource;
use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        return BookResource::collection(Book::where('status', 1)->with('authors', 'genres')->get());
    }

    public function show(Book $book)
    {
        return new BookResource($book, 'description');
    }
}
