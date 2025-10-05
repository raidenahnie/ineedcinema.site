@extends('layouts.app')

@section('title', 'iNeedCinema - Watch Movies & TV Shows Online')
@section('description', 'Stream and discover thousands of movies and TV shows online. Watch your favorite content anytime, anywhere.')

@section('content')
<!-- Hero Section with Search -->
<section class="relative min-h-screen flex items-center justify-center overflow-hidden">
    <!-- Background Video/Image -->
    <div class="absolute inset-0 bg-gradient-to-r from-black via-black/80 to-black/50 z-10"></div>
    <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-black/40 z-10"></div>
    
    <!-- Hero Background -->
    <div class="absolute inset-0">
        <img src="{{ asset('images/cinema.jpg') }}" 
             alt="Cinema Background" 
             class="w-full h-full object-cover opacity-30">
    </div>
    
    <!-- Hero Content -->
    <div class="relative z-20 container mx-auto px-4 text-center">
        <div class="max-w-4xl mx-auto">


            <!--<p>todo: walang laman yung anime, di rin makapag search at need i optimize yung landing page kasi napakahaba</p>-->

            
            <h1 class="text-5xl md:text-7xl font-bold text-white mb-6 leading-tight">
                Unlimited movies, TV shows, and more
            </h1>
            
            <p class="text-xl md:text-2xl text-gray-300 mb-12 max-w-2xl mx-auto leading-relaxed">
                Watch anywhere. Cancel anytime.
            </p>
            
            <!-- Large Search Bar -->
            <div class="max-w-2xl mx-auto mb-8">
                <div class="relative">
                    <input type="text" 
                           id="heroSearch"
                           placeholder="Search for movies, TV shows..." 
                           class="w-full bg-white/10 backdrop-blur-md border border-white/20 text-white placeholder-gray-300 rounded-lg px-6 py-4 text-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:bg-white/20 transition-all duration-300">
                    <button class="absolute right-2 top-1/2 transform -translate-y-1/2 bg-red-600 hover:bg-red-700 text-white px-6 py-2 rounded-md transition-colors duration-200">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
            
            <p class="text-gray-400 text-lg mb-8">
                Ready to watch? Start searching for your favorite content.
            </p>
            
            <!-- Quick Actions -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                <button onclick="loadMovies()" class="bg-white text-black font-semibold px-8 py-3 rounded-lg text-lg transition-all duration-300 hover:bg-gray-200">
                    <i class="fas fa-play mr-2"></i>
                    Browse Movies
                </button>
                
                <button onclick="loadTVShows()" class="border-2 border-white/30 hover:border-white text-white font-semibold px-8 py-3 rounded-lg text-lg transition-all duration-300 hover:bg-white/10 backdrop-blur-sm">
                    <i class="fas fa-tv mr-2"></i>
                    TV Shows
                </button>
            </div>
        </div>
    </div>
</section>

<!-- Trending Section -->
<section class="py-16 bg-black">
    <div class="container mx-auto px-4">
        <div class="mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">
                Trending Now
            </h2>
            <p class="text-gray-400 text-lg">
                Popular movies and TV shows everyone's watching
            </p>
        </div>
        
        <!-- Featured Movies Grid -->
        <div id="trending-movies" class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4 md:gap-6">
            <!-- Movies will be loaded here dynamically -->
        </div>
        
        <div class="text-center mt-12">
            <a href="#" class="inline-flex items-center text-red-500 hover:text-red-400 font-semibold text-lg transition-colors duration-200">
                See All Movies
                <i class="fas fa-arrow-right ml-2"></i>
            </a>
        </div>
    </div>
</section>

<!-- Categories Section -->
<section class="py-16 bg-gray-950">
    <div class="container mx-auto px-4">
        <div class="mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">
                Popular on iNeedCinema
            </h2>
        </div>
        
        <!-- More Movies Grid -->
        <div id="popular-movies" class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4 md:gap-6">
            <!-- Popular movies will be loaded here dynamically -->
        </div>
    </div>
</section>

<!-- TV Shows Section -->
<section class="py-16 bg-black">
    <div class="container mx-auto px-4">
        <div class="mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">
                Popular TV Shows
            </h2>
        </div>
        
        <!-- TV Shows Grid -->
        <div id="popular-tv" class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4 md:gap-6">
            <!-- Popular TV shows will be loaded here dynamically -->
        </div>
    </div>
</section>

<!-- Anime Section -->
<section class="py-16 bg-gray-950">
    <div class="container mx-auto px-4">
        <div class="mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">
                Popular Anime
            </h2>
        </div>
        
        <!-- Anime Grid -->
        <div id="popular-anime" class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4 md:gap-6">
            <!-- Popular anime will be loaded here dynamically -->
        </div>
    </div>
