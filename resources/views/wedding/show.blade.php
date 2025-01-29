@extends('base.base')

@section('title', $post['title'])

@section('styles')
    <style>
        .status-badge {
            @apply px-3 py-1 rounded-full text-sm font-semibold;
        }

        .status-published {
            @apply bg-green-100 text-green-800;
        }

        .status-draft {
            @apply bg-yellow-100 text-yellow-800;
        }

        .engagement-item {
            @apply flex items-center gap-2 text-gray-600;
        }
    </style>
@endsection

@section('content')
    <div class="min-h-screen bg-gradient-to-b from-pink-50 to-white py-12 px-4 sm:px-6 lg:px-8">
        <!-- Featured Image -->
        <img src="{{ $post['featured_image'] }}" alt="{{ $post['title'] }}"
            style="width: 100%; height: auto; border-radius: 8px; margin-bottom: 20px;">


        <article class="max-w-4xl mx-auto bg-white rounded-2xl shadow-xl overflow-hidden">
            <!-- Hero Section -->
            <h1 class="text-3xl font-bold text-center text-gray-800">{{ $post['title'] }}</h1>

            <!-- Main Content -->
            <div class="p-8">
                <!-- Couple Info -->
                <div class="flex flex-col md:flex-row justify-between items-center mb-12 space-y-6 md:space-y-0">
                    <div class="text-center md:text-left">
                        <h2 class="text-3xl font-serif text-gray-800">{{ $post['bride_name'] }}</h2>
                        <p class="text-rose-500 font-light">The Bride</p>
                    </div>
                    <div class="text-6xl font-serif text-rose-400">&</div>
                    <div class="text-center md:text-right">
                        <h2 class="text-3xl font-serif text-gray-800">{{ $post['groom_name'] }}</h2>
                        <p class="text-rose-500 font-light">The Groom</p>
                    </div>
                </div>


                {{-- <!-- Featured Image -->
                <img src="{{ $post['featured_image'] }}" alt="{{ $post['title'] }}"
                    style="width: 100%; height: auto; border-radius: 8px; margin-bottom: 20px;"> --}}

                <!-- Event Details -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-12">
                    <div class="bg-pink-50 rounded-xl p-6">
                        <h3 class="font-serif text-xl mb-2 text-gray-800">Wedding Date</h3>
                        <p class="text-gray-600">{{ $post['wedding_date'] }}</p>
                    </div>
                    <div class="bg-pink-50 rounded-xl p-6">
                        <h3 class="font-serif text-xl mb-2 text-gray-800">Venue</h3>
                        <p class="text-gray-600">{{ $post['venue'] }}</p>
                    </div>
                </div>

                <!-- Content -->
                <div class="prose max-w-none mb-12">
                    {!! $post['content'] !!}
                </div>

                <!-- Engagement Metrics -->
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
                    <div class="engagement-item">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                            <path fill-rule="evenodd"
                                d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
                                clip-rule="evenodd" />
                        </svg>
                        <span>{{ number_format($post['views']) }} Views</span>
                    </div>
                    <div class="engagement-item">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M5.293 9.707a1 1 0 010-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 01-1.414 1.414L11 7.414V15a1 1 0 11-2 0V7.414L6.707 9.707a1 1 0 01-1.414 0z"
                                clip-rule="evenodd" />
                        </svg>
                        <span>{{ number_format($post['shares']) }} Shares</span>
                    </div>
                    <div class="engagement-item">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z"
                                clip-rule="evenodd" />
                        </svg>
                        <span>{{ number_format($post['likes']) }} Likes</span>
                    </div>
                    <div class="engagement-item">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                clip-rule="evenodd" />
                        </svg>
                        <span>{{ number_format($post['dislikes']) }} Dislikes</span>
                    </div>
                </div>

                <!-- Meta Info -->
                <div class="border-t border-gray-100 pt-6 mt-6">
                    <div class="flex justify-between items-center flex-wrap gap-4">
                        <div class="space-y-2">
                            <p class="text-sm text-gray-500">Created: {{ $post['created_at'] }}</p>
                            <p class="text-sm text-gray-500">Updated: {{ $post['updated_at'] }}</p>
                        </div>
                        <div
                            class="status-badge {{ $post['status'] === 'published' ? 'status-published' : 'status-draft' }}">
                            {{ ucfirst($post['status']) }}
                        </div>
                    </div>
                </div>
            </div>
        </article>
    </div>
@endsection
