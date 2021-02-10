<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function reviews(){
        return $this->hasMany(Review::class);
    }

    public function ratings(){
        return $this->hasMany(Rating::class);
    }

    public function getBookStatus(){
        $status = [
            0 => 'Active',
            1 => 'Pending'
            //can add more if needed
        ];

        return $status[$this->status];
    }

}
