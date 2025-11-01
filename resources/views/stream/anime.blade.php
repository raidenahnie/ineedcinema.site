@extends('layouts.app')

@section('content')
    <div class="min-h-screen bg-gray-900">
        <!-- Anime Player Section - Mobile Optimized -->
        <div class="relative w-full">
            <!-- Responsive Video Container with 16:9 Aspect Ratio -->
            <div class="relative w-full" style="padding-top: 56.25%;">
                <div class="absolute inset-0 bg-black">
                    <iframe id="anime-player" src="{{ $embedUrl }}" class="w-full h-full" frameborder="0" allowfullscreen
                        allow="autoplay; fullscreen; picture-in-picture; encrypted-media; gyroscope; accelerometer"></iframe>
                </div>
            </div>

            <!-- Back Button - Mobile Optimized -->
            <button onclick="goBack()"
                class="absolute top-3 left-3 md:top-4 md:left-4 z-10 bg-black/80 text-white p-3 rounded-full hover:bg-black transition-all duration-200 touch-manipulation"
                style="width: 48px; height: 48px;">
                <i class="fas fa-arrow-left text-lg"></i>
            </button>

            <!-- Episode Info Overlay - Mobile Optimized -->
            <div id="episode-overlay"
                class="absolute bottom-3 left-3 right-3 md:bottom-4 md:left-4 md:right-4 bg-black/90 text-white p-4 rounded-lg transition-opacity duration-300 cursor-pointer"
                onclick="hideOverlay()">
                <button
                    class="absolute top-2 right-2 text-gray-300 hover:text-white p-2 touch-manipulation"
                    onclick="hideOverlay(); event.stopPropagation();" style="width: 40px; height: 40px;">
                    <i class="fas fa-times"></i>
                </button>
                <h2 class="text-lg md:text-xl font-bold pr-10">{{ $anime['name'] ?? 'Unknown Anime' }}</h2>
                <p class="text-sm md:text-base text-gray-300 mt-1">Season {{ $season }}, Episode {{ $episode }}</p>
                <p class="text-xs text-gray-400 mt-2">Tap to hide</p>
            </div>
        </div>

        <!-- Anime Info Section - Mobile Optimized -->
        <div class="px-4 md:px-6 py-4 md:py-8">
            <div class="max-w-6xl mx-auto">
                <div class="flex flex-col lg:flex-row gap-6 md:gap-8">
                    <!-- Anime Poster - Mobile Optimized -->
                    <div class="flex-shrink-0 mx-auto lg:mx-0">
                        <img src="{{ $anime['poster_path'] ? 'https://image.tmdb.org/t/p/w500' . $anime['poster_path'] : '/images/placeholder-poster.jpg' }}"
                            alt="{{ $anime['name'] }}" class="w-48 h-72 md:w-64 md:h-96 object-cover rounded-lg shadow-lg">
                    </div>

                    <!-- Anime Details and Episodes - Mobile Optimized -->
                    <div class="flex-grow text-white">
                        <h1 class="text-2xl md:text-4xl font-bold mb-4">{{ $anime['name'] ?? 'Unknown Anime' }}</h1>

                        <div class="flex flex-wrap gap-2 mb-5">
                            @if (isset($anime['vote_average']))
                                <span class="bg-yellow-600 px-3 py-1.5 rounded-full text-sm font-semibold flex items-center">
                                    <i class="fas fa-star mr-1.5"></i>
                                    {{ number_format($anime['vote_average'], 1) }}
                                </span>
                            @endif
                            @if (isset($anime['first_air_date']))
                                <span class="bg-gray-700 px-3 py-1.5 rounded-full text-sm">
                                    {{ \Carbon\Carbon::parse($anime['first_air_date'])->format('Y') }}
                                </span>
                            @endif
                            @if (isset($anime['number_of_seasons']))
                                <span class="bg-gray-700 px-3 py-1.5 rounded-full text-sm">
                                    {{ $anime['number_of_seasons'] }}
                                    Season{{ $anime['number_of_seasons'] > 1 ? 's' : '' }}
                                </span>
                            @endif
                            <span class="bg-red-600 px-3 py-1.5 rounded-full text-sm font-semibold flex items-center">
                                <i class="fas fa-tv mr-1.5"></i> ANIME
                            </span>
                        </div>

                        <!-- Current Episode Info - Mobile Optimized -->
                        <div class="bg-gray-800 p-4 rounded-lg mb-6">
                            <h3 class="text-lg md:text-xl font-semibold mb-2">
                                Now Playing: S{{ $season }} E{{ $episode }}
                            </h3>
                            @if ($currentEpisode)
                                <h4 class="text-base md:text-lg text-gray-300 mb-2">
                                    {{ $currentEpisode['name'] ?? "Episode $episode" }}</h4>
                                @if (isset($currentEpisode['overview']) && $currentEpisode['overview'])
                                    <p class="text-gray-400 text-sm line-clamp-3 md:line-clamp-none">
                                        {{ $currentEpisode['overview'] }}</p>
                                @endif
                            @endif
                        </div>

                        <!-- Episode Navigation - Mobile Optimized -->
                        @if ($episodes && count($episodes) > 0)
                            <div class="mb-6">
                                <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3 mb-4">
                                    <h3 class="text-xl font-semibold">Season {{ $season }} Episodes</h3>

                                    <!-- Season Selector - Mobile Optimized -->
                                    @if ($anime['number_of_seasons'] > 1)
                                        <div class="flex items-center gap-2">
                                            <label class="text-sm text-gray-400">Season:</label>
                                            <select id="season-selector"
                                                class="bg-gray-700 text-white px-3 py-2 rounded touch-manipulation"
                                                style="min-height: 44px;" onchange="changeSeason(this.value)">
                                                @for ($s = 1; $s <= $anime['number_of_seasons']; $s++)
                                                    <option value="{{ $s }}"
                                                        {{ $s == $season ? 'selected' : '' }}>
                                                        Season {{ $s }}
                                                    </option>
                                                @endfor
                                            </select>
                                        </div>
                                    @endif
                                </div>

                                <!-- Episodes Grid - Mobile Optimized -->
                                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 gap-3 max-h-96 overflow-y-auto p-1">

                                    {{-- We only need to get today's date ONCE, outside the loop for efficiency --}}
                                    @php $today = \Carbon\Carbon::today(); @endphp

                                    @foreach ($episodes as $ep)
                                        @php
                                            // Simple check 1: Is the episode in the future?
                                            // We check if 'air_date' exists AND if it's after today.
                                            $isFutureEpisode = !empty($ep['air_date']) && \Carbon\Carbon::parse($ep['air_date'])->gt($today);

                                            // Simple check 2: Is the image missing?
                                            $isMissingImage = empty($ep['still_path']);
                                        @endphp

                                        {{-- 
                    Main Episode Card
                    - If it's a future episode, make it unclickable (cursor-default) and dim (opacity-50).
                    - Otherwise, make it clickable (cursor-pointer, hover, etc.) and add the onclick.
                --}}
                                        <div class="relative bg-gray-800 rounded-lg p-3 transition-all touch-manipulation
                            {{ $ep['episode_number'] == $episode ? 'ring-2 ring-red-500' : '' }}
                            @if ($isFutureEpisode) opacity-50 cursor-default
                            @else
                                cursor-pointer hover:bg-gray-700 active:bg-gray-600 @endif"
                                            style="min-height: 44px;"
                                            @if (!$isFutureEpisode) onclick="playEpisode({{ $season }}, {{ $ep['episode_number'] }})" @endif>
                                            {{-- Image container --}}
                                            <div class="relative w-full aspect-video mb-2">

                                                @if (!$isMissingImage)
                                                    {{-- We HAVE an image, show it --}}
                                                    <img src="https://image.tmdb.org/t/p/w300{{ $ep['still_path'] }}"
                                                        alt="Episode {{ $ep['episode_number'] }}"
                                                        class="w-full h-full object-cover rounded">
                                                @else
                                                    {{-- We DON'T have an image, show a placeholder --}}
                                                    <div
                                                        class="w-full h-full bg-gray-600 rounded flex items-center justify-center">
                                                        <i class="fas fa-image text-gray-400 text-xl"></i>
                                                    </div>
                                                @endif

                                                {{-- 
                            Overlays
                            - Priority 1: If it's a future episode, show "Not Aired".
                            - Priority 2: ELSE IF the image is missing, show "Data Missing".
                        --}}
                                                @if ($isFutureEpisode)
                                                    <div
                                                        class="absolute inset-0 bg-black/70 rounded flex flex-col items-center justify-center text-center p-1">
                                                        <i class="fas fa-clock text-yellow-400 text-lg mb-1"></i>
                                                        <span class="text-white text-xs font-semibold">Not Aired</span>
                                                    </div>
                                                @elseif($isMissingImage)
                                                    <div
                                                        class="absolute inset-0 bg-black/60 rounded flex items-center justify-center">
                                                        <span class="text-gray-300 text-xs font-semibold">Data Missing</span>
                                                    </div>
                                                @endif
                                            </div>

                                            {{-- Episode Info --}}
                                            <p class="text-sm font-semibold">Ep {{ $ep['episode_number'] }}</p>
                                            <p class="text-xs text-gray-400 truncate mt-1">
                                                {{ $ep['name'] ?? "Episode {$ep['episode_number']}" }}</p>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <!-- Show Overview - Mobile Optimized -->
                        @if (isset($anime['overview']) && $anime['overview'])
                            <div class="mb-6">
                                <h3 class="text-lg font-semibold mb-3">About the Show</h3>
                                <p class="text-gray-300 leading-relaxed">
                                    {{ $anime['overview'] }}
                                </p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function goBack() {
            if (document.referrer) {
                window.history.back();
            } else {
                window.location.href = '{{ route('home') }}';
            }
        }

        function playEpisode(season, episode) {
            window.location.href = '/watch/anime/{{ $anime['id'] }}?season=' + season + '&episode=' + episode;
        }

        function changeSeason(season) {
            window.location.href = '/watch/anime/{{ $anime['id'] }}?season=' + season + '&episode=1';
        }

        // Hide overlay function
        function hideOverlay() {
            const overlay = document.getElementById('episode-overlay');
            if (overlay) {
                overlay.style.opacity = '0';
                setTimeout(() => {
                    overlay.style.display = 'none';
                }, 300);
            }
        }

        // Auto-hide overlay after 5 seconds and try to unmute
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(() => {
                hideOverlay();
            }, 5000);

            // Try to unmute video on load
            const iframe = document.getElementById('anime-player');
            if (iframe) {
                iframe.onload = function() {
                    try {
                        // Try to send unmute command to iframe
                        iframe.contentWindow.postMessage({
                            action: 'unmute'
                        }, '*');
                        iframe.contentWindow.postMessage({
                            action: 'setVolume',
                            volume: 1
                        }, '*');
                    } catch (e) {
                        console.log('Could not control iframe audio directly');
                    }
                };
            }
        });

        // Enhanced fullscreen handling
        let isFullscreen = false;

        document.addEventListener('keydown', function(e) {
            if (e.key === 'f' || e.key === 'F') {
                toggleFullscreen();
            }
            if (e.key === 'Escape') {
                exitFullscreen();
            }
        });

        function toggleFullscreen() {
            if (!isFullscreen) {
                enterFullscreen();
            } else {
                exitFullscreen();
            }
        }

        function enterFullscreen() {
            const iframe = document.getElementById('anime-player');
            if (iframe) {
                if (iframe.requestFullscreen) {
                    iframe.requestFullscreen();
                } else if (iframe.webkitRequestFullscreen) {
                    iframe.webkitRequestFullscreen();
                } else if (iframe.msRequestFullscreen) {
                    iframe.msRequestFullscreen();
                }
                isFullscreen = true;
            }
        }

        function exitFullscreen() {
            if (document.exitFullscreen) {
                document.exitFullscreen();
            } else if (document.webkitExitFullscreen) {
                document.webkitExitFullscreen();
            } else if (document.msExitFullscreen) {
                document.msExitFullscreen();
            }
            isFullscreen = false;
        }

        // Listen for fullscreen changes
        document.addEventListener('fullscreenchange', function() {
            isFullscreen = !!document.fullscreenElement;
        });

        document.addEventListener('webkitfullscreenchange', function() {
            isFullscreen = !!document.webkitFullscreenElement;
        });

        document.addEventListener('msfullscreenchange', function() {
            isFullscreen = !!document.msFullscreenElement;
        });
    </script>
@endsection