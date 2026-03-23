@extends('layouts.app')

@section('title', 'Edit Item - Fin & Flora')

@section('content')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-lg shadow-md p-6 mb-8">
            <div class="flex items-center justify-between mb-6">
                <h1 class="text-2xl font-bold text-gray-900">Edit Aquarium Item</h1>
                <a href="{{ route('aquarium-items.index') }}" class="text-gray-600 hover:text-gray-900">
                    ← Back to Items
                </a>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow-md p-6">
            <form action="{{ route('aquarium-items.update', $aquariumItem->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')
                
                @if ($errors->any())
                    <div class="bg-red-50 border border-red-200 rounded-lg p-4">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm font-medium text-red-800">There were errors with your submission:</p>
                                <ul class="mt-1 text-sm text-red-700">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Basic Information -->
                <div class="border-b border-gray-200 pb-6">
                    <h2 class="text-lg font-medium text-gray-900 mb-6 flex items-center">
                        <svg class="w-5 h-5 text-blue-600 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Basic Information
                    </h2>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Item Name *</label>
                            <input type="text" id="name" name="name" value="{{ old('name', $aquariumItem->name) }}" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                        </div>
                        <div>
                            <label for="category" class="block text-sm font-medium text-gray-700 mb-2">Category *</label>
                            <select id="category" name="category" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors bg-white">
                                <option value="">Select Category</option>
                                <option value="fish" {{ old('category', $aquariumItem->category) == 'fish' ? 'selected' : '' }}>Fish</option>
                                <option value="plant" {{ old('category', $aquariumItem->category) == 'plant' ? 'selected' : '' }}>Plant</option>
                                <option value="equipment" {{ old('category', $aquariumItem->category) == 'equipment' ? 'selected' : '' }}>Equipment</option>
                            </select>
                        </div>
                    </div>

                    <div class="mt-6">
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description *</label>
                        <textarea id="description" name="description" rows="4" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">{{ old('description', $aquariumItem->description) }}</textarea>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-6">
                        <div>
                            <label for="price" class="block text-sm font-medium text-gray-700 mb-2">Price ($) *</label>
                            <div class="relative">
                                <span class="absolute left-3 top-3 text-gray-500">$</span>
                                <input type="number" id="price" name="price" step="0.01" min="0" value="{{ old('price', $aquariumItem->price) }}" required
                                    class="w-full pl-8 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                            </div>
                        </div>
                        <div>
                            <label for="discount_price" class="block text-sm font-medium text-gray-700 mb-2">Discount Price ($)</label>
                            <div class="relative">
                                <span class="absolute left-3 top-3 text-gray-500">$</span>
                                <input type="number" id="discount_price" name="discount_price" step="0.01" min="0" value="{{ old('discount_price', $aquariumItem->discount_price) }}"
                                    class="w-full pl-8 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                            </div>
                        </div>
                        <div>
                            <label for="total_quantity" class="block text-sm font-medium text-gray-700 mb-2">Total Quantity *</label>
                            <input type="number" id="total_quantity" name="total_quantity" min="0" value="{{ old('total_quantity', $aquariumItem->total_quantity) }}" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                        <div>
                            <label for="type" class="block text-sm font-medium text-gray-700 mb-2">Type *</label>
                            <select id="type" name="type" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors bg-white">
                                <option value="">Select Type</option>
                                <option value="fish" {{ old('type', $aquariumItem->type) == 'fish' ? 'selected' : '' }}>Fish</option>
                                <option value="plant" {{ old('type', $aquariumItem->type) == 'plant' ? 'selected' : '' }}>Plant</option>
                            </select>
                        </div>
                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status *</label>
                            <select id="status" name="status" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors bg-white">
                                <option value="">Select Status</option>
                                <option value="available" {{ old('status', $aquariumItem->status) == 'available' ? 'selected' : '' }}>Available</option>
                                <option value="unavailable" {{ old('status', $aquariumItem->status) == 'unavailable' ? 'selected' : '' }}>Unavailable</option>
                                <option value="out_of_stock" {{ old('status', $aquariumItem->status) == 'out_of_stock' ? 'selected' : '' }}>Out of Stock</option>
                            </select>
                        </div>
                    </div>

                    <div class="mt-6">
                        <label for="care_instructions" class="block text-sm font-medium text-gray-700 mb-2">Care Instructions</label>
                        <textarea id="care_instructions" name="care_instructions" rows="3"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">{{ old('care_instructions', $aquariumItem->care_instructions) }}</textarea>
                    </div>
                </div>

                <!-- Image Upload -->
                <div class="border-b border-gray-200 pb-6">
                    <h2 class="text-lg font-medium text-gray-900 mb-6 flex items-center">
                        <svg class="w-5 h-5 text-blue-600 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                        Item Image
                    </h2>
                    
                    <div class="space-y-4">
                        <!-- Current Image Preview -->
                        @if ($aquariumItem->image_url)
                            <div class="flex items-center space-x-4">
                                <img src="{{ $aquariumItem->image_url }}" alt="{{ $aquariumItem->name }}" class="h-16 w-16 object-cover rounded-lg">
                                <div class="text-sm text-gray-600">
                                    <p>Current image</p>
                                    <p class="text-xs">Upload new image to replace</p>
                                </div>
                            </div>
                        @endif
                        
                        <!-- File Upload Area -->
                        <div class="flex items-center space-x-4">
                            <div class="flex-1">
                                <div class="flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg hover:border-gray-400 transition-colors">
                                    <div class="space-y-1 text-center">
                                        <svg class="mx-auto h-8 w-8 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                        <div class="flex text-sm text-gray-600">
                                            <label for="image-upload" class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                                                <span>Upload image</span>
                                                <input id="image-upload" name="image_upload" type="file" class="sr-only" accept="image/*" onchange="handleFileSelect(event)">
                                            </label>
                                        </div>
                                        <p class="pl-1">or drag and drop</p>
                                    </div>
                                    <p class="text-xs text-gray-500">PNG, JPG, GIF up to 10MB</p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- OR Divider -->
                        <div class="relative">
                            <div class="absolute inset-0 flex items-center">
                                <div class="w-full border-t border-gray-300"></div>
                            </div>
                            <div class="relative flex justify-center text-xs">
                                <span class="px-2 bg-white text-gray-500">OR</span>
                            </div>
                        </div>
                        
                        <!-- URL Input -->
                        <div>
                            <label for="image_url" class="block text-sm font-medium text-gray-700 mb-2">Paste image URL:</label>
                            <input type="url" id="image_url" name="image_url" value="{{ old('image_url', $aquariumItem->image_url) }}"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                placeholder="https://example.com/image.jpg">
                        </div>
                        
                        <!-- Preview -->
                        <div id="image-preview" class="hidden">
                            <div class="flex items-center space-x-4">
                                <img id="preview-img" src="" alt="Preview" class="h-16 w-16 object-cover rounded-lg">
                                <div class="flex-1">
                                    <p class="text-sm font-medium text-gray-900">Selected Image</p>
                                    <p id="preview-filename" class="text-sm text-gray-600"></p>
                                </div>
                                <button type="button" onclick="clearImage()" class="text-red-600 hover:text-red-800 text-sm">
                                    Remove
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Fish Specific Fields -->
                <div id="fish-fields" class="border-b border-gray-200 pb-6 {{ $aquariumItem->type !== 'fish' ? 'hidden' : '' }}">
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
                                <input type="text" id="fish_data_name" name="fish_data[name]" value="{{ old('fish_data.name', $aquariumItem->fish->first() ? $aquariumItem->fish->first()->name : '') }}"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                            </div>
                            <div>
                                <label for="fish_data_scientific_name" class="block text-sm font-medium text-gray-700 mb-2">Scientific Name</label>
                                <input type="text" id="fish_data_scientific_name" name="fish_data[scientific_name]" value="{{ old('fish_data.scientific_name', $aquariumItem->fish->first() ? $aquariumItem->fish->first()->scientific_name : '') }}"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors italic"
                                    placeholder="e.g., Paracheirodon innesi">
                            </div>
                            <div>
                                <label for="fish_data_temperament" class="block text-sm font-medium text-gray-700 mb-2">Temperament</label>
                                <input type="text" id="fish_data_temperament" name="fish_data[temperament]" value="{{ old('fish_data.temperament', $aquariumItem->fish->first() ? $aquariumItem->fish->first()->temperament : '') }}"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                    placeholder="e.g., Peaceful, Aggressive, Semi-aggressive">
                            </div>
                            <div>
                                <label for="fish_data_diet" class="block text-sm font-medium text-gray-700 mb-2">Diet</label>
                                <input type="text" id="fish_data_diet" name="fish_data[diet]" value="{{ old('fish_data.diet', $aquariumItem->fish->first() ? $aquariumItem->fish->first()->diet : '') }}"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                    placeholder="e.g., Omnivore, Carnivore, Herbivore">
                            </div>
                            <div>
                                <label for="fish_data_min_tank_size" class="block text-sm font-medium text-gray-700 mb-2">Min Tank Size (gallons)</label>
                                <input type="number" id="fish_data_min_tank_size" name="fish_data[min_tank_size]" min="1" value="{{ old('fish_data.min_tank_size', $aquariumItem->fish->first() ? $aquariumItem->fish->first()->min_tank_size : '') }}"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                                    placeholder="Minimum aquarium size in gallons">
                            </div>
                        </div>
                        
                        <div class="space-y-4">
                            <div>
                                <label for="fish_data_size" class="block text-sm font-medium text-gray-700 mb-2">Size *</label>
                                <select id="fish_data_size" name="fish_data[size]"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors bg-white">
                                    <option value="">Select Size</option>
                                    <option value="small" {{ old('fish_data.size', $aquariumItem->fish->first() ? $aquariumItem->fish->first()->size : '') == 'small' ? 'selected' : '' }}>Small</option>
                                    <option value="medium" {{ old('fish_data.size', $aquariumItem->fish->first() ? $aquariumItem->fish->first()->size : '') == 'medium' ? 'selected' : '' }}>Medium</option>
                                    <option value="large" {{ old('fish_data.size', $aquariumItem->fish->first() ? $aquariumItem->fish->first()->size : '') == 'large' ? 'selected' : '' }}>Large</option>
                                </select>
                            </div>
                            <div>
                                <label for="fish_data_water_type" class="block text-sm font-medium text-gray-700 mb-2">Water Type *</label>
                                <select id="fish_data_water_type" name="fish_data[water_type]"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors bg-white">
                                    <option value="">Select Water Type</option>
                                    <option value="freshwater" {{ old('fish_data.water_type', $aquariumItem->fish->first() ? $aquariumItem->fish->first()->water_type : '') == 'freshwater' ? 'selected' : '' }}>
                                        Freshwater
                                    </option>
                                    <option value="saltwater" {{ old('fish_data.water_type', $aquariumItem->fish->first() ? $aquariumItem->fish->first()->water_type : '') == 'saltwater' ? 'selected' : '' }}>
                                        Saltwater
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Plant Specific Fields -->
                <div id="plant-fields" class="border-b border-gray-200 pb-6 {{ $aquariumItem->type !== 'plant' ? 'hidden' : '' }}">
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
                                <input type="text" id="plant_data_name" name="plant_data[name]" value="{{ old('plant_data.name', $aquariumItem->plants->first() ? $aquariumItem->plants->first()->name : '') }}"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors">
                            </div>
                            <div>
                                <label for="plant_data_scientific_name" class="block text-sm font-medium text-gray-700 mb-2">Scientific Name</label>
                                <input type="text" id="plant_data_scientific_name" name="plant_data[scientific_name]" value="{{ old('plant_data.scientific_name', $aquariumItem->plants->first() ? $aquariumItem->plants->first()->scientific_name : '') }}"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors italic"
                                    placeholder="e.g., Anubias nana">
                            </div>
                            <div>
                                <label for="plant_data_size" class="block text-sm font-medium text-gray-700 mb-2">Size *</label>
                                <select id="plant_data_size" name="plant_data[size]"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors bg-white">
                                    <option value="">Select Size</option>
                                    <option value="small" {{ old('plant_data.size', $aquariumItem->plants->first() ? $aquariumItem->plants->first()->size : '') == 'small' ? 'selected' : '' }}>Small</option>
                                    <option value="medium" {{ old('plant_data.size', $aquariumItem->plants->first() ? $aquariumItem->plants->first()->size : '') == 'medium' ? 'selected' : '' }}>Medium</option>
                                    <option value="large" {{ old('plant_data.size', $aquariumItem->plants->first() ? $aquariumItem->plants->first()->size : '') == 'large' ? 'selected' : '' }}>Large</option>
                                </select>
                            </div>
                            <div>
                                <label for="plant_data_light_requirements" class="block text-sm font-medium text-gray-700 mb-2">Light Requirements *</label>
                                <select id="plant_data_light_requirements" name="plant_data[light_requirements]"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors bg-white">
                                    <option value="">Select Light Level</option>
                                    <option value="low" {{ old('plant_data.light_requirements', $aquariumItem->plants->first() ? $aquariumItem->plants->first()->light_requirements : '') == 'low' ? 'selected' : '' }}>Low Light</option>
                                    <option value="medium" {{ old('plant_data.light_requirements', $aquariumItem->plants->first() ? $aquariumItem->plants->first()->light_requirements : '') == 'medium' ? 'selected' : '' }}>Medium Light</option>
                                    <option value="high" {{ old('plant_data.light_requirements', $aquariumItem->plants->first() ? $aquariumItem->plants->first()->light_requirements : '') == 'high' ? 'selected' : '' }}>High Light</option>
                                </select>
                            </div>
                            <div>
                                <label for="plant_data_co2_requirement" class="block text-sm font-medium text-gray-700 mb-2">CO2 Requirement *</label>
                                <select id="plant_data_co2_requirement" name="plant_data[co2_requirement]"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors bg-white">
                                    <option value="">Select CO2 Level</option>
                                    <option value="low" {{ old('plant_data.co2_requirement', $aquariumItem->plants->first() ? $aquariumItem->plants->first()->co2_requirement : '') == 'low' ? 'selected' : '' }}>Low CO2</option>
                                    <option value="high" {{ old('plant_data.co2_requirement', $aquariumItem->plants->first() ? $aquariumItem->plants->first()->co2_requirement : '') == 'high' ? 'selected' : '' }}>High CO2</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="space-y-4">
                            <div>
                                <label for="plant_data_difficulty_level" class="block text-sm font-medium text-gray-700 mb-2">Difficulty Level *</label>
                                <select id="plant_data_difficulty_level" name="plant_data[difficulty_level]"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors bg-white">
                                    <option value="">Select Difficulty</option>
                                    <option value="easy" {{ old('plant_data.difficulty_level', $aquariumItem->plants->first() ? $aquariumItem->plants->first()->difficulty_level : '') == 'easy' ? 'selected' : '' }}>Easy</option>
                                    <option value="medium" {{ old('plant_data.difficulty_level', $aquariumItem->plants->first() ? $aquariumItem->plants->first()->difficulty_level : '') == 'medium' ? 'selected' : '' }}>Medium</option>
                                    <option value="hard" {{ old('plant_data.difficulty_level', $aquariumItem->plants->first() ? $aquariumItem->plants->first()->difficulty_level : '') == 'hard' ? 'selected' : '' }}>Hard</option>
                                </select>
                            </div>
                            <div>
                                <label for="plant_data_growth_rate" class="block text-sm font-medium text-gray-700 mb-2">Growth Rate *</label>
                                <select id="plant_data_growth_rate" name="plant_data[growth_rate]"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors bg-white">
                                    <option value="">Select Growth Rate</option>
                                    <option value="slow" {{ old('plant_data.growth_rate', $aquariumItem->plants->first() ? $aquariumItem->plants->first()->growth_rate : '') == 'slow' ? 'selected' : '' }}>Slow Growing</option>
                                    <option value="medium" {{ old('plant_data.growth_rate', $aquariumItem->plants->first() ? $aquariumItem->plants->first()->growth_rate : '') == 'medium' ? 'selected' : '' }}>Medium Growing</option>
                                    <option value="fast" {{ old('plant_data.growth_rate', $aquariumItem->plants->first() ? $aquariumItem->plants->first()->growth_rate : '') == 'fast' ? 'selected' : '' }}>Fast Growing</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Submit Buttons -->
                <div class="flex justify-end space-x-4">
                    <a href="{{ route('aquarium-items.index') }}" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50">
                        Cancel
                    </a>
                    <button type="submit" class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors">
                        Update Item
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function toggleFields(type) {
    const fishFields = document.getElementById('fish-fields');
    const plantFields = document.getElementById('plant-fields');
    
    if (type === 'fish') {
        fishFields.classList.remove('hidden');
        plantFields.classList.add('hidden');
    } else if (type === 'plant') {
        fishFields.classList.add('hidden');
        plantFields.classList.remove('hidden');
    } else {
        fishFields.classList.add('hidden');
        plantFields.classList.add('hidden');
    }
}

function handleFileSelect(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('image-preview').classList.remove('hidden');
            document.getElementById('preview-img').src = e.target.result;
            document.getElementById('preview-filename').textContent = file.name;
            document.getElementById('image_url').value = '';
        };
        reader.readAsDataURL(file);
    }
}

function clearImage() {
    document.getElementById('image-preview').classList.add('hidden');
    document.getElementById('preview-img').src = '';
    document.getElementById('preview-filename').textContent = '';
    document.getElementById('image-upload').value = '';
}

document.getElementById('type').addEventListener('change', function() {
    toggleFields(this.value);
});

document.addEventListener('DOMContentLoaded', function() {
    toggleFields(document.getElementById('type').value);
    
    // Check for success/error messages and show SweetAlert
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: '{{ session('success') }}',
            timer: 2000,
            showConfirmButton: false
        });
    @endif

    @if(session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: '{{ session('error') }}',
            confirmButtonText: 'OK'
        });
    @endif
});
</script>
@endsection
