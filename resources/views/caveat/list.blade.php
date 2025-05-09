@extends('base.base')
@section('content')
    <div class="min-h-screen bg-gray-50">
        <div class="container mx-auto px-4 py-8">
            <!-- Header Section -->
            <div class="mb-8">
                <h1 class="text-4xl font-bold text-gray-900">Caveat Posts</h1>
                <p class="text-lg text-gray-600 mt-2">Exploring insights, warnings, and important considerations across
                    various topics.</p>
            </div>


            <!-- Posts Sections -->
            <div class="space-y-12">
                <!-- Article Posts Section -->
                <section class="bg-white rounded-2xl shadow-lg p-6">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-2xl font-bold text-green-600">
                            Caveats Reported
                            <span class="ml-2 text-lg text-gray-500">({{ $totalArticlePosts }})</span>
                        </h2>
                    </div>

                    @if (count($articlePostsData) > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach ($articlePostsData as $post)
                                <article
                                    class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100 transition-all hover:shadow-lg">
                                    <div class="relative">
                                        <img class="w-full h-48 object-cover" src="{{ $post['featured_image'] }}"
                                            alt="{{ $post['title'] }}">
                                        @if ($post['is_featured'])
                                            <span
                                                class="absolute top-4 left-4 bg-yellow-500 text-white px-2 py-1 rounded-full text-xs">
                                                Featured
                                            </span>
                                        @endif
                                    </div>

                                    <div class="p-6">
                                        <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $post['title'] }}</h3>
                                        <p class="text-gray-600 mb-4">{!! \Str::limit(strip_tags($post['content']), 150) !!}</p>

                                        <!-- Meta Information -->
                                        <div class="flex items-center justify-between text-sm text-gray-500 mb-4">
                                            <span>By {{ $post['created_by'] }}</span>
                                            @if ($post['is_scheduled'])
                                                <span>Scheduled:
                                                    {{ \Carbon\Carbon::parse($post['scheduled_time'])->format('M d, Y') }}</span>
                                            @endif
                                        </div>

                                        <div class="flex items-center justify-between">
                                            <a href="{{ route('caveat.details', $post['slug'] ?? '#') }}"
                                                class="text-green-600 hover:text-green-700 font-medium">
                                                Read more →
                                            </a>
                                            @if ($post['allow_comments'])
                                                <span class="text-gray-500 text-sm">
                                                    <i class="fas fa-comments mr-1"></i> Comments enabled
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </article>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-12 bg-gray-50 rounded-lg">
                            <p class="text-gray-600">No Article posts available at the moment.</p>
                        </div>
                    @endif
                </section>

                <!-- Caveat Posts Section -->
                <section class="bg-white rounded-2xl shadow-lg p-6">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-2xl font-bold text-blue-600">
                            Caveat Posts
                            <span class="ml-2 text-lg text-gray-500">({{ $totalCaveatPosts }})</span>
                        </h2>


                    </div>

                    @if (count($caveatPostsData) > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach ($caveatPostsData as $post)
                                <article
                                    class="bg-white rounded-xl shadow-md overflow-hidden border border-gray-100 transition-all hover:shadow-lg">
                                    <div class="relative">
                                        <img class="w-full h-48 object-cover" src="{{ $post['featured_image'] }}"
                                            alt="{{ $post['title'] }}">
                                        <!-- Status Indicators -->
                                        <div class="absolute top-4 left-4 flex gap-2">
                                            @if ($post['is_featured'])
                                                <span
                                                    class="bg-yellow-500 text-white px-2 py-1 rounded-full text-xs">Featured</span>
                                            @endif
                                            @if ($post['is_breaking'])
                                                <span
                                                    class="bg-red-500 text-white px-2 py-1 rounded-full text-xs">Breaking</span>
                                            @endif
                                            @if ($post['hot_gist'])
                                                <span class="bg-orange-500 text-white px-2 py-1 rounded-full text-xs">Hot
                                                    Gist</span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="p-6">
                                        <div class="flex gap-2 mb-3">
                                            @if ($post['pride_of_nigeria'])
                                                <span
                                                    class="text-xs bg-green-100 text-green-600 px-2 py-1 rounded-full">Pride
                                                    of Nigeria</span>
                                            @endif
                                            @if ($post['top_topic'])
                                                <span
                                                    class="text-xs bg-purple-100 text-purple-600 px-2 py-1 rounded-full">Top
                                                    Topic</span>
                                            @endif
                                        </div>

                                        <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $post['views'] }} views
                                            {{ $post['title'] }}</h3>
                                        <p class="text-gray-600 mb-4">{!! \Str::limit(strip_tags($post['content']), 150) !!}</p>

                                        <!-- Meta Information -->
                                        <div class="flex items-center justify-between text-sm text-gray-500 mb-4">
                                            <span>By {{ $post['created_by'] }}</span>
                                            @if ($post['is_scheduled'])
                                                <span>Scheduled:
                                                    {{ \Carbon\Carbon::parse($post['scheduled_time'])->format('M d, Y') }}</span>
                                            @endif

                                            <span> {{ $post['views'] }} views </span>
                                        </div>

                                        <div class="flex items-center justify-between">
                                            <a href="{{ route('post.details', $post['slug'] ?? '#') }}"
                                                class="text-blue-600 hover:text-blue-700 font-medium">
                                                Read more →
                                            </a>
                                            @if ($post['allow_comments'])
                                                <span class="text-gray-500 text-sm">
                                                    <i class="fas fa-comments mr-1"></i> Comments enabled
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </article>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-12 bg-gray-50 rounded-lg">
                            <p class="text-gray-600">No Caveat posts available at the moment.</p>
                        </div>
                    @endif
                </section>


            </div>
        </div>
    </div>
@endsection
