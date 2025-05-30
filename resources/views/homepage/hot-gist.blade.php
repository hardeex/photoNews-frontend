
            <section class="max-w-6xl mx-auto px-4 py-8">
                <h2 class="text-2xl font-bold mb-6">Hot Gist</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    <!-- Large item -->
                    <div class="md:col-span-2 relative">
                        <a href="{{ route('post.details', $hotGistsPostsData[0]['slug'] ?? '#') }}"
                            class="hover:text-blue-600 transition-colors w-full">

                            <div class="absolute top-0 left-0 bg-red-600 text-white px-2 py-1 text-sm">



                            </div>
                            <div class="absolute bottom-0 left-0 right-0 bg-black bg-opacity-50 text-white p-4">
                                <h3 class="text-lg font-semibold">{{ $hotGistsPostsData[0]['title'] ?? 'Untitled' }}</h3>
                            </div>
                            {{-- <div class="absolute top-2 right-2 flex items-center space-x-2">
                                <span class="flex items-center text-white">
                                    {{ $post['views'] }} views
                                </span>
                                <span class="flex items-center text-white">
                                    {{ $post['shares'] }} shares
                                </span>
                            </div> --}}
                        </a>
                    </div>

                    <!-- Regular items -->
                    @for ($i = 1; $i < count($hotGistsPostsData); $i++)
                        <div class="relative">
                            <a href="{{ route('post.details', $hotGistsPostsData[$i]['slug'] ?? '#') }}"
                                class="hover:text-blue-600 transition-colors w-full">
                                @if ($hotGistsPostsData[$i]['featured_image'])
                                    <img src="{{ $hotGistsPostsData[$i]['featured_image'] }}"
                                        alt="{{ ucwords(strtolower($hotGistsPostsData[$i]['title'])) }}"
                                        class="w-full h-48 object-cover">
                                @else
                                    <img src="https://picsum.photos/seed/news/1200/600"
                                        alt="{{ ucwords(strtolower($hotGistsPostsData[$i]['title'])) }}"
                                        class="w-full h-48 object-cover">
                                @endif
                                <div class="absolute top-0 left-0 bg-red-600 text-white px-2 py-1 text-sm">
                                    @if (isset($post['category_names']) || (isset($post['category']) && isset($post['category']['name'])))
                                        {{ isset($post['category_names'])
                                            ? ucwords(strtolower($post['category_names']))
                                            : ucwords(strtolower($post['category']['name'])) }}
                                    @else
                                        'Not available'
                                    @endif
                                </div>
                                <div class="absolute bottom-0 left-0 right-0 bg-black bg-opacity-50 text-white p-4">
                                    <h3 class="text-sm font-semibold">{{ $hotGistsPostsData[$i]['title'] ?? 'Untitled' }}
                                    </h3>
                                </div>
                                <div class="absolute top-2 right-2 flex items-center space-x-2">
                                    {{-- <span class="flex items-center text-white">
                                        {{ $post['views'] }} views
                                    </span>
                                    <span class="flex items-center text-white">
                                        {{ $post['shares'] }} shares
                                    </span> --}}
                                </div>
                            </a>
                        </div>
                    @endfor
                </div>
            </section>
