@extends('base.base')

@section('title', 'All News Categories')

@section('content')
<div class="min-h-screen bg-gray-50">
    <!-- Header Section -->
    <div class="bg-gradient-to-r from-slate-900 via-blue-900 to-indigo-900 py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-4xl md:text-5xl font-bold text-white mb-4">
                    All News Categories
                </h1>
                <p class="text-xl text-blue-100 mb-8">
                    Explore all {{ count($categoriesWithPosts) }} categories and discover stories that matter to you
                </p>
                
                <!-- Back to Home Button -->
                <a href="{{ route('welcome') }}" 
                   class="inline-flex items-center px-6 py-3 bg-white/10 hover:bg-white/20 text-white font-semibold rounded-full backdrop-blur-sm transition-all duration-300">
                    <svg class="mr-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Back to Home
                </a>
            </div>
        </div>
    </div>

    <!-- Categories Grid -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        @if(isset($error))
            <!-- Error State -->
            <div class="text-center py-12">
                <div class="w-24 h-24 mx-auto bg-red-100 rounded-full flex items-center justify-center mb-4">
                    <svg class="w-12 h-12 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-800 mb-2">Unable to Load Categories</h3>
                <p class="text-gray-600 mb-4">{{ $error }}</p>
                <a href="{{ route('welcome') }}" class="text-blue-600 hover:text-blue-800 font-medium">
                    Return to Home
                </a>
            </div>
        @elseif($categoriesWithPosts && count($categoriesWithPosts) > 0)
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-4 md:gap-6">
                @php
                    // Define color schemes for categories
                    $colorSchemes = [
                        ['from-red-500', 'to-pink-600', 'red', '🏛️'],
                        ['from-blue-500', 'to-cyan-600', 'blue', '💻'],
                        ['from-green-500', 'to-emerald-600', 'green', '⚽'],
                        ['from-purple-500', 'to-violet-600', 'purple', '🎭'],
                        ['from-gray-600', 'to-slate-700', 'gray', '💼'],
                        ['from-teal-500', 'to-cyan-600', 'teal', '🏥'],
                        ['from-indigo-500', 'to-blue-600', 'indigo', '🔬'],
                        ['from-orange-500', 'to-red-600', 'orange', '✈️'],
                        ['from-yellow-500', 'to-orange-600', 'yellow', '🍽️'],
                        ['from-pink-500', 'to-rose-600', 'pink', '🎨'],
                        ['from-emerald-500', 'to-green-600', 'emerald', '🌍'],
                        ['from-violet-500', 'to-purple-600', 'violet', '🎵'],
                        ['from-cyan-500', 'to-blue-600', 'cyan', '📚'],
                        ['from-rose-500', 'to-pink-600', 'rose', '💰'],
                        ['from-lime-500', 'to-green-600', 'lime', '🏠'],
                        ['from-amber-500', 'to-yellow-600', 'amber', '⚖️'],
                        ['from-sky-500', 'to-blue-600', 'sky', '🌤️'],
                        ['from-fuchsia-500', 'to-purple-600', 'fuchsia', '📱']
                    ];
                @endphp

                @foreach($categoriesWithPosts as $index => $category)
                    @php
                        $colorIndex = $index % count($colorSchemes);
                        $colors = $colorSchemes[$colorIndex];
                        $gradientFrom = $colors[0];
                        $gradientTo = $colors[1];
                        $colorName = $colors[2];
                        $emoji = $colors[3];
                        $isHot = $category['posts_count'] > 50;
                    @endphp

                    <a href="{{ route('categories.show', $category['slug']) }}" 
                       class="group relative bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 overflow-hidden border border-gray-100 hover:border-{{ $colorName }}-200 transform hover:-translate-y-2 hover:rotate-1">
                        
                        <div class="absolute inset-0 opacity-0 group-hover:opacity-5 transition-opacity duration-300">
                            <div class="absolute inset-0 bg-gradient-to-br {{ $gradientFrom }} {{ $gradientTo }}"></div>
                        </div>
                        
                        <div class="relative p-4 lg:p-6 flex flex-col items-center text-center space-y-3 lg:space-y-4">
                            <div class="relative">
                                <div class="w-12 h-12 lg:w-16 lg:h-16 rounded-2xl bg-gradient-to-br {{ $gradientFrom }} {{ $gradientTo }} flex items-center justify-center shadow-lg transform group-hover:rotate-12 group-hover:scale-110 transition-all duration-300">
                                    <span class="text-xl lg:text-2xl">{{ $emoji }}</span>
                                </div>
                                <div class="absolute inset-0 rounded-2xl bg-gradient-to-br {{ $gradientFrom }} {{ $gradientTo }} opacity-0 group-hover:opacity-20 group-hover:scale-125 transition-all duration-300"></div>
                            </div>

                            <div class="space-y-2">
                                <h3 class="text-sm lg:text-base font-bold text-gray-800 group-hover:text-{{ $colorName }}-600 transition-colors duration-300 line-clamp-2">
                                    {{ $category['name'] }}
                                </h3>
                                
                                <span class="inline-block bg-{{ $colorName }}-100 text-{{ $colorName }}-700 text-xs font-medium px-2 py-1 rounded-full">
                                    {{ $category['posts_count'] }} {{ Str::plural('post', $category['posts_count']) }}
                                </span>
                            </div>

                            @if($isHot)
                                <div class="absolute top-2 right-2">
                                    <div class="bg-gradient-to-r from-yellow-400 to-orange-500 text-white text-xs font-bold px-2 py-1 rounded-full flex items-center space-x-1">
                                        <span>🔥</span>
                                        <span class="hidden sm:inline">HOT</span>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </a>
                @endforeach
            </div>

            <!-- Statistics Section -->
            <div class="mt-16 bg-gradient-to-r from-blue-50 to-indigo-50 rounded-2xl p-8">
                <div class="text-center">
                    <h3 class="text-2xl font-bold text-gray-800 mb-4">Category Statistics</h3>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="bg-white p-6 rounded-xl shadow-sm">
                            <div class="text-3xl font-bold text-blue-600 mb-2">{{ count($categoriesWithPosts) }}</div>
                            <div class="text-gray-600">Total Categories</div>
                        </div>
                        <div class="bg-white p-6 rounded-xl shadow-sm">
                            <div class="text-3xl font-bold text-green-600 mb-2">{{ collect($categoriesWithPosts)->sum('posts_count') }}</div>
                            <div class="text-gray-600">Total Posts</div>
                        </div>
                        <div class="bg-white p-6 rounded-xl shadow-sm">
                            <div class="text-3xl font-bold text-purple-600 mb-2">{{ collect($categoriesWithPosts)->where('posts_count', '>', 50)->count() }}</div>
                            <div class="text-gray-600">Hot Categories</div>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <!-- No Categories State -->
            <div class="text-center py-12">
                <div class="w-24 h-24 mx-auto bg-gray-100 rounded-full flex items-center justify-center mb-4">
                    <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-800 mb-2">No Categories Available</h3>
                <p class="text-gray-600 mb-4">Categories will appear here once they're created.</p>
                <a href="{{ route('welcome') }}" class="text-blue-600 hover:text-blue-800 font-medium">
                    Return to Home
                </a>
            </div>
        @endif
    </div>
</div>

<style>
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>
@endsection