@extends('base.base')

@section('content')
    <div class="min-h-screen bg-gradient-to-b from-pink-50 to-purple-50 py-12">
        <div class="container mx-auto px-4">
            <!-- Header Section -->
            <div class="text-center mb-12">
                <h1 class="text-4xl font-bold text-gray-800 mb-4">Birthday Celebrations</h1>
                <p class="text-gray-600">Celebrating life's special moments together</p>
            </div>

            <!-- Birthday Posts Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse ($postsData as $post)
                    <div
                        class="bg-white rounded-xl shadow-lg overflow-hidden transform hover:scale-105 transition-transform duration-300">
                        <!-- Featured Image -->
                        <div class="relative h-48 overflow-hidden">
                            <img src="{{ $post['featured_image'] }}" alt="{{ $post['title'] }}"
                                class="w-full h-full object-cover">
                            @if ($post['is_featured'])
                                <div class="absolute top-4 right-4">
                                    <span class="bg-yellow-400 text-yellow-900 text-xs font-bold px-3 py-1 rounded-full">
                                        Featured
                                    </span>
                                </div>
                            @endif
                        </div>

                        <!-- Content -->
                        <div class="p-6">
                            <div class="flex justify-between items-start mb-4">
                                <div>
                                    <h2 class="text-xl font-semibold text-gray-800 mb-2">{{ $post['title'] }}</h2>
                                    <p class="text-purple-600 font-medium">
                                        Turning {{ $post['celebrant_age'] }}
                                    </p>
                                </div>
                                <div class="flex flex-col items-end">
                                    <span class="text-sm text-gray-500">
                                        {{ \Carbon\Carbon::parse($post['dob'])->format('M d') }}
                                    </span>
                                </div>
                            </div>

                            <div class="prose prose-sm mb-4">
                                {!! Str::limit(strip_tags($post['content']), 100) !!}
                            </div>

                            <!-- Footer -->
                            <div class="mt-6 pt-4 border-t border-gray-100">
                                <div class="flex justify-between items-center">
                                    <div class="flex items-center space-x-2">
                                        <span class="text-sm text-gray-500">
                                            By {{ $post['creator']['name'] ?? 'Anonymous' }}
                                        </span>
                                    </div>
                                    <a href="{{ route('birthday.details', $post['slug']) }}"
                                        class="inline-flex items-center px-4 py-2 bg-purple-600 hover:bg-purple-700 text-white text-sm font-medium rounded-md transition-colors duration-300">
                                        View Details
                                    </a>
                                </div>
                            </div>

                            <!-- Engagement Stats -->
                            <div class="mt-4 flex justify-between text-sm text-gray-500">
                                <span class="flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                                    {{ $post['views'] }}
                                </span>
                                <span class="flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
                                    </svg>
                                    {{ $post['shares'] }}
                                </span>
                                <span class="flex items-center">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                    </svg>
                                    {{ $post['likes'] }}
                                </span>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full">
                        <div class="text-center py-12 bg-white rounded-lg shadow">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900">No birthday posts</h3>
                            <p class="mt-1 text-sm text-gray-500">Get started by creating a new birthday post.</p>
                        </div>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if ($pagination['total'] > $pagination['per_page'])
                <div class="mt-12">
                    <nav class="flex justify-center">
                        <ul class="flex space-x-2">
                            @if ($pagination['current_page'] > 1)
                                <li>
                                    <a href="?page={{ $pagination['current_page'] - 1 }}"
                                        class="px-4 py-2 bg-white border border-gray-300 rounded-md hover:bg-gray-50">
                                        Previous
                                    </a>
                                </li>
                            @endif

                            @if ($pagination['current_page'] < $pagination['last_page'])
                                <li>
                                    <a href="?page={{ $pagination['current_page'] + 1 }}"
                                        class="px-4 py-2 bg-white border border-gray-300 rounded-md hover:bg-gray-50">
                                        Next
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </nav>
                </div>
            @endif
        </div>
    </div>
@endsection
