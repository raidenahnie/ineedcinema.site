@extends('layouts.app')

@section('title', 'Anime - iNeedCinema')
@section('description', 'Watch the best anime series. From action to romance, discover your next favorite anime.')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="mb-8">
        <h1 class="text-4xl font-bold text-white mb-4">Anime</h1>
        <p class="text-gray-400 text-lg">Explore the world of anime - from classics to the latest releases</p>
    </div>
    
    <div class="mb-8 bg-gray-800 rounded-lg p-6">
        <div class="flex flex-wrap gap-4 items-center justify-between">
            <div class="flex flex-wrap gap-4 items-center">
                <div class="relative">
                    <select id="genreFilter" class="bg-gray-700 text-white border border-gray-600 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-red-500">
                        <option value="">All Genres</option>
                        <option value="10759">Action & Adventure</option>
                        <option value="35">Comedy</option>
                        <option value="18">Drama</option>
                        <option value="10751">Family</option>
                        <option value="9648">Mystery</option>
                        <option value="10765">Sci-Fi & Fantasy</option>
                    </select>
                </div>
                <div class="relative">
                    <select id="yearFilter" class="bg-gray-700 text-white border border-gray-600 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-red-500">
                        <option value="">All Years</option>
                        <option value="2024">2024</option>
                        <option value="2023">2023</option>
                        <option value="2022">2022</option>
                        <option value="2021">2021</option>
                        <option value="2020">2020</option>
                    </select>
                </div>
                <div class="relative">
                    <select id="ratingFilter" class="bg-gray-700 text-white border border-gray-600 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-red-500">
                        <option value="">All Ratings</option>
                        <option value="8">8.0+ Rating</option>
                        <option value="7">7.0+ Rating</option>
                        <option value="6">6.0+ Rating</option>
                    </select>
                </div>
            </div>
            <div class="flex gap-4 items-center">
                <label class="text-gray-400">Sort by:</label>
                <select id="sortFilter" class="bg-gray-700 text-white border border-gray-600 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-red-500">
                    <option value="popularity.desc">Most Popular</option>
                    <option value="first_air_date.desc">Latest Release</option>
                    <option value="vote_average.desc">Highest Rated</option>
                    <option value="name.asc">A-Z</option>
                </select>
            </div>
        </div>
    </div>

    <section class="mb-12">
        <h2 class="text-2xl font-bold text-white mb-6">Popular Anime</h2>
        <div id="popular-anime" class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-6"></div>
    </section>

    <section class="mb-12">
        <h2 class="text-2xl font-bold text-white mb-6">This Season</h2>
        <div id="season-anime" class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-6"></div>
    </section>

    <section class="mb-12">
        <h2 class="text-2xl font-bold text-white mb-6">Top Rated Anime</h2>
        <div id="top-anime" class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-6"></div>
    </section>

    <section class="mb-12">
        <h2 class="text-2xl font-bold text-white mb-6">Upcoming Anime</h2>
        <div id="upcoming-anime" class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-6"></div>
    </section>

    <section class="mb-12">
        <h2 class="text-2xl font-bold text-white mb-6">Action & Adventure</h2>
        <div id="action-anime" class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-6"></div>
    </section>

    <section class="mb-12">
        <h2 class="text-2xl font-bold text-white mb-6">Sci-Fi & Fantasy</h2>
        <div id="fantasy-anime" class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-6"></div>
    </section>

    <section class="mb-12">
        <h2 class="text-2xl font-bold text-white mb-6">Comedy</h2>
        <div id="comedy-anime" class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-6"></div>
    </section>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    loadAnimeSections();
    document.getElementById('genreFilter').addEventListener('change', applyFilters);
    document.getElementById('yearFilter').addEventListener('change', applyFilters);
    document.getElementById('ratingFilter').addEventListener('change', applyFilters);
    document.getElementById('sortFilter').addEventListener('change', applyFilters);
});

async function loadAnimeSections() {
    showLoadingCards('popular-anime');
    showLoadingCards('season-anime');
    showLoadingCards('top-anime');
    showLoadingCards('upcoming-anime');
    showLoadingCards('action-anime');
    showLoadingCards('fantasy-anime');
    showLoadingCards('comedy-anime');
    
    loadAnime('popular-anime', '/api/anime/popular');
    loadAnime('season-anime', '/api/anime/season/now');
    loadAnime('top-anime', '/api/anime/top');
    loadAnime('upcoming-anime', '/api/anime/season/upcoming');
    loadAnimeByGenre('action-anime', 10759);
    loadAnimeByGenre('fantasy-anime', 10765);
    loadAnimeByGenre('comedy-anime', 35);
}

