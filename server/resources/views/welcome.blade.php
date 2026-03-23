@extends('layouts.app')

@section('title', 'Welcome to Fin & Flora')

@section('content')
<!-- Hero Section -->
<section class="relative bg-cover bg-center bg-no-repeat text-white h-screen w-screen" style="background-image: url('/home_img/cute-fish-with-vegetation.jpg');">
    <!-- Enhanced Overlay -->
    <div class="absolute inset-0 hero-overlay"></div>
    <div class="relative max-w-4xl mx-auto text-center px-4 sm:px-6 lg:px-8 flex flex-col justify-center h-full">
        <h1 class="hero-title text-4xl md:text-5xl font-bold mb-6">Welcome to Fin & Flora</h1>
        <p class="hero-description text-xl md:text-2xl mb-8 opacity-90">Discover the perfect blend of aquatic wisdom and natural beauty</p>
        <a href="{{ route('register.form') }}" class="hero-button inline-block text-blue-600 px-8 py-3 rounded-full font-semibold text-lg transition-all duration-200">Get Started Today</a>
    </div>
</section>

<!-- Items Section -->
<section class="items-section py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h2 class="section-title text-3xl md:text-4xl font-bold text-gray-900 mb-4">Featured Aquarium Items</h2>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">Explore our curated collection of premium fish, plants, and equipment for your perfect aquarium setup</p>
        </div>

        <!-- Filter Tabs -->
        <div class="flex justify-center mb-8">
            <div class="filter-container bg-white rounded-lg shadow-sm p-1 inline-flex">
                <button onclick="filterItems('all')" class="filter-btn px-6 py-2 rounded-md text-sm font-medium transition-colors bg-blue-600 text-white" data-filter="all">
                    <span>All Items</span>
                </button>
                <button onclick="filterItems('fish')" class="filter-btn px-6 py-2 rounded-md text-sm font-medium transition-colors text-gray-700 hover:bg-gray-100" data-filter="fish">
                    <span>Fish</span>
                </button>
                <button onclick="filterItems('plant')" class="filter-btn px-6 py-2 rounded-md text-sm font-medium transition-colors text-gray-700 hover:bg-gray-100" data-filter="plant">
                    <span>Plants</span>
                </button>
                <button onclick="filterItems('equipment')" class="filter-btn px-6 py-2 rounded-md text-sm font-medium transition-colors text-gray-700 hover:bg-gray-100" data-filter="equipment">
                    <span>Equipment</span>
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
            <div class="empty-state">
                <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                </svg>
                <p class="text-gray-500 text-lg font-medium">No items available at the moment.</p>
                <p class="text-gray-400 mt-2">Check back soon for new arrivals!</p>
            </div>
        @endif
    </div>
</section>

