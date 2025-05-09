@extends('base.base')

@section('content')
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <h1 class="text-4xl font-bold text-center text-gray-900 mb-8">Wedding Posts</h1>

        @if (count($postsData) > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-8">
                @foreach ($postsData as $post)
                    <div class="bg-white border border-gray-200 rounded-lg shadow-lg overflow-hidden">
                        <img class="w-full h-48 object-cover" src="{{ $post['featured_image'] }}" alt="Wedding Image">
                        <div class="p-6">
                            <h2 class="text-2xl font-semibold text-gray-800 mb-2">{{ $post['title'] }}</h2>
                            <p class="text-sm text-gray-500 mb-4">By {{ $post['created_by'] }} on
                                {{ \Carbon\Carbon::parse($post['wedding_date'])->format('F j, Y') }}</p>
                            <p class="text-gray-700 mb-4">{{ strip_tags($post['content']) }}</p>

                            <div class="flex justify-between items-center mt-6">
                                <span class="text-sm text-gray-500">Venue: {{ $post['venue'] }}</span>
                                <a href="{{ route('wedding.details', $post['slug']) }}"
                                    class="text-indigo-600 hover:text-indigo-800 font-medium">Read more</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-8 flex justify-between items-center">
                @if ($pagination['prev_page_url'])
                    <a href="{{ $pagination['prev_page_url'] }}"
                        class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">Previous</a>
                @endif

                @if ($pagination['next_page_url'])
                    <a href="{{ $pagination['next_page_url'] }}"
                        class="px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">Next</a>
                @endif
            </div>
        @else
            <div class="text-center py-8">
                <h2 class="text-xl font-semibold text-gray-700">No Wedding Posts Found</h2>
                <p class="text-gray-500">It looks like there are no wedding posts available at the moment.</p>
            </div>
        @endif
    </div>
@endsection
