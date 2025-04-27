<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Referral extends Model
{
    use HasFactory;

    protected $fillable = [
        'referrer_id',
        'customer_id',
        'status',
        'commission',
        'paid'
    ];

    protected $casts = [
        'paid' => 'boolean'
    ];

    public function referrer()
    {
        return $this->belongsTo(User::class, 'referrer_id');
    }

    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id');
    }
}