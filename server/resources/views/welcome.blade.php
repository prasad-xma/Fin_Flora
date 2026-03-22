@extends('layouts.app')

@section('title', 'Welcome to Fin & Flora')

@section('content')
<!-- Hero Section -->
<section class="bg-gradient-to-br from-blue-600 to-cyan-600 text-white py-24">
    <div class="max-w-4xl mx-auto text-center px-4 sm:px-6 lg:px-8">
        <h1 class="text-4xl md:text-5xl font-bold mb-6">Welcome to Fin & Flora</h1>
        <p class="text-xl md:text-2xl mb-8 opacity-90">Discover the perfect blend of aquatic wisdom and natural beauty</p>
        <a href="{{ route('register.form') }}" class="inline-block bg-white text-blue-600 px-8 py-3 rounded-full font-semibold text-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-200">Get Started Today</a>
    </div>
</section>

<!-- Features Section -->
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-3xl md:text-4xl font-bold text-center text-gray-900 mb-12">What We Offer</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-white p-8 rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-200 text-center">
                <div class="text-5xl mb-4"></div>
                <h3 class="text-xl font-semibold text-gray-900 mb-4">Aquatic Planning</h3>
                <p class="text-gray-600 leading-relaxed">Expert guidance to help you manage your aquarium and achieve your aquatic goals.</p>
            </div>
            <div class="bg-white p-8 rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-200 text-center">
                <div class="text-5xl mb-4"></div>
                <h3 class="text-xl font-semibold text-gray-900 mb-4">Aquatic Solutions</h3>
                <p class="text-gray-600 leading-relaxed">Sustainable and eco-friendly approaches to modern aquarium keeping and marine life.</p>
            </div>
            <div class="bg-white p-8 rounded-xl shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-200 text-center">
                <div class="text-5xl mb-4"></div>
                <h3 class="text-xl font-semibold text-gray-900 mb-4">Educational Resources</h3>
                <p class="text-gray-600 leading-relaxed">Comprehensive guides and tutorials to expand your aquatic knowledge.</p>
            </div>
        </div>
    </div>
</section>
@endsection
