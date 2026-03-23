@extends('layouts.app')

@section('title', 'User Details - Admin Dashboard')

@section('content')
<style>
    .user-show-wrapper {
        max-width: 800px;
        margin: 40px auto;
        padding: 0 20px;
        font-family: 'Inter', sans-serif;
    }

    .page-header {
        margin-bottom: 30px;
    }

    .page-title {
        font-size: 2rem;
        font-weight: 700;
        color: #1a1a1a;
        margin-bottom: 10px;
    }

    .user-card {
        background: white;
        border-radius: 16px;
        padding: 40px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        border: 1px solid #e5e7eb;
    }

    .detail-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
        margin-bottom: 30px;
    }

    .detail-item {
        padding: 15px;
        background: #f9fafb;
        border-radius: 8px;
        border: 1px solid #e5e7eb;
    }

    .detail-label {
        font-size: 0.875rem;
        color: #6b7280;
        font-weight: 600;
        margin-bottom: 5px;
        text-transform: uppercase;
    }

    .detail-value {
        font-size: 1rem;
        color: #1a1a1a;
        font-weight: 500;
    }

    .status-badge {
        display: inline-block;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 0.875rem;
        font-weight: 600;
    }

    .status-active {
        background: #d1fae5;
        color: #065f46;
    }

    .status-inactive {
        background: #fee2e2;
        color: #991b1b;
    }

    .btn {
        padding: 10px 20px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 1rem;
        text-decoration: none;
        border: none;
        cursor: pointer;
        transition: all 0.2s;
        margin-right: 10px;
    }

    .btn-primary {
        background: #3b82f6;
        color: white;
    }

    .btn-primary:hover {
        background: #2563eb;
    }

    .btn-secondary {
        background: #6b7280;
        color: white;
    }

    .btn-secondary:hover {
        background: #4b5563;
    }

    @media (max-width: 768px) {
        .user-show-wrapper {
            margin: 20px auto;
            padding: 0 10px;
        }
        
        .detail-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="user-show-wrapper">
    <div class="page-header">
        <h1 class="page-title">User Details</h1>
        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
            ← Back to Users
        </a>
    </div>

    <div class="user-card">
        <div class="detail-grid">
            <div class="detail-item">
                <div class="detail-label">User ID</div>
                <div class="detail-value">{{ $user->id }}</div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Full Name</div>
                <div class="detail-value">{{ $user->name }}</div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Email Address</div>
                <div class="detail-value">{{ $user->email }}</div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Phone Number</div>
                <div class="detail-value">{{ $user->phone_no ?: 'Not provided' }}</div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Address</div>
                <div class="detail-value">{{ $user->address ?: 'Not provided' }}</div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Account Status</div>
                <div class="detail-value">
                    <span class="status-badge {{ $user->is_active ? 'status-active' : 'status-inactive' }}">
                        {{ $user->is_active ? 'Active' : 'Inactive' }}
                    </span>
                </div>
            </div>
            <div class="detail-item">
                <div class="detail-label">Registered At</div>
                <div class="detail-value">{{ $user->created_at->format('F j, Y g:i A') }}</div>
            </div>
        </div>

        <div style="text-align: center; margin-top: 30px;">
            <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-primary">
                Edit User
            </a>
        </div>
    </div>
</div>
@endsection