</section>

<!-- Latest Movies Section -->
<section class="py-16 bg-gray-950">
    <div class="container mx-auto px-4">
        <div class="mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">
                Latest Releases
            </h2>
        </div>
        
        <!-- Latest Movies Grid -->
        <div id="latest-movies" class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4 md:gap-6">
            <!-- Latest movies will be loaded here dynamically -->
        </div>
    </div>
</section>

<!-- Action Movies Section -->
<section class="py-16 bg-black">
    <div class="container mx-auto px-4">
        <div class="mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">
                Action Movies
            </h2>
        </div>
        
        <!-- Action Movies Grid -->
        <div id="action-movies" class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4 md:gap-6">
            <!-- Action movies will be loaded here dynamically -->
        </div>
    </div>
</section>

<!-- Comedy Movies Section -->
<section class="py-16 bg-gray-950">
    <div class="container mx-auto px-4">
        <div class="mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">
                Comedy Movies
            </h2>
        </div>
        
        <!-- Comedy Movies Grid -->
        <div id="comedy-movies" class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4 md:gap-6">
            <!-- Comedy movies will be loaded here dynamically -->
        </div>
    </div>
</section>

<!-- Horror Movies Section -->
<section class="py-16 bg-black">
    <div class="container mx-auto px-4">
        <div class="mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">
                Horror Movies
            </h2>
        </div>
        
        <!-- Horror Movies Grid -->
        <div id="horror-movies" class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4 md:gap-6">
            <!-- Horror movies will be loaded here dynamically -->
        </div>
    </div>
</section>

<!-- Sci-Fi Movies Section -->
<section class="py-16 bg-gray-950">
    <div class="container mx-auto px-4">
        <div class="mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">
                Sci-Fi Movies
            </h2>
        </div>
        
        <!-- Sci-Fi Movies Grid -->
        <div id="scifi-movies" class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4 md:gap-6">
            <!-- Sci-Fi movies will be loaded here dynamically -->
        </div>
    </div>
</section>

<!-- Romance Movies Section -->
<section class="py-16 bg-black">
    <div class="container mx-auto px-4">
        <div class="mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">
                Romance Movies
            </h2>
        </div>
        
        <!-- Romance Movies Grid -->
        <div id="romance-movies" class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4 md:gap-6">
            <!-- Romance movies will be loaded here dynamically -->
        </div>
    </div>
</section>

<!-- Animation Movies Section -->
<section class="py-16 bg-gray-950">
    <div class="container mx-auto px-4">
        <div class="mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">
                Animation
            </h2>
        </div>
        
        <!-- Animation Movies Grid -->
        <div id="animation-movies" class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4 md:gap-6">
            <!-- Animation movies will be loaded here dynamically -->
        </div>
    </div>
</section>

<!-- Documentary Section -->
<section class="py-16 bg-black">
    <div class="container mx-auto px-4">
        <div class="mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">
                Documentaries
            </h2>
        </div>
        
        <!-- Documentary Grid -->
        <div id="documentary-movies" class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4 md:gap-6">
            <!-- Documentary movies will be loaded here dynamically -->
        </div>
    </div>
</section>

<!-- Family Movies Section -->
<section class="py-16 bg-gray-950">
    <div class="container mx-auto px-4">
        <div class="mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">
                Family Movies
            </h2>
        </div>
        
        <!-- Family Movies Grid -->
        <div id="family-movies" class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4 md:gap-6">
            <!-- Family movies will be loaded here dynamically -->
        </div>
    </div>
</section>

<!-- Thriller Movies Section -->
<section class="py-16 bg-black">
    <div class="container mx-auto px-4">
        <div class="mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">
                Thriller Movies
            </h2>
        </div>
        
        <!-- Thriller Movies Grid -->
        <div id="thriller-movies" class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4 md:gap-6">
            <!-- Thriller movies will be loaded here dynamically -->
        </div>
    </div>
</section>

<!-- Drama Movies Section -->
<section class="py-16 bg-gray-950">
    <div class="container mx-auto px-4">
        <div class="mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">
                Drama Movies
            </h2>
        </div>
        
        <!-- Drama Movies Grid -->
        <div id="drama-movies" class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4 md:gap-6">
            <!-- Drama movies will be loaded here dynamically -->
        </div>
    </div>
</section>

<!-- Mystery Movies Section -->
<section class="py-16 bg-black">
    <div class="container mx-auto px-4">
        <div class="mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">
                Mystery Movies
            </h2>
        </div>
        
        <!-- Mystery Movies Grid -->
        <div id="mystery-movies" class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4 md:gap-6">
            <!-- Mystery movies will be loaded here dynamically -->
        </div>
    </div>
