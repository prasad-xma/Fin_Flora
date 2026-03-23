@props(['item'])

<a href="{{ route('customer.item.show', $item->id) }}" class="item-card-link">
    <!-- Image Section -->
    <div class="item-card-image-container">
        @if($item->image_url)
            <img src="{{ $item->image_url }}" 
                 alt="{{ $item->name }}" 
                 class="item-card-image"
                 onerror="this.src='/images/placeholder.jpg'">
        @else
            <div class="item-card-no-image">
                <div class="item-card-no-image-content">
                    @if($item->category === 'fish')
                        <svg class="item-card-no-image-icon" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 20l-3-3h2V9h2v8h2l-3 3zm0-18C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z"/>
                        </svg>
                    @elseif($item->category === 'plant')
                        <svg class="item-card-no-image-icon" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8zm-1-13h2v6h-2zm0 8h2v2h-2z"/>
                        </svg>
                    @else
                        <svg class="item-card-no-image-icon" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/>
                        </svg>
                    @endif
                    <p class="item-card-no-image-text">No Image</p>
                </div>
            </div>
        @endif
        
        <!-- Status Badge -->
        <div class="item-card-status-badge">
            @if($item->status === 'available')
                <span class="status-badge-available">Available</span>
            @elseif($item->status === 'unavailable')
                <span class="status-badge-unavailable">Unavailable</span>
            @else
                <span class="status-badge-out-of-stock">Out of Stock</span>
            @endif
        </div>

        <!-- Quick Actions Overlay -->
        <div class="item-card-overlay">
            <div class="item-card-overlay-content">
                <!-- <p class="text-white text-sm font-medium">Click to view details</p> -->
            </div>
        </div>
    </div>

    <!-- Content Section -->
    <div class="item-card-content">
        <!-- Title and Price -->
        <div class="item-card-title-price">
            <h3 class="item-card-title">
                {{ $item->name }}
            </h3>
            <div class="item-card-price-container">
                <div class="item-card-price">
                    ${{ number_format($item->price, 2) }}
                </div>
                @if($item->discount_price)
                    <div class="item-card-discount-price">
                        ${{ number_format($item->discount_price, 2) }}
                    </div>
                @endif
            </div>
        </div>

        <!-- Description Preview -->
        <p class="item-card-description">
            {{ Str::limit($item->description, 60) }}
        </p>

        <!-- Stock Info -->
        <div class="item-card-stock-info">
            <div class="item-card-stock-quantity">
                <svg class="item-card-stock-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <!-- <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8-4M2 7l8 4 8 4m0 8l-8-4-8-4m0 8l8 4 8 4m-8-4v8m0 4.354a6 6 0 011.707 1.293l5.414 5.414a1 1 0 01.707.293H11.586a1 1 0 01-.707-.293l-5.414-5.414A1 1 0 016.586 13H4"/> -->
                </svg>
                {{ $item->total_quantity }} in stock
            </div>
            <div class="item-card-type">
                @if($item->type === 'fish')
                    <svg class="item-card-type-icon" fill="currentColor" viewBox="0 0 24 24">
                        <!-- <path d="M12 20l-3-3h2V9h2v8h2l-3 3zm0-18C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2z"/> -->
                    </svg>
                    Fish
                @elseif($item->type === 'plant')
                    <svg class="item-card-type-icon" fill="currentColor" viewBox="0 0 24 24">
                        <!-- <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2z"/> -->
                    </svg>
                    Plant
                @else
                    <svg class="item-card-type-icon" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/>
                    </svg>
                    Equipment
                @endif
            </div>
        </div>

        <!-- Add to Cart Button -->
        <button class="item-card-add-to-cart-btn"
                onclick="event.stopPropagation(); addToCart({{ $item->id }})">
            <svg class="item-card-btn-icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
            </svg>
            Add to Cart
        </button>
    </div>
</a>

<style>
/* Item Card Component Styles */
.item-card-link {
    display: block;
    background: white;
    border-radius: 12px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
    overflow: hidden;
    cursor: pointer;
    text-decoration: none;
}

