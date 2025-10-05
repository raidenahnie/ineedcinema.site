@extends('layouts.app')

@section('title', 'Anime - iNeedCinema')
@section('description', 'Watch the best anime series and movies. From shonen to seinen, discover your next favorite anime.')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-4xl font-bold text-white mb-4">Anime</h1>
        <p class="text-gray-400 text-lg">Explore the world of anime - from classics to the latest releases</p>
    </div>
    
    <!-- Filter and Sort Options -->
    <div class="mb-8 bg-gray-800 rounded-lg p-6">
        <div class="flex flex-wrap gap-4 items-center justify-between">
            <div class="flex flex-wrap gap-4 items-center">
                <!-- Type Filter -->
                <div class="relative">
                    <select id="typeFilter" class="bg-gray-700 text-white border border-gray-600 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-red-500">
                        <option value="">All Types</option>
                        <option value="tv">TV Series</option>
                        <option value="movie">Movies</option>
                        <option value="ova">OVA</option>
                        <option value="special">Specials</option>
                    </select>
                </div>
                
                <!-- Genre Filter -->
                <div class="relative">
                    <select id="genreFilter" class="bg-gray-700 text-white border border-gray-600 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-red-500">
                        <option value="">All Genres</option>
                        <option value="1">Action</option>
                        <option value="2">Adventure</option>
                        <option value="4">Comedy</option>
                        <option value="8">Drama</option>
                        <option value="10">Fantasy</option>
                        <option value="14">Horror</option>
                        <option value="22">Romance</option>
                        <option value="24">Sci-Fi</option>
                        <option value="27">Shounen</option>
                        <option value="25">Shoujo</option>
                        <option value="42">Seinen</option>
                        <option value="43">Josei</option>
                    </select>
                </div>
                
                <!-- Status Filter -->
                <div class="relative">
                    <select id="statusFilter" class="bg-gray-700 text-white border border-gray-600 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-red-500">
                        <option value="">All Status</option>
                        <option value="airing">Currently Airing</option>
                        <option value="complete">Completed</option>
                        <option value="upcoming">Upcoming</option>
                    </select>
                </div>
                
                <!-- Rating Filter -->
                <div class="relative">
                    <select id="ratingFilter" class="bg-gray-700 text-white border border-gray-600 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-red-500">
                        <option value="">All Ratings</option>
                        <option value="g">G - All Ages</option>
                        <option value="pg">PG - Children</option>
                        <option value="pg13">PG-13 - Teens 13+</option>
                        <option value="r17">R - 17+ (violence & profanity)</option>
                        <option value="r">R+ - Mild Nudity</option>
                        <option value="rx">Rx - Hentai</option>
                    </select>
                </div>

                <!-- Language Preference -->
                <div class="relative">
                    <select id="languageFilter" class="bg-gray-700 text-white border border-gray-600 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-red-500">
                        <option value="">All Languages</option>
                        <option value="sub">Subtitled</option>
                        <option value="dub">Dubbed</option>
                    </select>
                </div>
            </div>
            
            <!-- Sort Options -->
            <div class="flex gap-4 items-center">
                <label class="text-gray-400">Sort by:</label>
                <select id="sortFilter" class="bg-gray-700 text-white border border-gray-600 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-red-500">
                    <option value="">Most Popular</option>
                    <option value="title">Title A-Z</option>
                    <option value="start_date">Latest Release</option>
                    <option value="score">Highest Rated</option>
                    <option value="episodes">Episode Count</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Top Anime Section -->
    <section class="mb-12">
        <h2 class="text-2xl font-bold text-white mb-6">Top Anime</h2>
        <div id="top-anime" class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-6">
            <!-- Anime will be loaded here -->
        </div>
    </section>

    <!-- Airing Now Section -->
    <section class="mb-12">
        <h2 class="text-2xl font-bold text-white mb-6">Currently Airing</h2>
        <div id="airing-anime" class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-6">
            <!-- Anime will be loaded here -->
        </div>
    </section>

    <!-- Popular Anime Section -->
    <section class="mb-12">
        <h2 class="text-2xl font-bold text-white mb-6">Most Popular</h2>
        <div id="popular-anime" class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-6">
            <!-- Anime will be loaded here -->
        </div>
    </section>

    <!-- Upcoming Anime Section -->
    <section class="mb-12">
        <h2 class="text-2xl font-bold text-white mb-6">Upcoming Anime</h2>
        <div id="upcoming-anime" class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-6">
            <!-- Anime will be loaded here -->
        </div>
    </section>

    <!-- Genre-based Sections -->
    <section class="mb-12">
        <h2 class="text-2xl font-bold text-white mb-6">Action Anime</h2>
        <div id="action-anime" class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-6">
            <!-- Anime will be loaded here -->
        </div>
    </section>

    <section class="mb-12">
        <h2 class="text-2xl font-bold text-white mb-6">Romance Anime</h2>
        <div id="romance-anime" class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-6">
            <!-- Anime will be loaded here -->
        </div>
    </section>

    <section class="mb-12">
        <h2 class="text-2xl font-bold text-white mb-6">Fantasy Anime</h2>
        <div id="fantasy-anime" class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-6">
            <!-- Anime will be loaded here -->
        </div>
    </section>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    loadAnimeSections();
    
    // Add event listeners for filters
    document.getElementById('typeFilter').addEventListener('change', applyFilters);
    document.getElementById('genreFilter').addEventListener('change', applyFilters);
    document.getElementById('statusFilter').addEventListener('change', applyFilters);
    document.getElementById('ratingFilter').addEventListener('change', applyFilters);
    document.getElementById('languageFilter').addEventListener('change', applyFilters);
    document.getElementById('sortFilter').addEventListener('change', applyFilters);
});

