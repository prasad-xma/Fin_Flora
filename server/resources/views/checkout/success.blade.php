@extends('layouts.app')

@section('title', 'Payment Successful')

@section('content')
<style>
    .success-wrapper {
        max-width: 600px;
        margin: 60px auto;
        padding: 0 20px;
        text-align: center;
        font-family: 'Inter', sans-serif;
    }

    .success-icon {
        width: 80px;
        height: 80px;
        background: #27ae60;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 30px;
        font-size: 40px;
        color: white;
    }

    .success-title {
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 15px;
        color: #1a1a1a;
    }

    .success-message {
        font-size: 1.1rem;
        color: #666;
        margin-bottom: 40px;
        line-height: 1.6;
    }

    .action-buttons {
        display: flex;
        gap: 20px;
        justify-content: center;
        flex-wrap: wrap;
    }

    .btn {
        padding: 15px 30px;
        border-radius: 10px;
        text-decoration: none;
        font-weight: 600;
        font-size: 1rem;
        transition: all 0.2s;
        border: none;
        cursor: pointer;
    }

    .btn-primary {
        background: #000;
        color: white;
    }

    .btn-primary:hover {
        background: #333;
    }

    .btn-secondary {
        background: #f0f0f0;
        color: #333;
    }

    .btn-secondary:hover {
        background: #e0e0e0;
    }

    @media (max-width: 600px) {
        .success-wrapper {
            margin: 40px auto;
        }
        
        .action-buttons {
            flex-direction: column;
            align-items: center;
        }
        
        .btn {
            width: 100%;
            max-width: 300px;
        }
    }
</style>

<div class="success-wrapper">
    <div class="success-icon">
        ✓
    </div>
    
    <h1 class="success-title">Payment Successful!</h1>
    
    <p class="success-message">
        Thank you for your order! Your payment has been processed successfully. 
        We've received your order and will start preparing it for shipment.
    </p>
    
    <div class="action-buttons">
        <a href="{{ route('welcome') }}" class="btn btn-primary">Continue Shopping</a>
        <a href="{{ route('user.dashboard') }}" class="btn btn-secondary">My Dashboard</a>
    </div>
</div>
@endsection
