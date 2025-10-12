<?php

namespace App\Http\Controllers;

use App\Services\TMDBService;
use App\Services\VidLinkService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class SearchController extends Controller
{
    protected TMDBService $tmdbService;
    protected VidLinkService $vidlinkService;

    public function __construct(TMDBService $tmdbService, VidLinkService $vidlinkService)
    {
        $this->tmdbService = $tmdbService;
        $this->vidlinkService = $vidlinkService;
    }

    /**
     * Unified fast search - searches everything at once
     */
    public function unifiedSearch(Request $request): JsonResponse
    {
        $request->validate([
            'q' => 'required|string|min:1|max:255'
        ]);

        $query = $request->input('q');

        try {
            // Use TMDB's multi-search endpoint (searches movies + TV in one call)
            $results = $this->tmdbService->multiSearch($query);
            
            $movies = [];
            $tvShows = [];
            $anime = [];
            
            if (isset($results['results'])) {
                foreach ($results['results'] as $item) {
                    // Skip people/person results
                    if ($item['media_type'] === 'person') {
                        continue;
                    }
                    
                    // Movies
                    if ($item['media_type'] === 'movie') {
                        $movies[] = $item;
                    }
                    
                    // TV Shows and Anime
                    if ($item['media_type'] === 'tv') {
                        // Check if it's anime (Animation genre + Asian origin)
                        $isAnime = false;
                        
                        // Check for Animation genre (16)
                        if (isset($item['genre_ids']) && in_array(16, $item['genre_ids'])) {
                            // Check origin country
                            $animeOrigins = ['JP', 'KR', 'CN', 'TW', 'HK', 'TH'];
                            if (isset($item['origin_country']) && is_array($item['origin_country'])) {
                                $isAnime = count(array_intersect($item['origin_country'], $animeOrigins)) > 0;
                            }
                            
                            // Check original language as fallback
                            if (!$isAnime && isset($item['original_language'])) {
                                $isAnime = in_array($item['original_language'], ['ja', 'ko', 'zh']);
                            }
                        }
                        
                        if ($isAnime) {
                            $anime[] = $item;
                        } else {
                            $tvShows[] = $item;
                        }
                    }
                }
            }
            
            return response()->json([
                'movies' => array_slice($movies, 0, 3),
                'tvShows' => array_slice($tvShows, 0, 3),
                'anime' => array_slice($anime, 0, 3),
                'total' => count($movies) + count($tvShows) + count($anime)
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Search failed',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
