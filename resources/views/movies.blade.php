@extends('layouts.app')

@section('title', 'Movies - iNeedCinema')
@section('description', 'Browse and discover thousands of movies. From blockbusters to indie films, find your next favorite movie.')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-4xl font-bold text-white mb-4">Movies</h1>
        <p class="text-gray-400 text-lg">Discover thousands of movies from every genre and decade</p>
    </div>
    
    <!-- Filter and Sort Options -->
    <div class="mb-8 bg-gray-800 rounded-lg p-6">
        <div class="flex flex-wrap gap-4 items-center justify-between">
            <div class="flex flex-wrap gap-4 items-center">
                <!-- Genre Filter -->
                <div class="relative">
                    <select id="genreFilter" class="bg-gray-700 text-white border border-gray-600 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-red-500">
                        <option value="">All Genres</option>
                        <!-- Genres will be loaded dynamically -->
                    </select>
                </div>
                
                <!-- Year Filter -->
                <div class="relative">
                    <select id="yearFilter" class="bg-gray-700 text-white border border-gray-600 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-red-500">
                        <option value="">All Years</option>
                        <option value="2024">2024</option>
                        <option value="2023">2023</option>
                        <option value="2022">2022</option>
                        <option value="2021">2021</option>
                        <option value="2020">2020</option>
                        <!-- More years can be added -->
                    </select>
                </div>
                
                <!-- Rating Filter -->
                <div class="relative">
                    <select id="ratingFilter" class="bg-gray-700 text-white border border-gray-600 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-red-500">
                        <option value="">All Ratings</option>
                        <option value="8">8.0+ Rating</option>
                        <option value="7">7.0+ Rating</option>
                        <option value="6">6.0+ Rating</option>
                        <option value="5">5.0+ Rating</option>
                    </select>
                </div>
            </div>
            
            <!-- Sort Options -->
            <div class="flex gap-4 items-center">
                <label class="text-gray-400">Sort by:</label>
                <select id="sortFilter" class="bg-gray-700 text-white border border-gray-600 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-red-500">
                    <option value="popularity.desc">Most Popular</option>
                    <option value="release_date.desc">Latest Release</option>
                    <option value="vote_average.desc">Highest Rated</option>
                    <option value="title.asc">A-Z</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Popular Movies Section -->
    <section class="mb-12">
        <h2 class="text-2xl font-bold text-white mb-6">Popular Movies</h2>
        <div id="popular-movies" class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-6">
            <!-- Movies will be loaded here -->
        </div>
    </section>

    <!-- Now Playing Section -->
    <section class="mb-12">
        <h2 class="text-2xl font-bold text-white mb-6">Now Playing</h2>
        <div id="now-playing-movies" class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-6">
            <!-- Movies will be loaded here -->
        </div>
    </section>

    <!-- Top Rated Section -->
    <section class="mb-12">
        <h2 class="text-2xl font-bold text-white mb-6">Top Rated Movies</h2>
        <div id="top-rated-movies" class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-6">
            <!-- Movies will be loaded here -->
        </div>
    </section>

    <!-- Genre-based Sections -->
    <section class="mb-12">
        <h2 class="text-2xl font-bold text-white mb-6">Action Movies</h2>
        <div id="action-movies" class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-6">
            <!-- Movies will be loaded here -->
        </div>
    </section>

    <section class="mb-12">
        <h2 class="text-2xl font-bold text-white mb-6">Comedy Movies</h2>
        <div id="comedy-movies" class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-6">
            <!-- Movies will be loaded here -->
        </div>
    </section>

    <section class="mb-12">
        <h2 class="text-2xl font-bold text-white mb-6">Horror Movies</h2>
        <div id="horror-movies" class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-6">
            <!-- Movies will be loaded here -->
        </div>
    </section>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    loadGenres();
    loadMoviesSections();
    
    // Add event listeners for filters
    document.getElementById('genreFilter').addEventListener('change', applyFilters);
    document.getElementById('yearFilter').addEventListener('change', applyFilters);
    document.getElementById('ratingFilter').addEventListener('change', applyFilters);
    document.getElementById('sortFilter').addEventListener('change', applyFilters);
});

