@extends('base.base')
@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-white to-blue-50">
    <!-- Hero Section with Category Info -->
    <div class="relative overflow-hidden bg-gradient-to-r from-blue-600 via-purple-600 to-indigo-700">
        <div class="absolute inset-0 bg-black/20"></div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
            <div class="text-center">
                <h1 class="text-4xl md:text-5xl font-bold text-white mb-4 tracking-tight">
                    {{ $category['name'] }} News
                </h1>
                <p class="text-xl text-blue-100 max-w-2xl mx-auto">
                    Stay updated with the latest {{ strtolower($category['name']) }} stories and insights
                </p>
                <div class="mt-6 flex justify-center">
                    <div class="bg-white/20 backdrop-blur-sm rounded-full px-6 py-2 text-white font-medium">
                        {{ count($posts['data']) }} Articles Available
                    </div>
                </div>
            </div>
        </div>
        <!-- Decorative elements -->
        <div class="absolute top-0 right-0 w-64 h-64 bg-white/10 rounded-full -translate-y-32 translate-x-32"></div>
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-purple-500/20 rounded-full translate-y-48 -translate-x-48"></div>
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <!-- Filter/Sort Bar -->
        <div class="mb-8 flex flex-col sm:flex-row justify-between items-center gap-4">
            <div class="flex items-center space-x-4">
                <div class="relative">
                    <select class="appearance-none bg-white border border-gray-200 rounded-xl px-4 py-2 pr-8 text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent shadow-sm">
                        <option>Sort by Latest</option>
                        <option>Sort by Popular</option>
                        <option>Sort by Oldest</option>
                    </select>
                    <div class="absolute inset-y-0 right-0 flex items-center px-2 pointer-events-none">
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </div>
                </div>
            </div>
            <div class="flex items-center space-x-2">
                <button class="p-2 rounded-lg bg-white border border-gray-200 text-gray-600 hover:bg-gray-50 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                    </svg>
                </button>
                <button class="p-2 rounded-lg bg-blue-600 text-white">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Enhanced Post Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach ($posts['data'] as $index => $post)
            <article class="group relative bg-white rounded-2xl shadow-sm hover:shadow-xl transition-all duration-500 overflow-hidden border border-gray-100 hover:border-blue-200 hover:-translate-y-1">
                <a href="{{ url('/post/' . $post['slug']) }}" class="block">
                    <!-- Image Container -->
                    <div class="relative overflow-hidden aspect-video">
                        <img src="{{ $post['featured_image'] }}" 
                             alt="{{ $post['title'] }}" 
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                        
                        <!-- Overlay Gradient -->
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        
                        <!-- Featured Badge for first post -->
                        @if ($index === 0)
                        <div class="absolute top-3 left-3">
                            <span class="bg-gradient-to-r from-red-500 to-pink-500 text-white text-xs font-bold px-3 py-1 rounded-full shadow-lg">
                                Featured
                            </span>
                        </div>
                        @endif
                        
                        <!-- Read time estimate -->
                        <div class="absolute top-3 right-3">
                            <span class="bg-black/50 backdrop-blur-sm text-white text-xs px-2 py-1 rounded-full">
                                {{ rand(2, 8) }} min read
                            </span>
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="p-6">
                        <!-- Category Tag -->
                        <div class="mb-3">
                            <span class="inline-block bg-blue-100 text-blue-800 text-xs font-semibold px-2 py-1 rounded-full">
                                {{ $category['name'] }}
                            </span>
                        </div>
                        
                        <!-- Title -->
                        <h2 class="text-lg font-bold text-gray-900 mb-3 line-clamp-2 group-hover:text-blue-600 transition-colors duration-200 leading-snug">
                            {{ $post['title'] }}
                        </h2>
                        
                        <!-- Excerpt -->
                        <p class="text-gray-600 text-sm mb-4 line-clamp-2 leading-relaxed">
                            {{ Str::limit(strip_tags($post['excerpt'] ?? 'Discover the latest insights and updates in this comprehensive article covering important developments in the field.'), 120) }}
                        </p>
                        
                        <!-- Meta Info -->
                        <div class="flex items-center justify-between text-xs text-gray-500">
                            <div class="flex items-center space-x-2">
                                <div class="w-6 h-6 bg-gradient-to-r from-blue-500 to-purple-500 rounded-full flex items-center justify-center text-white font-bold text-xs">
                                    {{ substr($post['created_by'] ?? 'Admin', 0, 1) }}
                                </div>
                                <span class="font-medium">{{ $post['created_by'] ?? 'Admin' }}</span>
                            </div>
                            <time class="font-medium">
                                {{ \Carbon\Carbon::parse($post['created_at'])->format('M d, Y') }}
                            </time>
                        </div>
                    </div>
                    
                    <!-- Hover Arrow -->
                    <div class="absolute bottom-4 right-4 w-8 h-8 bg-blue-600 rounded-full flex items-center justify-center opacity-0 group-hover:opacity-100 transform translate-x-2 group-hover:translate-x-0 transition-all duration-300">
                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </div>
                </a>
            </article>
            @endforeach
        </div>

        <!-- Enhanced Pagination -->
        @if ($posts['last_page'] > 1)
        <div class="mt-16 flex flex-col items-center space-y-4">
            <div class="text-sm text-gray-600 mb-4">
                Showing page {{ $posts['current_page'] }} of {{ $posts['last_page'] }}
            </div>
            
            <nav class="flex items-center space-x-2" aria-label="Pagination">
                {{-- Previous --}}
                @if ($posts['prev_page_url'])
                <a href="{{ $posts['prev_page_url'] }}" 
                   class="group flex items-center space-x-2 px-4 py-2 bg-white border border-gray-200 rounded-xl text-gray-700 hover:bg-blue-50 hover:border-blue-200 hover:text-blue-600 transition-all duration-200 shadow-sm">
                    <svg class="w-4 h-4 group-hover:-translate-x-1 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                    <span class="font-medium">Previous</span>
                </a>
                @endif

                {{-- Page Numbers --}}
                <div class="flex items-center space-x-1">
                    @foreach ($posts['links'] as $link)
                        @if ($link['url'] && is_numeric($link['label']))
                        <a href="{{ $link['url'] }}"
                           class="w-10 h-10 flex items-center justify-center rounded-xl font-medium transition-all duration-200 {{ $link['active'] ? 'bg-blue-600 text-white shadow-lg shadow-blue-600/25' : 'bg-white border border-gray-200 text-gray-700 hover:bg-blue-50 hover:border-blue-200 hover:text-blue-600' }}">
                            {{ $link['label'] }}
                        </a>
                        @elseif ($link['label'] === '...')
                        <span class="w-10 h-10 flex items-center justify-center text-gray-400">
                            ...
                        </span>
                        @endif
                    @endforeach
                </div>

                {{-- Next --}}
                @if ($posts['next_page_url'])
                <a href="{{ $posts['next_page_url'] }}" 
                   class="group flex items-center space-x-2 px-4 py-2 bg-white border border-gray-200 rounded-xl text-gray-700 hover:bg-blue-50 hover:border-blue-200 hover:text-blue-600 transition-all duration-200 shadow-sm">
                    <span class="font-medium">Next</span>
                    <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </a>
                @endif
            </nav>
        </div>
        @endif
    </div>

    <!-- Back to Top Button -->
    <button id="backToTop" class="fixed bottom-6 right-6 w-12 h-12 bg-blue-600 hover:bg-blue-700 text-white rounded-full shadow-lg hover:shadow-xl transition-all duration-300 opacity-0 invisible">
        <svg class="w-6 h-6 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
        </svg>
    </button>
</div>

<script>
// Back to top functionality
window.addEventListener('scroll', function() {
    const backToTop = document.getElementById('backToTop');
    if (window.pageYOffset > 300) {
        backToTop.classList.remove('opacity-0', 'invisible');
    } else {
        backToTop.classList.add('opacity-0', 'invisible');
    }
});

document.getElementById('backToTop').addEventListener('click', function() {
    window.scrollTo({ top: 0, behavior: 'smooth' });
});
</script>
@endsection