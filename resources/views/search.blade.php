@extends('layouts.app')

@section('title', 'Search Results - iNeedCinema')
@section('description', 'Search results for movies, TV shows, and anime.')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Search Header -->
    <div class="mb-8">
        <h1 class="text-4xl font-bold text-white mb-4">Search Results</h1>
        <div class="flex flex-col md:flex-row gap-4 items-start md:items-center justify-between">
            <div>
                <p class="text-gray-400 text-lg" id="search-query-display">
                    Showing results for: <span class="text-white font-semibold" id="search-term"></span>
                </p>
                <p class="text-gray-500 text-sm" id="results-count">
                    <!-- Results count will be displayed here -->
                </p>
            </div>
            
            <!-- Search Again Form -->
            <form action="{{ route('search') }}" method="GET" class="flex gap-2">
                <input type="text" 
                       name="q" 
                       id="search-input"
                       placeholder="Search movies, TV shows, anime..." 
                       class="bg-gray-700 text-white border border-gray-600 rounded-lg px-4 py-2 w-64 focus:outline-none focus:ring-2 focus:ring-red-500"
                       value="{{ request('q') }}">
                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-6 py-2 rounded-lg transition-colors">
                    <i class="fas fa-search"></i>
                </button>
            </form>
        </div>
    </div>

    <!-- Content Type Tabs -->
    <div class="mb-8">
        <nav class="flex space-x-1 bg-gray-800 rounded-lg p-1">
            <button onclick="switchTab('all')" 
                    class="tab-button flex-1 py-3 px-4 text-center rounded-md transition-colors focus:outline-none active"
                    id="tab-all">
                All Results
                <span class="ml-2 text-sm bg-gray-700 px-2 py-1 rounded-full" id="count-all">0</span>
            </button>
            <button onclick="switchTab('movies')" 
                    class="tab-button flex-1 py-3 px-4 text-center rounded-md transition-colors focus:outline-none"
                    id="tab-movies">
                Movies
                <span class="ml-2 text-sm bg-gray-700 px-2 py-1 rounded-full" id="count-movies">0</span>
            </button>
            <button onclick="switchTab('tv')" 
                    class="tab-button flex-1 py-3 px-4 text-center rounded-md transition-colors focus:outline-none"
                    id="tab-tv">
                TV Shows
                <span class="ml-2 text-sm bg-gray-700 px-2 py-1 rounded-full" id="count-tv">0</span>
            </button>
            <button onclick="switchTab('anime')" 
                    class="tab-button flex-1 py-3 px-4 text-center rounded-md transition-colors focus:outline-none"
                    id="tab-anime">
                Anime
                <span class="ml-2 text-sm bg-gray-700 px-2 py-1 rounded-full" id="count-anime">0</span>
            </button>
        </nav>
    </div>

    <!-- Filters -->
    <div class="mb-8 bg-gray-800 rounded-lg p-6" id="filters-section">
        <div class="flex flex-wrap gap-4 items-center">
            <!-- Genre Filter -->
            <div class="relative">
                <select id="genreFilter" class="bg-gray-700 text-white border border-gray-600 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-red-500">
                    <option value="">All Genres</option>
                    <!-- Genres will be populated based on active tab -->
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
            
            <!-- Sort Filter -->
            <div class="relative ml-auto">
                <label class="text-gray-400 mr-2">Sort by:</label>
                <select id="sortFilter" class="bg-gray-700 text-white border border-gray-600 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-red-500">
                    <option value="relevance">Relevance</option>
                    <option value="popularity">Popularity</option>
                    <option value="rating">Rating</option>
                    <option value="year">Release Year</option>
                    <option value="title">Title A-Z</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Results Container -->
    <div id="results-container">
        <!-- Loading State -->
        <div id="loading-state" class="text-center py-12">
            <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-red-600 mx-auto mb-4"></div>
            <p class="text-gray-400">Searching...</p>
        </div>
        
        <!-- No Results State -->
        <div id="no-results-state" class="text-center py-12 hidden">
            <div class="text-6xl mb-4">🔍</div>
            <h3 class="text-2xl font-bold text-white mb-2">No results found</h3>
            <p class="text-gray-400 mb-4">Try adjusting your search terms or filters</p>
            <button onclick="clearFilters()" class="bg-red-600 hover:bg-red-700 text-white px-6 py-2 rounded-lg transition-colors">
                Clear Filters
            </button>
        </div>
        
        <!-- Results Grid -->
        <div id="results-grid" class="hidden">
            <!-- Search results will be displayed here -->
        </div>
    </div>

    <!-- Pagination -->
    <div id="pagination-container" class="mt-12 hidden">
        <nav class="flex space-x-2">
            <!-- Pagination buttons will be generated here -->
        </nav>
    </div>
