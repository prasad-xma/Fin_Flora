<?php

use Illuminate\Support\Facades\Route;
// import user controller 
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

// registeration
Route::get('/register', [UserController::class, 'showRegisterForm'])->name('register.form');
Route::post('/register', [UserController::class, 'register'])->name('user.register');