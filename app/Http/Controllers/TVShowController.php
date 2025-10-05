<?php

namespace App\Http\Controllers;

use App\Services\TMDBService;
use App\Services\VidLinkService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class TVShowController extends Controller
{
    protected TMDBService $tmdbService;
    protected VidLinkService $vidlinkService;

    public function __construct(TMDBService $tmdbService, VidLinkService $vidlinkService)
    {
        $this->tmdbService = $tmdbService;
        $this->vidlinkService = $vidlinkService;
    }

    /**
     * Get TV show details
     */
    public function show(int $id): JsonResponse
    {
        $tvShow = $this->tmdbService->getTVShowDetails($id);

        if (!$tvShow) {
            return response()->json(['error' => 'TV show not found'], 404);
        }

        // Add streaming information for first episode
        $tvShow['streaming'] = $this->vidlinkService->getTVStreamingOptions($id, 1, 1);
        $tvShow['poster_url'] = $this->tmdbService->getImageUrl($tvShow['poster_path'] ?? '');
        $tvShow['backdrop_url'] = $this->tmdbService->getBackdropUrl($tvShow['backdrop_path'] ?? '');
        $tvShow['year'] = $this->tmdbService->getYear($tvShow['first_air_date'] ?? '');

        return response()->json($tvShow);
    }

    /**
     * Get popular TV shows
     */
    public function popular(Request $request): JsonResponse
    {
        $page = $request->input('page', 1);
        $results = $this->tmdbService->getPopularTVShows($page);

        // Process results to add streaming URLs and image URLs
        if (isset($results['results'])) {
            foreach ($results['results'] as &$tvShow) {
                $tvShow['streaming_url'] = $this->vidlinkService->getTVStreamUrl($tvShow['id'], 1, 1);
                $tvShow['poster_url'] = $this->tmdbService->getImageUrl($tvShow['poster_path'] ?? '');
                $tvShow['backdrop_url'] = $this->tmdbService->getBackdropUrl($tvShow['backdrop_path'] ?? '');
                $tvShow['year'] = $this->tmdbService->getYear($tvShow['first_air_date'] ?? '');
            }
        }

        return response()->json($results);
    }

    /**
     * Get TV show genres
     */
    public function genres(): JsonResponse
    {
        $genres = $this->tmdbService->getTVGenres();
        return response()->json($genres);
    }

    /**
     * Stream TV show episode
     */
    public function stream(string $id, ?string $season = '1', ?string $episode = '1')
    {
        try {
            $show = $this->tmdbService->getTVShowDetails($id);
            
            if (!$show) {
                abort(404, 'TV show not found');
            }
            
            $seasonDetails = $this->tmdbService->getTVShowSeasonDetails($id, (int)$season);
            $embedUrl = $this->vidlinkService->getTVStreamUrl($id, (int)$season, (int)$episode);
            
            $currentEpisode = null;
            $episodes = [];
            
            if ($seasonDetails && isset($seasonDetails['episodes'])) {
                $episodes = $seasonDetails['episodes'];
                $currentEpisode = collect($episodes)->firstWhere('episode_number', (int)$episode);
            }
            
            return view('stream.tv', compact('show', 'embedUrl', 'season', 'episode', 'currentEpisode', 'episodes'));
        } catch (\Exception $e) {
            abort(404, 'TV show not found or streaming not available: ' . $e->getMessage());
        }
    }

    /**
     * TV Shows index page
     */
    public function index()
    {
        return view('tv-shows');
    }

    /**
     * Search only TV shows
     */
    public function searchTV(Request $request): JsonResponse
    {
        $request->validate([
            'q' => 'required|string|min:1|max:255',
            'page' => 'sometimes|integer|min:1|max:1000'
        ]);

        $query = $request->input('q');
        $page = $request->input('page', 1);

        $results = $this->tmdbService->search($query, $page);
        
        // Filter to only TV shows
        if (isset($results['results'])) {
            $results['results'] = array_filter($results['results'], function($item) {
                return ($item['media_type'] ?? 'tv') === 'tv';
            });
            $results['results'] = array_values($results['results']); // Re-index array
        }

        // Process results to add streaming URLs
        if (isset($results['results'])) {
            foreach ($results['results'] as &$tvShow) {
                $tvShow['streaming_url'] = $this->vidlinkService->getTVStreamUrl($tvShow['id'], 1, 1);
                $tvShow['poster_url'] = $this->tmdbService->getImageUrl($tvShow['poster_path'] ?? '');
                $tvShow['backdrop_url'] = $this->tmdbService->getBackdropUrl($tvShow['backdrop_path'] ?? '');
                $tvShow['year'] = $this->tmdbService->getYear($tvShow['first_air_date'] ?? '');
            }
        }

        return response()->json($results);
    }

    /**
     * Get TV shows airing today
     */
    public function airingToday(Request $request): JsonResponse
    {
        $page = $request->input('page', 1);
        // Use popular TV shows as a fallback since we don't have the specific method
        $results = $this->tmdbService->getPopularTVShows($page);

        // Process results to add streaming URLs and image URLs
        if (isset($results['results'])) {
            foreach ($results['results'] as &$tvShow) {
                $tvShow['streaming_url'] = $this->vidlinkService->getTVStreamUrl($tvShow['id'], 1, 1);
                $tvShow['poster_url'] = $this->tmdbService->getImageUrl($tvShow['poster_path'] ?? '');
                $tvShow['backdrop_url'] = $this->tmdbService->getBackdropUrl($tvShow['backdrop_path'] ?? '');
                $tvShow['year'] = $this->tmdbService->getYear($tvShow['first_air_date'] ?? '');
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
     * Get TV shows currently on the air
     */
    public function onTheAir(Request $request): JsonResponse
    {
        $page = $request->input('page', 1);
        // Use popular TV shows as a fallback since we don't have the specific method
        $results = $this->tmdbService->getPopularTVShows($page);

        // Process results to add streaming URLs and image URLs
        if (isset($results['results'])) {
            foreach ($results['results'] as &$tvShow) {
                $tvShow['streaming_url'] = $this->vidlinkService->getTVStreamUrl($tvShow['id'], 1, 1);
                $tvShow['poster_url'] = $this->tmdbService->getImageUrl($tvShow['poster_path'] ?? '');
                $tvShow['backdrop_url'] = $this->tmdbService->getBackdropUrl($tvShow['backdrop_path'] ?? '');
                $tvShow['year'] = $this->tmdbService->getYear($tvShow['first_air_date'] ?? '');
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
     * Get TV shows by genre
     */
    public function byGenre(Request $request, int $genreId): JsonResponse
    {
        $page = $request->input('page', 1);
        // Use popular TV shows as a fallback since we don't have the specific method
        $results = $this->tmdbService->getPopularTVShows($page);

        // Process results to add streaming URLs and image URLs
        if (isset($results['results'])) {
            foreach ($results['results'] as &$tvShow) {
                $tvShow['streaming_url'] = $this->vidlinkService->getTVStreamUrl($tvShow['id'], 1, 1);
                $tvShow['poster_url'] = $this->tmdbService->getImageUrl($tvShow['poster_path'] ?? '');
                $tvShow['backdrop_url'] = $this->tmdbService->getBackdropUrl($tvShow['backdrop_path'] ?? '');
                $tvShow['year'] = $this->tmdbService->getYear($tvShow['first_air_date'] ?? '');
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
     * Get streaming embed for TV show episode
     */
    public function embed(int $id, int $season = 1, int $episode = 1): JsonResponse
    {
        $embedCode = $this->vidlinkService->getTVEmbedCode($id, $season, $episode, [
            'width' => '100%',
            'height' => '500px',
            'allowfullscreen' => true
        ]);

        return response()->json([
            'embed_code' => $embedCode,
            'stream_url' => $this->vidlinkService->getTVStreamUrl($id, $season, $episode),
            'season' => $season,
            'episode' => $episode
        ]);
    }
}