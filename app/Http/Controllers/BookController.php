<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookPostRequest;
use App\Mail\BookReportMail;
use App\Models\Book;
use App\Services\BookService;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Response;

class BookController extends Controller
{
    private BookService $bookService;

    public function __construct()
    {
        $this->bookService = new BookService();
    }

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
            'books' => $searched_books,
        ])->withCookie($cookie);
    }

    public function index()
    {
        $books = $this->bookService->getAllPaginated();

        return view('home', [
            'books' => $books,
        ]);
    }

    public function manageMenu()
    {
        $books = Book::where('user_id', Auth::id())
            ->simplePaginate();

        return view('book/manage', [
            'books' => $books,
        ]);
    }

    public function show(Book $book)
    {
        $book = $this->bookService->getWithComments($book);

        return view('book.show', [
            'book' => $book,
        ]);
    }

    public function destroy(Book $book)
    {
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

        return redirect()->route('book.index')
            ->with('status', 'Book modified!');
    }

    public function store(BookPostRequest $request)
    {
        $this->bookService->create($request);

        return redirect()->route('booksManageMenu')
            ->with('status', 'Book created!');
    }

    public function report(Request $request, Book $book)
    {
        $details = [
            'title'      => $book->title,
            'user_name'  => auth()->user()->name,
            'user_email' => auth()->user()->email,
            'complaint'  => $request->input('complaint'),
        ];

        Mail::to('support@bookstore.lt')->send(new BookReportMail($details));

        return redirect()->route('book.show', ['id' => $book->id])
            ->with('status', 'Book reported!');
    }

}
