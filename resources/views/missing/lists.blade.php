@extends('base.base')

@section('content')
    <div class="container mx-auto my-8">
        <h1 class="text-3xl font-bold text-center mb-6">Missing Persons</h1>

        @if (count($postsData) > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($postsData as $post)
                    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                        <img src="{{ $post['featured_image'] }}" alt="{{ $post['title'] }}" class="w-full h-48 object-cover">
                        <div class="p-4">
                            <h2 class="text-xl font-semibold text-gray-800 mb-2">{{ $post['title'] }}</h2>
                            <p class="text-sm text-gray-600 mb-4">{!! Str::limit(strip_tags($post['content']), 150) !!}</p>
                            <a href="{{ route('missing-wanted.details', ['slug' => $post['slug']]) }}"
                                class="text-indigo-600 hover:text-indigo-800 text-sm font-medium">Read More
                                &rarr;</a>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            @if ($pagination['total'] > 0)
                <div class="mt-8">
                    <nav class="flex justify-center space-x-2">
                        @if ($pagination['current_page'] > 1)
                            <a href="?page={{ $pagination['current_page'] - 1 }}"
                                class="px-4 py-2 bg-gray-200 text-gray-600 rounded-md hover:bg-gray-300">&laquo;
                                Previous</a>
                        @endif

                        @for ($i = 1; $i <= $pagination['last_page']; $i++)
                            <a href="?page={{ $i }}"
                                class="px-4 py-2 {{ $pagination['current_page'] == $i ? 'bg-indigo-600 text-white' : 'bg-gray-200 text-gray-600 hover:bg-gray-300' }} rounded-md">
                                {{ $i }}
                            </a>
                        @endfor

                        @if ($pagination['current_page'] < $pagination['last_page'])
                            <a href="?page={{ $pagination['current_page'] + 1 }}"
                                class="px-4 py-2 bg-gray-200 text-gray-600 rounded-md hover:bg-gray-300">Next &raquo;</a>
                        @endif
                    </nav>
                </div>
            @endif
        @else
            <div class="text-center text-gray-600">
                <p>No public notices available at the moment.</p>
            </div>
        @endif
    </div>
@endsection
