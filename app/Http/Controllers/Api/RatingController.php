<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\RatingResource;
use App\Models\Book;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{
    public function index(Book $book)
    {
        $rating = RatingResource::collection($book->ratings);

        return $rating;
    }

    public function store(Request $request,Book $book)
    {
        $rating = Rating::where([
            'user_id' => Auth::id(),
            'book_id' => $book->id
        ])->first();

        if ($rating == null)//create score
        {
            $rating = new Rating();
            $rating->book_id = $book->id;
            $rating->user_id = Auth::id();
        }

        $rating->star_score = $request->rating;

        $rating->save();

        return new RatingResource($rating);

    }
}
