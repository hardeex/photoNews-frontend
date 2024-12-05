@extends('base.base')
@section('title', 'Home - Essential Nigeria News')

@section('content')

    <div class="bg-gray-100 min-h-screen">


        <main class="container mx-auto px-4 py-8">
            <section class="bg-purple-700 text-white p-4 md:p-8 rounded-lg mb-8">
                <h1 class="text-2xl md:text-3xl font-bold mb-4">EXPLORE THE WORLD WITH US</h1>
                <form action="#" method="GET" class="flex">
                    <input type="text" name="query" placeholder="Search news, birthday, obituary..."
                        class="flex-grow p-2 rounded-l-lg text-black">
                    <button type="submit" class="bg-pink-500 p-2 rounded-r-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </button>
                </form>
            </section>

            <!--- START OF TEST CONTAINER--->

            <!--- END OF TEST CONTAINER-->


            <section class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-7 gap-4">
                @php
                    $categories = [
                        ['title' => 'News', 'count' => '1M'],
                        ['title' => 'Public Notice', 'count' => '53'],
                        ['title' => 'Forums', 'count' => '100'],
                        ['title' => 'Loss of Document', 'count' => '2000'],
                        ['title' => 'Forums', 'count' => '100'],
                        ['title' => 'Loss of Document', 'count' => '2000'],
                        ['title' => 'Obituary', 'count' => '1M'],
                    ];
                @endphp

                @foreach ($categories as $category)
                    <div class="text-center">
                        <div class="font-bold text-lg">{{ $category['count'] }}</div>
                        <div class="text-sm text-gray-600">{{ $category['title'] }}</div>
                    </div>
                @endforeach
            </section>

            <div class="bg-gray-100 p-4">
                <h2 class="text-2xl font-bold mb-4 bg-gray-300 p-2">Latest News</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                    @if (count($postsData) > 0)
                        @foreach ($postsData as $post)
                            <a href="{{ route('post.details', $post['slug'] ?? '#') }}"
                                class="hover:text-blue-600 transition-colors truncate w-full">
                                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                                    <div class="relative">
                                        @if ($post['featured_image'])
                                            <img src="{{ $post['featured_image'] }}"
                                                alt="{{ ucwords(strtolower($post['title'])) }}"
                                                class="w-full h-48 object-cover">
                                        @else
                                            <img src="https://picsum.photos/seed/news/1200/600"
                                                alt="{{ ucwords(strtolower($post['title'])) }}"
                                                class="w-full h-48 object-cover">
                                        @endif

                                        <span
                                            class="absolute top-2 right-2 bg-red-600 text-white text-xs font-bold px-2 py-1 rounded">
                                            {{ isset($category) ? ucwords(strtolower($post['category_names'])) : 'Not available' }}
                                        </span>
                                    </div>

                                    <div class="p-4">
                                        <h3 class="text-lg font-semibold mb-2">
                                            {{ \Illuminate\Support\Str::title(\Illuminate\Support\Str::words($post['title'] ?? 'Untitled', 4, '...')) }}
                                        </h3>

                                        {{-- <h3 class="text-lg font-semibold mb-2 break-words">
                                            {{ $post['title'] ?? 'Untitled' }}
                                        </h3> --}}


                                        <p class="text-sm text-gray-600 mb-4">
                                            {{ \Illuminate\Support\Str::limit(strip_tags($post['content']), 50, '...') }}
                                        </p>


                                        <!-- Author and Category -->
                                        <div class="mb-3">
                                            <p class="text-sm text-gray-600 mb-1">
                                                By <span class="font-medium">{{ $post['created_by'] }}</span>
                                            </p>
                                            <span class="inline-block text-xs bg-blue-100 text-blue-800 px-2 py-1 rounded">
                                                {{ isset($category) ? ucwords(strtolower($post['category_names'])) : 'Not available' }}
                                            </span>
                                        </div>

                                        <!-- Display Tags -->
                                        <div class="mb-3">
                                            <p class="text-sm text-gray-600 mb-1">Tags:</p>
                                            <div class="flex flex-wrap space-x-2">
                                                @foreach ($post['tags'] as $tag)
                                                    <span
                                                        class="inline-block text-xs bg-green-100 text-green-800 px-2 py-1 rounded">
                                                        {{ $tag['name'] }} <!-- Assuming tags have a 'name' attribute -->
                                                    </span>
                                                @endforeach
                                            </div>
                                        </div>

                                        <!-- Engagement Metrics -->
                                        <div class="flex items-center space-x-6 text-sm text-gray-500 pt-3 border-t">
                                            <!-- Likes -->
                                            <div class="flex items-center space-x-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-blue-500"
                                                    viewBox="0 0 20 20" fill="currentColor">
                                                    <path
                                                        d="M2 10.5a1.5 1.5 0 113 0v6a1.5 1.5 0 01-3 0v-6zM6 10.333v5.43a2 2 0 001.106 1.79l.05.025A4 4 0 008.943 18h5.416a2 2 0 001.962-1.608l1.2-6A2 2 0 0015.56 8H12V4a2 2 0 00-2-2 1 1 0 00-1 1v.667a4 4 0 01-.8 2.4L6.8 7.933a4 4 0 00-.8 2.4z" />
                                                </svg>
                                                <span>123</span>
                                            </div>

                                            <!-- Comments -->
                                            <div class="flex items-center space-x-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-blue-500"
                                                    viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd"
                                                        d="M18 10c0 3.866-3.582 7-8 7a8.841 8.841 0 01-4.083-.98L2 17l1.338-3.123C2.493 12.767 2 11.434 2 10c0-3.866 3.582-7 8-7s8 3.134 8 7zM7 9H5v2h2V9zm8 0h-2v2h2V9zM9 9h2v2H9V9z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                                <span>20</span>
                                            </div>

                                            <!-- Views -->
                                            <div class="flex items-center space-x-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-blue-500"
                                                    viewBox="0 0 20 20" fill="currentColor">
                                                    <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                                    <path fill-rule="evenodd"
                                                        d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                                <span>1.2k views</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        @endforeach
                        </a>
                        <!-- Pagination Links (if needed) -->
                        @if ($pagination && isset($pagination['total_pages']))
                            <div class="pagination">
                                <p>Page {{ $pagination['current_page'] }} of {{ $pagination['total_pages'] }}</p>
                                <a href="?page={{ $pagination['next_page'] }}">Next</a>
                            </div>
                        @endif
                    @else
                        <p>No published posts available.</p>
                    @endif
                </div>
            </div>


            {{-- 
            <div class="bg-gray-100 p-4">
                <h2 class="text-2xl font-bold mb-4 bg-gray-300 p-2">Latest News</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                    @if (count($postsData) > 0)
                        @foreach ($postsData as $post)
                            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                                <div class="relative">
                                    @if ($post['featured_image'])
                                        <img src="{{ $post['featured_image'] }}"
                                            alt="{{ ucwords(strtolower($post['title'])) }}"
                                            class="w-full h-48 object-cover">
                                    @else
                                        <img src="https://picsum.photos/seed/news/1200/600"
                                            alt="{{ ucwords(strtolower($post['title'])) }}"
                                            class="w-full h-48 object-cover">
                                    @endif

                                    <span
                                        class="absolute top-2 right-2 bg-red-600 text-white text-xs font-bold px-2 py-1 rounded">
                                        {{ isset($category) ? ucwords(strtolower($post['category_names'])) : 'Not available' }}

                                    </span>
                                </div>

                                <div class="p-4">
                                    <h3 class="text-lg font-semibold mb-2">
                                        {{ $post['title'] }}
                                    </h3>

                                    <p class="text-sm text-gray-600 mb-4">
                                        {{ strip_tags($post['content']) }}

                                    </p>

                                    <!-- Author and Category -->
                                    <div class="mb-3">
                                        <p class="text-sm text-gray-600 mb-1">
                                            By <span class="font-medium">{{ $post['created_by'] }}</span>
                                        </p>
                                        <span class="inline-block text-xs bg-blue-100 text-blue-800 px-2 py-1 rounded">
                                            {{ isset($category) ? ucwords(strtolower($post['category_names'])) : 'Not available' }}

                                        </span>
                                    </div>

                                    <!-- Engagement Metrics -->
                                    <div class="flex items-center space-x-6 text-sm text-gray-500 pt-3 border-t">
                                        <!-- Likes -->
                                        <div class="flex items-center space-x-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-blue-500"
                                                viewBox="0 0 20 20" fill="currentColor">
                                                <path
                                                    d="M2 10.5a1.5 1.5 0 113 0v6a1.5 1.5 0 01-3 0v-6zM6 10.333v5.43a2 2 0 001.106 1.79l.05.025A4 4 0 008.943 18h5.416a2 2 0 001.962-1.608l1.2-6A2 2 0 0015.56 8H12V4a2 2 0 00-2-2 1 1 0 00-1 1v.667a4 4 0 01-.8 2.4L6.8 7.933a4 4 0 00-.8 2.4z" />
                                            </svg>
                                            <span>123</span>
                                        </div>

                                        <!-- Comments -->
                                        <div class="flex items-center space-x-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-blue-500"
                                                viewBox="0 0 20 20" fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M18 10c0 3.866-3.582 7-8 7a8.841 8.841 0 01-4.083-.98L2 17l1.338-3.123C2.493 12.767 2 11.434 2 10c0-3.866 3.582-7 8-7s8 3.134 8 7zM7 9H5v2h2V9zm8 0h-2v2h2V9zM9 9h2v2H9V9z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            <span>20</span>
                                        </div>

                                        <!-- Views -->
                                        <div class="flex items-center space-x-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-blue-500"
                                                viewBox="0 0 20 20" fill="currentColor">
                                                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                                <path fill-rule="evenodd"
                                                    d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                            <span>1.2k views</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        <!-- Pagination Links (if needed) -->
                        @if ($pagination && isset($pagination['total_pages']))
                            <div class="pagination">
                                <p>Page {{ $pagination['current_page'] }} of {{ $pagination['total_pages'] }}</p>
                                <a href="?page={{ $pagination['next_page'] }}">Next</a>
                            </div>
                        @endif
                    @else
                        <p>No published posts available.</p>
                    @endif
                </div>
            </div> --}}

            <!--- End of the news higlight-->
    </div>



    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-6">Public Notice</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Notice 1 -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <img src="/images/news-image.jpeg" alt="Car for sale" class="w-full h-48 object-cover">
                <div class="p-4">
                    <h2 class="text-xl font-semibold mb-2">Car for sale</h2>
                    <p class="text-gray-600 mb-4">VOX 340 G4 for sale. White covet with shield properties and V6
                        enabled...</p>
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-500">Aug 25 2024</span>
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500 mr-1" viewBox="0 0 20 20"
                                fill="currentColor">
                                <path
                                    d="M2 10.5a1.5 1.5 0 113 0v6a1.5 1.5 0 01-3 0v-6zM6 10.333v5.43a2 2 0 001.106 1.79l.05.025A4 4 0 008.943 18h5.416a2 2 0 001.962-1.608l1.2-6A2 2 0 0015.56 8H12V4a2 2 0 00-2-2 1 1 0 00-1 1v.667a4 4 0 01-.8 2.4L6.8 7.933a4 4 0 00-.8 2.4z" />
                            </svg>
                            <span class="text-sm text-gray-500">123</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Notice 2 -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <img src="https://via.placeholder.com/400x200?text=NUC+release+memo" alt="NUC release memo"
                    class="w-full h-48 object-cover">
                <div class="p-4">
                    <h2 class="text-xl font-semibold mb-2">NUC release memo on strike</h2>
                    <p class="text-gray-600 mb-4">VOX 340 G4 for sale. White covet with shield properties and V6
                        enabled...</p>
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-500">Aug 25 2024</span>
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500 mr-1"
                                viewBox="0 0 20 20" fill="currentColor">
                                <path
                                    d="M2 10.5a1.5 1.5 0 113 0v6a1.5 1.5 0 01-3 0v-6zM6 10.333v5.43a2 2 0 001.106 1.79l.05.025A4 4 0 008.943 18h5.416a2 2 0 001.962-1.608l1.2-6A2 2 0 0015.56 8H12V4a2 2 0 00-2-2 1 1 0 00-1 1v.667a4 4 0 01-.8 2.4L6.8 7.933a4 4 0 00-.8 2.4z" />
                            </svg>
                            <span class="text-sm text-gray-500">20</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Notice 3 -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <img src="https://via.placeholder.com/400x200?text=John+James" alt="John James"
                    class="w-full h-48 object-cover">
                <div class="p-4">
                    <h2 class="text-xl font-semibold mb-2">John James has escaped from Prison</h2>
                    <p class="text-gray-600 mb-4">The Long contained lunatic - Joh james that was arrested on the
                        5th day of Ju...</p>
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-500">Aug 25 2024</span>
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500 mr-1"
                                viewBox="0 0 20 20" fill="currentColor">
                                <path
                                    d="M2 10.5a1.5 1.5 0 113 0v6a1.5 1.5 0 01-3 0v-6zM6 10.333v5.43a2 2 0 001.106 1.79l.05.025A4 4 0 008.943 18h5.416a2 2 0 001.962-1.608l1.2-6A2 2 0 0015.56 8H12V4a2 2 0 00-2-2 1 1 0 00-1 1v.667a4 4 0 01-.8 2.4L6.8 7.933a4 4 0 00-.8 2.4z" />
                            </svg>
                            <span class="text-sm text-gray-500">20</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Notice 4 -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <img src="https://via.placeholder.com/400x200?text=Maryland+bridge" alt="Maryland bridge"
                    class="w-full h-48 object-cover">
                <div class="p-4">
                    <h2 class="text-xl font-semibold mb-2">Maryland bridge is under construction</h2>
                    <p class="text-gray-600 mb-4">VOX 340 G4 for sale. White covet with shield properties and V6
                        enabled...</p>
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-gray-500">Aug 25 2024</span>
                        <div class="flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-500 mr-1"
                                viewBox="0 0 20 20" fill="currentColor">
                                <path
                                    d="M2 10.5a1.5 1.5 0 113 0v6a1.5 1.5 0 01-3 0v-6zM6 10.333v5.43a2 2 0 001.106 1.79l.05.025A4 4 0 008.943 18h5.416a2 2 0 001.962-1.608l1.2-6A2 2 0 0015.56 8H12V4a2 2 0 00-2-2 1 1 0 00-1 1v.667a4 4 0 01-.8 2.4L6.8 7.933a4 4 0 00-.8 2.4z" />
                            </svg>
                            <span class="text-sm text-gray-500">20</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-8 text-center">
            <button class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded">
                See more
            </button>
        </div>
    </div>




    <section class="bg-gray-100 py-8 overflow-hidden">
        <div class="container mx-auto px-4">
            <h2 class="text-3xl font-bold mb-6">Announcements</h2>

            <div class="relative">
                <div class="flex overflow-x-auto pb-4 scrolling-touch" id="scrollingAnnouncements">
                    <!-- Announcement items -->
                    <div class="flex-none w-64 mx-2">
                        <div class="bg-white rounded-lg shadow-md p-4 text-center">
                            <div class="w-24 h-24 mx-auto mb-4 bg-yellow-500 rounded-full"></div>
                            <h3 class="text-lg font-semibold">Important Notice</h3>
                            <p class="text-sm text-gray-600 mt-2">Annual General Meeting</p>
                        </div>
                    </div>

                    <div class="flex-none w-64 mx-2">
                        <div class="bg-white rounded-lg shadow-md p-4 text-center">
                            <div class="w-24 h-24 mx-auto mb-4 bg-blue-500 rounded-full"></div>
                            <h3 class="text-lg font-semibold">Event Update</h3>
                            <p class="text-sm text-gray-600 mt-2">Annual General Meeting</p>
                        </div>
                    </div>

                    <div class="flex-none w-64 mx-2">
                        <div class="bg-white rounded-lg shadow-md p-4 text-center">
                            <div class="w-24 h-24 mx-auto mb-4 bg-green-500 rounded-full"></div>
                            <h3 class="text-lg font-semibold">Community News</h3>
                            <p class="text-sm text-gray-600 mt-2">Annual General Meeting</p>
                        </div>
                    </div>

                    <div class="flex-none w-64 mx-2">
                        <div class="bg-white rounded-lg shadow-md p-4 text-center">
                            <div class="w-24 h-24 mx-auto mb-4 bg-red-500 rounded-full"></div>
                            <h3 class="text-lg font-semibold">Upcoming Events</h3>
                            <p class="text-sm text-gray-600 mt-2">Annual General Meeting</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-8 bg-red-600 text-white py-4 px-6 rounded-lg">
                <p class="text-xl font-semibold text-center">Stay informed with our latest updates!</p>
            </div>
        </div>

        <script>
            const scrollContainer = document.getElementById('scrollingAnnouncements');
            let scrollAmount = 0;
            const scrollSpeed = 1;

            function autoScroll() {
                scrollContainer.scrollLeft += scrollSpeed;
                if (scrollContainer.scrollLeft >= scrollContainer.scrollWidth - scrollContainer.clientWidth) {
                    scrollContainer.scrollLeft = 0;
                }
                requestAnimationFrame(autoScroll);
            }

            autoScroll();
        </script>
    </section>


    <section class="w-full">
        <img src="{{ asset('/images/ad1.png') }}" alt="Advertisement" class="w-full h-auto max-h-60 object-cover">
    </section>


    <section class="max-w-6xl mx-auto px-4 py-8">
        <h2 class="text-2xl font-bold mb-6 bg-red-600 text-white p-2">Featured Entertainment News</h2>

        <div class="flex flex-wrap gap-2 mb-6">
            @foreach (['Gold Market', 'Nigeria\'s Inflation Rate Eases to 33.40%', 'Adekunle Gold', 'Nigeria and Guinea Strengthen Ties', 'Nigeria\'s Economic Activity Declines Again'] as $tag)
                <span class="bg-purple-200 text-purple-800 text-xs px-2 py-1 rounded">{{ $tag }}</span>
            @endforeach
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- start of the breaking news-->
            {{-- <div class="md:col-span-2">
                @if (count($postsData) > 0)
                    @foreach ($postsData as $post)
                        <a href="{{ route('post.details', $post['slug'] ?? '#') }}"
                            class="hover:text-blue-600 transition-colors w-full">
                            @if ($post['featured_image'])
                                <img src="{{ $post['featured_image'] }}" alt="{{ ucwords(strtolower($post['title'])) }}"
                                    class="w-full h-64 object-cover mb-4">
                            @else
                                <img src="https://picsum.photos/seed/news/1200/600"
                                    alt="{{ ucwords(strtolower($post['title'])) }}"
                                    class="w-full h-64 object-cover mb-4">
                            @endif


                            <h3 class="text-xl font-semibold mb-2 break-words">
                                {{ $post['title'] ?? 'Untitled' }}
                            </h3>
                            <p class="text-gray-600">
                                {{ \Illuminate\Support\Str::limit(strip_tags($post['content']), 100, '...') }}
                            </p>
                        </a>
                    @endforeach
                @endif
            </div> --}}
            <!--- end of the breaking news-->

            <!-- start of another test-->

            <!-- start of the breaking news section -->
            <div class="md:col-span-2">
                @if (count($breakingPostsData) > 0)
                    <h2 class="text-2xl font-bold mb-4">Breaking News</h2>
                    @foreach ($breakingPostsData as $post)
                        <a href="{{ route('post.details', $post['slug'] ?? '#') }}"
                            class="hover:text-blue-600 transition-colors w-full">
                            @if ($post['featured_image'])
                                <img src="{{ $post['featured_image'] }}" alt="{{ ucwords(strtolower($post['title'])) }}"
                                    class="w-full h-64 object-cover mb-4">
                            @else
                                <img src="https://picsum.photos/seed/news/1200/600"
                                    alt="{{ ucwords(strtolower($post['title'])) }}"
                                    class="w-full h-64 object-cover mb-4">
                            @endif
                            <h3 class="text-xl font-semibold mb-2 break-words">
                                {{ $post['title'] ?? 'Untitled' }}
                            </h3>
                            <p class="text-gray-600">
                                {{ \Illuminate\Support\Str::limit(strip_tags($post['content']), 100, '...') }}
                            </p>
                        </a>
                    @endforeach
                @else
                    <p>No breaking news available.</p>
                @endif
            </div>
            <!-- end of the breaking news section -->



            <!--- End of another test-->
            <div>
                <h4 class="text-lg font-semibold mb-4">Music News</h4>
                {{-- @for ($i = 0; $i < 3; $i++)
                    <div class="mb-4">
                        <img src="/images/news-image.jpeg" alt="Music News {{ $i + 1 }}"
                            class="w-full h-32 object-cover mb-2">
                        <h5 class="font-medium">Nicki Minaj Detained at Amsterdam Airport Over Suspected Drug
                            Possession</h5>
                    </div>
                @endfor --}}

                @if (count($musicPostsData) > 0)
                    @foreach ($musicPostsData as $index => $post)
                        <a href="{{ route('post.details', $post['slug'] ?? '#') }}">
                            <div class="mb-4">
                                @if ($post['featured_image'])
                                    <img src="{{ $post['featured_image'] }}" alt="Music News {{ $index + 1 }}"
                                        class="w-full h-32 object-cover mb-2">
                                @else
                                    <img src="/images/news-image.jpeg" alt="Music News {{ $index + 1 }}"
                                        class="w-full h-32 object-cover mb-2">
                                @endif
                                <h5 class="font-medium">{{ $post['title'] ?? 'Untitled' }}</h5>
                            </div>
                        </a>
                    @endforeach
                @else
                    <p class="text-gray-500">No music news available at the moment. Please check back later.</p>
                @endif
                <a href="#" class="text-blue-600 hover:underline">See more</a>
            </div>
        </div>
    </section>


    <section class="max-w-6xl mx-auto px-4 py-8">
        <h2 class="text-2xl font-bold mb-6">Caveat</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @foreach ([1, 2, 3, 4] as $index)
                <div class="bg-white shadow-md rounded-lg overflow-hidden">
                    <img src="/images/news-image.jpeg" alt="News Image {{ $index }}"
                        class="w-full h-48 object-cover">
                    <div class="p-4">
                        <h3 class="text-lg font-semibold mb-2">Nigerian Senators' Monthly Pay Exceeds N2 Billion:
                            Controversy Over Legislative Salaries and Allowances</h3>
                        <p class="text-sm text-gray-600 mb-4">Emerging reports indicate that the total monthly
                            remuneration of 99 non-principal officers of the Nigerian Senate surpa...</p>
                        <div class="flex items-center justify-between text-xs text-gray-500">
                            <span>By Shola Akinyele</span>
                            <span>Category: Local</span>
                        </div>
                        <div class="mt-2 flex items-center">
                            <svg class="w-4 h-4 text-blue-500 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M2 10.5a1.5 1.5 0 113 0v6a1.5 1.5 0 01-3 0v-6zM6 10.333v5.43a2 2 0 001.106 1.79l.05.025A4 4 0 008.943 18h5.416a2 2 0 001.962-1.608l1.2-6A2 2 0 0015.56 8H12V4a2 2 0 00-2-2 1 1 0 00-1 1v.667a4 4 0 01-.8 2.4L6.8 7.933a4 4 0 00-.8 2.4z">
                                </path>
                            </svg>
                            <span class="text-sm text-gray-500">123</span>
                            <span class="ml-2 text-sm text-gray-500">20 comments</span>
                        </div>
                    </div>
                </div>
            @endforeach
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
                    @foreach ($localPostsData as $index => $post)
                        <a href="{{ route('post.details', $post['slug'] ?? '#') }}" class="flex mb-6">
                            <div class="flex mb-6">
                                @if ($post['featured_image'])
                                    <img src="{{ $post['featured_image'] }}" alt="Music News {{ $index + 1 }}"
                                        class="w-24 h-24 object-cover mr-4">
                                @else
                                    <img src="/images/news-image.jpeg" alt="Music News {{ $index + 1 }}"
                                        class="w-24 h-24 object-cover mr-4">
                                @endif

                                <div>
                                    <h3 class="text-lg font-semibold mb-2">
                                        {{ $post['title'] ?? 'Untitled' }}
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
                @if (count($internationalPostsData) > 0)
                    @foreach ($internationalPostsData as $index => $post)
                        <a href="{{ route('post.details', $post['slug'] ?? '#') }}" class="flex mb-6">
                            <div class="flex mb-6">


                                @if ($post['featured_image'])
                                    <img src="{{ $post['featured_image'] }}" alt="Music News {{ $index + 1 }}"
                                        class="w-24 h-24 object-cover mr-4">
                                @else
                                    <img src="/images/news-image.jpeg" alt="Music News {{ $index + 1 }}"
                                        class="w-24 h-24 object-cover mr-4">
                                @endif

                                <div>
                                    <h3 class="text-lg font-semibold mb-2">
                                        {{ $post['title'] ?? 'Untitled' }}
                                    </h3>
                                    <p class="text-sm text-gray-600">
                                        {{ \Illuminate\Support\Str::limit(strip_tags($post['content']), 100, '...') }}
                                    </p>
                                </div>
                            </div>
                    @endforeach
                @else
                    <p class="text-gray-500">No international news available at the moment. Please check back later.</p>
                @endif
            </div>
        </div>

        <div class="text-center mt-8">
            <a href="#"
                class="bg-blue-500 text-white px-6 py-2 rounded-full inline-block hover:bg-blue-600 transition duration-300">See
                more</a>
        </div>
    </section>




    <section class="max-w-6xl mx-auto px-4 py-8">
        <h2 class="text-2xl font-bold mb-6">Hot Gist</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            <!-- Large item -->
            <div class="md:col-span-2 relative">
                <a href="{{ route('post.details', $hotGistsPostsData[0]['slug'] ?? '#') }}"
                    class="hover:text-blue-600 transition-colors w-full">
                    {{-- @if ($hotGistsPostsData[0]['featured_image'])
                        <img src="{{ $hotGistsPostsData[0]['featured_image'] }}"
                            alt="{{ ucwords(strtolower($hotGistsPostsData[0]['title'])) }}"
                            class="w-full h-64 object-cover">
                    @else
                        <img src="https://picsum.photos/seed/news/1200/600"
                            alt="{{ ucwords(strtolower($hotGistsPostsData[0]['title'])) }}"
                            class="w-full h-64 object-cover">
                    @endif --}}
                    <div class="absolute top-0 left-0 bg-red-600 text-white px-2 py-1 text-sm">

                        @if (isset($post['categories']) && count($post['categories']) > 0)
                            {{ implode(', ',array_map(function ($category) {return ucwords(strtolower($category['name']));}, $post['categories'])) }}
                        @else
                            'Not available'
                        @endif


                    </div>
                    <div class="absolute bottom-0 left-0 right-0 bg-black bg-opacity-50 text-white p-4">
                        <h3 class="text-lg font-semibold">{{ $hotGistsPostsData[0]['title'] ?? 'Untitled' }}</h3>
                    </div>
                    <div class="absolute top-2 right-2 flex items-center space-x-2">
                        <span class="flex items-center text-white">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M2 10.5a1.5 1.5 0 113 0v6a1.5 1.5 0 01-3 0v-6zM6 10.333v5.43a2 2 0 001.106 1.79l.05.025A4 4 0 008.943 18h5.416a2 2 0 001.962-1.608l1.2-6A2 2 0 0015.56 8H12V4a2 2 0 00-2-2 1 1 0 00-1 1v.667a4 4 0 01-.8 2.4L6.8 7.933a4 4 0 00-.8 2.4z">
                                </path>
                            </svg>123
                        </span>
                        <span class="flex items-center text-white">
                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                    d="M18 5v8a2 2 0 01-2 2h-5l-5 4v-4H4a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2zM7 8H5v2h2V8zm2 0h2v2H9V8zm6 0h-2v2h2V8z"
                                    clip-rule="evenodd"></path>
                            </svg>20
                        </span>
                    </div>
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
                            @if (isset($post['categories']) && count($post['categories']) > 0)
                                {{ implode(', ',array_map(function ($category) {return ucwords(strtolower($category['name']));}, $post['categories'])) }}
                            @else
                                'Not available'
                            @endif
                        </div>
                        <div class="absolute bottom-0 left-0 right-0 bg-black bg-opacity-50 text-white p-4">
                            <h3 class="text-sm font-semibold">{{ $hotGistsPostsData[$i]['title'] ?? 'Untitled' }}</h3>
                        </div>
                        <div class="absolute top-2 right-2 flex items-center space-x-2">
                            <span class="flex items-center text-white">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M2 10.5a1.5 1.5 0 113 0v6a1.5 1.5 0 01-3 0v-6zM6 10.333v5.43a2 2 0 001.106 1.79l.05.025A4 4 0 008.943 18h5.416a2 2 0 001.962-1.608l1.2-6A2 2 0 0015.56 8H12V4a2 2 0 00-2-2 1 1 0 00-1 1v.667a4 4 0 01-.8 2.4L6.8 7.933a4 4 0 00-.8 2.4z">
                                    </path>
                                </svg>123
                            </span>
                            <span class="flex items-center text-white">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M18 5v8a2 2 0 01-2 2h-5l-5 4v-4H4a2 2 0 01-2-2V5a2 2 0 012-2h12a2 2 0 012 2zM7 8H5v2h2V8zm2 0h2v2H9V8zm6 0h-2v2h2V8z"
                                        clip-rule="evenodd"></path>
                                </svg>20
                            </span>
                        </div>
                    </a>
                </div>
            @endfor
        </div>
    </section>




    <section class="max-w-6xl mx-auto px-4 py-8">
        <div class="bg-green-500 p-2 mb-4">
            <h2 class="text-2xl font-bold text-white">Lost but Found</h2>
        </div>

        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4" role="alert">
            <p class="text-sm">Disclaimer: You would be proved to confirm your ownership of this item. So for your
                best interest, please come with a prove of ownership</p>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-4">
            @foreach (range(1, 4) as $index)
                <div class="bg-gray-200 p-2 rounded">
                    <img src="/images/news-image.jpeg" alt="Rolex wristwatch" class="w-full h-40 object-cover mb-2">
                    <p class="text-sm font-semibold bg-black bg-opacity-50 text-white p-1">Name of Item: Rolex
                        wristwatch</p>
                </div>
            @endforeach
        </div>

        <div class="text-center">
            <a href="#"
                class="bg-purple-600 text-white px-6 py-2 rounded-full inline-block hover:bg-purple-700 transition duration-300">See
                more</a>
        </div>
    </section>


    <section class="w-full">
        <img src="{{ asset('/images/ad2.png') }}" alt="Advertisement" class="w-full h-auto max-h-60 object-cover">
    </section>


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
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                    <span>{{ \Carbon\Carbon::parse($post['created_at'])->diffForHumans() }}</span>

                                </div>
                                <div class="flex items-center text-gray-500 text-xs mt-1">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
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

    <section class="max-w-6xl mx-auto px-4 py-8">
        <div class="bg-gray-200 p-2 mb-4">
            <h2 class="text-2xl font-bold">Loss of Document</h2>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4 mb-4">
            @foreach (range(1, 5) as $index)
                <div class="bg-white shadow-md rounded-lg overflow-hidden">
                    <img src="/images/news-image.jpeg" alt="Lost Document {{ $index }}"
                        class="w-full h-32 object-cover">
                    <div class="p-3">
                        <p class="text-sm font-semibold mb-2">I John Obiama humbly seek your help incase for the
                            misplace of one of my document : DRIVER LICENCE</p>
                        <p class="text-xs text-gray-600">If found, please contact</p>
                        <p class="text-sm font-bold text-blue-600">08035674857{{ $index }}</p>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="text-center">
            <a href="#"
                class="bg-purple-600 text-white px-6 py-2 rounded-full inline-block hover:bg-purple-700 transition duration-300">See
                more</a>
        </div>
    </section>

    <section class="w-full">
        <img src="{{ asset('/images/ad3.jpg') }}" alt="Advertisement" class="w-full h-auto max-h-60 object-cover">
    </section>



    <section class="max-w-6xl mx-auto px-4 py-8">
        <div class="bg-gray-200 p-2 mb-4">
            <h2 class="text-2xl font-bold">Topics</h2>
        </div>

        <div class="flex flex-wrap gap-2 mb-6 overflow-x-auto whitespace-nowrap">
            @foreach (['Gold Market', 'Nigeria\'s Inflation Rate Eases to 33.40%', 'Adekunle Gold', 'Nigeria and Guinea Strengthen Ties', 'Nigeria\'s Economic Activity Declines Again'] as $topic)
                <span class="bg-purple-200 text-purple-800 text-xs px-3 py-1 rounded-full">{{ $topic }}</span>
            @endforeach
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="md:col-span-2">
                <div class="bg-black aspect-w-16 aspect-h-9 relative">
                    <div class="absolute inset-0 flex items-center justify-center">
                        <div class="text-white bg-red-600 p-2 rounded-full">
                            <svg class="w-12 h-12" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M8 5v10l7-5-7-5z" />
                            </svg>
                        </div>
                    </div>
                    <div class="absolute top-4 right-4 bg-white text-black px-2 py-1 text-sm rounded">
                        No live event at the moment
                    </div>
                </div>
            </div>
            <div class="space-y-4">
                <div class="bg-red-600 p-4 text-white text-center font-bold">
                    ADVERTISE HERE!
                </div>
                <div class="bg-gray-200 p-4 text-center">
                    <p class="font-semibold">ADVERTISE HERE !!</p>
                </div>
                <div class="bg-blue-600 p-4 text-white text-center">
                    <p class="font-bold">ADVERTIZE YOUR BUSINESS HERE!</p>
                </div>
            </div>
        </div>
    </section>


    <section class="max-w-6xl mx-auto px-4 py-8">
        <div class="bg-gray-200 p-2 mb-4">
            <h2 class="text-2xl font-bold">Missing Person</h2>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-4">
            @foreach (range(1, 4) as $index)
                <div class="bg-white shadow-md rounded-lg overflow-hidden">
                    <img src="/images/news-image.jpeg" alt="Missing Person {{ $index }}"
                        class="w-full h-48 object-cover">
                    <div class="p-3">
                        <table class="w-full text-sm">
                            <tr>
                                <td class="font-semibold">Name:</td>
                                <td>JOHN OBIAMA</td>
                            </tr>
                            <tr>
                                <td class="font-semibold">Sex:</td>
                                <td>M</td>
                            </tr>
                            <tr>
                                <td class="font-semibold">Age:</td>
                                <td>26</td>
                            </tr>
                            <tr>
                                <td class="font-semibold">Height:</td>
                                <td>6.02"</td>
                            </tr>
                            <tr>
                                <td class="font-semibold">Tone:</td>
                                <td>Black</td>
                            </tr>
                            <tr>
                                <td class="font-semibold">Call:</td>
                                <td>08025384758</td>
                            </tr>
                        </table>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="text-center">
            <a href="#"
                class="bg-purple-600 text-white px-6 py-2 rounded-full inline-block hover:bg-purple-700 transition duration-300">See
                more</a>
        </div>
    </section>

    <section class="max-w-6xl mx-auto px-4 py-8">
        <div class="bg-white p-4">
            <h1 class="text-3xl font-bold mb-4">Wanted Person</h1>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
                @for ($i = 0; $i < 4; $i++)
                    <div class="border border-gray-200 rounded-lg overflow-hidden">
                        <div class="relative">
                            <img src="/images/news-image.jpeg" alt="Bridge" class="w-full h-40 object-cover">
                            <span
                                class="absolute top-2 right-2 bg-red-500 text-white text-xs font-bold px-2 py-1 rounded">DANGEROUS</span>
                        </div>
                        <div class="p-4">
                            <h2 class="font-bold mb-2">Name: JOHN OBIAMA</h2>
                            <p class="text-sm mb-1">Sex: M &nbsp;&nbsp;&nbsp; Age: 26</p>
                            <p class="text-sm mb-1">Height: 6.02' &nbsp;&nbsp;&nbsp; Tone: Black</p>
                            <p class="text-sm mb-1">Bounty: ${{ number_format(450000 + $i * 250000, 0) }}</p>
                            <p class="text-sm mb-2">More info:</p>
                            <p class="text-xs mb-4">This is a master of disguise and can be really unpredictable
                                and very dangerous person! Beware!</p>
                            <div class="bg-red-500 text-white text-center py-2 font-bold">
                                DON'T RELATE WITH, CALL 911 IMMEDIATELY
                            </div>
                        </div>
                    </div>
                @endfor
            </div>
            <button class="mt-4 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">See more</button>
        </div>
    </section>



    {{-- <section class="max-w-6xl mx-auto px-4 py-8">
        <div class="bg-white p-4">
            <h2 class="text-2xl font-bold mb-4 text-center">Top News Category</h2>

            <div class="relative w-full h-6 bg-gray-200 rounded-full mb-6">
                <div class="absolute left-0 top-0 h-full w-1/4 bg-red-500 rounded-full"></div>
                <div class="absolute right-0 top-0 text-xs font-semibold text-red-500 mr-2">Live</div>
            </div>

            <form class="mb-6">
                <div class="relative">
                    <input type="text" placeholder="Search categories..."
                        class="w-full p-2 pl-10 pr-4 rounded-full border border-gray-300 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent">
                    <div class="absolute left-3 top-1/2 transform -translate-y-1/2">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                </div>
            </form>

            <div class="grid grid-cols-3 sm:grid-cols-4 md:grid-cols-5 lg:grid-cols-7 gap-2">
                @if ($categories && count($categories) > 0)
                    @foreach ($categories as $category)
                        <div class="bg-gray-100 p-2 rounded flex flex-col items-center justify-center text-center h-20">
                            <svg class="w-6 h-6 text-red-500 mb-1" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                            </svg>
                            <a href="#">
                                <span class="text-xs">{{ $category['name'] }}</span> <!-- Change here -->
                            </a>
                        </div>
                    @endforeach
                @else
                    <p>No categories available.</p>
                @endif
            </div>
        </div>
    </section> --}}




    <section class="max-w-6xl mx-auto px-4 py-8">
        <div class="bg-white p-4">
            <h2 class="text-2xl font-bold mb-4 text-center">Top News Category</h2>

            <div class="relative w-full h-6 bg-gray-200 rounded-full mb-6">
                <div class="absolute left-0 top-0 h-full w-1/4 bg-red-500 rounded-full"></div>
                <div class="absolute right-0 top-0 text-xs font-semibold text-red-500 mr-2">Live</div>
            </div>

            <form class="mb-6">
                <div class="relative">
                    <input type="text" placeholder="Search categories..."
                        class="w-full p-2 pl-10 pr-4 rounded-full border border-gray-300 focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent">
                    <div class="absolute left-3 top-1/2 transform -translate-y-1/2">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                </div>
            </form>

            <div class="grid grid-cols-3 sm:grid-cols-4 md:grid-cols-5 lg:grid-cols-7 gap-2">
                @php
                    $categories = [
                        'Politics',
                        'Art & Entertainment',
                        'Business',
                        'Communication',
                        'Automobile',
                        'Agriculture & Farming',
                        'Travel',
                        'Government',
                        'Health & Medicine',
                        'Home & Estate',
                        'IT & Computers',
                        'Legal Services',
                        'Business Service',
                        'Engineering',
                        'Finance Technology',
                        'Energy & Utilities',
                        'Education & Learning',
                        'Car Dealer',
                        'Insurance - General',
                        'Security & Emergency',
                        'Pet Supply',
                        'Schools',
                        'Sports',
                        'Online Influencers',
                        'Personal Care',
                        'Tourism & Hospitality',
                        'Fashion & Clothing',
                        'Food & Restaurant',
                        'Companies',
                        'Phone/Laptop',
                        'Religion & Spirituality',
                        'Shopping',
                        'Transportation',
                        'Non-Profit Organization',
                        'Online Courses',
                    ];
                @endphp

                @foreach ($categories as $category)
                    <div class="bg-gray-100 p-2 rounded flex flex-col items-center justify-center text-center h-20">
                        <svg class="w-6 h-6 text-red-500 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                        </svg>
                        <a href="#">
                            <span class="text-xs">{{ $category }}</span>
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <section class="w-full">
        <img src="{{ asset('/images/ad4.jpg') }}" alt="Advertisement" class="w-full h-auto max-h-60 object-cover">
    </section>

    <section>


        <section class="container mx-auto px-4 py-8">
            <h2 class="text-3xl font-bold mb-6 text-gray-800">Obituary</h2>
            <h3 class="text-xl font-semibold mb-4 text-gray-700">In Loving Memory</h3>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">
                <!-- Obituary 1 -->
                <div class="bg-white shadow-md rounded-lg overflow-hidden">
                    <img src="/images/news-image.jpeg" alt="John Obiama" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <h4 class="font-semibold text-lg mb-2">JOHN OBIAMA</h4>
                        <div class="text-sm text-gray-600">
                            <p>Sex: M</p>
                            <p>Age: 26</p>
                            <p>DOB: 12-09-95</p>
                            <p>DOD: 31-12-23</p>
                        </div>
                        <button class="mt-4 bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded">
                            Send Condolence
                        </button>
                    </div>
                </div>

                <!-- Obituary 2 -->
                <div class="bg-white shadow-md rounded-lg overflow-hidden">
                    <img src="/images/news-image.jpeg" alt="John Obiama" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <h4 class="font-semibold text-lg mb-2">JOHN OBIAMA</h4>
                        <div class="text-sm text-gray-600">
                            <p>Sex: M</p>
                            <p>Age: 26</p>
                            <p>DOB: 12-09-95</p>
                            <p>DOD: 31-12-23</p>
                        </div>
                        <button class="mt-4 bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded">
                            Send Condolence
                        </button>
                    </div>
                </div>

                <!-- Obituary 3 -->
                <div class="bg-white shadow-md rounded-lg overflow-hidden">
                    <img src="/images/news-image.jpeg" alt="John Obiama" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <h4 class="font-semibold text-lg mb-2">JOHN OBIAMA</h4>
                        <div class="text-sm text-gray-600">
                            <p>Sex: M</p>
                            <p>Age: 26</p>
                            <p>DOB: 12-09-95</p>
                            <p>DOD: 31-12-23</p>
                        </div>
                        <button class="mt-4 bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded">
                            Send Condolence
                        </button>
                    </div>
                </div>

                <!-- Obituary 4 -->
                <div class="bg-white shadow-md rounded-lg overflow-hidden">
                    <img src="/images/news-image.jpeg" alt="John Obiama" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <h4 class="font-semibold text-lg mb-2">JOHN OBIAMA</h4>
                        <div class="text-sm text-gray-600">
                            <p>Sex: M</p>
                            <p>Age: 26</p>
                            <p>DOB: 12-09-95</p>
                            <p>DOD: 31-12-23</p>
                        </div>
                        <button class="mt-4 bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded">
                            Send Condolence
                        </button>
                    </div>
                </div>
            </div>

            <div class="text-center mt-8">
                <button class="bg-purple-500 hover:bg-purple-600 text-white font-semibold py-2 px-6 rounded-full">
                    See more
                </button>
            </div>
        </section>
    </section>



    <section class="container mx-auto px-4 py-8 bg-no-repeat bg-cover"
        style="background-image: url('/images/gradient.jpeg');">
        <div class="bg-gradient rounded-lg shadow-lg overflow-hidden">
            <div class="flex flex-col md:flex-row items-center p-6 relative">
                <img src="/images/avatatar.jpeg" alt="Loved one"
                    class="w-24 h-24 rounded-full object-cover border-4 border-white shadow-md mb-4 md:mb-0 md:mr-6">
                <div class="text-black text-center md:text-left flex-grow">
                    <h2 class="font-['Courgette'] text-2xl mb-2 italic">In loving memory</h2>
                    <h1 class="text-3xl font-bold mb-2">Post remembrance in honoring memory of loved ones</h1>
                    <p class="mb-4">Post remembrance with ease so the public can see and memories would not
                        be lost in time</p>
                    <button
                        class="bg-purple-600 hover:bg-purple-700 text-white font-bold py-2 px-6 rounded-full transition duration-300">
                        Go to Templates
                    </button>
                </div>
            </div>
        </div>
    </section>


    <section class="bg-white p-4">
        <h2 class="text-2xl font-bold mb-4 bg-gray-200 p-2">Remembrance</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
            @for ($i = 0; $i < 4; $i++)
                <div class="border border-gray-200 rounded-lg overflow-hidden">
                    <div class="relative">
                        <img src="/images/news-image.jpeg" alt="Remembrance Image" class="w-full h-48 object-cover">
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
                        <p class="font-semibold">Name: MR AND MRS AMAO ADAMS</p>
                        <p>Date: 12-Mar</p>
                        <p>Address:</p>
                        <p>Year: 2nd year</p>
                        <button class="mt-2 bg-gray-200 text-gray-700 px-4 py-2 rounded hover:bg-gray-300 transition">
                            {{ $i % 2 == 0 ? 'Extend Regards' : 'Send Regards' }}
                        </button>
                    </div>
                </div>
            @endfor
        </div>

        <div class="mt-6 text-center">
            <button class="bg-purple-600 text-white px-6 py-2 rounded hover:bg-purple-700 transition">
                See more
            </button>
        </div>
    </section>


    <section class="bg-white p-4">
        <div class="max-w-4xl mx-auto">
            <h2 class="text-2xl font-bold mb-2">Do you know this person</h2>
            <div class="bg-red-500 h-1 w-full mb-4"></div>
            <p class="text-gray-600 mb-4">Send in your condolences</p>

            <div class="flex flex-col md:flex-row gap-6">
                <div class="md:w-1/2">
                    <img src="/images/missing-person.jpg" alt="Mr. Stephen Kamboe"
                        class="w-full h-auto rounded-lg shadow-lg">
                </div>

                <div class="md:w-1/2">
                    <form class="space-y-4">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                            <input type="text" id="name" name="name" placeholder="Name"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label for="phone1" class="block text-sm font-medium text-gray-700">Phone
                                    no.</label>
                                <input type="tel" id="phone1" name="phone1" placeholder="Phone no."
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            </div>
                            <div>
                                <label for="phone2" class="block text-sm font-medium text-gray-700">Phone
                                    no.</label>
                                <input type="tel" id="phone2" name="phone2" placeholder="Phone no."
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            </div>
                        </div>

                        <div>
                            <label for="condolence" class="block text-sm font-medium text-gray-700">Condolence</label>
                            <textarea id="condolence" name="condolence" rows="4" placeholder="Type in your message"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></textarea>
                        </div>

                        <div>
                            <button type="submit"
                                class="w-full bg-purple-500 text-white py-2 px-4 rounded-md hover:bg-purple-600 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-opacity-50">
                                Send
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>


    <section class="bg-white p-4">
        <h2 class="text-2xl font-bold mb-4 bg-gray-200 p-2">Change of Name</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4">
            @for ($i = 0; $i < 5; $i++)
                <div class="border border-gray-300 p-4 rounded-lg">
                    <p class="font-semibold mb-2">Name: JOHN OBIAMA</p>
                    <p class="text-sm">I, formally John Marvin Kane, now JOHN OBIAMA. All former documents remains
                        valid. Authority and general public take note</p>
                </div>
            @endfor
        </div>

        <div class="mt-6 text-center">
            <button class="bg-purple-600 text-white px-6 py-2 rounded hover:bg-purple-700 transition">
                See more
            </button>
        </div>
    </section>

    <section class="bg-green-100 p-4">
        <h2 class="text-2xl font-bold mb-4 text-center text-green-800">PRIDE OF NIGERIA</h2>

        <!-- Top News Items -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4 mb-8">
            @foreach (['Osadebe: President Tinubu To Hold Consultation Session', 'Dismay Marathon Winners Wait In Center Of Abuja', 'Lagos State Governor Introduces New Initiative To Boost Productivity Levels', 'Nigerian Army Promises Ongoing Engagement To Maintain Security', 'Nigeria On Track Says IMF, World Bank, But By Cryptos Trade, Ease Trade'] as $index => $title)
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <img src="/images/news-image.jpeg" alt="News Image" class="w-full h-40 object-cover">
                    <div class="p-4">
                        <h3 class="font-semibold text-sm mb-2">{{ $title }}</h3>
                        <p class="text-xs text-gray-600">Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                            Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pride of Nigeria Banner -->
        <div class="bg-green-700 text-white text-center py-2 mb-8">
            <h3 class="text-xl font-bold">Pride of Nigeria</h3>
        </div>

        <!-- Lifestyle Interview Section -->
        <h3 class="text-xl font-semibold mb-4 text-center">11 Lifestyle interview with successful People</h3>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 mb-8">
            @for ($i = 0; $i < 4; $i++)
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    <img src="/images/news-image.jpeg" alt="Interview Image" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <p class="font-semibold mb-2">Topic: LIVING IN THE EYES OF TODAY'S MEDIA SPACE OF TODAY</p>
                        <p>Guest: John Stones</p>
                        <p>Date: 12-Mar</p>
                        <p>By: John James</p>
                    </div>
                </div>
            @endfor
        </div>

        <div class="text-center">
            <button class="bg-purple-600 text-white px-6 py-2 rounded hover:bg-purple-700 transition">
                See more
            </button>
        </div>
    </section>

    <section class="bg-white p-4">
        <div class="flex flex-col md:flex-row items-center md:items-start gap-8">
            <!-- Left side - Image -->
            <div class="w-full md:w-1/2 relative">
                <img src="/images/event.jpg" alt="Event background" class="w-full h-auto rounded-lg shadow-lg">
                <div class="absolute inset-0 flex items-center justify-center">
                    <div class="bg-black bg-opacity-60 rounded-full p-8">
                        <h2 class="text-white text-3xl font-bold text-center">EVENT<br>TICKETS</h2>
                    </div>
                </div>
                <div class="absolute top-4 left-4 bg-white rounded-full px-3 py-1 text-sm">
                    Send e-party
                </div>
                <div class="absolute bottom-4 right-4 bg-white rounded-full px-3 py-1 text-sm">
                    Start a party
                </div>
            </div>

            <!-- Right side - Text content -->
            <div class="w-full md:w-1/2">
                <p class="mb-4">Experience effortless event scheduling and management with Evenup. Whether it's a
                    corporate conference, wedding, or community gathering, our intuitive platform simplifies every
                    step.</p>

                <ul class="space-y-2">
                    <li class="flex items-center">
                        <svg class="w-5 h-5 mr-2 text-green-500" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                            </path>
                        </svg>
                        Schedule events effortlessly
                    </li>
                    <li class="flex items-center">
                        <svg class="w-5 h-5 mr-2 text-green-500" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                            </path>
                        </svg>
                        Coordinate with attendees seamlessly
                    </li>
                    <li class="flex items-center">
                        <svg class="w-5 h-5 mr-2 text-green-500" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                            </path>
                        </svg>
                        Send invitations and manage RSVPs
                    </li>
                    <li class="flex items-center">
                        <svg class="w-5 h-5 mr-2 text-green-500" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                            </path>
                        </svg>
                        Track event progress in real-time
                    </li>
                    <li class="flex items-center">
                        <svg class="w-5 h-5 mr-2 text-green-500" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7">
                            </path>
                        </svg>
                        Customizable event templates
                    </li>
                </ul>

                <button class="mt-6 bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition">
                    Get Started
                </button>
            </div>
        </div>
    </section>

    <section class="relative h-screen bg-gray-900 text-white">
        <div class="absolute inset-0 bg-black opacity-50"></div>
        <div class="relative z-10 flex flex-col items-center justify-center h-full px-4 text-center">
            <h1 class="mb-6 text-4xl font-bold tracking-tight">
                SEE WHO IS TAKEN?
            </h1>
            <p class="mb-8 text-lg max-w-2xl">
                Connect with your family story on Ancestry and discover the what, where, and who of how it all leads
                to you.
            </p>
            <div class="flex space-x-4">
                <a href="#"
                    class="px-6 py-2 bg-white text-black font-semibold rounded hover:bg-gray-200 transition-colors">
                    View Registry
                </a>
                <a href="#"
                    class="px-6 py-2 border border-white font-semibold rounded hover:bg-white hover:text-black transition-colors">
                    Court Statement
                </a>
                <a href="#"
                    class="px-6 py-2 border border-white font-semibold rounded hover:bg-white hover:text-black transition-colors">
                    Birth Certificate
                </a>
            </div>
        </div>
    </section>


    <section class="container mx-auto px-4 py-8">
        <h2 class="text-3xl font-bold mb-6">Book A Hotel Before Leaving</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
            <div class="relative">
                <img src="{{ asset('/images/hotel_image1.jpeg') }}" alt="Luxury hotel room"
                    class="w-full h-64 object-cover rounded-lg">
                <div class="absolute bottom-4 left-4 bg-white px-3 py-1 rounded">
                    <p class="text-sm font-semibold">Hundreds of 5-star reviews</p>
                </div>
                <a href="http://ebnbhotel.com/"
                    class="absolute bottom-4 right-4 bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 transition">Book
                    Now</a>
            </div>

            <div>
                <h3 class="text-2xl font-semibold mb-4 text-red-600">You will be amazed by what we have prepared
                    for you</h3>
                <p class="mb-4">Prepare to be enchanted by our warm hospitality and personalized service, crafted
                    to exceed your expectations. Whether you're here for business or leisure, our dedicated team is
                    committed to making your stay a memorable one.</p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <img src="{{ asset('/images/hotel_image2.jpeg') }}" alt="Hotel sign"
                    class="w-full h-48 object-cover rounded-lg">
            </div>
            <div>
                <img src="{{ asset('/images/hotel_image3.jpeg') }}" alt="Hotel exterior"
                    class="w-full h-48 object-cover rounded-lg">
            </div>
            <div>
                <img src="{{ asset('/images/hotel_image4.jpeg') }}" alt="Hotel entrance"
                    class="w-full h-48 object-cover rounded-lg">
            </div>
        </div>
    </section>

    <section class="container mx-auto px-4 py-8">
        <h2 class="text-2xl font-bold mb-4 text-center">Explore Our Templates</h2>
        <div class="overflow-x-auto whitespace-nowrap">
            <div class="inline-block p-4">
                <div class="bg-white rounded-lg shadow-lg p-6 w-64">
                    <img src="/images/template1.jpeg" alt="Template 1" class="w-full rounded-md mb-4">
                    <h3 class="font-bold text-lg">Template 1</h3>
                    <p>A beautiful way to remember your loved ones.</p>
                </div>
            </div>
            <div class="inline-block p-4">
                <div class="bg-white rounded-lg shadow-lg p-6 w-64">
                    <img src="/images/template2.jpeg" alt="Template 2" class="w-full rounded-md mb-4">
                    <h3 class="font-bold text-lg">Template 2</h3>
                    <p>Elegant design for heartfelt messages.</p>
                </div>
            </div>
            <div class="inline-block p-4">
                <div class="bg-white rounded-lg shadow-lg p-6 w-64">
                    <img src="/images/template3.jpeg" alt="Template 3" class="w-full rounded-md mb-4">
                    <h3 class="font-bold text-lg">Template 3</h3>
                    <p>Classic style for timeless memories.</p>
                </div>
            </div>
            <!-- Add more templates as needed -->
        </div>
    </section>


    <section class="container mx-auto px-4 py-8">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold">Groups You May Like</h2>
            <a href="#" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">Join
                The Topic Discussions</a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ([
            [
                'title' => 'Current Affairs',
                'description' => 'Stay informed with the latest developments in the world. Discuss current events, analyze their impact, and engage in meaningful debates about the issues that shape our lives.',
                'action' => 'Join!',
            ],
            [
                'title' => 'Diverse Perspectives',
                'description' => 'Join a diverse community of thinkers and share your unique viewpoints, challenging thoughts, and innovative ideas. Expand your worldview by engaging with different perspectives in this vibrant forum.',
                'action' => 'Join!',
            ],
            [
                'title' => 'Voice Your Opinions',
                'description' => 'Have your say on the topics that matter to you. Share your insights, views, and solutions to global challenges that help shape public opinion. Our community values every voice that can make a real difference.',
                'action' => 'Join!',
            ],
            [
                'title' => 'Connect with Like-Minded Individuals',
                'description' => 'Connect with others who share your interests and passions. Engage in stimulating conversations where you can find like-minded individuals to connect with, learn from, and build relationships with.',
                'action' => 'Join!',
            ],
            [
                'title' => 'Access Expert Analysis',
                'description' => 'Gain access to in-depth analysis and commentary on leading issues from experts in various fields. Engage in discussions with professionals and experts to enhance your understanding and broaden your knowledge.',
                'action' => 'Join!',
            ],
            [
                'title' => 'Stay Civically Engaged',
                'description' => 'Being part of our discussion groups is not just about debating ideas, it\'s about actively participating in civil discourse and contributing to a more informed and engaged society. Join us in fostering constructive dialogue and civic engagement.',
                'action' => 'Join!',
            ],
        ] as $group)
                <div class="bg-gray-100 p-6 rounded-lg shadow">
                    <h3 class="text-xl font-semibold mb-3">{{ $group['title'] }}</h3>
                    <p class="mb-4">{{ $group['description'] }}</p>
                    <a href="#"
                        class="inline-block bg-orange-500 text-white px-4 py-2 rounded hover:bg-orange-600 transition">{{ $group['action'] }}</a>
                </div>
            @endforeach
        </div>

        <div class="mt-12 bg-gray-900 text-white p-6 rounded-lg flex flex-col md:flex-row items-center justify-between">
            <div class="mb-4 md:mb-0">
                <h3 class="text-xl font-semibold mb-2">Subscribe To Our Newsletter</h3>
                <p>Don't miss out on latest updates and information</p>
            </div>
            <form class="flex w-full md:w-auto">
                <input type="email" placeholder="Enter your email"
                    class="px-4 py-2 rounded-l text-gray-900 w-full md:w-64">
                <button type="submit"
                    class="bg-red-500 text-white px-4 py-2 rounded-r hover:bg-red-600 transition">Subscribe</button>
            </form>
        </div>
    </section>

    <section class="container mx-auto px-4 py-8">
        <div class="bg-gray-200 p-4 mb-6">
            <h2 class="text-2xl font-bold">Birthday celebration</h2>
        </div>

        <h3 class="text-center italic text-2xl mb-6">Happy Birthday to these wonderful people!</h3>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 mb-6">
            @foreach ([1, 2, 3, 4] as $index)
                <div class="bg-white shadow-md rounded-lg overflow-hidden">
                    <img src="{{ asset('/images/birthday.jpg') }}" alt="Birthday person {{ $index }}"
                        class="w-full h-48 object-cover">
                    <div class="p-4">
                        <h4 class="font-bold">Name: MRS JANETH OBAMA</h4>
                        <p>Sex: F</p>
                        <p>Age: 28</p>
                        <p>DOB: 12-Mar</p>
                        <p class="truncate">Address: 24 junta street off dispatch city osogbo osun state
                            secretariat</p>
                        <p>Time: 05:04AM</p>
                        <button class="mt-2 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">Send
                            Wishes</button>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="text-center mb-12">
            <button class="bg-purple-600 text-white px-6 py-2 rounded hover:bg-purple-700 transition">See
                more</button>
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


    <section class="container mx-auto px-4 py-8">
        <div class="bg-blue-600 text-white p-4 mb-6">
            <h2 class="text-2xl font-bold">Stolen items and vehicles</h2>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 mb-6">
            @php
                $items = [
                    [
                        'image' => 'car.jpg',
                        'name' => 'BMW 572 JR',
                        'date' => '12-05-24',
                        'color' => 'Black',
                        'value' => '950,000',
                        'description' => 'Car stolen BMW 572 JR vehicle at the parking lot of NNPC towers.',
                    ],
                    [
                        'image' => 'plane.jpg',
                        'name' => 'BMW 572 JR',
                        'date' => '12-05-24',
                        'color' => 'Black',
                        'value' => '950,000',
                        'description' => 'Car stolen BMW 572 JR vehicle at the parking lot of NNPC towers.',
                    ],
                    [
                        'image' => 'gold.jpg',
                        'name' => 'BMW 572 JR',
                        'date' => '12-05-24',
                        'color' => 'Black',
                        'value' => '950,000',
                        'description' => 'Car stolen BMW 572 JR vehicle at the parking lot of NNPC towers.',
                    ],
                    [
                        'image' => 'plane.jpg',
                        'name' => 'BMW 572 JR',
                        'date' => '12-05-24',
                        'color' => 'Black',
                        'value' => '950,000',
                        'description' => 'Car stolen BMW 572 JR vehicle at the parking lot of NNPC towers.',
                    ],
                ];
            @endphp

            @foreach ($items as $item)
                <div class="bg-white shadow-md rounded-lg overflow-hidden">
                    {{-- <img src="{{ asset('images/' . $item['image']) }}" alt="{{ $item['name'] }}"
                                class="w-full h-48 object-cover"> --}}
                    <img src="/images/vehicle.jpg" alt="Stolen Vehicle">
                    <div class="p-4">
                        <h4 class="font-bold">Item: {{ $item['name'] }}</h4>
                        <p>Date of Loss: {{ $item['date'] }}</p>
                        <p>Color: {{ $item['color'] }}</p>
                        <p>Value: ${{ $item['value'] }}</p>
                        <p class="text-sm mt-2">Description:</p>
                        <p class="text-sm">{{ $item['description'] }}</p>
                        <p class="mt-2">Call: 08023364726</p>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="text-center">
            <button class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition">See more</button>
        </div>
    </section>


    <section class="container mx-auto px-4 py-8">
        <div class="bg-gray-200 p-4 mb-6">
            <h2 class="text-2xl font-bold">Wedding Celebration</h2>
        </div>

        <h3 class="text-center italic text-2xl mb-6">Hearty Congratulations!</h3>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 mb-6">
            @php
                $couples = [
                    [
                        'names' => 'MR AND MRS JAMO ADAMS',
                        'husband' => 'Tolu Aman Adebayo',
                        'wife' => 'Shade Esther John',
                        'address' => '24 junta street off dispatch city osogbo osun state secretariat',
                        'time' => '05:04AM',
                    ],
                    [
                        'names' => 'MR AND MRS JAMO ADAMS',
                        'husband' => 'Tolu Aman Adebayo',
                        'wife' => 'Shade Esther John',
                        'address' => '24 junta street off dispatch city osogbo osun state secretariat',
                        'time' => '05:04AM',
                    ],
                    [
                        'names' => 'MR AND MRS JAMO ADAMS',
                        'husband' => 'Tolu Aman Adebayo',
                        'wife' => 'Shade Esther John',
                        'address' => '24 junta street off dispatch city osogbo osun state secretariat',
                        'time' => '05:04AM',
                    ],
                    [
                        'names' => 'MR AND MRS JAMO ADAMS',
                        'husband' => 'Tolu Aman Adebayo',
                        'wife' => 'Shade Esther John',
                        'address' => '24 junta street off dispatch city osogbo osun state secretariat',
                        'time' => '05:04AM',
                    ],
                ];
            @endphp

            @foreach ($couples as $couple)
                <div class="bg-red-400 rounded-lg overflow-hidden relative">
                    <div class="absolute top-2 right-2 bg-white rounded-full p-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-red-400" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                        </svg>
                    </div>
                    <div class="p-4 text-white">
                        <h4 class="font-bold">Couple: {{ $couple['names'] }}</h4>
                        <p>Husband: {{ $couple['husband'] }}</p>
                        <p>Wife: {{ $couple['wife'] }}</p>
                        <p class="text-sm mt-2">Address:</p>
                        <p class="text-sm">{{ $couple['address'] }}</p>
                        <p class="mt-2">Time: {{ $couple['time'] }}</p>
                        <button class="mt-4 bg-white text-red-400 px-4 py-2 rounded hover:bg-gray-100 transition">Send
                            Wishes</button>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="text-center">
            <button class="bg-purple-600 text-white px-6 py-2 rounded hover:bg-purple-700 transition">See
                more</button>
        </div>
    </section>

    <section class="container mx-auto px-4 py-8">
        <div class="bg-blue-600 text-white p-4 mb-6">
            <h2 class="text-2xl font-bold">Naming Ceremony/Child Dedication</h2>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4 mb-6">
            @php
                $ceremonies = [
                    [
                        'parents' => 'MR AND MRS JAMO ADAMS',
                        'date' => '12-Mar',
                        'address' => '24 junta street off dispatch city osogbo osun state secretariat',
                        'time' => '05:04AM',
                    ],
                    [
                        'parents' => 'MR AND MRS JAMO ADAMS',
                        'date' => '12-Mar',
                        'address' => '24 junta street off dispatch city osogbo osun state secretariat',
                        'time' => '05:04AM',
                    ],
                    [
                        'parents' => 'MR AND MRS JAMO ADAMS',
                        'date' => '12-Mar',
                        'address' => '24 junta street off dispatch city osogbo osun state secretariat',
                        'time' => '05:04AM',
                    ],
                    [
                        'parents' => 'MR AND MRS JAMO ADAMS',
                        'date' => '12-Mar',
                        'address' => '24 junta street off dispatch city osogbo osun state secretariat',
                        'time' => '05:04AM',
                    ],
                ];
            @endphp

            @foreach ($ceremonies as $ceremony)
                <div class="bg-blue-600 rounded-lg overflow-hidden relative">
                    <div class="h-32 bg-gray-300"></div>
                    <div class="absolute top-2 right-2 bg-white rounded-full p-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                        </svg>
                    </div>
                    <div class="p-4 text-white">
                        <h4 class="font-bold">Parents: {{ $ceremony['parents'] }}</h4>
                        <p>Date: {{ $ceremony['date'] }}</p>
                        <p class="text-sm mt-2">Address:</p>
                        <p class="text-sm">{{ $ceremony['address'] }}</p>
                        <p class="mt-2">Time: {{ $ceremony['time'] }}</p>
                        <button class="mt-4 bg-white text-blue-600 px-4 py-2 rounded hover:bg-gray-100 transition">Send
                            Regards</button>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="text-center">
            <button class="bg-purple-600 text-white px-6 py-2 rounded hover:bg-purple-700 transition">See
                more</button>
        </div>
    </section>



    <section class="container mx-auto px-4 py-8">
        <h2 class="text-2xl font-bold mb-6">Product/Business Launch</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
            <!-- Launch Item 1 -->
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <img src="/images/product-launch.jpg" alt="Launch Image" class="w-full h-48 object-cover">
                <div class="p-4">
                    <p class="font-semibold">Name: DARMA</p>
                    <p>Date: 12 Mar</p>
                    <p>By: Karma Ways Group</p>
                </div>
            </div>

            <!-- Launch Item 2 -->
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <img src="/images/product-launch.jpg" alt="Launch Image" class="w-full h-48 object-cover">
                <div class="p-4">
                    <p class="font-semibold">Name: DARMA</p>
                    <p>Date: 12 Mar</p>
                    <p>By: Karma Ways Group</p>
                </div>
            </div>

            <!-- Launch Item 3 -->
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <img src="/images/product-launch.jpg" alt="Launch Image" class="w-full h-48 object-cover">
                <div class="p-4">
                    <p class="font-semibold">Name: DARMA</p>
                    <p>Date: 12 Mar</p>
                    <p>By: Karma Ways Group</p>
                </div>
            </div>

            <!-- Launch Item 4 -->
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <img src="/images/product-launch.jpg" alt="Launch Image" class="w-full h-48 object-cover">
                <div class="p-4">
                    <p class="font-semibold">Name: DARMA</p>
                    <p>Date: 12 Mar</p>
                    <p>By: Karma Ways Group</p>
                </div>
            </div>
        </div>

        <div class="text-center mt-6">
            <button
                class="bg-purple-600 hover:bg-purple-700 text-white font-semibold py-2 px-6 rounded-full transition duration-300">
                See more
            </button>
        </div>
    </section>


    <div class="container mx-auto px-4">
        <!-- Product Showcase Section -->
        <div class="mb-8">
            <h2 class="text-xl font-bold mb-4 border-b pb-2">Nigeria's Decide and Choice of Product/ Items</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-4">
                @for ($i = 0; $i < 4; $i++)
                    <div class="bg-white shadow-md rounded-lg overflow-hidden">
                        <img src="/images/product-image.jpg" alt="Product Image" class="w-full h-48 object-cover">
                        <div class="p-4">
                            <h3 class="font-semibold mb-2">Product: INDOMIE</h3>
                            <p class="text-sm text-gray-600">By: John James</p>
                        </div>
                    </div>
                @endfor
            </div>
            <div class="text-center mt-4">
                <a href="#" class="bg-indigo-600 text-white px-4 py-2 rounded-md inline-block">See more</a>
            </div>
        </div>

        <!-- Top News Section -->
        <div>
            <h2 class="text-xl font-bold mb-4 border-b pb-2">Top Topics</h2>
            <div class="space-y-8">
                @if (count($topTopicPostsData) > 0)
                    @foreach ($topTopicPostsData as $post)
                        <a href="{{ route('post.details', $post['slug'] ?? '#') }}"
                            class="hover:text-blue-600 transition-colors w-full flex items-start space-x-4">
                            {{-- Image --}}
                            @if ($post['featured_image'])
                                <img src="{{ $post['featured_image'] }}" alt="{{ ucwords(strtolower($post['title'])) }}"
                                    class="w-24 h-24 object-cover rounded-md">
                            @else
                                <img src="https://picsum.photos/seed/news/1200/600"
                                    alt="{{ ucwords(strtolower($post['title'])) }}"
                                    class="w-24 h-24 object-cover rounded-md">
                            @endif

                            {{-- Text Content --}}
                            <div>
                                <h3 class="font-semibold mb-2">
                                    {{ $post['title'] ?? 'Untitled' }}
                                </h3>
                                <p class="text-sm text-gray-600">
                                    {{ \Illuminate\Support\Str::limit(strip_tags($post['content']), 50, '...') }}
                                </p>
                            </div>
                        </a>
                    @endforeach
                @else
                    <p>No Top Topic news available.</p>
                @endif
            </div>
        </div>


    </div>
    </main>

@endsection
