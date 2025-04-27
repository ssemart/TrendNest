<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'card_number',
        'expiry',
        'card_holder',
        'type'
    ];

    protected $hidden = [
        'card_number'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getCardNumberAttribute($value)
    {
        $decrypted = decrypt($value);
        return '****' . substr($decrypted, -4);
    }
}