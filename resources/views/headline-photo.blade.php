<div class="min-h-screen bg-white">
    @if (!empty($image) && isset($image['image_url']))
        <!-- All Content: Header, Image, Posts, Sidebar, Footer -->
        <!-- Newspaper Header -->
        <div class="border-b-4 border-black py-2 px-4">
            <div class="text-center">
                <h1 class="text-2xl sm:text-4xl lg:text-6xl font-bold text-black font-serif tracking-wider">
                    {{-- THE ESSENTIAL NEW <br> --}}
                    <span>essentialnews.ng</span>
                </h1>
                <div class="flex justify-between items-center text-xs sm:text-sm text-gray-700 mt-1">
                    <span>{{ date('l, F j, Y') }}</span>
                    <span class="hidden sm:inline">Vol. 1 • No. 1</span>
                    <span>NGN {{ number_format(rand(100, 299) / 100, 2) }}</span>
                </div>
            </div>
        </div>

        <!-- Main Headline Image -->
        <div class="relative">
            <div class="bg-red-600 text-white text-center py-1 px-4">
                <span class="text-sm sm:text-base font-bold tracking-wide">BREAKING NEWS</span>
            </div>
            
             
            <div class="relative bg-black">
                <img src="{{ $image['image_url'] }}" 
                     alt="Breaking News" 
                     class="w-full h-full sm:h-full lg:h-full object-cover">
            </div>
            {{-- <div class="relative bg-black flex justify-center items-center overflow-hidden">
    <img src="{{ $image['image_url'] }}" 
         alt="Essential Nigeria Breaking News" 
         class="object-contain" />
</div> --}}

        </div>

       

        <!-- Footer -->
        <div class="border-t-4 border-black mt-8 py-2 px-4 bg-gray-50">
            <div class="text-center text-xs text-gray-600">
                <div class="flex justify-center space-x-4">
                    <span>© {{ date('Y') }} The Daily News</span>
                    <span>•</span>
                    <span>All Rights Reserved</span>
                    <span>•</span>
                    <span>Breaking News Coverage</span>
                </div>
            </div>
        </div>

    @else
        <!-- Optional: blank or loading state (or remove this block entirely if you want nothing at all) -->
        {{-- <div class="min-h-screen flex items-center justify-center">
            <p class="text-gray-500 text-lg">Loading or no image available.</p>
        </div> --}}
    @endif
</div>