</div>

@push('scripts')
<script>
let currentTab = 'all';
let currentPage = 1;
let searchQuery = '';
let allResults = {
    movies: [],
    tv: [],
    anime: [],
    all: []
};

document.addEventListener('DOMContentLoaded', function() {
    // Get search query from URL
    const urlParams = new URLSearchParams(window.location.search);
    searchQuery = urlParams.get('q') || '';
    
    if (searchQuery) {
        document.getElementById('search-term').textContent = searchQuery;
        document.getElementById('search-input').value = searchQuery;
        performSearch();
    } else {
        showNoResults();
    }
    
    // Add event listeners for filters
    document.getElementById('genreFilter').addEventListener('change', applyFilters);
    document.getElementById('yearFilter').addEventListener('change', applyFilters);
    document.getElementById('ratingFilter').addEventListener('change', applyFilters);
    document.getElementById('sortFilter').addEventListener('change', applyFilters);
});

async function performSearch() {
    if (!searchQuery.trim()) return;
    
    showLoading();
    
    try {
        // Search across all content types
        const [moviesResponse, tvResponse, animeResponse] = await Promise.all([
            fetch(`/api/search/movies?q=${encodeURIComponent(searchQuery)}`),
            fetch(`/api/search/tv?q=${encodeURIComponent(searchQuery)}`),
            fetch(`/api/search/anime?q=${encodeURIComponent(searchQuery)}`)
        ]);
        
        const moviesData = await moviesResponse.json();
        const tvData = await tvResponse.json();
        const animeData = await animeResponse.json();
        
        // Process results
        allResults.movies = processMovieResults(moviesData);
        allResults.tv = processTVResults(tvData);
        allResults.anime = processAnimeResults(animeData);
        allResults.all = [...allResults.movies, ...allResults.tv, ...allResults.anime];
        
        // Update counts
        updateResultsCounts();
        
        // Display results for current tab
        displayResults();
        
    } catch (error) {
        console.error('Search error:', error);
        showError('Failed to perform search. Please try again.');
    }
}

function processMovieResults(data) {
    if (!data.results || !Array.isArray(data.results)) return [];
    
    return data.results.map(movie => ({
        id: movie.id,
        title: movie.title || 'Unknown Title',
        poster_path: movie.poster_path,
        release_date: movie.release_date,
        vote_average: movie.vote_average,
        type: 'movie',
        year: movie.release_date ? new Date(movie.release_date).getFullYear() : null
    }));
}

function processTVResults(data) {
    if (!data.results || !Array.isArray(data.results)) return [];
    
    return data.results.map(show => ({
        id: show.id,
        title: show.name || 'Unknown Title',
        poster_path: show.poster_path,
        first_air_date: show.first_air_date,
        vote_average: show.vote_average,
        type: 'tv',
        year: show.first_air_date ? new Date(show.first_air_date).getFullYear() : null
    }));
}

function processAnimeResults(data) {
    if (!data.data || !Array.isArray(data.data)) return [];
    
    return data.data.map(anime => ({
        id: anime.mal_id,
        title: anime.title || anime.title_english || 'Unknown Title',
        poster_path: anime.images?.jpg?.large_image_url || anime.images?.jpg?.image_url,
        release_date: anime.aired?.from,
        vote_average: anime.score,
        type: 'anime',
        year: anime.year || (anime.aired?.from ? new Date(anime.aired.from).getFullYear() : null)
    }));
}

function updateResultsCounts() {
    document.getElementById('count-all').textContent = allResults.all.length;
    document.getElementById('count-movies').textContent = allResults.movies.length;
    document.getElementById('count-tv').textContent = allResults.tv.length;
    document.getElementById('count-anime').textContent = allResults.anime.length;
    
    const totalResults = allResults.all.length;
    document.getElementById('results-count').textContent = `${totalResults} result${totalResults !== 1 ? 's' : ''} found`;
}

function switchTab(tab) {
    currentTab = tab;
    currentPage = 1;
    
    // Update active tab styling
    document.querySelectorAll('.tab-button').forEach(btn => {
        btn.classList.remove('active', 'bg-red-600', 'text-white');
        btn.classList.add('text-gray-400', 'hover:text-white');
    });
    
    const activeTab = document.getElementById(`tab-${tab}`);
    activeTab.classList.add('active', 'bg-red-600', 'text-white');
    activeTab.classList.remove('text-gray-400', 'hover:text-white');
    
    displayResults();
}

