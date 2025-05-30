
    <section class="container mx-auto px-4 py-8">
        <div class="bg-gray-200 p-4 mb-6">
            <h2 class="text-2xl font-bold">Wedding Celebration</h2>
        </div>

        <h3 class="text-center italic text-2xl mb-6">Hearty Congratulations!</h3>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 mb-6">
            @if (count($weddingPostsData) > 0)
                @foreach ($weddingPostsData as $post)
                    <div class="bg-red-400 rounded-lg overflow-hidden relative">
                        <div class="absolute top-2 right-2 bg-white rounded-full p-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-400" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                            </svg>
                        </div>
                        <div class="p-4 text-white">
                            <img src="{{ $post['featured_image'] }}" alt="{{ $post['title'] }}"
                                class="w-full h-48 object-cover">
                            <h4 class="font-bold">{{ $post['title'] }}</h4>
                            <p>Bride: {{ $post['bride_name'] }}</p>
                            <p>Groom: {{ $post['groom_name'] }}</p>
                            <p class="text-sm mt-2">Wedding Date:
                                {{ \Carbon\Carbon::parse($post['wedding_date'])->format('F j, Y') }}</p>
                            {{-- <p class="text-sm">{{ $couple['address'] }}</p> --}}
                            <p class="mt-2">Venue: {{ $post['venue'] }}</p>
                            <div class="mt-4 text-gray-500">
                                <span>Posted by: {{ $post['creator']['name'] }} on
                                    {{ \Carbon\Carbon::parse($post['created_at'])->format('F j, Y') }}</span>
                            </div>
                            <button class="mt-4 bg-white text-red-400 px-4 py-2 rounded hover:bg-gray-100 transition">Send
                                Wishes</button>
                        </div>
                    </div>
                @endforeach
        </div>
    @else
        <p class="text-center text-gray-600">No Wedding posts found.</p>
        @endif

        <div class="text-center">
            <button class="bg-purple-600 text-white px-6 py-2 rounded hover:bg-purple-700 transition">See
                more</button>
        </div>
    </section>