</section>

<!-- Crime Movies Section -->
<section class="py-16 bg-gray-950">
    <div class="container mx-auto px-4">
        <div class="mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">
                Crime Movies
            </h2>
        </div>
        
        <!-- Crime Movies Grid -->
        <div id="crime-movies" class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4 md:gap-6">
            <!-- Crime movies will be loaded here dynamically -->
        </div>
    </div>
</section>

<!-- War Movies Section -->
<section class="py-16 bg-black">
    <div class="container mx-auto px-4">
        <div class="mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">
                War Movies
            </h2>
        </div>
        
        <!-- War Movies Grid -->
        <div id="war-movies" class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4 md:gap-6">
            <!-- War movies will be loaded here dynamically -->
        </div>
    </div>
</section>

<!-- Music Movies Section -->
<section class="py-16 bg-gray-950">
    <div class="container mx-auto px-4">
        <div class="mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">
                Music Movies
            </h2>
        </div>
        
        <!-- Music Movies Grid -->
        <div id="music-movies" class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4 md:gap-6">
            <!-- Music movies will be loaded here dynamically -->
        </div>
    </div>
</section>

<!-- History Movies Section -->
<section class="py-16 bg-black">
    <div class="container mx-auto px-4">
        <div class="mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">
                History Movies
            </h2>
        </div>
        
        <!-- History Movies Grid -->
        <div id="history-movies" class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4 md:gap-6">
            <!-- History movies will be loaded here dynamically -->
        </div>
    </div>
</section>

<!-- Western Movies Section -->
<section class="py-16 bg-gray-950">
    <div class="container mx-auto px-4">
        <div class="mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">
                Western Movies
            </h2>
        </div>
        
        <!-- Western Movies Grid -->
        <div id="western-movies" class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4 md:gap-6">
            <!-- Western movies will be loaded here dynamically -->
        </div>
    </div>
</section>

<!-- Adventure Movies Section -->
<section class="py-16 bg-black">
    <div class="container mx-auto px-4">
        <div class="mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">
                Adventure Movies
            </h2>
        </div>
        
        <!-- Adventure Movies Grid -->
        <div id="adventure-movies" class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4 md:gap-6">
            <!-- Adventure movies will be loaded here dynamically -->
        </div>
    </div>
</section>

<!-- Fantasy Movies Section -->
<section class="py-16 bg-gray-950">
    <div class="container mx-auto px-4">
        <div class="mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">
                Fantasy Movies
            </h2>
        </div>
        
        <!-- Fantasy Movies Grid -->
        <div id="fantasy-movies" class="grid grid-cols-2 md:grid-cols-4 lg:gap-6">
            <!-- Fantasy movies will be loaded here dynamically -->
        </div>
    </div>
</section>

@push('scripts')
<script>
// Search functionality
document.getElementById('heroSearch').addEventListener('keypress', function(e) {
    if (e.key === 'Enter') {
        performSearch();
    }
});

document.querySelector('.bg-red-600').addEventListener('click', performSearch);

function performSearch() {
    const searchTerm = document.getElementById('heroSearch').value;
    if (searchTerm.trim()) {
        // Redirect to search results (we'll create this later)
        window.location.href = `/search?q=${encodeURIComponent(searchTerm)}`;
    }
}

// Load content functions
function loadMovies() {
    document.getElementById('trending-movies').scrollIntoView({ behavior: 'smooth' });
}

function loadTVShows() {
    // For now, scroll to popular section (we can add a TV shows section later)
    document.getElementById('popular-movies').scrollIntoView({ behavior: 'smooth' });
}

// Load trending movies on page load
document.addEventListener('DOMContentLoaded', function() {
    loadTrendingMovies();
    loadPopularMovies();
});

async function loadTrendingMovies() {
    try {
        showLoadingCards('trending-movies');
        const response = await fetch('/api/movies/trending');
        const data = await response.json();
        
        if (data.results && data.results.length > 0) {
            renderMovieGrid(data.results.slice(0, 12), 'trending-movies');
        }
    } catch (error) {
        console.error('Error loading trending movies:', error);
        showError('trending-movies', 'Failed to load trending movies');
    }
}

async function loadPopularMovies() {
    try {
        showLoadingCards('popular-movies');
        const response = await fetch('/api/movies/popular');
        const data = await response.json();
        
        if (data.results && data.results.length > 0) {
            renderMovieGrid(data.results.slice(0, 12), 'popular-movies');
        }
    } catch (error) {
        console.error('Error loading popular movies:', error);
        showError('popular-movies', 'Failed to load popular movies');
    }
}

