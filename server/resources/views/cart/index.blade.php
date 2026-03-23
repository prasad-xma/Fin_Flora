@extends('layouts.app')

@section('title', 'Shopping Cart')

@section('content')
<style>
    .cart-wrapper {
        max-width: 1000px;
        margin: 40px auto;
        padding: 0 20px;
        font-family: 'Inter', sans-serif;
        color: #1a1a1a;
    }

    .cart-header {
        display: flex;
        justify-content: space-between;
        align-items: baseline;
        margin-bottom: 30px;
        border-bottom: 2px solid #f0f0f0;
        padding-bottom: 10px;
    }

    .cart-container {
        display: grid;
        grid-template-columns: 1fr 350px;
        gap: 40px;
    }

    /* Cart Items */
    .cart-items-list {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .cart-item {
        display: flex;
        align-items: center;
        gap: 20px;
        background: #fff;
        padding: 20px;
        border-radius: 16px;
        border: 1px solid #eee;
        transition: transform 0.2s;
    }

    .item-img-container {
        width: 100px; /* Fixed small size */
        height: 100px;
        flex-shrink: 0;
        border-radius: 12px;
        overflow: hidden;
        background: #f9f9f9;
    }

    .item-img-container img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .item-details {
        flex-grow: 1;
    }

    .item-name {
        font-size: 1.1rem;
        font-weight: 700;
        margin: 0;
    }

    .item-meta {
        font-size: 0.85rem;
        color: #777;
        text-transform: uppercase;
        margin: 4px 0;
    }

    .quantity-controls {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-top: 10px;
    }

    .qty-btn {
        width: 32px;
        height: 32px;
        border-radius: 8px;
        border: 1px solid #ddd;
        background: white;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .qty-btn:hover:not(:disabled) {
        background: #f0f0f0;
    }

    .remove-btn {
        background: none;
        border: none;
        color: #ff4d4d;
        font-size: 0.8rem;
        cursor: pointer;
        margin-left: 15px;
        text-decoration: underline;
    }

    /* Summary Section */
    .summary-card {
        background: #fff;
        padding: 30px;
        border-radius: 24px;
        border: 1px solid #eee;
        box-shadow: 0 10px 25px rgba(0,0,0,0.03);
        height: fit-content;
        position: sticky;
        top: 20px;
    }

    .summary-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 12px;
        font-size: 0.95rem;
    }

    .total-row {
        margin-top: 20px;
        padding-top: 20px;
        border-top: 1px solid #eee;
        font-weight: 800;
        font-size: 1.2rem;
    }

    .checkout-btn {
        width: 100%;
        padding: 16px;
        background: #000;
        color: #fff;
        border: none;
        border-radius: 14px;
        font-weight: 700;
        font-size: 1rem;
        margin-top: 20px;
        cursor: pointer;
    }

    @media (max-width: 768px) {
        .cart-container { grid-template-columns: 1fr; }
    }
</style>

<div class="cart-wrapper">
    <div class="cart-header">
        <h1 class="item-name" style="font-size: 2rem;">Shopping Bag</h1>
        <span style="color: #888;">{{ $cartItems->count() }} Items</span>
    </div>

    @if($cartItems->isEmpty())
        <div style="text-align: center; padding: 60px;">
            <h3>Your cart is empty</h3>
            <a href="{{ route('welcome') }}">Go back to store</a>
        </div>
    @else
        <div class="cart-container">
            <div class="cart-items-list">
                @foreach($cartItems as $cartItem)
                <div class="cart-item">
                    <div class="item-img-container">
                        @if($cartItem->aquariumItem->image_url)
                            <img src="{{ $cartItem->aquariumItem->image_url }}" alt="Item">
                        @endif
                    </div>
                    
                    <div class="item-details">
                        <p class="item-meta">{{ $cartItem->aquariumItem->category }}</p>
                        <h3 class="item-name">{{ $cartItem->aquariumItem->name }}</h3>
                        
                        <div class="quantity-controls">
                            <button class="qty-btn" onclick="updateQuantity(event, {{ $cartItem->id }}, {{ $cartItem->quantity - 1 }})" @if($cartItem->quantity <= 1) disabled @endif>−</button>
                            <span style="font-weight: 600;">{{ $cartItem->quantity }}</span>
                            <button class="qty-btn" onclick="updateQuantity(event, {{ $cartItem->id }}, {{ $cartItem->quantity + 1 }})" @if($cartItem->quantity >= $cartItem->aquariumItem->total_quantity) disabled @endif>+</button>
                            
                            <button class="remove-btn" onclick="removeFromCart({{ $cartItem->id }})">Remove</button>
                        </div>
                    </div>

                    <div style="text-align: right;">
                        <div style="font-weight: 800;">${{ number_format($cartItem->price * $cartItem->quantity, 2) }}</div>
                        <div style="font-size: 0.75rem; color: #aaa;">${{ number_format($cartItem->price, 2) }} ea</div>
                    </div>
                </div>
                @endforeach
            </div>

            <div class="summary-card">
                <h2 style="margin-top: 0; margin-bottom: 25px;">Order Summary</h2>
                
                <div class="summary-row">
                    <span>Subtotal</span>
                    <span>${{ number_format($total, 2) }}</span>
                </div>
                <div class="summary-row">
                    <span>Tax (8%)</span>
                    <span>${{ number_format($total * 0.08, 2) }}</span>
                </div>
                <div class="summary-row" style="color: #27ae60; font-weight: 600;">
                    <span>Shipping</span>
                    <span>FREE</span>
                </div>

                <div class="summary-row total-row">
                    <span>Total</span>
                    <span>${{ number_format($total * 1.08, 2) }}</span>
                </div>

                <button class="checkout-btn">Proceed to Checkout</button>
                <a href="{{ route('welcome') }}" style="display: block; text-align: center; margin-top: 15px; font-size: 0.85rem; color: #888;">Continue Shopping</a>
            </div>
        </div>
    @endif
</div>
@endsection