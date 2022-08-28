<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBookRequest;
use App\Models\Book;
use App\Services\BookService;
use Illuminate\Http\Request;

class BookController extends Controller
{
    private BookService $bookService;

    public function __construct()
    {
        $this->bookService = new BookService();
    }

    public function index()
    {
        $books = $this->bookService->getAllBelongingToAuthUserPaginated();

        return view('user.book.index', compact('books'));
    }

    public function destroy(Book $book)
    {
        $this->authorize('update', $book);

        $this->bookService->delete($book);

        return back()->with('status', 'Book deleted!');
    }

    public function create()
    {
        return view('book/create');
    }

    public function edit(Book $book)
    {
        $this->authorize('update', $book);

        return view('book.edit', compact('book'));
    }

    public function update(StoreBookRequest $request, Book $book)
    {
        $this->authorize('update', $book);

        $this->bookService->update($book, $request);

        return redirect()->route('books.index')
            ->with('status', 'Book modified');
    }

    public function store(StoreBookRequest $request)
    {
        $this->bookService->store($request);

        return redirect()->route('books.index')
            ->with('status', 'Book created');
    }
}
