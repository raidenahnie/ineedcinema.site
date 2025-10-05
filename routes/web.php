<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\TVShowController;

Route::get('/', function () {
    return view('landing');
})->name('home');

Route::get('/test', function () {
    return response()->json(['status' => 'working']);
});

Route::get('/test-urls', function () {
    $service = app(\App\Services\VidLinkService::class);
    return [
        'movie_url' => $service->getMovieStreamUrl(941109),
        'tv_url' => $service->getTVStreamUrl(94997, 1, 1),
        'anime_sub_url' => $service->getAnimeStreamUrl(5, 1, true),
        'anime_dub_url' => $service->getAnimeStreamUrl(5, 1, false),
        'anime_sub_fallback' => $service->getAnimeStreamUrlWithFallback(5, 1, true),
    ];
});

// API Routes
Route::prefix('api')->group(function () {
    Route::get('/search', [MovieController::class, 'search']);
    Route::prefix('movies')->group(function () {
        Route::get('/popular', [MovieController::class, 'popular']);
        Route::get('/trending', [MovieController::class, 'trending']);
        Route::get('/now_playing', [MovieController::class, 'nowPlaying']);
        Route::get('/genre/{genreId}', [MovieController::class, 'byGenre']);
        Route::get('/{id}', [MovieController::class, 'show']);
    });
    Route::prefix('tv')->group(function () {
        Route::get('/popular', [TVShowController::class, 'popular']);
    });
    Route::prefix('anime')->group(function () {
        Route::get('/search', [\App\Http\Controllers\AnimeController::class, 'search']);
        Route::get('/popular', [\App\Http\Controllers\AnimeController::class, 'popular']);
        Route::get('/genres', [\App\Http\Controllers\AnimeController::class, 'genres']);
        Route::get('/genre/{genreId}', [\App\Http\Controllers\AnimeController::class, 'byGenre']);
        Route::get('/{id}', [\App\Http\Controllers\AnimeController::class, 'show']);
        Route::get('/{id}/episodes', [\App\Http\Controllers\AnimeController::class, 'episodes']);
    });
});

Route::prefix('watch')->group(function () {
    Route::get('/movie/{id}', [MovieController::class, 'stream'])->name('watch.movie');
    Route::get('/tv/{id}/{season?}/{episode?}', [TVShowController::class, 'stream'])->name('watch.tv');
    Route::get('/anime/{id}', [\App\Http\Controllers\AnimeController::class, 'stream'])->name('watch.anime');
});
