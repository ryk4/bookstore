<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $dates = ['created_at'];

    protected $fillable = [
        'actual_comment',
        'book_id',
        'user_id',
        'created_at'

    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function get_days_ago_readable()
    {
        $readable_days_ago = Carbon::parse($this->created_at)->diffInDays(Carbon::now());

        if($readable_days_ago == 0)
        {
            return 'Today';
        }
        else{
            return $readable_days_ago.' day(s) ago';
        }


    }

}
