<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class AquariumItem extends Model
{
    protected $fillable = [
        'name',
        'description',
        'price',
        'discount_price',
        'total_quantity',
        'category',
        'type',
        'status',
        'care_instructions',
        'image_url',
        'manager_id'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'discount_price' => 'decimal:2',
        'total_quantity' => 'integer'
    ];

    public function fish(): HasMany
    {
        return $this->hasMany(Fish::class);
    }

    public function plants(): HasMany
    {
        return $this->hasMany(Plant::class);
    }

    protected static function booted(): void
    {
        static::deleting(function ($aquariumItem) {
            $aquariumItem->fish()->delete();
            $aquariumItem->plants()->delete();
        });
    }

    public function manager(): BelongsTo
    {
        return $this->belongsTo(User::class, 'manager_id');
    }

    public function getAvailableQuantityAttribute(): int
    {
        return $this->total_quantity - $this->sold_quantity;
    }

    public function getDiscountPercentageAttribute(): ?float
    {
        if ($this->discount_price && $this->price > 0) {
            return round((($this->price - $this->discount_price) / $this->price) * 100, 2);
        }
        return null;
    }
}
