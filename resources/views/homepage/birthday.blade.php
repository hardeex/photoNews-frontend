<section class="min-h-screen py-8">
    <!-- Hero Header -->
   <div class="bg-gradient-to-r from-red-600 to-red-700 text-white py-8 md:py-12">
    <div class="container mx-auto px-4">
        <div class="text-center">
            <div class="inline-flex items-center justify-center w-20 h-20 md:w-24 md:h-24 bg-white bg-opacity-20 rounded-full mb-6">
                <span class="text-4xl md:text-5xl">🎉</span>
            </div>
            <h1 class="text-3xl md:text-5xl lg:text-6xl font-bold mb-4 leading-tight">
                Birthday Celebrations
            </h1>
            <p class="text-lg md:text-xl opacity-90 max-w-2xl mx-auto">
                Celebrate yourself and your loved ones in style! Make birthdays unforgettable with heartfelt moments shared right here on our platform.
            </p>
        </div>
    </div>
</div>

    <div class="container mx-auto px-4 py-8 lg:py-16">
        <div class="grid grid-cols-1 xl:grid-cols-3 gap-8 lg:gap-12">
            
            <!-- Main Content Area - Birthday Posts -->
            <div class="xl:col-span-2 order-2 xl:order-1">
                <div class="flex justify-between items-center mb-8">
                    <h2 class="text-2xl md:text-3xl font-bold text-gray-800">
                        Today's Celebrations
                    </h2>
                    <a href="{{ route('list.birthday-posts') }}" 
                       class="hidden md:inline-flex items-center px-4 py-2 text-red-600 border border-red-200 rounded-lg hover:bg-red-50 transition-all duration-300">
                        View All
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>

                @if (count($birthdayPostsData) > 0)
                    <!-- Birthday Posts Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                        @foreach ($birthdayPostsData as $post)
                            <article class="bg-white rounded-2xl shadow-sm hover:shadow-xl transition-all duration-500 overflow-hidden border border-gray-100 group">
                                <!-- Image Container -->
                                <div class="relative overflow-hidden">
                                    <img src="{{ $post['featured_image'] ?? 'images/birthday-default.jpg' }}"
                                         alt="{{ $post['title'] }}" 
                                         class="w-full h-48 md:h-56 object-cover group-hover:scale-105 transition-transform duration-500"
                                         onerror="this.src='images/birthday-default.jpg'">
                                    
                                    <!-- Age Badge -->
                                    <div class="absolute top-4 right-4">
                                        <span class="bg-red-500 text-white text-sm font-semibold px-3 py-1 rounded-full shadow-lg">
                                            {{ $post['celebrant_age'] }} years
                                        </span>
                                    </div>
                                    
                                    <!-- Celebration Icon -->
                                    <div class="absolute top-4 left-4">
                                        <div class="bg-white bg-opacity-90 p-2 rounded-full">
                                            <span class="text-xl">🎂</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Content -->
                                <div class="p-6">
                                    <h3 class="font-bold text-lg md:text-xl text-gray-800 mb-4 line-clamp-2 group-hover:text-red-600 transition-colors duration-300">
                                        {{ $post['title'] }}
                                    </h3>

                                    <!-- Post Details -->
                                    <div class="space-y-3 mb-6">
                                        <div class="flex items-center text-sm">
                                            <div class="w-5 h-5 text-red-500 mr-3 flex-shrink-0">
                                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 11.5A8.38 8.38 0 0112 21m0 0a8.38 8.38 0 01-9-8.5m9 8.5c1.8 0 3.5-.5 5-1.5L12 15l-5 4.5c1.5 1 3.2 1.5 5 1.5z"/>
                                                </svg>
                                            </div>
                                            <span class="truncate text-gray-800 font-medium">Gift: {{ $post['gift_suggestions'] }}</span>
                                        </div>

                                        <div class="flex items-center text-sm">
                                            <div class="w-5 h-5 text-red-500 mr-3 flex-shrink-0">
                                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                </svg>
                                            </div>
                                            <span class="truncate text-gray-800 font-medium">{{ $post['event_location'] }}</span>
                                        </div>

                                        {{-- <div class="flex items-center text-sm">
                                            <div class="w-5 h-5 text-red-500 mr-3 flex-shrink-0">
                                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                </svg>
                                            </div>
                                            <span class="text-gray-800 font-medium">05:04 AM</span>
                                        </div> --}}
                                    </div>

                                    <!-- Creator Info & Action -->
                                    <div class="flex items-center justify-between pt-4 border-t border-gray-100">
                                        <div class="flex items-center space-x-3">
                                            <img src="{{ $post['creator']['avatar'] ?? 'images/default-avatar.jpg' }}"
                                                 alt="{{ $post['creator']['name'] }}" 
                                                 class="w-10 h-10 rounded-full border-2 border-red-100">
                                            <div>
                                                <p class="text-sm font-medium text-gray-800">{{ $post['creator']['name'] }}</p>
                                                <p class="text-xs text-gray-500">
                                                    {{ \Carbon\Carbon::parse($post['created_at'])->format('M j, Y') }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Send Wishes Button -->
                                    <a href="{{ route('birthday.details', $post['slug']) }}"
                                       class="flex items-center justify-center w-full mt-4 bg-gradient-to-r from-red-500 to-red-600 text-white px-4 py-3 rounded-xl font-medium hover:from-red-600 hover:to-red-700 transition-all duration-300 transform hover:scale-[1.02] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 shadow-lg hover:shadow-xl">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                                        </svg>
                                        Send Birthday Wishes
                                    </a>
                                </div>
                            </article>
                        @endforeach
                    </div>

                    <!-- Mobile View All Button -->
                    <div class="text-center md:hidden">
                        <a href="{{ route('list.birthday-posts') }}"
                           class="inline-flex items-center px-6 py-3 bg-red-600 text-white font-medium rounded-xl hover:bg-red-700 transition-colors duration-300 shadow-lg">
                            See All Birthdays
                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                            </svg>
                        </a>
                    </div>

                @else
                    <!-- Empty State -->
                    <div class="text-center py-16 bg-white rounded-2xl shadow-sm">
                        <div class="w-24 h-24 mx-auto mb-6 bg-red-50 rounded-full flex items-center justify-center">
                            <svg class="w-12 h-12 text-red-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 15.546c-.523 0-1.046.151-1.5.454a2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0 2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0 2.704 2.704 0 01-3 0 2.701 2.701 0 00-1.5-.454M9 6v2m3-2v2m3-2v2M9 3h.01M12 3h.01M15 3h.01M21 21v-7a2 2 0 00-2-2H5a2 2 0 00-2 2v7h18zm-3-9v-2a2 2 0 00-2-2H8a2 2 0 00-2 2v2h12z"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-700 mb-2">No Celebrations Today</h3>
                        <p class="text-gray-500">Check back soon for upcoming birthday celebrations!</p>
                    </div>
                @endif
            </div>

            <!-- Sidebar - Call to Action -->
            <div class="xl:col-span-1 order-1 xl:order-2">
                <div class="sticky top-8">
                    <!-- Main CTA Card -->
                    <div class="bg-gradient-to-br from-red-600 via-red-700 to-red-800 rounded-3xl shadow-2xl text-white overflow-hidden relative">
                        <!-- Background Decorations -->
                        <div class="absolute inset-0 opacity-10">
                            <div class="absolute -top-10 -right-10 w-32 h-32 bg-white rounded-full"></div>
                            <div class="absolute top-1/2 -left-8 w-24 h-24 bg-white rounded-full"></div>
                            <div class="absolute -bottom-6 right-1/4 w-20 h-20 bg-white rounded-full"></div>
                        </div>

                        <div class="relative z-10 p-8 lg:p-10">
                            <!-- Icon -->
                            <div class="text-center mb-6">
                                <div class="inline-flex items-center justify-center w-16 h-16 bg-white bg-opacity-20 rounded-2xl mb-4">
                                    <span class="text-3xl">🎊</span>
                                </div>
                                <h2 class="text-2xl lg:text-3xl font-bold mb-2">Share Your Joy!</h2>
                                <p class="text-red-100 text-lg">Create unforgettable birthday moments</p>
                            </div>

                            <!-- Features -->
                           <div class="space-y-4 mb-8">
    <div class="flex items-center space-x-3">
        <div class="w-8 h-8 bg-white bg-opacity-20 rounded-lg flex items-center justify-center flex-shrink-0">
            <span class="text-sm">📸</span>
        </div>
        <span class="text-sm font-medium">Share beautiful memories</span>
    </div>
    <div class="flex items-center space-x-3">
        <div class="w-8 h-8 bg-white bg-opacity-20 rounded-lg flex items-center justify-center flex-shrink-0">
            <span class="text-sm">💝</span>
        </div>
        <span class="text-sm font-medium">Receive heartfelt wishes</span>
    </div>
    <div class="flex items-center space-x-3">
        <div class="w-8 h-8 bg-white bg-opacity-20 rounded-lg flex items-center justify-center flex-shrink-0">
            <span class="text-sm">🎁</span>
        </div>
        <span class="text-sm font-medium">Get gift suggestions</span>
    </div>
    <div class="flex items-center space-x-3">
        <div class="w-8 h-8 bg-white bg-opacity-20 rounded-lg flex items-center justify-center flex-shrink-0">
            <span class="text-sm">🌟</span>
        </div>
        <span class="text-sm font-medium">Join our celebration community</span>
    </div>
    <div class="flex items-center space-x-3">
        <div class="w-8 h-8 bg-white bg-opacity-20 rounded-lg flex items-center justify-center flex-shrink-0">
            <span class="text-sm">🖌️</span>
        </div>
        <span class="text-sm font-medium">Let us design your birthday post — starting from just ₦1,500</span>
    </div>
</div>

<!-- CTA Button -->
<button class="w-full px-6 py-4 bg-white text-red-700 rounded-2xl font-bold text-lg hover:bg-red-50 transition-all duration-300 transform hover:scale-105 shadow-xl">
    🎈 Create Birthday Post
</button>

                            <!-- Stats -->
                            {{-- <div class="mt-6 pt-6 border-t border-red-500 border-opacity-30">
                                <div class="grid grid-cols-3 gap-4 text-center">
                                    <div>
                                        <div class="text-2xl font-bold">1.2K+</div>
                                        <div class="text-xs text-red-100">Posts</div>
                                    </div>
                                    <div>
                                        <div class="text-2xl font-bold">5.8K+</div>
                                        <div class="text-xs text-red-100">Wishes</div>
                                    </div>
                                    <div>
                                        <div class="text-2xl font-bold">850+</div>
                                        <div class="text-xs text-red-100">Members</div>
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                    </div>

                    <!-- Quick Tips Card -->
                    <div class="mt-6 bg-white rounded-2xl shadow-lg p-6 border border-red-100">
                        <h3 class="font-bold text-gray-800 mb-4 flex items-center">
                            <span class="w-6 h-6 bg-red-100 rounded-full flex items-center justify-center mr-2 text-sm">💡</span>
                            Quick Tips
                        </h3>
                        <ul class="space-y-3 text-sm text-gray-600">
                            <li class="flex items-start space-x-2">
                                <span class="w-2 h-2 bg-red-400 rounded-full mt-2 flex-shrink-0"></span>
                                <span>Add high-quality photos for better engagement</span>
                            </li>
                            <li class="flex items-start space-x-2">
                                <span class="w-2 h-2 bg-red-400 rounded-full mt-2 flex-shrink-0"></span>
                                <span>Include gift suggestions to help friends</span>
                            </li>
                            <li class="flex items-start space-x-2">
                                <span class="w-2 h-2 bg-red-400 rounded-full mt-2 flex-shrink-0"></span>
                                <span>Share your celebration location</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>