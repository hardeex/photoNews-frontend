@extends('base.base')

@section('content')
    <div class="min-h-screen bg-gray-50">
        @if ($post)
            <!-- Hero Section with Parallax Effect -->
            <div class="relative h-[70vh] min-h-[500px] w-full overflow-hidden">
                @if (!empty($post['featured_image']))
                    <img src="{{ $post['featured_image'] }}" alt="{{ $post['title'] }}"
                        class="w-full h-full object-cover transform scale-105 transition-transform duration-300 ease-out hover:scale-110">
                @endif
                <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/50 to-transparent">
                    <div class="absolute bottom-0 left-0 right-0 p-8 text-white">
                        @if ($post['is_featured'])
                            <div class="flex items-center gap-2 mb-4">
                                <span
                                    class="bg-yellow-500/20 backdrop-blur-sm text-yellow-300 px-4 py-1 rounded-full text-sm flex items-center">
                                    <i class="fas fa-star mr-2"></i>Featured Memorial
                                </span>
                            </div>
                        @endif
                        <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-4">{{ $post['title'] }}</h1>
                        <p class="text-xl md:text-2xl text-gray-200">
                            {{ Carbon\Carbon::parse($post['date_of_birth'])->format('F j, Y') }} - Present
                        </p>
                    </div>
                </div>
            </div>

            <!-- Stats Cards (Elevated above content) -->
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-20 relative z-10">
                <div class="bg-white/95 backdrop-blur-sm rounded-2xl shadow-xl p-6 grid grid-cols-2 md:grid-cols-3 gap-4">
                    <div class="text-center p-4 border-r border-gray-200 last:border-r-0">
                        <p class="text-gray-600 text-sm">Age</p>
                        <p class="text-3xl font-bold text-gray-900">{{ $post['age'] }}</p>
                    </div>
                    <div class="text-center p-4 border-r border-gray-200 last:border-r-0">
                        <p class="text-gray-600 text-sm">Birth Year</p>
                        <p class="text-3xl font-bold text-gray-900">
                            {{ Carbon\Carbon::parse($post['date_of_birth'])->format('Y') }}
                        </p>
                    </div>
                    <div class="text-center p-4 border-r border-gray-200 last:border-r-0">
                        <p class="text-gray-600 text-sm">Years of Impact</p>
                        <p class="text-3xl font-bold text-gray-900">{{ $post['year'] }}</p>
                    </div>
                    {{-- <div class="text-center p-4">
                        <p class="text-gray-600 text-sm">Status</p>
                        <p class="text-3xl font-bold text-gray-900">{{ ucfirst($post['status']) }}</p>
                    </div> --}}
                </div>
            </div>

            <!-- Main Content Grid -->
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
                <div class="grid md:grid-cols-3 gap-8">
                    <!-- Left Column (Main Content) -->
                    <div class="md:col-span-2 space-y-8">
                        <!-- Main Content -->
                        <div class="bg-white rounded-2xl shadow-sm p-8">
                            <div class="prose max-w-none">
                                {!! $post['content'] !!}
                            </div>
                        </div>

                        <!-- Engagement Stats -->
                        {{-- <div class="bg-white rounded-2xl shadow-sm p-6">
                            <div class="grid grid-cols-3 gap-4">
                                <button
                                    class="flex items-center justify-center gap-2 py-3 px-4 rounded-xl hover:bg-gray-50 transition-colors">
                                    <i class="fas fa-eye text-gray-500"></i>
                                    <span class="font-semibold">{{ number_format($post['views']) }}</span>
                                </button>
                                <button
                                    class="flex items-center justify-center gap-2 py-3 px-4 rounded-xl hover:bg-gray-50 transition-colors">
                                    <i class="fas fa-heart text-red-500"></i>
                                    <span class="font-semibold">{{ number_format($post['likes']) }}</span>
                                </button>
                                <button
                                    class="flex items-center justify-center gap-2 py-3 px-4 rounded-xl hover:bg-gray-50 transition-colors">
                                    <i class="fas fa-share text-blue-500"></i>
                                    <span class="font-semibold">{{ number_format($post['shares']) }}</span>
                                </button>
                            </div>
                        </div> --}}

                        <!-- Tributes Section -->
                        @if ($post['allow_comments'])
                            <div class="bg-white rounded-2xl shadow-sm p-8">
                                <h2 class="text-2xl font-bold mb-6">Recent Tributes</h2>
                                <div class="space-y-6">
                                    <!-- Sample Tributes -->
                                    <div class="border-b border-gray-100 pb-6 last:border-b-0 last:pb-0">
                                        <div class="flex items-center gap-4 mb-4">
                                            <div class="w-12 h-12 bg-gray-200 rounded-full"></div>
                                            <div>
                                                <h3 class="font-semibold">Sarah Johnson</h3>
                                                <p class="text-sm text-gray-500">2 days ago</p>
                                            </div>
                                        </div>
                                        <p class="text-gray-700">Rest in peace, dear friend. Your impact on our community
                                            will never be forgotten.</p>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Right Column (Sidebar) -->
                    <div class="space-y-8">
                        <!-- Add Tribute Form -->
                        <div class="bg-white rounded-2xl shadow-sm p-6">
                            <h3 class="text-xl font-bold mb-6">Leave a Tribute</h3>
                            <form action="/tributes" method="POST" class="space-y-4">
                                @csrf
                                <input type="hidden" name="post_id" value="{{ $post['id'] }}">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Your Name</label>
                                    <input type="text" name="name"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                        required>
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Your Message</label>
                                    <textarea name="message" rows="4"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                                        required></textarea>
                                </div>
                                <button type="submit"
                                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 px-4 rounded-lg transition-colors">
                                    Post Tribute
                                </button>
                            </form>
                        </div>

                        <!-- Meta Information -->
                        <div class="bg-white rounded-2xl shadow-sm p-6">
                            <h3 class="text-xl font-bold mb-4">Additional Information</h3>
                            <div class="space-y-3 text-gray-600">
                                <p class="flex items-center gap-2">
                                    <i class="fas fa-calendar"></i>
                                    <span>Created: {{ Carbon\Carbon::parse($post['created_at'])->format('F j, Y') }}</span>
                                </p>
                                @if ($post['is_featured'])
                                    <p class="flex items-center gap-2 text-yellow-600">
                                        <i class="fas fa-star"></i>
                                        <span>Featured Memorial</span>
                                    </p>
                                @endif
                            </div>
                        </div>

                        <!-- Review Feedback -->
                        @if (!empty($post['review_feedback']))
                            <div class="bg-white rounded-2xl shadow-sm p-6">
                                <h3 class="text-xl font-bold mb-4">Review Feedback</h3>
                                <p class="text-gray-700">{{ $post['review_feedback'] }}</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @else
            <!-- Not Found State -->
            <div class="min-h-[50vh] flex items-center justify-center">
                <div class="text-center">
                    <h2 class="text-2xl font-bold text-gray-800 mb-2">Post not found</h2>
                    <p class="text-gray-600 mb-6">The remembrance post you're looking for doesn't exist or has been removed.
                    </p>
                    <a href="/"
                        class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 px-6 rounded-lg transition-colors">
                        Return Home
                    </a>
                </div>
            </div>
        @endif
    </div>
@endsection
