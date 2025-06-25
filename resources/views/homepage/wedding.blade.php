<section class="container mx-auto px-4 py-8">
    <div class="flex flex-col lg:flex-row gap-8">
        <!-- Main Content (Left Side) -->
        <div class="lg:w-2/3">
            <!-- Header Section -->
            <div class="bg-gradient-to-r from-pink-500 to-red-500 text-white p-6 rounded-lg mb-8 shadow-lg relative overflow-hidden">
                <div class="absolute inset-0 opacity-20">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" class="w-full h-full">
                        <path d="M30,30 Q40,20 50,30 T70,30" stroke="white" stroke-width="2" fill="none" />
                        <path d="M20,50 Q30,40 40,50 T60,50 T80,50" stroke="white" stroke-width="2" fill="none" />
                        <path d="M10,70 Q20,60 30,70 T50,70 T70,70" stroke="white" stroke-width="2" fill="none" />
                    </svg>
                </div>
                <div class="relative z-10 text-center">
                    <div class="inline-block bg-white/20 p-3 rounded-full mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14M12 5l7 7-7 7" />
                        </svg>
                    </div>
                    <h2 class="text-3xl font-bold">Wedding Celebrations</h2>
                    <p class="mt-2 text-pink-100">Celebrating love and new beginnings in our community</p>
                </div>
            </div>

            <!-- Congratulations Message -->
            <div class="text-center mb-8">
                <h3 class="text-2xl italic font-serif text-pink-600 mb-2">Hearty Congratulations!</h3>
                <p class="text-gray-600">Wishing the happy couples a lifetime of love and happiness</p>
            </div>

            <!-- Wedding Cards Grid -->
            @if (count($weddingPostsData) > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-8">
                    @foreach ($weddingPostsData as $post)
                        <div class="bg-white rounded-xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden border border-gray-100 hover:border-pink-200">
                            <div class="relative">
                                <img src="{{ $post['featured_image'] ?? '/images/wedding-placeholder.jpg' }}" 
                                     alt="{{ $post['title'] }}"
                                     class="w-full h-48 object-cover">
                                <div class="absolute top-3 right-3 bg-white p-2 rounded-full shadow-md">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-pink-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                    </svg>
                                </div>
                            </div>
                            
                            <div class="p-5">
                                <h4 class="text-xl font-bold text-gray-800 mb-2">{{ $post['title'] }}</h4>
                                
                                <div class="flex items-center space-x-4 mb-3">
                                    <div class="flex-1">
                                        <p class="text-sm text-gray-500">Bride</p>
                                        <p class="font-medium">{{ $post['bride_name'] }}</p>
                                    </div>
                                    <div class="text-pink-500">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                        </svg>
                                    </div>
                                    <div class="flex-1">
                                        <p class="text-sm text-gray-500">Groom</p>
                                        <p class="font-medium">{{ $post['groom_name'] }}</p>
                                    </div>
                                </div>
                                
                                <div class="space-y-2 text-sm text-gray-600 mb-4">
                                    <div class="flex items-start">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-pink-500 mr-2 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        <span><span class="font-medium">Date:</span> {{ \Carbon\Carbon::parse($post['wedding_date'])->format('F j, Y') }}</span>
                                    </div>
                                    <div class="flex items-start">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-pink-500 mr-2 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                        <span><span class="font-medium">Venue:</span> {{ $post['venue'] }}</span>
                                    </div>
                                </div>
                                
                                <div class="flex justify-between items-center text-xs text-gray-500">
                                    <span>Posted by {{ $post['creator']['name'] ?? 'Admin' }}</span>
                                    <span>{{ \Carbon\Carbon::parse($post['created_at'])->format('M d, Y') }}</span>
                                </div>
                                
                               <a href="{{ route('wedding.details', $post['slug']) }}">
    <button class="mt-4 w-full bg-pink-500 text-white px-4 py-2 rounded-lg font-medium hover:bg-pink-600 transition-colors flex items-center justify-center">
        Send Wishes
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
        </svg>
    </button>
</a>

                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-12 bg-white rounded-xl shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <h3 class="text-xl font-semibold text-gray-700 mb-2">No Wedding Announcements</h3>
                    <p class="text-gray-500 max-w-md mx-auto">
                        There are currently no wedding celebrations to display. Check back soon for updates.
                    </p>
                </div>
            @endif

            <!-- See More Button -->
            {{-- <div class="text-center mt-8">
                <button class="bg-purple-600 text-white px-8 py-3 rounded-lg hover:bg-purple-700 transition-colors duration-300 shadow-md hover:shadow-lg font-semibold flex items-center justify-center mx-auto">
                    View More Celebrations
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
            </div> --}}
        </div>

        <!-- Right Sidebar (Banners) -->
        <div class="lg:w-1/3 space-y-6">
            <!-- Wedding Wishes Banner -->
          <div class="bg-gradient-to-br from-pink-500 to-red-500 rounded-xl p-6 text-white shadow-lg">
    <div class="flex items-center mb-4">
        <div class="bg-white/20 p-2 rounded-full mr-3">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
            </svg>
        </div>
        <h3 class="text-xl font-bold">Publish a Wedding</h3>
    </div>
    <p class="mb-4 text-pink-100">
        Share your love story and beautiful moments with the world — publish your wedding at a very reasonable price starting from just ₦2,000.
    </p>
    {{-- <form>
        <textarea class="w-full bg-white/20 border border-white/30 rounded-lg p-3 text-white placeholder-pink-200 mb-3" rows="3" placeholder="Add a short note or story..."></textarea>
        <button class="w-full bg-white text-pink-600 px-4 py-2 rounded-lg font-medium hover:bg-gray-100 transition-colors">
            Publish Wedding
        </button>
    </form> --}}
</div>


            <!-- Upcoming Weddings Banner -->
            <div class="bg-white border border-gray-200 rounded-xl p-6 shadow-sm">
                <div class="flex items-center mb-4">
                    <div class="bg-pink-100 p-2 rounded-full mr-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-pink-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800">Upcoming Weddings</h3>
                </div>
                @if(count($weddingPostsData) > 0)
                    <div class="space-y-4">
                        @foreach(array_slice($weddingPostsData, 0, 3) as $upcoming)
                            <div class="flex items-start space-x-3">
                                <div class="flex-shrink-0 bg-pink-50 text-pink-600 text-xs font-medium rounded-full w-6 h-6 flex items-center justify-center mt-1">
                                    {{ $loop->iteration }}
                                </div>
                                <div>
                                    <a href="{{ route('wedding.details', $post['slug']) }}">
                                    <h4 class="text-sm font-medium text-gray-800">{{ $upcoming['bride_name'] }} & {{ $upcoming['groom_name'] }}</h4>
                                    <p class="text-xs text-gray-500">
                                        {{ \Carbon\Carbon::parse($upcoming['wedding_date'])->format('M j, Y') }} • {{ $upcoming['venue'] }}
                                    </p>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <a href="{{route('lists.wedding')}}" class="mt-4 inline-block text-sm font-medium text-pink-600 hover:text-pink-800 transition-colors">
                        View all upcoming weddings →
                    </a>
                @else
                    <p class="text-sm text-gray-500 py-4">No upcoming weddings scheduled</p>
                @endif
            </div>

            <!-- Wedding Tips Banner -->
            <div class="bg-white border border-gray-200 rounded-xl p-6 shadow-sm">
                <div class="flex items-center mb-4">
                    <div class="bg-pink-100 p-2 rounded-full mr-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-pink-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800">Wedding Planning Tips</h3>
                </div>
                <ul class="space-y-3 text-sm text-gray-600">
                    <li class="flex items-start">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-pink-500 mr-2 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <span>Book venues and vendors at least 6 months in advance</span>
                    </li>
                    <li class="flex items-start">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-pink-500 mr-2 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <span>Create a realistic budget and stick to it</span>
                    </li>
                    <li class="flex items-start">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-pink-500 mr-2 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <span>Send save-the-dates 6-8 months before</span>
                    </li>
                </ul>
                {{-- <button class="mt-4 w-full bg-pink-600 text-white px-4 py-2 rounded-lg font-medium hover:bg-pink-700 transition-colors">
                    More Planning Tips
                </button> --}}
            </div>
        </div>
    </div>
</section>