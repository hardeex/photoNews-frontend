@extends('base.base')

@section('content')
    <div class="max-w-4xl mx-auto px-4 py-8">
        {{-- Header Section --}}
        <div class="mb-8">
            <h1 class="text-3xl font-bold mb-2">{{ $post['title'] }}</h1>
            <div class="flex items-center text-gray-600 text-sm">
                <span>Posted by {{ $post['created_by'] }}</span>
                <span class="mx-2">•</span>
                <span>{{ \Carbon\Carbon::parse($post['created_at'])->format('M d, Y') }}</span>
            </div>
        </div>

        {{-- Featured Image --}}
        <div class="mb-8">
            <img src="{{ $post['featured_image'] }}" alt="{{ $post['title'] }}"
                class="w-full h-96 object-cover rounded-lg shadow-lg">
        </div>

        {{-- Vehicle Details Grid --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8 bg-gray-50 p-6 rounded-lg">
            <div class="space-y-4">
                <div>
                    <h3 class="text-sm font-semibold text-gray-500">Vehicle Make</h3>
                    <p class="text-lg">{{ $post['vehicle_make'] }}</p>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-gray-500">Year</h3>
                    <p class="text-lg">{{ $post['vehicle_year'] }}</p>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-gray-500">Color</h3>
                    <p class="text-lg">{{ $post['vehicle_color'] }}</p>
                </div>
            </div>
            <div class="space-y-4">
                <div>
                    <h3 class="text-sm font-semibold text-gray-500">License Plate</h3>
                    <p class="text-lg">{{ $post['license_plate'] }}</p>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-gray-500">Location Stolen</h3>
                    <p class="text-lg">{{ $post['stolen_location'] }}</p>
                </div>
                <div>
                    <h3 class="text-sm font-semibold text-gray-500">Theft Date</h3>
                    <p class="text-lg">{{ \Carbon\Carbon::parse($post['theft_date'])->format('M d, Y h:i A') }}</p>
                </div>
            </div>
        </div>

        {{-- Content Section --}}
        <div class="prose max-w-none mb-8">
            {!! $post['content'] !!}
        </div>

        {{-- Engagement Stats --}}
        <div class="flex items-center space-x-6 text-sm text-gray-600 border-t pt-6">
            <div class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                </svg>
                <span>{{ number_format($post['views']) }} views</span>
            </div>
            <div class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
                </svg>
                <span>{{ number_format($post['shares']) }} shares</span>
            </div>
            <div class="flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5" />
                </svg>
                <span>{{ number_format($post['likes']) }} likes</span>
            </div>
        </div>

        @if ($post['allow_comments'])
            {{-- Comments Section --}}
            <div class="mt-12">
                <h2 class="text-2xl font-bold mb-6">Comments</h2>
                {{-- Add your comments component here --}}
            </div>
        @endif
    </div>
@endsection

@section('meta')
    <meta name="description" content="{{ $post['meta_description'] }}">
    <meta property="og:title" content="{{ $post['meta_title'] }}">
    <meta property="og:description" content="{{ $post['meta_description'] }}">
    <meta property="og:image" content="{{ $post['featured_image'] }}">
    <title>{{ $post['meta_title'] }}</title>
@endsection
