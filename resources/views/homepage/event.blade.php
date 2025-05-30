
            <section class="max-w-6xl mx-auto px-4 py-8">
                <div class="flex items-center mb-4">
                    <h2 class="text-2xl font-bold mr-2">Events</h2>
                    <div class="flex-grow h-1 bg-gradient-to-r from-red-500 to-blue-500"></div>
                </div>

                <div class="overflow-x-auto pb-4">
                    <div class="flex space-x-4 min-w-max">
                        @if (count($eventsPostsData) > 0)
                            @foreach ($eventsPostsData as $post)
                                <a href="{{ route('post.details', $post['slug'] ?? '#') }}"
                                    class="hover:text-blue-600 transition-colors w-full">
                                    <div class="w-64 flex-shrink-0">
                                        {{-- <img src="/images/news-image.jpeg" alt="Event Image"
                            class="w-full h-40 object-cover mb-2 rounded"> --}}
                                        @if ($post['featured_image'])
                                            <img src="{{ $post['featured_image'] }}"
                                                alt="{{ ucwords(strtolower($post['title'])) }}"
                                                class="w-full h-40 object-cover mb-2 rounded">
                                        @else
                                            <img src="https://picsum.photos/seed/news/1200/600"
                                                alt="{{ ucwords(strtolower($post['title'])) }}"
                                                class="w-full h-40 object-cover mb-2 rounded">
                                        @endif
                                        <h3 class="text-sm font-semibold">
                                            {{ $post['title'] ?? 'Untitled' }}
                                        </h3>
                                        <div class="flex items-center text-gray-500 text-xs mt-1">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                </path>
                                            </svg>
                                            <span>{{ \Carbon\Carbon::parse($post['created_at'])->diffForHumans() }}</span>

                                        </div>
                                        <div class="flex items-center text-gray-500 text-xs mt-1">
                                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z">
                                                </path>
                                            </svg>
                                            <span>By {{ $post['created_by'] }}</span>
                                        </div>
                                    </div>
                            @endforeach
                        @else
                            <p>No Event news available.</p>
                        @endif
                    </div>
                </div>

                <div class="text-center mt-4">
                    <a href="#"
                        class="bg-purple-600 text-white px-6 py-2 rounded-full inline-block hover:bg-purple-700 transition duration-300">See
                        more</a>
                </div>
            </section>