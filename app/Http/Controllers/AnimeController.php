<?php

namespace App\Http\Controllers;

use App\Services\VidLinkService;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Http;

class AnimeController extends Controller
{
    protected VidLinkService $vidlinkService;

    public function __construct(VidLinkService $vidlinkService)
    {
        $this->vidlinkService = $vidlinkService;
    }

    /**
     * Search for anime using Jikan API (free MyAnimeList API)
     */
    public function search(Request $request): JsonResponse
    {
        $request->validate([
            'query' => 'required|string|min:1|max:255',
            'page' => 'sometimes|integer|min:1|max:100'
        ]);

        $query = $request->input('query');
        $page = $request->input('page', 1);

        try {
            $response = Http::get('https://api.jikan.moe/v4/anime', [
                'q' => $query,
                'page' => $page,
                'limit' => 25
            ]);

            if ($response->successful()) {
                $data = $response->json();
                
                // Process results to add VidLink streaming URLs
                if (isset($data['data'])) {
                    foreach ($data['data'] as &$anime) {
                        $anime['streaming_url'] = $this->vidlinkService->getAnimeStreamUrl($anime['mal_id'], 1);
                        $anime['streaming_url_fallback'] = $this->vidlinkService->getAnimeStreamUrlWithFallback($anime['mal_id'], 1);
                    }
                }

                return response()->json($data);
            }

            return response()->json(['error' => 'Failed to fetch anime data'], 500);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Search service unavailable'], 503);
        }
    }

