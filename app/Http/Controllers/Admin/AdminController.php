<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{

    public function index()
    {
        $books_to_approve = Book::where('status', 0)->get();

        return view('admin.book.index', [
            'books' => $books_to_approve
        ]);
    }

    public function index_approve()
    {
        $books_to_approve = Book::where('status', 0)->get();

        return view('admin.book.index', [
            'books' => $books_to_approve
        ]);
    }

    public function approve(Request $request, Book $book)
    {
        //one function to do both actions approve and delete

        $action = $request->validate; //1- approve, 2-delete (no point keeping in DB)

        if ($action == 1) {
            $book->status = 1;
            $book->save();
            $statusMsg = 'Book approved!';
        } else {
            $book->delete();
            $statusMsg = 'Book deleted!';
        }

        return redirect()->route('admin.book.index')
            ->with('status', $statusMsg);;
    }

    public function manage_menu_admin()
    {
        $books = Book::with('authors', 'genres')->simplePaginate();

        return view('user.book.index', [
            'books' => $books,

        ]);
    }


}
