<?php

namespace App\Http\Controllers;

use App\Services\AquariumItemService;
use App\Models\AquariumItem;
use Illuminate\Http\Request;

class AquariumItemController extends Controller
{
    public function __construct(
        protected AquariumItemService $aquariumItemService
    ) {}

    public function index()
    {
        $items = $this->aquariumItemService->getManagerAquariumItems();
        return view('aquarium-items.index', compact('items'));
    }

    public function create()
    {
        return view('aquarium-items.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'discount_price' => 'nullable|numeric|min:0|lt:price',
            'total_quantity' => 'required|integer|min:0',
            'category' => 'required|string|in:fish,plant,equipment',
            'type' => 'required|string|in:fish,plant',
            'status' => 'required|string|in:available,unavailable,out_of_stock',
            'care_instructions' => 'nullable|string',
            'image_url' => 'nullable|url',
            'image_upload' => 'nullable|file|max:10240',
        ]);

        // Handle file upload
        $imageUrl = $validated['image_url'] ?? null;
        if ($request->hasFile('image_upload')) {
            $file = $request->file('image_upload');
            if ($file->isValid()) {
                try {
                    $imageInfo = getimagesize($file->getPathname());
                    if ($imageInfo === false) {
                        $imageUrl = $validated['image_url'] ?? null;
                    } else {
                        $filename = time() . '_' . $file->getClientOriginalName();
                        $file->move(public_path('images/items'), $filename);
                        $imageUrl = '/images/items/' . $filename;
                    }
                } catch (\Exception $e) {
                    $imageUrl = $validated['image_url'] ?? null;
                }
            }
        }
        
        $validated['image_url'] = $imageUrl;

        // Validate type-specific data
        $typeSpecificRules = [];
        
        if ($request->type === 'fish') {
            $typeSpecificRules = [
                'fish_data.name' => 'required|string|max:255',
                'fish_data.scientific_name' => 'nullable|string|max:255',
                'fish_data.description' => 'nullable|string',
                'fish_data.size' => 'required|string|in:small,medium,large',
                'fish_data.water_type' => 'required|string|in:freshwater,saltwater',
                'fish_data.temperament' => 'nullable|string',
                'fish_data.diet' => 'nullable|string',
                'fish_data.min_tank_size' => 'nullable|integer|min:1',
                'fish_data.image_url' => 'nullable|url',
            ];
        } elseif ($request->type === 'plant') {
            $typeSpecificRules = [
                'plant_data.name' => 'required|string|max:255',
                'plant_data.scientific_name' => 'nullable|string|max:255',
                'plant_data.description' => 'nullable|string',
                'plant_data.size' => 'required|string|in:small,medium,large',
                'plant_data.light_requirements' => 'required|string|in:low,medium,high',
                'plant_data.co2_requirement' => 'required|string|in:low,high',
                'plant_data.difficulty_level' => 'required|string|in:easy,medium,hard',
                'plant_data.growth_rate' => 'required|string|in:slow,medium,fast',
                'plant_data.image_url' => 'nullable|url',
            ];
        }

        $validated = array_merge($validated, $request->validate($typeSpecificRules));

        $aquariumItem = $this->aquariumItemService->createAquariumItem($validated);

        return redirect()->route('aquarium-items.index')
            ->with('success', 'Aquarium item created successfully!');
    }

    public function show(AquariumItem $aquariumItem)
    {
        $item = $this->aquariumItemService->getAquariumItemById($aquariumItem->id);
        
        if (!$item) {
            return redirect()->route('aquarium-items.index')
                ->with('error', 'Item not found.');
        }

        return view('aquarium-items.show', compact('item'));
    }

    public function edit(AquariumItem $aquariumItem)
    {
        if ($aquariumItem->manager_id !== auth()->id()) {
            return redirect()->route('aquarium-items.index')
                ->with('error', 'Unauthorized access.');
        }

        $aquariumItem->load(['fish', 'plants']);
        return view('aquarium-items.edit', compact('aquariumItem'));
    }

    public function update(Request $request, AquariumItem $aquariumItem)
    {
        if ($aquariumItem->manager_id !== auth()->id()) {
            return redirect()->route('aquarium-items.index')
                ->with('error', 'Unauthorized access.');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'discount_price' => 'nullable|numeric|min:0|lt:price',
            'total_quantity' => 'required|integer|min:0',
            'category' => 'required|string|in:fish,plant,equipment',
            'type' => 'required|string|in:fish,plant',
            'status' => 'required|string|in:available,unavailable,out_of_stock',
            'care_instructions' => 'nullable|string',
            'image_url' => 'nullable|url',
            'image_upload' => 'nullable|file|max:10240',
        ]);

        // Handle file upload
        $imageUrl = $validated['image_url'] ?? null;
        if ($request->hasFile('image_upload')) {
            $file = $request->file('image_upload');
            if ($file->isValid()) {
                try {
                    $imageInfo = getimagesize($file->getPathname());
                    if ($imageInfo === false) {
                        $imageUrl = $validated['image_url'] ?? null;
                    } else {
                        $filename = time() . '_' . $file->getClientOriginalName();
                        $file->move(public_path('images/items'), $filename);
                        $imageUrl = '/images/items/' . $filename;
                        
                        if ($aquariumItem->image_url && file_exists(public_path($aquariumItem->image_url))) {
                            unlink(public_path($aquariumItem->image_url));
                        }
                    }
                } catch (\Exception $e) {
                    $imageUrl = $validated['image_url'] ?? null;
                }
            }
        }
        
        $validated['image_url'] = $imageUrl ?: $aquariumItem->image_url;

        // Validate type-specific data
        $typeSpecificRules = [];
        
        if ($request->type === 'fish') {
            $typeSpecificRules = [
                'fish_data.name' => 'required|string|max:255',
                'fish_data.scientific_name' => 'nullable|string|max:255',
                'fish_data.description' => 'nullable|string',
                'fish_data.size' => 'required|string|in:small,medium,large',
                'fish_data.water_type' => 'required|string|in:freshwater,saltwater',
                'fish_data.temperament' => 'nullable|string',
                'fish_data.diet' => 'nullable|string',
                'fish_data.min_tank_size' => 'nullable|integer|min:1',
                'fish_data.image_url' => 'nullable|url',
            ];
        } elseif ($request->type === 'plant') {
            $typeSpecificRules = [
                'plant_data.name' => 'required|string|max:255',
                'plant_data.scientific_name' => 'nullable|string|max:255',
                'plant_data.description' => 'nullable|string',
                'plant_data.size' => 'required|string|in:small,medium,large',
                'plant_data.light_requirements' => 'required|string|in:low,medium,high',
                'plant_data.co2_requirement' => 'required|string|in:low,high',
                'plant_data.difficulty_level' => 'required|string|in:easy,medium,hard',
                'plant_data.growth_rate' => 'required|string|in:slow,medium,fast',
                'plant_data.image_url' => 'nullable|url',
            ];
        }

        $validated = array_merge($validated, $request->validate($typeSpecificRules));

        $this->aquariumItemService->updateAquariumItem($aquariumItem, $validated);

        return redirect()->route('aquarium-items.index')
            ->with('success', 'Aquarium item updated successfully!');
    }

    public function destroy(AquariumItem $aquariumItem)
    {
        if ($aquariumItem->manager_id !== auth()->id()) {
            return redirect()->route('aquarium-items.index')
                ->with('error', 'Unauthorized access.');
        }

        $this->aquariumItemService->deleteAquariumItem($aquariumItem);

        return redirect()->route('aquarium-items.index')
            ->with('success', 'Aquarium item deleted successfully!');
    }
}
