@extends('layouts.app')

@section('title', 'TV Shows - iNeedCinema')
@section('description', 'Discover the best TV series and shows. From drama to comedy, find your next binge-worthy series.')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-4xl font-bold text-white mb-4">TV Shows</h1>
        <p class="text-gray-400 text-lg">Explore the world's best television series and shows</p>
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
                
                <!-- Status Filter -->
                <div class="relative">
                    <select id="statusFilter" class="bg-gray-700 text-white border border-gray-600 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-red-500">
                        <option value="">All Status</option>
                        <option value="returning">Returning Series</option>
                        <option value="ended">Ended</option>
                        <option value="canceled">Canceled</option>
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
                    <option value="first_air_date.desc">Latest Episodes</option>
                    <option value="vote_average.desc">Highest Rated</option>
                    <option value="name.asc">A-Z</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Popular TV Shows Section -->
    <section class="mb-12">
        <h2 class="text-2xl font-bold text-white mb-6">Popular TV Shows</h2>
        <div id="popular-shows" class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-6">
            <!-- TV shows will be loaded here -->
        </div>
    </section>

    <!-- Airing Today Section -->
    <section class="mb-12">
        <h2 class="text-2xl font-bold text-white mb-6">Airing Today</h2>
        <div id="airing-today-shows" class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-6">
            <!-- TV shows will be loaded here -->
        </div>
    </section>

    <!-- Top Rated Section -->
    <section class="mb-12">
        <h2 class="text-2xl font-bold text-white mb-6">Top Rated Shows</h2>
        <div id="top-rated-shows" class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-6">
            <!-- TV shows will be loaded here -->
        </div>
    </section>

    <!-- On The Air Section -->
    <section class="mb-12">
        <h2 class="text-2xl font-bold text-white mb-6">Currently Airing</h2>
        <div id="on-the-air-shows" class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-6">
            <!-- TV shows will be loaded here -->
        </div>
    </section>

    <!-- Genre-based Sections -->
    <section class="mb-12">
        <h2 class="text-2xl font-bold text-white mb-6">Drama Series</h2>
        <div id="drama-shows" class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-6">
            <!-- TV shows will be loaded here -->
        </div>
    </section>

    <section class="mb-12">
        <h2 class="text-2xl font-bold text-white mb-6">Comedy Series</h2>
        <div id="comedy-shows" class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-6">
            <!-- TV shows will be loaded here -->
        </div>
    </section>

    <section class="mb-12">
        <h2 class="text-2xl font-bold text-white mb-6">Action & Adventure</h2>
        <div id="action-shows" class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-6">
            <!-- TV shows will be loaded here -->
        </div>
    </section>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    loadGenres();
    loadTVShowsSections();
    
    // Add event listeners for filters
    document.getElementById('genreFilter').addEventListener('change', applyFilters);
    document.getElementById('yearFilter').addEventListener('change', applyFilters);
    document.getElementById('statusFilter').addEventListener('change', applyFilters);
    document.getElementById('ratingFilter').addEventListener('change', applyFilters);
    document.getElementById('sortFilter').addEventListener('change', applyFilters);
});

async function loadGenres() {
    try {
        const response = await fetch('/api/tv/genres');
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
        console.error('Error loading TV genres:', error);
    }
}

async function loadTVShowsSections() {
    // Show loading placeholders
    showLoadingCards('popular-shows');
    showLoadingCards('airing-today-shows');
    showLoadingCards('top-rated-shows');
    showLoadingCards('on-the-air-shows');
    showLoadingCards('drama-shows');
    showLoadingCards('comedy-shows');
    showLoadingCards('action-shows');
    
    // Load different sections
    loadTVShows('popular-shows', '/api/tv/popular');
    loadTVShows('airing-today-shows', '/api/tv/airing_today');
    loadTVShows('top-rated-shows', '/api/tv/popular?sort_by=vote_average.desc');
    loadTVShows('on-the-air-shows', '/api/tv/on_the_air');
    loadTVShowsByGenre('drama-shows', 18); // Drama
    loadTVShowsByGenre('comedy-shows', 35); // Comedy
    loadTVShowsByGenre('action-shows', 10759); // Action & Adventure
}

