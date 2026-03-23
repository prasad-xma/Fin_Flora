@extends('layouts.app')

@section('title', 'Item Details')

@section('content')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class="item-show-container">
    <div class="item-show-wrapper">
        <!-- Breadcrumb -->
        <nav class="breadcrumb-nav">
            <ol class="breadcrumb-list">
                <li class="breadcrumb-item">
                    <a href="{{ route('welcome') }}" class="breadcrumb-link">
                        <svg class="breadcrumb-icon" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path>
                        </svg>
                        Home
                    </a>
                </li>
                <li class="breadcrumb-separator">
                    <svg class="separator-icon" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="breadcrumb-current">{{ $item->name }}</span>
                </li>
            </ol>
        </nav>

        <div class="item-show-grid">
            <!-- Product Images -->
            <div class="product-images">
                <!-- Main Image -->
                <div class="main-image-container">
                    @if($item->image_url)
                        <img src="{{ $item->image_url }}" 
                             alt="{{ $item->name }}" 
                             class="main-image"
                             onerror="this.src='/images/placeholder.jpg'">
                    @else
                        <div class="no-image-container">
                            <div class="no-image-content">
                                @if($item->category === 'fish')
                                    <svg class="no-image-icon" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 20l-3-3h2V9h2v8h2l-3 3zm0-18C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z"/>
                                    </svg>
                                @elseif($item->category === 'plant')
                                    <svg class="no-image-icon" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm-1-13h2v6h-2zm0 8h2v2h-2z"/>
                                    </svg>
                                @else
                                    <svg class="no-image-icon" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/>
                                    </svg>
                                @endif
                                <p class="no-image-text">No Image Available</p>
                            </div>
                        </div>
                    @endif
                    
                    <!-- Status Badge -->
                    <div class="status-badge">
                        @if($item->status === 'available')
                            <span class="status-available">
                                <svg class="status-icon" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                                Available
                            </span>
                        @elseif($item->status === 'unavailable')
                            <span class="status-unavailable">
                                <svg class="status-icon" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                </svg>
                                Unavailable
                            </span>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Product Details -->
            <div class="product-details">
                <!-- Title and Price -->
                <div class="product-header">
                    <div class="product-info">
                        <h1 class="product-title">{{ $item->name }}</h1>
                        <div class="product-meta">
                            <span class="meta-item">
                                @if($item->category === 'fish')
                                    <svg class="meta-icon" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 20l-3-3h2V9h2v8h2l-3 3zm0-18C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2z"/>
                                    </svg>
                                @elseif($item->category === 'plant')
                                    <svg class="meta-icon" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2z"/>
                                    </svg>
                                @else
                                    <svg class="meta-icon" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2z"/>
                                    </svg>
                                @endif
                                {{ $item->category }}
                            </span>
                            <span class="meta-item">
                                <svg class="meta-icon" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M3 1a1 1 0 000 2h1.22l.305 1.222a.997.997 0 00.01.042l1.358 5.43-.893.892C3.74 11.846 4.632 14 6.414 14H15a1 1 0 000-2H6.414l1-1H14a1 1 0 00.894-.553l3-6A1 1 0 0017 3H6.28l-.31-1.243A1 1 0 005 1H3z"/>
                                </svg>
                                {{ $item->total_quantity }} in stock
                            </span>
                        </div>
                    </div>
                    <div class="price-section">
                        <div class="current-price">
                            ${{ number_format($item->price, 2) }}
                        </div>
                        @if($item->discount_price)
                            <div class="original-price">
                                ${{ number_format($item->discount_price, 2) }}
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Description -->
                <div class="description-card">
                    <h3 class="section-title">Description</h3>
                    <p class="description-text">{{ $item->description }}</p>
                </div>

                <!-- Type-specific Details -->
                @if($item->type === 'fish' && $item->fish->isNotEmpty())
                    <div class="details-card">
                        <h3 class="section-title">Fish Details</h3>
                        <div class="details-grid">
                            <div class="detail-item">
                                <span class="detail-label">Scientific Name</span>
                                <span class="detail-value">{{ $item->fish->first()->scientific_name ?? 'N/A' }}</span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">Size</span>
                                <span class="detail-value">{{ $item->fish->first()->size ?? 'N/A' }}</span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">Water Type</span>
                                <span class="detail-value">{{ $item->fish->first()->water_type ?? 'N/A' }}</span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">Temperament</span>
                                <span class="detail-value">{{ $item->fish->first()->temperament ?? 'N/A' }}</span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">Diet</span>
                                <span class="detail-value">{{ $item->fish->first()->diet ?? 'N/A' }}</span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">Min Tank Size</span>
                                <span class="detail-value">{{ $item->fish->first()->min_tank_size ? $item->fish->first()->min_tank_size . ' gallons' : 'N/A' }}</span>
                            </div>
                        </div>
                    </div>
                @elseif($item->type === 'plant' && $item->plants->isNotEmpty())
                    <div class="details-card">
                        <h3 class="section-title">Plant Details</h3>
                        <div class="details-grid">
                            <div class="detail-item">
                                <span class="detail-label">Scientific Name</span>
                                <span class="detail-value">{{ $item->plants->first()->scientific_name ?? 'N/A' }}</span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">Size</span>
                                <span class="detail-value">{{ $item->plants->first()->size ?? 'N/A' }}</span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">Light Requirements</span>
                                <span class="detail-value">{{ $item->plants->first()->light_requirements ?? 'N/A' }}</span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">CO2 Requirement</span>
                                <span class="detail-value">{{ $item->plants->first()->co2_requirement ?? 'N/A' }}</span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">Difficulty Level</span>
                                <span class="detail-value">{{ $item->plants->first()->difficulty_level ?? 'N/A' }}</span>
                            </div>
                            <div class="detail-item">
                                <span class="detail-label">Growth Rate</span>
                                <span class="detail-value">{{ $item->plants->first()->growth_rate ?? 'N/A' }}</span>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Care Instructions -->
                @if($item->care_instructions)
                    <div class="care-card">
                        <h3 class="section-title">
                            <svg class="section-icon" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                            </svg>
                            Care Instructions
                        </h3>
                        <p class="care-text">{{ $item->care_instructions }}</p>
                    </div>
                @endif

                <!-- Add to Cart Section -->
                <div class="purchase-card">
                    <div class="quantity-section">
                        <label class="quantity-label">Quantity:</label>
                        <div class="quantity-controls">
                            <button class="quantity-btn" onclick="decrementQuantity()">
                                <svg class="btn-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"></path>
                                </svg>
                            </button>
                            <input type="number" id="quantity" value="1" min="1" max="{{ $item->total_quantity }}" class="quantity-input">
                            <button class="quantity-btn" onclick="incrementQuantity()">
                                <svg class="btn-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                </svg>
                            </button>
                        </div>
                        <span class="stock-info">{{ $item->total_quantity }} available</span>
                    </div>

                    <button class="add-to-cart-btn" onclick="addToCart({{ $item->id }}, this)">
                        <svg class="cart-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                        Add to Cart
                    </button>

                    <div class="trust-badges">
                        <span class="trust-badge">
                            <svg class="trust-icon" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            In Stock
                        </span>
                        <span class="trust-badge">
                            <svg class="trust-icon" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z"></path>
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" clip-rule="evenodd"></path>
                            </svg>
                            Secure Payment
                        </span>
                        <span class="trust-badge">
                            <svg class="trust-icon" fill="currentColor" viewBox="0 0 20 20">
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
        <svg class="cart-icon animate-spin" fill="none" viewBox="0 0 24 24" stroke="currentColor">
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
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: data.message,
                timer: 2000,
                showConfirmButton: false
            });
            updateCartCounter(data.cart_count);
        } else {
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: data.message,
                confirmButtonText: 'OK'
            });
        }
    })
    .catch(error => {
        console.error('Error:', error);
        Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: 'An error occurred. Please try again.',
            confirmButtonText: 'OK'
        });
    })
    .finally(() => {
        // Restore button
        button.disabled = false;
        button.innerHTML = `
            <svg class="cart-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
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
</script>

<style>
/* Item Show Page - Modern Clean Design */
.item-show-container {
    min-height: 100vh;
    background: linear-gradient(135deg, #f8fafc 0%, #e0f2fe 50%, #dcfce7 100%);
    padding: 2rem 1rem;
}

.item-show-wrapper {
    max-width: 1200px;
    margin: 0 auto;
}

/* Breadcrumb */
.breadcrumb-nav {
    margin-bottom: 2rem;
}

.breadcrumb-list {
    display: flex;
    align-items: center;
    list-style: none;
    padding: 0;
    margin: 0;
}

.breadcrumb-item {
    display: flex;
    align-items: center;
}

.breadcrumb-link {
    display: flex;
    align-items: center;
    color: #64748b;
    text-decoration: none;
    font-size: 0.9rem;
    font-weight: 500;
    transition: color 0.2s ease;
}

.breadcrumb-link:hover {
    color: #3b82f6;
}

.breadcrumb-icon {
    width: 16px;
    height: 16px;
    margin-right: 8px;
}

.breadcrumb-separator {
    display: flex;
    align-items: center;
    margin-left: 8px;
}

.separator-icon {
    width: 16px;
    height: 16px;
    color: #cbd5e1;
    margin-right: 8px;
}

.breadcrumb-current {
    color: #1e293b;
    font-size: 0.9rem;
    font-weight: 500;
}

/* Main Grid Layout */
.item-show-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 3rem;
    align-items: start;
}

/* Product Images Section */
.product-images {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.main-image-container {
    position: relative;
    background: white;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
}

.main-image {
    width: 100%;
    height: 400px;
    object-fit: cover;
    display: block;
}

.no-image-container {
    width: 100%;
    height: 400px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, #e0f2fe 0%, #dcfce7 100%);
}

.no-image-content {
    text-align: center;
}

.no-image-icon {
    width: 80px;
    height: 80px;
    margin: 0 auto 1rem;
    color: #60a5fa;
}

.no-image-text {
    color: #64748b;
    font-size: 1rem;
    margin: 0;
}

/* Status Badge */
.status-badge {
    position: absolute;
    top: 1rem;
    right: 1rem;
}

.status-available,
.status-unavailable {
    display: flex;
    align-items: center;
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 600;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.status-available {
    background: #10b981;
    color: white;
}

.status-unavailable {
    background: #f59e0b;
    color: white;
}

.status-icon {
    width: 16px;
    height: 16px;
    margin-right: 6px;
}

/* Thumbnail Gallery */
.thumbnail-gallery {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 0.5rem;
}

.thumbnail {
    background: white;
    border-radius: 8px;
    padding: 0.5rem;
    border: 2px solid transparent;
    cursor: pointer;
    transition: all 0.2s ease;
}

.thumbnail:hover {
    border-color: #3b82f6;
}

.thumbnail.active {
    border-color: #3b82f6;
}

.thumbnail-placeholder {
    aspect-ratio: 1;
    background: #f1f5f9;
    border-radius: 4px;
}

/* Product Details Section */
.product-details {
    display: flex;
    flex-direction: column;
    gap: 1.5rem;
}

/* Product Header */
.product-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    gap: 2rem;
}

.product-title {
    font-size: 2rem;
    font-weight: 700;
    color: #1e293b;
    margin: 0 0 0.5rem 0;
    line-height: 1.2;
}

.product-meta {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.meta-item {
    display: flex;
    align-items: center;
    color: #64748b;
    font-size: 0.9rem;
}

.meta-icon {
    width: 16px;
    height: 16px;
    margin-right: 8px;
}

.price-section {
    text-align: right;
}

.current-price {
    font-size: 2rem;
    font-weight: 700;
    color: #10b981;
    margin-bottom: 0.5rem;
}

.original-price {
    font-size: 1.2rem;
    color: #ef4444;
    text-decoration: line-through;
}

/* Cards */
.description-card,
.details-card,
.care-card,
.purchase-card {
    background: white;
    border-radius: 16px;
    padding: 1.5rem;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
    border: 1px solid #f1f5f9;
}

.section-title {
    font-size: 1.1rem;
    font-weight: 600;
    color: #1e293b;
    margin: 0 0 1rem 0;
    display: flex;
    align-items: center;
}

.section-icon {
    width: 20px;
    height: 20px;
    margin-right: 8px;
    color: #3b82f6;
}

.description-text,
.care-text {
    color: #475569;
    line-height: 1.6;
    margin: 0;
}

/* Details Grid */
.details-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 1rem;
}

.detail-item {
    display: flex;
    flex-direction: column;
}

.detail-label {
    font-size: 0.8rem;
    color: #64748b;
    margin-bottom: 0.25rem;
}

.detail-value {
    font-weight: 500;
    color: #1e293b;
}

/* Care Card */
.care-card {
    background: linear-gradient(135deg, #dbeafe 0%, #dcfce7 100%);
    border-color: #3b82f6;
}

.care-card .section-title {
    color: #1e40af;
}

.care-text {
    color: #1e40af;
}

/* Purchase Section */
.quantity-section {
    display: flex;
    align-items: center;
    gap: 1rem;
    margin-bottom: 1.5rem;
}

.quantity-label {
    font-size: 0.9rem;
    font-weight: 500;
    color: #374151;
    min-width: 80px;
}

.quantity-controls {
    display: flex;
    align-items: center;
    border: 1px solid #d1d5db;
    border-radius: 8px;
    overflow: hidden;
}

.quantity-btn {
    background: white;
    border: none;
    padding: 0.5rem;
    cursor: pointer;
    transition: background 0.2s ease;
}

.quantity-btn:hover {
    background: #f3f4f6;
}

.btn-icon {
    width: 16px;
    height: 16px;
    color: #6b7280;
}

.quantity-input {
    width: 60px;
    text-align: center;
    border: none;
    padding: 0.5rem;
    font-size: 1rem;
    background: white;
}

.stock-info {
    font-size: 0.8rem;
    color: #6b7280;
}

/* Add to Cart Button */
.add-to-cart-btn {
    width: 100%;
    background: linear-gradient(135deg, #3b82f6 0%, #06b6d4 100%);
    color: white;
    border: none;
    padding: 1rem 2rem;
    border-radius: 12px;
    font-size: 1.1rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
}

.add-to-cart-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 8px 25px rgba(59, 130, 246, 0.4);
}

.cart-icon {
    width: 24px;
    height: 24px;
    margin-right: 12px;
}

/* Trust Badges */
.trust-badges {
    display: flex;
    justify-content: center;
    gap: 2rem;
    margin-top: 1.5rem;
}

.trust-badge {
    display: flex;
    align-items: center;
    color: #6b7280;
    font-size: 0.8rem;
}

.trust-icon {
    width: 16px;
    height: 16px;
    margin-right: 6px;
}

/* Responsive Design */
@media (max-width: 1024px) {
    .item-show-grid {
        grid-template-columns: 1fr;
        gap: 2rem;
    }
    
    .main-image {
        height: 350px;
    }
    
    .no-image-container {
        height: 350px;
    }
}

@media (max-width: 768px) {
    .item-show-container {
        padding: 1rem 0.5rem;
    }
    
    .product-header {
        flex-direction: column;
        gap: 1rem;
    }
    
    .product-title {
        font-size: 1.5rem;
    }
    
    .current-price {
        font-size: 1.5rem;
    }
    
    .details-grid {
        grid-template-columns: 1fr;
    }
    
    .quantity-section {
        flex-direction: column;
        align-items: stretch;
        gap: 0.5rem;
    }
    
    .trust-badges {
        flex-direction: column;
        gap: 1rem;
        align-items: center;
    }
    
    .main-image {
        height: 300px;
    }
    
    .no-image-container {
        height: 300px;
    }
    
    .no-image-icon {
        width: 60px;
        height: 60px;
    }
}

/* Animations */
@keyframes spin {
    from {
        transform: rotate(0deg);
    }
    to {
        transform: rotate(360deg);
    }
}

.animate-spin {
    animation: spin 1s linear infinite;
}
</style>
@endsection