function renderMovieGrid(movies, containerId) {
    const container = document.getElementById(containerId);
    if (!container) return;
    
    container.innerHTML = '';
    
    movies.forEach(movie => {
        const posterUrl = movie.poster_path 
            ? `https://image.tmdb.org/t/p/w500${movie.poster_path}`
            : '/images/placeholder-poster.jpg';
            
        const releaseYear = movie.release_date ? new Date(movie.release_date).getFullYear() : 'N/A';
        
        const movieCard = `
            <div class="group cursor-pointer transform hover:scale-105 transition-all duration-300" onclick="openMovie(${movie.id}, '${movie.title.replace(/'/g, '\\\'')}')"  >
                <div class="relative overflow-hidden rounded-lg shadow-lg">
                    <img src="${posterUrl}" 
                         alt="${movie.title}" 
                         class="w-full h-64 md:h-80 object-cover group-hover:opacity-80 transition-opacity duration-300"
                         onerror="this.src='/images/placeholder-poster.jpg'">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <div class="absolute bottom-4 left-4 right-4">
                            <h3 class="text-white font-semibold text-sm md:text-base mb-1 truncate">${movie.title}</h3>
                            <div class="flex items-center space-x-2">
                                <span class="text-yellow-400">★ ${movie.vote_average.toFixed(1)}</span>
                                <span class="text-gray-300 text-sm">${releaseYear}</span>
                            </div>
                        </div>
                        <div class="absolute top-4 right-4">
                            <button class="w-10 h-10 bg-red-600 rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transform scale-0 group-hover:scale-100 transition-all duration-300">
                                <i class="fas fa-play text-white text-sm"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        `;
        
        container.innerHTML += movieCard;
    });
}

function openMovie(movieId, movieTitle) {
    // Navigate to movie streaming page
    window.location.href = `/watch/movie/${movieId}`;
}

// Add loading placeholders
function showLoadingCards(containerId) {
    const container = document.getElementById(containerId);
    if (!container) return;
    
    container.innerHTML = '';
    
    for (let i = 0; i < 12; i++) {
        const placeholder = `
            <div class="animate-pulse">
                <div class="bg-gray-700 w-full h-64 md:h-80 rounded-lg"></div>
            </div>
        `;
        container.innerHTML += placeholder;
    }
}

