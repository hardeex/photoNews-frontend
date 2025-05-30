
    <section class="container mx-auto px-4 py-8">
        <div class="bg-blue-600 text-white p-4 mb-6 rounded-lg">
            <h2 class="text-2xl font-bold">Naming Ceremony/Child Dedication</h2>
        </div>

        @if (count($childDedicationPostsData) > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 mb-8">
                @foreach ($childDedicationPostsData as $post)
                    <div
                        class="bg-white rounded-lg overflow-hidden shadow-md hover:shadow-lg transition duration-300 border border-gray-200">
                        <div class="relative">
                            <img src="{{ $post['featured_image'] }}" alt="{{ $post['title'] }}"
                                class="w-full h-48 object-cover">
                            <div
                                class="absolute top-2 right-2 bg-white rounded-full p-1 shadow-sm hover:bg-blue-100 transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                </svg>
                            </div>
                        </div>
                        <div class="p-4">
                            <h4 class="font-bold text-gray-800 mb-2 text-lg">{{ $post['title'] }}</h4>
                            <p class="text-gray-700"><span class="font-medium">Parents:</span>
                                {{ $post['parents_names'] }}</p>
                            <p class="mt-2 text-gray-700"><span class="font-medium">Date:</span>
                                {{ \Carbon\Carbon::parse($post['dedication_date'])->format('F j, Y') }}</p>
                            <div class="mt-3 text-gray-500 text-sm">
                                <span>Posted on {{ \Carbon\Carbon::parse($post['created_at'])->format('F j, Y') }}</span>
                            </div>
                            <button
                                class="mt-4 w-full bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition duration-300 font-medium">
                                Send Regards
                            </button>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="text-center mt-8">
                <button
                    class="bg-purple-600 text-white px-6 py-3 rounded-lg hover:bg-purple-700 transition duration-300 font-medium">
                    See More Dedications
                </button>
            </div>
        @else
            <div class="bg-gray-100 p-8 rounded-lg text-center">
                <p class="text-gray-600">No Child Dedication posts found.</p>
            </div>
        @endif
    </section>

