<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'sku',
        'name',
        'price',
        'stock',
    ];

    /**
     * Relasi ke model Category (Many to One)
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Relasi ke model Supplier (Many to Many)
     */
    public function suppliers()
    {
        return $this->belongsToMany(Supplier::class, 'product_supplier');
    }

    /**
     * Relasi ke model Transaction
     */
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}