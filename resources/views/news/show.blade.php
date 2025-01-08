@extends('base.base')
@section('title', 'News Category')

@section('content')
    <!-- resources/views/news-homepage.blade.php -->
    <div class="bg-gray-100 min-h-screen p-4">
        <div class="max-w-7xl mx-auto">
            <h1 class="text-3xl font-bold text-center mb-6">We have everything news here, from trending topic, to hot gist to
                latest news</h1>

            <!-- Search Bar -->
            <div class="flex mb-6">
                <input type="text" placeholder="search news for 12-09/24"
                    class="flex-grow p-2 border border-gray-300 rounded-l-md">
                <button
                    class="bg-purple-600 text-white px-4 py-2 rounded-r-md hover:bg-purple-700 transition duration-300">Search</button>
            </div>

            <!-- Categories -->
            <div class="flex space-x-4 mb-6 overflow-x-auto">
                @foreach (['Trending', 'Hot gist', 'Music', 'Latest', 'News', 'Top Topic', 'Local', 'Photo News'] as $category)
                    <button class="px-4 py-2 bg-white shadow rounded-full hover:bg-purple-100 transition duration-300">
                        {{ $category }}
                    </button>
                @endforeach
            </div>



            @if (count($postsData) > 0)
                <!-- News Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                    @foreach ($postsData as $post)
                        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                            <img src="{{ $post['featured_image'] }}" alt="{{ $post['title'] }}"
                                class="w-full h-48 object-cover">
                            <div class="p-4">
                                <h2 class="text-xl font-semibold mb-2">
                                    <a
                                        href="{{ route('post.details', $post['slug'] ?? '#') }}">{{ ucwords($post['title']) }}</a>
                                </h2>

                                </h2>
                                <p class="text-sm text-gray-600 mb-4">
                                    {!! Str::limit(strip_tags($post['content']), 150) !!}
                                </p>
                                <div class="flex items-center justify-between text-sm mb-2">
                                    <span class="font-medium">By: {{ $post['created_by'] }}</span>
                                    <span class="text-purple-600">Category:
                                        {{ ucwords(strtolower($post['category_names'])) }}</span>
                                </div>
                                <div class="flex items-center text-sm text-gray-500 mb-4">
                                    <svg class="h-4 w-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                                            clip-rule="evenodd" />
                                    </svg>
                                    <span> ({{ \Carbon\Carbon::parse($post['created_at'])->diffForHumans() }})</span>
                                </div>
                                <div class="flex items-center justify-between border-t pt-3">
                                    <div class="flex items-center space-x-4">
                                        <button class="flex items-center text-gray-600 hover:text-purple-600">
                                            <svg class="h-5 w-5 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path
                                                    d="M2 10.5a1.5 1.5 0 113 0v6a1.5 1.5 0 01-3 0v-6zM6 10.333v5.43a2 2 0 001.106 1.79l.05.025A4 4 0 008.943 18h5.416a2 2 0 001.962-1.608l1.2-6A2 2 0 0015.56 8H12V4a2 2 0 00-2-2 1 1 0 00-1 1v.667a4 4 0 01-.8 2.4L6.8 7.933a4 4 0 00-.8 2.4z" />
                                            </svg>
                                            <span> {{ $post['views'] }} views</span>
                                        </button>
                                        <button class="flex items-center text-gray-600 hover:text-purple-600">
                                            <svg class="h-5 w-5 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd"
                                                    d="M18 10c0 3.866-3.582 7-8 7a8.841 8.841 0 01-4.083-.98L2 17l1.338-3.123C2.493 12.767 2 11.434 2 10c0-3.866 3.582-7 8-7s8 3.134 8 7zM7 9H5v2h2V9zm8 0h-2v2h2V9zM9 9h2v2H9V9z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            <span>{{ $post['likes'] }} likes</span>
                                        </button>
                                    </div>
                                    <button class="flex items-center text-gray-600 hover:text-purple-600">
                                        <svg class="h-5 w-5 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M15 8a3 3 0 10-2.977-2.63l-4.94 2.47a3 3 0 100 4.319l4.94 2.47a3 3 0 10.895-1.789l-4.94-2.47a3.027 3.027 0 000-.74l4.94-2.47C13.456 7.68 14.19 8 15 8z" />
                                        </svg>
                                        Share
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <!-- Advertise Card -->
                    <div class="bg-purple-100 rounded-lg shadow-lg overflow-hidden flex items-center justify-center p-6">
                        <h3 class="text-2xl font-bold text-purple-800 text-center">ADVERTISE HERE !!</h3>
                    </div>
                </div>

                {{-- Pagination --}}
                @if ($pagination['total'] > 0 && $pagination['last_page'] > 1)
                    <div class="mt-6 flex justify-center">
                        <nav class="inline-flex rounded-md shadow-sm">
                            @if ($pagination['current_page'] > 1)
                                <a href="{{ route('news', ['page' => $pagination['current_page'] - 1]) }}"
                                    class="px-3 py-2 rounded-l-md border border-gray-300 text-gray-700 hover:bg-gray-50 hover:text-gray-800">
                                    Previous
                                </a>
                            @else
                                <span
                                    class="px-3 py-2 rounded-l-md border border-gray-300 text-gray-500 cursor-not-allowed">Previous</span>
                            @endif

                            @if ($pagination['current_page'] < $pagination['last_page'])
                                <a href="{{ route('news', ['page' => $pagination['current_page'] + 1]) }}"
                                    class="px-3 py-2 rounded-r-md border border-gray-300 text-gray-700 hover:bg-gray-50 hover:text-gray-800">
                                    Next
                                </a>
                            @else
                                <span
                                    class="px-3 py-2 rounded-r-md border border-gray-300 text-gray-500 cursor-not-allowed">Next</span>
                            @endif
                        </nav>
                    </div>
                @endif
            @else
                <p class="text-center text-xl text-gray-600">No posts available at the moment.</p>
            @endif
        </div>
    </div>
    </div>
@endsection
