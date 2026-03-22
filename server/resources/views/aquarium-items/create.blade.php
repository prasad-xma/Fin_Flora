@extends('layouts.app')

@section('title', 'Add Aquarium Item - Fin & Flora')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-lg shadow-md p-6 mb-8">
            <div class="flex items-center justify-between mb-6">
                <h1 class="text-2xl font-bold text-gray-900">Add New Aquarium Item</h1>
                <a href="{{ route('aquarium-items.index') }}" class="text-gray-600 hover:text-gray-900">
                    ← Back to Items
                </a>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6">
            <form action="{{ route('aquarium-items.store') }}" method="POST" class="space-y-6">
                @csrf
                
                @if ($errors->any())
                    <div class="bg-red-50 border border-red-200 rounded-lg p-4">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <h3 class="text-sm font-medium text-red-800">Please fix the following errors:</h3>
                                <div class="mt-2 text-sm text-red-700">
                                    <ul class="list-disc list-inside space-y-1">
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Basic Information -->
                <div class="border-b border-gray-200 pb-6">
                    <h2 class="text-lg font-medium text-gray-900 mb-4">Basic Information</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Item Name *</label>
                            <input type="text" id="name" name="name" value="{{ old('name') }}" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label for="category" class="block text-sm font-medium text-gray-700 mb-2">Category *</label>
                            <select id="category" name="category" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <option value="">Select Category</option>
                                <option value="fish" {{ old('category') == 'fish' ? 'selected' : '' }}>Fish</option>
                                <option value="plant" {{ old('category') == 'plant' ? 'selected' : '' }}>Plant</option>
                                <option value="equipment" {{ old('category') == 'equipment' ? 'selected' : '' }}>Equipment</option>
                            </select>
                        </div>
                        <div>
                            <label for="type" class="block text-sm font-medium text-gray-700 mb-2">Type *</label>
                            <select id="type" name="type" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <option value="">Select Type</option>
                                <option value="fish" {{ old('type') == 'fish' ? 'selected' : '' }}>Fish</option>
                                <option value="plant" {{ old('type') == 'plant' ? 'selected' : '' }}>Plant</option>
                            </select>
                        </div>
                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status *</label>
                            <select id="status" name="status" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <option value="available" {{ old('status') == 'available' ? 'selected' : '' }}>Available</option>
                                <option value="unavailable" {{ old('status') == 'unavailable' ? 'selected' : '' }}>Unavailable</option>
                                <option value="out_of_stock" {{ old('status') == 'out_of_stock' ? 'selected' : '' }}>Out of Stock</option>
                            </select>
                        </div>
                    </div>
                    <div class="mt-6">
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description *</label>
                        <textarea id="description" name="description" rows="3" required
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">{{ old('description') }}</textarea>
                    </div>
                    <div class="mt-6">
                        <label for="care_instructions" class="block text-sm font-medium text-gray-700 mb-2">Care Instructions</label>
                        <textarea id="care_instructions" name="care_instructions" rows="2"
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">{{ old('care_instructions') }}</textarea>
                    </div>
                </div>

                <!-- Pricing and Inventory -->
                <div class="border-b border-gray-200 pb-6">
                    <h2 class="text-lg font-medium text-gray-900 mb-4">Pricing & Inventory</h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label for="price" class="block text-sm font-medium text-gray-700 mb-2">Price ($) *</label>
                            <input type="number" id="price" name="price" step="0.01" min="0" value="{{ old('price') }}" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label for="discount_price" class="block text-sm font-medium text-gray-700 mb-2">Discount Price ($)</label>
                            <input type="number" id="discount_price" name="discount_price" step="0.01" min="0" value="{{ old('discount_price') }}"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <label for="total_quantity" class="block text-sm font-medium text-gray-700 mb-2">Total Quantity *</label>
                            <input type="number" id="total_quantity" name="total_quantity" min="0" value="{{ old('total_quantity') }}" required
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        </div>
                    </div>
                    <div class="mt-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Item Image</label>
                        
                        <!-- Image Selector -->
                        <div class="space-y-4">
                            <!-- Selected Image Preview -->
                            <div id="image-preview" class="hidden">
                                <div class="flex items-center space-x-4 p-4 border-2 border-blue-300 rounded-lg bg-blue-50">
                                    <img id="preview-img" src="" alt="Selected image" class="h-20 w-20 object-cover rounded-lg">
                                    <div>
                                        <p class="text-sm font-medium text-gray-900">Selected: <span id="selected-filename"></span></p>
                                        <button type="button" onclick="clearImageSelection()" class="text-red-600 hover:text-red-800 text-sm">Clear Selection</button>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Image Grid -->
                            <div class="border border-gray-300 rounded-lg p-4">
                                <div class="flex items-center justify-between mb-3">
                                    <label class="text-sm font-medium text-gray-700">Choose from available images:</label>
                                    <button type="button" onclick="toggleImageGrid()" class="text-blue-600 hover:text-blue-800 text-sm">
                                        <span id="toggle-text">Show Images</span>
                                    </button>
                                </div>
                                
                                <div id="image-grid" class="hidden grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-3 max-h-60 overflow-y-auto">
                                    @php
                                        $images = \App\Helpers\ImageHelper::getAvailableItemImages();
                                    @endphp
                                    
                                    @if(empty($images))
                                        <div class="col-span-full text-center py-8">
                                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                            </svg>
                                            <p class="mt-2 text-sm text-gray-500">No images found</p>
                                            <p class="text-xs text-gray-400">Add images to <code>public/images/items</code> folder</p>
                                        </div>
                                    @else
                                        @foreach($images as $image)
                                            <div class="relative group cursor-pointer" onclick="selectImage('{{ $image['filename'] }}', '{{ $image['url'] }}')">
                                                <img src="{{ $image['url'] }}" alt="{{ $image['filename'] }}" 
                                                     class="h-16 w-16 object-cover rounded-lg border-2 border-gray-200 group-hover:border-blue-400 transition-colors">
                                                <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-10 rounded-lg transition-all"></div>
                                                
                                                <!-- Image info on hover -->
                                                <div class="absolute bottom-0 left-0 right-0 bg-black bg-opacity-75 text-white text-xs p-1 rounded-b-lg opacity-0 group-hover:opacity-100 transition-opacity">
                                                    <div class="truncate">{{ $image['filename'] }}</div>
                                                    <div class="text-gray-300">{{ number_format($image['size'] / 1024, 1) }} KB</div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                            
                            <!-- Fallback URL Input -->
                            <div class="mt-4">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Or enter image URL:</label>
                                <input type="url" id="image_url" name="image_url" value="{{ old('image_url') }}"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                       placeholder="https://example.com/image.jpg">
                                <p class="mt-1 text-xs text-gray-500">Use this for external images</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Fish Specific Fields -->
                <div id="fish-fields" class="border-b border-gray-200 pb-6 hidden">
                    <h2 class="text-lg font-medium text-gray-900 mb-6 flex items-center">
                        <svg class="w-5 h-5 text-blue-600 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 4 7.5 4S4.168 5.477 3 6.253v13C4 20.732 5.477 6.753 7.5c0 1.247 1.168 2.253 3 2.253v13c0 1.768 1.832 3 3 3 .992 0 1.835-.832 3-3 3z"/>
                        </svg>
                        Fish Details
                    </h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-4">
                            <div>
                                <label for="fish_data_name" class="block text-sm font-medium text-gray-700 mb-2">Fish Name *</label>
                                <input type="text" id="fish_data_name" name="fish_data[name]" value="{{ old('fish_data.name') }}"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                            </div>
                            <div>
                                <label for="fish_data_scientific_name" class="block text-sm font-medium text-gray-700 mb-2">Scientific Name</label>
                                <input type="text" id="fish_data_scientific_name" name="fish_data[scientific_name]" value="{{ old('fish_data.scientific_name') }}"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors italic"
                                    placeholder="e.g., Paracheirodon innesi">
                            </div>
                            <div>
                                <label for="fish_data_price" class="block text-sm font-medium text-gray-700 mb-2">Fish Price ($) *</label>
                                <div class="relative">
                                    <span class="absolute left-3 top-3 text-gray-500">$</span>
                                    <input type="number" id="fish_data_price" name="fish_data[price]" step="0.01" min="0" value="{{ old('fish_data.price') }}"
                                        class="w-full pl-8 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                                </div>
                            </div>
                            <div>
                                <label for="fish_data_quantity" class="block text-sm font-medium text-gray-700 mb-2">Fish Quantity *</label>
                                <input type="number" id="fish_data_quantity" name="fish_data[quantity]" min="1" value="{{ old('fish_data.quantity') }}"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                            </div>
                        </div>
                        
                        <div class="space-y-4">
                            <div>
                                <label for="fish_data_size" class="block text-sm font-medium text-gray-700 mb-2">Size *</label>
                                <select id="fish_data_size" name="fish_data[size]"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors bg-white">
                                    <option value="">Select Size</option>
                                    <option value="small" {{ old('fish_data.size') == 'small' ? 'selected' : '' }}>Small</option>
                                    <option value="medium" {{ old('fish_data.size') == 'medium' ? 'selected' : '' }}>Medium</option>
                                    <option value="large" {{ old('fish_data.size') == 'large' ? 'selected' : '' }}>Large</option>
                                </select>
                            </div>
                            <div>
                                <label for="fish_data_water_type" class="block text-sm font-medium text-gray-700 mb-2">Water Type *</label>
                                <select id="fish_data_water_type" name="fish_data[water_type]"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors bg-white">
                                    <option value="">Select Water Type</option>
                                    <option value="freshwater" {{ old('fish_data.water_type') == 'freshwater' ? 'selected' : '' }}>
                                        🌊 Freshwater
                                    </option>
                                    <option value="saltwater" {{ old('fish_data.water_type') == 'saltwater' ? 'selected' : '' }}>
                                        🌊 Saltwater
                                    </option>
                                </select>
                            </div>
                            <div>
                                <label for="fish_data_temperament" class="block text-sm font-medium text-gray-700 mb-2">Temperament</label>
                                <div class="relative">
                                    <span class="absolute left-3 top-3 text-gray-500">😊</span>
                                    <input type="text" id="fish_data_temperament" name="fish_data[temperament]" value="{{ old('fish_data.temperament') }}"
                                        class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                        placeholder="e.g., Peaceful, Aggressive, Semi-aggressive">
                                </div>
                            </div>
                            <div>
                                <label for="fish_data_diet" class="block text-sm font-medium text-gray-700 mb-2">Diet</label>
                                <div class="relative">
                                    <span class="absolute left-3 top-3 text-gray-500">🍽</span>
                                    <input type="text" id="fish_data_diet" name="fish_data[diet]" value="{{ old('fish_data.diet') }}"
                                        class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                        placeholder="e.g., Omnivore, Carnivore, Herbivore">
                                </div>
                            </div>
                            <div>
                                <label for="fish_data_min_tank_size" class="block text-sm font-medium text-gray-700 mb-2">Min Tank Size (gallons)</label>
                                <div class="relative">
                                    <span class="absolute left-3 top-3 text-gray-500">🐠</span>
                                    <input type="number" id="fish_data_min_tank_size" name="fish_data[min_tank_size]" min="1" value="{{ old('fish_data.min_tank_size') }}"
                                        class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                        placeholder="Minimum aquarium size in gallons">
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Fish Care Tips -->
                    <div class="mt-6 p-4 bg-blue-50 border border-blue-200 rounded-lg">
                        <div class="flex items-start">
                            <svg class="w-5 h-5 text-blue-600 mr-2 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h1m1-4h1M3 21h18a2 2 0 002-2V5a2 2 0 00-2-2H3a2 2 0 00-2 2v14a2 2 0 002 2z"/>
                            </svg>
                            <div>
                                <h4 class="text-sm font-medium text-blue-800 mb-1">Fish Care Tips</h4>
                                <ul class="text-sm text-blue-700 space-y-1">
                                    <li>• Research fish compatibility before adding to community tanks</li>
                                    <li>• Maintain appropriate water temperature and pH levels</li>
                                    <li>• Provide proper filtration and regular water changes</li>
                                    <li>• Feed appropriate diet and avoid overfeeding</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Plant Specific Fields -->
                <div id="plant-fields" class="border-b border-gray-200 pb-6 hidden">
                    <h2 class="text-lg font-medium text-gray-900 mb-6 flex items-center">
                        <svg class="w-5 h-5 text-green-600 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8-4M2 7l8 4 8 4m0 8l-8-4-8-4m0 8l8 4 8 4m-8-4v8m0 4.354a6 6 0 011.707 1.293l5.414 5.414a1 1 0 01.707.293H11.586a1 1 0 01-.707-.293l-5.414-5.414A1 1 0 016.586 13H4"/>
                        </svg>
                        Plant Details
                    </h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-4">
                            <div>
                                <label for="plant_data_name" class="block text-sm font-medium text-gray-700 mb-2">Plant Name *</label>
                                <input type="text" id="plant_data_name" name="plant_data[name]" value="{{ old('plant_data.name') }}"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors">
                            </div>
                            <div>
                                <label for="plant_data_scientific_name" class="block text-sm font-medium text-gray-700 mb-2">Scientific Name</label>
                                <input type="text" id="plant_data_scientific_name" name="plant_data[scientific_name]" value="{{ old('plant_data.scientific_name') }}"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors italic"
                                    placeholder="e.g., Anubias nana">
                            </div>
                            <div>
                                <label for="plant_data_price" class="block text-sm font-medium text-gray-700 mb-2">Plant Price ($) *</label>
                                <div class="relative">
                                    <span class="absolute left-3 top-3 text-gray-500">$</span>
                                    <input type="number" id="plant_data_price" name="plant_data[price]" step="0.01" min="0" value="{{ old('plant_data.price') }}"
                                        class="w-full pl-8 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors">
                                </div>
                            </div>
                            <div>
                                <label for="plant_data_quantity" class="block text-sm font-medium text-gray-700 mb-2">Plant Quantity *</label>
                                <input type="number" id="plant_data_quantity" name="plant_data[quantity]" min="1" value="{{ old('plant_data.quantity') }}"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors">
                            </div>
                        </div>
                        
                        <div class="space-y-4">
                            <div>
                                <label for="plant_data_size" class="block text-sm font-medium text-gray-700 mb-2">Size *</label>
                                <select id="plant_data_size" name="plant_data[size]"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors bg-white">
                                    <option value="">Select Size</option>
                                    <option value="small" {{ old('plant_data.size') == 'small' ? 'selected' : '' }}>🌱 Small</option>
                                    <option value="medium" {{ old('plant_data.size') == 'medium' ? 'selected' : '' }}>🌿 Medium</option>
                                    <option value="large" {{ old('plant_data.size') == 'large' ? 'selected' : '' }}>🌳 Large</option>
                                </select>
                            </div>
                            <div>
                                <label for="plant_data_light_requirements" class="block text-sm font-medium text-gray-700 mb-2">Light Requirements *</label>
                                <select id="plant_data_light_requirements" name="plant_data[light_requirements]"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors bg-white">
                                    <option value="">Select Light Level</option>
                                    <option value="low" {{ old('plant_data.light_requirements') == 'low' ? 'selected' : '' }}>💡 Low Light</option>
                                    <option value="medium" {{ old('plant_data.light_requirements') == 'medium' ? 'selected' : '' }}>🔆 Medium Light</option>
                                    <option value="high" {{ old('plant_data.light_requirements') == 'high' ? 'selected' : '' }}>☀️ High Light</option>
                                </select>
                            </div>
                            <div>
                                <label for="plant_data_co2_requirement" class="block text-sm font-medium text-gray-700 mb-2">CO2 Requirement *</label>
                                <select id="plant_data_co2_requirement" name="plant_data[co2_requirement]"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors bg-white">
                                    <option value="">Select CO2 Level</option>
                                    <option value="low" {{ old('plant_data.co2_requirement') == 'low' ? 'selected' : '' }}>🌬 Low CO2</option>
                                    <option value="high" {{ old('plant_data.co2_requirement') == 'high' ? 'selected' : '' }}>💨 High CO2</option>
                                </select>
                            </div>
                            <div>
                                <label for="plant_data_difficulty_level" class="block text-sm font-medium text-gray-700 mb-2">Difficulty Level *</label>
                                <select id="plant_data_difficulty_level" name="plant_data[difficulty_level]"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors bg-white">
                                    <option value="">Select Difficulty</option>
                                    <option value="easy" {{ old('plant_data.difficulty_level') == 'easy' ? 'selected' : '' }}>🌱 Easy</option>
                                    <option value="medium" {{ old('plant_data.difficulty_level') == 'medium' ? 'selected' : '' }}>🌱 Medium</option>
                                    <option value="hard" {{ old('plant_data.difficulty_level') == 'hard' ? 'selected' : '' }}>🌱 Hard</option>
                                </select>
                            </div>
                            <div>
                                <label for="plant_data_growth_rate" class="block text-sm font-medium text-gray-700 mb-2">Growth Rate *</label>
                                <select id="plant_data_growth_rate" name="plant_data[growth_rate]"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors bg-white">
                                    <option value="">Select Growth Rate</option>
                                    <option value="slow" {{ old('plant_data.growth_rate') == 'slow' ? 'selected' : '' }}>🐌 Slow Growing</option>
                                    <option value="medium" {{ old('plant_data.growth_rate') == 'medium' ? 'selected' : '' }}>🌱 Medium Growing</option>
                                    <option value="fast" {{ old('plant_data.growth_rate') == 'fast' ? 'selected' : '' }}>🚀 Fast Growing</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Plant Care Tips -->
                    <div class="mt-6 p-4 bg-green-50 border border-green-200 rounded-lg">
                        <div class="flex items-start">
                            <svg class="w-5 h-5 text-green-600 mr-2 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 4 7.5 4S4.168 5.477 3 6.253v13C4 20.732 5.477 6.753 7.5c0 1.247 1.168 2.253 3 2.253v13c0 1.768 1.832 3 3 3 .992 0 1.835-.832 3-3 3z"/>
                            </svg>
                            <div>
                                <h4 class="text-sm font-medium text-green-800 mb-1">Plant Care Tips</h4>
                                <ul class="text-sm text-green-700 space-y-1">
                                    <li>• Choose appropriate lighting for your plant species</li>
                                    <li>• Provide proper nutrients through substrate or water column</li>
                                    <li>• Maintain CO2 levels for demanding plant species</li>
                                    <li>• Trim regularly to promote healthy growth</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Submit Buttons -->
                <div class="flex justify-end space-x-4">
                    <a href="{{ route('aquarium-items.index') }}" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                        Cancel
                    </a>
                    <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                        Create Item
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const typeSelect = document.getElementById('type');
    const fishFields = document.getElementById('fish-fields');
    const plantFields = document.getElementById('plant-fields');

    function toggleFields() {
        const selectedType = typeSelect.value;
        
        if (selectedType === 'fish') {
            fishFields.classList.remove('hidden');
            plantFields.classList.add('hidden');
        } else if (selectedType === 'plant') {
            fishFields.classList.add('hidden');
            plantFields.classList.remove('hidden');
        } else {
            fishFields.classList.add('hidden');
            plantFields.classList.add('hidden');
        }
    }

    typeSelect.addEventListener('change', toggleFields);
    toggleFields();
});

