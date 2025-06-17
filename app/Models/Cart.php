<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'book_id',
        'quantity',
    ];


    public function user(): BelongsTo
    {

        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }


    public function book(): BelongsTo
    {

        return $this->belongsTo(Book::class, 'book_id', 'book_id');
    }
}