    /**
     * Get anime details by MAL ID
     */
    public function show(int $id): JsonResponse
    {
        try {
            $response = Http::get("https://api.jikan.moe/v4/anime/{$id}");

            if ($response->successful()) {
                $anime = $response->json()['data'];
                
                // Add VidLink streaming information
                $anime['streaming'] = [
                    'sub' => $this->vidlinkService->getAnimeStreamUrl($id, 1, true),
                    'dub' => $this->vidlinkService->getAnimeStreamUrl($id, 1, false),
                    'sub_fallback' => $this->vidlinkService->getAnimeStreamUrlWithFallback($id, 1, true),
                    'dub_fallback' => $this->vidlinkService->getAnimeStreamUrlWithFallback($id, 1, false),
                ];

                return response()->json($anime);
            }

            return response()->json(['error' => 'Anime not found'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Service unavailable'], 503);
        }
    }

    /**
     * Get popular anime
     */
    public function popular(Request $request): JsonResponse
    {
        $page = $request->input('page', 1);

        try {
            $response = Http::get('https://api.jikan.moe/v4/top/anime', [
                'page' => $page,
                'limit' => 25
            ]);

            if ($response->successful()) {
                $data = $response->json();
                
                // Process results to add streaming URLs
                if (isset($data['data'])) {
                    foreach ($data['data'] as &$anime) {
                        $anime['streaming_url'] = $this->vidlinkService->getAnimeStreamUrl($anime['mal_id'], 1);
                        $anime['streaming_url_fallback'] = $this->vidlinkService->getAnimeStreamUrlWithFallback($anime['mal_id'], 1);
                    }
                }

                return response()->json($data);
            }

            return response()->json(['error' => 'Failed to fetch popular anime'], 500);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Service unavailable'], 503);
        }
    }

    /**
     * Get anime by genre
     */
    public function byGenre(Request $request, int $genreId): JsonResponse
    {
        $page = $request->input('page', 1);

        try {
            $response = Http::get('https://api.jikan.moe/v4/anime', [
                'genres' => $genreId,
                'page' => $page,
                'limit' => 25
            ]);

            if ($response->successful()) {
                $data = $response->json();
                
                // Process results to add streaming URLs
                if (isset($data['data'])) {
                    foreach ($data['data'] as &$anime) {
                        $anime['streaming_url'] = $this->vidlinkService->getAnimeStreamUrl($anime['mal_id'], 1);
                        $anime['streaming_url_fallback'] = $this->vidlinkService->getAnimeStreamUrlWithFallback($anime['mal_id'], 1);
                    }
                }

                return response()->json($data);
            }

            return response()->json(['error' => 'Failed to fetch anime by genre'], 500);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Service unavailable'], 503);
        }
    }

    /**
     * Get anime genres
     */
    public function genres(): JsonResponse
    {
        try {
            $response = Http::get('https://api.jikan.moe/v4/genres/anime');

            if ($response->successful()) {
                return response()->json($response->json());
            }

            return response()->json(['error' => 'Failed to fetch genres'], 500);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Service unavailable'], 503);
        }
    }

    /**
     * Stream anime
     */
    public function stream(string $id, Request $request)
    {
        $episode = $request->input('episode', 1);
        $type = $request->input('type', 'sub'); // 'sub' or 'dub'
        $fallback = $request->input('fallback', false);

        try {
            // Get anime details from Jikan API
            $response = Http::get("https://api.jikan.moe/v4/anime/{$id}");
            
            if (!$response->successful()) {
                abort(404, 'Anime not found');
            }

            $responseData = $response->json();
            
            if (!isset($responseData['data'])) {
                abort(404, 'Anime data not found');
            }
            
            $anime = $responseData['data'];
            
            // Generate VidLink embed URL
            if ($fallback) {
                $embedUrl = $this->vidlinkService->getAnimeStreamUrlWithFallback(
                    (int)$id, 
                    (int)$episode, 
                    $type === 'sub'
                );
            } else {
                $embedUrl = $this->vidlinkService->getAnimeStreamUrl(
                    (int)$id, 
                    (int)$episode, 
                    $type === 'sub'
                );
            }
            
            return view('stream.anime', compact('anime', 'embedUrl', 'episode', 'type'));
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
     * Get top anime
     */
    public function top(Request $request): JsonResponse
    {
        $page = $request->input('page', 1);
        $filter = $request->input('filter', ''); // Can be 'airing', 'upcoming', 'bypopularity', 'favorite'

        try {
            $params = [
                'page' => $page,
                'limit' => 25
            ];

            if ($filter) {
                $params['filter'] = $filter;
            }

            $response = Http::get('https://api.jikan.moe/v4/top/anime', $params);

            if ($response->successful()) {
                $data = $response->json();
                
                // Process results to add streaming URLs
                if (isset($data['data'])) {
                    foreach ($data['data'] as &$anime) {
                        $anime['streaming_url'] = $this->vidlinkService->getAnimeStreamUrl($anime['mal_id'], 1);
                        $anime['streaming_url_fallback'] = $this->vidlinkService->getAnimeStreamUrlWithFallback($anime['mal_id'], 1);
                    }
                }

                return response()->json($data);
            }

            return response()->json(['error' => 'Failed to fetch top anime'], 500);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Service unavailable'], 503);
        }
    }

    /**
     * Get current season anime
     */
    public function seasonNow(Request $request): JsonResponse
    {
        $page = $request->input('page', 1);

        try {
            $response = Http::get('https://api.jikan.moe/v4/seasons/now', [
                'page' => $page,
                'limit' => 25
            ]);

            if ($response->successful()) {
                $data = $response->json();
                
                // Process results to add streaming URLs
                if (isset($data['data'])) {
                    foreach ($data['data'] as &$anime) {
                        $anime['streaming_url'] = $this->vidlinkService->getAnimeStreamUrl($anime['mal_id'], 1);
                        $anime['streaming_url_fallback'] = $this->vidlinkService->getAnimeStreamUrlWithFallback($anime['mal_id'], 1);
                    }
                }

                return response()->json($data);
            }

            return response()->json(['error' => 'Failed to fetch current season anime'], 500);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Service unavailable'], 503);
        }
    }

    /**
     * Get upcoming season anime
     */
    public function seasonUpcoming(Request $request): JsonResponse
    {
        $page = $request->input('page', 1);

        try {
            $response = Http::get('https://api.jikan.moe/v4/seasons/upcoming', [
                'page' => $page,
                'limit' => 25
            ]);

            if ($response->successful()) {
                $data = $response->json();
                
                // Process results to add streaming URLs
                if (isset($data['data'])) {
                    foreach ($data['data'] as &$anime) {
                        $anime['streaming_url'] = $this->vidlinkService->getAnimeStreamUrl($anime['mal_id'], 1);
                        $anime['streaming_url_fallback'] = $this->vidlinkService->getAnimeStreamUrlWithFallback($anime['mal_id'], 1);
                    }
                }

                return response()->json($data);
            }

            return response()->json(['error' => 'Failed to fetch upcoming anime'], 500);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Service unavailable'], 503);
        }
    }

    /**
     * Get anime episodes (if available from API)
     */
    public function episodes(int $id): JsonResponse
    {
        try {
            $response = Http::get("https://api.jikan.moe/v4/anime/{$id}/episodes");

            if ($response->successful()) {
                $data = $response->json();
                
                // Add streaming URLs for each episode
                if (isset($data['data'])) {
                    foreach ($data['data'] as &$episode) {
                        $episodeNumber = $episode['mal_id'] ?? 1;
                        $episode['streaming'] = [
                            'sub' => $this->vidlinkService->getAnimeStreamUrl($id, $episodeNumber, true),
                            'dub' => $this->vidlinkService->getAnimeStreamUrl($id, $episodeNumber, false),
                        ];
                    }
                }

                return response()->json($data);
            }

            return response()->json(['error' => 'Episodes not found'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Service unavailable'], 503);
        }
    }
}