
    @if (!empty($listRemembrancePostsData['remembrancePostsData']))
        <section class="bg-white p-4">
            <h2 class="text-2xl font-bold mb-4 bg-gray-200 p-2">Remembrance</h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
                @foreach ($listRemembrancePostsData['remembrancePostsData'] as $post)
                    <div class="border border-gray-200 rounded-lg overflow-hidden">
                        <div class="relative">
                            <img src="{{ $post['featured_image'] }}" alt="{{ $post['title'] }}"
                                class="w-full h-48 object-cover">
                            <span class="absolute top-2 right-2 bg-white rounded-full p-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-500" viewBox="0 0 20 20"
                                    fill="currentColor">
                                    <path fill-rule="evenodd"
                                        d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z"
                                        clip-rule="evenodd" />
                                </svg>
                            </span>
                        </div>
                        <div class="p-4">
                            <p class="font-semibold">Name: {{ $post['title'] }}</p>
                            <p>Aged: {{ $post['age'] }}</p>
                            <p>Year: {{ $post['year'] }} year{{ $post['year'] !== 1 ? 's' : '' }} Remembrance</p>
                            <a href="{{ route('remembrance.details', ['slug' => $post['slug']]) }}"
                                class="mt-2 bg-gray-200 text-gray-700 px-4 py-2 rounded hover:bg-gray-300 transition">
                                {{ $loop->index % 2 == 0 ? 'Extend Regards' : 'Send Regards' }}
                            </a>

                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-4 flex justify-between items-center">
                @if ($listRemembrancePostsData['pagination']['prev_page_url'])
                    <a href="{{ $listRemembrancePostsData['pagination']['prev_page_url'] }}"
                        class="bg-gray-200 px-4 py-2 rounded hover:bg-gray-300 transition">Previous</a>
                @endif

                <span>Page {{ $listRemembrancePostsData['pagination']['current_page'] }} of
                    {{ $listRemembrancePostsData['pagination']['last_page'] }}</span>

                @if ($listRemembrancePostsData['pagination']['next_page_url'])
                    <a href="{{ $listRemembrancePostsData['pagination']['next_page_url'] }}"
                        class="bg-gray-200 px-4 py-2 rounded hover:bg-gray-300 transition">Next</a>
                @endif
            </div>

            <div class="mt-6 text-center">
                <button class="bg-purple-600 text-white px-6 py-2 rounded hover:bg-purple-700 transition">
                    See more
                </button>
            </div>
        </section>
    @endif
