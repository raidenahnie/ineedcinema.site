@extends('layouts.app')

@section('title', 'iNeedCinema - Stream Movies, TV Shows & Anime')
@section('description', 'Your ultimate streaming destination. Discover and watch thousands of movies, TV shows, and anime series.')

@section('content')
<!-- Hero Section -->
<section class="relative h-screen flex items-center justify-center overflow-hidden">
    <!-- Animated Background Gradient -->
    <div class="absolute inset-0 bg-gradient-to-br from-gray-900 via-black to-red-950 animate-gradient"></div>
    
    <!-- Floating Particles Effect -->
    <div class="absolute inset-0 opacity-20">
        <div class="absolute top-20 left-20 w-72 h-72 bg-red-500 rounded-full mix-blend-multiply filter blur-3xl animate-blob"></div>
        <div class="absolute top-40 right-20 w-72 h-72 bg-orange-500 rounded-full mix-blend-multiply filter blur-3xl animate-blob animation-delay-2000"></div>
        <div class="absolute bottom-20 left-40 w-72 h-72 bg-pink-500 rounded-full mix-blend-multiply filter blur-3xl animate-blob animation-delay-4000"></div>
    </div>
    
    <!-- Hero Content -->
    <div class="relative z-10 container mx-auto px-4 text-center">
        <div class="max-w-4xl mx-auto space-y-8">
            <!-- Badge -->
            <div class="inline-flex items-center px-4 py-2 bg-red-500/10 border border-red-500/20 rounded-full backdrop-blur-sm">
                <span class="w-2 h-2 bg-red-500 rounded-full animate-pulse mr-2"></span>
                <span class="text-red-400 text-sm font-medium">Unlimited Streaming</span>
            </div>
            
            <!-- Main Heading -->
            <h1 class="text-5xl md:text-7xl lg:text-8xl font-bold text-white leading-tight">
                Watch <span class="bg-gradient-to-r from-red-500 via-orange-500 to-pink-500 bg-clip-text text-transparent">Everything</span>
            </h1>
            
            <p class="text-xl md:text-2xl text-gray-300 max-w-2xl mx-auto leading-relaxed">
                Stream unlimited movies, TV shows, and anime. Your next favorite is waiting.
            </p>
            
            <!-- CTA Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center pt-8">
                <a href="{{ route('movies') }}" class="group relative inline-flex items-center justify-center px-8 py-4 bg-gradient-to-r from-red-600 to-red-500 text-white font-semibold rounded-xl overflow-hidden transition-all duration-300 hover:shadow-2xl hover:shadow-red-500/50 hover:scale-105">
                    <span class="relative z-10 flex items-center">
                        <i class="fas fa-play mr-2"></i>
                        Start Watching
                    </span>
                    <div class="absolute inset-0 bg-gradient-to-r from-red-500 to-orange-500 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                </a>
                
                <a href="{{ route('search') }}" class="inline-flex items-center px-8 py-4 border-2 border-white/20 hover:border-white/40 text-white font-semibold rounded-xl backdrop-blur-sm hover:bg-white/5 transition-all duration-300">
                    <i class="fas fa-search mr-2"></i>
                    Browse Library
                </a>
            </div>
            
            <!-- Stats -->
            <div class="grid grid-cols-3 gap-8 pt-16 max-w-2xl mx-auto">
                <div class="space-y-2">
                    <div class="text-3xl md:text-4xl font-bold text-white">10K+</div>
                    <div class="text-sm text-gray-400">Movies</div>
                </div>
                <div class="space-y-2">
                    <div class="text-3xl md:text-4xl font-bold text-white">5K+</div>
                    <div class="text-sm text-gray-400">TV Shows</div>
                </div>
                <div class="space-y-2">
                    <div class="text-3xl md:text-4xl font-bold text-white">∞</div>
                    <div class="text-sm text-gray-400">Entertainment</div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Scroll Indicator -->
    <div class="absolute bottom-8 left-1/2 -translate-x-1/2 z-10 animate-bounce">
        <i class="fas fa-chevron-down text-white/50 text-2xl"></i>
    </div>
</section>

