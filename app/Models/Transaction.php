<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Transaction extends Model
{
    protected $fillable = [
        'product_id',
        'user_id',
        'type',
        'quantity',
        'total_harga',
    ];

    /**
     * Relasi: Transaksi terhubung ke satu Produk
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Relasi: Transaksi dilakukan oleh satu Pengguna (User)
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}