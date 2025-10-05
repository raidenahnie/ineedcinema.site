<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;

class VidLinkService
{
    private string $baseUrl;

    public function __construct()
    {
        $this->baseUrl = config('services.vidlink.base_url', 'https://vidlink.pro');
    }

    /**
     * Generate movie streaming URL using TMDB ID
     */
    public function getMovieStreamUrl(int $tmdbId): string
    {
        return "{$this->baseUrl}/movie/{$tmdbId}?autoplay=1&muted=0&sound=1";
    }

    /**
     * Generate TV show streaming URL using TMDB ID
     */
    public function getTVStreamUrl(int $tmdbId, int $season = 1, int $episode = 1): string
    {
        return "{$this->baseUrl}/tv/{$tmdbId}/{$season}/{$episode}?autoplay=1&muted=0&sound=1";
    }

    /**
     * Generate anime streaming URL using MyAnimeList ID
     */
    public function getAnimeStreamUrl(int $malId, int $episode = 1, bool $subOrDub = true): string
    {
        $type = $subOrDub ? 'sub' : 'dub';
        return "{$this->baseUrl}/anime/{$malId}/{$episode}/{$type}?autoplay=1&muted=0&sound=1";
    }

    /**
     * Generate anime streaming URL with fallback support
     */
    public function getAnimeStreamUrlWithFallback(int $malId, int $episode = 1, bool $subOrDub = true): string
    {
        $type = $subOrDub ? 'sub' : 'dub';
        return "{$this->baseUrl}/anime/{$malId}/{$episode}/{$type}?fallback=true&autoplay=1&muted=0&sound=1";
    }

    /**
     * Generate iframe embed code for movie
     */
    public function getMovieEmbedCode(int $tmdbId, array $options = []): string
    {
        $url = $this->getMovieStreamUrl($tmdbId);
        
        $width = $options['width'] ?? '100%';
        $height = $options['height'] ?? '500px';
        $allowfullscreen = $options['allowfullscreen'] ?? true;
        $frameborder = $options['frameborder'] ?? '0';

        $allowfullscreenAttr = $allowfullscreen ? 'allowfullscreen' : '';

        return "<iframe src=\"{$url}\" width=\"{$width}\" height=\"{$height}\" frameborder=\"{$frameborder}\" {$allowfullscreenAttr}></iframe>";
    }

    /**
     * Generate iframe embed code for TV show
     */
    public function getTVEmbedCode(int $tmdbId, int $season = 1, int $episode = 1, array $options = []): string
    {
        $url = $this->getTVStreamUrl($tmdbId, $season, $episode);
        
        $width = $options['width'] ?? '100%';
        $height = $options['height'] ?? '500px';
        $allowfullscreen = $options['allowfullscreen'] ?? true;
        $frameborder = $options['frameborder'] ?? '0';

        $allowfullscreenAttr = $allowfullscreen ? 'allowfullscreen' : '';

        return "<iframe src=\"{$url}\" width=\"{$width}\" height=\"{$height}\" frameborder=\"{$frameborder}\" {$allowfullscreenAttr}></iframe>";
    }

    /**
     * Generate iframe embed code for anime
     */
    public function getAnimeEmbedCode(int $malId, int $episode = 1, bool $subOrDub = true, array $options = []): string
    {
        $url = $this->getAnimeStreamUrl($malId, $episode, $subOrDub);
        
        $width = $options['width'] ?? '100%';
        $height = $options['height'] ?? '500px';
        $allowfullscreen = $options['allowfullscreen'] ?? true;
        $frameborder = $options['frameborder'] ?? '0';

        $allowfullscreenAttr = $allowfullscreen ? 'allowfullscreen' : '';

        return "<iframe src=\"{$url}\" width=\"{$width}\" height=\"{$height}\" frameborder=\"{$frameborder}\" {$allowfullscreenAttr}></iframe>";
    }

    /**
     * Check if streaming is available (basic URL validation)
     */
    public function isStreamingAvailable(string $url): bool
    {
        try {
            // Basic URL validation
            return filter_var($url, FILTER_VALIDATE_URL) !== false;
        } catch (\Exception $e) {
            Log::error('VidLink availability check failed', ['error' => $e->getMessage(), 'url' => $url]);
            return false;
        }
    }

    /**
     * Get streaming options for a movie
     */
    public function getMovieStreamingOptions(int $tmdbId): array
    {
        return [
            'primary' => $this->getMovieStreamUrl($tmdbId),
            'embed_code' => $this->getMovieEmbedCode($tmdbId),
            'available' => true,
            'type' => 'movie'
        ];
    }

    /**
     * Get streaming options for a TV show
     */
    public function getTVStreamingOptions(int $tmdbId, int $season = 1, int $episode = 1): array
    {
        return [
            'primary' => $this->getTVStreamUrl($tmdbId, $season, $episode),
            'embed_code' => $this->getTVEmbedCode($tmdbId, $season, $episode),
            'available' => true,
            'type' => 'tv',
            'season' => $season,
            'episode' => $episode
        ];
    }

    /**
     * Get streaming options for anime
     */
    public function getAnimeStreamingOptions(int $malId, int $episode = 1, bool $subOrDub = true): array
    {
        return [
            'primary' => $this->getAnimeStreamUrl($malId, $episode, $subOrDub),
            'fallback' => $this->getAnimeStreamUrlWithFallback($malId, $episode, $subOrDub),
            'embed_code' => $this->getAnimeEmbedCode($malId, $episode, $subOrDub),
            'available' => true,
            'type' => 'anime',
            'episode' => $episode,
            'language' => $subOrDub ? 'sub' : 'dub'
        ];
    }

    /**
     * Generate multiple quality options if needed
     */
    public function getQualityOptions(int $tmdbId, string $type = 'movie'): array
    {
        $baseUrl = $type === 'movie' 
            ? $this->getMovieStreamUrl($tmdbId)
            : $this->getTVStreamUrl($tmdbId);

        return [
            'auto' => $baseUrl,
            'hd' => $baseUrl,
            '720p' => $baseUrl,
            '480p' => $baseUrl,
        ];
    }
}