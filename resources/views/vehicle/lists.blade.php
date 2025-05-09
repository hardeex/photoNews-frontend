@extends('base.base')
@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-8">Stolen Vehicles Reports</h1>

        @if (count($posts) > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($posts as $post)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        @if ($post['featured_image'])
                            <img src="{{ $post['featured_image'] }}" alt="{{ $post['title'] }}"
                                class="w-full h-48 object-cover">
                        @endif

                        <div class="p-4">
                            <h3 class="text-xl font-semibold mb-2">{{ $post['title'] }}</h3>

                            <div class="mb-4 text-gray-600">
                                <p><strong>Make:</strong> {{ $post['vehicle_make'] }}</p>
                                <p><strong>Year:</strong> {{ $post['vehicle_year'] }}</p>
                                <p><strong>Color:</strong> {{ $post['vehicle_color'] }}</p>
                                <p><strong>License Plate:</strong> {{ $post['license_plate'] }}</p>
                                <p><strong>Location:</strong> {{ $post['stolen_location'] }}</p>
                                <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($post['theft_date'])->format('M d, Y') }}
                                </p>
                            </div>

                            <div class="flex justify-between items-center">
                                <a href="{{ route('stolen-vehicles.details', $post['slug']) }}"
                                    class="inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">
                                    Read More
                                </a>
                                <span class="text-sm text-gray-500">
                                    Posted by {{ $post['created_by'] }}
                                </span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            @if ($pagination['last_page'] > 1)
                <div class="mt-8">
                    <nav class="flex justify-center">
                        <ul class="flex space-x-2">
                            @if ($pagination['current_page'] > 1)
                                <li>
                                    <a href="?page={{ $pagination['current_page'] - 1 }}"
                                        class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">
                                        Previous
                                    </a>
                                </li>
                            @endif

                            @if ($pagination['next_page_url'])
                                <li>
                                    <a href="?page={{ $pagination['current_page'] + 1 }}"
                                        class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">
                                        Next
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </nav>
                </div>
            @endif
        @else
            <div class="text-center py-8">
                <p class="text-gray-600">No stolen vehicle reports found.</p>
            </div>
        @endif
    </div>
@endsection
