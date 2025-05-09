@extends('base.base')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <!-- Header Section -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Lost and Found Items</h1>
            <p class="mt-2 text-sm text-gray-600">Browse through recently reported lost and found items</p>
        </div>

        @if (count($postsData) > 0)
            <!-- Grid Layout -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($postsData as $post)
                    <article
                        class="bg-white rounded-lg shadow-sm overflow-hidden hover:shadow-md transition-shadow duration-300">
                        <!-- Image Container -->
                        <div class="relative aspect-w-16 aspect-h-9">
                            <img src="{{ $post['featured_image'] }}" alt="{{ $post['title'] }}"
                                class="w-full h-48 object-cover">
                            @if ($post['is_featured'])
                                <span
                                    class="absolute top-2 right-2 bg-yellow-100 text-yellow-800 text-xs px-2 py-1 rounded-full">
                                    Featured
                                </span>
                            @endif
                        </div>

                        <!-- Content -->
                        <div class="p-4">
                            <h2 class="text-xl font-semibold text-gray-900 mb-2">{{ $post['title'] }}</h2>

                            <p class="text-gray-600 text-sm mb-4">
                                {{ Str::limit(strip_tags($post['content']), 100) }}
                            </p>

                            <!-- Contact Info -->
                            <div class="flex items-center mb-4 text-sm text-gray-600">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                                {{ $post['phone_number'] }}
                            </div>

                            <!-- Meta Information -->
                            <div class="flex justify-between items-center text-sm text-gray-500 mb-4">
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                    {{ $post['views'] }} views
                                </div>
                                <span>
                                    {{ \Carbon\Carbon::parse($post['created_at'])->diffForHumans() }}
                                </span>
                            </div>

                            <!-- Action Buttons -->
                            <div class="flex justify-between items-center">
                                <a href="{{ route('misplaced.details', ['slug' => $post['slug']]) }}"
                                    class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-300">
                                    Read More
                                    <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                    </svg>
                                </a>

                                @if ($post['allow_comments'])
                                    <button class="text-gray-500 hover:text-gray-700">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                                        </svg>
                                    </button>
                                @endif
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>

            <!-- Pagination -->
            @if ($pagination['total'] > $pagination['per_page'])
                <div class="mt-8">
                    <nav class="flex justify-center">
                        <ul class="flex space-x-2">
                            <li>
                                <a href="?page={{ $pagination['current_page'] - 1 }}"
                                    class="{{ !$pagination['prev_page_url'] ? 'opacity-50 cursor-not-allowed' : '' }} px-3 py-2 rounded-md bg-white text-gray-700 border hover:bg-gray-50"
                                    {{ !$pagination['prev_page_url'] ? 'disabled' : '' }}>
                                    Previous
                                </a>
                            </li>
                            <li>
                                <a href="?page={{ $pagination['current_page'] + 1 }}"
                                    class="{{ !$pagination['next_page_url'] ? 'opacity-50 cursor-not-allowed' : '' }} px-3 py-2 rounded-md bg-white text-gray-700 border hover:bg-gray-50"
                                    {{ !$pagination['next_page_url'] ? 'disabled' : '' }}>
                                    Next
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            @endif
        @else
            <div class="text-center py-12">
                <div class="max-w-xl mx-auto">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">No posts found</h3>
                    <p class="mt-1 text-sm text-gray-500">No lost and found items have been posted yet.</p>
                </div>
            </div>
        @endif
    </div>
@endsection
