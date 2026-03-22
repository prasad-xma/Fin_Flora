<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Fish extends Model
{
    protected $fillable = [
        'name',
        'scientific_name',
        'description',
        'price',
        'quantity',
        'size',
        'water_type',
        'temperament',
        'diet',
        'min_tank_size',
        'image_url',
        'aquarium_item_id'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'quantity' => 'integer',
        'min_tank_size' => 'integer'
    ];

    public function aquariumItem(): BelongsTo
    {
        return $this->belongsTo(AquariumItem::class);
    }

    public function getFormattedPriceAttribute(): string
    {
        return '$' . number_format($this->price, 2);
    }

    public function getIsFreshwaterAttribute(): bool
    {
        return $this->water_type === 'freshwater';
    }

    public function getIsSaltwaterAttribute(): bool
    {
        return $this->water_type === 'saltwater';
    }
}
