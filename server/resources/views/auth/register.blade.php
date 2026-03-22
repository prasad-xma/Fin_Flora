@extends('layouts.app')

@section('title', 'Register')

@section('content')
<div class="container">
    <h2>Create Account</h2>
    <form action="{{ route('user.register') }}" method="POST">
        @csrf <input type="text" name="first_name" placeholder="First Name" required>
        <input type="text" name="last_name" placeholder="Last Name" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <input type="text" name="phone_no" placeholder="Phone Number">
        <textarea name="address" placeholder="Address"></textarea>
        
        <button type="submit">Register</button>
    </form>
</div>
@endsection