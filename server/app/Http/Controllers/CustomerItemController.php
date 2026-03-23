<?php

namespace App\Http\Controllers;

use App\Models\AquariumItem;
use App\Services\AquariumItemService;

class CustomerItemController extends Controller
{
    public function __construct(
        protected AquariumItemService $aquariumItemService
    ) {}

    public function show(AquariumItem $aquariumItem)
    {
        $item = $this->aquariumItemService->getAquariumItemById($aquariumItem->id);
        
        if (!$item) {
            return redirect()->route('welcome')
                ->with('error', 'Item not found.');
        }

        // Only show available items to customers
        if ($item->status === 'out_of_stock') {
            return redirect()->route('welcome')
                ->with('error', 'This item is currently out of stock.');
        }

        return view('customer.item-show', compact('item'));
    }
}
