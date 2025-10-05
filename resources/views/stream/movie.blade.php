@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-900">
    <!-- Movie Player Section -->
    <div class="relative w-full h-screen">
        <div class="absolute inset-0 bg-black">
            <iframe 
                id="movie-player"
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
    </div>

    <!-- Movie Info Section -->
    <div class="px-6 py-8">
        <div class="max-w-4xl mx-auto">
            <div class="flex flex-col md:flex-row gap-8">
                <!-- Movie Poster -->
                <div class="flex-shrink-0">
                    <img 
                        src="{{ $movie['poster_path'] ? 'https://image.tmdb.org/t/p/w500' . $movie['poster_path'] : '/images/placeholder-poster.jpg' }}"
                        alt="{{ $movie['title'] }}"
                        class="w-64 h-96 object-cover rounded-lg shadow-lg"
                    >
                </div>
                
                <!-- Movie Details -->
                <div class="flex-grow text-white">
                    <h1 class="text-4xl font-bold mb-4">{{ $movie['title'] }}</h1>
                    
                    <div class="flex flex-wrap gap-4 mb-6">
                        <span class="bg-yellow-600 px-3 py-1 rounded-full text-sm font-semibold">
                            <i class="fas fa-star mr-1"></i>
                            {{ number_format($movie['vote_average'], 1) }}
                        </span>
                        <span class="bg-gray-700 px-3 py-1 rounded-full text-sm">
                            {{ \Carbon\Carbon::parse($movie['release_date'])->format('Y') }}
                        </span>
                        @if(isset($movie['runtime']))
                            <span class="bg-gray-700 px-3 py-1 rounded-full text-sm">
                                {{ $movie['runtime'] }} min
                            </span>
                        @endif
                    </div>
                    
                    <!-- Genres -->
                    @if(isset($movie['genres']) && count($movie['genres']) > 0)
                        <div class="mb-6">
                            <h3 class="text-lg font-semibold mb-2">Genres</h3>
                            <div class="flex flex-wrap gap-2">
                                @foreach($movie['genres'] as $genre)
                                    <span class="bg-red-600 px-3 py-1 rounded-full text-sm">
                                        {{ $genre['name'] }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    @endif
                    
                    <!-- Overview -->
                    @if(isset($movie['overview']) && $movie['overview'])
                        <div class="mb-6">
                            <h3 class="text-lg font-semibold mb-2">Overview</h3>
                            <p class="text-gray-300 leading-relaxed">
                                {{ $movie['overview'] }}
                            </p>
                        </div>
                    @endif
                    
                    <!-- Additional Info -->
                    <div class="grid grid-cols-2 gap-4 text-sm">
                        @if(isset($movie['production_companies']) && count($movie['production_companies']) > 0)
                            <div>
                                <span class="text-gray-400">Production:</span>
                                <span class="text-white">{{ $movie['production_companies'][0]['name'] }}</span>
                            </div>
                        @endif
                        @if(isset($movie['original_language']))
                            <div>
                                <span class="text-gray-400">Language:</span>
                                <span class="text-white">{{ strtoupper($movie['original_language']) }}</span>
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

// Try to unmute video on load
document.addEventListener('DOMContentLoaded', function() {
    const iframe = document.getElementById('movie-player');
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

// Optional: Handle fullscreen
document.addEventListener('keydown', function(e) {
    if (e.key === 'f' || e.key === 'F') {
        const iframe = document.getElementById('movie-player');
        if (iframe.requestFullscreen) {
            iframe.requestFullscreen();
        }
    }
});
</script>
@endsection