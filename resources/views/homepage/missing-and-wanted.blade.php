<section class="max-w-7xl mx-auto px-4 py-12 sm:px-6 lg:px-8">
    <!-- Header Section with SVG Background -->
    <div class="relative bg-gradient-to-r from-blue-600 to-purple-600 p-8 mb-8 rounded-xl shadow-2xl overflow-hidden">
        <!-- SVG Background Pattern -->
        <div class="absolute inset-0 opacity-20">
            <svg class="w-full h-full" viewBox="0 0 100 100" preserveAspectRatio="none">
                <path d="M0,0 L100,0 L100,100 L0,100 Z" fill="none" stroke="white" stroke-width="2" stroke-dasharray="5,5" />
                <circle cx="20" cy="20" r="3" fill="white" />
                <circle cx="80" cy="80" r="3" fill="white" />
                <circle cx="50" cy="50" r="3" fill="white" />
            </svg>
        </div>
        
        <div class="relative z-10 text-center">
            <div class="inline-block bg-white bg-opacity-20 p-3 rounded-full mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                </svg>
            </div>
            <h2 class="text-4xl font-bold text-white mb-3">Lost & Found Hub</h2>
            <p class="text-xl text-white opacity-90 max-w-2xl mx-auto">Reuniting people with their lost items through our community network</p>
        </div>
    </div>

    <!-- Main Content Container -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Left Side: Categories and Recent Items -->
        <div class="lg:col-span-1 space-y-6">
            <!-- Categories -->
            {{-- <div class="bg-white rounded-xl shadow-md p-5">
                <h3 class="text-xl font-semibold text-gray-800 mb-4">Categories</h3>
                <div class="grid grid-cols-2 gap-3">
                    <a href="#" class="flex items-center p-3 bg-blue-50 rounded-lg hover:bg-blue-100 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                        Documents
                    </a>
                    <a href="#" class="flex items-center p-3 bg-green-50 rounded-lg hover:bg-green-100 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-600 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 5v2m0 4v2m0 4v2M5 5a2 2 0 00-2 2v3a2 2 0 110 4v3a2 2 0 002 2h14a2 2 0 002-2v-3a2 2 0 110-4V7a2 2 0 00-2-2H5z" />
                        </svg>
                        Wallets
                    </a>
                    <a href="#" class="flex items-center p-3 bg-yellow-50 rounded-lg hover:bg-yellow-100 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-600 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                        </svg>
                        Electronics
                    </a>
                    <a href="#" class="flex items-center p-3 bg-purple-50 rounded-lg hover:bg-purple-100 transition">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-purple-600 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                        Keys
                    </a>
                </div>
            </div> --}}

            <!-- Recent Found Items -->
            <div class="bg-white rounded-xl shadow-md p-5">
    <h3 class="text-xl font-semibold text-gray-800 mb-4">Recently Found</h3>
    <div class="space-y-4">
        @if (!empty($lostAndFoundPostData['lostAndFoundPostsData']) && count($lostAndFoundPostData['lostAndFoundPostsData']) > 0)
            @foreach(array_slice($lostAndFoundPostData['lostAndFoundPostsData'], 0, 2) as $recentPost)
            <a href="{{ route('misplaced.details', $recentPost['slug']) }}">
                <div class="flex items-start p-3 border border-gray-100 rounded-lg hover:shadow-sm transition">
                    <img src="{{ $recentPost['featured_image'] ?? 'https://images.unsplash.com/photo-1585771724684-38269d6639fd?ixlib=rb-1.2.1&auto=format&fit=crop&w=100&h=100&q=80' }}" 
                         alt="{{ $recentPost['title'] }}" 
                         class="w-16 h-16 object-cover rounded-md mr-3">
                    <div>
                        <h4 class="font-medium text-gray-800">{{ $recentPost['title'] }}</h4>
                        <p class="text-sm text-gray-500">{{ Str::limit($recentPost['meta_description'], 50) }}</p>
                        <span class="inline-block mt-1 text-xs px-2 py-1 bg-green-100 text-green-800 rounded-full">
                            Posted {{ \Carbon\Carbon::parse($recentPost['created_at'])->diffForHumans() }}
                        </span>
                    </div>
                </div>
            </a>
            @endforeach
        @else
            <p class="text-gray-500 text-center py-4">No recent found items</p>
        @endif
    </div>
