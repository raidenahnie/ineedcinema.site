@props(['count' => 6])

@for($i = 0; $i < $count; $i++)
    <div class="animate-pulse">
        <div class="aspect-[2/3] bg-gray-800 rounded-xl mb-3 shimmer"></div>
        <div class="h-4 bg-gray-800 rounded mb-2"></div>
        <div class="h-3 bg-gray-800 rounded w-2/3"></div>
    </div>
@endfor

@push('styles')
<style>
    @keyframes shimmer {
        0% {
            background-position: -1000px 0;
        }
        100% {
            background-position: 1000px 0;
        }
    }
    
    .shimmer {
        animation: shimmer 2s infinite;
        background: linear-gradient(
            to right,
            #1f2937 0%,
            #374151 50%,
            #1f2937 100%
        );
        background-size: 1000px 100%;
    }
</style>
@endpush
