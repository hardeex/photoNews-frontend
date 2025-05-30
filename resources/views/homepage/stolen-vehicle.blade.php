
    <section class="container mx-auto px-4 py-8">
        {{-- Header Section --}}
        <div class="bg-gradient-to-r from-blue-700 to-blue-500 text-white p-6 rounded-lg mb-8 shadow-lg">
            <div class="flex items-center gap-3">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2">
                    <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z" />
                    <line x1="12" y1="9" x2="12" y2="13" />
                    <line x1="12" y1="17" x2="12.01" y2="17" />
                </svg>
                <h2 class="text-3xl font-bold">Stolen Vehicle Alert Center</h2>
            </div>
            <p class="mt-2 text-blue-100">Help us locate these missing vehicles. If spotted, please contact local
                authorities.</p>
        </div>

        {{-- Vehicle Cards Grid --}}
        @if (count($stolenVehiclePostsData) > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 mb-8">
                @foreach ($stolenVehiclePostsData as $post)
                    <div
                        class="bg-white rounded-lg shadow-md hover:shadow-xl transition-shadow duration-300 overflow-hidden">
                        <div class="relative">
                            <img src="{{ $post['featured_image'] }}" alt="{{ $post['title'] }}"
                                class="w-full h-48 object-cover">
                            <div class="absolute top-0 right-0 bg-red-500 text-white px-3 py-1 m-2 rounded-full text-sm">
                                ALERT
                            </div>
                        </div>

                        <div class="p-4">
                            <h4 class="text-xl font-bold text-gray-800 mb-3">{{ $post['title'] }}</h4>

                            <div class="space-y-2">
                                <div class="flex justify-between text-sm">
                                    <span class="font-semibold">Make:</span>
                                    <span class="text-gray-600">{{ $post['vehicle_make'] }}</span>
                                </div>

                                <div class="flex justify-between text-sm">
                                    <span class="font-semibold">Year:</span>
                                    <span class="text-gray-600">{{ $post['vehicle_year'] }}</span>
                                </div>

                                <div class="flex justify-between text-sm">
                                    <span class="font-semibold">Color:</span>
                                    <span class="text-gray-600">{{ $post['vehicle_color'] }}</span>
                                </div>

                                <div class="flex justify-between text-sm">
                                    <span class="font-semibold">License:</span>
                                    <span
                                        class="bg-yellow-100 px-2 py-1 rounded font-mono">{{ $post['license_plate'] }}</span>
                                </div>
                            </div>

                            <div class="mt-4 pt-4 border-t border-gray-200">
                                <p class="text-sm text-gray-600">
                                    <span class="font-semibold">Location: </span>
                                    {{ $post['stolen_location'] }}
                                </p>
                                <p class="text-sm text-gray-600 mt-1">
                                    <span class="font-semibold">Stolen on: </span>
                                    {{ \Carbon\Carbon::parse($post['theft_date'])->format('F j, Y') }}
                                </p>
                            </div>

                            <div class="mt-4 text-xs text-gray-500">
                                Posted: {{ \Carbon\Carbon::parse($post['created_at'])->format('F j, Y') }}
                            </div>

                            <a href="{{ route('stolen-vehicles.details', $post['slug']) }}"
                                class="inline-block mt-2 px-4 py-2 text-white text-xs font-semibold bg-blue-600 rounded-full hover:bg-blue-700 hover:scale-105 transition duration-300 ease-in-out transform">
                                Read More
                            </a>

                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-12">
                <p class="text-gray-400 text-lg">No stolen vehicles reported at this time</p>
            </div>
        @endif

        {{-- Action Button --}}
        <div class="text-center">
            <button
                class="bg-blue-600 text-white px-8 py-3 rounded-lg hover:bg-blue-700 transition-colors duration-300 shadow-md hover:shadow-lg font-semibold">
                View All Reports
            </button>
        </div>
    </section>