<div class="container mx-auto px-4 py-8">
    <div class="flex flex-col lg:flex-row gap-8">
        <!-- Main Content (Left Side) -->
        <div class="lg:w-2/3">
            @php
                $sectionsData = [
                    [
                        'title' => 'Missing Persons',
                        'posts' => $missingPosts ?? [],
                        'icon' => '🔍',
                        'color' => 'red',
                        'bgGradient' => 'from-red-500 to-red-600',
                        'emptyMessage' => 'No missing persons cases reported.',
                        'urgencyBadge' => 'URGENT',
                    ],
                    [
                        'title' => 'Wanted Persons',
                        'posts' => $wantedPosts ?? [],
                        'icon' => '⚖️',
                        'color' => 'amber',
                        'bgGradient' => 'from-amber-500 to-orange-600',
                        'emptyMessage' => 'No wanted persons cases reported.',
                        'urgencyBadge' => 'WANTED',
                    ]
                ];
            @endphp

            <div class="space-y-16">
                @foreach($sectionsData as $section)
                    <section class="relative">
                        {{-- Section Header --}}
                        <div class="flex items-center justify-between mb-8">
                            <div class="flex items-center space-x-4">
                                <div class="bg-gradient-to-br {{ $section['bgGradient'] }} p-3 rounded-full shadow-lg">
                                    <span class="text-2xl">{{ $section['icon'] }}</span>
                                </div>
                                <div>
                                    <h2 class="text-3xl font-bold text-gray-800">{{ $section['title'] }}</h2>
                                    <p class="text-gray-600 mt-1">Help us bring them home safely</p>
                                </div>
                            </div>
                            
                            {{-- Statistics Badge --}}
                            <div class="hidden md:flex items-center bg-gray-100 px-4 py-2 rounded-full">
                                <div class="w-2 h-2 bg-{{ $section['color'] }}-500 rounded-full mr-2 animate-pulse"></div>
                                <span class="text-sm font-medium text-gray-700">
                                    {{ count($section['posts']) }} Active Cases
                                </span>
                            </div>
                        </div>

                        {{-- Cards Grid --}}
                        @if(count($section['posts']) > 0)
                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-2 gap-6">
                                @foreach($section['posts'] as $post)
                                    <div class="group bg-white rounded-2xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden border border-gray-100 hover:border-{{ $section['color'] }}-200 transform hover:-translate-y-1">
                                        {{-- Image Container --}}
                                        <div class="relative overflow-hidden">
                                            <img src="{{ $post['featured_image'] ?? '/images/placeholder-person.jpg' }}" 
                                                 alt="{{ $post['title'] }}"
                                                 class="w-full h-56 object-cover group-hover:scale-105 transition-transform duration-300">
                                            
                                            {{-- Urgency Badge --}}
                                            <div class="absolute top-3 left-3">
                                                <span class="bg-gradient-to-r {{ $section['bgGradient'] }} text-white text-xs font-bold px-3 py-1 rounded-full shadow-lg animate-pulse">
                                                    {{ $section['urgencyBadge'] }}
                                                </span>
                                            </div>

                                            {{-- Time Badge --}}
                                            @if(isset($post['created_at']))
                                                <div class="absolute top-3 right-3">
                                                    <span class="bg-black/70 backdrop-blur-sm text-white text-xs px-2 py-1 rounded-full">
                                                        {{ \Carbon\Carbon::parse($post['created_at'])->diffForHumans() }}
                                                    </span>
                                                </div>
                                            @endif
                                        </div>

                                        {{-- Content --}}
                                        <div class="p-5">
                                            <h3 class="text-lg font-bold text-gray-800 mb-3 line-clamp-2 group-hover:text-{{ $section['color'] }}-600 transition-colors">
                                                {{ $post['title'] }}
                                            </h3>

                                            {{-- Person Details Grid --}}
                                            <div class="grid grid-cols-2 gap-3 mb-4">
                                                @php
                                                    $details = [
                                                        ['label' => 'Age', 'value' => ($post['age'] ?? 'Unknown') . ' years', 'icon' => '👤'],
                                                        ['label' => 'Gender', 'value' => ucfirst($post['gender'] ?? 'Unknown'), 'icon' => '⚥'],
                                                        ['label' => 'Height', 'value' => ($post['height'] ?? 'Unknown') . ' ft', 'icon' => '📏'],
                                                        ['label' => 'Skin', 'value' => ucfirst($post['skin_color'] ?? 'Unknown'), 'icon' => '🎨'],
                                                    ];
                                                @endphp

                                                @foreach($details as $detail)
                                                    <div class="bg-gray-50 rounded-lg p-2">
                                                        <div class="flex items-center space-x-1 mb-1">
                                                            <span class="text-xs">{{ $detail['icon'] }}</span>
                                                            <span class="text-xs font-medium text-gray-500">{{ $detail['label'] }}</span>
                                                        </div>
                                                        <span class="text-sm font-semibold text-gray-800">{{ $detail['value'] }}</span>
                                                    </div>
                                                @endforeach
                                            </div>

                                            {{-- Contact Info --}}
                                            @if(isset($post['phone_number']) && $post['phone_number'])
                                                <div class="bg-blue-50 border border-blue-200 rounded-lg p-3 mb-4">
                                                    <div class="flex items-center space-x-2">
                                                        <span class="text-blue-600">📞</span>
                                                        <span class="text-sm font-medium text-blue-800">Contact:</span>
                                                    </div>
                                                    <a href="tel:{{ $post['phone_number'] }}" 
                                                       class="text-sm font-semibold text-blue-600 hover:text-blue-800 transition-colors">
                                                        {{ $post['phone_number'] }}
                                                    </a>
                                                </div>
                                            @endif

                                            {{-- Action Buttons --}}
                                            <div class="flex space-x-2 pt-2">
                                                <a href="{{ route('missing-wanted.details', $post['slug'] ?? '#') }}"
                                                   class="flex-1 bg-gradient-to-r {{ $section['bgGradient'] }} text-white text-center px-4 py-2.5 rounded-lg text-sm font-semibold hover:shadow-lg transition-all duration-300 transform hover:scale-105">
                                                    View Details
                                                </a>
                                                <button onclick="shareCase('{{ $post['title'] }}', '{{ route('missing-wanted.details', $post['slug'] ?? '#') }}')"
                                                        class="bg-gray-100 hover:bg-gray-200 text-gray-700 p-2.5 rounded-lg transition-colors">
                                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                        <path d="M15 8a3 3 0 10-2.977-2.63l-4.94 2.47a3 3 0 100 4.319l4.94 2.47a3 3 0 10.895-1.789l-4.94-2.47a3.027 3.027 0 000-.74l4.94-2.47C13.456 7.68 14.19 8 15 8z"/>
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            {{-- Load More Button --}}
                            @if(count($section['posts']) >= 8)
                                <div class="text-center mt-8">
                                    <button class="bg-white border-2 border-{{ $section['color'] }}-500 text-{{ $section['color'] }}-600 px-8 py-3 rounded-full font-semibold hover:bg-{{ $section['color'] }}-500 hover:text-white transition-all duration-300">
                                        Load More Cases
                                    </button>
                                </div>
                            @endif
                        @else
                            {{-- Empty State --}}
                            <div class="text-center py-16">
                                <div class="bg-gray-100 rounded-full w-24 h-24 flex items-center justify-center mx-auto mb-6">
                                    <span class="text-4xl text-gray-400">{{ $section['icon'] }}</span>
                                </div>
                                <h3 class="text-lg font-semibold text-gray-600 mb-2">{{ $section['emptyMessage'] }}</h3>
                                <p class="text-gray-500 max-w-md mx-auto">
                                    We're grateful there are currently no active cases. Check back regularly for updates.
                                </p>
                            </div>
                        @endif
                    </section>
                @endforeach
            </div>

            {{-- Emergency Contact Banner --}}
            <div class="mt-12 bg-gradient-to-r from-blue-600 via-purple-600 to-indigo-700 rounded-2xl p-8 text-white relative overflow-hidden">
                <div class="absolute inset-0 bg-black/10"></div>
                <div class="relative z-10">
                    <div class="flex flex-col md:flex-row items-center justify-between">
                        <div class="mb-4 md:mb-0">
                            <h3 class="text-2xl font-bold mb-2">Emergency Information</h3>
                            <p class="text-blue-100">If you have any information about these cases, please contact us immediately.</p>
                        </div>
                        <div class="flex flex-col sm:flex-row space-y-2 sm:space-y-0 sm:space-x-4">
                            <a href="tel:911" class="bg-red-500 hover:bg-red-600 px-6 py-3 rounded-lg font-semibold text-center transition-colors">
                                🚨 Emergency: 911
                            </a>
                            <a href="tel:+1234567890" class="bg-white/20 hover:bg-white/30 px-6 py-3 rounded-lg font-semibold text-center transition-colors backdrop-blur-sm">
                                📞 Tip Line: (234) 7000 555666
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Sidebar (Banners) -->
        <div class="lg:w-1/3 space-y-6">
            <!-- Safety Tips Banner -->
            <div class="bg-gradient-to-br from-blue-500 to-blue-700 rounded-2xl p-6 text-white shadow-lg">
                <div class="flex items-center mb-4">
                    <div class="bg-white/20 p-2 rounded-full mr-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold">Safety Tips</h3>
                </div>
                <ul class="space-y-3">
                    <li class="flex items-start">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-200 mr-2 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <span>Always be aware of your surroundings</span>
                    </li>
                    <li class="flex items-start">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-200 mr-2 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <span>Report suspicious activity to authorities</span>
                    </li>
                    <li class="flex items-start">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-200 mr-2 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <span>Don't approach wanted individuals yourself</span>
                    </li>
                    <li class="flex items-start">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-200 mr-2 mt-0.5 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                        </svg>
                        <span>Keep emergency numbers saved in your phone</span>
                    </li>
                </ul>
            </div>

            <!-- Most Wanted Banner -->
            <div class="bg-gradient-to-br from-red-500 to-red-700 rounded-2xl p-6 text-white shadow-lg">
                <div class="flex items-center mb-4">
                    <div class="bg-white/20 p-2 rounded-full mr-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold">Most Wanted</h3>
                </div>
                @if(count($wantedPosts ?? []) > 0)
                    @php $mostWanted = $wantedPosts[0]; @endphp
                    <div class="bg-white/10 rounded-xl p-4 mb-4">
                        <div class="flex items-center space-x-4">
                            <img src="{{ $mostWanted['featured_image'] ?? '/images/placeholder-person.jpg' }}" 
                                 alt="{{ $mostWanted['title'] }}"
                                 class="w-16 h-16 object-cover rounded-full border-2 border-white">
                            <div>
                                <h4 class="font-bold">{{ $mostWanted['title'] }}</h4>
                                <p class="text-sm text-red-100">{{ $mostWanted['crime_type'] ?? 'Wanted for questioning' }}</p>
                            </div>
                        </div>
                    </div>
                    <p class="text-sm mb-4">{{ Str::limit($mostWanted['meta_description'] ?? 'Considered armed and dangerous. Do not approach.', 120) }}</p>
                    <a href="{{ route('missing-wanted.details', $mostWanted['slug'] ?? '#') }}"
                       class="block text-center bg-white text-red-600 px-4 py-2 rounded-lg font-semibold hover:bg-gray-100 transition">
                        View Details
                    </a>
                @else
                    <div class="text-center py-6">
                        <p class="text-red-100">No current most wanted cases</p>
                    </div>
                @endif
            </div>

            <!-- Reward Banner -->
            <div class="bg-gradient-to-br from-amber-500 to-amber-700 rounded-2xl p-6 text-white shadow-lg">
                <div class="flex items-center mb-4">
                    <div class="bg-white/20 p-2 rounded-full mr-3">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4H5z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold">Rewards</h3>
                </div>
                <p class="mb-4">Substantial rewards may be available for information leading to the resolution of these cases.</p>
                <div class="bg-white/10 rounded-xl p-4 text-center">
                    <p class="text-sm mb-1">UP TO</p>
                    <p class="text-3xl font-bold">500K</p>
                    <p class="text-sm mt-1">FOR CRITICAL INFORMATION</p>
                </div>
                <button class="mt-4 w-full bg-white/20 hover:bg-white/30 px-4 py-2 rounded-lg font-semibold transition backdrop-blur-sm">
                    Learn About Rewards
                </button>
            </div>
        </div>
    </div>
</div>

<script>
function shareCase(title, url) {
    if (navigator.share) {
        navigator.share({
            title: title,
            text: `Help us find ${title}`,
            url: url
        });
    } else {
        // Fallback to copying to clipboard
        navigator.clipboard.writeText(url).then(() => {
            // You could show a toast notification here
            alert('Link copied to clipboard!');
        });
    }
}
</script>

<style>
@media (max-width: 640px) {
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
}

/* Custom animations */
@keyframes pulse {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.5; }
}

.animate-pulse {
    animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
}
</style>