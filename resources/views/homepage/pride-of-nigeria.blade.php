@if (!empty($listPrideOfNigeriaPostsData['prideOfNigeriaPostsData']) && count($listPrideOfNigeriaPostsData['prideOfNigeriaPostsData']) > 0)
<section class="relative  py-12 px-4 overflow-hidden">
    <!-- Decorative Background Elements -->
    <div class="absolute top-0 left-0 w-32 h-32 bg-red-100 rounded-full opacity-30 -translate-x-16 -translate-y-16"></div>
    <div class="absolute bottom-0 right-0 w-40 h-40 bg-blue-100 rounded-full opacity-30 translate-x-20 translate-y-20"></div>
    
    <div class="max-w-7xl mx-auto relative z-10">
        <!-- Header Section -->
        <div class="text-center mb-12">
            <div class="inline-flex items-center justify-center w-16 h-16 bg-gradient-to-r from-red-500 to-blue-500 rounded-full mb-4">
                <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                </svg>
            </div>
            <h2 class="text-4xl md:text-5xl font-bold bg-gradient-to-r from-red-600 to-blue-600 bg-clip-text text-transparent mb-3">
                PRIDE OF NIGERIA
            </h2>
            <p class="text-gray-600 text-lg max-w-2xl mx-auto">
                Celebrating the achievements, culture, and excellence that make Nigeria proud
            </p>
            <div class="w-24 h-1 bg-gradient-to-r from-red-500 to-blue-500 mx-auto mt-4 rounded-full"></div>
        </div>

        <!-- Posts Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8 mb-12">
            @foreach ($listPrideOfNigeriaPostsData['prideOfNigeriaPostsData'] as $index => $post)
            <article class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden border border-gray-100 hover:border-red-200 transform hover:-translate-y-2">
                <!-- Image Container -->
                <div class="relative overflow-hidden">
                    <img src="{{ $post['featured_image'] ?? asset('default-image.jpg') }}" 
                         alt="{{ $post['title'] ?? 'No title' }}"
                         class="w-full h-56 object-cover group-hover:scale-110 transition-transform duration-500">
                    
                    <!-- Overlay Gradient -->
                    <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    
                    <!-- Featured Badge -->
                    @if($index < 3)
                    <div class="absolute top-4 left-4">
                        <span class="bg-gradient-to-r from-red-500 to-blue-500 text-white px-3 py-1 rounded-full text-xs font-semibold shadow-lg">
                            Featured
                        </span>
                    </div>
                    @endif
                </div>

                <!-- Content -->
                <div class="p-6">
                    <h3 class="font-bold text-lg mb-3 text-gray-800 line-clamp-2 group-hover:text-red-600 transition-colors duration-200">
                        {{ $post['title'] ?? 'Untitled' }}
                    </h3>
                    
                    <p class="text-gray-600 text-sm mb-4 line-clamp-3 leading-relaxed">
                        {{ $post['meta_description'] ?? 'No description available.' }}
                    </p>
                    
                    <!-- Read More Button -->
                    <a href="{{ route('post.details', ['slug' => $post['slug'] ?? '#']) }}"
                       class="inline-flex items-center justify-center w-full bg-gradient-to-r from-red-500 to-blue-500 text-white py-3 px-4 rounded-xl font-semibold text-sm hover:from-red-600 hover:to-blue-600 transition-all duration-200 transform hover:scale-105 shadow-lg hover:shadow-xl">
                        <span>Read More</span>
                        <svg class="ml-2 w-4 h-4 group-hover:translate-x-1 transition-transform duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
                        </svg>
                    </a>
                </div>
            </article>
            @endforeach
        </div>

        <!-- Pagination -->
        {{-- @if (isset($listPrideOfNigeriaPostsData['pagination']) && $listPrideOfNigeriaPostsData['pagination']['last_page'] > 1)
        <div class="flex justify-center mb-8">
            <nav aria-label="Pagination" class="bg-white rounded-2xl shadow-lg p-2 border border-gray-100">
                <ul class="flex items-center space-x-1">
                    @if ($listPrideOfNigeriaPostsData['pagination']['current_page'] > 1)
                    <li>
                        <a href="?page={{ $listPrideOfNigeriaPostsData['pagination']['current_page'] - 1 }}"
                           class="flex items-center justify-center w-10 h-10 bg-gradient-to-r from-red-500 to-blue-500 text-white rounded-xl hover:from-red-600 hover:to-blue-600 transition-all duration-200 shadow-md hover:shadow-lg">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                            </svg>
                        </a>
                    </li>
                    @endif
                    
                    <li>
                        <span class="flex items-center justify-center w-10 h-10 bg-gray-100 text-gray-700 rounded-xl font-semibold">
                            {{ $listPrideOfNigeriaPostsData['pagination']['current_page'] }}
                        </span>
                    </li>
                    
                    @if ($listPrideOfNigeriaPostsData['pagination']['current_page'] < $listPrideOfNigeriaPostsData['pagination']['last_page'])
                    <li>
                        <a href="?page={{ $listPrideOfNigeriaPostsData['pagination']['current_page'] + 1 }}"
                           class="flex items-center justify-center w-10 h-10 bg-gradient-to-r from-red-500 to-blue-500 text-white rounded-xl hover:from-red-600 hover:to-blue-600 transition-all duration-200 shadow-md hover:shadow-lg">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </a>
                    </li>
                    @endif
                </ul>
            </nav>
        </div>
        @endif --}}

        <!-- See More Button -->
        {{-- <div class="text-center">
            <button class="group bg-gradient-to-r from-red-500 to-blue-500 text-white px-8 py-4 rounded-2xl font-bold text-lg hover:from-red-600 hover:to-blue-600 transition-all duration-300 transform hover:scale-105 shadow-2xl hover:shadow-3xl border-2 border-transparent hover:border-white/20">
                <span class="flex items-center justify-center">
                    Explore More Stories
                    <svg class="ml-3 w-5 h-5 group-hover:translate-x-2 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                    </svg>
                </span>
            </button>
        </div> --}}
    </div>
</section>
@endif