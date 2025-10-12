@props([
    'title',
    'image',
    'year' => null,
    'rating' => null,
    'type' => 'movie', // movie, tv, anime
    'href',
    'badge' => null
])

<a href="{{ $href }}" class="group block">
    <div class="relative aspect-[2/3] overflow-hidden rounded-xl shadow-lg transition-all duration-300 group-hover:scale-105 group-hover:shadow-2xl group-hover:shadow-red-500/20">
        <!-- Image -->
        <img src="{{ $image }}" 
             alt="{{ $title }}" 
             loading="lazy"
             class="w-full h-full object-cover">
        
        <!-- Hover Overlay -->
        <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-300">
            <!-- Play Button -->
            <div class="absolute inset-0 flex items-center justify-center">
                <div class="w-16 h-16 bg-red-600 rounded-full flex items-center justify-center transform scale-0 group-hover:scale-100 transition-transform duration-300">
                    <i class="fas fa-play text-white text-xl ml-1"></i>
                </div>
            </div>
            
            <!-- Info -->
            <div class="absolute bottom-0 left-0 right-0 p-4 transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">
                @if($rating)
                    <div class="flex items-center gap-2 mb-2">
                        <span class="bg-red-600 px-2 py-1 rounded text-xs font-semibold">
                            <i class="fas fa-star mr-1"></i>{{ $rating }}
                        </span>
                        @if($year)
                            <span class="text-xs text-gray-300">{{ $year }}</span>
                        @endif
                        @if($badge)
                            <span class="bg-gray-800/80 px-2 py-1 rounded text-xs font-semibold text-red-400">
                                {{ $badge }}
                            </span>
                        @endif
                    </div>
                @endif
            </div>
        </div>
        
        <!-- Type Badge -->
        @if($type === 'anime')
            <div class="absolute top-3 right-3 bg-red-600 px-2 py-1 rounded text-xs font-semibold">
                ANIME
            </div>
        @elseif($type === 'tv')
            <div class="absolute top-3 right-3 bg-purple-600 px-2 py-1 rounded text-xs font-semibold">
                TV
            </div>
        @endif
    </div>
    
    <!-- Title -->
    <h3 class="mt-3 font-semibold text-white truncate group-hover:text-red-500 transition-colors">
        {{ $title }}
    </h3>
    
    <!-- Year -->
    @if($year && !$rating)
        <p class="text-sm text-gray-400">{{ $year }}</p>
    @endif
</a>
