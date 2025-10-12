@props([
    'genres' => [],
    'years' => [],
    'sortOptions' => [],
    'showGenres' => true,
    'showYear' => true,
    'showSort' => true,
    'showRating' => false
])

<div class="bg-gray-900/50 backdrop-blur-xl border border-gray-800/50 rounded-xl p-6 mb-8">
    <div class="flex flex-col lg:flex-row gap-4">
        <!-- Genre Filter -->
        @if($showGenres && count($genres) > 0)
            <div class="flex-1">
                <label class="block text-sm font-medium text-gray-400 mb-2">
                    <i class="fas fa-tags mr-2"></i>Genre
                </label>
                <select id="genreFilter" class="w-full bg-gray-800/50 text-white border border-gray-700/50 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-red-500/50 transition-all">
                    <option value="">All Genres</option>
                    @foreach($genres as $genre)
                        <option value="{{ $genre['id'] }}">{{ $genre['name'] }}</option>
                    @endforeach
                </select>
            </div>
        @endif
        
        <!-- Year Filter -->
        @if($showYear && count($years) > 0)
            <div class="flex-1">
                <label class="block text-sm font-medium text-gray-400 mb-2">
                    <i class="fas fa-calendar mr-2"></i>Year
                </label>
                <select id="yearFilter" class="w-full bg-gray-800/50 text-white border border-gray-700/50 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-red-500/50 transition-all">
                    <option value="">All Years</option>
                    @foreach($years as $year)
                        <option value="{{ $year }}">{{ $year }}</option>
                    @endforeach
                </select>
            </div>
        @endif
        
        <!-- Rating Filter -->
        @if($showRating)
            <div class="flex-1">
                <label class="block text-sm font-medium text-gray-400 mb-2">
                    <i class="fas fa-star mr-2"></i>Min Rating
                </label>
                <select id="ratingFilter" class="w-full bg-gray-800/50 text-white border border-gray-700/50 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-red-500/50 transition-all">
                    <option value="">Any Rating</option>
                    <option value="9">9+ Outstanding</option>
                    <option value="8">8+ Excellent</option>
                    <option value="7">7+ Good</option>
                    <option value="6">6+ Fair</option>
                </select>
            </div>
        @endif
        
        <!-- Sort Filter -->
        @if($showSort && count($sortOptions) > 0)
            <div class="flex-1">
                <label class="block text-sm font-medium text-gray-400 mb-2">
                    <i class="fas fa-sort mr-2"></i>Sort By
                </label>
                <select id="sortFilter" class="w-full bg-gray-800/50 text-white border border-gray-700/50 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-red-500/50 transition-all">
                    @foreach($sortOptions as $value => $label)
                        <option value="{{ $value }}">{{ $label }}</option>
                    @endforeach
                </select>
            </div>
        @endif
        
        <!-- Apply Button -->
        <div class="flex items-end">
            <button onclick="applyFilters()" class="w-full lg:w-auto px-6 py-2.5 bg-gradient-to-r from-red-600 to-red-500 hover:from-red-500 hover:to-red-600 text-white font-medium rounded-lg transition-all duration-300 hover:shadow-lg hover:shadow-red-500/50">
                <i class="fas fa-filter mr-2"></i>Apply Filters
            </button>
        </div>
    </div>
</div>
