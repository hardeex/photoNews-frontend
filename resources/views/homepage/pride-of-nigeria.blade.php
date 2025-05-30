 <section class="bg-green-100 p-4">
        <h2 class="text-2xl font-bold mb-4 text-center text-green-800">PRIDE OF NIGERIA</h2>

        <!-- Top News Items -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4 mb-8">
            @foreach ($listPrideOfNigeriaPostsData['prideOfNigeriaPostsData'] as $post)
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <img src="{{ $post['featured_image'] }}" alt="{{ $post['title'] }}"
                        class="w-full h-40 object-cover">
                    <div class="p-4">
                        <h3 class="font-semibold text-sm mb-2">{{ $post['title'] }}</h3>
                        <p class="text-xs text-gray-600">
                            {{ $post['meta_description'] }}
                        </p>
                        <a href="{{ route('post.details', ['slug' => $post['slug']]) }}"
                            class="inline-block mt-2 text-blue-500 text-xs font-semibold hover:underline">
                            Read More
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-8 flex justify-center">
            @if (isset($listPrideOfNigeriaPostsData['pagination']) && $listPrideOfNigeriaPostsData['pagination']['last_page'] > 1)
                <nav aria-label="Pagination">
                    <ul class="flex space-x-2">
                        @if ($listPrideOfNigeriaPostsData['pagination']['current_page'] > 1)
                            <li>
                                <a href="?page={{ $listPrideOfNigeriaPostsData['pagination']['current_page'] - 1 }}"
                                    class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">Previous</a>
                            </li>
                        @endif

                        <li>
                            <span
                                class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg">{{ $listPrideOfNigeriaPostsData['pagination']['current_page'] }}</span>
                        </li>

                        @if (
                            $listPrideOfNigeriaPostsData['pagination']['current_page'] <
                                $listPrideOfNigeriaPostsData['pagination']['last_page']
                        )
                            <li>
                                <a href="?page={{ $listPrideOfNigeriaPostsData['pagination']['current_page'] + 1 }}"
                                    class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600">Next</a>
                            </li>
                        @endif
                    </ul>
                </nav>
            @endif
        </div>



        <div class="text-center">
            <button class="bg-purple-600 text-white px-6 py-2 rounded hover:bg-purple-700 transition">
                See more
            </button>
        </div>
    </section>