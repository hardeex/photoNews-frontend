<!-- Top News Section -->
<div class="container mx-auto px-4 py-8 max-w-6xl">
    <!-- Section Header -->
    <div class="mb-8">
        <h2 class="text-3xl font-bold text-gray-800 mb-2">Top Topics</h2>
        <div class="w-20 h-1 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full"></div>
    </div>

    @if (count($topTopicPostsData) > 0)
        <!-- Desktop/Tablet Grid Layout -->
        <div class="hidden md:grid md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
            @foreach (array_slice($topTopicPostsData, 0, 6) as $index => $post)
                <article class="group bg-white rounded-xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden border border-gray-100 hover:border-blue-200">
                    <a href="{{ route('post.details', $post['slug'] ?? '#') }}" class="block">
                        <!-- Image Container -->
                        <div class="relative overflow-hidden h-48 bg-gray-100">
                            @if ($post['featured_image'])
                                <img src="{{ $post['featured_image'] }}" 
                                     alt="{{ ucwords(strtolower($post['title'])) }}"
                                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                                     loading="lazy">
                            @else
                                <img src="https://picsum.photos/seed/{{ $post['id'] ?? $index }}/400/300" 
                                     alt="{{ ucwords(strtolower($post['title'])) }}"
                                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300"
                                     loading="lazy">
                            @endif
                            
                            <!-- Gradient overlay -->
                            <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        </div>

                        <!-- Content -->
                        <div class="p-6">
                            <h3 class="font-bold text-lg text-gray-800 mb-3 line-clamp-2 group-hover:text-blue-600 transition-colors duration-300">
                                {{ $post['title'] ?? 'Untitled' }}
                            </h3>
                            <p class="text-gray-600 text-sm leading-relaxed line-clamp-3">
                                {{ \Illuminate\Support\Str::limit(strip_tags($post['content']), 120, '...') }}
                            </p>
                            
                            <!-- Read more indicator -->
                            <div class="mt-4 flex items-center text-blue-600 text-sm font-medium opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                <span>Read more</span>
                                <svg class="w-4 h-4 ml-1 transform group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </div>
                        </div>
                    </a>
                </article>
            @endforeach
        </div>

        <!-- Mobile Layout -->
        <div class="md:hidden space-y-4">
            @foreach ($topTopicPostsData as $post)
                <article class="bg-white rounded-lg shadow-md hover:shadow-lg transition-all duration-300 overflow-hidden border border-gray-100">
                    <a href="{{ route('post.details', $post['slug'] ?? '#') }}" class="block">
                        <div class="flex space-x-4 p-4">
                            <!-- Image -->
                            <div class="flex-shrink-0">
                                @if ($post['featured_image'])
                                    <img src="{{ $post['featured_image'] }}" 
                                         alt="{{ ucwords(strtolower($post['title'])) }}"
                                         class="w-20 h-20 sm:w-24 sm:h-24 object-cover rounded-lg"
                                         loading="lazy">
                                @else
                                    <img src="https://picsum.photos/seed/{{ $post['id'] ?? 'default' }}/200/200" 
                                         alt="{{ ucwords(strtolower($post['title'])) }}"
                                         class="w-20 h-20 sm:w-24 sm:h-24 object-cover rounded-lg"
                                         loading="lazy">
                                @endif
                            </div>

                            <!-- Content -->
                            <div class="flex-1 min-w-0">
                                <h3 class="font-semibold text-gray-800 text-base sm:text-lg mb-2 line-clamp-2">
                                    {{ $post['title'] ?? 'Untitled' }}
                                </h3>
                                <p class="text-gray-600 text-sm line-clamp-2 sm:line-clamp-3">
                                    {{ \Illuminate\Support\Str::limit(strip_tags($post['content']), 100, '...') }}
                                </p>
                                
                                <!-- Meta info -->
                                <div class="mt-2 flex items-center text-xs text-gray-500">
                                    <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <span>{{ $post['created_at'] ? \Carbon\Carbon::parse($post['created_at'])->diffForHumans() : 'Recently' }}</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </article>
            @endforeach
        </div>

        <!-- Load More Button (Optional) -->
        @if(count($topTopicPostsData) > 6)
            <div class="text-center mt-8">
                <button class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-500 to-purple-600 text-white font-medium rounded-lg hover:from-blue-600 hover:to-purple-700 transition-all duration-300 shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                    <span>Load More Topics</span>
                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                    </svg>
                </button>
            </div>
        @endif

    @else
        <!-- Empty State -->
        <div class="text-center py-16 bg-gray-50 rounded-xl">
            <div class="max-w-md mx-auto">
                <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                </svg>
                <h3 class="text-lg font-semibold text-gray-800 mb-2">No Topics Available</h3>
                <p class="text-gray-600">Check back later for the latest trending topics and news.</p>
            </div>
        </div>
    @endif
</div>

<!-- Add these CSS classes to your app.css or include them in a style tag -->
<style>
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    
    .line-clamp-3 {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>