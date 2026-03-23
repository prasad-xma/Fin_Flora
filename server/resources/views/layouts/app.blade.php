<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Fin And Flora | @yield('title')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="pt-20">
    <!-- Navigation -->
    <nav class="fixed top-0 left-0 right-0 bg-white/95 backdrop-blur-sm shadow-md z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <div class="flex items-center">
                    <div class="text-xl font-bold text-blue-600">Fin & Flora</div>
                </div>
                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('welcome') }}" class="text-gray-700 hover:text-blue-600 font-medium transition-colors">Home</a>
                    <a href="#" class="text-gray-700 hover:text-blue-600 font-medium transition-colors">About Us</a>
                    <a href="#" class="text-gray-700 hover:text-blue-600 font-medium transition-colors">Blogs</a>
                    <a href="#" class="text-gray-700 hover:text-blue-600 font-medium transition-colors">Contact</a>
                    
                    @guest
                        <a href="{{ route('login') }}" class="bg-gradient-to-r from-blue-600 to-cyan-600 text-white px-6 py-2 rounded-full font-medium hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-200">Sign In</a>
                    @else
                        <!-- Cart Icon -->
                        <a href="{{ route('cart.index') }}" class="relative text-gray-700 hover:text-blue-600 transition-colors">
                            <svg class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                            <span id="cart-counter" class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center hidden">0</span>
                        </a>
                        
                        @if(auth()->user()->isAdmin())
                            <a href="{{ route('admin.dashboard') }}" class="border-2 border-blue-600 text-blue-600 hover:bg-blue-600 hover:text-white px-4 py-2 rounded-lg transition-all duration-200 font-medium">Dashboard</a>
                        @elseif(auth()->user()->isManager())
                            <a href="{{ route('manager.dashboard') }}" class="border-2 border-blue-600 text-blue-600 hover:bg-blue-600 hover:text-white px-4 py-2 rounded-lg transition-all duration-200 font-medium">Dashboard</a>
                        @else
                            <a href="{{ route('user.dashboard') }}" class="border-2 border-green-600 text-green-600 hover:bg-green-600 hover:text-white px-4 py-2 rounded-lg transition-all duration-200 font-medium">Profile</a>
                        @endif
                        <form action="{{ route('logout') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="text-gray-600 hover:text-red-600 font-medium transition-colors">Logout</button>
                        </form>
                    @endguest
                </div>
            </div>
        </div>
    </nav>

    @yield('content')

    @guest
        <!-- Cart functionality for guests -->
    @else
        <script>
            // Initialize cart counter
            document.addEventListener('DOMContentLoaded', function() {
                fetch('{{ route("cart.count") }}')
                    .then(response => response.json())
                    .then(data => {
                        updateCartCounter(data.count);
                    })
                    .catch(error => console.error('Error fetching cart count:', error));
            });

            function updateCartCounter(count) {
                const cartCounter = document.getElementById('cart-counter');
                if (cartCounter) {
                    cartCounter.textContent = count;
                    if (count > 0) {
                        cartCounter.classList.remove('hidden');
                    } else {
                        cartCounter.classList.add('hidden');
                    }
                }
            }
        </script>
    @endguest
</body>
</html>