function displayResults() {
    const results = allResults[currentTab] || [];
    const resultsGrid = document.getElementById('results-grid');
    
    hideLoading();
    
    if (results.length === 0) {
        showNoResults();
        return;
    }
    
    // Show results grid
    document.getElementById('no-results-state').classList.add('hidden');
    resultsGrid.classList.remove('hidden');
    resultsGrid.className = 'grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-6';
    
    // Clear and populate results
    resultsGrid.innerHTML = '';
    
    results.forEach(item => {
        const posterUrl = item.poster_path 
            ? (item.type === 'anime' ? item.poster_path : `https://image.tmdb.org/t/p/w500${item.poster_path}`)
            : 'https://via.placeholder.com/300x450/374151/9CA3AF?text=No+Poster';
            
        const year = item.year || 'N/A';
        const rating = item.vote_average ? item.vote_average.toFixed(1) : 'N/A';
        
        // Type badge
        const typeColors = {
            movie: 'bg-blue-600',
            tv: 'bg-green-600',
            anime: 'bg-purple-600'
        };
        
        const typeLabels = {
            movie: 'Movie',
            tv: 'TV Show',
            anime: 'Anime'
        };
        
        const itemCard = `
            <div class="group cursor-pointer transform hover:scale-105 transition-all duration-300" onclick="openContent('${item.type}', ${item.id}, '${item.title.replace(/'/g, '\\\'').replace(/"/g, '&quot;')}')">
                <div class="relative overflow-hidden rounded-lg shadow-lg">
                    <img src="${posterUrl}" 
                         alt="${item.title}" 
                         class="w-full h-64 md:h-80 object-cover group-hover:opacity-80 transition-opacity duration-300"
                         onerror="this.src='https://via.placeholder.com/300x450/374151/9CA3AF?text=No+Poster'">
                    
                    <div class="absolute top-2 left-2">
                        <span class="${typeColors[item.type]} text-white text-xs px-2 py-1 rounded-full">
                            ${typeLabels[item.type]}
                        </span>
                    </div>
                    
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <div class="absolute bottom-4 left-4 right-4">
                            <h3 class="text-white font-semibold text-sm md:text-base mb-1 truncate">${item.title}</h3>
                            <div class="flex items-center justify-between">
                                <span class="text-yellow-400">★ ${rating}</span>
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
        
        resultsGrid.innerHTML += itemCard;
    });
}

function openContent(type, id, title) {
    let url;
    switch (type) {
        case 'movie':
            url = `/watch/movie/${id}`;
            break;
        case 'tv':
            url = `/watch/tv/${id}`;
            break;
        case 'anime':
            url = `/watch/anime/${id}`;
            break;
        default:
            return;
    }
    window.location.href = url;
}

function showLoading() {
    document.getElementById('loading-state').classList.remove('hidden');
    document.getElementById('no-results-state').classList.add('hidden');
    document.getElementById('results-grid').classList.add('hidden');
}

function hideLoading() {
    document.getElementById('loading-state').classList.add('hidden');
}

function showNoResults() {
    hideLoading();
    document.getElementById('no-results-state').classList.remove('hidden');
    document.getElementById('results-grid').classList.add('hidden');
}

function showError(message) {
    hideLoading();
    document.getElementById('results-grid').innerHTML = `
        <div class="col-span-full text-center py-8">
            <p class="text-red-400 text-lg">${message}</p>
            <button onclick="performSearch()" class="mt-4 bg-red-600 hover:bg-red-700 text-white px-6 py-2 rounded-lg transition-colors">
                Try Again
            </button>
        </div>
    `;
    document.getElementById('results-grid').classList.remove('hidden');
}

function applyFilters() {
    // This function will filter the current results based on selected criteria
    console.log('Applying search filters...');
    displayResults();
}

function clearFilters() {
    document.getElementById('genreFilter').value = '';
    document.getElementById('yearFilter').value = '';
    document.getElementById('ratingFilter').value = '';
    document.getElementById('sortFilter').value = 'relevance';
    applyFilters();
}

// CSS for tab styling
const style = document.createElement('style');
style.textContent = `
    .tab-button {
        color: #9CA3AF;
        transition: all 0.2s;
    }
    .tab-button:hover {
        color: white;
    }
    .tab-button.active {
        background-color: #DC2626;
        color: white;
    }
`;
document.head.appendChild(style);
</script>
@endpush
@endsection