@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-900">
    <!-- Episode Player Section -->
    <div class="relative w-full h-screen">
        <div class="absolute inset-0 bg-black">
            <iframe 
                id="episode-player"
                src="{{ $embedUrl }}" 
                class="w-full h-full"
                frameborder="0" 
                allowfullscreen
                allow="autoplay; fullscreen; picture-in-picture; encrypted-media; gyroscope; accelerometer"
            ></iframe>
        </div>
        
        <!-- Back Button -->
        <button 
            onclick="goBack()" 
            class="absolute top-4 left-4 z-10 bg-black bg-opacity-50 text-white p-3 rounded-full hover:bg-opacity-70 transition-all duration-200"
        >
            <i class="fas fa-arrow-left text-xl"></i>
        </button>
        
        <!-- Episode Info Overlay (Dismissible) -->
        <div id="episode-overlay" class="absolute bottom-4 left-4 right-4 bg-black bg-opacity-70 text-white p-4 rounded-lg transition-opacity duration-300 cursor-pointer" onclick="hideOverlay()">
            <button class="absolute top-2 right-2 text-gray-300 hover:text-white" onclick="hideOverlay(); event.stopPropagation();">
                <i class="fas fa-times"></i>
            </button>
            <h2 class="text-xl font-bold">{{ $show['name'] ?? 'Unknown Show' }}</h2>
            <p class="text-gray-300">Season {{ $season }}, Episode {{ $episode }}</p>
            <p class="text-xs text-gray-400 mt-1">Click to hide</p>
        </div>
    </div>

    <!-- Show Info Section -->
    <div class="px-6 py-8">
        <div class="max-w-6xl mx-auto">
            <div class="flex flex-col lg:flex-row gap-8">
                <!-- Show Poster -->
                <div class="flex-shrink-0">
                    <img 
                        src="{{ $show['poster_path'] ? 'https://image.tmdb.org/t/p/w500' . $show['poster_path'] : '/images/placeholder-poster.jpg' }}"
                        alt="{{ $show['name'] }}"
                        class="w-64 h-96 object-cover rounded-lg shadow-lg"
                    >
                </div>
                
                <!-- Show Details and Episodes -->
                <div class="flex-grow text-white">
                    <h1 class="text-4xl font-bold mb-4">{{ $show['name'] ?? 'Unknown Show' }}</h1>
                    
                    <div class="flex flex-wrap gap-4 mb-6">
                        @if(isset($show['vote_average']))
                            <span class="bg-yellow-600 px-3 py-1 rounded-full text-sm font-semibold">
                                <i class="fas fa-star mr-1"></i>
                                {{ number_format($show['vote_average'], 1) }}
                            </span>
                        @endif
                        @if(isset($show['first_air_date']))
                            <span class="bg-gray-700 px-3 py-1 rounded-full text-sm">
                                {{ \Carbon\Carbon::parse($show['first_air_date'])->format('Y') }}
                            </span>
                        @endif
                        @if(isset($show['number_of_seasons']))
                            <span class="bg-gray-700 px-3 py-1 rounded-full text-sm">
                                {{ $show['number_of_seasons'] }} Season{{ $show['number_of_seasons'] > 1 ? 's' : '' }}
                            </span>
                        @endif
                    </div>
                    
                    <!-- Current Episode Info -->
                    <div class="bg-gray-800 p-4 rounded-lg mb-6">
                        <h3 class="text-xl font-semibold mb-2">
                            Now Playing: Season {{ $season }}, Episode {{ $episode }}
                        </h3>
                        @if($currentEpisode)
                            <h4 class="text-lg text-gray-300 mb-2">{{ $currentEpisode['name'] ?? "Episode $episode" }}</h4>
                            @if(isset($currentEpisode['overview']) && $currentEpisode['overview'])
                                <p class="text-gray-400 text-sm">{{ $currentEpisode['overview'] }}</p>
                            @endif
                        @endif
                    </div>
                    
                    <!-- Episode Navigation -->
                    @if($episodes && count($episodes) > 0)
                        <div class="mb-6">
                            <div class="flex justify-between items-center mb-4">
                                <h3 class="text-xl font-semibold">Season {{ $season }} Episodes</h3>
                                
                                <!-- Season Selector -->
                                @if($show['number_of_seasons'] > 1)
                                    <div class="flex items-center gap-2">
                                        <label class="text-sm text-gray-400">Season:</label>
                                        <select 
                                            id="season-selector" 
                                            class="bg-gray-700 text-white px-3 py-1 rounded"
                                            onchange="changeSeason(this.value)"
                                        >
                                            @for($s = 1; $s <= $show['number_of_seasons']; $s++)
                                                <option value="{{ $s }}" {{ $s == $season ? 'selected' : '' }}>
                                                    Season {{ $s }}
                                                </option>
                                            @endfor
                                        </select>
                                    </div>
                                @endif
                            </div>
                            
                            <!-- Episodes Grid -->
                            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 max-h-96 overflow-y-auto">
                                @foreach($episodes as $ep)
                                    <div class="bg-gray-800 rounded-lg p-3 cursor-pointer hover:bg-gray-700 transition-colors {{ $ep['episode_number'] == $episode ? 'ring-2 ring-red-500' : '' }}"
                                         onclick="playEpisode({{ $season }}, {{ $ep['episode_number'] }})">
                                        @if(isset($ep['still_path']) && $ep['still_path'])
                                            <img 
                                                src="https://image.tmdb.org/t/p/w300{{ $ep['still_path'] }}"
                                                alt="Episode {{ $ep['episode_number'] }}"
                                                class="w-full h-20 object-cover rounded mb-2"
                                            >
                                        @else
                                            <div class="w-full h-20 bg-gray-600 rounded mb-2 flex items-center justify-center">
                                                <i class="fas fa-play text-gray-400"></i>
                                            </div>
                                        @endif
                                        <p class="text-sm font-semibold">Episode {{ $ep['episode_number'] }}</p>
                                        <p class="text-xs text-gray-400 truncate">{{ $ep['name'] ?? "Episode {$ep['episode_number']}" }}</p>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                    
                    <!-- Show Overview -->
                    @if(isset($show['overview']) && $show['overview'])
                        <div class="mb-6">
                            <h3 class="text-lg font-semibold mb-2">About the Show</h3>
                            <p class="text-gray-300 leading-relaxed">
                                {{ $show['overview'] }}
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
        window.location.href = '{{ route("home") }}';
    }
}

function playEpisode(season, episode) {
    window.location.href = '{{ route("watch.tv", ["id" => $show["id"]]) }}/' + season + '/' + episode;
}

function changeSeason(season) {
    window.location.href = '{{ route("watch.tv", ["id" => $show["id"]]) }}/' + season + '/1';
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
    const iframe = document.getElementById('episode-player');
    if (iframe) {
        iframe.onload = function() {
            try {
                // Try to send unmute command to iframe
                iframe.contentWindow.postMessage({action: 'unmute'}, '*');
                iframe.contentWindow.postMessage({action: 'setVolume', volume: 1}, '*');
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
    const iframe = document.getElementById('episode-player');
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