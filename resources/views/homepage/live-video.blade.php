<section class="max-w-6xl mx-auto px-4 py-8">
                <div class="bg-gray-200 p-2 mb-4">
                    <h2 class="text-2xl font-bold">Topics</h2>
                </div>

                <div class="flex flex-wrap gap-2 mb-6 overflow-x-auto whitespace-nowrap">
                    @foreach (['Gold Market', 'Nigeria\'s Inflation Rate Eases to 33.40%', 'Adekunle Gold', 'Nigeria and Guinea Strengthen Ties', 'Nigeria\'s Economic Activity Declines Again'] as $topic)
                        <span
                            class="bg-purple-200 text-purple-800 text-xs px-3 py-1 rounded-full">{{ $topic }}</span>
                    @endforeach
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="md:col-span-2">
                        <!-- Video Content Area -->
                        <div class="bg-gradient-to-r from-gray-900 to-black rounded-lg overflow-hidden shadow-lg">
                            <!-- Video Header with Title and Status -->
                            <div
                                class="bg-gradient-to-r from-purple-800 to-blue-800 p-3 flex justify-between items-center">
                                <h3 class="text-white font-bold">
                                    {{ !empty($recentVideo) ? 'Now Playing' : 'Featured Video' }}</h3>
                                <div
                                    class="bg-black bg-opacity-50 text-white px-3 py-1 text-sm rounded-full flex items-center">
                                    <span
                                        class="w-2 h-2 {{ !empty($recentVideo) ? 'bg-green-500' : 'bg-red-500' }} rounded-full mr-2"></span>
                                    {{ !empty($recentVideo) ? 'Live now' : 'No live event at the moment' }}
                                </div>
                            </div>

                            <!-- Video Player Area -->
                            <div class="aspect-w-16 aspect-h-9 relative" style="height: 400px;">
                                @if (!empty($recentVideo))
                                    <div class="absolute inset-0">
                                        <iframe id="youtube-video" class="w-full h-full"
                                            src="{{ $recentVideo['youtube_url'] }}?rel=0&autoplay=0&enablejsapi=1"
                                            title="{{ $recentVideo['title'] }}" frameborder="0"
                                            allow="accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                            allowfullscreen>
                                        </iframe>
                                        <!-- Custom play button overlay -->
                                        <div id="play-button"
                                            class="absolute inset-0 flex items-center justify-center cursor-pointer bg-black bg-opacity-40">
                                            <div
                                                class="text-white bg-red-600 p-3 rounded-full hover:bg-red-700 transition-transform duration-300 transform hover:scale-110">
                                                <svg class="w-12 h-12" fill="currentColor" viewBox="0 0 20 20">
                                                    <path d="M8 5v10l7-5-7-5z" />
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div
                                        class="absolute inset-0 flex flex-col items-center justify-center text-center p-6">
                                        <!-- Play Button -->
                                        <div
                                            class="text-white bg-red-600 p-3 rounded-full cursor-pointer hover:bg-red-700 transition-transform duration-300 transform hover:scale-110 mb-6">
                                            <svg class="w-12 h-12" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M8 5v10l7-5-7-5z" />
                                            </svg>
                                        </div>

                                        <!-- Video Upload Section - Only visible to admins/editors -->
                                        @if (session('api_token'))
                                            @php
                                                $userRole = session('user')['role'] ?? '';
                                            @endphp

                                            @if ($userRole == 'admin' || $userRole == 'editor')
                                                <div class="mt-4 w-full max-w-sm">
                                                    <p class="text-gray-300 mb-3">You're logged in as: <span
                                                            class="font-bold text-white">{{ $userRole }}</span></p>
                                                    <a href="{{ route('youtube-link') }}"
                                                        class="flex items-center justify-center gap-2 bg-gradient-to-r from-orange-500 to-red-600 text-white px-6 py-3 rounded-lg font-bold shadow-md hover:shadow-lg transform hover:-translate-y-1 transition-all duration-300 w-full">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12">
                                                            </path>
                                                        </svg>
                                                        Upload New Video
                                                    </a>
                                                </div>
                                            @else
                                                <div class="text-white mt-4">
                                                    <p>Check back later for upcoming videos and live events.</p>
                                                </div>
                                            @endif
                                        @else
                                            <!-- Message for non-logged in users -->
                                            <div class="text-white mt-4">
                                                <p>Check back later for upcoming videos and live events.</p>
                                            </div>
                                        @endif
                                    </div>
                                @endif
                            </div>

                            <!-- Video Footer with Info -->
                            <div class="bg-gray-800 p-3 text-gray-300 text-sm">
                                @if (!empty($recentVideo))
                                    <p>{{ $recentVideo['title'] }} - {{ $recentVideo['description'] }}</p>
                                @else
                                    <p>Stay tuned for breaking news and live broadcasts</p>
                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- <div class="space-y-4">
                        <div class="bg-red-600 p-4 text-white text-center font-bold">
                            ADVERTISE HERE!
                        </div>
                        <div class="bg-gray-200 p-4 text-center">
                            <p class="font-semibold">ADVERTISE HERE !!</p>
                        </div>
                        <div class="bg-blue-600 p-4 text-white text-center">
                            <p class="font-bold">ADVERTIZE YOUR BUSINESS HERE!</p>
                        </div>
                    </div> --}}

                    <div class="space-y-4">
  <!-- Main Hero Banner -->
  <div class="relative overflow-hidden rounded-xl bg-gradient-to-r from-blue-800 to-purple-900 hover-scale cursor-pointer">
    <div class="absolute inset-0 bg-black bg-opacity-40"></div>
    <div class="relative flex items-center justify-between p-6 text-white">
      <div class="flex-1">
        <h2 class="text-3xl font-bold mb-2">EBNB Hotel Management</h2>
        <p class="text-lg mb-3">Premium Hotel Management Solutions</p>
        <p class="text-sm mb-4">Streamline your hospitality business with professional management services</p>
        <div class="inline-flex items-center bg-white bg-opacity-20 px-4 py-2 rounded-full">
          <span class="text-sm font-semibold">Visit: ebnbhotel.com</span>
        </div>
      </div>
      <div class="ml-6">
        <img src="https://images.unsplash.com/photo-1566073771259-6a8506099945?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=400&q=80" 
             alt="Luxury Hotel" 
             class="w-32 h-24 object-cover rounded-lg shadow-lg">
      </div>
    </div>
  </div>

  <!-- Secondary Banner -->
  <div class="bg-gradient-to-r from-amber-500 to-orange-600 p-4 rounded-lg text-center text-white hover-scale cursor-pointer">
    <p class="font-bold text-xl">🏨 EBNB Hotel Management Services</p>
    <p class="text-sm mt-1">Professional • Reliable • Results-Driven | ebnbhotel.com</p>
  </div>

  {{-- <!-- Compact Banner -->
  <div class="bg-gradient-to-r from-teal-600 to-blue-700 p-4 text-white text-center rounded-lg hover-scale cursor-pointer">
    <div class="flex items-center justify-center space-x-4">
      <img src="https://images.unsplash.com/photo-1520250497591-112f2f40a3f4?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=100&q=80" 
           alt="Hotel Reception" 
           class="w-16 h-12 object-cover rounded">
      <div>
        <p class="font-bold text-lg">Transform Your Hotel Business</p>
        <p class="text-sm">EBNB Hotel Management • ebnbhotel.com</p>
      </div>
    </div>
  </div> --}}
</div>

<style>
  .hover-scale {
    transition: transform 0.3s ease-in-out;
  }
  .hover-scale:hover {
    transform: scale(1.02);
  }
</style>
                </div>
            </section>


             <!-- Add this script at the end of your file, before the closing body tag -->
            @if (!empty($recentVideo))
                <script>
                    document.addEventListener('DOMContentLoaded', function() {
                        const playButton = document.getElementById('play-button');
                        const iframe = document.getElementById('youtube-video');

                        if (playButton && iframe) {
                            playButton.addEventListener('click', function() {
                                // Get the iframe's source
                                const iframeSrc = iframe.src;

                                // Replace autoplay parameter to 1 to start playing
                                iframe.src = iframeSrc.replace('autoplay=0', 'autoplay=1');

                                // Hide the play button
                                playButton.style.display = 'none';
                            });
                        }
                    });
                </script>
            @endif