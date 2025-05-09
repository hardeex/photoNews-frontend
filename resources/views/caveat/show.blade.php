{{-- resources/views/caveat/show.blade.php --}}
@extends('base.base')

@section('content')
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        @if ($post)
            {{-- Article Header --}}
            <header class="mb-8">
                <h1 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-4 capitalize">
                    {{ $post['title'] ?? 'Untitled' }}
                </h1>
                
                <div class="flex flex-wrap items-center text-sm text-gray-600 gap-4">
                    <div class="flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        <span>By {{ $post['creator']['name'] ?? 'Unknown Author' }}</span>
                    </div>
                    <div class="flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <span>{{ isset($post['created_at']) ? \Carbon\Carbon::parse($post['created_at'])->format('M d, Y') : 'Date not available' }}</span>
                    </div>
                </div>
            </header>

            {{-- Featured Image --}}
            @if (isset($post['featured_image']) && $post['featured_image'])
                <div class="mb-8 rounded-lg overflow-hidden shadow-lg">
                    <img src="{{ $post['featured_image'] }}" alt="{{ $post['title'] ?? 'Featured image' }}"
                        class="w-full h-auto object-cover"
                        onerror="this.onerror=null; this.src='{{ asset('images/placeholder.jpg') }}';">
                </div>
            @endif

            {{-- Content --}}
            <article class="prose prose-lg max-w-none mb-8">
                {!! $post['content'] ?? 'No content available' !!}
            </article>

            {{-- Engagement Stats --}}
            <div class="flex flex-wrap gap-4 py-6 border-t border-gray-200">
                <div class="flex items-center">
                    <svg class="w-5 h-5 text-gray-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                    <span class="text-gray-600">{{ number_format($post['views'] ?? 0) }} views</span>
                </div>
                <div class="flex items-center">
                    <svg class="w-5 h-5 text-gray-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
                    </svg>
                    <span class="text-gray-600">{{ number_format($post['shares'] ?? 0) }} shares</span>
                </div>
                <div class="flex items-center">
                    <svg class="w-5 h-5 text-gray-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5" />
                    </svg>
                    <span class="text-gray-600">{{ number_format($post['likes'] ?? 0) }} likes</span>
                </div>
            </div>

            {{-- Meta Information --}}
            @if (isset($post['meta_description']) && $post['meta_description'])
                <div class="mt-8 p-4 bg-gray-50 rounded-lg">
                    <h2 class="text-lg font-semibold text-gray-900 mb-2">About this Caveat</h2>
                    <p class="text-gray-600">{{ $post['meta_description'] }}</p>
                </div>
            @endif

            {{-- Comments Section (if allowed) --}}
            @if (isset($post['allow_comments']) && $post['allow_comments'])
                <div class="mt-8">
                    <h2 class="text-2xl font-bold text-gray-900 mb-4">Comments</h2>
                    {{-- Add your comments component here --}}
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <p class="text-gray-600">Comments section coming soon...</p>
                    </div>
                </div>
            @endif
        @else
            <div class="text-center py-12">
                <h2 class="text-2xl font-bold text-gray-900 mb-4">Caveat Not Found</h2>
                <p class="text-gray-600">The requested caveat could not be found or might have been removed.</p>
                <a href="#" class="mt-4 inline-block bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700">
                    Back to Caveats
                </a>
            </div>
        @endif
    </div>
@endsection