async function loadGenres() {
    try {
        const response = await fetch('/api/movies/genres');
        const data = await response.json();
        
        const genreSelect = document.getElementById('genreFilter');
        if (data.genres) {
            data.genres.forEach(genre => {
                const option = document.createElement('option');
                option.value = genre.id;
                option.textContent = genre.name;
                genreSelect.appendChild(option);
            });
        }
    } catch (error) {
        console.error('Error loading genres:', error);
    }
}

async function loadMoviesSections() {
    // Show loading placeholders
    showLoadingCards('popular-movies');
    showLoadingCards('now-playing-movies');
    showLoadingCards('top-rated-movies');
    showLoadingCards('action-movies');
    showLoadingCards('comedy-movies');
    showLoadingCards('horror-movies');
    
    // Load different sections
    loadMovies('popular-movies', '/api/movies/popular');
    loadMovies('now-playing-movies', '/api/movies/now_playing');
    loadMovies('top-rated-movies', '/api/movies/popular?sort_by=vote_average.desc');
    loadMoviesByGenre('action-movies', 28); // Action
    loadMoviesByGenre('comedy-movies', 35); // Comedy
    loadMoviesByGenre('horror-movies', 27); // Horror
}

async function loadMovies(containerId, endpoint) {
    try {
        const response = await fetch(endpoint);
        const data = await response.json();
        
        if (data.results && data.results.length > 0) {
            displayMovies(data.results.slice(0, 12), containerId);
        } else if (data.data && data.data.length > 0) {
            displayMovies(data.data.slice(0, 12), containerId);
        } else {
            showError(containerId, 'No movies found.');
        }
    } catch (error) {
        console.error(`Error loading movies for ${containerId}:`, error);
        showError(containerId, 'Failed to load movies. Please try again.');
    }
}

async function loadMoviesByGenre(containerId, genreId) {
    try {
        const response = await fetch(`/api/movies/genre/${genreId}`);
        const data = await response.json();
        
        if (data.success && data.data && data.data.length > 0) {
            displayMovies(data.data.slice(0, 12), containerId);
        } else {
            showError(containerId, 'No movies found for this genre.');
        }
    } catch (error) {
        console.error(`Error loading genre ${genreId}:`, error);
        showError(containerId, 'Failed to load movies. Please try again.');
    }
}

function displayMovies(movies, containerId) {
    const container = document.getElementById(containerId);
    if (!container) return;
    
    container.innerHTML = '';
    
    movies.forEach(movie => {
        const posterUrl = movie.poster_path 
            ? `https://image.tmdb.org/t/p/w500${movie.poster_path}`
            : 'https://via.placeholder.com/300x450/374151/9CA3AF?text=No+Poster';
            
        const releaseYear = movie.release_date ? new Date(movie.release_date).getFullYear() : 'N/A';
        const title = movie.title || 'Unknown Title';
        const rating = movie.vote_average ? movie.vote_average.toFixed(1) : 'N/A';
        
        const movieCard = `
            <div class="group cursor-pointer transform hover:scale-105 transition-all duration-300" onclick="openMovie(${movie.id}, '${title.replace(/'/g, '\\\'').replace(/"/g, '&quot;')}')">
                <div class="relative overflow-hidden rounded-lg shadow-lg">
                    <img src="${posterUrl}" 
                         alt="${title}" 
                         class="w-full h-64 md:h-80 object-cover group-hover:opacity-80 transition-opacity duration-300"
                         onerror="this.src='https://via.placeholder.com/300x450/374151/9CA3AF?text=No+Poster'">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <div class="absolute bottom-4 left-4 right-4">
                            <h3 class="text-white font-semibold text-sm md:text-base mb-1 truncate">${title}</h3>
                            <div class="flex items-center justify-between">
                                <span class="text-yellow-400">★ ${rating}</span>
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
    window.location.href = `/watch/movie/${movieId}`;
}

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

function applyFilters() {
    // This function will be implemented to filter movies based on selected criteria
    console.log('Applying filters...');
    // For now, just reload the sections
    loadMoviesSections();
}
</script>
@endpush
@endsection