</div>

        </div>

        <!-- Right Side: Featured Lost Item -->
        <div class="lg:col-span-2">
            @if (!empty($lostAndFoundPostData['lostAndFoundPostsData']) && count($lostAndFoundPostData['lostAndFoundPostsData']) > 0)
                @php $featuredPost = $lostAndFoundPostData['lostAndFoundPostsData'][0]; @endphp
                <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                    <div class="md:flex">
                        <!-- Item Image -->
                        <div class="md:w-1/2 relative">
                            <img src="{{ $featuredPost['featured_image'] ?? 'https://images.unsplash.com/photo-1590658268037-6bf12165a8df?ixlib=rb-1.2.1&auto=format&fit=crop&w=600&h=400&q=80' }}" 
                                 alt="{{ $featuredPost['title'] }}" 
                                 class="w-full h-full object-cover">
                            <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black to-transparent p-4">
                                <div class="flex space-x-2">
                                    <span class="inline-block px-3 py-1 bg-red-500 text-white text-xs font-semibold rounded-full">LOST</span>
                                    <span class="inline-block px-3 py-1 bg-white text-gray-800 text-xs font-semibold rounded-full">DOCUMENT</span>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Item Details -->
                        <div class="md:w-1/2 p-6">
                            <div class="flex items-center mb-4">
                                <div class="bg-blue-100 p-2 rounded-full mr-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                </div>
                                <h3 class="text-2xl font-bold text-gray-800">{{ $featuredPost['title'] }}</h3>
                            </div>
                            
                            <div class="prose prose-sm text-gray-600 mb-6">
                                <p>{{ $featuredPost['meta_description'] }}</p>
                            </div>
                            
                            <!-- Contact Information -->
                            <div class="bg-blue-50 rounded-lg p-4 mb-6">
                                <h4 class="font-semibold text-gray-800 mb-3 flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                    </svg>
                                    Contact Information
                                </h4>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                    <a href="tel:{{ $featuredPost['phone_number'] ?? '' }}" class="flex items-center text-blue-600 hover:text-blue-800">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                        </svg>
                                        {{ $featuredPost['phone_number'] ?? 'N/A' }}
                                    </a>
                                    <div class="flex items-center text-gray-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                        {{ $featuredPost['location'] ?? 'Unknown location' }}
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Action Buttons -->
                            <div class="flex flex-wrap gap-3">
                                <a href="{{ route('misplaced.details', $featuredPost['slug'] ?? '#') }}" class="flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                                    </svg>
                                    View Details
                                </a>
                                <a href="tel:{{ $featuredPost['phone_number'] ?? '' }}" class="flex items-center px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                    </svg>
                                    Call Now
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="bg-white rounded-xl shadow-lg overflow-hidden p-10 text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <h3 class="text-xl font-semibold text-gray-700 mb-2">No Lost Items Found</h3>
                    <p class="text-gray-500 mb-6">There are currently no lost items reported. Check back later or report a lost item.</p>
                    <button class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                        Report Lost Item
                    </button>
                </div>
            @endif
            
            <!-- Report Lost Item CTA -->
           <div class="mt-6 bg-gradient-to-r from-blue-500 to-purple-600 rounded-xl shadow-lg p-6 text-white">
    <div class="flex flex-col md:flex-row items-center">
        <div class="md:w-2/3 mb-4 md:mb-0">
            <h3 class="text-xl font-bold mb-2">Lost something important?</h3>
            <p class="opacity-90">
                Report your lost item and we'll help you find it — all for a very reasonable fee starting from just ₦1,000.
            </p>
        </div>
        <div class="md:w-1/3 text-right">
            <button class="px-6 py-3 bg-white text-blue-600 font-semibold rounded-lg hover:bg-gray-100 transition">
                Report Lost Item
            </button>
        </div>
    </div>