async function loadAnimeSections() {
    // Show loading placeholders
    showLoadingCards('top-anime');
    showLoadingCards('airing-anime');
    showLoadingCards('popular-anime');
    showLoadingCards('upcoming-anime');
    showLoadingCards('action-anime');
    showLoadingCards('romance-anime');
    showLoadingCards('fantasy-anime');
    
    // Load different sections using Jikan API endpoints
    loadAnime('top-anime', '/api/anime/top');
    loadAnime('airing-anime', '/api/anime/season/now');
    loadAnime('popular-anime', '/api/anime/top?filter=bypopularity');
    loadAnime('upcoming-anime', '/api/anime/season/upcoming');
    loadAnimeByGenre('action-anime', 1); // Action
    loadAnimeByGenre('romance-anime', 22); // Romance
    loadAnimeByGenre('fantasy-anime', 10); // Fantasy
}

async function loadAnime(containerId, endpoint) {
    try {
        const response = await fetch(endpoint);
        const data = await response.json();
        
        if (data.data && data.data.length > 0) {
            displayAnime(data.data.slice(0, 12), containerId);
        } else if (data.results && data.results.length > 0) {
            displayAnime(data.results.slice(0, 12), containerId);
        } else {
            showError(containerId, 'No anime found.');
        }
    } catch (error) {
        console.error(`Error loading anime for ${containerId}:`, error);
        showError(containerId, 'Failed to load anime. Please try again.');
    }
}

async function loadAnimeByGenre(containerId, genreId) {
    try {
        const response = await fetch(`/api/anime/genre/${genreId}`);
        const data = await response.json();
        
        if (data.success && data.data && data.data.length > 0) {
            displayAnime(data.data.slice(0, 12), containerId);
        } else {
            showError(containerId, 'No anime found for this genre.');
        }
    } catch (error) {
        console.error(`Error loading anime genre ${genreId}:`, error);
        showError(containerId, 'Failed to load anime. Please try again.');
    }
}

