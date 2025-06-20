<!-- Enhanced News Section with Blue & Red Brand Colors -->
<section class="relative py-16 overflow-hidden">
    <!-- Background with gradient and animated elements -->
    <div class="absolute inset-0 bg-gradient-to-br from-slate-50 via-blue-50/50 to-red-50/30"></div>
    <div class="absolute top-0 left-0 w-72 h-72 bg-blue-200/20 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-pulse"></div>
    <div class="absolute bottom-0 right-0 w-96 h-96 bg-red-200/20 rounded-full mix-blend-multiply filter blur-xl opacity-70 animate-pulse" style="animation-delay: 2s;"></div>
    
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Enhanced Header -->
        <div class="text-center mb-16">
            <div class="inline-flex items-center justify-center p-2 bg-gradient-to-r from-blue-600 to-red-600 rounded-full mb-6">
                <div class="flex items-center justify-center w-12 h-12 bg-white rounded-full">
                    <i class="fas fa-newspaper text-xl bg-gradient-to-r from-blue-600 to-red-600 bg-clip-text text-transparent"></i>
                </div>
            </div>
            <h2 class="text-4xl md:text-5xl font-bold mb-4">
                <span class="bg-gradient-to-r from-blue-600 via-blue-700 to-red-600 bg-clip-text text-transparent">
                    Latest News
                </span>
            </h2>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                Stay updated with the most recent stories and breaking news from around the world
            </p>
            <div class="mt-6 h-1 w-24 bg-gradient-to-r from-blue-600 to-red-600 mx-auto rounded-full"></div>
        </div>

        <!-- News Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @if (count($postsData) > 0)
                @foreach ($postsData as $index => $post)
                    <article class="group bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-3 hover:scale-[1.02] flex flex-col h-full"
                             style="animation-delay: {{ $index * 0.1 }}s;">
                        
                        <!-- Image Container with Enhanced Effects -->
                        <div class="relative overflow-hidden h-56">
                            @if ($post['featured_image'])
                                <img src="{{ $post['featured_image'] }}"
                                     alt="{{ ucwords(strtolower($post['title'])) }}"
                                     class="w-full h-full object-cover transition-all duration-700 group-hover:scale-110 group-hover:rotate-1">
                            @else
                                <img src="https://picsum.photos/seed/news{{ $index }}/600/400"
                                     alt="{{ ucwords(strtolower($post['title'])) }}"
                                     class="w-full h-full object-cover transition-all duration-700 group-hover:scale-110 group-hover:rotate-1">
                            @endif
                            
                            <!-- Gradient Overlay -->
                            <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            
                            <!-- Category Badge with Enhanced Design -->
                            @if (isset($post['category_names']) || (isset($post['category']) && isset($post['category']['name'])))
                                <div class="absolute top-4 right-4">
                                    <div class="relative">
                                        <div class="absolute inset-0 bg-gradient-to-r from-blue-600 to-red-600 rounded-full blur opacity-75"></div>
                                        <span class="relative inline-flex items-center px-4 py-2 bg-gradient-to-r from-blue-600 to-red-600 text-white text-xs font-bold rounded-full shadow-lg backdrop-blur-sm">
                                            <i class="fas fa-tag mr-2"></i>
                                            {{ isset($post['category_names'])
                                                ? ucwords(strtolower($post['category_names']))
                                                : ucwords(strtolower($post['category']['name'])) }}
                                        </span>
                                    </div>
                                </div>
                            @endif

                            <!-- Reading Time Badge -->
                            <div class="absolute top-4 left-4 bg-white/90 backdrop-blur-sm rounded-full px-3 py-1 shadow-lg">
                                <span class="text-xs font-medium text-gray-700">
                                    <i class="far fa-clock mr-1"></i>
                                    {{ rand(2, 8) }} min read
                                </span>
                            </div>
                        </div>

                        <!-- Content Section with Better Spacing -->
                        <div class="flex flex-col flex-1 p-6">
                            <!-- Title with Gradient Hover Effect -->
                            <h3 class="text-xl font-bold mb-3 line-clamp-2 group-hover:bg-gradient-to-r group-hover:from-blue-600 group-hover:to-red-600 group-hover:bg-clip-text group-hover:text-transparent transition-all duration-300">
                                {{ $post['title'] ?? 'Untitled' }}
                            </h3>

                            <!-- Enhanced Description -->
                            <p class="text-gray-600 mb-6 line-clamp-3 leading-relaxed">
                                {{ strip_tags(strlen($post['meta_description'] ?? '') > 120 ? substr($post['meta_description'], 0, 120) . '...' : $post['meta_description'] ?? $post['content']) }}
                            </p>

                            <!-- Author Section with Better Design -->
                            <div class="mb-4 p-3 bg-gray-50 rounded-xl">
                                <div class="flex items-center justify-between">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 bg-gradient-to-r from-blue-600 to-red-600 rounded-full flex items-center justify-center mr-3">
                                            <span class="text-white font-bold text-sm">
                                                {{ substr($post['created_by'], 0, 1) }}
                                            </span>
                                        </div>
                                        <div>
                                            <p class="font-semibold text-gray-800 text-sm">{{ $post['created_by'] }}</p>
                                            <p class="text-xs text-gray-500">
                                                {{ \Carbon\Carbon::parse($post['created_at'])->format('M d, Y') }}
                                            </p>
                                        </div>
                                    </div>
                                    <span class="text-xs bg-blue-100 text-blue-700 px-2 py-1 rounded-full font-medium">
                                        {{ \Carbon\Carbon::parse($post['created_at'])->diffForHumans() }}
                                    </span>
                                </div>
                            </div>

                            <!-- Enhanced Stats with Icons -->
                            <div class="flex items-center justify-between text-sm text-gray-500 mb-6 p-3 bg-gradient-to-r from-blue-50 to-red-50 rounded-xl">
                                <div class="flex items-center space-x-4">
                                    <span class="flex items-center hover:text-blue-600 transition-colors">
                                        <i class="fas fa-eye mr-1"></i>
                                        {{ number_format($post['views']) }}
                                    </span>
                                    <span class="flex items-center hover:text-green-600 transition-colors">
                                        <i class="fas fa-share-alt mr-1"></i>
                                        {{ number_format($post['shares']) }}
                                    </span>
                                    <span class="flex items-center hover:text-red-600 transition-colors">
                                        <i class="fas fa-heart mr-1"></i>
                                        {{ number_format($post['likes']) }}
                                    </span>
                                </div>
                            </div>

                            <!-- Enhanced CTA Button -->
                            <div class="mt-auto">
                                <a href="{{ route('post.details', $post['slug'] ?? '#') }}" 
                                   class="group/btn relative inline-flex items-center justify-center w-full px-6 py-3 text-sm font-semibold text-white bg-gradient-to-r from-blue-600 to-red-600 rounded-xl overflow-hidden transition-all duration-300 hover:shadow-xl hover:shadow-blue-500/30">
                                    <!-- Button Background Animation -->
                                    <div class="absolute inset-0 bg-gradient-to-r from-red-600 to-blue-600 opacity-0 group-hover/btn:opacity-100 transition-opacity duration-300"></div>
                                    
                                    <!-- Button Content -->
                                    <span class="relative flex items-center">
                                        Read Full Story
                                        <i class="fas fa-arrow-right ml-2 transform group-hover/btn:translate-x-1 transition-transform duration-300"></i>
                                    </span>
                                </a>
                            </div>
                        </div>
                    </article>
                @endforeach
            @else
                <!-- Enhanced No Posts Message -->
                <div class="col-span-full flex flex-col items-center justify-center py-16 text-center">
                    <div class="relative mb-8">
                        <div class="absolute inset-0 bg-gradient-to-r from-blue-600 to-red-600 rounded-full blur opacity-20 animate-pulse"></div>
                        <div class="relative w-24 h-24 bg-gradient-to-r from-blue-600 to-red-600 rounded-full flex items-center justify-center">
                            <i class="fas fa-newspaper text-3xl text-white"></i>
                        </div>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-800 mb-4">No Stories Yet</h3>
                    <p class="text-gray-600 mb-8 max-w-md">
                        We're working hard to bring you the latest news. Check back soon for exciting updates!
                    </p>
                    <button class="px-8 py-3 bg-gradient-to-r from-blue-600 to-red-600 text-white font-semibold rounded-xl hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1">
                        <i class="fas fa-bell mr-2"></i>
                        Notify Me
                    </button>
                </div>
            @endif
        </div>

        <!-- Enhanced Load More Section -->
        @if (count($postsData) > 0)
            <div class="text-center mt-16">
                <a href="{{route('news')}}" class="group relative inline-flex items-center px-8 py-4 bg-white border-2 border-transparent  bg-clip-border text-transparent font-bold rounded-xl hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                    <span class="absolute inset-0 bg-gradient-to-r from-blue-600 to-red-600 rounded-xl blur opacity-30 group-hover:opacity-50 transition-opacity"></span>
                    <span class="relative bg-gradient-to-r from-blue-600 to-red-600 bg-clip-text">
                        <i class="fas fa-plus mr-2"></i>
                        Load More Stories
                    </span>
                </a>
            </div>
        @endif
    </div>
</section>

<!-- Additional CSS for animations -->
<style>
    @keyframes slideInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .grid > article {
        animation: slideInUp 0.6s ease-out forwards;
        opacity: 0;
    }
    
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
    
    /* Smooth scrolling for better UX */
    html {
        scroll-behavior: smooth;
    }
</style>








