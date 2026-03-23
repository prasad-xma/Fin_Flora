@extends('layouts.app')

@section('title', 'Edit User - Admin Dashboard')

@section('content')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<style>
    .user-edit-wrapper {
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

    .form-section {
        margin-bottom: 35px;
    }

    .section-title {
        font-size: 1.2rem;
        font-weight: 600;
        margin-bottom: 20px;
        color: #333;
        border-bottom: 2px solid #f0f0f0;
        padding-bottom: 8px;
    }

    .form-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 20px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group.full-width {
        grid-column: 1 / -1;
    }

    .form-label {
        display: block;
        margin-bottom: 8px;
        font-weight: 500;
        color: #333;
        font-size: 0.95rem;
    }

    .form-input {
        width: 100%;
        padding: 12px 16px;
        border: 1px solid #ddd;
        border-radius: 8px;
        font-size: 1rem;
        transition: border-color 0.2s;
    }

    .form-input:focus {
        outline: none;
        border-color: #3b82f6;
        box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.1);
    }

    .form-textarea {
        resize: vertical;
        min-height: 100px;
    }

    .btn {
        padding: 12px 24px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 1rem;
        cursor: pointer;
        border: none;
        transition: all 0.2s;
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
        margin-left: 15px;
    }

    .btn-secondary:hover {
        background: #4b5563;
    }

    .alert {
        padding: 15px 20px;
        border-radius: 8px;
        margin-bottom: 25px;
        font-weight: 500;
    }

    .alert-success {
        background: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }

    .alert-danger {
        background: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }

    .error-message {
        color: #dc3545;
        font-size: 0.875rem;
        margin-top: 5px;
    }

    @media (max-width: 768px) {
        .user-edit-wrapper {
            margin: 20px auto;
            padding: 0 10px;
        }
        
        .form-grid {
            grid-template-columns: 1fr;
        }
        
        .btn-secondary {
            margin-left: 0;
            margin-top: 10px;
            display: block;
            width: 100%;
        }
    }
</style>

<div class="user-edit-wrapper">
    <div class="page-header">
        <h1 class="page-title">Edit User</h1>
        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
            ← Back to Users
        </a>
    </div>

    <div class="user-card">
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                <ul style="margin: 0; padding-left: 20px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.users.update', $user) }}" method="POST">
            @csrf
            @method('PUT')

            <!-- Personal Information -->
            <div class="form-section">
                <h2 class="section-title">Personal Information</h2>
                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label" for="first_name">First Name</label>
                        <input type="text" id="first_name" name="first_name" class="form-input" 
                               value="{{ old('first_name', $user->first_name) }}" required>
                        @if($errors->has('first_name'))
                            <div class="error-message">{{ $errors->first('first_name') }}</div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="last_name">Last Name</label>
                        <input type="text" id="last_name" name="last_name" class="form-input" 
                               value="{{ old('last_name', $user->last_name) }}" required>
                        @if($errors->has('last_name'))
                            <div class="error-message">{{ $errors->first('last_name') }}</div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="email">Email Address</label>
                        <input type="email" id="email" name="email" class="form-input" 
                               value="{{ old('email', $user->email) }}" required>
                        @if($errors->has('email'))
                            <div class="error-message">{{ $errors->first('email') }}</div>
                        @endif
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="phone_no">Phone Number</label>
                        <input type="tel" id="phone_no" name="phone_no" class="form-input" 
                               value="{{ old('phone_no', $user->phone_no) }}">
                        @if($errors->has('phone_no'))
                            <div class="error-message">{{ $errors->first('phone_no') }}</div>
                        @endif
                    </div>

                    <div class="form-group full-width">
                        <label class="form-label" for="address">Address</label>
                        <textarea id="address" name="address" class="form-input form-textarea" 
                                  rows="3">{{ old('address', $user->address) }}</textarea>
                        @if($errors->has('address'))
                            <div class="error-message">{{ $errors->first('address') }}</div>
                        @endif
                    </div>
                </div>
            </div>

            <div style="text-align: center; margin-top: 30px;">
                <button type="submit" class="btn btn-primary">Update User</button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: '{{ session('success') }}',
            timer: 2000,
            showConfirmButton: false
        });
    @endif

    @if(session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: '{{ session('error') }}',
            confirmButtonText: 'OK'
        });
    @endif
});
</script>
@endsection