@push('styles')
<style>
    /* Page Layout Fixes */
    html, body {
        height: 100%;
        margin: 0;
        padding: 0;
    }
    
    body {
        overflow-x: hidden;
    }
    
    /* Enhanced Hero Section Styles */
    .hero-overlay {
        background: linear-gradient(135deg, 
            rgba(6, 78, 156, 0.85) 0%, 
            rgba(8, 145, 178, 0.75) 50%, 
            rgba(6, 95, 70, 0.85) 100%);
        backdrop-filter: blur(2px);
    }
    
    .hero-title {
        background: linear-gradient(135deg, #ffffff 0%, #e0f2fe 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        text-shadow: 0 0 30px rgba(255, 255, 255, 0.3);
        animation: titleGlow 3s ease-in-out infinite alternate;
    }
    
    @keyframes titleGlow {
        from { filter: brightness(1); }
        to { filter: brightness(1.2); }
    }
    
    .hero-description {
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
        animation: fadeInUp 1s ease-out 0.5s both;
    }
    
    .hero-button {
        background: linear-gradient(135deg, #ffffff 0%, #f8fafc 100%);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2), 0 0 0 1px rgba(255, 255, 255, 0.1);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        animation: fadeInUp 1s ease-out 0.8s both;
    }
    
    .hero-button:hover {
        transform: translateY(-2px) scale(1.05);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3), 0 0 0 1px rgba(255, 255, 255, 0.2);
    }
    
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    /* Enhanced Items Section */
    .items-section {
        background: linear-gradient(180deg, #f9fafb 0%, #ffffff 100%);
        position: relative;
        min-height: 100vh;
        padding-bottom: 80px;
        margin-top: 0;
    }
    
    .items-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 1px;
        background: linear-gradient(90deg, 
            transparent 0%, 
            rgba(59, 130, 246, 0.3) 50%, 
            transparent 100%);
    }
    
    .section-title {
        background: linear-gradient(135deg, #1f2937 0%, #3b82f6 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        position: relative;
    }
    
    .section-title::after {
        content: '';
        position: absolute;
        bottom: -10px;
        left: 50%;
        transform: translateX(-50%);
        width: 60px;
        height: 3px;
        background: linear-gradient(90deg, #3b82f6, #10b981);
        border-radius: 2px;
    }
    
    /* Enhanced Filter Tabs */
    .filter-container {
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
    }
    
    .filter-btn {
        position: relative;
        overflow: hidden;
        transition: all 0.3s ease;
    }
    
    .filter-btn::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 0;
        height: 0;
        background: linear-gradient(135deg, #3b82f6, #1d4ed8);
        border-radius: 50%;
        transform: translate(-50%, -50%);
        transition: all 0.5s ease;
        z-index: 0;
    }
    
    .filter-btn.bg-blue-600::before {
        width: 100%;
        height: 100%;
        border-radius: 6px;
    }
    
    .filter-btn span {
        position: relative;
        z-index: 1;
    }
    
    /* Enhanced Item Cards */
    .item-card {
        background: linear-gradient(145deg, #ffffff 0%, #f8fafc 100%);
        border: 1px solid rgba(226, 232, 240, 0.8);
        box-shadow: 
            0 4px 6px -1px rgba(0, 0, 0, 0.1),
            0 2px 4px -1px rgba(0, 0, 0, 0.06),
            0 0 0 0px rgba(59, 130, 246, 0);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
        margin-bottom: 20px;
        width: 100%;
        max-width: 320px;
        min-height: 420px;
        max-height: 520px;
        border-radius: 12px;
        display: flex;
        flex-direction: column;
    }
    
    .item-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, 
            transparent 0%, 
            rgba(59, 130, 246, 0.1) 50%, 
            transparent 100%);
        transition: left 0.6s ease;
    }
    
    .item-card:hover::before {
        left: 100%;
    }
    
    .item-card:hover {
        transform: translateY(-12px) scale(1.02);
        box-shadow: 
            0 20px 25px -5px rgba(0, 0, 0, 0.15),
            0 10px 10px -5px rgba(0, 0, 0, 0.04),
            0 0 0 2px rgba(59, 130, 246, 0.2);
        border-color: rgba(59, 130, 246, 0.3);
    }
    
    .item-card img {
        transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1);
        width: 100%;
        height: 200px;
        object-fit: cover;
        border-radius: 12px 12px 0 0;
    }
    
    .item-card:hover img {
        transform: scale(1.08) rotate(1deg);
    }
    
    /* Card content styling */
    .item-card .card-content {
        padding: 16px;
        flex: 1;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }
    
    .item-card .card-title {
        font-size: 1.1rem;
        font-weight: 600;
        color: #1f2937;
        margin-bottom: 8px;
        line-height: 1.3;
        height: 2.6em;
        overflow: hidden;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
    }
    
    .item-card .card-description {
        font-size: 0.9rem;
        color: #6b7280;
        margin-bottom: 12px;
        line-height: 1.4;
        height: 2.8em;
        overflow: hidden;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
    }
    
    .item-card .card-price {
        font-size: 1.2rem;
        font-weight: 700;
        color: #059669;
        margin-bottom: 12px;
    }
    
    .item-card .card-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: auto;
    }
    
    /* Enhanced Status Badges */
    .status-badge {
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        animation: badgePulse 2s ease-in-out infinite;
    }
    
    @keyframes badgePulse {
        0%, 100% { 
            transform: scale(1);
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }
        50% { 
            transform: scale(1.05);
            box-shadow: 0 6px 20px rgba(0,0,0,0.15);
        }
    }
    
    /* Enhanced Add to Cart Button */
    .item-card button {
        background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%);
        border: 1px solid rgba(251, 191, 36, 0.3);
        box-shadow: 0 4px 15px rgba(251, 191, 36, 0.2);
        position: relative;
        overflow: hidden;
    }
    
    .item-card button::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 0;
        height: 0;
        background: linear-gradient(135deg, #fcd34d, #fbbf24);
        border-radius: 50%;
        transform: translate(-50%, -50%);
        transition: all 0.4s ease;
    }
    
    .item-card button:hover::before {
        width: 300%;
        height: 300%;
    }
    
    .item-card button:hover {
        transform: scale(1.05);
        box-shadow: 0 8px 25px rgba(251, 191, 36, 0.3);
    }
    
    .item-card button:active {
        transform: scale(0.95);
    }
    
    /* Loading State Enhancement */
    .cart-loading {
        position: relative;
        pointer-events: none;
        opacity: 0.8;
    }
    
    .cart-loading::after {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 20px;
        height: 20px;
        margin: -10px 0 0 -10px;
        border: 3px solid rgba(0, 0, 0, 0.1);
        border-top: 3px solid #fbbf24;
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }
    
    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
    
    /* Enhanced Notifications */
    .cart-notification {
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
        animation: slideInBounce 0.5s cubic-bezier(0.68, -0.55, 0.265, 1.55);
    }
    
    @keyframes slideInBounce {
        0% {
            transform: translateX(100%) scale(0.8);
            opacity: 0;
        }
        50% {
            transform: translateX(-10px) scale(1.05);
        }
        100% {
            transform: translateX(0) scale(1);
            opacity: 1;
        }
    }
    
    /* Empty State Enhancement */
    .empty-state {
        background: linear-gradient(145deg, #f8fafc 0%, #f1f5f9 100%);
        border: 2px dashed #cbd5e1;
        border-radius: 16px;
        padding: 60px 40px;
        text-align: center;
    }
    
    .empty-state svg {
        filter: drop-shadow(0 4px 6px rgba(0, 0, 0, 0.1));
        animation: float 3s ease-in-out infinite;
    }
    
    @keyframes float {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-10px); }
    }
    
    /* Responsive Enhancements */
    @media (max-width: 768px) {
        .hero-title {
            font-size: 2.5rem;
            line-height: 1.2;
        }
        
        .hero-description {
            font-size: 1.1rem;
        }
        
        .item-card:hover {
            transform: translateY(-8px) scale(1.01);
        }
        
        .item-card {
            max-width: 100%;
            min-height: 380px;
            max-height: 480px;
        }
        
        .items-section {
            padding-bottom: 60px;
        }
    }
    
    @media (max-width: 640px) {
        .item-card {
            min-height: 360px;
            max-height: 460px;
        }
        
        .item-card img {
            height: 180px;
        }
        
        .item-card .card-content {
            padding: 12px;
        }
        
        .item-card .card-title {
            font-size: 1rem;
        }
        
        .item-card .card-description {
            font-size: 0.85rem;
        }
    }
    
    /* Ensure items grid has proper spacing */
    #items-grid {
        margin-bottom: 40px;
    }
    
    /* Footer spacing */
    .items-section:after {
        content: '';
        display: block;
        height: 40px;
    }
</style>
@endpush
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
    notification.className = 'fixed bottom-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg z-50 flex items-center cart-notification';
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
