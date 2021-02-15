<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [

    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function get_days_ago_readable()
    {
        return $this->created_at->diffInDays(Carbon::now());
    }

}
