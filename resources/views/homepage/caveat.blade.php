      <section class="max-w-6xl mx-auto px-4 py-8">
                <h2 class="text-2xl font-bold mb-6">Caveat</h2>

                <div class="overflow-x-auto pb-4">
                    <div class="flex space-x-4 min-w-max">
                        @if (count($caveatPostsData) > 0)
                            @foreach ($caveatPostsData as $post)
                                <a href="{{ route('caveat.details', $post['slug'] ?? '#') }}"
                                    class="hover:text-blue-600 transition-colors w-full">
                                    <div class="w-64 flex-shrink-0">
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
                                            {{ ucfirst(strtolower($post['title'] ?? 'Untitled')) }}</h3>

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
                                        <div class="flex items-center space-x-6 text-sm text-gray-500 pt-3 border-t">
                                            <div class="flex items-center space-x-1">
                                                {{-- <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-blue-500"
                                                    viewBox="0 0 20 20" fill="currentColor">
                                                    <path
                                                        d="M2 10.5a1.5 1.5 0 113 0v6a1.5 1.5 0 01-3 0v-6zM6 10.333v5.43a2 2 0 001.106 1.79l.05.025A4 4 0 008.943 18h5.416a2 2 0 001.962-1.608l1.2-6A2 2 0 0015.56 8H12V4a2 2 0 00-2-2 1 1 0 00-1 1v.667a4 4 0 01-.8 2.4L6.8 7.933a4 4 0 00-.8 2.4z" />
                                                </svg> --}}
                                                <span>{{ $post['views'] }} views </span>
                                            </div>

                                            <div class="flex items-center space-x-1">
                                                {{-- <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-blue-500"
                                                    viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd"
                                                        d="M18 10c0 3.866-3.582 7-8 7a8.841 8.841 0 01-4.083-.98L2 17l1.338-3.123C2.493 12.767 2 11.434 2 10c0-3.866 3.582-7 8-7s8 3.134 8 7zM7 9H5v2h2V9zm8 0h-2v2h2V9zM9 9h2v2H9V9z"
                                                        clip-rule="evenodd" />
                                                </svg> --}}
                                                <span>{{ $post['shares'] }} shares </span>
                                            </div>

                                            <div class="flex items-center space-x-1">
                                                {{-- <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-blue-500"
                                                    viewBox="0 0 20 20" fill="currentColor">
                                                    <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                                    <path fill-rule="evenodd"
                                                        d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
                                                        clip-rule="evenodd" />
                                                </svg> --}}
                                                <span>{{ $post['likes'] }} Likes </span>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        @else
                            <p>No Caveat news available.</p>
                        @endif
                    </div>
                </div>

                <div class="text-center mt-6">
                    <a href="#"
                        class="bg-purple-600 text-white px-6 py-2 rounded-full inline-block hover:bg-purple-700 transition duration-300">See
                        more</a>
                </div>
            </section>






            <section class="max-w-6xl mx-auto px-4 py-8">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <!-- Hot Local Gists Column -->
                    <div>
                        <h2 class="text-2xl font-bold mb-6">Hot Local Gists</h2>
                        @if (count($localPostsData) > 0)
                            @foreach ($localPostsData['posts'] as $post)
                                <a href="{{ route('post.details', $post['slug'] ?? '#') }}" class="flex mb-6">
                                    <div class="flex mb-6">
                                        @if ($post['featured_image'])
                                            <img src="{{ $post['featured_image'] }}"
                                                alt=""
                                                class="w-24 h-24 object-cover mr-4">
                                        @else
                                            <img src="/images/news-image.jpeg" alt="Music News {{ $index + 1 }}"
                                                class="w-24 h-24 object-cover mr-4">
                                        @endif

                                        <div>
                                            <h3 class="text-lg font-semibold mb-2">
                                                {{ ucwords($post['title'] ?? 'Untitled') }}

                                            </h3>
                                            <p class="text-sm text-gray-600">
                                                {{ \Illuminate\Support\Str::limit(strip_tags($post['content']), 100, '...') }}
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        @else
                            <p class="text-gray-500">No local news available at the moment. Please check back later.</p>
                        @endif
                    </div>

                    <!-- Hot International Gists Column -->
                    <div>
                        <h2 class="text-2xl font-bold mb-6">Hot International Gists</h2>
                        @if (count($internationalPostsData['posts']) > 0)
                            @foreach ($internationalPostsData['posts'] as $post)
                                <a href="{{ route('post.details', $post['slug'] ?? '#') }}" class="flex mb-6">
                                    <div class="flex mb-6">


                                        @if ($post['featured_image'])
                                            <img src="{{ $post['featured_image'] }}"
                                                alt=""
                                                class="w-24 h-24 object-cover mr-4">
                                        @else
                                            <img src="/images/news-image.jpeg" alt="$post['slug'] ?? '#'"
                                                class="w-24 h-24 object-cover mr-4">
                                        @endif

                                        <div>
                                            <h3 class="text-lg font-semibold mb-2">
                                                {{ ucwords($post['title'] ?? 'Untitled') }}

                                            </h3>
                                            <p class="text-sm text-gray-600">
                                                {{ \Illuminate\Support\Str::limit(strip_tags($post['content']), 100, '...') }}
                                            </p>
                                        </div>
                                    </div>
                            @endforeach
                        @else
                            <p class="text-gray-500">No international news available at the moment. Please check back
                                later.</p>
                        @endif
                    </div>
                </div>

                <div class="text-center mt-8">
                    <a href="#"
                        class="bg-blue-500 text-white px-6 py-2 rounded-full inline-block hover:bg-blue-600 transition duration-300">See
                        more</a>
                </div>
            </section>