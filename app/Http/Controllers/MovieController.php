<?php

namespace App\Http\Controllers;

use App\Services\TMDBService;
use App\Services\VidLinkService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class MovieController extends Controller
{
    protected TMDBService $tmdbService;
    protected VidLinkService $vidlinkService;

    public function __construct(TMDBService $tmdbService, VidLinkService $vidlinkService)
    {
        $this->tmdbService = $tmdbService;
        $this->vidlinkService = $vidlinkService;
    }

    /**
     * Search for movies and TV shows
     */
    public function search(Request $request): JsonResponse
    {
        $request->validate([
            'query' => 'required|string|min:1|max:255',
            'page' => 'sometimes|integer|min:1|max:1000'
        ]);

        $query = $request->input('query');
        $page = $request->input('page', 1);

        $results = $this->tmdbService->search($query, $page);

        // Process results to add streaming URLs
        if (isset($results['results'])) {
            foreach ($results['results'] as &$item) {
                $item['streaming_url'] = $this->getStreamingUrl($item);
                $item['poster_url'] = $this->tmdbService->getImageUrl($item['poster_path'] ?? '');
                $item['backdrop_url'] = $this->tmdbService->getBackdropUrl($item['backdrop_path'] ?? '');
            }
        }

        return response()->json($results);
    }

    /**
     * Get movie details
     */
    public function show(int $id): JsonResponse
    {
        $movie = $this->tmdbService->getMovieDetails($id);

        if (!$movie) {
            return response()->json(['error' => 'Movie not found'], 404);
        }

        // Add streaming information
        $movie['streaming'] = $this->vidlinkService->getMovieStreamingOptions($id);
        $movie['poster_url'] = $this->tmdbService->getImageUrl($movie['poster_path'] ?? '');
        $movie['backdrop_url'] = $this->tmdbService->getBackdropUrl($movie['backdrop_path'] ?? '');
        $movie['formatted_runtime'] = $this->tmdbService->formatRuntime($movie['runtime'] ?? 0);
        $movie['year'] = $this->tmdbService->getYear($movie['release_date'] ?? '');

        return response()->json($movie);
    }

    /**
     * Get popular movies
     */
    public function popular(Request $request): JsonResponse
    {
        $page = $request->input('page', 1);
        $results = $this->tmdbService->getPopularMovies($page);

        // Process results to add streaming URLs and image URLs
        if (isset($results['results'])) {
            foreach ($results['results'] as &$movie) {
                $movie['streaming_url'] = $this->vidlinkService->getMovieStreamUrl($movie['id']);
                $movie['poster_url'] = $this->tmdbService->getImageUrl($movie['poster_path'] ?? '');
                $movie['backdrop_url'] = $this->tmdbService->getBackdropUrl($movie['backdrop_path'] ?? '');
                $movie['year'] = $this->tmdbService->getYear($movie['release_date'] ?? '');
            }
        }

        return response()->json($results);
    }

    /**
     * Get trending movies and TV shows
     */
    public function trending(Request $request): JsonResponse
    {
        $mediaType = $request->input('media_type', 'all');
        $timeWindow = $request->input('time_window', 'day');
        
        $results = $this->tmdbService->getTrending($mediaType, $timeWindow);

        // Process results to add streaming URLs and image URLs
        if (isset($results['results'])) {
            foreach ($results['results'] as &$item) {
                $item['streaming_url'] = $this->getStreamingUrl($item);
                $item['poster_url'] = $this->tmdbService->getImageUrl($item['poster_path'] ?? '');
                $item['backdrop_url'] = $this->tmdbService->getBackdropUrl($item['backdrop_path'] ?? '');
                
                // Add year based on media type
                if ($item['media_type'] === 'movie') {
                    $item['year'] = $this->tmdbService->getYear($item['release_date'] ?? '');
                } elseif ($item['media_type'] === 'tv') {
                    $item['year'] = $this->tmdbService->getYear($item['first_air_date'] ?? '');
                }
            }
        }

        return response()->json($results);
    }

    /**
     * Get now playing movies
     */
    public function nowPlaying(Request $request): JsonResponse
    {
        $page = $request->input('page', 1);
        $results = $this->tmdbService->getNowPlayingMovies($page);

        // Process results to add streaming URLs and image URLs
        if (isset($results['results'])) {
            foreach ($results['results'] as &$movie) {
                $movie['streaming_url'] = $this->vidlinkService->getMovieStreamUrl($movie['id']);
                $movie['poster_url'] = $this->tmdbService->getImageUrl($movie['poster_path'] ?? '');
                $movie['backdrop_url'] = $this->tmdbService->getBackdropUrl($movie['backdrop_path'] ?? '');
                $movie['year'] = $this->tmdbService->getYear($movie['release_date'] ?? '');
            }
        }

        return response()->json([
            'success' => true,
            'data' => $results['results'] ?? [],
            'pagination' => [
                'page' => $results['page'] ?? 1,
                'total_pages' => $results['total_pages'] ?? 1,
                'total_results' => $results['total_results'] ?? 0
            ]
        ]);
    }

    /**
     * Get movies by genre
     */
    public function byGenre(Request $request, int $genreId): JsonResponse
    {
        $page = $request->input('page', 1);
        $results = $this->tmdbService->getMoviesByGenre($genreId, $page);

        // Process results to add streaming URLs and image URLs
        if (isset($results['results'])) {
            foreach ($results['results'] as &$movie) {
                $movie['streaming_url'] = $this->vidlinkService->getMovieStreamUrl($movie['id']);
                $movie['poster_url'] = $this->tmdbService->getImageUrl($movie['poster_path'] ?? '');
                $movie['backdrop_url'] = $this->tmdbService->getBackdropUrl($movie['backdrop_path'] ?? '');
                $movie['year'] = $this->tmdbService->getYear($movie['release_date'] ?? '');
            }
        }

        return response()->json([
            'success' => true,
            'data' => $results['results'] ?? [],
            'pagination' => [
                'page' => $results['page'] ?? 1,
                'total_pages' => $results['total_pages'] ?? 1,
                'total_results' => $results['total_results'] ?? 0
            ]
        ]);
    }

    /**
     * Get movie genres
     */
    public function genres(): JsonResponse
    {
        $genres = $this->tmdbService->getMovieGenres();
        return response()->json($genres);
    }

    /**
     * Stream movie
     */
    public function stream(string $id)
    {
        try {
            $movie = $this->tmdbService->getMovieDetails($id);
            $embedUrl = $this->vidlinkService->getMovieStreamUrl($id);
            
            return view('stream.movie', compact('movie', 'embedUrl'));
        } catch (\Exception $e) {
            abort(404, 'Movie not found or streaming not available');
        }
    }

    /**
     * Get streaming embed for movie
     */
    public function embed(int $id): JsonResponse
    {
        $embedCode = $this->vidlinkService->getMovieEmbedCode($id, [
            'width' => '100%',
            'height' => '500px',
            'allowfullscreen' => true
        ]);

        return response()->json([
            'embed_code' => $embedCode,
            'stream_url' => $this->vidlinkService->getMovieStreamUrl($id)
        ]);
    }

    /**
     * Helper method to get streaming URL based on media type
     */
    private function getStreamingUrl(array $item): string
    {
        if (isset($item['media_type'])) {
            if ($item['media_type'] === 'movie') {
                return $this->vidlinkService->getMovieStreamUrl($item['id']);
            } elseif ($item['media_type'] === 'tv') {
                return $this->vidlinkService->getTVStreamUrl($item['id'], 1, 1);
            }
        }
        
        // Default to movie if no media_type specified
        return $this->vidlinkService->getMovieStreamUrl($item['id']);
    }
}