

    <section class="p-4">
        <h2 class="text-2xl font-bold mb-4 bg-gray-200 p-2">Change of Name</h2>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">


            <!-- Check if posts are available -->
            @if (count($listChangeOfNamePostsData['changeOfNamePostsData']) > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach ($listChangeOfNamePostsData['changeOfNamePostsData'] as $post)
                        <div class="bg-white p-6 rounded-lg shadow-lg">
                            <a href="{{ route('change-of-name.details', ['slug' => $post['slug']]) }}">
                                <img class="w-full h-48 object-cover rounded-t-lg mb-4"
                                    src="{{ $post['featured_image'] }}" alt={{ $post['new_name'] }}>

                                <h2 class="text-xl font-semibold text-gray-800 mb-2">{{ $post['old_name'] }} →
                                    {{ $post['new_name'] }}</h2>

                                <div class="text-gray-600 text-sm mb-4">
                                    <p class="text-sm">I, formally {{ $post['old_name'] }}, now
                                        {{ $post['new_name'] }}.
                                        All former documents remains
                                        valid. Authority and general public take note</p>
                                </div>

                                <div class="text-gray-700 mb-4">
                                    {!! $post['meta_description'] !!}
                                </div>

                                <div class="flex items-center justify-between">
                                    <span
                                        class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($post['created_at'])->format('M d, Y') }}</span>
                                    @if ($post['is_featured'])
                                        <span
                                            class="text-xs font-bold text-blue-500 bg-blue-100 px-2 py-1 rounded-full">Featured</span>
                                    @endif
                                </div>
                        </div></a>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-8 flex justify-between items-center">
                    @if (isset($listChangeOfNamePostsData['pagination']['prev_page_url']))
                        <a href="{{ $listChangeOfNamePostsData['pagination']['prev_page_url'] }}"
                            class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Previous</a>
                    @endif
                    <span class="text-gray-600">Page {{ $listChangeOfNamePostsData['pagination']['current_page'] }} of
                        {{ $listChangeOfNamePostsData['pagination']['last_page'] }}</span>
                    @if (isset($listChangeOfNamePostsData['pagination']['next_page_url']))
                        <a href="{{ $listChangeOfNamePostsData['pagination']['next_page_url'] }}"
                            class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">Next</a>
                    @endif
                </div>
            @else
                <p class="text-center text-lg text-gray-700">No Change of Name posts available.</p>
            @endif
        </div>


        <div class="mt-6 text-center">
            <button class="bg-purple-600 text-white px-6 py-2 rounded hover:bg-purple-700 transition">
                See more
            </button>
        </div>
    </section>

