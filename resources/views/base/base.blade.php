<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Essential News')</title>
    @vite('resources/css/app.css')
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>


    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <meta name="csrf-token" content="{{ csrf_token() }}">


</head>

<body >


    {{-- 
    <div id="preloader" class="fixed inset-0 bg-gray-100 flex items-center justify-center z-50">
        <div class="text-center">
            <div class="w-16 h-16 border-4 border-blue-500 border-t-transparent rounded-full animate-spin mx-auto">
            </div>
            <p class="mt-4 text-lg text-gray-700 font-semibold">Loading Essential News...</p>
        </div>
    </div> --}}

    <script>
        window.addEventListener('load', function() {
            document.getElementById('preloader').classList.add('hidden');
        });
    </script>

    <header class="bg-white shadow-md fixed top-0 left-0 right-0 z-50" x-data="{ isOpen: false }">
        <div class="container mx-auto px-4 py-2 flex justify-between items-center">
            <a href="{{ route('welcome') }}" class="inline-block">
                <div class="flex items-center justify-center w-32 h-12 bg-red-600 rounded-lg overflow-hidden shadow-lg">
                    <span class="text-2xl font-bold" style="text-shadow: 1px 1px 2px rgba(0,0,0,0.3);">
                        <span class="text-white">E-</span>
                        <span class="text-blue-900">News</span>
                    </span>
                </div>
            </a>
            <button @click="isOpen = !isOpen" class="md:hidden">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>

            <nav class="hidden md:block">

                <ul class="flex space-x-4">

                    @include('base.nav')
                </ul>
            </nav>
        </div>
        <nav class="md:hidden" x-show="isOpen" @click.away="isOpen = false">
            <ul class="bg-white border-t border-gray-200 py-2">
                <li><a href="#" class="block px-4 py-2 text-blue-600 font-semibold">Home</a></li>
                <li><a href="{{ route('news') }}" class="block px-4 py-2 hover:bg-gray-100">News</a></li>
                <li><a href="{{ route('obituary.listObituaryPosts') }}"
                        class="block px-4 py-2 hover:bg-gray-100">Obituary</a></li>
                <li><a href="{{ route('list.birthday-posts') }}" class="block px-4 py-2 hover:bg-gray-100">Birthday</a>
                </li>
                <li><a href="{{ route('lists-public-notice') }}" class="block px-4 py-2 hover:bg-gray-100">Public
                        Notice</a></li>


                {{-- <li class="relative group">
                    <a href="#" class="hover:text-green-600">Account</a>
                    <div class="absolute hidden bg-white shadow-lg mt-2 rounded-md w-40 group-hover:block">
                        <ul class="flex flex-col">
                            <li><a href="{{ route('user.login') }}"
                                    class="block px-4 py-2 text-gray-700 hover:bg-gray-200">Login</a></li>
                            <li><a href="{{ route('user.register') }}"
                                    class="block px-4 py-2 text-gray-700 hover:bg-gray-200">Register</a></li>
                            <li><a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-200">Profile</a>
                            </li>
                        </ul>
                    </div>
                </li> --}}

                <li class="relative group">
                    <a href="#" class="hover:text-green-600">Account</a>
                    <div class="absolute hidden bg-white shadow-lg mt-2 rounded-md w-40 group-hover:block z-30">
                        <ul class="flex flex-col">
                            @if (session('api_token'))
                                <!-- Check if the user is logged in -->
                                <!-- Check user role and show the appropriate dashboard link -->
                                @php
                                    $userRole = session('user')['role'] ?? ''; // Assuming the role is stored in the 'user' session data
                                @endphp

                                @if ($userRole == 'admin')
                                    <li><a href="{{ route('admin.dashboard') }}"
                                            class="block px-4 py-2 text-gray-700 hover:bg-gray-200">Admin Dashboard</a>
                                    </li>
                                @elseif($userRole == 'editor')
                                    <li><a href="{{ route('editor.dashboard') }}"
                                            class="block px-4 py-2 text-gray-700 hover:bg-gray-200">Editor Dashboard</a>
                                    </li>
                                @else
                                    <li><a href="{{ route('user.dashboard') }}"
                                            class="block px-4 py-2 text-gray-700 hover:bg-gray-200">User Dashboard</a>
                                    </li>
                                @endif

                                <li>
                                    <a href="#"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                                        class="block px-4 py-2 text-gray-700 hover:bg-gray-100 hover:text-green-600 transition-colors duration-200">
                                        Logout
                                    </a>
                                    <form id="logout-form" action="{{ route('user.logout') }}" method="POST"
                                        style="display:none;">
                                        @csrf
                                    </form>
                                </li>
                            @else
                                <li><a href="{{ route('user.login') }}"
                                        class="block px-4 py-2 text-gray-700 hover:bg-gray-200">Login</a></li>
                                <li><a href="{{ route('user.register') }}"
                                        class="block px-4 py-2 text-gray-700 hover:bg-gray-200">Register</a></li>
                            @endif
                        </ul>
                    </div>
                </li>



            </ul>
        </nav>
    </header>
    <div class="exchange-rate fixed top-16 left-0 right-0 z-40">
        

        @include('exchange-rate.exchange-rate')
        

        <br><br><br>

        <div style="margin-top: 20px">
            @include('base.flashnews')
        </div>


        <div class="content py-6">
            @yield('content')
        </div>

        @include('base.widget')
        <footer class="bg-gray-800 text-gray-300">
            <div class="max-w-7xl mx-auto px-4 py-12 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                    <!-- Company Info -->
                    <div>
                        <h3 class="text-white text-lg font-semibold mb-4">Essential Nigeria News</h3>
                        <p class="text-sm">Bringing you the latest and most important news from around the world, 24/7.
                        </p>
                    </div>

                    <!-- Quick Links -->
                    <div>
                        <h4 class="text-white text-lg font-semibold mb-4">Quick Links</h4>
                        <ul class="space-y-2">
                            <li><a href="#" class="hover:text-white transition">Home</a></li>
                            <li><a href="#" class="hover:text-white transition">Politics</a></li>
                            <li><a href="#" class="hover:text-white transition">Technology</a></li>
                            <li><a href="#" class="hover:text-white transition">Sports</a></li>
                            <li><a href="#" class="hover:text-white transition">Entertainment</a></li>
                        </ul>
                    </div>

                    <!-- Support -->
                    <div>
                        <h4 class="text-white text-lg font-semibold mb-4">Support</h4>
                        <ul class="space-y-2">
                            <li><a href="#" class="hover:text-white transition">Contact Us</a></li>
                            <li><a href="#" class="hover:text-white transition">FAQs</a></li>
                            <li><a href="#" class="hover:text-white transition">Advertise</a></li>
                            <li><a href="#" class="hover:text-white transition">Careers</a></li>
                        </ul>
                    </div>

                    <!-- Newsletter Signup -->
                    {{-- <div>
                    <h4 class="text-white text-lg font-semibold mb-4">Stay Updated</h4>
                    <p class="text-sm mb-4">Subscribe to our newsletter for daily news updates.</p>
                    <form class="flex" method="POST" action="{{ route('newsltter.subscribe') }}">
                        @csrf
                        <input type="email" placeholder="Your email" name="email"
                            class="flex-grow px-3 py-2 text-gray-700 bg-white rounded-l-md focus:outline-none"
                            required>
                        <button type="submit"
                            class="bg-blue-500 text-white px-4 py-2 rounded-r-md hover:bg-blue-600 transition">Subscribe</button>
                    </form>
                </div> --}}

                    @include('base.subscribe')

                    <!-- Social Media Links -->
                    <div class="mt-8 pt-8 border-t border-gray-700">
                        <div class="flex justify-center space-x-6">
                            <a href="#" class="text-gray-400 hover:text-white transition">
                                <span class="sr-only">Facebook</span>
                                <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path fill-rule="evenodd"
                                        d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"
                                        clip-rule="evenodd" />
                                </svg>
                            </a>
                            <a href="#" class="text-gray-400 hover:text-white transition">
                                <span class="sr-only">Twitter</span>
                                <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path
                                        d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" />
                                </svg>
                            </a>
                            <a href="#" class="text-gray-400 hover:text-white transition">
                                <span class="sr-only">Instagram</span>
                                <svg class="h-6 w-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path fill-rule="evenodd"
                                        d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 015.45 2.525c.636-.247 1.363-.416 2.427-.465C8.901 2.013 9.256 2 11.685 2h.63zm-.081 1.802h-.468c-2.456 0-2.784.011-3.807.058-.975.045-1.504.207-1.857.344-.467.182-.8.398-1.15.748-.35.35-.566.683-.748 1.15-.137.353-.3.882-.344 1.857-.047 1.023-.058 1.351-.058 3.807v.468c0 2.456.011 2.784.058 3.807.045.975.207 1.504.344 1.857.182.466.399.8.748 1.15.35.35.683.566 1.15.748.353.137.882.3 1.857.344 1.054.048 1.37.058 4.041.058h.08c2.597 0 2.917-.01 3.96-.058.976-.045 1.505-.207 1.858-.344.466-.182.8-.398 1.15-.748.35-.35.566-.683.748-1.15.137-.353.3-.882.344-1.857.048-1.055.058-1.37.058-4.041v-.08c0-2.597-.01-2.917-.058-3.96-.045-.976-.207-1.505-.344-1.858a3.097 3.097 0 00-.748-1.15 3.098 3.098 0 00-1.15-.748c-.353-.137-.882-.3-1.857-.344-1.023-.047-1.351-.058-3.807-.058zM12 6.865a5.135 5.135 0 110 10.27 5.135 5.135 0 010-10.27zm0 1.802a3.333 3.333 0 100 6.666 3.333 3.333 0 000-6.666zm5.338-3.205a1.2 1.2 0 110 2.4 1.2 1.2 0 010-2.4z"
                                        clip-rule="evenodd" />
                                </svg>
                            </a>
                        </div>
                    </div>

                    <!-- Legal -->
                    <div class="mt-8 border-t border-gray-700 pt-8 text-center text-sm">
                        <p>&copy; {{ date('Y') }} Essential Nigeria News. All rights reserved.</p>
                        <div class="mt-2">
                            <a href="#" class="inline-block px-2 hover:text-white transition">Privacy Policy</a>
                            <a href="#" class="inline-block px-2 hover:text-white transition">Terms of
                                Service</a>
                            <a href="#" class="inline-block px-2 hover:text-white transition">Cookie Policy</a>
                        </div>
                    </div>
                </div>

                <!---- VISITOR LOG START-->
                <div class="container mx-auto px-4 py-8">
                    {{-- Password Protection Section --}}
                    <div id="password-section" class="flex justify-center items-center min-h-[calc(100vh-4rem)]">
                        <div class="w-full max-w-md">
                            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                                <div class="p-6">
                                    <h3 class="text-2xl font-bold text-center mb-4">Please Enter the Password</h3>
                                    <div class="mb-4">
                                        <div class="flex">
                                            <input type="password" id="passwordInput"
                                                class="flex-grow px-3 py-2 border border-gray-300 rounded-l-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                                                placeholder="Enter access key">
                                            <button onclick="checkPassword()"
                                                class="px-4 py-2 bg-blue-500 text-white rounded-r-md hover:bg-blue-600 transition duration-300">
                                                Submit
                                            </button>
                                        </div>
                                    </div>
                                    <div id="passwordError" class="text-red-500 text-center hidden">
                                        Incorrect password. Please try again.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Stats Section (Initially Hidden) --}}
                    <div id="stats-section" class="hidden">
                        <h1 class="text-3xl font-bold text-center mb-8">Visitor Statistics Dashboard</h1>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            {{-- Total Visitors Card --}}
                            <div class="bg-white shadow-md rounded-lg p-6 text-center">
                                <div class="text-5xl mb-4 text-blue-500">
                                    <i class="bi bi-people"></i>
                                </div>
                                <h5 class="text-xl font-semibold mb-2">Total Visitors</h5>
                                <h2 id="totalVisitors" class="text-3xl text-blue-600">Loading...</h2>
                            </div>

                            {{-- New Visitors Card --}}
                            <div class="bg-white shadow-md rounded-lg p-6 text-center">
                                <div class="text-5xl mb-4 text-green-500">
                                    <i class="bi bi-person-plus"></i>
                                </div>
                                <h5 class="text-xl font-semibold mb-2">New Visitors</h5>
                                <p class="text-sm text-gray-600 mb-2">A new visitor is someone who hasn't been tracked
                                    before.
                                </p>
                                <h2 id="newVisitors" class="text-3xl text-green-600">Loading...</h2>
                            </div>

                            {{-- Active Visitors Card --}}
                            <div class="bg-white shadow-md rounded-lg p-6 text-center">
                                <div class="text-5xl mb-4 text-indigo-500">
                                    <i class="bi bi-person-check"></i>
                                </div>
                                <h5 class="text-xl font-semibold mb-2">Active Visitors</h5>
                                <p class="text-sm text-gray-600 mb-2">Active visitors are those who have visited the
                                    site
                                    recently.</p>
                                <h2 id="activeVisitors" class="text-3xl text-indigo-600">Loading...</h2>
                            </div>

                            {{-- Returning Visitors Card --}}
                            <div class="bg-white shadow-md rounded-lg p-6 text-center">
                                <div class="text-5xl mb-4 text-yellow-500">
                                    <i class="bi bi-person-check"></i>
                                </div>
                                <h5 class="text-xl font-semibold mb-2">Returning Visitors</h5>
                                <p class="text-sm text-gray-600 mb-2">A returning visitor is one who has previously
                                    visited
                                    the
                                    site, but is coming back.</p>
                                <h2 id="returningVisitors" class="text-3xl text-yellow-600">Loading...</h2>
                            </div>

                            {{-- Daily Visitors Card --}}
                            <div class="bg-white shadow-md rounded-lg p-6 text-center">
                                <div class="text-5xl mb-4 text-gray-500">
                                    <i class="bi bi-person-check"></i>
                                </div>
                                <h5 class="text-xl font-semibold mb-2">Daily Visitors</h5>
                                <p class="text-sm text-gray-600 mb-2">This counts unique visitors who visited the site
                                    today.
                                </p>
                                <h2 id="dailyVisitors" class="text-3xl text-gray-600">Loading...</h2>
                            </div>
                        </div>
                    </div>
                </div>


                <script>
                    // API URL from Laravel environment
                    const apiUrl = '{{ env('API_URL_VISITOR') }}';
                    const apiPassword = '{{ env('VISITOR_STATS_PASSWORD', 'Adewale') }}';

                    // Fetch the stats data from the API
                    function fetchVisitorStats() {
                        fetch(apiUrl, {
                                method: 'POST', // Changed to POST as per the backend route
                                headers: {
                                    'Content-Type': 'application/json',                                   
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                                }
                            })
                            .then(response => {
                                if (!response.ok) {
                                    throw new Error('Network response was not ok');
                                }
                                return response.json();
                            })
                            .then(data => {
                                // Update the stats in the page with the data from the API
                                document.getElementById('totalVisitors').innerText = data.totalVisitors;
                                document.getElementById('newVisitors').innerText = data.newVisitors;
                                document.getElementById('activeVisitors').innerText = data.activeVisitors;
                                document.getElementById('returningVisitors').innerText = data.returningVisitors;
                                document.getElementById('dailyVisitors').innerText = data.dailyVisitors;

                                // Show the stats section after data is loaded
                                document.getElementById('stats-section').classList.remove('hidden');
                            })
                            .catch(error => {
                                console.error('Error fetching visitor stats:', error);
                                // Optional: Show an error message to the user
                                document.getElementById('stats-section').innerHTML = `
                <div class="text-center text-red-500">
                    <p>Unable to load visitor statistics. Please try again later.</p>
                </div>
            `;
                            });
                    }
                    // Password protection check
                    const correctPassword = 'Adewale';

                    function checkPassword() {
                        const passwordInput = document.getElementById('passwordInput');
                        const statsSection = document.getElementById('stats-section');
                        const passwordSection = document.getElementById('password-section');
                        const passwordError = document.getElementById('passwordError');

                        if (passwordInput.value === correctPassword) {
                            statsSection.classList.remove('hidden');
                            passwordSection.classList.add('hidden');
                            passwordError.classList.add('hidden');

                            // Store in session storage so it remains visible on page refresh
                            sessionStorage.setItem('statsAuthenticated', 'true');

                            // Fetch visitor stats after authentication
                            fetchVisitorStats();
                        } else {
                            passwordError.classList.remove('hidden');
                            passwordInput.value = '';
                        }
                    }

                    // Check if already authenticated on page load
                    window.onload = function() {
                        if (sessionStorage.getItem('statsAuthenticated') === 'true') {
                            document.getElementById('stats-section').classList.remove('hidden');
                            document.getElementById('password-section').classList.add('hidden');

                            // Fetch visitor stats after authentication
                            fetchVisitorStats();
                        }
                    }
                </script>



        </footer>

        {{-- <button id="scrollToTop"
            class="fixed bottom-4 right-4 bg-blue-500 text-white p-2 rounded-full shadow-lg hover:bg-blue-600 transition duration-300 transform hover:scale-105 hidden"
            aria-label="Scroll to Top">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M15 12H9m0 0l3-3m-3 3l3 3" />
            </svg>
        </button>

        <script>
            document.getElementById('mobile-menu-button').addEventListener('click', function() {
                document.getElementById('mobile-menu').classList.toggle('active');
            });

            // handling scroll to top
            // Get the button
            const scrollToTopBtn = document.getElementById('scrollToTop');

            // Show the button when the user scrolls down 100px from the top of the document
            window.onscroll = function() {
                if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
                    scrollToTopBtn.classList.remove('hidden');
                } else {
                    scrollToTopBtn.classList.add('hidden');
                }
            };

            // Scroll to the top when the button is clicked
            scrollToTopBtn.onclick = function() {
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            };
        </script>
        <!--Start of Tawk.to Script-->
        <script type="text/javascript">
            var Tawk_API = Tawk_API || {},
                Tawk_LoadStart = new Date();
            (function() {
                var s1 = document.createElement("script"),
                    s0 = document.getElementsByTagName("script")[0];
                s1.async = true;
                s1.src = 'https://embed.tawk.to/667983feeaf3bd8d4d13c9ab/1ifm41hp3';
                s1.charset = 'UTF-8';
                s1.setAttribute('crossorigin', '*');
                s0.parentNode.insertBefore(s1, s0);
            })();
        </script> --}}
        <!--End of Tawk.to Script-->


        @stack('scripts')
</body>

</html>