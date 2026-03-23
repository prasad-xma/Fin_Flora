@extends('layouts.app')

@section('title', 'Users - Admin Dashboard')

@section('content')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<style>
    .users-wrapper {
        max-width: 1200px;
        margin: 40px auto;
        padding: 0 20px;
        font-family: 'Inter', sans-serif;
    }

    .page-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
    }

    .page-title {
        font-size: 2rem;
        font-weight: 700;
        color: #1a1a1a;
        margin: 0;
    }

    .add-user-btn {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 12px 24px;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 600;
        font-size: 1rem;
        transition: all 0.2s;
    }

    .add-user-btn:hover {
        background: linear-gradient(135deg, #5a67d8 0%, #6b46c1 100%);
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
    }

    .users-table {
        background: white;
        border-radius: 12px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        overflow: hidden;
        border: 1px solid #e5e7eb;
    }

    .table {
        width: 100%;
        border-collapse: collapse;
    }

    .table th {
        background: #f8f9fa;
        padding: 12px 16px;
        text-align: left;
        font-weight: 600;
        color: #374151;
        font-size: 0.875rem;
        border-bottom: 2px solid #e5e7eb;
    }

    .table td {
        padding: 16px;
        border-bottom: 1px solid #f3f4f6;
        color: #374151;
    }

    .table tr:hover {
        background: #f9fafb;
    }

    .action-buttons {
        display: flex;
        gap: 8px;
        align-items: center;
    }

    .btn {
        padding: 6px 12px;
        border-radius: 6px;
        font-size: 0.875rem;
        font-weight: 500;
        text-decoration: none;
        border: none;
        cursor: pointer;
        transition: all 0.2s;
        display: inline-flex;
        align-items: center;
        gap: 4px;
    }

    .btn-view {
        background: #3b82f6;
        color: white;
    }

    .btn-view:hover {
        background: #2563eb;
    }

    .btn-edit {
        background: #f59e0b;
        color: white;
    }

    .btn-edit:hover {
        background: #d97706;
    }

    .btn-deactivate {
        background: #ef4444;
        color: white;
    }

    .btn-deactivate:hover {
        background: #dc2626;
    }

    .btn-activate {
        background: #10b981;
        color: white;
    }

    .btn-activate:hover {
        background: #059669;
    }

    .status-badge {
        padding: 4px 8px;
        border-radius: 12px;
        font-size: 0.75rem;
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

    .pagination {
        margin-top: 20px;
        display: flex;
        justify-content: center;
        gap: 8px;
    }

    .pagination a {
        padding: 8px 16px;
        border: 1px solid #e5e7eb;
        border-radius: 6px;
        color: #374151;
        text-decoration: none;
        transition: all 0.2s;
    }

    .pagination a:hover {
        background: #f3f4f6;
        color: #111827;
    }

    .pagination .current {
        background: #4f46e5;
        color: white;
        border-color: #4f46e5;
    }

    @media (max-width: 768px) {
        .users-wrapper {
            margin: 20px auto;
            padding: 0 10px;
        }
        
        .page-header {
            flex-direction: column;
            gap: 15px;
            align-items: stretch;
        }
        
        .action-buttons {
            flex-direction: column;
            align-items: stretch;
        }
        
        .table {
            font-size: 0.8rem;
        }
        
        .table th, .table td {
            padding: 8px;
        }
    }
</style>

<div class="users-wrapper">
    <div class="page-header">
        <h1 class="page-title">Users</h1>
    </div>

    @if(session('success'))
        <div style="background: #d1fae5; color: #065f46; padding: 15px 20px; border-radius: 8px; margin-bottom: 20px; border: 1px solid #a7f3d0;">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div style="background: #fee2e2; color: #991b1b; padding: 15px 20px; border-radius: 8px; margin-bottom: 20px; border: 1px solid #fca5a5;">
            {{ session('error') }}
        </div>
    @endif

    <div class="users-table">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Address</th>
                    <th>Registered At</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @if($users->isEmpty())
                    <tr>
                        <td colspan="8" style="text-align: center; padding: 40px; color: #6b7280;">
                            No users found.
                        </td>
                    </tr>
                @else
                    @foreach($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->phone_no ?: '-' }}</td>
                        <td>{{ Str::limit($user->address ?: '-', 30) }}</td>
                        <td>{{ $user->created_at->format('M d, Y') }}</td>
                        <td>
                            <span class="status-badge {{ $user->is_active ? 'status-active' : 'status-inactive' }}">
                                {{ $user->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('admin.users.show', $user) }}" class="btn btn-view">
                                    <svg width="12" height="12" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10 12a2 2 0 100-4 2 2 0 000-4z"/>
                                    </svg>
                                    View
                                </a>
                                <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-edit">
                                    <svg width="12" height="12" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M13.586 3.586a2 2 0 112.828 0l-4.414 4.414a2 2 0 01-2.828 0L4 12a2 2 0 00-2 2v6a2 2 0 002 2h8a2 2 0 002-2V8a2 2 0 00-2-2z"/>
                                    </svg>
                                    Edit
                                </a>
                                @if($user->is_active)
                                    <form action="{{ route('admin.users.toggle-status', $user) }}" method="POST" style="display: inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-deactivate" onclick="return confirm('Are you sure you want to deactivate this user?')">
                                            <svg width="12" height="12" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 00-1.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293z" clip-rule="evenodd"/>
                                            </svg>
                                            Deactivate
                                        </button>
                                    </form>
                                @else
                                    <form action="{{ route('admin.users.toggle-status', $user) }}" method="POST" style="display: inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-activate" onclick="return confirm('Are you sure you want to activate this user?')">
                                            <svg width="12" height="12" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707a1 1 0 00-1.414 0L5.293 4.707a1 1 0 112.828 0l4.414 4.414a1 1 0 011.414 0L10 13.414l4.414-4.414z" clip-rule="evenodd"/>
                                            </svg>
                                            Activate
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="pagination">
        {{ $users->links() }}
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