<!-- Trending Section -->
<section class="py-20 bg-black">
    <div class="container mx-auto px-4">
        <!-- Section Header -->
        <div class="flex items-center justify-between mb-8">
            <div>
                <h2 class="text-3xl md:text-4xl font-bold text-white mb-2">
                    🔥 Trending Now
                </h2>
                <p class="text-gray-400">What everyone's watching this week</p>
            </div>
            <a href="{{ route('movies') }}" class="hidden md:inline-flex items-center text-red-500 hover:text-red-400 font-medium transition-colors group">
                View All
                <i class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform"></i>
            </a>
        </div>
        
        <!-- Trending Grid -->
        <div id="trending-content" class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-4 md:gap-6">
            <!-- Loading Placeholders -->
            @for($i = 0; $i < 6; $i++)
                <div class="animate-pulse">
                    <div class="aspect-[2/3] bg-gray-800 rounded-lg mb-3"></div>
                    <div class="h-4 bg-gray-800 rounded mb-2"></div>
                    <div class="h-3 bg-gray-800 rounded w-2/3"></div>
                </div>
            @endfor
        </div>
    </div>
</section>

<!-- Categories Section -->
<section class="py-20 bg-gradient-to-b from-black to-gray-950">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">
                Explore by Category
            </h2>
            <p class="text-gray-400">Find your next favorite from our curated collections</p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Movies Card -->
            <a href="{{ route('movies') }}" class="group relative overflow-hidden rounded-2xl bg-gradient-to-br from-blue-600/20 to-blue-900/20 border border-blue-500/20 hover:border-blue-500/40 p-8 transition-all duration-300 hover:scale-105 hover:shadow-2xl hover:shadow-blue-500/20">
                <div class="relative z-10">
                    <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                        <i class="fas fa-film text-white text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-white mb-2">Movies</h3>
                    <p class="text-gray-400 mb-4">Discover thousands of movies across all genres</p>
                    <div class="flex items-center text-blue-400 font-medium">
                        Explore Movies
                        <i class="fas fa-arrow-right ml-2 group-hover:translate-x-2 transition-transform"></i>
                    </div>
                </div>
                <div class="absolute inset-0 bg-gradient-to-br from-blue-600/0 to-blue-600/10 opacity-0 group-hover:opacity-100 transition-opacity"></div>
            </a>
            
            <!-- TV Shows Card -->
            <a href="{{ route('tv-shows') }}" class="group relative overflow-hidden rounded-2xl bg-gradient-to-br from-purple-600/20 to-purple-900/20 border border-purple-500/20 hover:border-purple-500/40 p-8 transition-all duration-300 hover:scale-105 hover:shadow-2xl hover:shadow-purple-500/20">
                <div class="relative z-10">
                    <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                        <i class="fas fa-tv text-white text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-white mb-2">TV Shows</h3>
                    <p class="text-gray-400 mb-4">Binge-watch your favorite series and find new ones</p>
                    <div class="flex items-center text-purple-400 font-medium">
                        Explore TV Shows
                        <i class="fas fa-arrow-right ml-2 group-hover:translate-x-2 transition-transform"></i>
                    </div>
                </div>
                <div class="absolute inset-0 bg-gradient-to-br from-purple-600/0 to-purple-600/10 opacity-0 group-hover:opacity-100 transition-opacity"></div>
            </a>
            
            <!-- Anime Card -->
            <a href="{{ route('anime') }}" class="group relative overflow-hidden rounded-2xl bg-gradient-to-br from-red-600/20 to-red-900/20 border border-red-500/20 hover:border-red-500/40 p-8 transition-all duration-300 hover:scale-105 hover:shadow-2xl hover:shadow-red-500/20">
                <div class="relative z-10">
                    <div class="w-16 h-16 bg-gradient-to-br from-red-500 to-red-600 rounded-2xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                        <i class="fas fa-dragon text-white text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-white mb-2">Anime</h3>
                    <p class="text-gray-400 mb-4">Stream the latest and classic anime series</p>
                    <div class="flex items-center text-red-400 font-medium">
                        Explore Anime
                        <i class="fas fa-arrow-right ml-2 group-hover:translate-x-2 transition-transform"></i>
                    </div>
                </div>
                <div class="absolute inset-0 bg-gradient-to-br from-red-600/0 to-red-600/10 opacity-0 group-hover:opacity-100 transition-opacity"></div>
            </a>
        </div>
    </div>
</section>

