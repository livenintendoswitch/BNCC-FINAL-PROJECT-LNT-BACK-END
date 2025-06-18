<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class InvoiceDetail extends Model
{
    use HasFactory;

    protected $primaryKey = 'invoice_detail_id';


    protected $fillable = [
        'invoice_header_id',
        'book_id',
        'quantity',
        'subtotal',
    ];


    public function invoice(): BelongsTo
    {
        return $this->belongsTo(Invoice::class, 'invoice_header_id', 'invoice_header_id');
    }


    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class, 'book_id', 'book_id');
    }
}