// Image selection functions
function toggleImageGrid() {
    const grid = document.getElementById('image-grid');
    const toggleText = document.getElementById('toggle-text');
    
    if (grid.classList.contains('hidden')) {
        grid.classList.remove('hidden');
        toggleText.textContent = 'Hide Images';
    } else {
        grid.classList.add('hidden');
        toggleText.textContent = 'Show Images';
    }
}

function selectImage(filename, url) {
    const preview = document.getElementById('image-preview');
    const previewImg = document.getElementById('preview-img');
    const selectedFilename = document.getElementById('selected-filename');
    const imageUrlInput = document.getElementById('image_url');
    
    // Show preview
    preview.classList.remove('hidden');
    previewImg.src = url;
    selectedFilename.textContent = filename;
    
    // Set the URL input value
    imageUrlInput.value = url;
    
    // Hide grid after selection
    document.getElementById('image-grid').classList.add('hidden');
    document.getElementById('toggle-text').textContent = 'Show Images';
    
    // Add selected styling to the chosen image
    document.querySelectorAll('#image-grid .group').forEach(img => {
        img.classList.remove('ring-2', 'ring-blue-500');
    });
    
    // Find and highlight selected image
    const selectedImage = document.querySelector(`img[alt="${filename}"]`);
    if (selectedImage) {
        selectedImage.parentElement.classList.add('ring-2', 'ring-blue-500');
    }
}

function clearImageSelection() {
    const preview = document.getElementById('image-preview');
    const imageUrlInput = document.getElementById('image_url');
    
    // Hide preview
    preview.classList.add('hidden');
    
    // Clear URL input
    imageUrlInput.value = '';
    
    // Remove selection styling
    document.querySelectorAll('#image-grid .group').forEach(img => {
        img.classList.remove('ring-2', 'ring-blue-500');
    });
}
</script>
@endsection
