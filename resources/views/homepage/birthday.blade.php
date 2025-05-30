
    <section class="container mx-auto px-4 py-8">
        <div class="bg-gray-200 p-4 mb-6">
            <h2 class="text-2xl font-bold">Birthday celebration</h2>
        </div>

        <h3 class="text-center italic text-2xl mb-6">Happy Birthday to these wonderful people!</h3>

        @if (count($birthdayPostsData) > 0)
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                    @foreach ($birthdayPostsData as $post)
                        <div
                            class="bg-white rounded-xl shadow-sm hover:shadow-md transition-shadow duration-300 overflow-hidden border border-gray-100">
                            <div class="relative">
                                <img src="{{ $post['featured_image'] ?? 'images/birthday-default.jpg' }}"
                                    alt="{{ $post['title'] }}" class="w-full h-52 object-cover"
                                    onerror="this.src='images/birthday-default.jpg'">
                                <div class="absolute top-3 right-3">
                                    <span class="bg-pink-500 text-white text-sm px-3 py-1 rounded-full">
                                        {{ $post['celebrant_age'] }} years
                                    </span>
                                </div>
                            </div>

                            <div class="p-5">
                                <h3 class="font-semibold text-lg text-gray-800 mb-2">{{ $post['title'] }}</h3>

                                <div class="space-y-2 text-sm text-gray-600">
                                    <div class="flex items-center gap-2">
                                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                        </svg>
                                        <p>Gift: {{ $post['gift_suggestions'] }}</p>
                                    </div>

                                    <div class="flex items-center gap-2">
                                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                        <p class="truncate">{{ $post['event_location'] }}</p>
                                    </div>

                                    <div class="flex items-center gap-2">
                                        <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <p>05:04 AM</p>
                                    </div>
                                </div>

                                <div class="mt-4 pt-4 border-t border-gray-100">
                                    <div>
                                        <div class="flex items-center space-x-2">
                                            <img src="{{ $post['creator']['avatar'] ?? 'images/default-avatar.jpg' }}"
                                                alt="{{ $post['creator']['name'] }}" class="w-8 h-8 rounded-full">
                                            <div class="text-sm">
                                                <p class="text-gray-700 font-medium">{{ $post['creator']['name'] }}</p>
                                                <p class="text-gray-500">
                                                    {{ \Carbon\Carbon::parse($post['created_at'])->format('M j, Y') }}</p>
                                            </div>
                                        </div>
                                        <a href="{{ route('birthday.details', $post['slug']) }}"
                                            class="flex items-center justify-center mt-6 bg-gradient-to-r from-pink-500 to-purple-500 text-white px-4 py-2 rounded-lg hover:from-pink-600 hover:to-purple-600 transition-colors duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
                                            <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                            </svg>
                                            Send Wishes
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="text-center">
                    <button
                        class="inline-flex items-center px-6 py-3 bg-purple-600 text-white font-medium rounded-lg hover:bg-purple-700 transition-colors duration-300 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
                        See more birthdays
                        <svg class="w-4 h-4 ml-2" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </button>
                </div>
            @else
                <div class="text-center py-12">
                    <div class="mx-auto w-24 h-24 mb-4">
                        <svg class="w-full h-full text-gray-300" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 15.546c-.523 0-1.046.151-1.5.454a2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0 2.704 2.704 0 01-3 0 2.704 2.704 0 00-3 0 2.704 2.704 0 01-3 0 2.701 2.701 0 00-1.5-.454M9 6v2m3-2v2m3-2v2M9 3h.01M12 3h.01M15 3h.01M21 21v-7a2 2 0 00-2-2H5a2 2 0 00-2 2v7h18zm-3-9v-2a2 2 0 00-2-2H8a2 2 0 00-2 2v2h12z" />
                        </svg>
                    </div>
                    <p class="text-gray-500 text-lg">No birthday posts found</p>
                    <p class="text-gray-400 mt-2">Check back later for upcoming celebrations!</p>
                </div>
        @endif
        </div>


        <div class="flex flex-col md:flex-row gap-8 items-center">
            <div class="md:w-1/2">
                <h2 class="text-3xl font-bold mb-4">Want to Advertise an Obituary?</h2>
                <h3 class="text-xl mb-4">Choose a template</h3>
                <p class="mb-4">Choose from our vast collection of obituary templates and advertise with ease</p>
                <button class="bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-600 transition">Select
                    Template</button>
            </div>
            <div class="md:w-1/2 flex justify-end">
                <div class="relative w-64 h-64">
                    <div class="absolute right-0 bottom-0 w-32 h-32 bg-red-800"></div>
                    <div class="absolute right-8 bottom-8 w-32 h-32 bg-red-600"></div>
                    <div class="absolute right-16 bottom-16 w-32 h-32 bg-blue-400"></div>
                </div>
            </div>
        </div>
    </section>