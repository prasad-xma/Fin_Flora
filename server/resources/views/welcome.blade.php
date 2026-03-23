@extends('layouts.app')

@section('title', 'Welcome to Fin & Flora')

@section('content')
<!-- Hero Section -->
<section class="bg-gradient-to-br from-blue-600 to-cyan-600 text-white py-24">
    <div class="max-w-4xl mx-auto text-center px-4 sm:px-6 lg:px-8">
        <h1 class="text-4xl md:text-5xl font-bold mb-6">Welcome to Fin & Flora</h1>
        <p class="text-xl md:text-2xl mb-8 opacity-90">Discover the perfect blend of aquatic wisdom and natural beauty</p>
        <a href="{{ route('register.form') }}" class="inline-block bg-white text-blue-600 px-8 py-3 rounded-full font-semibold text-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-200">Get Started Today</a>
    </div>
</section>

<!-- Items Section -->
<section class="py-16 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Featured Aquarium Items</h2>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">Explore our curated collection of premium fish, plants, and equipment for your perfect aquarium setup</p>
        </div>

        <!-- Filter Tabs -->
        <div class="flex justify-center mb-8">
            <div class="bg-white rounded-lg shadow-sm p-1 inline-flex">
                <button onclick="filterItems('all')" class="filter-btn px-6 py-2 rounded-md text-sm font-medium transition-colors bg-blue-600 text-white" data-filter="all">
                    All Items
                </button>
                <button onclick="filterItems('fish')" class="filter-btn px-6 py-2 rounded-md text-sm font-medium transition-colors text-gray-700 hover:bg-gray-100" data-filter="fish">
                    Fish
                </button>
                <button onclick="filterItems('plant')" class="filter-btn px-6 py-2 rounded-md text-sm font-medium transition-colors text-gray-700 hover:bg-gray-100" data-filter="plant">
                    Plants
                </button>
                <button onclick="filterItems('equipment')" class="filter-btn px-6 py-2 rounded-md text-sm font-medium transition-colors text-gray-700 hover:bg-gray-100" data-filter="equipment">
                    Equipment
                </button>
            </div>
        </div>

        <!-- Items Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6" id="items-grid">
            @foreach($items as $item)
                <div class="item-card" data-category="{{ $item->category }}">
                    <x-item-card :item="$item" />
                </div>
            @endforeach
        </div>

        @if($items->isEmpty())
            <div class="text-center py-12">
                <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                </svg>
                <p class="text-gray-500 text-lg">No items available at the moment.</p>
                <p class="text-gray-400 mt-2">Check back soon for new arrivals!</p>
            </div>
        @endif
    </div>
</section>

<!-- Features Section -->
<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl md:text-4xl font-bold text-center text-gray-900 mb-12">What We Offer</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-gray-50 p-8 rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-200 text-center">
                <div class="text-5xl mb-4">🐠</div>
                <h3 class="text-xl font-semibold text-gray-900 mb-4">Premium Fish</h3>
                <p class="text-gray-600 leading-relaxed">Healthy and vibrant fish sourced from trusted breeders, perfect for any aquarium setup.</p>
            </div>
            <div class="bg-gray-50 p-8 rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-200 text-center">
                <div class="text-5xl mb-4">🌿</div>
                <h3 class="text-xl font-semibold text-gray-900 mb-4">Aquatic Plants</h3>
                <p class="text-gray-600 leading-relaxed">Lush, thriving plants that bring life and natural beauty to your underwater world.</p>
            </div>
            <div class="bg-gray-50 p-8 rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-200 text-center">
                <div class="text-5xl mb-4">🔧</div>
                <h3 class="text-xl font-semibold text-gray-900 mb-4">Quality Equipment</h3>
                <p class="text-gray-600 leading-relaxed">Professional-grade equipment to maintain optimal conditions for your aquatic pets.</p>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
function filterItems(category) {
    const allCards = document.querySelectorAll('.item-card');
    const allButtons = document.querySelectorAll('.filter-btn');
    
    // Update button styles
    allButtons.forEach(btn => {
        if (btn.dataset.filter === category) {
            btn.classList.remove('text-gray-700', 'hover:bg-gray-100');
            btn.classList.add('bg-blue-600', 'text-white');
        } else {
            btn.classList.remove('bg-blue-600', 'text-white');
            btn.classList.add('text-gray-700', 'hover:bg-gray-100');
        }
    });
    
    // Filter cards
    allCards.forEach(card => {
        if (category === 'all' || card.dataset.category === category) {
            card.style.display = 'block';
        } else {
            card.style.display = 'none';
        }
    });
}

function addToCart(itemId) {
    // Simple notification for now - you can implement actual cart functionality later
    const notification = document.createElement('div');
    notification.className = 'fixed bottom-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50 flex items-center';
    notification.innerHTML = `
        <svg class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
        </svg>
        Item added to cart!
    `;
    document.body.appendChild(notification);
    
    setTimeout(() => {
        notification.remove();
    }, 3000);
    
    console.log('Added item to cart:', itemId);
}
</script>
@endpush
