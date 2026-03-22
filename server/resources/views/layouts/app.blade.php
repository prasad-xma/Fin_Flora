<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
</body>
</html>