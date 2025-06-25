
<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <h2 class="text-xl sm:text-2xl font-bold mb-6 bg-red-600 text-white p-2 rounded">Featured Entertainment News</h2>

    {{-- <div class="flex flex-wrap gap-2 mb-6">
        @foreach (['Gold Market', 'Nigeria\'s Inflation Rate Eases to 33.40%', 'Adekunle Gold', 'Nigeria and Guinea Strengthen Ties', 'Nigeria\'s Economic Activity Declines Again'] as $tag)
            <span class="bg-purple-200 text-purple-800 text-xs px-2 py-1 rounded">{{ $tag }}</span>
        @endforeach
    </div> --}}

    <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
        <!-- Breaking News Section -->
        <div class="lg:col-span-3">
            @if (count($breakingPostsData) > 0)
                <h2 class="text-xl sm:text-2xl font-bold mb-4 text-gray-800">Breaking News</h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    @foreach ($breakingPostsData as $post)
                        <a href="{{ route('post.details', $post['slug'] ?? '#') }}"
                           class="block hover:shadow-lg transition-all duration-300 rounded-lg overflow-hidden">
                            <div class="bg-white rounded-lg border border-gray-100">
                                @if ($post['featured_image'])
                                    <img src="{{ $post['featured_image'] }}"
                                         alt="{{ ucwords(strtolower($post['title'])) }}"
                                         class="w-full h-48 sm:h-64 object-cover">
                                @else
                                    <img src="https://picsum.photos/seed/news/1200/600"
                                         alt="{{ ucwords(strtolower($post['title'])) }}"
                                         class="w-full h-48 sm:h-64 object-cover">
                                @endif
                                <div class="p-4">
                                    <h3 class="text-lg sm:text-xl font-semibold mb-2 break-words text-gray-800">
                                        {{ $post['title'] ?? 'Untitled' }}
                                    </h3>
                                    <p class="text-gray-600 text-sm sm:text-base">
                                        {{ \Illuminate\Support\Str::limit(strip_tags($post['content']), 100, '...') }}
                                    </p>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            @else
                <p class="text-gray-600">No breaking news available.</p>
            @endif
        </div>

        <!-- Music News Sidebar -->
        <div class="lg:sticky lg:top-4">
            <div class="bg-gray-50 rounded-lg shadow-sm p-4 sm:p-6">
                <div class="flex justify-between items-center mb-4 border-b border-gray-200 pb-3">
                    <h4 class="text-lg sm:text-xl font-semibold text-gray-800">Music News</h4>
                    <a href="{{ route('news') ?? '#' }}"
                       class="text-blue-600 text-sm font-medium hover:text-blue-800 transition-colors duration-200">
                        View All <i class="fas fa-arrow-right ml-1"></i>
                    </a>
                </div>

                @if (count($musicPostsData['posts']) > 0)
                    <div class="space-y-4">
                        @foreach (collect($musicPostsData['posts'])->take(2) as $index => $post)
                            <a href="{{ route('post.details', $post['slug'] ?? '#') }}"
                               class="block group hover:shadow-md transition-all duration-300 rounded-lg overflow-hidden">
                                <div class="bg-white rounded-lg border border-gray-100 flex flex-col">
                                    <div class="relative">
                                        @if ($post['featured_image'])
                                            <img src="{{ $post['featured_image'] }}"
                                                 alt="Music News: {{ $post['title'] ?? 'Untitled' }}"
                                                 class="w-full h-32 sm:h-40 object-cover transition-transform duration-500 group-hover:scale-105">
                                        @else
                                            <img src="/images/news-image.jpeg"
                                                 alt="Music News: {{ $post['title'] ?? 'Untitled' }}"
                                                 class="w-full h-32 sm:h-40 object-cover transition-transform duration-500 group-hover:scale-105">
                                        @endif
                                        <span class="absolute top-2 right-2 bg-blue-600 text-white text-xs px-2 py-1 rounded-full">Music</span>
                                    </div>
                                    <div class="p-4 flex flex-col">
                                        <h5 class="font-semibold text-base sm:text-lg text-gray-800 line-clamp-2 mb-2 group-hover:text-blue-600">
                                            {{ $post['title'] ?? 'Untitled' }}
                                        </h5>
                                        <span class="text-xs bg-blue-100 text-blue-800 px-2 py-1 rounded mb-3">
                                            {{ \Carbon\Carbon::parse($post['created_at'])->format('M d, Y') }}
                                            ({{ \Carbon\Carbon::parse($post['created_at'])->diffForHumans() }})
                                        </span>
                                        <p class="text-gray-600 text-sm line-clamp-2 flex-grow">
                                            {!! \Illuminate\Support\Str::limit(strip_tags($post['content']), 100) !!}
                                        </p>
                                        <div class="flex items-center text-xs text-gray-500 gap-3 mt-3 pt-2 border-t border-gray-100">
                                            <span><i class="fas fa-eye mr-1"></i>{{ $post['views'] }} views</span>
                                            <span><i class="fas fa-share mr-1"></i>{{ $post['shares'] }} shares</span>
                                            <span><i class="fas fa-heart mr-1"></i>{{ $post['likes'] }} likes</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                    <div class="text-center mt-6 sm:hidden">
                        <a href="{{ route('news') ?? '#' }}"
                           class="inline-block bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                            View All Music News
                        </a>
                    </div>
                @else
                    <div class="bg-white rounded-lg border border-gray-200 text-center py-8 px-4">
                        <div class="mx-auto w-16 h-16 text-gray-400 mb-4">
                            <svg fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M9 9l10.5-3m0 6.553v3.75a2.25 2.25 0 01-1.632 2.163l-1.32.377a1.803 1.803 0 11-.99-3.467l2.31-.66a2.25 2.25 0 001.632-2.163zm0 0V2.25L9 5.25v10.303m0 0v3.75a2.25 2.25 0 01-1.632 2.163l-1.32.377a1.803 1.803 0 01-.99-3.467l2.31-.66A2.25 2.25 0 009 15.553z">
                                </path>
                            </svg>
                        </div>
                        <p class="text-gray-600 mb-3">No music news available at the moment.</p>
                        <button class="text-blue-600 border border-blue-600 px-4 py-2 rounded-lg hover:bg-blue-50">
                            <i class="fas fa-bell mr-1"></i> Get notified
                        </button>
                    </div>
                @endif

                <!-- Popular Categories (Collapsible on Mobile) -->
                <div class="mt-6 pt-4 border-t border-gray-200">
                    <button class="sm:hidden w-full text-left text-sm font-medium text-gray-700 mb-3 flex justify-between items-center"
                            onclick="this.nextElementSibling.classList.toggle('hidden')">
                        Popular Categories
                        <i class="fas fa-chevron-down"></i>
                    </button>
                    <div class="flex flex-wrap gap-2 hidden sm:flex">
                        @foreach (['Artists', 'Albums', 'Concerts', 'Reviews', 'Interviews'] as $category)
                            <a href="{{ route('news', strtolower($category)) ?? '#' }}"
                               class="px-3 py-1 bg-gray-200 hover:bg-gray-300 text-gray-800 text-xs rounded-full">
                               {{ $category }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

