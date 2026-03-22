@extends('layouts.app')

@section('title', 'Item Details - Fin & Flora')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <!-- Header -->
            <div class="bg-gradient-to-r from-blue-600 to-cyan-600 p-6">
                <div class="flex items-center justify-between">
                    <h1 class="text-2xl font-bold text-white">{{ $item->name }}</h1>
                    <div class="flex space-x-3">
                        <a href="{{ route('aquarium-items.edit', $item->id) }}" class="bg-white/20 hover:bg-white/30 text-white px-4 py-2 rounded-lg transition-colors">
                            Edit Item
                        </a>
                        <a href="{{ route('aquarium-items.index') }}" class="bg-white/20 hover:bg-white/30 text-white px-4 py-2 rounded-lg transition-colors">
                            Back to Items
                        </a>
                    </div>
                </div>
            </div>

            <!-- Content -->
            <div class="p-6">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <!-- Left Column - Basic Info -->
                    <div class="space-y-6">
                        <!-- Image -->
                        @if ($item->image_url)
                            <div class="bg-gray-100 rounded-lg overflow-hidden shadow-sm">
                                <img src="{{ $item->image_url }}" alt="{{ $item->name }}" 
                                     class="w-full h-64 object-cover hover:scale-105 transition-transform duration-300" 
                                     onerror="this.src='/images/placeholder.jpg'; this.onerror='';">
                            </div>
                        @else
                            <div class="bg-gray-100 rounded-lg p-8 text-center">
                                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <p class="mt-2 text-sm text-gray-500">No image available</p>
                            </div>
                        @endif

                        <!-- Basic Information -->
                        <div class="bg-gray-50 rounded-lg p-6">
                            <h2 class="text-lg font-semibold text-gray-900 mb-4">Basic Information</h2>
                            <dl class="space-y-3">
                                <div class="flex justify-between">
                                    <dt class="text-sm font-medium text-gray-500">Category:</dt>
                                    <dd>
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                            @if ($item->category === 'fish') bg-blue-100 text-blue-800
                                            @elseif ($item->category === 'plant') bg-green-100 text-green-800
                                            @else bg-gray-100 text-gray-800
                                            @endif">
                                            {{ ucfirst($item->category) }}
                                        </span>
                                    </dd>
                                </div>
                                <div class="flex justify-between">
                                    <dt class="text-sm font-medium text-gray-500">Type:</dt>
                                    <dd class="text-sm text-gray-900">{{ ucfirst($item->type) }}</dd>
                                </div>
                                <div class="flex justify-between">
                                    <dt class="text-sm font-medium text-gray-500">Status:</dt>
                                    <dd>
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                            @if ($item->status === 'available') bg-green-100 text-green-800
                                            @elseif ($item->status === 'unavailable') bg-yellow-100 text-yellow-800
                                            @else bg-red-100 text-red-800
                                            @endif">
                                            {{ ucfirst($item->status) }}
                                        </span>
                                    </dd>
                                </div>
                                <div class="flex justify-between">
                                    <dt class="text-sm font-medium text-gray-500">Total Quantity:</dt>
                                    <dd class="text-sm text-gray-900">{{ $item->total_quantity }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Description:</dt>
                                    <dd class="text-sm text-gray-900 mt-1">{{ $item->description }}</dd>
                                </div>
                                @if ($item->care_instructions)
                                    <div>
                                        <dt class="text-sm font-medium text-gray-500">Care Instructions:</dt>
                                        <dd class="text-sm text-gray-900 mt-1">{{ $item->care_instructions }}</dd>
                                    </div>
                                @endif
                            </dl>
                        </div>

                        <!-- Pricing -->
                        <div class="bg-gray-50 rounded-lg p-6">
                            <h2 class="text-lg font-semibold text-gray-900 mb-4">Pricing</h2>
                            <dl class="space-y-3">
                                <div class="flex justify-between">
                                    <dt class="text-sm font-medium text-gray-500">Price:</dt>
                                    <dd class="text-2xl font-bold text-gray-900">${{ number_format($item->price, 2) }}</dd>
                                </div>
                                @if ($item->discount_price)
                                    <div class="flex justify-between">
                                        <dt class="text-sm font-medium text-gray-500">Discount Price:</dt>
                                        <dd class="text-2xl font-bold text-green-600">${{ number_format($item->discount_price, 2) }}</dd>
                                    </div>
                                    <div class="flex justify-between">
                                        <dt class="text-sm font-medium text-gray-500">Discount:</dt>
                                        <dd class="text-lg font-semibold text-green-600">{{ $item->discount_percentage }}%</dd>
                                    </div>
                                @endif
                            </dl>
                        </div>
                    </div>

                    <!-- Right Column - Type Specific Details -->
                    <div class="space-y-6">
                        @if ($item->type === 'fish' && $item->fish->isNotEmpty())
                            <!-- Fish Details -->
                            <div class="bg-gradient-to-br from-blue-50 to-cyan-50 rounded-xl p-6 shadow-sm border border-blue-100">
                                <div class="flex items-center mb-6">
                                    <div class="bg-blue-100 rounded-lg p-3 mr-4">
                                        <svg class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 4 7.5 4S4.168 5.477 3 6.253v13C4 20.732 5.477 6.753 7.5c0 1.247 1.168 2.253 3 2.253v13c0 1.768 1.832 3 3 3 .992 0 1.835-.832 3-3 3z"/>
                                        </svg>
                                    </div>
                                    <div>
                                        <h2 class="text-xl font-bold text-gray-900">Fish Details</h2>
                                        <p class="text-sm text-gray-600">Specific information about this fish</p>
                                    </div>
                                </div>
                                
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <!-- Basic Fish Info -->
                                    <div class="space-y-4">
                                        <div class="bg-white rounded-lg p-4 border border-blue-100">
                                            <h3 class="text-sm font-semibold text-gray-700 mb-3">Basic Information</h3>
                                            <div class="space-y-3">
                                                <div class="flex items-center justify-between">
                                                    <span class="text-sm text-gray-600">Name:</span>
                                                    <span class="text-sm font-medium text-gray-900">{{ $item->fish->first()->name }}</span>
                                                </div>
                                                @if ($item->fish->first()->scientific_name)
                                                    <div class="flex items-center justify-between">
                                                        <span class="text-sm text-gray-600">Scientific:</span>
                                                        <span class="text-sm font-medium text-gray-900 italic">{{ $item->fish->first()->scientific_name }}</span>
                                                    </div>
                                                @endif
                                                <div class="flex items-center justify-between">
                                                    <span class="text-sm text-gray-600">Size:</span>
                                                    <span class="px-2 py-1 text-xs font-medium bg-blue-100 text-blue-800 rounded-full">{{ ucfirst($item->fish->first()->size) }}</span>
                                                </div>
                                                <div class="flex items-center justify-between">
                                                    <span class="text-sm text-gray-600">Water Type:</span>
                                                    <span class="px-2 py-1 text-xs font-medium rounded-full 
                                                        @if ($item->fish->first()->water_type === 'freshwater') bg-blue-100 text-blue-800
                                                        @else bg-cyan-100 text-cyan-800
                                                        @endif">
                                                        {{ ucfirst($item->fish->first()->water_type) }}
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        @if ($item->fish->first()->temperament || $item->fish->first()->diet)
                                            <div class="bg-white rounded-lg p-4 border border-blue-100">
                                                <h3 class="text-sm font-semibold text-gray-700 mb-3">Behavior & Diet</h3>
                                                <div class="space-y-3">
                                                    @if ($item->fish->first()->temperament)
                                                        <div class="flex items-center justify-between">
                                                            <span class="text-sm text-gray-600">Temperament:</span>
                                                            <span class="text-sm font-medium text-gray-900">{{ $item->fish->first()->temperament }}</span>
                                                        </div>
                                                    @endif
                                                    @if ($item->fish->first()->diet)
                                                        <div class="flex items-center justify-between">
                                                            <span class="text-sm text-gray-600">Diet:</span>
                                                            <span class="text-sm font-medium text-gray-900">{{ $item->fish->first()->diet }}</span>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                    
                                    <!-- Requirements & Pricing -->
                                    <div class="space-y-4">
                                        @if ($item->fish->first()->min_tank_size)
                                            <div class="bg-white rounded-lg p-4 border border-blue-100">
                                                <h3 class="text-sm font-semibold text-gray-700 mb-3">Tank Requirements</h3>
                                                <div class="text-center py-3">
                                                    <div class="text-2xl font-bold text-blue-600">{{ $item->fish->first()->min_tank_size }}</div>
                                                    <div class="text-sm text-gray-600">gallons minimum</div>
                                                    <div class="mt-2 text-xs text-gray-500">Minimum aquarium size for healthy environment</div>
                                                </div>
                                            </div>
                                        @endif
                                        
                                        <div class="bg-white rounded-lg p-4 border border-blue-100">
                                            <h3 class="text-sm font-semibold text-gray-700 mb-3">Pricing & Stock</h3>
                                            <div class="space-y-3">
                                                <div class="flex items-center justify-between">
                                                    <span class="text-sm text-gray-600">Fish Price:</span>
                                                    <span class="text-lg font-bold text-green-600">${{ number_format($item->fish->first()->price, 2) }}</span>
                                                </div>
                                                <div class="flex items-center justify-between">
                                                    <span class="text-sm text-gray-600">Quantity:</span>
                                                    <span class="px-2 py-1 text-xs font-medium rounded-full 
                                                        @if ($item->fish->first()->quantity > 10) bg-green-100 text-green-800
                                                        @elseif ($item->fish->first()->quantity > 5) bg-yellow-100 text-yellow-800
                                                        @else bg-red-100 text-red-800
                                                        @endif">
                                                        {{ $item->fish->first()->quantity }} available
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @elseif ($item->type === 'plant' && $item->plants->isNotEmpty())
                            <!-- Plant Details -->
                            <div class="bg-green-50 rounded-lg p-6">
                                <h2 class="text-lg font-semibold text-gray-900 mb-4">Plant Details</h2>
                                <dl class="space-y-3">
                                    <div>
                                        <dt class="text-sm font-medium text-gray-500">Plant Name:</dt>
                                        <dd class="text-sm text-gray-900">{{ $item->plants->first()->name }}</dd>
                                    </div>
                                    @if ($item->plants->first()->scientific_name)
                                        <div>
                                            <dt class="text-sm font-medium text-gray-500">Scientific Name:</dt>
                                            <dd class="text-sm text-gray-900 italic">{{ $item->plants->first()->scientific_name }}</dd>
                                        </div>
                                    @endif
                                    <div>
                                        <dt class="text-sm font-medium text-gray-500">Size:</dt>
                                        <dd class="text-sm text-gray-900">{{ ucfirst($item->plants->first()->size) }}</dd>
                                    </div>
                                    <div>
                                        <dt class="text-sm font-medium text-gray-500">Light Requirements:</dt>
                                        <dd>
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                @if ($item->plants->first()->light_requirements === 'low') bg-yellow-100 text-yellow-800
                                                @elseif ($item->plants->first()->light_requirements === 'medium') bg-orange-100 text-orange-800
                                                @else bg-red-100 text-red-800
                                                @endif">
                                                {{ ucfirst($item->plants->first()->light_requirements) }}
                                            </span>
                                        </dd>
                                    </div>
                                    <div>
                                        <dt class="text-sm font-medium text-gray-500">CO2 Requirement:</dt>
                                        <dd>
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                @if ($item->plants->first()->co2_requirement === 'low') bg-green-100 text-green-800
                                                @else bg-red-100 text-red-800
                                                @endif">
                                                {{ ucfirst($item->plants->first()->co2_requirement) }}
                                            </span>
                                        </dd>
                                    </div>
                                    <div>
                                        <dt class="text-sm font-medium text-gray-500">Difficulty Level:</dt>
                                        <dd>
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                @if ($item->plants->first()->difficulty_level === 'easy') bg-green-100 text-green-800
                                                @elseif ($item->plants->first()->difficulty_level === 'medium') bg-yellow-100 text-yellow-800
                                                @else bg-red-100 text-red-800
                                                @endif">
                                                {{ ucfirst($item->plants->first()->difficulty_level) }}
                                            </span>
                                        </dd>
                                    </div>
                                    <div>
                                        <dt class="text-sm font-medium text-gray-500">Growth Rate:</dt>
                                        <dd>
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                @if ($item->plants->first()->growth_rate === 'slow') bg-blue-100 text-blue-800
                                                @elseif ($item->plants->first()->growth_rate === 'medium') bg-gray-100 text-gray-800
                                                @else bg-green-100 text-green-800
                                                @endif">
                                                {{ ucfirst($item->plants->first()->growth_rate) }}
                                            </span>
                                        </dd>
                                    </div>
                                    <div>
                                        <dt class="text-sm font-medium text-gray-500">Plant Price:</dt>
                                        <dd class="text-lg font-semibold text-gray-900">${{ number_format($item->plants->first()->price, 2) }}</dd>
                                    </div>
                                    <div>
                                        <dt class="text-sm font-medium text-gray-500">Plant Quantity:</dt>
                                        <dd class="text-sm text-gray-900">{{ $item->plants->first()->quantity }}</dd>
                                    </div>
                                </dl>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Footer -->
                <div class="bg-gray-50 px-6 py-4 flex justify-between items-center">
                    <div class="text-sm text-gray-500">
                        Created by {{ $item->manager->name }} on {{ $item->created_at->format('F j, Y, g:i A') }}
                    </div>
                    <div class="flex space-x-3">
                        <a href="{{ route('aquarium-items.edit', $item->id) }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition-colors">
                            Edit Item
                        </a>
                        <form action="{{ route('aquarium-items.destroy', $item->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg transition-colors" onclick="return confirm('Are you sure you want to delete this item?')">
                                Delete Item
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
