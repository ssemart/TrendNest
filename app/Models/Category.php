<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Testing\Fluent\Concerns\Has;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_name',
        'image_path',
        'is_featured',
        'featured_order'
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'featured_order' => 'integer'
    ];

    public function subcategories(): HasMany{
    return $this->hasMany(Subcategory::class);
    
    }
}