.item-card-link:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
}

/* Image Container */
.item-card-image-container {
    position: relative;
    height: 160px;
    overflow: hidden;
    background: linear-gradient(135deg, #e3f2fd 0%, #e8f5e8 100%);
}

.item-card-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
}

.item-card-link:hover .item-card-image {
    transform: scale(1.05);
}

/* No Image State */
.item-card-no-image {
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, #bbdefb 0%, #c8e6c9 100%);
}

.item-card-no-image-content {
    text-align: center;
}

.item-card-no-image-icon {
    width: 64px;
    height: 64px;
    margin: 0 auto 8px;
    color: #90caf9;
}

.item-card-no-image-text {
    color: #757575;
    font-size: 12px;
    margin: 0;
}

/* Status Badge */
.item-card-status-badge {
    position: absolute;
    top: 12px;
    right: 12px;
}

.status-badge-available,
.status-badge-unavailable,
.status-badge-out-of-stock {
    font-size: 12px;
    padding: 4px 8px;
    border-radius: 20px;
    font-weight: 600;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
}

.status-badge-available {
    background: #4caf50;
    color: white;
}

.status-badge-unavailable {
    background: #ff9800;
    color: white;
}

.status-badge-out-of-stock {
    background: #f44336;
    color: white;
}

/* Overlay */
.item-card-overlay {
    position: absolute;
    inset: 0;
    background: rgba(0, 0, 0, 0);
    transition: background 0.3s ease;
    display: flex;
    align-items: flex-end;
}

.item-card-link:hover .item-card-overlay {
    background: rgba(0, 0, 0, 0.1);
}

.item-card-overlay-content {
    width: 100%;
    padding: 16px;
    background: linear-gradient(to top, rgba(0, 0, 0, 0.6), transparent);
    opacity: 0;
    transition: opacity 0.3s ease;
}

.item-card-link:hover .item-card-overlay-content {
    opacity: 1;
}

/* Content Section */
.item-card-content {
    padding: 16px;
}

.item-card-title-price {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    margin-bottom: 8px;
}

.item-card-title {
    font-size: 16px;
    font-weight: 700;
    color: #1f2937;
    line-height: 1.2;
    overflow: hidden;
    display: -webkit-box;
    -webkit-line-clamp: 1;
    -webkit-box-orient: vertical;
    margin: 0;
}

.item-card-link:hover .item-card-title {
    color: #2563eb;
}

.item-card-price-container {
    text-align: right;
    margin-left: 8px;
    flex-shrink: 0;
}

.item-card-price {
    font-size: 18px;
    font-weight: 700;
    color: #16a34a;
    margin-bottom: 2px;
}

.item-card-discount-price {
    font-size: 12px;
    color: #ef4444;
    text-decoration: line-through;
}

.item-card-description {
    color: #6b7280;
    font-size: 12px;
    margin: 0 0 12px 0;
    line-height: 1.4;
    overflow: hidden;
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
}

/* Stock Info */
.item-card-stock-info {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 12px;
}

.item-card-stock-quantity,
.item-card-type {
    display: flex;
    align-items: center;
    color: #6b7280;
    font-size: 12px;
}

.item-card-stock-icon,
.item-card-type-icon {
    width: 12px;
    height: 12px;
    margin-right: 4px;
}

.item-card-type-icon.fish {
    color: #3b82f6;
}

.item-card-type-icon.plant {
    color: #10b981;
}

.item-card-type-icon.equipment {
    color: #6b7280;
}

/* Add to Cart Button */
.item-card-add-to-cart-btn {
    width: 100%;
    background: #2563eb;
    color: white;
    padding: 8px 12px;
    border-radius: 8px;
    font-size: 12px;
    font-weight: 500;
    border: none;
    cursor: pointer;
    transition: background 0.2s ease;
    display: flex;
    align-items: center;
    justify-content: center;
}

.item-card-add-to-cart-btn:hover {
    background: #1d4ed8;
}

.item-card-btn-icon {
    width: 12px;
    height: 12px;
    margin-right: 8px;
}
</style>