// Show error message
function showError(containerId, message) {
    const container = document.getElementById(containerId);
    if (!container) return;
    
    container.innerHTML = `
        <div class="col-span-full text-center py-8">
            <p class="text-gray-400 text-lg">${message}</p>
            <button onclick="location.reload()" class="mt-4 bg-red-600 hover:bg-red-700 text-white px-6 py-2 rounded-lg transition-colors">
                Try Again
            </button>
        </div>
    `;
}
</script>
@endpush
            <div class="group cursor-pointer transform hover:scale-105 transition-all duration-300">
                <div class="relative overflow-hidden rounded-lg shadow-lg">
                    <img src="https://images.unsplash.com/photo-1536440136628-849c177e76a1?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" 
                         alt="Movie Poster" 
                         class="w-full h-64 md:h-80 object-cover group-hover:opacity-80 transition-opacity duration-300">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <div class="absolute bottom-4 left-4 right-4">
                            <h3 class="text-white font-semibold text-sm md:text-base mb-1">Sci-Fi Adventure</h3>
                            <div class="flex items-center space-x-2">
                                <span class="text-yellow-400">★ 9.1</span>
                                <span class="text-gray-300 text-sm">2024</span>
                            </div>
                        </div>
                        <div class="absolute top-4 right-4">
                            <button class="w-10 h-10 bg-red-600 rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transform scale-0 group-hover:scale-100 transition-all duration-300">
                                <i class="fas fa-play text-white text-sm"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Movie Card 3 -->
            <div class="group cursor-pointer transform hover:scale-105 transition-all duration-300">
                <div class="relative overflow-hidden rounded-lg shadow-lg">
                    <img src="https://images.unsplash.com/photo-1478720568477-b0ac8a5c9daf?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" 
                         alt="Movie Poster" 
                         class="w-full h-64 md:h-80 object-cover group-hover:opacity-80 transition-opacity duration-300">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <div class="absolute bottom-4 left-4 right-4">
                            <h3 class="text-white font-semibold text-sm md:text-base mb-1">Drama Series</h3>
                            <div class="flex items-center space-x-2">
                                <span class="text-yellow-400">★ 8.8</span>
                                <span class="text-gray-300 text-sm">2024</span>
                            </div>
                        </div>
                        <div class="absolute top-4 right-4">
                            <button class="w-10 h-10 bg-red-600 rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transform scale-0 group-hover:scale-100 transition-all duration-300">
                                <i class="fas fa-play text-white text-sm"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Movie Card 4 -->
            <div class="group cursor-pointer transform hover:scale-105 transition-all duration-300">
                <div class="relative overflow-hidden rounded-lg shadow-lg">
                    <img src="https://images.unsplash.com/photo-1440404653325-ab127d49abc1?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" 
                         alt="Movie Poster" 
                         class="w-full h-64 md:h-80 object-cover group-hover:opacity-80 transition-opacity duration-300">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <div class="absolute bottom-4 left-4 right-4">
                            <h3 class="text-white font-semibold text-sm md:text-base mb-1">Comedy Special</h3>
                            <div class="flex items-center space-x-2">
                                <span class="text-yellow-400">★ 8.3</span>
                                <span class="text-gray-300 text-sm">2024</span>
                            </div>
                        </div>
                        <div class="absolute top-4 right-4">
                            <button class="w-10 h-10 bg-red-600 rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transform scale-0 group-hover:scale-100 transition-all duration-300">
                                <i class="fas fa-play text-white text-sm"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Movie Card 5 -->
            <div class="group cursor-pointer transform hover:scale-105 transition-all duration-300">
                <div class="relative overflow-hidden rounded-lg shadow-lg">
                    <img src="https://images.unsplash.com/photo-1489599731893-47d9ed96f360?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" 
                         alt="Movie Poster" 
                         class="w-full h-64 md:h-80 object-cover group-hover:opacity-80 transition-opacity duration-300">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <div class="absolute bottom-4 left-4 right-4">
                            <h3 class="text-white font-semibold text-sm md:text-base mb-1">Horror Mystery</h3>
                            <div class="flex items-center space-x-2">
                                <span class="text-yellow-400">★ 7.9</span>
                                <span class="text-gray-300 text-sm">2024</span>
                            </div>
                        </div>
                        <div class="absolute top-4 right-4">
                            <button class="w-10 h-10 bg-red-600 rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transform scale-0 group-hover:scale-100 transition-all duration-300">
                                <i class="fas fa-play text-white text-sm"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Movie Card 6 -->
            <div class="group cursor-pointer transform hover:scale-105 transition-all duration-300">
                <div class="relative overflow-hidden rounded-lg shadow-lg">
                    <img src="https://images.unsplash.com/photo-1518676590629-3dcbd9c5a5c9?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" 
                         alt="Movie Poster" 
                         class="w-full h-64 md:h-80 object-cover group-hover:opacity-80 transition-opacity duration-300">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <div class="absolute bottom-4 left-4 right-4">
                            <h3 class="text-white font-semibold text-sm md:text-base mb-1">Documentary</h3>
                            <div class="flex items-center space-x-2">
                                <span class="text-yellow-400">★ 8.7</span>
                                <span class="text-gray-300 text-sm">2024</span>
                            </div>
                        </div>
                        <div class="absolute top-4 right-4">
                            <button class="w-10 h-10 bg-red-600 rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transform scale-0 group-hover:scale-100 transition-all duration-300">
                                <i class="fas fa-play text-white text-sm"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="text-center mt-12">
            <a href="#" class="inline-flex items-center text-red-500 hover:text-red-400 font-semibold text-lg transition-colors duration-200">
                See All Movies
                <i class="fas fa-arrow-right ml-2"></i>
            </a>
        </div>
    </div>
</section>

