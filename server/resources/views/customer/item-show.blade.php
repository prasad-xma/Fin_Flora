@extends('layouts.app')

@section('title', 'Item Details')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 via-white to-green-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Breadcrumb -->
        <nav class="flex mb-8" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ route('welcome') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                        </svg>
                        Home
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">{{ $item->name }}</span>
                    </div>
                </li>
            </ol>
        </nav>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            <!-- Product Images -->
            <div class="space-y-4">
                <!-- Main Image -->
                <div class="relative bg-white rounded-2xl shadow-xl overflow-hidden">
                    @if($item->image_url)
                        <img src="{{ $item->image_url }}" 
                             alt="{{ $item->name }}" 
                             class="w-full h-96 object-cover"
                             onerror="this.src='/images/placeholder.jpg'">
                    @else
                        <div class="w-full h-96 flex items-center justify-center bg-gradient-to-br from-blue-100 to-green-100">
                            <div class="text-center">
                                @if($item->category === 'fish')
                                    <svg class="w-32 h-32 text-blue-400 mx-auto mb-4" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 20l-3-3h2V9h2v8h2l-3 3zm0-18C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z"/>
                                    </svg>
                                @elseif($item->category === 'plant')
                                    <svg class="w-32 h-32 text-green-400 mx-auto mb-4" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm-1-13h2v6h-2zm0 8h2v2h-2z"/>
                                    </svg>
                                @else
                                    <svg class="w-32 h-32 text-gray-400 mx-auto mb-4" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/>
                                    </svg>
                                @endif
                                <p class="text-gray-500 text-lg">No Image Available</p>
                            </div>
                        </div>
                    @endif
                    
                    <!-- Status Badge -->
                    <div class="absolute top-4 right-4">
                        @if($item->status === 'available')
                            <span class="bg-green-500 text-white text-sm px-3 py-1 rounded-full font-semibold shadow-lg flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                                Available
                            </span>
                        @elseif($item->status === 'unavailable')
                            <span class="bg-yellow-500 text-white text-sm px-3 py-1 rounded-full font-semibold shadow-lg flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                </svg>
                                Unavailable
                            </span>
                        @endif
                    </div>
                </div>

                <!-- Thumbnail Gallery (Placeholder for future) -->
                <div class="grid grid-cols-4 gap-2">
                    <div class="bg-white rounded-lg p-2 border-2 border-blue-500">
                        <div class="aspect-square bg-gray-100 rounded"></div>
                    </div>
                    <div class="bg-white rounded-lg p-2 border border-gray-200 hover:border-blue-300 transition-colors cursor-pointer">
                        <div class="aspect-square bg-gray-100 rounded"></div>
                    </div>
                    <div class="bg-white rounded-lg p-2 border border-gray-200 hover:border-blue-300 transition-colors cursor-pointer">
                        <div class="aspect-square bg-gray-100 rounded"></div>
                    </div>
                    <div class="bg-white rounded-lg p-2 border border-gray-200 hover:border-blue-300 transition-colors cursor-pointer">
                        <div class="aspect-square bg-gray-100 rounded"></div>
                    </div>
                </div>
            </div>

            <!-- Product Details -->
            <div class="space-y-6">
                <!-- Title and Price -->
                <div>
                    <div class="flex items-start justify-between mb-4">
                        <div>
                            <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $item->name }}</h1>
                            <div class="flex items-center space-x-4 text-sm text-gray-500">
                                <span class="flex items-center capitalize">
                                    @if($item->category === 'fish')
                                        <svg class="w-4 h-4 mr-1 text-blue-500" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M12 20l-3-3h2V9h2v8h2l-3 3zm0-18C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2z"/>
                                        </svg>
                                    @elseif($item->category === 'plant')
                                        <svg class="w-4 h-4 mr-1 text-green-500" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2z"/>
                                        </svg>
                                    @else
                                        <svg class="w-4 h-4 mr-1 text-gray-500" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2z"/>
                                        </svg>
                                    @endif
                                    {{ $item->category }}
                                </span>
                                <span class="flex items-center">
                                    <svg class="w-4 h-4 mr-1 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3z"/>
                                    </svg>
                                    {{ $item->total_quantity }} in stock
                                </span>
                            </div>
                        </div>
                        <div class="text-right">
                            <div class="text-3xl font-bold text-green-600">
                                ${{ number_format($item->price, 2) }}
                            </div>
                            @if($item->discount_price)
                                <div class="text-lg text-red-500 line-through">
                                    ${{ number_format($item->discount_price, 2) }}
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Description -->
                <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
                    <h3 class="text-lg font-semibold text-gray-900 mb-3">Description</h3>
                    <p class="text-gray-600 leading-relaxed">{{ $item->description }}</p>
                </div>

                <!-- Type-specific Details -->
                @if($item->type === 'fish' && $item->fish->isNotEmpty())
                    <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Fish Details</h3>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <span class="text-sm text-gray-500">Scientific Name</span>
                                <p class="font-medium text-gray-900">{{ $item->fish->first()->scientific_name ?? 'N/A' }}</p>
                            </div>
                            <div>
                                <span class="text-sm text-gray-500">Size</span>
                                <p class="font-medium text-gray-900 capitalize">{{ $item->fish->first()->size ?? 'N/A' }}</p>
                            </div>
                            <div>
                                <span class="text-sm text-gray-500">Water Type</span>
                                <p class="font-medium text-gray-900 capitalize">{{ $item->fish->first()->water_type ?? 'N/A' }}</p>
                            </div>
                            <div>
                                <span class="text-sm text-gray-500">Temperament</span>
                                <p class="font-medium text-gray-900">{{ $item->fish->first()->temperament ?? 'N/A' }}</p>
                            </div>
                            <div>
                                <span class="text-sm text-gray-500">Diet</span>
                                <p class="font-medium text-gray-900">{{ $item->fish->first()->diet ?? 'N/A' }}</p>
                            </div>
                            <div>
                                <span class="text-sm text-gray-500">Min Tank Size</span>
                                <p class="font-medium text-gray-900">{{ $item->fish->first()->min_tank_size ? $item->fish->first()->min_tank_size . ' gallons' : 'N/A' }}</p>
                            </div>
                        </div>
                    </div>
                @elseif($item->type === 'plant' && $item->plants->isNotEmpty())
                    <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Plant Details</h3>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <span class="text-sm text-gray-500">Scientific Name</span>
                                <p class="font-medium text-gray-900">{{ $item->plants->first()->scientific_name ?? 'N/A' }}</p>
                            </div>
                            <div>
                                <span class="text-sm text-gray-500">Size</span>
                                <p class="font-medium text-gray-900 capitalize">{{ $item->plants->first()->size ?? 'N/A' }}</p>
                            </div>
                            <div>
                                <span class="text-sm text-gray-500">Light Requirements</span>
                                <p class="font-medium text-gray-900 capitalize">{{ $item->plants->first()->light_requirements ?? 'N/A' }}</p>
                            </div>
                            <div>
                                <span class="text-sm text-gray-500">CO2 Requirement</span>
                                <p class="font-medium text-gray-900 capitalize">{{ $item->plants->first()->co2_requirement ?? 'N/A' }}</p>
                            </div>
                            <div>
                                <span class="text-sm text-gray-500">Difficulty Level</span>
                                <p class="font-medium text-gray-900 capitalize">{{ $item->plants->first()->difficulty_level ?? 'N/A' }}</p>
                            </div>
                            <div>
                                <span class="text-sm text-gray-500">Growth Rate</span>
                                <p class="font-medium text-gray-900 capitalize">{{ $item->plants->first()->growth_rate ?? 'N/A' }}</p>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Care Instructions -->
                @if($item->care_instructions)
                    <div class="bg-blue-50 rounded-xl p-6 border border-blue-200">
                        <h3 class="text-lg font-semibold text-blue-900 mb-3 flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                            </svg>
                            Care Instructions
                        </h3>
                        <p class="text-blue-800 leading-relaxed">{{ $item->care_instructions }}</p>
                    </div>
                @endif

                <!-- Add to Cart Section -->
                <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100">
                    <div class="flex items-center space-x-4 mb-4">
                        <label class="text-sm font-medium text-gray-700">Quantity:</label>
                        <div class="flex items-center border border-gray-300 rounded-lg">
                            <button class="px-3 py-2 text-gray-600 hover:text-gray-900 hover:bg-gray-100 transition-colors" onclick="decrementQuantity()">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                                </svg>
                            </button>
                            <input type="number" id="quantity" value="1" min="1" max="{{ $item->total_quantity }}" class="w-16 text-center border-0 focus:ring-0">
                            <button class="px-3 py-2 text-gray-600 hover:text-gray-900 hover:bg-gray-100 transition-colors" onclick="incrementQuantity()">
                                <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                </svg>
                            </button>
                        </div>
                        <span class="text-sm text-gray-500">{{ $item->total_quantity }} available</span>
                    </div>

                    <button class="w-full bg-gradient-to-r from-blue-600 to-cyan-600 hover:from-blue-700 hover:to-cyan-700 text-white px-6 py-3 rounded-xl font-semibold text-lg shadow-lg transform hover:-translate-y-0.5 transition-all duration-200 flex items-center justify-center"
                            onclick="addToCart({{ $item->id }}, this)">
                        <svg class="w-6 h-6 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        Add to Cart
                    </button>

                    <div class="mt-4 flex items-center justify-center space-x-6 text-sm text-gray-500">
                        <span class="flex items-center">
                            <svg class="w-4 h-4 mr-1 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            In Stock
                        </span>
                        <span class="flex items-center">
                            <svg class="w-4 h-4 mr-1 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z"></path>
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd"></path>
                            </svg>
                            Secure Payment
                        </span>
                        <span class="flex items-center">
                            <svg class="w-4 h-4 mr-1 text-purple-500" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M2 6a2 2 0 012-2h12a2 2 0 012 2v8a2 2 0 01-2 2H4a2 2 0 01-2-2V6zm14 0H4v8h12V6z"></path>
                            </svg>
                            Fast Delivery
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function incrementQuantity() {
    const input = document.getElementById('quantity');
    const max = parseInt(input.getAttribute('max'));
    const current = parseInt(input.value);
    if (current < max) {
        input.value = current + 1;
    }
}

