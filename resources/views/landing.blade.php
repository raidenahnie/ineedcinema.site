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

<!-- Latest Releases Section -->
<section class="py-16 bg-gray-950">
    <div class="container mx-auto px-4">
        <div class="mb-12 text-center">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">
                Latest Releases
            </h2>
            <p class="text-gray-400 text-lg">
                Fresh content added this week
            </p>
        </div>
        
        <!-- Latest Movies Grid -->
        <div id="latest-movies" class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4 md:gap-6">
            <!-- Latest movies will be loaded here dynamically -->
        </div>
        
        <div class="text-center mt-12">
            <a href="{{ route('movies') }}" class="inline-flex items-center text-red-500 hover:text-red-400 font-semibold text-lg transition-colors duration-200">
                Browse All Movies
                <i class="fas fa-arrow-right ml-2"></i>
            </a>
        </div>
    </div>
</section>

<!-- Mixed Content Section -->
<section class="py-16 bg-black">
    <div class="container mx-auto px-4">
        <div class="mb-12 text-center">
            <h2 class="text-3xl md:text-4xl font-bold text-white mb-4">
                Popular This Week
            </h2>
            <p class="text-gray-400 text-lg">
                Movies, TV shows, and anime everyone's watching
            </p>
        </div>
        
        <!-- Mixed Popular Content Grid -->
        <div id="popular-mixed" class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4 md:gap-6">
            <!-- Mixed popular content will be loaded here dynamically -->
        </div>
        
        <div class="text-center mt-12">
            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center">
                <a href="{{ route('tv-shows') }}" class="inline-flex items-center text-blue-400 hover:text-blue-300 font-semibold text-lg transition-colors duration-200">
                    Explore TV Shows
                    <i class="fas fa-tv ml-2"></i>
                </a>
                <a href="{{ route('anime') }}" class="inline-flex items-center text-purple-400 hover:text-purple-300 font-semibold text-lg transition-colors duration-200">
                    Discover Anime
                    <i class="fas fa-star ml-2"></i>
                </a>
            </div>
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

// Main function to load essential content only
async function loadMoviesData() {
    console.log('Loading essential content...');
    
    // Show loading states for the main sections only
    showLoadingCards('trending-movies');
    showLoadingCards('latest-movies');
    showLoadingCards('popular-mixed');
    
    try {
        // Load trending movies first
        await loadMovies('trending-movies', '/api/movies/trending');
        
        // Load latest releases
        await loadMovies('latest-movies', '/api/movies/now_playing');
        
        // Load mixed popular content (movies, TV shows, anime)
        await loadMixedPopularContent();
        
    } catch (error) {
        console.error('Error loading essential content:', error);
    }
}

// Load mixed popular content from different sources
async function loadMixedPopularContent() {
    try {
        // Load content from multiple sources in parallel
        const [moviesResponse, tvResponse, animeResponse] = await Promise.all([
            fetch('/api/movies/popular'),
            fetch('/api/tv/popular'),
            fetch('/api/anime/popular')
        ]);
        
        const [moviesData, tvData, animeData] = await Promise.all([
            moviesResponse.json(),
            tvResponse.json(), 
            animeResponse.json()
        ]);
        
        // Combine and shuffle the results
        let allContent = [];
        
        // Add movies (limit to 4)
        if (moviesData.results?.length > 0) {
            const movies = moviesData.results.slice(0, 4).map(item => ({...item, media_type: 'movie'}));
            allContent.push(...movies);
        }
        
        // Add TV shows (limit to 4)
        if (tvData.results?.length > 0) {
            const tvShows = tvData.results.slice(0, 4).map(item => ({...item, media_type: 'tv'}));
            allContent.push(...tvShows);
        }
        
        // Add anime (limit to 4) 
        if (animeData.data?.length > 0) {
            const anime = animeData.data.slice(0, 4).map(item => {
                const posterUrl = item.images?.jpg?.image_url || item.images?.jpg?.large_image_url;
                return {
                    id: item.mal_id,
                    title: item.title,
                    poster_path: posterUrl,
                    vote_average: item.score || 0,
                    release_date: item.aired?.from || item.year,
                    media_type: 'anime'
                };
            });
            allContent.push(...anime);
        }
        
        // Shuffle the combined content for variety
        allContent = shuffleArray(allContent);
        
        // Display the mixed content
        if (allContent.length > 0) {
            displayMovies(allContent, 'popular-mixed');
        } else {
            showError('popular-mixed', 'No popular content found.');
        }
        
    } catch (error) {
        console.error('Error loading mixed popular content:', error);
        showError('popular-mixed', 'Failed to load popular content.');
    }
}

// Utility function to shuffle array
function shuffleArray(array) {
    const shuffled = [...array];
    for (let i = shuffled.length - 1; i > 0; i--) {
        const j = Math.floor(Math.random() * (i + 1));
        [shuffled[i], shuffled[j]] = [shuffled[j], shuffled[i]];
    }
    return shuffled;
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
