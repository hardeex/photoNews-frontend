@extends('base.base')
@section('title', 'News Category')

@section('content')
    <div class="bg-gray-100 min-h-screen p-4 md:p-8">
        <div class="max-w-7xl mx-auto">
            <!-- Newspaper Header -->
            <div class="text-center border-b-4 border-black pb-4 mb-6">
                <h1 class="text-4xl md:text-6xl font-serif font-bold tracking-tight mb-2">Essential Nigeria News</h1>
                <div
                    class="text-sm border-t border-b border-gray-400 py-2 my-2 flex flex-col md:flex-row justify-between items-center">
                    <span>{{ \Carbon\Carbon::now()->format('l, F d, Y') }}</span>
                    <span class="hidden md:block">|</span>
                    <span>Volume XXIII</span>
                    <span class="hidden md:block">|</span>
                    <span>Breaking News & Latest Updates</span>
                </div>
            </div>

            <!-- Search and Categories Section -->
            <div class="mb-6 p-4 bg-white shadow-lg">
                <!-- Search Bar -->
                <div class="flex mb-4">
                    <input type="text" placeholder="search news for {{ \Carbon\Carbon::now()->format('d-m/y') }}"
                        class="flex-grow p-2 border-2 border-gray-300 rounded-l-md focus:border-purple-600 focus:ring-0">
                    <button
                        class="bg-purple-600 text-white px-6 py-2 rounded-r-md hover:bg-purple-700 transition duration-300">
                        <i class="fas fa-search mr-2"></i>Search
                    </button>
                </div>

                <!-- Categories as Newspaper Sections -->
                <div class="grid grid-cols-2 md:grid-cols-4 gap-2">
                    @foreach (['Trending', 'Hot gist', 'Music', 'Latest', 'News', 'Top Topic', 'Local', 'Photo News'] as $category)
                        <button
                            class="px-4 py-2 bg-gray-100 border border-gray-300 hover:bg-purple-100 transition duration-300 text-sm font-serif">
                            {{ $category }}
                        </button>
                    @endforeach
                </div>
            </div>

            @if (count($postsData) > 0)
                <!-- Newspaper Grid Layout -->
                <div class="grid grid-cols-1 md:grid-cols-12 gap-6">
                    <!-- Main Story Column -->
                    <div class="md:col-span-8 space-y-6">
                        <!-- Featured Story -->
                        @php $mainStory = $postsData[0]; @endphp
                        <div class="bg-white p-4 shadow-lg">
                            <div class="relative">
                                <img src="{{ $mainStory['featured_image'] }}" alt="{{ $mainStory['title'] }}"
                                    class="w-full h-[400px] object-cover">
                                <span class="absolute top-4 right-4 bg-red-600 text-white px-3 py-1 text-sm font-bold">
                                    {{ ucwords(strtolower($mainStory['category_names'])) }}
                                </span>
                            </div>
                            <h2 class="text-3xl font-serif font-bold mt-4 mb-3">
                                <a href="{{ route('post.details', $mainStory['slug'] ?? '#') }}"
                                    class="hover:text-purple-600 transition duration-300">
                                    {{ ucwords($mainStory['title']) }}
                                </a>
                            </h2>
                            <p class="text-gray-600 text-lg mb-3 font-serif leading-relaxed">
                                {!! Str::limit(strip_tags($mainStory['content']), 300) !!}
                            </p>
                            <div class="flex items-center justify-between text-sm border-t border-gray-200 pt-3">
                                <span class="italic">By {{ $mainStory['created_by'] }}</span>
                                <span>{{ \Carbon\Carbon::parse($mainStory['created_at'])->format('F d, Y') }}</span>
                            </div>
                        </div>

                        <!-- Secondary Stories Grid -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            @foreach (array_slice($postsData, 1, 4) as $post)
                                <div class="bg-white p-4 shadow-lg">
                                    <div class="relative mb-3">
                                        <img src="{{ $post['featured_image'] }}" alt="{{ $post['title'] }}"
                                            class="w-full h-48 object-cover">
                                        <span class="absolute top-2 right-2 bg-purple-600 text-white px-2 py-1 text-xs">
                                            {{ ucwords(strtolower($post['category_names'])) }}
                                        </span>
                                    </div>
                                    <h3 class="text-xl font-serif font-bold mb-2">
                                        <a href="{{ route('post.details', $post['slug'] ?? '#') }}"
                                            class="hover:text-purple-600 transition duration-300">
                                            {{ ucwords($post['title']) }}
                                        </a>
                                    </h3>
                                    <p class="text-gray-600 mb-3 line-clamp-3">
                                        {!! Str::limit(strip_tags($post['content']), 150) !!}
                                    </p>
                                    <div class="flex items-center justify-between text-xs text-gray-500">
                                        <div class="flex items-center space-x-4">
                                            <span><i class="fas fa-eye mr-1"></i>{{ $post['views'] }}</span>
                                            <span><i class="fas fa-heart mr-1"></i>{{ $post['likes'] }}</span>
                                        </div>
                                        <span>{{ \Carbon\Carbon::parse($post['created_at'])->diffForHumans() }}</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Sidebar Column -->
                    <div class="md:col-span-4 space-y-6">
                        <!-- Advertisement Box -->
                        <div class="bg-purple-100 p-6 shadow-lg text-center">
                            <h3 class="text-2xl font-serif font-bold text-purple-800">ADVERTISE HERE !!</h3>
                            <p class="text-purple-600 mt-2">Contact us for rates</p>
                        </div>

                        <!-- Latest Updates -->
                        <div class="bg-white p-4 shadow-lg">
                            <h3 class="text-xl font-serif font-bold border-b-2 border-gray-300 pb-2 mb-4">Latest Updates
                            </h3>
                            @foreach (array_slice($postsData, 5) as $post)
                                <div class="mb-4 pb-4 border-b border-gray-200 last:border-0">
                                    <h4 class="font-serif font-bold mb-1">
                                        <a href="{{ route('post.details', $post['slug'] ?? '#') }}"
                                            class="hover:text-purple-600 transition duration-300">
                                            {{ ucwords($post['title']) }}
                                        </a>
                                    </h4>
                                    <div class="flex justify-between text-xs text-gray-500">
                                        <span>{{ \Carbon\Carbon::parse($post['created_at'])->format('M d, Y') }}</span>
                                        <span><i class="fas fa-eye mr-1"></i>{{ $post['views'] }}</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <!-- Quick Stats -->
                        <div class="bg-white p-4 shadow-lg">
                            <h3 class="text-xl font-serif font-bold border-b-2 border-gray-300 pb-2 mb-4">Today's Highlights
                            </h3>
                            <div class="space-y-2 text-sm">
                                <div class="flex justify-between">
                                    <span>Breaking News</span>
                                    <span class="font-bold">{{ count($postsData) }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span>Total Views</span>
                                    <span class="font-bold">{{ collect($postsData)->sum('views') }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span>Total Shares</span>
                                    <span class="font-bold">{{ collect($postsData)->sum('shares') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pagination -->
                @if ($pagination['total'] > 0 && $pagination['last_page'] > 1)
                    <div class="mt-8 flex justify-center">
                        <nav class="inline-flex rounded-md shadow-sm">
                            @if ($pagination['current_page'] > 1)
                                <a href="{{ route('news', ['page' => $pagination['current_page'] - 1]) }}"
                                    class="px-4 py-2 border border-gray-300 text-gray-700 bg-white hover:bg-gray-50 rounded-l-md">
                                    Previous
                                </a>
                            @endif

                            <span class="px-4 py-2 border-t border-b border-gray-300 bg-gray-100">
                                Page {{ $pagination['current_page'] }} of {{ $pagination['last_page'] }}
                            </span>

                            @if ($pagination['current_page'] < $pagination['last_page'])
                                <a href="{{ route('news', ['page' => $pagination['current_page'] + 1]) }}"
                                    class="px-4 py-2 border border-gray-300 text-gray-700 bg-white hover:bg-gray-50 rounded-r-md">
                                    Next
                                </a>
                            @endif
                        </nav>
                    </div>
                @endif
            @else
                <div class="text-center py-12">
                    <div class="bg-white p-8 rounded-lg shadow-lg inline-block">
                        <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9.5a2 2 0 00-2-2h-2m-4 0h4">
                            </path>
                        </svg>
                        <p class="text-xl font-serif text-gray-600">No posts available at the moment.</p>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
