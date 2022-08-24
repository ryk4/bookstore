<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CommentResource;
use App\Models\Book;
use App\Models\Comment;
use Carbon\Carbon;
use Illuminate\Http\Request;


class CommentController extends Controller
{
    public function index(Book $book)
    {
        return CommentResource::collection($book->comments->sortByDesc('created_at'));
    }

    public function store(Request $request, Book $book)
    {
        $comment = Comment::create([
            'actual_comment' => $request->comment,
            'book_id' => $book->id,
            'user_id' => Auth()->user()->id,
            'created_at' => Carbon::now(),
        ]);

        return new CommentResource($comment);
    }
}
