
            <div class="bg-gray-100 p-4">
                <h2 class="text-2xl font-bold mb-4 bg-gray-300 p-2 rounded-lg">Public Notice</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @if (count($publicNotice) > 0)
                        @foreach ($publicNotice as $post)
                            <div
                                class="bg-white rounded-lg shadow-md overflow-hidden group hover:shadow-xl transition-all duration-300 flex flex-col h-full">
                                <!-- Image Section -->
                                <div class="relative overflow-hidden">
                                    @if ($post['featured_image'])
                                        <img src="{{ $post['featured_image'] }}"
                                            alt="{{ ucwords(strtolower($post['title'])) }}"
                                            class="w-full h-48 object-cover transform group-hover:scale-105 transition-transform duration-300">
                                    @else
                                        <img src="https://picsum.photos/seed/news/1200/600"
                                            alt="{{ ucwords(strtolower($post['title'])) }}"
                                            class="w-full h-48 object-cover transform group-hover:scale-105 transition-transform duration-300">
                                    @endif

                                    <!-- Category Badge -->
                                    @if (isset($post['category_names']) || (isset($post['category']) && isset($post['category']['name'])))
                                        <span
                                            class="absolute top-2 right-2 bg-red-600 text-white text-xs font-bold px-3 py-1 rounded-full shadow-md">
                                            {{ isset($post['category_names'])
                                                ? ucwords(strtolower($post['category_names']))
                                                : ucwords(strtolower($post['category']['name'])) }}
                                        </span>
                                    @endif
                                </div>

                                <!-- Content Section -->
                                <div class="flex flex-col flex-1">
                                    <div class="p-4 pb-0">
                                        <h3
                                            class="text-lg font-semibold mb-3 line-clamp-2 group-hover:text-blue-600 transition-colors">
                                            {{ $post['title'] ?? 'Untitled' }}
                                        </h3>

                                        <p class="text-sm text-gray-600 mb-4 line-clamp-3">
                                            {{ strip_tags(strlen($post['meta_description'] ?? '') > 150 ? substr($post['meta_description'], 0, 150) . '...' : $post['meta_description'] ?? $post['content']) }}
                                        </p>


                                        <!-- Author and Date -->
                                        <div class="mb-3">
                                            <p class="text-sm text-gray-600 mb-1 flex items-center">
                                                {{-- <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" />
                                                </svg> --}}
                                                {{-- <span class="font-medium">{{ $post['created_by'] }}</span> --}}
                                            </p>
                                            <span
                                                class="inline-block text-xs bg-blue-100 text-blue-800 px-2 py-1 rounded-full">
                                                {{ \Carbon\Carbon::parse($post['created_at'])->format('M d, Y') }}
                                                --
                                                ({{ \Carbon\Carbon::parse($post['created_at'])->diffForHumans() }})
                                            </span>
                                        </div>
                                       
                                    </div>

                                    <!-- Read More Button - Fixed at bottom -->
                                    <div class="p-4 mt-auto">
                                        <a href="{{ route('posts-public-notice-details', ['slug' => $post['slug']]) }}"
                                            class="inline-flex items-center justify-center w-full px-4 py-2 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition-all duration-300 transform hover:-translate-y-0.5 hover:shadow-lg">
                                            <span>Read more</span>
                                            <svg class="w-4 h-4 ml-2 transition-transform duration-300 group-hover:translate-x-1"
                                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <!-- No posts message -->
                        <div class="col-span-full text-center py-8 text-gray-500">
                            <svg class="w-16 h-16 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            <p class="text-lg font-medium">No public notice posts available.</p>
                        </div>
                    @endif
                </div>
            </div>