async function loadAnime(containerId, endpoint) {
    try {
        const response = await fetch(endpoint);
        const data = await response.json();
        
        if (data.success && data.data && data.data.length > 0) {
            displayAnime(data.data.slice(0, 12), containerId);
        } else if (data.results && data.results.length > 0) {
            displayAnime(data.results.slice(0, 12), containerId);
        } else {
            showError(containerId, 'No anime found.');
        }
    } catch (error) {
        console.error(`Error loading anime for ${containerId}:`, error);
        showError(containerId, 'Failed to load anime.');
    }
}

async function loadAnimeByGenre(containerId, genreId) {
    try {
        const response = await fetch(`/api/anime/genre/${genreId}`);
        const data = await response.json();
        
        if (data.success && data.data && data.data.length > 0) {
            displayAnime(data.data.slice(0, 12), containerId);
        } else {
            showError(containerId, 'No anime found.');
        }
    } catch (error) {
        console.error(`Error loading anime genre ${genreId}:`, error);
        showError(containerId, 'Failed to load anime.');
    }
}

function displayAnime(animeList, containerId) {
    const container = document.getElementById(containerId);
    if (!container) return;
    
    container.innerHTML = '';
    
    animeList.forEach(anime => {
        const posterUrl = anime.poster_path ? `https://image.tmdb.org/t/p/w500${anime.poster_path}` : 'https://via.placeholder.com/300x450/374151/9CA3AF?text=No+Poster';
        const name = anime.name || anime.original_name || 'Unknown';
        const year = anime.first_air_date ? new Date(anime.first_air_date).getFullYear() : 'N/A';
        const rating = anime.vote_average ? anime.vote_average.toFixed(1) : 'N/A';
        
        container.innerHTML += `
            <div class="group cursor-pointer transform hover:scale-105 transition-all duration-300" onclick="openAnime(${anime.id})">
                <div class="relative overflow-hidden rounded-lg shadow-lg">
                    <img src="${posterUrl}" alt="${name}" class="w-full h-64 md:h-80 object-cover group-hover:opacity-80 transition-opacity duration-300" onerror="this.src='https://via.placeholder.com/300x450/374151/9CA3AF?text=No+Poster'">
                    <div class="absolute top-2 left-2">
                        <span class="bg-red-600 text-white text-xs px-2 py-1 rounded-full">ANIME</span>
                    </div>
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <div class="absolute bottom-4 left-4 right-4">
                            <h3 class="text-white font-semibold text-sm md:text-base mb-1 line-clamp-2">${name}</h3>
                            <div class="flex items-center justify-between">
                                <span class="text-yellow-400"> ${rating}</span>
                                <span class="text-gray-300 text-sm">${year}</span>
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
    });
}

function openAnime(animeId) {
    window.location.href = `/watch/anime/${animeId}`;
}

function showLoadingCards(containerId) {
    const container = document.getElementById(containerId);
    if (!container) return;
    container.innerHTML = '';
    for (let i = 0; i < 12; i++) {
        container.innerHTML += `<div class="animate-pulse"><div class="bg-gray-700 w-full h-64 md:h-80 rounded-lg"></div></div>`;
    }
}

function showError(containerId, message) {
    const container = document.getElementById(containerId);
    if (!container) return;
    container.innerHTML = `<div class="col-span-full text-center py-8"><p class="text-gray-400 text-lg">${message}</p><button onclick="location.reload()" class="mt-4 bg-red-600 hover:bg-red-700 text-white px-6 py-2 rounded-lg transition-colors">Try Again</button></div>`;
}

async function applyFilters() {
    const genreFilter = document.getElementById('genreFilter').value;
    const yearFilter = document.getElementById('yearFilter').value;
    const ratingFilter = document.getElementById('ratingFilter').value;
    const sortFilter = document.getElementById('sortFilter').value;
    
    let queryParams = new URLSearchParams();
    if (genreFilter) queryParams.append('genres', genreFilter);
    if (yearFilter) queryParams.append('year', yearFilter);
    if (ratingFilter) queryParams.append('min_rating', ratingFilter);
    if (sortFilter) queryParams.append('sort_by', sortFilter);
    
    clearAllSections();
    showLoadingCards('popular-anime');
    
    try {
        const response = await fetch(`/api/anime/filter?${queryParams.toString()}`);
        const data = await response.json();
        
        if (data.success && data.data && data.data.length > 0) {
            displayAnime(data.data, 'popular-anime');
            document.querySelector('#popular-anime').closest('section').querySelector('h2').textContent = 'Filtered Results';
        } else {
            showError('popular-anime', 'No anime found matching your filters.');
        }
    } catch (error) {
        console.error('Error applying filters:', error);
        showError('popular-anime', 'Failed to apply filters.');
    }
}

function clearAllSections() {
    ['popular-anime', 'season-anime', 'top-anime', 'upcoming-anime', 'action-anime', 'fantasy-anime', 'comedy-anime'].forEach(id => {
        document.getElementById(id).innerHTML = '';
    });
}
</script>
@endpush
@endsection
