<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'img_path', // Changed from image_path to img_path to match the migration
        'is_primary'
    ];

    public function product(): BelongsTo{
        return $this->belongsTo(Product::class);
    }
}
