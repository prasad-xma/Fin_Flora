<?php

namespace App\Services;

use App\Models\AquariumItem;
use App\Models\Fish;
use App\Models\Plant;
use Illuminate\Support\Facades\Auth;

class AquariumItemService
{
    public function createAquariumItem(array $data): AquariumItem
    {
        $data['manager_id'] = Auth::id();
        
        $aquariumItem = AquariumItem::create($data);

        if ($data['type'] === 'fish' && isset($data['fish_data'])) {
            $fishData = array_merge($data['fish_data'], [
                'aquarium_item_id' => $aquariumItem->id,
                'price' => $aquariumItem->price,
                'quantity' => $aquariumItem->total_quantity
            ]);
            $aquariumItem->fish()->create($fishData);
        }

        if ($data['type'] === 'plant' && isset($data['plant_data'])) {
            $plantData = array_merge($data['plant_data'], [
                'aquarium_item_id' => $aquariumItem->id,
                'price' => $aquariumItem->price,
                'quantity' => $aquariumItem->total_quantity
            ]);
            $aquariumItem->plants()->create($plantData);
        }

        return $aquariumItem;
    }

    public function updateAquariumItem(AquariumItem $aquariumItem, array $data): AquariumItem
    {
        $aquariumItem->update($data);

        if ($data['type'] === 'fish' && isset($data['fish_data'])) {
            $fishData = array_merge($data['fish_data'], [
                'aquarium_item_id' => $aquariumItem->id,
                'price' => $aquariumItem->price,
                'quantity' => $aquariumItem->total_quantity
            ]);
            
            if ($aquariumItem->fish()->exists()) {
                $aquariumItem->fish()->update($fishData);
            } else {
                $aquariumItem->fish()->create($fishData);
            }
        }

        if ($data['type'] === 'plant' && isset($data['plant_data'])) {
            $plantData = array_merge($data['plant_data'], [
                'aquarium_item_id' => $aquariumItem->id,
                'price' => $aquariumItem->price,
                'quantity' => $aquariumItem->total_quantity
            ]);
            
            if ($aquariumItem->plants()->exists()) {
                $aquariumItem->plants()->update($plantData);
            } else {
                $aquariumItem->plants()->create($plantData);
            }
        }

        return $aquariumItem;
    }

    public function deleteAquariumItem(AquariumItem $aquariumItem): bool
    {
        return $aquariumItem->delete();
    }

    public function getManagerAquariumItems($managerId = null): \Illuminate\Database\Eloquent\Collection
    {
        $managerId = $managerId ?: Auth::id();
        
        return AquariumItem::where('manager_id', $managerId)
            ->with(['fish', 'plants'])
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function getAquariumItemById(int $id): ?AquariumItem
    {
        return AquariumItem::with(['fish', 'plants', 'manager'])
            ->find($id);
    }

    public function updateStock(AquariumItem $aquariumItem, int $quantity): AquariumItem
    {
        $aquariumItem->total_quantity += $quantity;
        $aquariumItem->save();
        
        return $aquariumItem;
    }

    public function applyDiscount(AquariumItem $aquariumItem, float $discountPrice): AquariumItem
    {
        $aquariumItem->discount_price = $discountPrice;
        $aquariumItem->save();
        
        return $aquariumItem;
    }

    public function removeDiscount(AquariumItem $aquariumItem): AquariumItem
    {
        $aquariumItem->discount_price = null;
        $aquariumItem->save();
        
        return $aquariumItem;
    }
}
