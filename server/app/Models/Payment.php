<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable([
    'user_id',
    'stripe_payment_id',
    'amount',
    'currency',
    'status',
    'payment_method'
])]
class Payment extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
