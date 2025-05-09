@extends('base.base')

@section('content')
    <div class="container mx-auto px-4 py-6">
        <h1 class="text-2xl font-bold mb-4">Change of Name Posts</h1>

        <!-- Grid Layout -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach ($postsData as $post)
                <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                    <img src="{{ $post['featured_image'] }}" alt="{{ $post['new_name'] }}" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <h3 class="text-xl font-semibold">{{ $post['new_name'] }}</h3>
                        <p class="text-gray-500 text-sm mb-3">{{ $post['meta_description'] }}</p>
                        <div class="flex justify-between text-sm text-gray-600">
                            <span>Views: {{ $post['views'] }}</span>
                            <span>Shares: {{ $post['shares'] }}</span>
                        </div>

                        <!-- View Details Button -->
                        <a href="{{ route('change-of-name.details', ['slug' => $post['slug']]) }}"
                            class="mt-4 inline-block text-center bg-blue-500 text-white rounded-full px-6 py-2 hover:bg-blue-600 transition duration-200">
                            View Details
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-6 flex justify-between items-center">
            @if ($pagination['current_page'] > 1)
                <a href="{{ route('change-of-name.list', ['page' => $pagination['current_page'] - 1]) }}"
                    class="text-blue-500 hover:text-blue-700">
                    Previous
                </a>
            @endif

            @if ($pagination['current_page'] < $pagination['last_page'])
                <a href="{{ route('change-of-name.list', ['page' => $pagination['current_page'] + 1]) }}"
                    class="text-blue-500 hover:text-blue-700">
                    Next
                </a>
            @endif
        </div>
    </div>
@endsection
