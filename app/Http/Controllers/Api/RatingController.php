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

    /*
    I will not be using Resource as the return values differ
    based if user is auth or not.
    */
    public function index(Book $book)
    {
        //this is stupid and i dont like it...

        $avg_score=round($book->ratings()->avg('star_score'), 2);
        $count_score = $book->ratings()->count();

        if (auth()->guard('sanctum')->user() != null) {
            $rating = Rating::where([
                'user_id' => auth()->guard('sanctum')->id(),
                'book_id' => $book->id
            ])->first();

            if ($rating != null) {
                return [
                    'user_score' => $rating->star_score,
                    'avg_score' => $avg_score,
                    'count_score' => $count_score,
                ];
            }
        }

        return [
            'avg_score' => $avg_score,
            'count_score' => $count_score,
        ];
    }

    public function store(Request $request, Book $book)
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