<!-- Categories Section -->
<section class="py-16 bg-gray-950">
    <div class="container mx-auto px-4">
        <div class="mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">
                Popular on iNeedCinema
            </h2>
        </div>
        
        <!-- More Movies Grid -->
        <div id="popular-movies" class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4 md:gap-6">
            <!-- Additional movie cards with different images -->
            <div class="group cursor-pointer transform hover:scale-105 transition-all duration-300">
                <div class="relative overflow-hidden rounded-lg shadow-lg">
                    <img src="https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" 
                         alt="Movie Poster" 
                         class="w-full h-64 md:h-80 object-cover group-hover:opacity-80 transition-opacity duration-300">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <div class="absolute top-4 right-4">
                            <button class="w-10 h-10 bg-red-600 rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transform scale-0 group-hover:scale-100 transition-all duration-300">
                                <i class="fas fa-play text-white text-sm"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="group cursor-pointer transform hover:scale-105 transition-all duration-300">
                <div class="relative overflow-hidden rounded-lg shadow-lg">
                    <img src="https://images.unsplash.com/photo-1626814026160-2237a95fc5a0?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" 
                         alt="Movie Poster" 
                         class="w-full h-64 md:h-80 object-cover group-hover:opacity-80 transition-opacity duration-300">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <div class="absolute top-4 right-4">
                            <button class="w-10 h-10 bg-red-600 rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transform scale-0 group-hover:scale-100 transition-all duration-300">
                                <i class="fas fa-play text-white text-sm"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="group cursor-pointer transform hover:scale-105 transition-all duration-300">
                <div class="relative overflow-hidden rounded-lg shadow-lg">
                    <img src="https://images.unsplash.com/photo-1518929458119-e5bf444c30f4?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" 
                         alt="Movie Poster" 
                         class="w-full h-64 md:h-80 object-cover group-hover:opacity-80 transition-opacity duration-300">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <div class="absolute top-4 right-4">
                            <button class="w-10 h-10 bg-red-600 rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transform scale-0 group-hover:scale-100 transition-all duration-300">
                                <i class="fas fa-play text-white text-sm"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="group cursor-pointer transform hover:scale-105 transition-all duration-300">
                <div class="relative overflow-hidden rounded-lg shadow-lg">
                    <img src="https://images.unsplash.com/photo-1509281373149-e957c6296406?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" 
                         alt="Movie Poster" 
                         class="w-full h-64 md:h-80 object-cover group-hover:opacity-80 transition-opacity duration-300">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <div class="absolute top-4 right-4">
                            <button class="w-10 h-10 bg-red-600 rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transform scale-0 group-hover:scale-100 transition-all duration-300">
                                <i class="fas fa-play text-white text-sm"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="group cursor-pointer transform hover:scale-105 transition-all duration-300">
                <div class="relative overflow-hidden rounded-lg shadow-lg">
                    <img src="https://images.unsplash.com/photo-1611605698335-8b1569810432?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" 
                         alt="Movie Poster" 
                         class="w-full h-64 md:h-80 object-cover group-hover:opacity-80 transition-opacity duration-300">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <div class="absolute top-4 right-4">
                            <button class="w-10 h-10 bg-red-600 rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transform scale-0 group-hover:scale-100 transition-all duration-300">
                                <i class="fas fa-play text-white text-sm"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="group cursor-pointer transform hover:scale-105 transition-all duration-300">
                <div class="relative overflow-hidden rounded-lg shadow-lg">
                    <img src="https://images.unsplash.com/photo-1574267432553-4b4628081c31?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" 
                         alt="Movie Poster" 
                         class="w-full h-64 md:h-80 object-cover group-hover:opacity-80 transition-opacity duration-300">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <div class="absolute top-4 right-4">
                            <button class="w-10 h-10 bg-red-600 rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transform scale-0 group-hover:scale-100 transition-all duration-300">
                                <i class="fas fa-play text-white text-sm"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
// Search functionality
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('heroSearch');
    const searchButton = document.querySelector('.bg-red-600');
    
    if (searchInput) {
        searchInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                performSearch();
            }
        });
    }
    
    if (searchButton) {
        searchButton.addEventListener('click', performSearch);
    }
    
    // Load all content sections
    loadMoviesData();
});

function performSearch() {
    const searchTerm = document.getElementById('heroSearch').value;
    if (searchTerm.trim()) {
        window.location.href = `/search?q=${encodeURIComponent(searchTerm)}`;
    }
}

// Main function to load all movie data
function loadMoviesData() {
    console.log('Loading movies data...');
    
    // Show loading states for all sections
    showLoadingCards('trending-movies');
    showLoadingCards('popular-movies');
    showLoadingCards('popular-tv');
    showLoadingCards('popular-anime');
    showLoadingCards('latest-movies');
    
    // Load main sections
    loadMovies('trending-movies', '/api/movies/trending');
    loadMovies('popular-movies', '/api/movies/popular');
    loadTVShows('popular-tv', '/api/tv/popular');
    loadAnime('popular-anime', '/api/anime/popular');
    loadMovies('latest-movies', '/api/movies/now_playing');
    
    // Load genre sections with small delay
    setTimeout(() => {
        showLoadingCards('action-movies');
        showLoadingCards('comedy-movies');
        showLoadingCards('horror-movies');
        showLoadingCards('scifi-movies');
        showLoadingCards('romance-movies');
        showLoadingCards('animation-movies');
        
        loadMoviesByGenre('action-movies', 28);
        loadMoviesByGenre('comedy-movies', 35);
        loadMoviesByGenre('horror-movies', 27);
        loadMoviesByGenre('scifi-movies', 878);
        loadMoviesByGenre('romance-movies', 10749);
        loadMoviesByGenre('animation-movies', 16);
    }, 1000);
    
    // Load more genres with additional delay
    setTimeout(() => {
        showLoadingCards('documentary-movies');
        showLoadingCards('family-movies');
        showLoadingCards('thriller-movies');
        showLoadingCards('drama-movies');
        
        loadMoviesByGenre('documentary-movies', 99);
        loadMoviesByGenre('family-movies', 10751);
        loadMoviesByGenre('thriller-movies', 53);
        loadMoviesByGenre('drama-movies', 18);
    }, 2000);
}

