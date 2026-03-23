<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Attributes\Fillable;

#[Fillable([
    'user_id',
    'aquarium_item_id',
    'quantity',
    'price',
    'user_address'
])]
class Order extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function aquariumItem()
    {
        return $this->belongsTo(AquariumItem::class);
    }
}
