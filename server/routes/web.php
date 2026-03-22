<?php

use Illuminate\Support\Facades\Route;
// import user controller 
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

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
    });

    // Manager Only
    Route::middleware(['manager'])->group(function () {
        Route::get('/manager/dashboard', function() { return view('dashboards.manager'); })->name('manager.dashboard');
    });
});