async function loadTVShows(containerId, endpoint) {
    try {
        const response = await fetch(endpoint);
        const data = await response.json();
        
        if (data.results && data.results.length > 0) {
            displayTVShows(data.results.slice(0, 12), containerId);
        } else if (data.data && data.data.length > 0) {
            displayTVShows(data.data.slice(0, 12), containerId);
        } else {
            showError(containerId, 'No TV shows found.');
        }
    } catch (error) {
        console.error(`Error loading TV shows for ${containerId}:`, error);
        showError(containerId, 'Failed to load TV shows. Please try again.');
    }
}

async function loadTVShowsByGenre(containerId, genreId) {
    try {
        const response = await fetch(`/api/tv/genre/${genreId}`);
        const data = await response.json();
        
        if (data.success && data.data && data.data.length > 0) {
            displayTVShows(data.data.slice(0, 12), containerId);
        } else {
            showError(containerId, 'No TV shows found for this genre.');
        }
    } catch (error) {
        console.error(`Error loading TV genre ${genreId}:`, error);
        showError(containerId, 'Failed to load TV shows. Please try again.');
    }
}

function displayTVShows(shows, containerId) {
    const container = document.getElementById(containerId);
    if (!container) return;
    
    container.innerHTML = '';
    
    shows.forEach(show => {
        const posterUrl = show.poster_path 
            ? `https://image.tmdb.org/t/p/w500${show.poster_path}`
            : 'https://via.placeholder.com/300x450/374151/9CA3AF?text=No+Poster';
            
        const firstAirYear = show.first_air_date ? new Date(show.first_air_date).getFullYear() : 'N/A';
        const name = show.name || 'Unknown Title';
        const rating = show.vote_average ? show.vote_average.toFixed(1) : 'N/A';
        
        // Status display
        let statusBadge = '';
        if (show.status) {
            const statusColor = show.status === 'Ended' ? 'bg-red-600' : 
                              show.status === 'Returning Series' ? 'bg-green-600' : 'bg-yellow-600';
            statusBadge = `<span class="${statusColor} text-white text-xs px-2 py-1 rounded-full">${show.status}</span>`;
        }
        
        const showCard = `
            <div class="group cursor-pointer transform hover:scale-105 transition-all duration-300" onclick="openTVShow(${show.id}, '${name.replace(/'/g, '\\\'').replace(/"/g, '&quot;')}')">
                <div class="relative overflow-hidden rounded-lg shadow-lg">
                    <img src="${posterUrl}" 
                         alt="${name}" 
                         class="w-full h-64 md:h-80 object-cover group-hover:opacity-80 transition-opacity duration-300"
                         onerror="this.src='https://via.placeholder.com/300x450/374151/9CA3AF?text=No+Poster'">
                    ${statusBadge ? `<div class="absolute top-2 left-2">${statusBadge}</div>` : ''}
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <div class="absolute bottom-4 left-4 right-4">
                            <h3 class="text-white font-semibold text-sm md:text-base mb-1 truncate">${name}</h3>
                            <div class="flex items-center justify-between">
                                <span class="text-yellow-400">★ ${rating}</span>
                                <span class="text-gray-300 text-sm">${firstAirYear}</span>
                            </div>
                            ${show.number_of_seasons ? `<div class="text-gray-400 text-sm mt-1">${show.number_of_seasons} Season${show.number_of_seasons !== 1 ? 's' : ''}</div>` : ''}
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
        
        container.innerHTML += showCard;
    });
}

function openTVShow(showId, showName) {
    // First, we need to get the show details to find the first available episode
    window.location.href = `/watch/tv/${showId}`;
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
    // This function will be implemented to filter TV shows based on selected criteria
    console.log('Applying TV show filters...');
    // For now, just reload the sections
    loadTVShowsSections();
}
</script>
@endpush
@endsection