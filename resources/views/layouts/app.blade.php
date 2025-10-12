<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5, user-scalable=yes">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="theme-color" content="#1f2937">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    
    <!-- SEO Meta Tags -->
    <title>@yield('title', 'iNeedCinema - Stream Movies, TV Shows & Anime Online')</title>
    <meta name="description" content="@yield('description', 'Discover and stream movies, TV shows, and anime. Browse through thousands of titles with an intuitive interface. Content aggregated from third-party sources.')">
    <meta name="keywords" content="@yield('keywords', 'movies, tv shows, anime, streaming, watch online, cinema, entertainment, TMDB')">
    <meta name="author" content="iNeedCinema">
    <meta name="robots" content="index, follow">
    
    <!-- Legal & Disclaimer Meta Tags -->
    <meta name="disclaimer" content="iNeedCinema does not host any files. All content is provided by third-party services. We do not own or distribute any content.">
    <meta name="copyright" content="All content belongs to their respective owners. Trademarks and logos are property of their respective companies.">
    
    <!-- Open Graph / Facebook Meta Tags -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="@yield('og_title', 'iNeedCinema - Stream Movies, TV Shows & Anime')">
    <meta property="og:description" content="@yield('og_description', 'Discover and stream movies, TV shows, and anime from third-party sources.')">
    <meta property="og:image" content="@yield('og_image', asset('images/og-banner.jpg'))">
    <meta property="og:site_name" content="iNeedCinema">
    
    <!-- Twitter Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:url" content="{{ url()->current() }}">
    <meta name="twitter:title" content="@yield('twitter_title', 'iNeedCinema - Stream Movies, TV Shows & Anime')">
    <meta name="twitter:description" content="@yield('twitter_description', 'Discover and stream movies, TV shows, and anime from third-party sources.')">
    <meta name="twitter:image" content="@yield('twitter_image', asset('images/og-banner.jpg'))">
    
    <!-- Canonical URL -->
    <link rel="canonical" href="{{ url()->current() }}">
    
    <!-- Additional Legal Meta Tags -->
    <meta name="rating" content="general">
    <meta name="referrer" content="no-referrer-when-downgrade">
    
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
    <header class="fixed top-0 left-0 right-0 z-50 bg-gray-900/95 backdrop-blur-xl border-b border-gray-800/50 shadow-lg">
        <nav class="container mx-auto px-4 py-3">
            <div class="flex items-center justify-between gap-8">
                <!-- Logo -->
                <a href="{{ route('home') }}" class="flex items-center space-x-3 group flex-shrink-0">
                    <div class="w-10 h-10 bg-gradient-to-br from-red-600 via-red-500 to-orange-500 rounded-xl flex items-center justify-center shadow-lg group-hover:shadow-red-500/50 transition-all duration-300 group-hover:scale-110">
                        <i class="fas fa-play text-white text-lg"></i>
                    </div>
                    <span class="text-2xl font-bold bg-gradient-to-r from-white to-gray-300 bg-clip-text text-transparent">iNeedCinema</span>
                </a>
                
                <!-- Navigation Menu -->
                <div class="hidden lg:flex items-center space-x-1">
                    <a href="{{ route('home') }}" class="nav-link px-4 py-2 rounded-lg @if(request()->routeIs('home')) bg-red-500/10 text-red-500 @endif">
                        <i class="fas fa-home mr-2"></i>Home
                    </a>
                    <a href="{{ route('movies') }}" class="nav-link px-4 py-2 rounded-lg @if(request()->routeIs('movies')) bg-red-500/10 text-red-500 @endif">
                        <i class="fas fa-film mr-2"></i>Movies
                    </a>
                    <a href="{{ route('tv-shows') }}" class="nav-link px-4 py-2 rounded-lg @if(request()->routeIs('tv-shows')) bg-red-500/10 text-red-500 @endif">
                        <i class="fas fa-tv mr-2"></i>TV Shows
                    </a>
                    <a href="{{ route('anime') }}" class="nav-link px-4 py-2 rounded-lg @if(request()->routeIs('anime')) bg-red-500/10 text-red-500 @endif">
                        <i class="fas fa-dragon mr-2"></i>Anime
                    </a>
                </div>
                
                <!-- Search and Actions -->
                <div class="flex items-center gap-3 flex-1 justify-end">
                    <!-- Search with Live Results -->
                    <div class="hidden md:block relative max-w-md w-full">
                        <div class="relative flex items-center">
                            <input type="text" 
                                   id="liveSearch"
                                   placeholder="Search anything..." 
                                   autocomplete="off"
                                   class="w-full bg-gray-800/50 text-white placeholder-gray-500 rounded-xl px-4 py-2.5 pl-11 pr-12 focus:outline-none focus:ring-2 focus:ring-red-500/50 focus:bg-gray-800 transition-all duration-300 border border-gray-700/50 hover:border-gray-600">
                            <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/4 text-gray-500 pointer-events-none"></i>
                            <a href="{{ route('search') }}" 
                               class="absolute right-3 top-1/2 -translate-y-1/4 text-gray-500 hover:text-red-500 transition-colors flex items-center justify-center w-6 h-6"
                               title="Advanced Search">
                                <i class="fas fa-sliders-h text-sm"></i>
                            </a>
                        </div>
                        
                        <!-- Live Search Results Dropdown -->
                        <div id="searchResults" class="hidden absolute top-full left-0 right-0 mt-2 bg-gray-800/95 backdrop-blur-xl border border-gray-700/50 rounded-xl shadow-2xl max-h-96 overflow-y-auto">
                            <div id="searchResultsContent" class="divide-y divide-gray-700/50"></div>
                            <a href="{{ route('search') }}" class="block p-4 text-center text-sm text-gray-400 hover:text-red-500 hover:bg-gray-700/50 transition-colors">
                                <i class="fas fa-arrow-right mr-2"></i>View all results
                            </a>
                        </div>
                    </div>
                    
                    <!-- Mobile Search Button -->
                    <button onclick="toggleMobileSearch()" class="md:hidden p-2 text-gray-400 hover:text-white hover:bg-gray-800 rounded-lg transition-all">
                        <i class="fas fa-search text-lg"></i>
                    </button>
                    
                    <!-- Mobile Menu Toggle -->
                    <button onclick="toggleMobileMenu()" class="lg:hidden p-2 text-gray-400 hover:text-white hover:bg-gray-800 rounded-lg transition-all">
                        <i class="fas fa-bars text-lg"></i>
                    </button>
                </div>
            </div>
            
            <!-- Mobile Search Bar -->
            <div id="mobileSearch" class="hidden md:hidden mt-4 pb-2">
                <div class="relative">
                    <input type="text" 
                           id="mobileSearchInput"
                           placeholder="Search movies, shows, anime..." 
                           class="w-full bg-gray-800/50 text-white placeholder-gray-500 rounded-xl px-4 py-2.5 pl-11 focus:outline-none focus:ring-2 focus:ring-red-500/50 border border-gray-700/50">
                    <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-gray-500"></i>
                </div>
            </div>
            
            <!-- Mobile Menu -->
            <div id="mobileMenu" class="hidden lg:hidden mt-4 pb-2 border-t border-gray-800/50 pt-4">
                <div class="flex flex-col space-y-2">
                    <a href="{{ route('home') }}" class="flex items-center px-4 py-2.5 rounded-lg text-gray-400 hover:text-white hover:bg-gray-800/50 transition-all @if(request()->routeIs('home')) bg-red-500/10 text-red-500 @endif">
                        <i class="fas fa-home w-6"></i>
                        <span>Home</span>
                    </a>
                    <a href="{{ route('movies') }}" class="flex items-center px-4 py-2.5 rounded-lg text-gray-400 hover:text-white hover:bg-gray-800/50 transition-all @if(request()->routeIs('movies')) bg-red-500/10 text-red-500 @endif">
                        <i class="fas fa-film w-6"></i>
                        <span>Movies</span>
                    </a>
                    <a href="{{ route('tv-shows') }}" class="flex items-center px-4 py-2.5 rounded-lg text-gray-400 hover:text-white hover:bg-gray-800/50 transition-all @if(request()->routeIs('tv-shows')) bg-red-500/10 text-red-500 @endif">
                        <i class="fas fa-tv w-6"></i>
                        <span>TV Shows</span>
                    </a>
                    <a href="{{ route('anime') }}" class="flex items-center px-4 py-2.5 rounded-lg text-gray-400 hover:text-white hover:bg-gray-800/50 transition-all @if(request()->routeIs('anime')) bg-red-500/10 text-red-500 @endif">
                        <i class="fas fa-dragon w-6"></i>
                        <span>Anime</span>
                    </a>
                </div>
            </div>
        </nav>
    </header>

    <!-- Main Content -->
    <main class="pt-20">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-gray-900/50 backdrop-blur-xl border-t border-gray-800/50 mt-20">
        <div class="container mx-auto px-4 py-12">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 mb-8">
                <!-- Brand -->
                <div class="lg:col-span-1">
                    <div class="flex items-center space-x-3 mb-4 group">
                        <div class="w-10 h-10 bg-gradient-to-br from-red-600 via-red-500 to-orange-500 rounded-xl flex items-center justify-center shadow-lg group-hover:shadow-red-500/50 transition-all duration-300">
                            <i class="fas fa-play text-white text-lg"></i>
                        </div>
                        <span class="text-2xl font-bold bg-gradient-to-r from-white to-gray-300 bg-clip-text text-transparent">iNeedCinema</span>
                    </div>
                    <p class="text-gray-400 mb-6 max-w-md leading-relaxed">
                        Your ultimate destination for streaming movies, TV shows, and anime. 
                        Discover, watch, and enjoy unlimited entertainment.
                    </p>
                    <div class="flex space-x-3">
                        <a href="#" class="w-10 h-10 flex items-center justify-center bg-gray-800/50 hover:bg-red-500 rounded-lg text-gray-400 hover:text-white transition-all duration-300">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="#" class="w-10 h-10 flex items-center justify-center bg-gray-800/50 hover:bg-red-500 rounded-lg text-gray-400 hover:text-white transition-all duration-300">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="w-10 h-10 flex items-center justify-center bg-gray-800/50 hover:bg-red-500 rounded-lg text-gray-400 hover:text-white transition-all duration-300">
                            <i class="fab fa-instagram"></i>
                        </a>
                        <a href="#" class="w-10 h-10 flex items-center justify-center bg-gray-800/50 hover:bg-red-500 rounded-lg text-gray-400 hover:text-white transition-all duration-300">
                            <i class="fab fa-youtube"></i>
                        </a>
                    </div>
                </div>
                
                <!-- Browse -->
                <div>
                    <h3 class="text-white font-semibold mb-4 text-lg">Browse</h3>
                    <ul class="space-y-3">
                        <li><a href="{{ route('movies') }}" class="text-gray-400 hover:text-red-500 transition-colors duration-200 flex items-center group">
                            <i class="fas fa-chevron-right text-xs mr-2 opacity-0 group-hover:opacity-100 transition-opacity"></i>
                            Movies
                        </a></li>
                        <li><a href="{{ route('tv-shows') }}" class="text-gray-400 hover:text-red-500 transition-colors duration-200 flex items-center group">
                            <i class="fas fa-chevron-right text-xs mr-2 opacity-0 group-hover:opacity-100 transition-opacity"></i>
                            TV Shows
                        </a></li>
                        <li><a href="{{ route('anime') }}" class="text-gray-400 hover:text-red-500 transition-colors duration-200 flex items-center group">
                            <i class="fas fa-chevron-right text-xs mr-2 opacity-0 group-hover:opacity-100 transition-opacity"></i>
                            Anime
                        </a></li>
                        <li><a href="{{ route('search') }}" class="text-gray-400 hover:text-red-500 transition-colors duration-200 flex items-center group">
                            <i class="fas fa-chevron-right text-xs mr-2 opacity-0 group-hover:opacity-100 transition-opacity"></i>
                            Advanced Search
                        </a></li>
                        <li><a href="{{ route('support') }}" class="text-gray-400 hover:text-red-500 transition-colors duration-200 flex items-center group">
                            <i class="fas fa-chevron-right text-xs mr-2 opacity-0 group-hover:opacity-100 transition-opacity"></i>
                            <i class="fas fa-heart text-red-500 mr-1"></i> Support
                        </a></li>
                    </ul>
                </div>
                
                <!-- Contact -->
                <div>
                    <h3 class="text-white font-semibold mb-4 text-lg">Contact</h3>
                    <ul class="space-y-3">
                        <li><a href="{{ route('contact') }}" class="text-gray-400 hover:text-red-500 transition-colors duration-200 flex items-center group">
                            <i class="fas fa-chevron-right text-xs mr-2 opacity-0 group-hover:opacity-100 transition-opacity"></i>
                            <i class="fas fa-envelope text-red-500 mr-2"></i> Contact Us
                        </a></li>
                        <li class="text-gray-400 text-sm pt-2">
                            <p class="mb-2">Have questions or feedback?</p>
                            <p class="text-gray-500 text-xs">We'd love to hear from you!</p>
                        </li>
                    </ul>
                </div>
                
                <!-- Disclaimer -->
                <div>
                    <h3 class="text-white font-semibold mb-4 text-lg">
                        <i class="fas fa-info-circle text-red-500 mr-2"></i>Disclaimer
                    </h3>
                    <div class="text-gray-400 text-sm leading-relaxed space-y-2">
                        <p>
                            iNeedCinema does not host any files on its servers. All content is provided by third-party services.
                        </p>
                        <p>
                            We do not own, produce, or distribute any movies, TV shows, or anime displayed on this website.
                        </p>
                        <p class="text-gray-500 text-xs mt-3">
                            All trademarks, logos, and images are property of their respective owners.
                        </p>
                    </div>
                </div>
            </div>
            
            <div class="border-t border-gray-800/50 pt-8">
                <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
                    <p class="text-gray-500 text-sm text-center sm:text-left">
                        © {{ date('Y') }} iNeedCinema. Content provided via third-party APIs.
                    </p>
                    <div class="flex flex-wrap items-center justify-center gap-4 text-xs">
                        <a href="{{ route('terms') }}" class="text-gray-500 hover:text-red-500 transition-colors">Terms of Service</a>
                        <span class="text-gray-700">•</span>
                        <a href="{{ route('privacy') }}" class="text-gray-500 hover:text-red-500 transition-colors">Privacy Policy</a>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    @vite(['resources/js/app.js'])
    
    <script>
        // Mobile menu toggle
        function toggleMobileMenu() {
            const menu = document.getElementById('mobileMenu');
            menu.classList.toggle('hidden');
        }
        
        // Mobile search toggle
        function toggleMobileSearch() {
            const search = document.getElementById('mobileSearch');
            search.classList.toggle('hidden');
        }
        
        // Live Search Functionality with Optimization
        let searchTimeout;
        let searchCache = {}; // Cache search results
        let currentSearchQuery = '';
        const liveSearchInput = document.getElementById('liveSearch');
        const searchResults = document.getElementById('searchResults');
        const searchResultsContent = document.getElementById('searchResultsContent');
        
        if (liveSearchInput) {
            liveSearchInput.addEventListener('input', function(e) {
                const query = e.target.value.trim();
                
                clearTimeout(searchTimeout);
                
                // Minimum 2 characters required
                if (query.length < 2) {
                    searchResults.classList.add('hidden');
                    currentSearchQuery = '';
                    return;
                }
                
                // Check cache first
                if (searchCache[query]) {
                    displaySearchResults(searchCache[query]);
                    searchResults.classList.remove('hidden');
                    return;
                }
                
                // Debounce: wait 400ms after user stops typing
                searchTimeout = setTimeout(() => {
                    currentSearchQuery = query;
                    performLiveSearch(query);
                }, 400);
            });
            
            // Close search results when clicking outside
            document.addEventListener('click', function(e) {
                if (!searchResults.contains(e.target) && e.target !== liveSearchInput) {
                    searchResults.classList.add('hidden');
                }
            });
            
            // Reopen if user clicks on input and has cached results
            liveSearchInput.addEventListener('focus', function() {
                const query = this.value.trim();
                if (query.length >= 2 && searchCache[query]) {
                    searchResults.classList.remove('hidden');
                }
            });
        }
        
        async function performLiveSearch(query) {
            // Show loading state
            searchResultsContent.innerHTML = `
                <div class="p-6 text-center">
                    <div class="inline-block animate-spin rounded-full h-8 w-8 border-b-2 border-red-500"></div>
                    <p class="text-gray-400 mt-2">Searching...</p>
                </div>
            `;
            searchResults.classList.remove('hidden');
            
            try {
                // Unified fast search - 1 API call instead of 3! (70% faster)
                const controller = new AbortController();
                const timeoutId = setTimeout(() => controller.abort(), 5000); // 5 second timeout (faster)
                
                const response = await fetch(`/api/search?q=${encodeURIComponent(query)}`, { 
                    signal: controller.signal 
                });
                
                clearTimeout(timeoutId);
                
                // Only display if this is still the current search query
                if (query !== currentSearchQuery) {
                    return;
                }
                
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                
                const results = await response.json();
                
                // Cache the results
                searchCache[query] = results;
                
                // Limit cache size to prevent memory issues
                const cacheKeys = Object.keys(searchCache);
                if (cacheKeys.length > 20) {
                    delete searchCache[cacheKeys[0]]; // Remove oldest entry
                }
                
                displaySearchResults(results);
                
            } catch (error) {
                console.error('Search error:', error);
                if (query === currentSearchQuery) {
                    searchResultsContent.innerHTML = `
                        <div class="p-6 text-center">
                            <i class="fas fa-exclamation-circle text-red-500 text-3xl mb-2"></i>
                            <p class="text-gray-400">Search failed. Please try again.</p>
                            <button onclick="performLiveSearch('${query}')" class="mt-3 text-red-500 hover:text-red-400 text-sm">
                                <i class="fas fa-redo mr-1"></i>Retry
                            </button>
                        </div>
                    `;
                }
            }
        }
        
        function displaySearchResults(results) {
            const { movies, tvShows, anime } = results;
            let html = '';
            let totalResults = movies.length + tvShows.length + anime.length;
                
                // Movies
                if (movies.length > 0) {
                    html += '<div class="p-3 bg-gray-700/30"><div class="text-xs font-semibold text-gray-400 uppercase"><i class="fas fa-film mr-2"></i>Movies</div></div>';
                    movies.forEach(item => {
                        const poster = item.poster_path ? `https://image.tmdb.org/t/p/w92${item.poster_path}` : '/images/placeholder-poster.jpg';
                        const year = item.release_date ? new Date(item.release_date).getFullYear() : '';
                        const title = escapeHtml(item.title || 'Unknown Title');
                        html += `
                            <a href="/watch/movie/${item.id}" class="flex items-center gap-3 p-3 hover:bg-gray-700/50 transition-colors">
                                <img src="${poster}" alt="${title}" class="w-12 h-16 object-cover rounded" loading="lazy" onerror="this.src='/images/placeholder-poster.jpg'">
                                <div class="flex-1 min-w-0">
                                    <div class="font-medium text-white truncate">${title}</div>
                                    <div class="text-xs text-blue-400 flex items-center gap-1">
                                        <i class="fas fa-film"></i>
                                        <span>Movie</span>
                                        ${year ? ' • ' + year : ''}
                                        ${item.vote_average ? ' • ⭐ ' + item.vote_average.toFixed(1) : ''}
                                    </div>
                                </div>
                            </a>
                        `;
                    });
                }
                
                // TV Shows
                if (tvShows.length > 0) {
                    html += '<div class="p-3 bg-gray-700/30"><div class="text-xs font-semibold text-gray-400 uppercase"><i class="fas fa-tv mr-2"></i>TV Shows</div></div>';
                    tvShows.forEach(item => {
                        const poster = item.poster_path ? `https://image.tmdb.org/t/p/w92${item.poster_path}` : '/images/placeholder-poster.jpg';
                        const year = item.first_air_date ? new Date(item.first_air_date).getFullYear() : '';
                        const name = escapeHtml(item.name || 'Unknown Show');
                        html += `
                            <a href="/watch/tv/${item.id}/1/1" class="flex items-center gap-3 p-3 hover:bg-gray-700/50 transition-colors">
                                <img src="${poster}" alt="${name}" class="w-12 h-16 object-cover rounded" loading="lazy" onerror="this.src='/images/placeholder-poster.jpg'">
                                <div class="flex-1 min-w-0">
                                    <div class="font-medium text-white truncate">${name}</div>
                                    <div class="text-xs text-purple-400 flex items-center gap-1">
                                        <i class="fas fa-tv"></i>
                                        <span>TV Show</span>
                                        ${year ? ' • ' + year : ''}
                                        ${item.vote_average ? ' • ⭐ ' + item.vote_average.toFixed(1) : ''}
                                    </div>
                                </div>
                            </a>
                        `;
                    });
                }
                
                // Anime
                if (anime.length > 0) {
                    html += '<div class="p-3 bg-gray-700/30"><div class="text-xs font-semibold text-gray-400 uppercase"><i class="fas fa-dragon mr-2"></i>Anime</div></div>';
                    anime.forEach(item => {
                        const poster = item.poster_path ? `https://image.tmdb.org/t/p/w92${item.poster_path}` : '/images/placeholder-poster.jpg';
                        const year = item.first_air_date ? new Date(item.first_air_date).getFullYear() : '';
                        const name = escapeHtml(item.name || 'Unknown Anime');
                        html += `
                            <a href="/watch/anime/${item.id}?season=1&episode=1" class="flex items-center gap-3 p-3 hover:bg-gray-700/50 transition-colors">
                                <img src="${poster}" alt="${name}" class="w-12 h-16 object-cover rounded" loading="lazy" onerror="this.src='/images/placeholder-poster.jpg'">
                                <div class="flex-1 min-w-0">
                                    <div class="font-medium text-white truncate">${name}</div>
                                    <div class="text-xs text-red-400 flex items-center gap-1">
                                        <i class="fas fa-dragon"></i>
                                        <span>Anime</span>
                                        ${year ? ' • ' + year : ''}
                                        ${item.vote_average ? ' • ⭐ ' + item.vote_average.toFixed(1) : ''}
                                    </div>
                                </div>
                            </a>
                        `;
                    });
                }
                
                if (html === '' || totalResults === 0) {
                    html = `
                        <div class="p-6 text-center">
                            <i class="fas fa-search text-gray-600 text-3xl mb-2"></i>
                            <p class="text-gray-400">No results found</p>
                            <p class="text-gray-500 text-sm mt-1">Try different keywords</p>
                        </div>
                    `;
                }
                
                searchResultsContent.innerHTML = html;
        }
        
        // Helper function to escape HTML and prevent XSS
        function escapeHtml(text) {
            const div = document.createElement('div');
            div.textContent = text;
            return div.innerHTML;
        }
        
        // Mobile search functionality
        const mobileSearchInput = document.getElementById('mobileSearchInput');
        if (mobileSearchInput) {
            mobileSearchInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    const query = e.target.value.trim();
                    if (query) {
                        window.location.href = `/search?q=${encodeURIComponent(query)}`;
                    }
                }
            });
        }
    </script>
    
    @stack('scripts')
</body>
</html>