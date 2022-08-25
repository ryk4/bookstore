<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Services\BookService;

class BookController extends Controller
{
    private BookService $service;

    public function __construct()
    {
        $this->service = new BookService();
    }

    public function index()
    {
        $books = $this->service->getAllIncludingNotApproved();

        return view('admin.book.index', [
            'books' => $books
        ]);
    }

    public function approve(Book $book)
    {
        $this->service->approve($book);

        return redirect()->route('admin.books.index')
            ->with('status', 'Book approved');;
    }
}