function displayAnime(animeList, containerId) {
    const container = document.getElementById(containerId);
    if (!container) return;
    
    container.innerHTML = '';
    
    animeList.forEach(anime => {
        // Handle different API response formats
        const posterUrl = anime.images?.jpg?.large_image_url || 
                         anime.images?.jpg?.image_url || 
                         anime.poster_path || 
                         'https://via.placeholder.com/300x450/374151/9CA3AF?text=No+Poster';
                         
        const title = anime.title || anime.title_english || anime.name || 'Unknown Title';
        const year = anime.year || (anime.aired?.from ? new Date(anime.aired.from).getFullYear() : 'N/A');
        const score = anime.score ? anime.score.toFixed(1) : (anime.vote_average ? anime.vote_average.toFixed(1) : 'N/A');
        const episodes = anime.episodes || 'N/A';
        const type = anime.type || 'Unknown';
        
        // Status badge
        let statusBadge = '';
        if (anime.status || anime.airing) {
            const status = anime.status || (anime.airing ? 'Airing' : 'Completed');
            const statusColor = status === 'Currently Airing' || status === 'Airing' ? 'bg-green-600' : 
                              status === 'Finished Airing' || status === 'Completed' ? 'bg-blue-600' : 
                              status === 'Not yet aired' ? 'bg-yellow-600' : 'bg-gray-600';
            statusBadge = `<span class="${statusColor} text-white text-xs px-2 py-1 rounded-full">${status}</span>`;
        }
        
        // Type badge
        const typeBadge = type !== 'Unknown' ? `<span class="bg-red-600 text-white text-xs px-2 py-1 rounded-full">${type}</span>` : '';
        
        const animeCard = `
            <div class="group cursor-pointer transform hover:scale-105 transition-all duration-300" onclick="openAnime(${anime.mal_id || anime.id}, '${title.replace(/'/g, '\\\'').replace(/"/g, '&quot;')}')">
                <div class="relative overflow-hidden rounded-lg shadow-lg">
                    <img src="${posterUrl}" 
                         alt="${title}" 
                         class="w-full h-64 md:h-80 object-cover group-hover:opacity-80 transition-opacity duration-300"
                         onerror="this.src='https://via.placeholder.com/300x450/374151/9CA3AF?text=No+Poster'">
                    
                    <div class="absolute top-2 left-2 flex flex-col gap-1">
                        ${statusBadge}
                        ${typeBadge}
                    </div>
                    
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <div class="absolute bottom-4 left-4 right-4">
                            <h3 class="text-white font-semibold text-sm md:text-base mb-1 truncate">${title}</h3>
                            <div class="flex items-center justify-between">
                                <span class="text-yellow-400">★ ${score}</span>
                                <span class="text-gray-300 text-sm">${year}</span>
                            </div>
                            ${episodes !== 'N/A' ? `<div class="text-gray-400 text-sm mt-1">${episodes} episode${episodes !== '1' ? 's' : ''}</div>` : ''}
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
        
        container.innerHTML += animeCard;
    });
}

function openAnime(animeId, animeTitle) {
    // Route to anime streaming page
    window.location.href = `/watch/anime/${animeId}`;
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
    // This function will be implemented to filter anime based on selected criteria
    console.log('Applying anime filters...');
    
    const typeFilter = document.getElementById('typeFilter').value;
    const genreFilter = document.getElementById('genreFilter').value;
    const statusFilter = document.getElementById('statusFilter').value;
    const ratingFilter = document.getElementById('ratingFilter').value;
    const languageFilter = document.getElementById('languageFilter').value;
    const sortFilter = document.getElementById('sortFilter').value;
    
    // Build query parameters
    let queryParams = new URLSearchParams();
    if (typeFilter) queryParams.append('type', typeFilter);
    if (genreFilter) queryParams.append('genres', genreFilter);
    if (statusFilter) queryParams.append('status', statusFilter);
    if (ratingFilter) queryParams.append('rating', ratingFilter);
    if (sortFilter) queryParams.append('order_by', sortFilter);
    
    // For now, just reload the sections with filters
    // This would ideally make filtered API calls
    loadAnimeSections();
}
</script>
@endpush
@endsection