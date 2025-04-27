<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomePageSetting extends Model
{
    protected $fillable = [
        'discounted_product_id',
        'discount_percent',
        'discount_heading',
        'discount_subheading',
        'featured_1_id',
        'featured_2_id',
    ];

    public function discountedProduct(){
        return $this->belongsTo(Product::class);
    }

    public function featuredProduct1(){
        return $this->belongsTo(Product::class);
    }

    public function featuredProduct2(){
        return $this->belongsTo(Product::class);
    }
}
