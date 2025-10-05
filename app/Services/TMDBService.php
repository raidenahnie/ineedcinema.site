<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class TMDBService
{
    private string $apiKey;
    private string $accessToken;
    private string $baseUrl;
    private string $imageBaseUrl = 'https://image.tmdb.org/t/p/';

    public function __construct()
    {
        $this->apiKey = config('services.tmdb.api_key');
        $this->accessToken = config('services.tmdb.access_token');
        $this->baseUrl = config('services.tmdb.base_url');
    }

    /**
     * Search for movies and TV shows
     */
    public function search(string $query, int $page = 1): array
    {
        $cacheKey = "tmdb_search_{$query}_page_{$page}";
        
        return Cache::remember($cacheKey, 300, function () use ($query, $page) {
            try {
                $response = Http::withoutVerifying()->withHeaders([
                    'Authorization' => 'Bearer ' . $this->accessToken,
                    'Accept' => 'application/json',
                ])->get("{$this->baseUrl}/search/multi", [
                    'query' => $query,
                    'page' => $page,
                    'include_adult' => false,
                ]);

                if ($response->successful()) {
                    return $response->json();
                }

                Log::error('TMDB Search API Error', [
                    'status' => $response->status(),
                    'body' => $response->body()
                ]);

                return ['results' => [], 'total_pages' => 0, 'total_results' => 0];
            } catch (\Exception $e) {
                Log::error('TMDB Search Exception', ['error' => $e->getMessage()]);
                return ['results' => [], 'total_pages' => 0, 'total_results' => 0];
            }
        });
    }

    /**
     * Get movie details by ID
     */
    public function getMovieDetails(int $movieId): ?array
    {
        $cacheKey = "tmdb_movie_{$movieId}";
        
        return Cache::remember($cacheKey, 3600, function () use ($movieId) {
            try {
                $response = Http::withoutVerifying()->withHeaders([
                    'Authorization' => 'Bearer ' . $this->accessToken,
                    'Accept' => 'application/json',
                ])->get("{$this->baseUrl}/movie/{$movieId}", [
                    'append_to_response' => 'videos,credits,similar,recommendations,release_dates'
                ]);

                if ($response->successful()) {
                    return $response->json();
                }

                return null;
            } catch (\Exception $e) {
                Log::error('TMDB Movie Details Exception', ['error' => $e->getMessage(), 'movie_id' => $movieId]);
                return null;
            }
        });
    }

    /**
     * Get TV show details by ID
     */
    public function getTVShowDetails(int $tvId): ?array
    {
        $cacheKey = "tmdb_tv_{$tvId}";
        
        return Cache::remember($cacheKey, 3600, function () use ($tvId) {
            try {
                $response = Http::withoutVerifying()->withHeaders([
                    'Authorization' => 'Bearer ' . $this->accessToken,
                    'Accept' => 'application/json',
                ])->get("{$this->baseUrl}/tv/{$tvId}", [
                    'append_to_response' => 'videos,credits,similar,recommendations,content_ratings'
                ]);

                if ($response->successful()) {
                    return $response->json();
                }

                return null;
            } catch (\Exception $e) {
                Log::error('TMDB TV Show Details Exception', ['error' => $e->getMessage(), 'tv_id' => $tvId]);
                return null;
            }
        });
    }

    /**
     * Get trending movies and TV shows
     */
    public function getTrending(string $mediaType = 'all', string $timeWindow = 'day'): array
    {
        $cacheKey = "tmdb_trending_{$mediaType}_{$timeWindow}";
        
        return Cache::remember($cacheKey, 600, function () use ($mediaType, $timeWindow) {
            try {
                $response = Http::withoutVerifying()->withHeaders([
                    'Authorization' => 'Bearer ' . $this->accessToken,
                    'Accept' => 'application/json',
                ])->get("{$this->baseUrl}/trending/{$mediaType}/{$timeWindow}");

                if ($response->successful()) {
                    return $response->json();
                }

                return ['results' => []];
            } catch (\Exception $e) {
                Log::error('TMDB Trending Exception', ['error' => $e->getMessage()]);
                return ['results' => []];
            }
        });
    }

    /**
     * Get popular movies
     */
    public function getPopularMovies(int $page = 1): array
    {
        $cacheKey = "tmdb_popular_movies_page_{$page}";
        
        return Cache::remember($cacheKey, 3600, function () use ($page) {
            try {
                $response = Http::withoutVerifying()->withHeaders([
                    'Authorization' => 'Bearer ' . $this->accessToken,
                    'Accept' => 'application/json',
                ])->get("{$this->baseUrl}/movie/popular", [
                    'page' => $page,
                ]);

                if ($response->successful()) {
                    return $response->json();
                }

                return ['results' => []];
            } catch (\Exception $e) {
                Log::error('TMDB Popular Movies Exception', ['error' => $e->getMessage()]);
                return ['results' => []];
            }
        });
    }

    /**
     * Get popular TV shows
     */
    public function getPopularTVShows(int $page = 1): array
    {
        $cacheKey = "tmdb_popular_tv_page_{$page}";
        
        return Cache::remember($cacheKey, 3600, function () use ($page) {
            try {
                $response = Http::withoutVerifying()->withHeaders([
                    'Authorization' => 'Bearer ' . $this->accessToken,
                    'Accept' => 'application/json',
                ])->get("{$this->baseUrl}/tv/popular", [
                    'page' => $page,
                ]);

                if ($response->successful()) {
                    return $response->json();
                }

                return ['results' => []];
            } catch (\Exception $e) {
                Log::error('TMDB Popular TV Shows Exception', ['error' => $e->getMessage()]);
                return ['results' => []];
            }
        });
    }

    /**
     * Get now playing movies
     */
    public function getNowPlayingMovies(int $page = 1): array
    {
        $cacheKey = "tmdb_now_playing_movies_page_{$page}";
        
        return Cache::remember($cacheKey, 1800, function () use ($page) {
            try {
                $response = Http::withoutVerifying()->withHeaders([
                    'Authorization' => 'Bearer ' . $this->accessToken,
                    'Accept' => 'application/json',
                ])->get("{$this->baseUrl}/movie/now_playing", [
                    'page' => $page,
                ]);

                if ($response->successful()) {
                    return $response->json();
                }

                return ['results' => []];
            } catch (\Exception $e) {
                Log::error('TMDB Now Playing Movies Exception', ['error' => $e->getMessage()]);
                return ['results' => []];
            }
        });
    }

    /**
     * Get movies by genre
     */
    public function getMoviesByGenre(int $genreId, int $page = 1): array
    {
        $cacheKey = "tmdb_movies_genre_{$genreId}_page_{$page}";
        
        return Cache::remember($cacheKey, 3600, function () use ($genreId, $page) {
            try {
                $response = Http::withoutVerifying()->withHeaders([
                    'Authorization' => 'Bearer ' . $this->accessToken,
                    'Accept' => 'application/json',
                ])->get("{$this->baseUrl}/discover/movie", [
                    'with_genres' => $genreId,
                    'page' => $page,
                    'sort_by' => 'popularity.desc',
                ]);

                if ($response->successful()) {
                    return $response->json();
                }

                return ['results' => []];
            } catch (\Exception $e) {
                Log::error('TMDB Movies By Genre Exception', ['error' => $e->getMessage(), 'genre_id' => $genreId]);
                return ['results' => []];
            }
        });
    }

    /**
     * Get movie genres
     */
    public function getMovieGenres(): array
    {
        $cacheKey = 'tmdb_movie_genres';
        
        return Cache::remember($cacheKey, 86400, function () {
            try {
                $response = Http::withoutVerifying()->withHeaders([
                    'Authorization' => 'Bearer ' . $this->accessToken,
                    'Accept' => 'application/json',
                ])->get("{$this->baseUrl}/genre/movie/list");

                if ($response->successful()) {
                    return $response->json();
                }

                return ['genres' => []];
            } catch (\Exception $e) {
                Log::error('TMDB Movie Genres Exception', ['error' => $e->getMessage()]);
                return ['genres' => []];
            }
        });
    }

    /**
     * Get TV genres
     */
    public function getTVGenres(): array
    {
        $cacheKey = 'tmdb_tv_genres';
        
        return Cache::remember($cacheKey, 86400, function () {
            try {
                $response = Http::withoutVerifying()->withHeaders([
                    'Authorization' => 'Bearer ' . $this->accessToken,
                    'Accept' => 'application/json',
                ])->get("{$this->baseUrl}/genre/tv/list");

                if ($response->successful()) {
                    return $response->json();
                }

                return ['genres' => []];
            } catch (\Exception $e) {
                Log::error('TMDB TV Genres Exception', ['error' => $e->getMessage()]);
                return ['genres' => []];
            }
        });
    }

    /**
     * Get full image URL for different sizes
     */
    public function getImageUrl(string $imagePath, string $size = 'w500'): string
    {
        if (empty($imagePath)) {
            return '/images/no-poster.jpg'; // Fallback image
        }
        
        return $this->imageBaseUrl . $size . $imagePath;
    }

    /**
     * Get backdrop image URL
     */
    public function getBackdropUrl(string $backdropPath, string $size = 'w1280'): string
    {
        if (empty($backdropPath)) {
            return '/images/no-backdrop.jpg'; // Fallback image
        }
        
        return $this->imageBaseUrl . $size . $backdropPath;
    }

    /**
     * Format runtime to hours and minutes
     */
    public function formatRuntime(int $minutes): string
    {
        if ($minutes < 60) {
            return $minutes . ' min';
        }
        
        $hours = floor($minutes / 60);
        $remainingMinutes = $minutes % 60;
        
        if ($remainingMinutes === 0) {
            return $hours . 'h';
        }
        
        return $hours . 'h ' . $remainingMinutes . 'min';
    }

    /**
     * Get release year from date
     */
    public function getYear(string $date): string
    {
        if (empty($date)) {
            return 'N/A';
        }
        
        return date('Y', strtotime($date));
    }

    /**
     * Get TV show season details
     */
    public function getTVShowSeasonDetails(int $tvId, int $seasonNumber): ?array
    {
        $cacheKey = "tmdb_tv_{$tvId}_season_{$seasonNumber}";
        
        return Cache::remember($cacheKey, 3600, function () use ($tvId, $seasonNumber) {
            try {
                $response = Http::withoutVerifying()->withHeaders([
                    'Authorization' => 'Bearer ' . $this->accessToken,
                    'Accept' => 'application/json',
                ])->get("{$this->baseUrl}/tv/{$tvId}/season/{$seasonNumber}");

                if ($response->successful()) {
                    return $response->json();
                }

                return null;
            } catch (\Exception $e) {
                Log::error('TMDB TV season details fetch failed', [
                    'tv_id' => $tvId,
                    'season' => $seasonNumber,
                    'error' => $e->getMessage()
                ]);
                return null;
            }
        });
    }
}
