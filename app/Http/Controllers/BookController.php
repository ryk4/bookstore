<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookPostRequest;
use App\Mail\BookReportMail;
use App\Models\Book;
use App\Services\BookService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class BookController extends Controller
{
    private BookService $bookService;

    public function __construct()
    {
        $this->bookService = new BookService();
    }

    public function search(Request $request)
    {
        $searchCriteria = $request->input('searchCriteria');

        return redirect()->route('books.index', compact('searchCriteria'));
    }

    public function index(Request $request)
    {
        $searchCriteria = $request->input('searchCriteria');

        $books = $this->bookService->getAllPaginated($searchCriteria);

        return view('book.index', compact('books', 'searchCriteria'));
    }

    public function userBooks()
    {
        $books = $this->bookService->getAllBelongingToAuthUserPaginated();

        return view('user.book.index', compact('books'));
    }

    public function show(Book $book)
    {
        $book = $this->bookService->getWithComments($book);

        return view('book.show', compact('book'));
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

    public function update(BookPostRequest $request, Book $book)
    {
        $this->bookService->update($book, $request);

        return redirect()->route('books.index')
            ->with('status', 'Book modified');
    }

    public function store(BookPostRequest $request)
    {
        $this->bookService->store($request);

        return redirect()->route('my-books.index')
            ->with('status', 'Book created');
    }

    public function report(Request $request, Book $book)
    {
        $details = [
            'title' => $book->title,
            'user_name' => auth()->user()->name,
            'user_email' => auth()->user()->email,
            'complaint' => $request->input('complaint'),
        ];

        Mail::to('support@bookstore.lt')->send(new BookReportMail($details));

        return redirect()->route('books.show', ['id' => $book->id])
            ->with('status', 'Book reported');
    }
}