// Generic function to load movies from an API endpoint
function loadMovies(containerId, endpoint) {
    fetch(endpoint)
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            console.log(`Loaded data for ${containerId}:`, data);
            
            let movies = [];
            if (data.results && Array.isArray(data.results)) {
                movies = data.results;
            } else if (data.data && Array.isArray(data.data)) {
                movies = data.data;
            }
            
            if (movies.length > 0) {
                displayMovies(movies.slice(0, 12), containerId);
            } else {
                showError(containerId, 'No content found.');
            }
        })
        .catch(error => {
            console.error(`Error loading ${containerId}:`, error);
            showError(containerId, 'Failed to load content. Please try again.');
        });
}

// Function to load TV shows
function loadTVShows(containerId, endpoint) {
    fetch(endpoint)
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            console.log(`Loaded TV data for ${containerId}:`, data);
            
            let shows = [];
            if (data.results && Array.isArray(data.results)) {
                shows = data.results.map(show => ({
                    ...show,
                    media_type: 'tv'
                }));
            } else if (data.data && Array.isArray(data.data)) {
                shows = data.data.map(show => ({
                    ...show,
                    media_type: 'tv'
                }));
            }
            
            if (shows.length > 0) {
                displayMovies(shows.slice(0, 12), containerId);
            } else {
                showError(containerId, 'No TV shows found.');
            }
        })
        .catch(error => {
            console.error(`Error loading TV shows for ${containerId}:`, error);
            showError(containerId, 'Failed to load TV shows. Please try again.');
        });
}

// Function to load anime
function loadAnime(containerId, endpoint) {
    fetch(endpoint)
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            console.log(`Loaded anime data for ${containerId}:`, data);
            
            let anime = [];
            if (data.data && Array.isArray(data.data)) {
                anime = data.data.map(item => {
                    // Handle different API response formats
                    const posterUrl = item.images?.jpg?.image_url || item.images?.jpg?.large_image_url;
                    
                    return {
                        id: item.mal_id,
                        title: item.title,
                        poster_path: posterUrl, // Keep full URL for anime
                        vote_average: item.score || 0,
                        release_date: item.aired?.from || item.year,
                        media_type: 'anime'
                    };
                });
            }
            
            if (anime.length > 0) {
                displayMovies(anime.slice(0, 12), containerId);
            } else {
                showError(containerId, 'No anime found.');
            }
        })
        .catch(error => {
            console.error(`Error loading anime for ${containerId}:`, error);
            showError(containerId, 'Failed to load anime. Please try again.');
        });
}

// Function to load movies by genre
function loadMoviesByGenre(containerId, genreId) {
    fetch(`/api/movies/genre/${genreId}`)
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            console.log(`Loaded genre data for ${containerId}:`, data);
            
            if (data.success && data.data && data.data.length > 0) {
                displayMovies(data.data.slice(0, 12), containerId);
            } else {
                showError(containerId, 'No movies found for this genre.');
            }
        })
        .catch(error => {
            console.error(`Error loading genre ${genreId}:`, error);
            showError(containerId, 'Failed to load movies. Please try again.');
        });
}

