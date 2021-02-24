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
        $books = BookResource::collection(Book::where('status',1)->with('authors','genres')->get());

        return $books;
    }

    public function show($book)
    {
        $book = new BookResource(Book::findOrFail($book),'description');

        return $book;
    }
}
