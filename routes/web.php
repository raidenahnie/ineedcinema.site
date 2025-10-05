<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\TVShowController;
use App\Http\Controllers\AnimeController;

Route::get('/', function () {
    return view('landing');
})->name('home');

// Dedicated Content Pages
Route::get('/movies', [MovieController::class, 'index'])->name('movies');
Route::get('/tv-shows', [TVShowController::class, 'index'])->name('tv-shows');
Route::get('/anime', [AnimeController::class, 'index'])->name('anime');
Route::get('/search', [MovieController::class, 'searchPage'])->name('search');

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
    Route::prefix('search')->group(function () {
        Route::get('/movies', [MovieController::class, 'searchMovies']);
        Route::get('/tv', [TVShowController::class, 'searchTV']);
        Route::get('/anime', [AnimeController::class, 'searchAnime']);
    });
    Route::prefix('movies')->group(function () {
        Route::get('/popular', [MovieController::class, 'popular']);
        Route::get('/trending', [MovieController::class, 'trending']);
        Route::get('/now_playing', [MovieController::class, 'nowPlaying']);
        Route::get('/genres', [MovieController::class, 'genres']);
        Route::get('/genre/{genreId}', [MovieController::class, 'byGenre']);
        Route::get('/{id}', [MovieController::class, 'show']);
    });
    Route::prefix('tv')->group(function () {
        Route::get('/popular', [TVShowController::class, 'popular']);
        Route::get('/airing_today', [TVShowController::class, 'airingToday']);
        Route::get('/on_the_air', [TVShowController::class, 'onTheAir']);
        Route::get('/genres', [TVShowController::class, 'genres']);
        Route::get('/genre/{genreId}', [TVShowController::class, 'byGenre']);
        Route::get('/{id}', [TVShowController::class, 'show']);
    });
    Route::prefix('anime')->group(function () {
        Route::get('/search', [AnimeController::class, 'search']);
        Route::get('/top', [AnimeController::class, 'top']);
        Route::get('/popular', [AnimeController::class, 'popular']);
        Route::get('/season/now', [AnimeController::class, 'seasonNow']);
        Route::get('/season/upcoming', [AnimeController::class, 'seasonUpcoming']);
        Route::get('/genres', [AnimeController::class, 'genres']);
        Route::get('/genre/{genreId}', [AnimeController::class, 'byGenre']);
        Route::get('/{id}', [AnimeController::class, 'show']);
        Route::get('/{id}/episodes', [AnimeController::class, 'episodes']);
    });
});

Route::prefix('watch')->group(function () {
    Route::get('/movie/{id}', [MovieController::class, 'stream'])->name('watch.movie');
    Route::get('/tv/{id}/{season?}/{episode?}', [TVShowController::class, 'stream'])->name('watch.tv');
    Route::get('/anime/{id}', [\App\Http\Controllers\AnimeController::class, 'stream'])->name('watch.anime');
});
