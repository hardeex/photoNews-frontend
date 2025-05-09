@extends('base.base')

@section('content')

    <body class="bg-gradient-to-br from-blue-50 to-indigo-50 min-h-screen font-sans antialiased">
        <div class="container mx-auto p-4 py-12">
            <div class="max-w-4xl mx-auto">
                <!-- Main Card -->
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                    <!-- Header Banner -->
                    <div class="relative h-48 bg-gradient-to-r from-blue-600 to-indigo-600">
                        <div class="absolute inset-0 bg-opacity-20 bg-pattern"></div>
                        <div class="absolute inset-0 flex items-center justify-center">
                            <h1 class="text-4xl font-bold text-black text-center px-4">
                                Change of Name Declaration
                            </h1>
                        </div>
                    </div>

                    <!-- Name Transition Section -->
                    <div class="px-8 py-6 bg-white">
                        <div
                            class="flex flex-col md:flex-row items-center justify-center space-y-4 md:space-y-0 md:space-x-8">
                            <div class="text-center md:text-right">
                                <p class="text-gray-600 text-sm uppercase tracking-wide">Former Name</p>
                                <h2 class="text-xl font-semibold text-gray-800">{{ $post['old_name'] }}</h2>
                            </div>
                            <div class="hidden md:block">
                                <div class="w-12 h-12 rounded-full bg-indigo-100 flex items-center justify-center">
                                    <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                    </svg>
                                </div>
                            </div>
                            <div class="text-center md:text-left">
                                <p class="text-gray-600 text-sm uppercase tracking-wide">New Name</p>
                                <h2 class="text-xl font-semibold text-indigo-600">{{ $post['new_name'] }}</h2>
                            </div>
                        </div>
                    </div>

                    <!-- Featured Image -->
                    <div class="px-8 py-6">
                        <div class="relative rounded-xl overflow-hidden shadow-lg">
                            <img src="{{ $post['featured_image'] }}" alt="{{ $post['new_name'] }}"
                                class="w-full h-auto object-cover transform hover:scale-105 transition-transform duration-300">
                            <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/50 to-transparent p-4">
                                <p class="text-white text-sm">Official Documentation</p>
                            </div>
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="px-8 py-6">
                        <div class="prose prose-lg max-w-none">
                            {!! $post['content'] !!}
                        </div>
                    </div>

                    <!-- Footer Information -->
                    <div class="bg-gray-50 px-8 py-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="text-center">
                                <p class="text-gray-600 text-sm">Published On</p>
                                <p class="font-semibold">{{ \Carbon\Carbon::parse($post['created_at'])->format('F d, Y') }}
                                </p>
                            </div>
                            {{-- <div class="text-center">
                                <p class="text-gray-600 text-sm">Status</p>
                                <span
                                    class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $post['status'] === 'published' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                    {{ ucfirst($post['status']) }}
                                </span>
                            </div> --}}
                            <div class="text-center">
                                <p class="text-gray-600 text-sm">Reference Number</p>
                                <p class="font-semibold">{{ $post['id'] }}/{{ date('Y') }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Social Sharing -->
                    @if ($post['shares'] !== null)
                        <div class="border-t border-gray-100 px-8 py-4">
                            <div class="flex justify-center space-x-4">
                                <button
                                    class="flex items-center space-x-2 text-gray-600 hover:text-indigo-600 transition-colors">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M15 8a3 3 0 10-2.977-2.63l-4.94 2.47a3 3 0 100 4.319l4.94 2.47a3 3 0 10.895-1.789l-4.94-2.47a3.027 3.027 0 000-.74l4.94-2.47C13.456 7.68 14.19 8 15 8z" />
                                    </svg>
                                    <span>Share</span>
                                </button>
                            </div>
                        </div>
                    @endif

                    <!-- Comments Section -->
                    @if ($post['allow_comments'])
                        <div class="border-t border-gray-100 px-8 py-6">
                            <h3 class="text-xl font-semibold text-gray-800 mb-4">Comments</h3>
                            <div class="bg-gray-50 rounded-lg p-4">
                                <p class="text-gray-600 text-center">Comments are enabled for this announcement. Please be
                                    respectful and follow our community guidelines.</p>
                                <!-- Add your comments component here -->
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <style>
            .bg-pattern {
                background-image: url("data:image/svg+xml,%3Csvg width='20' height='20' viewBox='0 0 20 20' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='%23ffffff' fill-opacity='0.1' fill-rule='evenodd'%3E%3Ccircle cx='3' cy='3' r='3'/%3E%3Ccircle cx='13' cy='13' r='3'/%3E%3C/g%3E%3C/svg%3E");
            }
        </style>
    </body>
@endsection