</div>

        </div>
    </div>
</section>

<!-- Event Promotion Section -->
<section class="bg-gradient-to-br from-blue-900 to-purple-900 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <!-- Left Content -->
            <div class="text-white">
                <div class="inline-block bg-white bg-opacity-20 p-2 rounded-lg mb-6">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
                <h2 class="text-4xl font-bold mb-6">Plan Your Next Event With Evenue</h2>
                <p class="text-xl opacity-90 mb-8">From intimate gatherings to grand celebrations, we provide seamless event planning services tailored to your needs.</p>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-8">
                    <div class="flex items-start">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-purple-300 mt-1 mr-3 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <div>
                            <h4 class="font-semibold text-lg">Wedding Planning</h4>
                            <p class="text-blue-100">Stress-free wedding coordination</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-purple-300 mt-1 mr-3 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <div>
                            <h4 class="font-semibold text-lg">Corporate Events</h4>
                            <p class="text-blue-100">Professional business gatherings</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-purple-300 mt-1 mr-3 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <div>
                            <h4 class="font-semibold text-lg">Birthday Parties</h4>
                            <p class="text-blue-100">Memorable celebrations</p>
                        </div>
                    </div>
                    <div class="flex items-start">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-purple-300 mt-1 mr-3 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <div>
                            <h4 class="font-semibold text-lg">Venue Booking</h4>
                            <p class="text-blue-100">Perfect locations for any event</p>
                        </div>
                    </div>
                </div>
                
                <div class="flex flex-wrap gap-4">
                    <a href="https://evenue.ng" class="px-6 py-3 bg-white text-blue-900 font-semibold rounded-lg hover:bg-gray-100 transition flex items-center">
                        Visit evenue.ng
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </a>
                    <a href="#" class="px-6 py-3 bg-purple-600 text-white font-semibold rounded-lg hover:bg-purple-700 transition flex items-center">
                        View Packages
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                        </svg>
                    </a>
                </div>
            </div>
            
            <!-- Right Content - Image Gallery -->
            <div class="grid grid-cols-2 gap-4">
                <div class="rounded-xl overflow-hidden shadow-xl transform hover:scale-105 transition duration-500">
                    <img src="https://images.unsplash.com/photo-1519671482749-fd09be7ccebf?ixlib=rb-1.2.1&auto=format&fit=crop&w=600&h=600&q=80" alt="Wedding event" class="w-full h-full object-cover">
                </div>
                <div class="rounded-xl overflow-hidden shadow-xl transform hover:scale-105 transition duration-500">
                    <img src="https://images.unsplash.com/photo-1531058020387-3be344556be6?ixlib=rb-1.2.1&auto=format&fit=crop&w=600&h=600&q=80" alt="Corporate event" class="w-full h-full object-cover">
                </div>
                <div class="rounded-xl overflow-hidden shadow-xl transform hover:scale-105 transition duration-500">
                    <img src="https://images.unsplash.com/photo-1511578314322-379afb476865?ixlib=rb-1.2.1&auto=format&fit=crop&w=600&h=600&q=80" alt="Birthday party" class="w-full h-full object-cover">
                </div>
                <div class="rounded-xl overflow-hidden shadow-xl transform hover:scale-105 transition duration-500">
                    <img src="https://images.unsplash.com/photo-1547036967-23d11aacaee0?ixlib=rb-1.2.1&auto=format&fit=crop&w=600&h=600&q=80" alt="Conference event" class="w-full h-full object-cover">
                </div>
            </div>
        </div>
    </div>
</section>