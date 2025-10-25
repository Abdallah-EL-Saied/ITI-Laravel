<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    /** @use HasFactory<\Database\Factories\ProductFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'category',
        'image',
        'stock_quantity',
        'is_active',
    ];

    public function getImageUrlAttribute()
    {
        return $this->image ? Storage::disk('public')->url('products/' . $this->image) : null;
    }
}
