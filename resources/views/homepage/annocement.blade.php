
            <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

<section class="bg-gray-100 py-8 overflow-hidden">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-2xl sm:text-3xl font-bold mb-6 text-gray-800">Announcements</h2>

        <div class="relative">
            <div class="flex overflow-x-hidden" id="scrollingAnnouncements" role="region" aria-label="Announcements carousel">
                <!-- Announcement items -->
                <div class="flex-none w-60 sm:w-64 mx-2">
                    <div class="bg-white rounded-lg shadow-md p-4 text-center transition-transform duration-300 hover:scale-105">
                        <div class="w-20 h-20 sm:w-24 sm:h-24 mx-auto mb-4 bg-yellow-500 rounded-full"></div>
                        <h3 class="text-base sm:text-lg font-semibold text-gray-800">Important Notice</h3>
                        <p class="text-xs sm:text-sm text-gray-600 mt-2">Annual General Meeting</p>
                    </div>
                </div>
                <div class="flex-none w-60 sm:w-64 mx-2">
                    <div class="bg-white rounded-lg shadow-md p-4 text-center transition-transform duration-300 hover:scale-105">
                        <div class="w-20 h-20 sm:w-24 sm:h-24 mx-auto mb-4 bg-blue-500 rounded-full"></div>
                        <h3 class="text-base sm:text-lg font-semibold text-gray-800">Event Update</h3>
                        <p class="text-xs sm:text-sm text-gray-600 mt-2">Annual General Meeting</p>
                    </div>
                </div>
                <div class="flex-none w-60 sm:w-64 mx-2">
                    <div class="bg-white rounded-lg shadow-md p-4 text-center transition-transform duration-300 hover:scale-105">
                        <div class="w-20 h-20 sm:w-24 sm:h-24 mx-auto mb-4 bg-green-500 rounded-full"></div>
                        <h3 class="text-base sm:text-lg font-semibold text-gray-800">Community News</h3>
                        <p class="text-xs sm:text-sm text-gray-600 mt-2">Annual General Meeting</p>
                    </div>
                </div>
                <div class="flex-none w-60 sm:w-64 mx-2">
                    <div class="bg-white rounded-lg shadow-md p-4 text-center transition-transform duration-300 hover:scale-105">
                        <div class="w-20 h-20 sm:w-24 sm:h-24 mx-auto mb-4 bg-red-500 rounded-full"></div>
                        <h3 class="text-base sm:text-lg font-semibold text-gray-800">Upcoming Events</h3>
                        <p class="text-xs sm:text-sm text-gray-600 mt-2">Annual General Meeting</p>
                    </div>
                </div>
            </div>
            <!-- Navigation buttons -->
            <button class="absolute top-1/2 left-0 transform -translate-y-1/2 bg-gray-800 text-white p-2 rounded-full hidden sm:block" onclick="scrollCarousel(-1)">
                <i class="fas fa-chevron-left"></i>
            </button>
            <button class="absolute top-1/2 right-0 transform -translate-y-1/2 bg-gray-800 text-white p-2 rounded-full hidden sm:block" onclick="scrollCarousel(1)">
                <i class="fas fa-chevron-right"></i>
            </button>
        </div>

        <div class="mt-8 bg-red-600 text-white py-4 px-6 rounded-lg text-center">
            <p class="text-lg sm:text-xl font-semibold">Stay informed with our latest updates!</p>
        </div>
    </div>

    <style>
        #scrollingAnnouncements {
            animation: scroll 30s linear infinite;
        }
        #scrollingAnnouncements:hover {
            animation-play-state: paused;
        }
        @keyframes scroll {
            0% { transform: translateX(0); }
            100% { transform: translateX(-50%); }
        }
        @media (max-width: 640px) {
            #scrollingAnnouncements {
                animation-duration: 40s;
            }
        }
    </style>

    <script>
        function scrollCarousel(direction) {
            const container = document.getElementById('scrollingAnnouncements');
            const scrollAmount = 256; // Width of one item (w-64 = 256px)
            container.scrollBy({ left: direction * scrollAmount, behavior: 'smooth' });
        }
    </script>