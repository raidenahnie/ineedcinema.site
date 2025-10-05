<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>@yield('title', 'iNeedCinema - My Personal Movie Collection')</title>
    <meta name="description" content="@yield('description', 'My personal cinema collection. Organize, browse, and enjoy my favorite movies and TV series.')"
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Styles -->
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    @vite(['resources/css/app.css'])
    @stack('styles')
</head>
<body class="bg-dark text-white font-inter antialiased">
    <!-- Header -->
    <header class="fixed top-0 left-0 right-0 z-50 bg-dark/95 backdrop-blur-md border-b border-gray-800">
        <nav class="container mx-auto px-4 py-4">
            <div class="flex items-center justify-between">
                <!-- Logo -->
                <div class="flex items-center space-x-2">
                    <a href="{{ route('home') }}" class="flex items-center space-x-2">
                        <div class="w-10 h-10 bg-gradient-to-r from-red-600 to-red-500 rounded-lg flex items-center justify-center">
                            <i class="fas fa-play text-white text-lg"></i>
                        </div>
                        <span class="text-2xl font-bold text-white">iNeedCinema</span>
                    </a>
                </div>
                
                <!-- Navigation Menu -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="{{ route('home') }}" class="text-white hover:text-red-500 transition-colors duration-200 @if(request()->routeIs('home')) text-red-500 @endif">Home</a>
                    <a href="#" class="text-gray-400 hover:text-red-500 transition-colors duration-200">Movies</a>
                    <a href="#" class="text-gray-400 hover:text-red-500 transition-colors duration-200">TV Shows</a>
                    <a href="#" class="text-gray-400 hover:text-red-500 transition-colors duration-200">Genres</a>
                    <a href="#" class="text-gray-400 hover:text-red-500 transition-colors duration-200">My List</a>
                </div>
                
                <!-- Search and User Actions -->
                <div class="flex items-center space-x-4">
                    <!-- Search -->
                    <div class="hidden sm:block">
                        <div class="relative">
                            <input type="text" 
                                   placeholder="Search movies, TV shows..." 
                                   class="bg-gray-800 text-white placeholder-gray-400 rounded-lg px-4 py-2 w-64 focus:outline-none focus:ring-2 focus:ring-red-500">
                            <i class="fas fa-search absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                        </div>
                    </div>
                    
                    <!-- Mobile Search -->
                    <button class="sm:hidden text-gray-400 hover:text-white transition-colors duration-200">
                        <i class="fas fa-search text-xl"></i>
                    </button>
                    
                    <!-- Notifications -->
                    <button class="relative text-gray-400 hover:text-white transition-colors duration-200">
                        <i class="fas fa-bell text-xl"></i>
                        <span class="absolute -top-2 -right-2 bg-red-600 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">2</span>
                    </button>
                    
                    <!-- Settings -->
                    <button class="text-gray-400 hover:text-white transition-colors duration-200">
                        <i class="fas fa-cog text-xl"></i>
                    </button>
                    
                    <!-- Mobile Menu Toggle -->
                    <button class="md:hidden text-gray-400 hover:text-white transition-colors duration-200" 
                            onclick="toggleMobileMenu()">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                </div>
            </div>
            
            <!-- Mobile Menu -->
            <div id="mobileMenu" class="hidden md:hidden mt-4 pb-4 border-t border-gray-800">
                <div class="flex flex-col space-y-4 mt-4">
                    <a href="{{ route('home') }}" class="text-white hover:text-red-500 transition-colors duration-200">Home</a>
                    <a href="#" class="text-gray-400 hover:text-red-500 transition-colors duration-200">Movies</a>
                    <a href="#" class="text-gray-400 hover:text-red-500 transition-colors duration-200">TV Shows</a>
                    <a href="#" class="text-gray-400 hover:text-red-500 transition-colors duration-200">Genres</a>
                    <a href="#" class="text-gray-400 hover:text-red-500 transition-colors duration-200">My List</a>
                    
                    <!-- Mobile Search -->
                    <div class="mt-4">
                        <input type="text" 
                               placeholder="Search movies, TV shows..." 
                               class="bg-gray-800 text-white placeholder-gray-400 rounded-lg px-4 py-2 w-full focus:outline-none focus:ring-2 focus:ring-red-500">
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <!-- Main Content -->
    <main class="pt-20">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900 border-t border-gray-800 mt-16">
        <div class="container mx-auto px-4 py-12">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                <!-- Brand -->
                <div class="col-span-1 lg:col-span-2">
                    <div class="flex items-center space-x-2 mb-4">
                        <div class="w-10 h-10 bg-gradient-to-r from-red-600 to-red-500 rounded-lg flex items-center justify-center">
                            <i class="fas fa-play text-white text-lg"></i>
                        </div>
                        <span class="text-2xl font-bold text-white">iNeedCinema</span>
                    </div>
                    <p class="text-gray-400 mb-4 max-w-md">
                        Watch thousands of movies and TV shows online. 
                        Stream your favorite content anytime, anywhere.
                    </p>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-red-500 transition-colors duration-200">
                            <i class="fab fa-facebook-f text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-red-500 transition-colors duration-200">
                            <i class="fab fa-twitter text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-red-500 transition-colors duration-200">
                            <i class="fab fa-instagram text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-red-500 transition-colors duration-200">
                            <i class="fab fa-youtube text-xl"></i>
                        </a>
                    </div>
                </div>
                
                <!-- Browse -->
                <div>
                    <h3 class="text-white font-semibold mb-4">Browse</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors duration-200">Movies</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors duration-200">TV Shows</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors duration-200">New & Popular</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors duration-200">My List</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors duration-200">Browse by Language</a></li>
                    </ul>
                </div>
                
                <!-- Help -->
                <div>
                    <h3 class="text-white font-semibold mb-4">Help</h3>
                    <ul class="space-y-2">
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors duration-200">Help Center</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors duration-200">Contact Us</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors duration-200">Account</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors duration-200">Media Center</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors duration-200">Privacy</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition-colors duration-200">Terms of Use</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="border-t border-gray-700 mt-8 pt-8">
                <div class="flex flex-col sm:flex-row justify-between items-center">
                    <p class="text-gray-400 text-sm">
                        © {{ date('Y') }} iNeedCinema.site. All rights reserved.
                    </p>
                    <div class="flex space-x-6 mt-4 sm:mt-0">
                        <a href="#" class="text-gray-400 hover:text-white text-sm transition-colors duration-200">Privacy</a>
                        <a href="#" class="text-gray-400 hover:text-white text-sm transition-colors duration-200">Terms</a>
                        <a href="#" class="text-gray-400 hover:text-white text-sm transition-colors duration-200">Cookies</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    @vite(['resources/js/app.js'])
    
    <script>
        function toggleUserMenu() {
            const menu = document.getElementById('userMenu');
            menu.classList.toggle('hidden');
        }
        
        function toggleMobileMenu() {
            const menu = document.getElementById('mobileMenu');
            menu.classList.toggle('hidden');
        }
        
        // Close menus when clicking outside
        document.addEventListener('click', function(event) {
            const userMenu = document.getElementById('userMenu');
            const mobileMenu = document.getElementById('mobileMenu');
            
            if (!event.target.closest('.relative') && userMenu) {
                userMenu.classList.add('hidden');
            }
            
            if (!event.target.closest('button') && mobileMenu && !event.target.closest('#mobileMenu')) {
                mobileMenu.classList.add('hidden');
            }
        });
    </script>
    
    @stack('scripts')
</body>
</html>