function decrementQuantity() {
    const input = document.getElementById('quantity');
    const current = parseInt(input.value);
    if (current > 1) {
        input.value = current - 1;
    }
}

function addToCart(itemId, button) {
    const quantity = document.getElementById('quantity').value;
    
    // Disable button and show loading
    button.disabled = true;
    button.innerHTML = `
        <svg class="w-6 h-6 mr-3 animate-spin" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
        </svg>
        Adding...
    `;
    
    // Make AJAX call to add to cart
    fetch('{{ route("cart.add") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({
            item_id: itemId,
            quantity: quantity
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showNotification(data.message, 'success');
            updateCartCounter(data.cart_count);
        } else {
            showNotification(data.message, 'error');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showNotification('An error occurred. Please try again.', 'error');
    })
    .finally(() => {
        // Restore button
        button.disabled = false;
        button.innerHTML = `
            <svg class="w-6 h-6 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
            </svg>
            Add to Cart
        `;
    });
}

function updateCartCounter(count) {
    // Update cart counter in navigation if it exists
    const cartCounter = document.getElementById('cart-counter');
    if (cartCounter) {
        cartCounter.textContent = count;
        cartCounter.classList.remove('hidden');
        if (count > 0) {
            cartCounter.classList.add('animate-bounce');
            setTimeout(() => {
                cartCounter.classList.remove('animate-bounce');
            }, 1000);
        }
    }
}

function showNotification(message, type = 'success') {
    // Create notification element
    const notification = document.createElement('div');
    notification.className = `fixed top-20 right-4 z-50 p-4 rounded-lg shadow-lg transform translate-x-full transition-transform duration-300 ${
        type === 'success' ? 'bg-green-500 text-white' : 'bg-red-500 text-white'
    }`;
    notification.innerHTML = `
        <div class="flex items-center">
            <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                ${type === 'success' 
                    ? '<path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>'
                    : '<path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>'
                }
            </svg>
            <span>${message}</span>
        </div>
    `;
    
    document.body.appendChild(notification);
    
    // Slide in
    setTimeout(() => {
        notification.style.transform = 'translateX(0)';
    }, 100);
    
    // Remove after 3 seconds
    setTimeout(() => {
        notification.style.transform = 'translateX(100%)';
        setTimeout(() => {
            document.body.removeChild(notification);
        }, 300);
    }, 3000);
}
</script>
@endsection
