@extends('layouts.app')

@section('title', 'Welcome to Fin & Flora')

@section('content')
<!-- Navigation -->
<nav class="fixed top-0 left-0 right-0 bg-white/95 backdrop-blur-sm shadow-md z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <div class="flex items-center">
                <div class="text-xl font-bold text-purple-600">🌿 Fin & Flora</div>
            </div>
            <div class="hidden md:flex items-center space-x-8">
                <a href="#" class="text-gray-700 hover:text-purple-600 font-medium transition-colors">Home</a>
                <a href="#" class="text-gray-700 hover:text-purple-600 font-medium transition-colors">About Us</a>
                <a href="#" class="text-gray-700 hover:text-purple-600 font-medium transition-colors">Blogs</a>
                <a href="#" class="text-gray-700 hover:text-purple-600 font-medium transition-colors">Contact</a>
                <a href="{{ route('register.form') }}" class="bg-gradient-to-r from-purple-600 to-purple-800 text-white px-6 py-2 rounded-full font-medium hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-200">Sign Up</a>
            </div>
        </div>
    </div>
</nav>

<!-- Hero Section -->
<section class="bg-gradient-to-br from-purple-600 to-purple-800 text-white py-24">
    <div class="max-w-4xl mx-auto text-center px-4 sm:px-6 lg:px-8">
        <h1 class="text-4xl md:text-5xl font-bold mb-6">Welcome to Fin & Flora</h1>
        <p class="text-xl md:text-2xl mb-8 opacity-90">Discover the perfect blend of financial wisdom and natural beauty</p>
        <a href="{{ route('register.form') }}" class="inline-block bg-white text-purple-600 px-8 py-3 rounded-full font-semibold text-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-200">Get Started Today</a>
    </div>
</section>

<!-- Features Section -->
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl md:text-4xl font-bold text-center text-gray-900 mb-12">What We Offer</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-white p-8 rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-200 text-center">
                <div class="text-5xl mb-4">💰</div>
                <h3 class="text-xl font-semibold text-gray-900 mb-4">Financial Planning</h3>
                <p class="text-gray-600 leading-relaxed">Expert guidance to help you manage your finances and achieve your financial goals.</p>
            </div>
            <div class="bg-white p-8 rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-200 text-center">
                <div class="text-5xl mb-4">🌱</div>
                <h3 class="text-xl font-semibold text-gray-900 mb-4">Natural Solutions</h3>
                <p class="text-gray-600 leading-relaxed">Sustainable and eco-friendly approaches to modern living and business.</p>
            </div>
            <div class="bg-white p-8 rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-200 text-center">
                <div class="text-5xl mb-4">📚</div>
                <h3 class="text-xl font-semibold text-gray-900 mb-4">Educational Resources</h3>
                <p class="text-gray-600 leading-relaxed">Comprehensive guides and tutorials to expand your knowledge.</p>
            </div>
        </div>
    </div>
</section>
@endsection