// Display movies in a grid
function displayMovies(movies, containerId) {
    const container = document.getElementById(containerId);
    if (!container) {
        console.error(`Container ${containerId} not found`);
        return;
    }
    
    container.innerHTML = '';
    
    movies.forEach(movie => {
        // Determine media type first
        const mediaType = getMediaType(movie);
        
        // Handle different poster sources
        let posterUrl;
        if (mediaType === 'anime' && movie.poster_path && movie.poster_path.startsWith('http')) {
            // Anime posters are full URLs from MyAnimeList
            posterUrl = movie.poster_path;
        } else if (movie.poster_path) {
            // TMDB posters need the base URL
            posterUrl = `https://image.tmdb.org/t/p/w500${movie.poster_path}`;
        } else {
            posterUrl = 'https://via.placeholder.com/300x450/374151/9CA3AF?text=No+Poster';
        }
            
        const releaseYear = movie.release_date 
            ? new Date(movie.release_date).getFullYear() 
            : (movie.first_air_date ? new Date(movie.first_air_date).getFullYear() : 'N/A');
            
        const title = movie.title || movie.name || 'Unknown Title';
        const rating = movie.vote_average ? movie.vote_average.toFixed(1) : 'N/A';
        
        const movieCard = `
            <div class="group cursor-pointer transform hover:scale-105 transition-all duration-300" onclick="openContent(${movie.id}, '${title.replace(/'/g, '\\\'').replace(/"/g, '&quot;')}', '${mediaType}')"  >
                <div class="relative overflow-hidden rounded-lg shadow-lg">
                    <img src="${posterUrl}" 
                         alt="${title}" 
                         class="w-full h-64 md:h-80 object-cover group-hover:opacity-80 transition-opacity duration-300"
                         onerror="this.src='https://via.placeholder.com/300x450/374151/9CA3AF?text=No+Poster'">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <div class="absolute bottom-4 left-4 right-4">
                            <h3 class="text-white font-semibold text-sm md:text-base mb-1 truncate">${title}</h3>
                            <div class="flex items-center space-x-2">
                                <span class="text-yellow-400">★ ${rating}</span>
                                <span class="text-gray-300 text-sm">${releaseYear}</span>
                                ${getMediaTypeBadge(mediaType)}
                            </div>
                        </div>
                        <div class="absolute top-4 right-4">
                            <button class="w-10 h-10 bg-red-600 rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transform scale-0 group-hover:scale-100 transition-all duration-300">
                                <i class="fas fa-play text-white text-sm"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        `;
        
        container.innerHTML += movieCard;
    });
}

// Determine media type based on item properties
function getMediaType(item) {
    // Check if it's from a specific endpoint first
    if (item.media_type) {
        if (item.media_type === 'movie') return 'movie';
        if (item.media_type === 'tv') return 'tv';
        if (item.media_type === 'anime') return 'anime';
    }
    
    // Check for anime characteristics (this is heuristic-based)
    if (item.genres) {
        const genreNames = item.genres.map(g => g.name ? g.name.toLowerCase() : '');
        if (genreNames.includes('animation') && (genreNames.includes('family') || item.origin_country?.includes('JP'))) {
            return 'anime';
        }
    }
    
    // Check if it has TV show characteristics
    if (item.first_air_date || item.name || item.number_of_seasons) {
        return 'tv';
    }
    
    // Check if it has movie characteristics  
    if (item.release_date || item.title || item.runtime) {
        return 'movie';
    }
    
    // Default to movie if unclear
    return 'movie';
}

// Get badge for media type
function getMediaTypeBadge(mediaType) {
    switch(mediaType) {
        case 'tv':
            return '<span class="text-xs bg-blue-600 px-2 py-1 rounded">TV</span>';
        case 'anime':
            return '<span class="text-xs bg-purple-600 px-2 py-1 rounded">ANIME</span>';
        case 'movie':
        default:
            return '<span class="text-xs bg-green-600 px-2 py-1 rounded">MOVIE</span>';
    }
}

function openContent(contentId, contentTitle, mediaType) {
    console.log(`Opening ${mediaType}: ${contentId} - ${contentTitle}`);
    
    switch(mediaType) {
        case 'movie':
            window.location.href = `/watch/movie/${contentId}`;
            break;
        case 'tv':
            window.location.href = `/watch/tv/${contentId}/1/1`;
            break;
        case 'anime':
            window.location.href = `/watch/anime/${contentId}?episode=1&type=sub`;
            break;
        default:
            // Default to movie if uncertain
            window.location.href = `/watch/movie/${contentId}`;
            break;
    }
}

// Legacy function for backwards compatibility
function openMovie(movieId, movieTitle) {
    openContent(movieId, movieTitle, 'movie');
}

// Show loading placeholders
function showLoadingCards(containerId) {
    const container = document.getElementById(containerId);
    if (!container) return;
    
    container.innerHTML = '';
    
    for (let i = 0; i < 12; i++) {
        const placeholder = `
            <div class="animate-pulse">
                <div class="bg-gray-700 w-full h-64 md:h-80 rounded-lg"></div>
            </div>
        `;
        container.innerHTML += placeholder;
    }
}

// Show error message
function showError(containerId, message) {
    const container = document.getElementById(containerId);
    if (!container) return;
    
    container.innerHTML = `
        <div class="col-span-full text-center py-8">
            <p class="text-gray-400 text-lg">${message}</p>
            <button onclick="location.reload()" class="mt-4 bg-red-600 hover:bg-red-700 text-white px-6 py-2 rounded-lg transition-colors">
                Try Again
            </button>
        </div>
    `;
}
</script>
@endpush
