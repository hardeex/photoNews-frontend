@extends('base.base')

@section('content')
    <div class="container mx-auto p-6">
        <div class="bg-white p-8 rounded-lg shadow-lg">
            <!-- Meta Information -->
            @if ($post['meta_title'] || $post['meta_description'])
                <div class="mb-6">
                    <h2 class="sr-only">Meta Information</h2>
                    <meta name="title" content="{{ $post['meta_title'] }}">
                    <meta name="description" content="{{ $post['meta_description'] }}">
                </div>
            @endif

            <!-- Post Header -->
            <div class="flex flex-col items-center mb-6">
                <img src="{{ $post['featured_image'] }}" alt="Birthday Celebration Image"
                    class="w-full h-64 object-cover rounded-lg mb-4">
                <h1 class="text-3xl font-bold text-gray-900">{{ $post['title'] }}</h1>
                <p class="text-xl text-gray-600">{{ $post['celebrant_age'] }} years old -
                    {{ \Carbon\Carbon::parse($post['dob'])->format('F j, Y') }}</p>

                <!-- Featured & Status Badges -->
                <div class="flex gap-2 mt-2">
                    @if ($post['is_featured'])
                        <span
                            class="bg-yellow-100 text-yellow-800 text-xs font-medium px-2.5 py-0.5 rounded">Featured</span>
                    @endif
                    @if ($post['is_draft'])
                        <span class="bg-gray-100 text-gray-800 text-xs font-medium px-2.5 py-0.5 rounded">Draft</span>
                    @endif
                    @if ($post['is_scheduled'])
                        <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded">
                            Scheduled for {{ \Carbon\Carbon::parse($post['scheduled_time'])->format('M j, Y H:i') }}
                        </span>
                    @endif
                </div>
            </div>

            <!-- Event Details -->
            @if ($post['event_location'] || $post['gift_suggestions'] || $post['rsvp'])
                <div class="mb-6 bg-gray-50 p-4 rounded-lg">
                    @if ($post['event_location'])
                        <div class="mb-2">
                            <strong class="text-gray-700">Location:</strong>
                            <span class="text-gray-600">{{ $post['event_location'] }}</span>
                        </div>
                    @endif

                    @if ($post['gift_suggestions'])
                        <div class="mb-2">
                            <strong class="text-gray-700">Gift Suggestions:</strong>
                            <span class="text-gray-600">{{ $post['gift_suggestions'] }}</span>
                        </div>
                    @endif

                    @if ($post['rsvp'])
                        <div>
                            <strong class="text-gray-700">RSVP:</strong>
                            <span class="text-gray-600">{{ $post['rsvp'] }}</span>
                        </div>
                    @endif
                </div>
            @endif

            <!-- Post Content -->
            <div class="mb-6">
                <div class="prose lg:prose-xl">
                    {!! $post['content'] !!}
                </div>
            </div>

            <!-- Review Feedback -->
            @if ($post['review_feedback'])
                <div class="mb-6 bg-yellow-50 p-4 rounded-lg">
                    <h3 class="font-semibold text-gray-900 mb-2">Review Feedback</h3>
                    <p class="text-gray-700">{{ $post['review_feedback'] }}</p>
                </div>
            @endif

            <!-- Additional Details -->
            <div class="flex flex-col space-y-4">
                <div class="flex justify-between items-center text-gray-600">
                    <span><strong>Created By:</strong> {{ $post['created_by'] }}</span>
                    <span><strong>Status:</strong> {{ ucfirst($post['status']) }}</span>
                </div>

                <div class="flex justify-between items-center text-gray-600">
                    <span><strong>Views:</strong> {{ $post['views'] }}</span>
                    <span><strong>Likes:</strong> {{ $post['likes'] }}</span>
                    <span><strong>Shares:</strong> {{ $post['shares'] }}</span>
                    <span><strong>Dislikes:</strong> {{ $post['dislikes'] }}</span>
                </div>

                <div class="flex justify-between items-center text-gray-600">
                    <span><strong>Created:</strong>
                        {{ \Carbon\Carbon::parse($post['created_at'])->format('M j, Y H:i') }}</span>
                    <span><strong>Updated:</strong>
                        {{ \Carbon\Carbon::parse($post['updated_at'])->format('M j, Y H:i') }}</span>
                </div>

                @if ($post['allow_comments'])
                    <div class="text-gray-600">
                        <strong>Comments are enabled for this post.</strong>
                    </div>
                @else
                    <div class="text-gray-600">
                        <strong>Comments are disabled for this post.</strong>
                    </div>
                @endif
            </div>

            <!-- Creator Info -->
            <div class="mt-6 border-t border-gray-300 pt-4 text-center text-sm text-gray-500">
                <p>Created by <strong>{{ $post['creator']['name'] }}</strong> ({{ $post['creator']['email'] }})</p>
                <p class="mt-1">Role: {{ ucfirst($post['creator']['role']) }}</p>
            </div>
        </div>
    </div>
@endsection
