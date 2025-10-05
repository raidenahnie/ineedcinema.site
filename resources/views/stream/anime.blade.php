@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-900">
    <!-- Anime Player Section -->
    <div class="relative w-full h-screen">
        <div class="absolute inset-0 bg-black">
            <iframe 
                id="anime-player"
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
        
        <!-- Episode Controls -->
        <div class="absolute top-4 right-4 z-10 flex gap-2">
            <select 
                onchange="changeType(this.value)" 
                class="bg-black bg-opacity-70 text-white p-2 rounded border border-gray-600 focus:outline-none"
            >
                <option value="sub" {{ $type === 'sub' ? 'selected' : '' }}>Subtitled</option>
                <option value="dub" {{ $type === 'dub' ? 'selected' : '' }}>Dubbed</option>
            </select>
            
            <div class="flex items-center gap-2 bg-black bg-opacity-70 text-white p-2 rounded">
                <button onclick="changeEpisode(-1)" class="hover:text-red-400">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <span>Episode {{ $episode }}</span>
                <button onclick="changeEpisode(1)" class="hover:text-red-400">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Anime Info Section -->
    <div class="px-6 py-8">
        <div class="max-w-4xl mx-auto">
            <div class="flex flex-col md:flex-row gap-8">
                <!-- Anime Poster -->
                <div class="flex-shrink-0">
                    <img 
                        src="{{ $anime['images']['jpg']['large_image_url'] ?? $anime['images']['jpg']['image_url'] ?? '/images/placeholder-poster.jpg' }}"
                        alt="{{ $anime['title'] }}"
                        class="w-64 h-96 object-cover rounded-lg shadow-lg"
                    >
                </div>
                
                <!-- Anime Details -->
                <div class="flex-grow text-white">
                    <h1 class="text-4xl font-bold mb-4">{{ $anime['title'] ?? 'Unknown Anime' }}</h1>
                    
                    @if(isset($anime['title_japanese']))
                        <h2 class="text-xl text-gray-300 mb-4">{{ $anime['title_japanese'] }}</h2>
                    @endif
                    
                    <div class="flex flex-wrap gap-4 mb-6">
                        @if(isset($anime['score']) && $anime['score'])
                            <span class="bg-yellow-600 px-3 py-1 rounded-full text-sm font-semibold">
                                <i class="fas fa-star mr-1"></i>
                                {{ number_format($anime['score'], 1) }}
                            </span>
                        @endif
                        @if(isset($anime['year']))
                            <span class="bg-gray-700 px-3 py-1 rounded-full text-sm">
                                {{ $anime['year'] }}
                            </span>
                        @endif
                        @if(isset($anime['episodes']))
                            <span class="bg-gray-700 px-3 py-1 rounded-full text-sm">
                                {{ $anime['episodes'] }} Episodes
                            </span>
                        @endif
                        @if(isset($anime['status']))
                            <span class="bg-blue-600 px-3 py-1 rounded-full text-sm">
                                {{ $anime['status'] }}
                            </span>
                        @endif
                    </div>
                    
                    <!-- Genres -->
                    @if(isset($anime['genres']) && count($anime['genres']) > 0)
                        <div class="mb-6">
                            <h3 class="text-lg font-semibold mb-2">Genres</h3>
                            <div class="flex flex-wrap gap-2">
                                @foreach($anime['genres'] as $genre)
                                    <span class="bg-red-600 px-3 py-1 rounded-full text-sm">
                                        {{ $genre['name'] }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    @endif
                    
                    <!-- Synopsis -->
                    @if(isset($anime['synopsis']) && $anime['synopsis'])
                        <div class="mb-6">
                            <h3 class="text-lg font-semibold mb-2">Synopsis</h3>
                            <p class="text-gray-300 leading-relaxed">
                                {{ $anime['synopsis'] }}
                            </p>
                        </div>
                    @endif
                    
                    <!-- Additional Info -->
                    <div class="grid grid-cols-2 gap-4 text-sm">
                        @if(isset($anime['studios']) && count($anime['studios']) > 0)
                            <div>
                                <span class="text-gray-400">Studio:</span>
                                <span class="text-white">{{ $anime['studios'][0]['name'] }}</span>
                            </div>
                        @endif
                        @if(isset($anime['source']))
                            <div>
                                <span class="text-gray-400">Source:</span>
                                <span class="text-white">{{ $anime['source'] }}</span>
                            </div>
                        @endif
                        @if(isset($anime['rating']))
                            <div>
                                <span class="text-gray-400">Rating:</span>
                                <span class="text-white">{{ $anime['rating'] }}</span>
                            </div>
                        @endif
                        @if(isset($anime['duration']))
                            <div>
                                <span class="text-gray-400">Duration:</span>
                                <span class="text-white">{{ $anime['duration'] }}</span>
                            </div>
                        @endif
                    </div>
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

function changeType(type) {
    const url = new URL(window.location);
    url.searchParams.set('type', type);
    window.location.href = url.toString();
}

function changeEpisode(direction) {
    const currentEpisode = {{ $episode }};
    const newEpisode = Math.max(1, currentEpisode + direction);
    
    const url = new URL(window.location);
    url.searchParams.set('episode', newEpisode);
    window.location.href = url.toString();
}

// Try to unmute video on load
document.addEventListener('DOMContentLoaded', function() {
    const iframe = document.getElementById('anime-player');
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
    
    // Arrow key navigation
    if (e.key === 'ArrowRight') {
        changeEpisode(1);
    } else if (e.key === 'ArrowLeft') {
        changeEpisode(-1);
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