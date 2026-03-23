<?php

use Illuminate\Support\Facades\Route;
// import user controller 
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AquariumItemController;
use App\Http\Controllers\AdminManagerController;

Route::get('/', [WelcomeController::class, 'index'])->name('welcome');

// Authentication Routes
Route::get('/login', function() { return view('auth.login'); })->name('login');
Route::post('/login', [UserController::class, 'login'])->name('login.post');
Route::post('/logout', [UserController::class, 'logout'])->name('logout');

// registeration
Route::get('/register', [UserController::class, 'showRegisterForm'])->name('register.form');
Route::post('/register', [UserController::class, 'register'])->name('user.register');

// Group for Authenticated Users
Route::middleware(['auth'])->group(function () {
    
    // User Dashboard
    Route::get('/dashboard', function() { return view('dashboards.user'); })->name('user.dashboard');

    // Admin Only
    Route::middleware(['admin'])->group(function () {
        Route::get('/admin/dashboard', function() { return view('dashboards.admin'); })->name('admin.dashboard');
        
        // Manager Management
        Route::get('/admin/managers', [AdminManagerController::class, 'index'])->name('admin.managers.index');
        Route::get('/admin/managers/create', [AdminManagerController::class, 'create'])->name('admin.managers.create');
        Route::post('/admin/managers', [AdminManagerController::class, 'store'])->name('admin.managers.store');
        Route::get('/admin/managers/{manager}', [AdminManagerController::class, 'show'])->name('admin.managers.show');
        Route::get('/admin/managers/{manager}/edit', [AdminManagerController::class, 'edit'])->name('admin.managers.edit');
        Route::put('/admin/managers/{manager}', [AdminManagerController::class, 'update'])->name('admin.managers.update');
        Route::delete('/admin/managers/{manager}', [AdminManagerController::class, 'destroy'])->name('admin.managers.destroy');
        Route::post('/admin/managers/{manager}/toggle-status', [AdminManagerController::class, 'toggleStatus'])->name('admin.managers.toggle-status');
    });

    // Manager Only
    Route::middleware(['manager'])->group(function () {
        Route::get('/manager/dashboard', function() { return view('dashboards.manager'); })->name('manager.dashboard');
        
        // Aquarium Items Management
        Route::get('/aquarium-items', [AquariumItemController::class, 'index'])->name('aquarium-items.index');
        Route::get('/aquarium-items/create', [AquariumItemController::class, 'create'])->name('aquarium-items.create');
        Route::post('/aquarium-items', [AquariumItemController::class, 'store'])->name('aquarium-items.store');
        Route::get('/aquarium-items/{aquariumItem}', [AquariumItemController::class, 'show'])->name('aquarium-items.show');
        Route::get('/aquarium-items/{aquariumItem}/edit', [AquariumItemController::class, 'edit'])->name('aquarium-items.edit');
        Route::put('/aquarium-items/{aquariumItem}', [AquariumItemController::class, 'update'])->name('aquarium-items.update');
        Route::delete('/aquarium-items/{aquariumItem}', [AquariumItemController::class, 'destroy'])->name('aquarium-items.destroy');
    });
});