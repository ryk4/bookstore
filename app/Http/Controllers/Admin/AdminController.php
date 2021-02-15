<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function index()
    {

        $books_to_approve = Book::where('status',0)->get();

        return view('admin.book.index',[
            'books' => $books_to_approve
        ]);

    }

    public function approve(Request $request,Book $book)
    {
        $action = $request->validate; //1- approve, 2-delete (no point keeping in DB)

        if($action==1)
        {
            $book->status = 1;
            $book->save();
        }
        else {
            $book->delete();
        }

        return redirect()->route('admin.book.index');
    }

    public function previewBook()
    {

    }


}
