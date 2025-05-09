@extends('base.base')

@section('content')
    <div class="container mx-auto p-6 md:p-8">
        <div class="bg-white p-8 rounded-xl shadow-lg space-y-8">

            <!-- Meta Information -->
            @if ($post['meta_title'] || $post['meta_description'])
                <div class="text-center mb-6">
                    <meta name="title" content="{{ $post['meta_title'] }}">
                    <meta name="description" content="{{ $post['meta_description'] }}">
                    <h2 class="text-lg font-semibold text-gray-800">Meta Information</h2>
                </div>
            @endif

            <!-- Post Header -->
            <div class="flex flex-col items-center text-center">
                <img src="{{ $post['featured_image'] }}" alt="Child Dedication Image"
                    class="w-full h-80 object-cover rounded-xl shadow-md mb-6">
                <h1 class="text-4xl font-extrabold text-gray-900 leading-tight">{{ $post['title'] }}</h1>
                <p class="text-lg text-gray-600 mt-2">
                    {{ \Carbon\Carbon::parse($post['dedication_date'])->format('F j, Y') }}</p>

                <!-- Status and Tags -->
                <div class="flex gap-3 mt-4 justify-center">
                    @if ($post['is_featured'])
                        <span
                            class="bg-yellow-100 text-yellow-800 text-xs font-semibold px-3 py-1 rounded-full">Featured</span>
                    @endif
                    @if ($post['is_draft'])
                        <span class="bg-gray-100 text-gray-800 text-xs font-semibold px-3 py-1 rounded-full">Draft</span>
                    @endif
                    @if ($post['is_scheduled'])
                        <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-3 py-1 rounded-full">
                            Scheduled for {{ \Carbon\Carbon::parse($post['scheduled_time'])->format('M j, Y H:i') }}
                        </span>
                    @endif
                </div>
            </div>

            <!-- Event Details -->
            @if ($post['parents_names'])
                <div class="bg-gray-50 p-6 rounded-lg mt-8">
                    <h3 class="text-xl font-semibold text-gray-800 mb-4">Event Details</h3>
                    <div class="text-gray-700">
                        <strong class="text-gray-900">Parents' Names: </strong>{{ $post['parents_names'] }}
                    </div>
                </div>
            @endif

            <!-- Post Content -->
            <div class="prose lg:prose-xl mb-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">Celebration Details</h2>
                {!! $post['content'] !!}
            </div>

            <!-- Feedback Section -->
            @if ($post['review_feedback'])
                <div class="bg-yellow-50 p-6 rounded-lg mb-6">
                    <h3 class="font-semibold text-gray-800 text-lg mb-4">Review Feedback</h3>
                    <p class="text-gray-700">{{ $post['review_feedback'] }}</p>
                </div>
            @endif

            <!-- Stats & Analytics -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 text-center">
                <div class="bg-gray-100 p-4 rounded-xl">
                    <h4 class="text-xl text-gray-800 font-semibold">Views</h4>
                    <p class="text-3xl text-gray-600">{{ $post['views'] }}</p>
                </div>
                <div class="bg-gray-100 p-4 rounded-xl">
                    <h4 class="text-xl text-gray-800 font-semibold">Likes</h4>
                    <p class="text-3xl text-gray-600">{{ $post['likes'] }}</p>
                </div>
                <div class="bg-gray-100 p-4 rounded-xl">
                    <h4 class="text-xl text-gray-800 font-semibold">Shares</h4>
                    <p class="text-3xl text-gray-600">{{ $post['shares'] }}</p>
                </div>
                <div class="bg-gray-100 p-4 rounded-xl">
                    <h4 class="text-xl text-gray-800 font-semibold">Dislikes</h4>
                    <p class="text-3xl text-gray-600">{{ $post['dislikes'] }}</p>
                </div>
            </div>

            <!-- Meta & Date -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mt-8 text-gray-600">
                <div class="flex justify-between items-center">
                    <span><strong>Created On:</strong>
                        {{ \Carbon\Carbon::parse($post['created_at'])->format('M j, Y H:i') }}</span>
                    <span><strong>Last Updated:</strong>
                        {{ \Carbon\Carbon::parse($post['updated_at'])->format('M j, Y H:i') }}</span>
                </div>
                <div class="flex justify-between items-center">
                    <span><strong>Status:</strong> {{ ucfirst($post['status']) }}</span>
                    <span><strong>Comments:</strong>
                        @if ($post['allow_comments'])
                            Enabled
                        @else
                            Disabled
                        @endif
                    </span>
                </div>
            </div>

            <!-- Creator Information -->
            <div class="mt-8 border-t border-gray-300 pt-4 text-center text-sm text-gray-500">
                @if ($post['creator'])
                    <p>Created by <strong>{{ $post['creator']['name'] }}</strong></p>
                    <p>{{ $post['creator']['email'] }} | Role: {{ ucfirst($post['creator']['role']) }}</p>
                @else
                    <p>Creator information not available.</p>
                @endif
            </div>
        </div>
    </div>
@endsection
