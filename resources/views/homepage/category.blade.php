<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 lg:py-12">
    <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
        <!-- Header Section -->
        <div class="bg-gradient-to-r from-slate-900 via-blue-900 to-indigo-900 px-6 py-8 relative overflow-hidden">
            <!-- Background Pattern -->
            <div class="absolute inset-0 opacity-10">
                <div class="absolute inset-0 bg-grid-pattern"></div>
                <div class="absolute top-4 right-8 w-12 h-12 bg-white rounded-full opacity-20 animate-float"></div>
                <div class="absolute bottom-6 left-12 w-8 h-8 bg-yellow-400 rounded-full opacity-30 animate-float-delayed"></div>
            </div>
            
            <div class="relative z-10 text-center">
                <div class="inline-flex items-center bg-red-600 text-white px-4 py-2 rounded-full mb-4 shadow-lg">
                    <div class="w-2 h-2 bg-white rounded-full mr-2 animate-ping"></div>
                    <span class="font-semibold text-sm tracking-wide">LIVE NEWS</span>
                </div>
                
                <h2 class="text-3xl md:text-4xl font-bold text-white mb-2">
                    Top News Categories
                </h2>
                <p class="text-blue-100 text-lg">
                    Discover the latest stories across all topics
                </p>
                
                <!-- Live Progress Bar -->
                <div class="mt-6 max-w-md mx-auto">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-sm text-blue-200">Live Coverage</span>
                        <span class="text-sm text-red-400 font-semibold">{{ count($categoriesWithPosts) }} Active</span>
                    </div>
                    <div class="relative w-full h-2 bg-white/20 rounded-full overflow-hidden">
                        <div class="absolute left-0 top-0 h-full bg-gradient-to-r from-red-500 to-red-400 rounded-full animate-pulse" 
                             style="width: 75%"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Categories Grid - Dynamic -->
        <div class="p-6 lg:p-8">
            @if($categoriesWithPosts && count($categoriesWithPosts) > 0)
                <div class="grid grid-cols-3 sm:grid-cols-4 md:grid-cols-5 lg:grid-cols-6 xl:grid-cols-6 gap-3 sm:gap-4 lg:gap-6">
                    @php
                        // Sort categories by posts_count in descending order and take first 18
                        $topCategories = collect($categoriesWithPosts)
                            ->sortByDesc('posts_count')
                            ->take(18);
                        
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

                    @foreach($topCategories as $index => $category)
                        @php
                            $colorIndex = $index % count($colorSchemes);
                            $colors = $colorSchemes[$colorIndex];
                            $gradientFrom = $colors[0];
                            $gradientTo = $colors[1];
                            $colorName = $colors[2];
                            $emoji = $colors[3];
                            $isHot = $category['posts_count'] > 50; // Categories with more than 50 posts are "hot"
                        @endphp

                        <a href="{{ route('categories.show', $category['slug']) }}" 
                           class="group relative bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 overflow-hidden border border-gray-100 hover:border-{{ $colorName }}-200 transform hover:-translate-y-2 hover:rotate-1">
                            
                            <div class="absolute inset-0 opacity-0 group-hover:opacity-5 transition-opacity duration-300">
                                <div class="absolute inset-0 bg-gradient-to-br {{ $gradientFrom }} {{ $gradientTo }}"></div>
                            </div>
                            
                            <div class="relative p-3 sm:p-4 lg:p-6 flex flex-col items-center text-center space-y-2 sm:space-y-3 lg:space-y-4">
                                <div class="relative">
                                    <div class="w-10 h-10 sm:w-12 sm:h-12 lg:w-16 lg:h-16 rounded-2xl bg-gradient-to-br {{ $gradientFrom }} {{ $gradientTo }} flex items-center justify-center shadow-lg transform group-hover:rotate-12 group-hover:scale-110 transition-all duration-300">
                                        <span class="text-lg sm:text-xl lg:text-2xl">{{ $emoji }}</span>
                                    </div>
                                    <div class="absolute inset-0 rounded-2xl bg-gradient-to-br {{ $gradientFrom }} {{ $gradientTo }} opacity-0 group-hover:opacity-20 group-hover:scale-125 transition-all duration-300"></div>
                                </div>

                                <div class="space-y-1 sm:space-y-2">
                                    <h3 class="text-xs sm:text-sm lg:text-base font-bold text-gray-800 group-hover:text-{{ $colorName }}-600 transition-colors duration-300 line-clamp-2">
                                        {{ $category['name'] }}
                                    </h3>
                                    
                                    <span class="inline-block bg-{{ $colorName }}-100 text-{{ $colorName }}-700 text-xs font-medium px-2 py-1 rounded-full hidden sm:block">
                                        {{ $category['posts_count'] }} posts
                                    </span>
                                </div>

                                @if($isHot)
                                    <div class="absolute top-1 right-1 sm:top-2 sm:right-2">
                                        <div class="bg-gradient-to-r from-yellow-400 to-orange-500 text-white text-xs font-bold px-1 py-1 sm:px-2 rounded-full flex items-center space-x-1">
                                            <span class="text-xs">🔥</span>
                                            <span class="hidden sm:inline">HOT</span>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </a>
                    @endforeach
                </div>

                <!-- See More Button -->
                @if(count($categoriesWithPosts) > 18)
                    <div class="mt-8 text-center">
                        <a href="{{ route('categories.all') }}" 
                           class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-semibold rounded-full shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-300">
                            <span>View All Categories</span>
                            <svg class="ml-2 w-5 h-5 transform group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                            </svg>
                            <span class="ml-2 bg-white/20 text-xs px-2 py-1 rounded-full">
                                +{{ count($categoriesWithPosts) - 18 }} more
                            </span>
                        </a>
                    </div>
                @endif
            @else
                <!-- No Categories Available -->
                <div class="text-center py-12">
                    <div class="w-24 h-24 mx-auto bg-gray-100 rounded-full flex items-center justify-center mb-4">
                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                        </svg>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-800 mb-2">No Categories Available</h3>
                    <p class="text-gray-600">Categories will appear here once they're created.</p>
                </div>
            @endif
        </div>
    </div>
</section>

<style>
    .bg-grid-pattern {
        background-image: radial-gradient(circle at 1px 1px, rgba(255,255,255,0.1) 1px, transparent 0);
        background-size: 20px 20px;
    }
    
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    
    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-8px); }
    }
    
    @keyframes ping {
        75%, 100% {
            transform: scale(2);
            opacity: 0;
        }
    }
    
    .animate-float {
        animation: float 3s ease-in-out infinite;
    }
    
    .animate-float-delayed {
        animation: float 3s ease-in-out infinite;
        animation-delay: 1.5s;
    }
    
    .animate-ping {
        animation: ping 1s cubic-bezier(0, 0, 0.2, 1) infinite;
    }
    
    /* Mobile Optimizations */
    @media (max-width: 640px) {
        .grid-cols-3 > * {
            min-height: 100px;
        }
    }
    
    @media (min-width: 641px) and (max-width: 768px) {
        .sm\:grid-cols-4 > * {
            min-height: 120px;
        }
    }
    
    @media (min-width: 769px) {
        .md\:grid-cols-5 > *, 
        .lg\:grid-cols-6 > *, 
        .xl\:grid-cols-6 > * {
            min-height: 160px;
        }
    }
    
    /* Hover Effects Enhancement */
    @media (hover: hover) {
        .group:hover {
            transform: translateY(-8px) rotate(1deg);
        }
    }
    
    /* Touch Device Optimizations */
    @media (hover: none) {
        .group:active {
            transform: scale(0.98);
        }
    }
</style>