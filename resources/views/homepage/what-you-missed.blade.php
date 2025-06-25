@if (count($postsData) > 0)
<section class="max-w-7xl mx-auto px-4 py-16">
  <!-- Section Header -->
<div class="text-center mb-16">
    <h2 class="text-4xl font-bold bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent mb-4">
        In Case You Missed It
    </h2>
    <p class="text-xl text-gray-600 max-w-2xl mx-auto">
        Catch up on important reads, updates, and highlights you may have overlooked
    </p>
</div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Articles Grid - Takes 2/3 of the space -->
        <div class="lg:col-span-2 space-y-6">
            @foreach ($postsData as $index => $post)
                @if ($index === 0)
                    <!-- Featured Article (First Post) -->
                    <article class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-xl transition-all duration-300 group">
                        <div class="h-2 bg-gradient-to-r from-blue-500 to-purple-600"></div>
                        <div class="p-8">
                            <div class="flex items-center mb-4">
                                <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-3 py-1 rounded-full">Featured</span>
                            </div>
                            <h3 class="text-2xl font-bold text-gray-900 mb-4 group-hover:text-blue-600 transition-colors">
                                {{ $post['title'] ?? 'Untitled' }}
                            </h3>
                            {{-- @if (isset($post['excerpt']) || isset($post['content']))
                                <p class="text-gray-600 mb-6 line-clamp-3">
                                    {{ $post['excerpt'] ?? Str::limit(strip_tags($post['content'] ?? ''), 150) }}
                                </p>
                            @endif --}}
                            <div class="flex items-center justify-between flex-wrap gap-4">
                                <div class="flex items-center space-x-4">
                                    <div class="flex items-center text-sm text-gray-500">
                                        <i class="fas fa-user mr-2"></i>
                                        <span>{{ $post['created_by'] ?? 'Anonymous' }}</span>
                                    </div>
                                    <div class="flex items-center text-sm text-gray-500">
                                        <i class="far fa-clock mr-2"></i>
                                        <span>{{ isset($post['created_at']) ? \Carbon\Carbon::parse($post['created_at'])->diffForHumans() : '' }}</span>
                                    </div>
                                </div>
                                <a href="{{ route('post.details', $post['slug'] ?? '#') }}" 
                                   class="inline-flex items-center text-blue-600 hover:text-blue-800 font-semibold transition-colors group/link">
                                    Read more 
                                    <i class="fas fa-arrow-right ml-2 transform group-hover/link:translate-x-1 transition-transform"></i>
                                </a>
                            </div>
                        </div>
                    </article>
                @else
                    <!-- Regular Articles -->
                    <article class="bg-white rounded-xl p-6 shadow-md hover:shadow-lg transition-all duration-300 border border-gray-100 group">
                        <h3 class="text-xl font-semibold text-gray-900 mb-3 group-hover:text-blue-600 transition-colors">
                            {{ $post['title'] ?? 'Untitled' }}
                        </h3>
                        {{-- @if (isset($post['excerpt']) || isset($post['content']))
                            <p class="text-gray-600 mb-4 line-clamp-2">
                                {{ $post['excerpt'] ?? Str::limit(strip_tags($post['content'] ?? ''), 100) }}
                            </p>
                        @endif --}}
                        <div class="flex items-center justify-between flex-wrap gap-4">
                            <div class="flex items-center space-x-4">
                                <div class="flex items-center text-sm text-gray-500">
                                    <i class="fas fa-user mr-2"></i>
                                    <span>{{ $post['created_by'] ?? 'Anonymous' }}</span>
                                </div>
                                <div class="flex items-center text-sm text-gray-500">
                                    <i class="far fa-clock mr-2"></i>
                                    <span>{{ isset($post['created_at']) ? \Carbon\Carbon::parse($post['created_at'])->diffForHumans() : '' }}</span>
                                </div>
                            </div>
                            <a href="{{ route('post.details', $post['slug'] ?? '#') }}" 
                               class="text-blue-600 hover:text-blue-800 font-medium transition-colors group/link">
                                Read more 
                                <i class="fas fa-arrow-right ml-1 transform group-hover/link:translate-x-1 transition-transform"></i>
                            </a>
                        </div>
                    </article>
                @endif
            @endforeach
        </div>

        <!-- Enhanced Sidebar -->
        <div class="space-y-6">
            <!-- Newsletter Signup -->
            <div class="bg-gradient-to-br from-blue-50 to-purple-50 rounded-2xl p-8 border border-blue-100">
                <div class="text-center">
                    <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-purple-600 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-envelope text-white text-2xl"></i>
                    </div>
                    <h4 class="text-xl font-bold text-gray-900 mb-3">Stay Updated</h4>
                    <p class="text-gray-600 mb-6">
                        Get the latest articles and insights delivered straight to your inbox.
                    </p>
                    <div class="space-y-3">
                        <input type="email" placeholder="Enter your email" 
                               class="w-full px-4 py-3 rounded-lg border border-gray-200 focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition-all">
                        <button class="w-full bg-gradient-to-r from-blue-600 to-purple-600 text-white font-semibold py-3 px-6 rounded-lg hover:shadow-lg transform hover:-translate-y-0.5 transition-all duration-300">
                            Subscribe Now
                        </button>
                    </div>
                </div>
            </div>

            <!-- Article Stats -->
            <div class="bg-white rounded-xl p-6 shadow-md border border-gray-100">
                <h4 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-chart-line mr-2 text-green-600"></i>
                    Article Stats
                </h4>
                <div class="space-y-4">
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600">Total Articles</span>
                        <span class="font-semibold text-gray-900">{{ count($postsData) }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600">Latest Author</span>
                        <span class="font-semibold text-blue-600">{{ $postsData[0]['created_by'] ?? 'N/A' }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600">Last Updated</span>
                        <span class="font-semibold text-gray-900">
                            {{ isset($postsData[0]['created_at']) ? \Carbon\Carbon::parse($postsData[0]['created_at'])->format('M d') : 'N/A' }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Authors List -->
            @if (count($postsData) > 1)
                <div class="bg-white rounded-xl p-6 shadow-md border border-gray-100">
                    <h4 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                        <i class="fas fa-users mr-2 text-purple-600"></i>
                        Recent Authors
                    </h4>
                    <div class="space-y-3">
                        @foreach (collect($postsData)->take(5)->unique('created_by') as $post)
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 bg-gradient-to-br from-blue-400 to-purple-500 rounded-full flex items-center justify-center mr-3">
                                        <span class="text-white text-sm font-semibold">
                                            {{ strtoupper(substr($post['created_by'] ?? 'A', 0, 1)) }}
                                        </span>
                                    </div>
                                    <span class="text-gray-700 font-medium">{{ $post['created_by'] ?? 'Anonymous' }}</span>
                                </div>
                                <span class="text-xs text-gray-500">
                                    {{ isset($post['created_at']) ? \Carbon\Carbon::parse($post['created_at'])->format('M d') : '' }}
                                </span>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Back to Top Button -->
            <div class="bg-gradient-to-br from-gray-50 to-blue-50 rounded-xl p-6 text-center border border-gray-100">
                <div class="mb-4">
                    <i class="fas fa-arrow-up text-3xl text-blue-600"></i>
                </div>
                <h4 class="text-lg font-bold text-gray-800 mb-2">Missed Something?</h4>
                <p class="text-gray-600 mb-4 text-sm">
                    Scroll back up to catch any articles you might have missed.
                </p>
                <button onclick="window.scrollTo({top: 0, behavior: 'smooth'})" 
                        class="px-6 py-2 bg-gradient-to-r from-blue-600 to-purple-600 text-white font-semibold rounded-lg hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1">
                    Back to Top
                </button>
            </div>
        </div>
    </div>

    <!-- Load More Section (if needed) -->
    @if (count($postsData) >= 10)
        <div class="text-center mt-12">
            <button class="bg-white hover:bg-gray-50 text-gray-700 font-semibold py-3 px-8 rounded-lg border border-gray-200 hover:border-gray-300 transition-all duration-300 shadow-sm hover:shadow-md">
                Load More Articles
            </button>
        </div>
    @endif
</section>
@endif