@props(['item'])

<a href="{{ route('aquarium-items.show', $item->id) }}" class="block bg-white rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 overflow-hidden group cursor-pointer transform hover:-translate-y-1">
    <!-- Image Section -->
    <div class="relative h-56 overflow-hidden bg-gradient-to-br from-blue-50 to-green-50">
        @if($item->image_url)
            <img src="{{ $item->image_url }}" 
                 alt="{{ $item->name }}" 
                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                 onerror="this.src='/images/placeholder.jpg'">
        @else
            <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-blue-100 to-green-100">
                <div class="text-center">
                    @if($item->category === 'fish')
                        <svg class="w-20 h-20 text-blue-400 mx-auto mb-2" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 20l-3-3h2V9h2v8h2l-3 3zm0-18C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z"/>
                        </svg>
                    @elseif($item->category === 'plant')
                        <svg class="w-20 h-20 text-green-400 mx-auto mb-2" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm-1-13h2v6h-2zm0 8h2v2h-2z"/>
                        </svg>
                    @else
                        <svg class="w-20 h-20 text-gray-400 mx-auto mb-2" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/>
                        </svg>
                    @endif
                    <p class="text-gray-500 text-sm">No Image</p>
                </div>
            </div>
        @endif
        
        <!-- Status Badge -->
        <div class="absolute top-3 right-3">
            @if($item->status === 'available')
                <span class="bg-green-500 text-white text-xs px-2 py-1 rounded-full font-semibold shadow-lg">
                    Available
                </span>
            @elseif($item->status === 'unavailable')
                <span class="bg-yellow-500 text-white text-xs px-2 py-1 rounded-full font-semibold shadow-lg">
                    Unavailable
                </span>
            @else
                <span class="bg-red-500 text-white text-xs px-2 py-1 rounded-full font-semibold shadow-lg">
                    Out of Stock
                </span>
            @endif
        </div>

        <!-- Category Badge -->
        <!-- <div class="absolute top-3 left-3">
            <span class="bg-white/90 backdrop-blur-sm text-gray-800 text-xs px-2 py-1 rounded-full font-semibold capitalize shadow-sm">
                {{ $item->category }}
            </span>
        </div> -->

        <!-- Quick Actions Overlay -->
        <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-10 transition-all duration-300 flex items-end">
            <div class="w-full p-4 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                <!-- <p class="text-white text-sm font-medium">Click to view details</p> -->
            </div>
        </div>
    </div>

    <!-- Content Section -->
    <div class="p-5">
        <!-- Title and Price -->
        <div class="flex justify-between items-start mb-3">
            <h3 class="text-lg font-bold text-gray-900 line-clamp-1 group-hover:text-blue-600 transition-colors">
                {{ $item->name }}
            </h3>
            <div class="text-right flex-shrink-0 ml-2">
                <div class="text-xl font-bold text-green-600">
                    ${{ number_format($item->price, 2) }}
                </div>
                @if($item->discount_price)
                    <div class="text-sm text-red-500 line-through">
                        ${{ number_format($item->discount_price, 2) }}
                    </div>
                @endif
            </div>
        </div>

        <!-- Description Preview -->
        <p class="text-gray-600 text-sm mb-4 line-clamp-2">
            {{ Str::limit($item->description, 80) }}
        </p>

        <!-- Stock Info -->
        <div class="flex items-center justify-between mb-4">
            <div class="flex items-center text-sm text-gray-500">
                <svg class="w-4 h-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <!-- <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8-4M2 7l8 4 8 4m0 8l-8-4-8-4m0 8l8 4 8 4m-8-4v8m0 4.354a6 6 0 011.707 1.293l5.414 5.414a1 1 0 01.707.293H11.586a1 1 0 01-.707-.293l-5.414-5.414A1 1 0 016.586 13H4"/> -->
                </svg>
                {{ $item->total_quantity }} in stock
            </div>
            <div class="flex items-center text-sm text-gray-500">
                @if($item->type === 'fish')
                    <svg class="w-4 h-4 mr-1 text-blue-500" fill="currentColor" viewBox="0 0 24 24">
                        <!-- <path d="M12 20l-3-3h2V9h2v8h2l-3 3zm0-18C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2z"/> -->
                    </svg>
                    Fish
                @elseif($item->type === 'plant')
                    <svg class="w-4 h-4 mr-1 text-green-500" fill="currentColor" viewBox="0 0 24 24">
                        <!-- <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2z"/> -->
                    </svg>
                    Plant
                @else
                    <svg class="w-4 h-4 mr-1 text-gray-500" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/>
                    </svg>
                    Equipment
                @endif
            </div>
        </div>

        <!-- Add to Cart Button -->
        <button class="w-full bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors flex items-center justify-center"
                onclick="event.stopPropagation(); addToCart({{ $item->id }})">
            <svg class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
            </svg>
            Add to Cart
        </button>
    </div>
</a>
