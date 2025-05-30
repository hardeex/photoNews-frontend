
            <section class="max-w-7xl mx-auto px-4 py-8 sm:px-6 lg:px-8">
                {{-- Header Section --}}
                <div class="bg-green-500 p-2 mb-4">
                    <h2 class="text-2xl font-bold text-white">Misplaced Items &amp; Documents</h2>
                </div>

                {{-- Main Content Container --}}
                <div class="container mx-auto">
                    {{-- Grid of Lost and Found Posts --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                        @forelse ($lostAndFoundPostData['lostAndFoundPostsData'] as $post)
                            <div
                                class="bg-white rounded-lg shadow-lg overflow-hidden transform transition duration-300 hover:scale-105 hover:shadow-xl">
                                {{-- Post Image --}}
                                <a href="{{ route('misplaced.details', $post['slug'] ?? '#') }}" class="block">
                                    <div class="relative">
                                        <img src="{{ $post['featured_image'] }}" alt="{{ $post['title'] }}"
                                            class="w-full h-48 object-cover transition duration-300 transform hover:opacity-75">
                                        <div class="absolute bottom-0 left-0 right-0 bg-black bg-opacity-50 p-2">
                                            <h3 class="text-white text-lg font-semibold truncate">
                                                {{ $post['title'] }}
                                            </h3>
                                        </div>
                                    </div>
                                </a>


                                {{-- Post Details --}}
                                <div class="p-4">
                                    {{-- Meta Description --}}
                                    <p class="text-gray-600 text-sm mb-3 line-clamp-2">
                                        {{ $post['meta_description'] }}
                                    </p>

                                    {{-- Contact Information --}}
                                    <div class="flex items-center mb-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-500 mr-2"
                                            viewBox="0 0 20 20" fill="currentColor">
                                            <path
                                                d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z" />
                                        </svg>
                                        <a href="tel:{{ $post['phone_number'] }}"
                                            class="text-blue-600 hover:text-blue-800 text-sm">
                                            {{ $post['phone_number'] }}
                                        </a>
                                    </div>

                                    {{-- Post Date --}}
                                    <div class="text-xs text-gray-500 flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-gray-400"
                                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        Posted on: {{ \Carbon\Carbon::parse($post['created_at'])->format('F j, Y') }}
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-span-full text-center py-10">
                                <p class="text-gray-500 text-xl">No lost and found items at the moment.</p>
                            </div>
                        @endforelse
                    </div>

                    {{-- Pagination Section --}}
                    @if (
                        !empty($lostAndFoundPostData['pagination']) &&
                            $lostAndFoundPostData['pagination']['total'] > $lostAndFoundPostData['pagination']['per_page']
                    )
                        <div class="mt-8 flex flex-col sm:flex-row justify-between items-center space-y-4 sm:space-y-0">
                            {{-- Page Info --}}
                            <span class="text-sm text-gray-600">
                                Page {{ $lostAndFoundPostData['pagination']['current_page'] }}
                                of {{ $lostAndFoundPostData['pagination']['last_page'] }}
                            </span>

                            {{-- Navigation Buttons --}}
                            <div class="flex space-x-4">
                                @if ($lostAndFoundPostData['pagination']['prev_page_url'])
                                    <a href="{{ $lostAndFoundPostData['pagination']['prev_page_url'] }}"
                                        class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition duration-300 flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20"
                                            fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        Previous
                                    </a>
                                @endif

                                @if ($lostAndFoundPostData['pagination']['next_page_url'])
                                    <a href="{{ $lostAndFoundPostData['pagination']['next_page_url'] }}"
                                        class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition duration-300 flex items-center">
                                        Next
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" viewBox="0 0 20 20"
                                            fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </a>
                                @endif
                            </div>
                        </div>
                    @endif
                </div>

                {{-- See More Button --}}
                <div class="text-center">
                    <a href="#"
                        class="bg-purple-600 text-white px-6 py-2 rounded-full inline-block hover:bg-purple-700 transition duration-300">See
                        more</a>
                </div>
            </section>

         <section class="w-full">
  <div class="relative w-full h-full bg-gradient-to-r from-pink-500 via-purple-600 to-indigo-700 overflow-hidden">
    <!-- Animated Background Elements -->
    <div class="absolute inset-0 opacity-20">
      <div class="absolute top-8 left-16 w-6 h-6 bg-yellow-300 rounded-full animate-pulse"></div>
      <div class="absolute top-20 right-24 w-4 h-4 bg-white rounded-full animate-pulse delay-300"></div>
      <div class="absolute bottom-12 left-32 w-8 h-8 bg-pink-300 rounded-full animate-pulse delay-700"></div>
      <div class="absolute bottom-20 right-16 w-5 h-5 bg-yellow-400 rounded-full animate-pulse delay-500"></div>
    </div>
    
    <!-- Confetti Pattern -->
    <div class="absolute inset-0 opacity-30">
      <div class="absolute top-6 left-20 w-3 h-8 bg-yellow-400 transform rotate-45"></div>
      <div class="absolute top-16 right-32 w-3 h-8 bg-pink-400 transform -rotate-45"></div>
      <div class="absolute bottom-16 left-40 w-3 h-8 bg-blue-400 transform rotate-12"></div>
      <div class="absolute bottom-8 right-20 w-3 h-8 bg-green-400 transform -rotate-12"></div>
    </div>
    
    <!-- Main Content -->
    <div class="relative flex items-center justify-between h-full px-8">
      <!-- Left Side - Text Content -->
      <div class="flex-1 text-white">
        <div class="mb-4">
          <h1 class="text-5xl font-bold mb-2 text-transparent bg-clip-text bg-gradient-to-r from-yellow-300 to-pink-300">
            Evenue
          </h1>
          <p class="text-2xl font-semibold text-yellow-200">Your Event, Our Expertise</p>
        </div>
        
        <div class="mb-6">
          <p class="text-lg mb-2">✨ Wedding Planning • Corporate Events • Private Parties</p>
          <p class="text-lg mb-2">🎪 Venue Booking • Catering • Entertainment</p>
          <p class="text-lg">🎯 Professional Event Management Made Simple</p>
        </div>
        
        <div class="flex items-center space-x-4">
          <div class="bg-white bg-opacity-20 px-6 py-3 rounded-full backdrop-blur-sm">
            <span class="text-xl font-bold">evenue.ng</span>
          </div>
          <div class="bg-gradient-to-r from-yellow-400 to-pink-400 text-black px-6 py-3 rounded-full">
            <span class="font-bold">Plan Your Event!</span>
          </div>
        </div>
      </div>
      
      <!-- Right Side - Event Visual -->
      <div class="ml-8 flex flex-col items-center">
        <div class="relative">
          <!-- Event Categories Display -->
          <div class="bg-white bg-opacity-20 p-6 rounded-3xl backdrop-blur-sm border border-white border-opacity-30">
            <div class="text-center mb-4">
              <div class="text-4xl mb-2">🎉</div>
              <p class="text-sm font-bold text-yellow-200">Event Categories</p>
            </div>
            
            <div class="grid grid-cols-2 gap-3 mb-4">
              <div class="bg-gradient-to-br from-pink-400 to-purple-500 p-3 rounded-xl text-center">
                <div class="text-2xl mb-1">💒</div>
                <p class="text-xs font-semibold">Weddings</p>
              </div>
              <div class="bg-gradient-to-br from-blue-400 to-indigo-500 p-3 rounded-xl text-center">
                <div class="text-2xl mb-1">🏢</div>
                <p class="text-xs font-semibold">Corporate</p>
              </div>
              <div class="bg-gradient-to-br from-green-400 to-teal-500 p-3 rounded-xl text-center">
                <div class="text-2xl mb-1">🎂</div>
                <p class="text-xs font-semibold">Birthdays</p>
              </div>
              <div class="bg-gradient-to-br from-yellow-400 to-orange-500 p-3 rounded-xl text-center">
                <div class="text-2xl mb-1">🎊</div>
                <p class="text-xs font-semibold">Parties</p>
              </div>
            </div>
            
            <!-- Success Indicator -->
            <div class="text-center">
              <div class="inline-flex items-center bg-green-500 bg-opacity-80 px-3 py-1 rounded-full">
                <span class="text-xs font-bold">1000+ Events Managed</span>
              </div>
            </div>
          </div>
        </div>
        
        <!-- Floating Action -->
        <div class="mt-4 animate-bounce">
          <div class="bg-yellow-400 text-black px-4 py-2 rounded-full text-sm font-bold">
            Start Planning 🚀
          </div>
        </div>
      </div>
    </div>
    
    <!-- Bottom Celebration Line -->
    <div class="absolute bottom-0 left-0 right-0 h-3 bg-gradient-to-r from-pink-400 via-yellow-400 via-green-400 to-blue-400"></div>
  </div>
</section>

<style>
  @keyframes bounce {
    0%, 20%, 53%, 80%, 100% {
      transform: translateY(0);
    }
    40%, 43% {
      transform: translateY(-10px);
    }
    70% {
      transform: translateY(-5px);
    }
  }
  .animate-bounce {
    animation: bounce 2s infinite;
  }
  
  @keyframes pulse {
    0%, 100% {
      opacity: 1;
    }
    50% {
      opacity: 0.5;
    }
  }
  .animate-pulse {
    animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
  }
  
  .delay-300 {
    animation-delay: 300ms;
  }
  .delay-500 {
    animation-delay: 500ms;
  }
  .delay-700 {
    animation-delay: 700ms;
  }
</style>
