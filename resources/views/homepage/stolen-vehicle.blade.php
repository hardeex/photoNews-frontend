<section class="container mx-auto px-4 py-8">
    <div class="flex flex-col lg:flex-row gap-8">
        <!-- Main Content (Left Side) -->
        <div class="lg:w-2/3">
            {{-- Header Section --}}
            <div class="bg-gradient-to-r from-blue-700 to-blue-500 text-white p-6 rounded-lg mb-8 shadow-lg relative overflow-hidden">
                <div class="absolute inset-0 opacity-10">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" class="w-full h-full">
                        <path d="M20,20 Q30,10 40,20 T60,20 T80,20" stroke="white" stroke-width="2" fill="none" />
                        <path d="M10,40 Q20,30 30,40 T50,40 T70,40 T90,40" stroke="white" stroke-width="2" fill="none" />
                        <path d="M15,70 Q25,60 35,70 T55,70 T75,70" stroke="white" stroke-width="2" fill="none" />
                    </svg>
                </div>
                <div class="relative z-10 flex items-center gap-4">
                    <div class="bg-white/20 p-3 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z" />
                            <line x1="12" y1="9" x2="12" y2="13" />
                            <line x1="12" y1="17" x2="12.01" y2="17" />
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-3xl font-bold">Stolen Vehicle Alert Center</h2>
                        <p class="mt-2 text-blue-100">Help us locate these missing vehicles. If spotted, please contact local authorities immediately.</p>
                    </div>
                </div>
            </div>

            {{-- Vehicle Cards Grid --}}
            @if (count($stolenVehiclePostsData) > 0)
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 gap-6 mb-8">
                    @foreach ($stolenVehiclePostsData as $post)
                        <div class="bg-white rounded-xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden border border-gray-100 hover:border-blue-200">
                            <div class="relative">
                                <img src="{{ $post['featured_image'] ?? '/images/vehicle-placeholder.jpg' }}" 
                                     alt="{{ $post['title'] }}"
                                     class="w-full h-48 object-cover">
                                <div class="absolute top-3 right-3 bg-red-600 text-white px-3 py-1 rounded-full text-xs font-bold shadow-md animate-pulse">
                                    STOLEN VEHICLE
                                </div>
                                <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/70 to-transparent p-4">
                                    <h4 class="text-xl font-bold text-white">{{ $post['title'] }}</h4>
                                </div>
                            </div>

                            <div class="p-5">
                                <div class="grid grid-cols-2 gap-4 mb-4">
                                    <div>
                                        <p class="text-xs text-gray-500">Make</p>
                                        <p class="font-semibold">{{ $post['vehicle_make'] }}</p>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-500">Year</p>
                                        <p class="font-semibold">{{ $post['vehicle_year'] }}</p>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-500">Color</p>
                                        <p class="font-semibold">{{ $post['vehicle_color'] }}</p>
                                    </div>
                                    <div>
                                        <p class="text-xs text-gray-500">License</p>
                                        <p class="font-mono font-bold bg-yellow-100 px-2 py-1 rounded inline-block">{{ $post['license_plate'] }}</p>
                                    </div>
                                </div>

                                <div class="space-y-3 text-sm">
                                    <div class="flex items-start">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-blue-500 mr-2 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                        <span><span class="font-medium">Location:</span> {{ $post['stolen_location'] }}</span>
                                    </div>
                                    <div class="flex items-start">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-blue-500 mr-2 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        <span><span class="font-medium">Stolen on:</span> {{ \Carbon\Carbon::parse($post['theft_date'])->format('F j, Y') }}</span>
                                    </div>
                                    <div class="flex items-start">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-blue-500 mr-2 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <span><span class="font-medium">Reported:</span> {{ \Carbon\Carbon::parse($post['created_at'])->diffForHumans() }}</span>
                                    </div>
                                </div>

                                <div class="mt-6 flex justify-between items-center">
                                    <a href="{{ route('stolen-vehicles.details', $post['slug']) }}"
                                        class="px-4 py-2 bg-blue-600 text-white rounded-lg text-sm font-semibold hover:bg-blue-700 transition-colors flex items-center">
                                        View Details
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                        </svg>
                                    </a>
                                    <button onclick="shareVehicle('{{ $post['title'] }}', '{{ route('stolen-vehicles.details', $post['slug']) }}')"
                                            class="p-2 bg-gray-100 hover:bg-gray-200 rounded-full transition-colors">
                                        <svg class="w-4 h-4 text-gray-600" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M15 8a3 3 0 10-2.977-2.63l-4.94 2.47a3 3 0 100 4.319l4.94 2.47a3 3 0 10.895-1.789l-4.94-2.47a3.027 3.027 0 000-.74l4.94-2.47C13.456 7.68 14.19 8 15 8z"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-12 bg-white rounded-xl shadow-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-400 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                    </svg>
                    <h3 class="text-xl font-semibold text-gray-700 mb-2">No Stolen Vehicles Reported</h3>
                    <p class="text-gray-500 max-w-md mx-auto">
                        There are currently no stolen vehicle reports. Check back regularly for updates.
                    </p>
                </div>
            @endif

            {{-- Action Button --}}
            <div class="text-center mt-8">
                <button class="bg-blue-600 text-white px-8 py-3 rounded-lg hover:bg-blue-700 transition-colors duration-300 shadow-md hover:shadow-lg font-semibold flex items-center justify-center mx-auto">
                    View All Reports
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Right Sidebar (Banners) -->
        <div class="lg:w-1/3 space-y-6">
            <!-- Emergency Contact Banner -->
            <div class="bg-gradient-to-br from-red-600 to-red-700 rounded-xl p-6 text-white shadow-lg">
                <div class="flex items-center mb-4">
                    <div class="bg-white/20 p-2 rounded-full mr-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold">Emergency Contacts</h3>
                </div>
                <p class="mb-4 text-red-100">If you spot any of these vehicles, contact authorities immediately. Do not approach.</p>
                <div class="space-y-3">
                    <a href="tel:911" class="flex items-center justify-between bg-white/10 hover:bg-white/20 p-3 rounded-lg transition-colors">
                        <div class="flex items-center">
                            <div class="bg-white/20 p-2 rounded-full mr-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                            </div>
                            <span>Emergency Police Line</span>
                        </div>
                        <span class="font-bold">911</span>
                    </a>
                    <a href="tel:+1234567890" class="flex items-center justify-between bg-white/10 hover:bg-white/20 p-3 rounded-lg transition-colors">
                        <div class="flex items-center">
                            <div class="bg-white/20 p-2 rounded-full mr-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                            </div>
                            <span>Stolen Vehicle Hotline</span>
                        </div>
                        <span class="font-bold">(234) 7000 555666</span>
                    </a>
                </div>
            </div>

            <!-- Prevention Tips Banner -->
            <div class="bg-white border border-gray-200 rounded-xl p-6 shadow-sm">
                <div class="flex items-center mb-4">
                    <div class="bg-blue-100 p-2 rounded-full mr-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800">Theft Prevention Tips</h3>
                </div>
                <ul class="space-y-3 text-sm text-gray-600">
                    <li class="flex items-start">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-blue-500 mr-2 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <span>Always lock your vehicle and take the keys</span>
                    </li>
                    <li class="flex items-start">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-blue-500 mr-2 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <span>Park in well-lit, secure areas</span>
                    </li>
                    <li class="flex items-start">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-blue-500 mr-2 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <span>Install anti-theft devices</span>
                    </li>
                    <li class="flex items-start">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-blue-500 mr-2 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <span>Never leave valuables in plain sight</span>
                    </li>
                </ul>
                <button class="mt-4 w-full bg-blue-600 text-white px-4 py-2 rounded-lg font-medium hover:bg-blue-700 transition-colors">
                    More Safety Tips
                </button>
            </div>

            <!-- Most Stolen Models Banner -->
            <div class="bg-white border border-gray-200 rounded-xl p-6 shadow-sm">
                <div class="flex items-center mb-4">
                    <div class="bg-blue-100 p-2 rounded-full mr-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800">Most Stolen Models</h3>
                </div>
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <span class="text-sm font-medium">Toyota Camry</span>
                        <span class="text-xs bg-blue-100 text-blue-800 px-2 py-1 rounded-full">High Risk</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-sm font-medium">Honda Accord</span>
                        <span class="text-xs bg-blue-100 text-blue-800 px-2 py-1 rounded-full">High Risk</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-sm font-medium">Ford Pickups</span>
                        <span class="text-xs bg-yellow-100 text-yellow-800 px-2 py-1 rounded-full">Medium Risk</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-sm font-medium">Chevrolet Silverado</span>
                        <span class="text-xs bg-yellow-100 text-yellow-800 px-2 py-1 rounded-full">Medium Risk</span>
                    </div>
                </div>
                <button class="mt-4 w-full bg-white border border-blue-500 text-blue-600 px-4 py-2 rounded-lg font-medium hover:bg-blue-50 transition-colors">
                    View Full Report
                </button>
            </div>
        </div>
    </div>
</section>

<script>
function shareVehicle(title, url) {
    if (navigator.share) {
        navigator.share({
            title: title,
            text: `Help locate this stolen vehicle: ${title}`,
            url: url
        });
    } else {
        // Fallback to copying to clipboard
        navigator.clipboard.writeText(url).then(() => {
            alert('Link copied to clipboard!');
        });
    }
}
</script>

<style>
.animate-pulse {
    animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
}

@keyframes pulse {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.5; }
}
</style>