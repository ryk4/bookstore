<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Book extends Model
{
    use HasFactory;

    public const STATUS_IS_ACTIVE = 1;
    public const STATUS_IS_INACTIVE = 0;

    protected $fillable = [
        'title',
        'cover',
        'price',
        'discount',
        'status',
        'description',
        'user_id',
    ];

    protected $perPage = 25;

    public function authors(): BelongsToMany
    {
        return $this->belongsToMany(Author::class);
    }

    public function genres(): BelongsToMany
    {
        return $this->belongsToMany(Genre::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function ratings(): HasMany
    {
        return $this->hasMany(Rating::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getBookStatus(): string
    {
        $status = [
            0 => 'Pending',
            1 => 'Active'
        ];

        return $status[$this->status];
    }

    public function isActive(): bool
    {
        return $this->status;
    }

    public function isAddedThisWeek(): bool
    {
        return $this->created_at > Carbon::now()->add(-7, 'day');
    }

    public function authors_readable(): string
    {
        return implode(",", $this->authors()->pluck('fullname')->toArray());
    }

    public function price_discounted(): float
    {
        $price_with_discount = $this->price * (1 - ($this->discount / 100));

        return round($price_with_discount, 2);
    }

    public function avg_rating(): float
    {
        return round($this->ratings()->avg('star_score'), 2);
    }


}
