<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    public const STOCK_STATUS_IN_STOCK = 'in_stock';
    public const STOCK_STATUS_OUT_OF_STOCK = 'out_of_stock';

    protected $fillable = [
        'product_name',
        'description',
        'sku',
        'seller_id',
        'category_id',
        'subcategory_id',
        'store_id',
        'regular_price',
        'discounted_price',
        'tax_rate',
        'stock_quantity',
        'stock_status',
        'slug',
        'visibility',
        'meta_title',
        'meta_description',
        'status',
    ];

    protected $casts = [
        'stock_status' => 'string',
        'visibility' => 'boolean',
        'regular_price' => 'decimal:2',
        'discounted_price' => 'decimal:2',
        'tax_rate' => 'decimal:2',
    ];

    public function category(): BelongsTo{
        return $this->belongsTo(Category::class);
    }
    public function subcategory(): BelongsTo{
        return $this->belongsTo(Subcategory::class);
    }
    public function store(): BelongsTo{
        return $this->belongsTo(Store::class);
    }
    public function seller(): BelongsTo{
        return $this->belongsTo(User::class);
    }
    
    // Original relationship kept for backward compatibility
    public function images(){
        return $this->hasMany(ProductImage::class);
    }
    
    // Added new relationship name to match your code
    public function productImages(){
        return $this->hasMany(ProductImage::class);
    }

    public function carts(): HasMany {
        return $this->hasMany(Cart::class);
    }
    
}