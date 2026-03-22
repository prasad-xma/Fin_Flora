<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Plant extends Model
{
    protected $fillable = [
        'name',
        'scientific_name',
        'description',
        'price',
        'quantity',
        'size',
        'light_requirements',
        'co2_requirement',
        'difficulty_level',
        'growth_rate',
        'image_url',
        'aquarium_item_id'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'quantity' => 'integer'
    ];

    public function aquariumItem(): BelongsTo
    {
        return $this->belongsTo(AquariumItem::class);
    }

    public function getFormattedPriceAttribute(): string
    {
        return '$' . number_format($this->price, 2);
    }

    public function getIsLowLightAttribute(): bool
    {
        return $this->light_requirements === 'low';
    }

    public function getIsMediumLightAttribute(): bool
    {
        return $this->light_requirements === 'medium';
    }

    public function getIsHighLightAttribute(): bool
    {
        return $this->light_requirements === 'high';
    }

    public function getIsLowCO2Attribute(): bool
    {
        return $this->co2_requirement === 'low';
    }

    public function getIsHighCO2Attribute(): bool
    {
        return $this->co2_requirement === 'high';
    }
}
