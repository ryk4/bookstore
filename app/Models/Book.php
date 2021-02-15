<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'cover',
        'price',
        'discount',
        'status',
        'description'
    ];

    public function authors(){
        return $this->belongsToMany(Author::class);
    }

    public function genres(){
        return $this->belongsToMany(Genre::class);
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function ratings(){
        return $this->hasMany(Rating::class);
    }

    public function getBookStatus(){
        $status = [
            0 => 'Pending',
            1 => 'Active'
            //can add more if needed
        ];

        return $status[$this->status];
    }

    public function isAddedThisWeek()
    {
       return $this->created_at > Carbon::now()->add(-7,'day');
    }

    public function authors_readable()
    {
        return implode(",",$this->authors()->pluck('fullname')->toArray());
    }

    public function price_discounted(){

        $price_with_discount = $this->price * (1-($this->discount / 100));

        return $price_with_discount;
    }

    public function if_rating_left_by_user(){

        $rating = Rating::where([
            'user_id'=>Auth::id(),
            'book_id'=>$this->id
        ])->first();

        if($rating == null) {
            return false;
        }

        return true;
    }

    public function rating_left_by_user(){
        $rating = Rating::where([
            'user_id'=>Auth::id(),
            'book_id'=>$this->id
        ])->first()->star_score;

        return $rating;
    }

    public function avg_rating(){
        return round($this->ratings()->avg('star_score'),2);
    }




}
