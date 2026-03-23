@extends('layouts.app')

@section('title', 'Admin Dashboard - Fin & Flora')

@section('content')
<style>
    .admin-profile-btn {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%) !important;
        color: white !important;
        padding: 12px 24px !important;
        border-radius: 8px !important;
        font-weight: 600 !important;
        font-size: 1rem !important;
        text-decoration: none !important;
        display: inline-block !important;
        width: 100% !important;
        text-align: center !important;
        transition: all 0.2s ease !important;
    }
    
    .admin-profile-btn:hover {
        background: linear-gradient(135deg, #5a67d8 0%, #6b46c1 100%) !important;
        transform: translateY(-1px) !important;
        box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4) !important;
    }
</style>
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="bg-white rounded-lg shadow-md p-6 mb-8">
            <div class="flex items-center">
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Admin Dashboard</h1>
                    <p class="text-gray-600 mt-2">Welcome back, {{ auth()->user()->name }}!</p>
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800 mt-2">
                        Administrator
                    </span>
                </div>
            </div>
        </div>

        <!-- Admin Stats -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-red-100 rounded-lg p-3">
                        <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-medium text-gray-900">Total Users</h3>
                        <p class="text-2xl font-bold text-gray-900">{{ App\Models\User::count() }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-blue-100 rounded-lg p-3">
                        <svg class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-medium text-gray-900">Managers</h3>
                        <p class="text-2xl font-bold text-gray-900">{{ App\Models\User::where('role', 'manager')->count() }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-green-100 rounded-lg p-3">
                        <svg class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-medium text-gray-900">Active Managers</h3>
                        <p class="text-2xl font-bold text-gray-900">{{ App\Models\User::where('role', 'manager')->where('is_active', true)->count() }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-md p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0 bg-purple-100 rounded-lg p-3">
                        <svg class="h-6 w-6 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <h3 class="text-lg font-medium text-gray-900">Total Items</h3>
                        <p class="text-2xl font-bold text-gray-900">{{ App\Models\AquariumItem::count() }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Admin Actions -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Manager Management</h3>
                <p class="text-gray-600 mb-4">Create and manage manager accounts</p>
                <div class="space-y-2">
                    <a href="{{ route('admin.managers.index') }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition-colors w-full text-center">
                        View Managers
                    </a>
                    <a href="{{ route('admin.managers.create') }}" class="inline-block bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg transition-colors w-full text-center">
                        Add Manager
                    </a>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">User Management</h3>
                <p class="text-gray-600 mb-4">View and manage all users</p>
                <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition-colors w-full">
                    Manage Users
                </button>
            </div>

            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Admin Profile</h3>
                <p class="text-gray-600 mb-4">Update your admin account details</p>
                <a href="{{ route('admin.profile') }}" class="admin-profile-btn">
                    Edit Profile
                </a>
            </div>

            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">System Settings</h3>
                <p class="text-gray-600 mb-4">Configure system preferences</p>
                <button class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg transition-colors w-full">
                    Settings
                </button>
            </div>

            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Reports</h3>
                <p class="text-gray-600 mb-4">Generate system reports</p>
                <button class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-lg transition-colors w-full">
                    Generate Reports
                </button>
            </div>

            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Audit Logs</h3>
                <p class="text-gray-600 mb-4">View system activity logs</p>
                <button class="bg-orange-600 hover:bg-orange-700 text-white px-4 py-2 rounded-lg transition-colors w-full">
                    View Logs
                </button>
            </div>

            <div class="bg-white rounded-lg shadow-md p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-4">Backup</h3>
                <p class="text-gray-600 mb-4">System backup and restore</p>
                <button class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg transition-colors w-full">
                    Backup System
                </button>
            </div>
        </div>
    </div>
</div>
@endsection