<!-- Features Section -->
<section class="py-20 bg-gray-950">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">
                Why Choose iNeedCinema?
            </h2>
            <p class="text-gray-400 max-w-2xl mx-auto">
                The ultimate streaming experience with features designed for entertainment lovers
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <div class="text-center space-y-4">
                <div class="w-16 h-16 bg-gradient-to-br from-red-500 to-red-600 rounded-2xl flex items-center justify-center mx-auto">
                    <i class="fas fa-infinity text-white text-2xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-white">Unlimited Access</h3>
                <p class="text-gray-400">Stream as much as you want, whenever you want</p>
            </div>
            
            <div class="text-center space-y-4">
                <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center mx-auto">
                    <i class="fas fa-hd text-white text-2xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-white">HD Quality</h3>
                <p class="text-gray-400">Watch in stunning high definition quality</p>
            </div>
            
            <div class="text-center space-y-4">
                <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl flex items-center justify-center mx-auto">
                    <i class="fas fa-mobile-alt text-white text-2xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-white">Any Device</h3>
                <p class="text-gray-400">Watch on your phone, tablet, or computer</p>
            </div>
            
            <div class="text-center space-y-4">
                <div class="w-16 h-16 bg-gradient-to-br from-green-500 to-green-600 rounded-2xl flex items-center justify-center mx-auto">
                    <i class="fas fa-bolt text-white text-2xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-white">Fast Streaming</h3>
                <p class="text-gray-400">Lightning-fast loading with no buffering</p>
            </div>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-20 bg-gradient-to-r from-red-900/20 via-red-600/20 to-orange-900/20">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto text-center space-y-8">
            <h2 class="text-4xl md:text-5xl font-bold text-white">
                Ready to start watching?
            </h2>
            <p class="text-xl text-gray-300">
                Join thousands of users streaming their favorite content
            </p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="{{ route('movies') }}" class="inline-flex items-center justify-center px-8 py-4 bg-gradient-to-r from-red-600 to-red-500 text-white font-semibold rounded-xl hover:shadow-2xl hover:shadow-red-500/50 hover:scale-105 transition-all duration-300">
                    <i class="fas fa-play mr-2"></i>
                    Get Started
                </a>
                <a href="{{ route('search') }}" class="inline-flex items-center justify-center px-8 py-4 border-2 border-white/20 hover:border-white/40 text-white font-semibold rounded-xl backdrop-blur-sm hover:bg-white/5 transition-all duration-300">
                    <i class="fas fa-search mr-2"></i>
                    Browse Content
                </a>
            </div>
        </div>
    </div>
</section>

@push('styles')
<style>
    @keyframes gradient {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }
    
    .animate-gradient {
        background-size: 200% 200%;
        animation: gradient 15s ease infinite;
    }
    
    @keyframes blob {
        0%, 100% { transform: translate(0, 0) scale(1); }
        25% { transform: translate(20px, -50px) scale(1.1); }
        50% { transform: translate(-20px, 20px) scale(0.9); }
        75% { transform: translate(50px, 50px) scale(1.05); }
    }
    
    .animate-blob {
        animation: blob 7s infinite;
    }
    
    .animation-delay-2000 {
        animation-delay: 2s;
    }
    
    .animation-delay-4000 {
        animation-delay: 4s;
    }
</style>
@endpush

@push('scripts')
<script>
// Load trending content
async function loadTrendingContent() {
    try {
        const response = await fetch('/api/movies/popular?page=1');
        const data = await response.json();
        
        const container = document.getElementById('trending-content');
        if (!container) return;
        
        const movies = data.results.slice(0, 12);
        
        container.innerHTML = movies.map(movie => {
            const poster = movie.poster_path 
                ? `https://image.tmdb.org/t/p/w500${movie.poster_path}`
                : '/images/placeholder-poster.jpg';
            const rating = movie.vote_average ? movie.vote_average.toFixed(1) : 'N/A';
            const year = movie.release_date ? new Date(movie.release_date).getFullYear() : '';
            
            return `
                <a href="/watch/movie/${movie.id}" class="group block">
                    <div class="relative aspect-[2/3] overflow-hidden rounded-lg shadow-lg transition-all duration-300 group-hover:scale-105 group-hover:shadow-2xl group-hover:shadow-red-500/20">
                        <img src="${poster}" 
                             alt="${movie.title}" 
                             class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <div class="absolute bottom-0 left-0 right-0 p-4">
                                <div class="flex items-center gap-2 mb-2">
                                    <span class="bg-red-600 px-2 py-1 rounded text-xs font-semibold">
                                        <i class="fas fa-star mr-1"></i>${rating}
                                    </span>
                                    <span class="text-xs text-gray-300">${year}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <h3 class="mt-3 font-semibold text-white truncate group-hover:text-red-500 transition-colors">
                        ${movie.title}
                    </h3>
                    <p class="text-sm text-gray-400">${year}</p>
                </a>
            `;
        }).join('');
    } catch (error) {
        console.error('Error loading trending content:', error);
    }
}

// Load content when page loads
document.addEventListener('DOMContentLoaded', loadTrendingContent);
</script>
@endpush
@endsection
