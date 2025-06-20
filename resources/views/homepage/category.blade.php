    <section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 lg:py-12">
    <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
        {{-- Header Section --}}
        <div class="bg-gradient-to-r from-slate-900 via-blue-900 to-indigo-900 px-6 py-8 relative overflow-hidden">
            {{-- Background Pattern --}}
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
                
                {{-- Live Progress Bar --}}
                <div class="mt-6 max-w-md mx-auto">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-sm text-blue-200">Live Coverage</span>
                        <span class="text-sm text-red-400 font-semibold">{{ count($categoriesData ?? []) }} Active</span>
                    </div>
                    <div class="relative w-full h-2 bg-white/20 rounded-full overflow-hidden">
                        <div class="absolute left-0 top-0 h-full bg-gradient-to-r from-red-500 to-red-400 rounded-full animate-pulse" 
                             style="width: 75%"></div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Categories Grid --}}
        <div class="p-6 lg:p-8">
            @if (count($categoriesData ?? []) > 0)
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-5 xl:grid-cols-6 gap-4 lg:gap-6">
                    @foreach ($categoriesData as $index => $category)
                        @php
                            $categoryStyles = [
                                'politics' => ['icon' => '🏛️', 'bg' => 'from-red-500 to-pink-600', 'accent' => 'red'],
                                'technology' => ['icon' => '💻', 'bg' => 'from-blue-500 to-cyan-600', 'accent' => 'blue'],
                                'sports' => ['icon' => '⚽', 'bg' => 'from-green-500 to-emerald-600', 'accent' => 'green'],
                                'entertainment' => ['icon' => '🎭', 'bg' => 'from-purple-500 to-violet-600', 'accent' => 'purple'],
                                'business' => ['icon' => '💼', 'bg' => 'from-gray-600 to-slate-700', 'accent' => 'gray'],
                                'health' => ['icon' => '🏥', 'bg' => 'from-teal-500 to-cyan-600', 'accent' => 'teal'],
                                'science' => ['icon' => '🔬', 'bg' => 'from-indigo-500 to-blue-600', 'accent' => 'indigo'],
                                'travel' => ['icon' => '✈️', 'bg' => 'from-orange-500 to-red-600', 'accent' => 'orange'],
                                'food' => ['icon' => '🍽️', 'bg' => 'from-yellow-500 to-orange-600', 'accent' => 'yellow'],
                                'fashion' => ['icon' => '👗', 'bg' => 'from-pink-500 to-rose-600', 'accent' => 'pink'],
                                'education' => ['icon' => '📚', 'bg' => 'from-amber-500 to-yellow-600', 'accent' => 'amber'],
                                'environment' => ['icon' => '🌱', 'bg' => 'from-green-600 to-lime-600', 'accent' => 'green'],
                                'default' => ['icon' => '📰', 'bg' => 'from-slate-500 to-gray-600', 'accent' => 'slate']
                            ];

                            $categoryKey = strtolower(str_replace([' ', '-', '_'], '', $category['name'] ?? ''));
                            $style = $categoryStyles[$categoryKey] ?? $categoryStyles['default'];
                            $animationDelay = ($index * 0.1) . 's';
                        @endphp

                        <a href="#"
                           class="group relative bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 overflow-hidden border border-gray-100 hover:border-{{ $style['accent'] }}-200 transform hover:-translate-y-2 hover:rotate-1"
                           style="animation-delay: {{ $animationDelay }}">
                           
                            {{-- Background Pattern --}}
                            <div class="absolute inset-0 opacity-0 group-hover:opacity-5 transition-opacity duration-300">
                                <div class="absolute inset-0 bg-gradient-to-br {{ $style['bg'] }}"></div>
                            </div>
                            
                            {{-- Content --}}
                            <div class="relative p-6 flex flex-col items-center text-center space-y-4">
                                {{-- Icon Container --}}
                                <div class="relative">
                                    <div class="w-16 h-16 md:w-18 md:h-18 rounded-2xl bg-gradient-to-br {{ $style['bg'] }} flex items-center justify-center shadow-lg transform group-hover:rotate-12 group-hover:scale-110 transition-all duration-300">
                                        <span class="text-2xl md:text-3xl">{{ $style['icon'] }}</span>
                                    </div>
                                    {{-- Pulse Ring --}}
                                    <div class="absolute inset-0 rounded-2xl bg-gradient-to-br {{ $style['bg'] }} opacity-0 group-hover:opacity-20 group-hover:scale-125 transition-all duration-300"></div>
                                </div>

                                {{-- Category Name --}}
                                <div class="space-y-2">
                                    <h3 class="text-sm md:text-base font-bold text-gray-800 group-hover:text-{{ $style['accent'] }}-600 transition-colors duration-300 line-clamp-2">
                                        {{ $category['name'] }}
                                    </h3>
                                    
                                    {{-- Post Count Badge --}}
                                    @if(isset($category['posts_count']))
                                        <span class="inline-block bg-{{ $style['accent'] }}-100 text-{{ $style['accent'] }}-700 text-xs font-medium px-2 py-1 rounded-full">
                                            {{ $category['posts_count'] }} posts
                                        </span>
                                    @endif
                                </div>

                                {{-- Trending Indicator --}}
                                @if(($index + 1) <= 3)
                                    <div class="absolute top-2 right-2">
                                        <div class="bg-gradient-to-r from-yellow-400 to-orange-500 text-white text-xs font-bold px-2 py-1 rounded-full flex items-center space-x-1">
                                            <span>🔥</span>
                                            <span>HOT</span>
                                        </div>
                                    </div>
                                @endif

                                {{-- Hover Overlay --}}
                                <div class="absolute inset-0 bg-gradient-to-t from-black/0 via-transparent to-white/10 opacity-0 group-hover:opacity-100 transition-opacity duration-300 rounded-2xl"></div>
                            </div>
                        </a>
                    @endforeach
                </div>

               

            @else
                {{-- Enhanced Empty State --}}
                <div class="text-center py-16">
                    <div class="relative inline-block mb-8">
                        <div class="w-32 h-32 rounded-full bg-gradient-to-br from-gray-100 to-slate-200 flex items-center justify-center">
                            <span class="text-6xl text-gray-400">📂</span>
                        </div>
                        <div class="absolute -top-2 -right-2 w-8 h-8 bg-red-500 rounded-full flex items-center justify-center">
                            <span class="text-white text-xs font-bold">!</span>
                        </div>
                    </div>
                    
                    <h3 class="text-2xl font-bold text-gray-700 mb-3">No Categories Available</h3>
                    <p class="text-gray-500 mb-8 max-w-md mx-auto">
                        We're working on adding exciting news categories. Check back soon for the latest updates!
                    </p>
                    
                    <div class="flex flex-col sm:flex-row items-center justify-center space-y-3 sm:space-y-0 sm:space-x-4">
                        <button onclick="location.reload()" 
                                class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-semibold transition-colors">
                            🔄 Refresh Page
                        </button>
                        <a href="{{ route('welcome') }}" 
                           class="bg-gray-100 hover:bg-gray-200 text-gray-700 px-6 py-3 rounded-lg font-semibold transition-colors">
                            🏠 Back to Home
                        </a>
                    </div>
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
    
    /* Responsive Grid Adjustments */
    @media (max-width: 640px) {
        .grid-cols-2 > * {
            min-height: 120px;
        }
    }
    
    @media (min-width: 641px) and (max-width: 768px) {
        .sm\:grid-cols-3 > * {
            min-height: 140px;
        }
    }
    
    @media (min-width: 769px) {
        .md\:grid-cols-4 > *, 
        .lg\:grid-cols-5 > *, 
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
