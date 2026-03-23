@extends('layouts.app')

@section('title', 'Managers - Admin Dashboard')

@section('content')
<style>
    .managers-wrapper {
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

    .add-manager-btn {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        padding: 12px 24px;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 600;
        font-size: 1rem;
        transition: all 0.2s;
    }

    .add-manager-btn:hover {
        background: linear-gradient(135deg, #5a67d8 0%, #6b46c1 100%);
        transform: translateY(-1px);
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
    }

    .managers-table {
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

    @media (max-width: 768px) {
        .managers-wrapper {
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

<div class="managers-wrapper">
    <div class="page-header">
        <h1 class="page-title">Managers</h1>
        <a href="{{ route('admin.managers.create') }}" class="add-manager-btn">
            + Add New Manager
        </a>
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

    <div class="managers-table">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Created At</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @if($managers->isEmpty())
                    <tr>
                        <td colspan="7" style="text-align: center; padding: 40px; color: #6b7280;">
                            No managers found.
                        </td>
                    </tr>
                @else
                    @foreach($managers as $manager)
                    <tr>
                        <td>{{ $manager->id }}</td>
                        <td>{{ $manager->name }}</td>
                        <td>{{ $manager->email }}</td>
                        <td>{{ $manager->phone_no ?: '-' }}</td>
                        <td>{{ $manager->created_at->format('M d, Y') }}</td>
                        <td>
                            <span class="status-badge {{ $manager->is_active ? 'status-active' : 'status-inactive' }}">
                                {{ $manager->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td>
                            <div class="action-buttons">
                                <a href="{{ route('admin.managers.show', $manager) }}" class="btn btn-view">
                                    <svg width="12" height="12" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10 12a2 2 0 100-4 2 2 0 000-4z"/>
                                    </svg>
                                    View
                                </a>
                                <a href="{{ route('admin.managers.edit', $manager) }}" class="btn btn-edit">
                                    <svg width="12" height="12" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M13.586 3.586a2 2 0 112.828 0l-4.414 4.414a2 2 0 01-2.828 0L4 12a2 2 0 00-2 2v6a2 2 0 002 2h8a2 2 0 002-2V8a2 2 0 00-2-2z"/>
                                    </svg>
                                    Edit
                                </a>
                                @if($manager->is_active)
                                    <form action="{{ route('admin.managers.toggle-status', $manager) }}" method="POST" style="display: inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-deactivate" onclick="return confirm('Are you sure you want to deactivate this manager?')">
                                            <svg width="12" height="12" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 00-1.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293z" clip-rule="evenodd"/>
                                            </svg>
                                            Deactivate
                                        </button>
                                    </form>
                                @else
                                    <form action="{{ route('admin.managers.toggle-status', $manager) }}" method="POST" style="display: inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-activate" onclick="return confirm('Are you sure you want to activate this manager?')">
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
</div>
@endsection
