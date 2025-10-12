<?php

namespace App\Http\Controllers;

use App\Services\VidLinkService;
use App\Services\TMDBService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class AnimeController extends Controller
{
    protected VidLinkService $vidlinkService;
    protected TMDBService $tmdbService;

    public function __construct(VidLinkService $vidlinkService, TMDBService $tmdbService)
    {
        $this->vidlinkService = $vidlinkService;
        $this->tmdbService = $tmdbService;
    }

    /**
     * Search for anime using TMDB (anime are TV shows with Animation genre)
     */
    public function search(Request $request): JsonResponse
    {
        $request->validate([
            'q' => 'required|string|min:1|max:255',
            'page' => 'sometimes|integer|min:1|max:100'
        ]);

        $query = $request->input('q');
        $page = $request->input('page', 1);

        try {
            // Search TMDB for TV shows
            $results = $this->tmdbService->searchTVShows($query, $page);
            
            // Filter for anime (animation genre + Japanese/Asian origin)
            if (isset($results['results'])) {
                $results['results'] = array_filter($results['results'], function($show) {
                    // Must have Animation genre (16)
                    if (!isset($show['genre_ids']) || !in_array(16, $show['genre_ids'])) {
                        return false;
                    }
                    
                    // Filter by Japanese/Asian origin countries
                    $animeOrigins = ['JP', 'KR', 'CN', 'TW', 'HK', 'TH']; // Japan, Korea, China, Taiwan, Hong Kong, Thailand
                    if (isset($show['origin_country']) && is_array($show['origin_country'])) {
                        return count(array_intersect($show['origin_country'], $animeOrigins)) > 0;
                    }
                    
                    // If no origin country, check original language (ja = Japanese, ko = Korean, zh = Chinese)
                    if (isset($show['original_language'])) {
                        return in_array($show['original_language'], ['ja', 'ko', 'zh']);
                    }
                    
                    return false;
                });
                
                // Re-index array after filtering
                $results['results'] = array_values($results['results']);
                
                // Add streaming URLs
                foreach ($results['results'] as &$show) {
                    $show['streaming_url'] = $this->vidlinkService->getTVStreamUrl($show['id'], 1, 1);
                }
            }

            return response()->json($results);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Service unavailable'], 503);
        }
    }

    /**
     * Get anime details by TMDB ID
     */
    public function show(int $id): JsonResponse
    {
        try {
            $anime = $this->tmdbService->getTVShowDetails($id);
            
            if ($anime) {
                // Add streaming information
                $anime['streaming'] = [
                    'url' => $this->vidlinkService->getTVStreamUrl($id, 1, 1),
                ];
                
                return response()->json($anime);
            }

            return response()->json(['error' => 'Anime not found'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Service unavailable'], 503);
        }
    }

    /**
     * Get popular anime (using TMDB Animation genre + Asian origins)
     */
    public function popular(Request $request): JsonResponse
    {
        $page = $request->input('page', 1);

        try {
            // Get popular TV shows with Animation genre (16) from Japan/Asia
            $results = $this->tmdbService->discoverTV([
                'with_genres' => 16, // Animation
                'with_origin_country' => 'JP|KR|CN|TW|HK|TH', // Japan, Korea, China, Taiwan, Hong Kong, Thailand
                'sort_by' => 'popularity.desc',
                'page' => $page
            ]);
            
            // Add streaming URLs
            if (isset($results['results'])) {
                foreach ($results['results'] as &$show) {
                    $show['streaming_url'] = $this->vidlinkService->getTVStreamUrl($show['id'], 1, 1);
                }
            }

            return response()->json($results);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Service unavailable'], 503);
        }
    }

    /**
     * Get anime by genre (TMDB genre IDs + Asian origins)
     */
    public function byGenre(Request $request, int $genreId): JsonResponse
    {
        $page = $request->input('page', 1);

        try {
            // Get TV shows with Animation (16) + specified genre from Japan/Asia
            $results = $this->tmdbService->discoverTV([
                'with_genres' => "16,{$genreId}", // Animation + specified genre
                'with_origin_country' => 'JP|KR|CN|TW|HK|TH',
                'sort_by' => 'popularity.desc',
                'page' => $page
            ]);
            
            // Add streaming URLs
            if (isset($results['results'])) {
                foreach ($results['results'] as &$show) {
                    $show['streaming_url'] = $this->vidlinkService->getTVStreamUrl($show['id'], 1, 1);
                }
            }

            return response()->json([
                'success' => true,
                'data' => $results['results'] ?? [],
                'pagination' => [
                    'current_page' => $results['page'] ?? 1,
                    'total_pages' => $results['total_pages'] ?? 1,
                    'total_results' => $results['total_results'] ?? 0
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Service unavailable'], 503);
        }
    }

    /**
     * Get anime genres (TMDB TV genres)
     */
    public function genres(): JsonResponse
    {
        try {
            // Return TMDB TV genres - these can be combined with Animation (16)
            $genres = [
                ['id' => 16, 'name' => 'Animation'],
                ['id' => 10759, 'name' => 'Action & Adventure'],
                ['id' => 35, 'name' => 'Comedy'],
                ['id' => 18, 'name' => 'Drama'],
                ['id' => 10751, 'name' => 'Family'],
                ['id' => 10762, 'name' => 'Kids'],
                ['id' => 9648, 'name' => 'Mystery'],
                ['id' => 10765, 'name' => 'Sci-Fi & Fantasy'],
                ['id' => 10768, 'name' => 'War & Politics'],
                ['id' => 37, 'name' => 'Western']
            ];

            return response()->json([
                'success' => true,
                'data' => $genres
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Service unavailable'], 503);
        }
    }

    /**
     * Get filtered anime (TMDB-based + Asian origins)
     */
    public function filter(Request $request): JsonResponse
    {
        $page = $request->input('page', 1);
        $genres = $request->input('genres'); // TMDB genre IDs
        $sortBy = $request->input('sort_by', 'popularity.desc');
        $year = $request->input('year');
        $minRating = $request->input('min_rating');

        try {
            $params = [
                'with_genres' => 16, // Always include Animation
                'with_origin_country' => 'JP|KR|CN|TW|HK|TH', // Asian origins
                'sort_by' => $sortBy,
                'page' => $page
            ];

            // Add additional genre filters
            if ($genres) {
                $params['with_genres'] = "16,{$genres}"; // Combine Animation with other genres
            }

            // Add year filter
            if ($year) {
                $params['first_air_date_year'] = $year;
            }

            // Add rating filter
            if ($minRating) {
                $params['vote_average.gte'] = $minRating;
            }

            $results = $this->tmdbService->discoverTV($params);
            
            // Add streaming URLs
            if (isset($results['results'])) {
                foreach ($results['results'] as &$show) {
                    $show['streaming_url'] = $this->vidlinkService->getTVStreamUrl($show['id'], 1, 1);
                }
            }

            return response()->json([
                'success' => true,
                'data' => $results['results'] ?? [],
                'pagination' => [
                    'current_page' => $results['page'] ?? 1,
                    'total_pages' => $results['total_pages'] ?? 1,
                    'total_results' => $results['total_results'] ?? 0
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Service unavailable'], 503);
        }
    }

    /**
     * Stream anime (using TMDB TV show ID)
     */
    public function stream(string $id, Request $request)
    {
        $episode = $request->input('episode', 1);
        $season = $request->input('season', 1);

        try {
            // Get TV show details from TMDB (id is now TMDB ID directly)
            $anime = $this->tmdbService->getTVShowDetails($id);
            
            if (!$anime) {
                abort(404, 'Anime not found');
            }
            
            // Get season details with episodes
            $seasonDetails = $this->tmdbService->getTVShowSeasonDetails($id, (int)$season);
            
            // Generate VidLink URL using TMDB TV show ID
            $embedUrl = $this->vidlinkService->getTVStreamUrl($id, (int)$season, (int)$episode);
            
            $currentEpisode = null;
            $episodes = [];
            
            if ($seasonDetails && isset($seasonDetails['episodes'])) {
                $episodes = $seasonDetails['episodes'];
                $currentEpisode = collect($episodes)->firstWhere('episode_number', (int)$episode);
            }
            
            return view('stream.anime', compact('anime', 'embedUrl', 'episode', 'season', 'currentEpisode', 'episodes'));
        } catch (\Exception $e) {
            abort(404, 'Anime not found or streaming not available: ' . $e->getMessage());
        }
    }

    /**
     * Anime index page
     */
    public function index()
    {
        return view('anime');
    }

    /**
     * Search only anime
     */
    public function searchAnime(Request $request): JsonResponse
    {
        // This is the same as the existing search method
        return $this->search($request);
    }

    /**
     * Get top anime (TMDB top-rated animation)
     */
    public function top(Request $request): JsonResponse
    {
        $page = $request->input('page', 1);
        $filter = $request->input('filter', ''); // Can be 'airing', 'upcoming', 'bypopularity', 'favorite'

        try {
            $params = [
                'with_genres' => 16, // Animation genre
                'with_origin_country' => 'JP|KR|CN|TW|HK|TH', // Asian origins
                'page' => $page
            ];

            // Map filters to TMDB sorting
            switch ($filter) {
                case 'airing':
                    $params['sort_by'] = 'first_air_date.desc';
                    $params['air_date.lte'] = date('Y-m-d');
                    break;
                case 'upcoming':
                    $params['sort_by'] = 'first_air_date.asc';
                    $params['air_date.gte'] = date('Y-m-d');
                    break;
                case 'bypopularity':
                    $params['sort_by'] = 'popularity.desc';
                    break;
                case 'favorite':
                default:
                    $params['sort_by'] = 'vote_average.desc';
                    $params['vote_count.gte'] = 100; // Minimum votes for relevance
                    break;
            }

            $results = $this->tmdbService->discoverTV($params);
            
            // Add streaming URLs
            if (isset($results['results'])) {
                foreach ($results['results'] as &$show) {
                    $show['streaming_url'] = $this->vidlinkService->getTVStreamUrl($show['id'], 1, 1);
                }
            }

            return response()->json([
                'success' => true,
                'data' => $results['results'] ?? [],
                'pagination' => [
                    'current_page' => $results['page'] ?? 1,
                    'total_pages' => $results['total_pages'] ?? 1,
                    'total_results' => $results['total_results'] ?? 0
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Service unavailable'], 503);
        }
    }

    /**
     * Get current season anime (TMDB recent animation from Asia)
     */
    public function seasonNow(Request $request): JsonResponse
    {
        $page = $request->input('page', 1);

        try {
            // Get animation shows from this year from Japan/Asia
            $results = $this->tmdbService->discoverTV([
                'with_genres' => 16, // Animation genre
                'with_origin_country' => 'JP|KR|CN|TW|HK|TH',
                'first_air_date.gte' => date('Y') . '-01-01', // This year
                'sort_by' => 'popularity.desc',
                'page' => $page
            ]);
            
            // Add streaming URLs
            if (isset($results['results'])) {
                foreach ($results['results'] as &$show) {
                    $show['streaming_url'] = $this->vidlinkService->getTVStreamUrl($show['id'], 1, 1);
                }
            }

            return response()->json([
                'success' => true,
                'data' => $results['results'] ?? [],
                'pagination' => [
                    'current_page' => $results['page'] ?? 1,
                    'total_pages' => $results['total_pages'] ?? 1,
                    'total_results' => $results['total_results'] ?? 0
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Service unavailable'], 503);
        }
    }

    /**
     * Get upcoming season anime (TMDB upcoming animation from Asia)
     */
    public function seasonUpcoming(Request $request): JsonResponse
    {
        $page = $request->input('page', 1);

        try {
            // Get upcoming animation shows from Japan/Asia
            $results = $this->tmdbService->discoverTV([
                'with_genres' => 16, // Animation genre
                'with_origin_country' => 'JP|KR|CN|TW|HK|TH',
                'first_air_date.gte' => date('Y-m-d'), // From today onwards
                'sort_by' => 'first_air_date.asc',
                'page' => $page
            ]);
            
            // Add streaming URLs
            if (isset($results['results'])) {
                foreach ($results['results'] as &$show) {
                    $show['streaming_url'] = $this->vidlinkService->getTVStreamUrl($show['id'], 1, 1);
                }
            }

            return response()->json([
                'success' => true,
                'data' => $results['results'] ?? [],
                'pagination' => [
                    'current_page' => $results['page'] ?? 1,
                    'total_pages' => $results['total_pages'] ?? 1,
                    'total_results' => $results['total_results'] ?? 0
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Service unavailable'], 503);
        }
    }

    /**
     * Get anime episodes from TMDB (TV show seasons/episodes)
     */
    public function episodes(int $id): JsonResponse
    {
        try {
            // Get TV show details from TMDB
            $show = $this->tmdbService->getTVShowDetails($id);
            
            if (!$show || !isset($show['seasons'])) {
                return response()->json(['error' => 'Episodes not found'], 404);
            }
            
            // Format seasons and episodes data
            $seasonsData = [];
            foreach ($show['seasons'] as $season) {
                if ($season['season_number'] > 0) { // Skip specials (season 0)
                    $seasonsData[] = [
                        'season_number' => $season['season_number'],
                        'episode_count' => $season['episode_count'],
                        'name' => $season['name'],
                        'air_date' => $season['air_date'] ?? null,
                        'poster_path' => $season['poster_path'] ? $this->tmdbService->getImageUrl($season['poster_path']) : null,
                    ];
                }
            }

            return response()->json([
                'success' => true,
                'data' => [
                    'id' => $show['id'],
                    'name' => $show['name'],
                    'seasons' => $seasonsData,
                    'number_of_seasons' => $show['number_of_seasons'] ?? 0,
                    'number_of_episodes' => $show['number_of_episodes'] ?? 0,
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Service unavailable'], 503);
        }
    }
}