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

    

</head>

<body>



    <div id="preloader" class="fixed inset-0 bg-gray-100 flex items-center justify-center z-50">
        <div class="text-center">
            <div class="w-16 h-16 border-4 border-blue-500 border-t-transparent rounded-full animate-spin mx-auto"></div>
            <p class="mt-4 text-lg text-gray-700 font-semibold">Loading Essential News...</p>
        </div>
    </div>

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
                    <li><a href="#" class="text-blue-600 font-semibold">Home</a></li>
                    <li><a href="{{ route('news') }}" class="hover:text-blue-600">News</a></li>
                    <li><a href="#"class="hover:text-blue-600">Birthday</a></li>
                    <li><a href="#" class="hover:text-blue-600">Naming Ceremony</a></li>
                    <li><a href="#"class="hover:text-blue-600">Obituary</a></li>
                    <li><a href="#" class="hover:text-blue-600">History</a></li>
                    <li><a href="#" class="hover:text-blue-600">Marketplace</a></li>
                    {{-- <li class="relative group">
                        <a href="#" class="hover:text-green-600">Account</a>
                        <div class="absolute hidden bg-white shadow-lg mt-2 rounded-md w-40 group-hover:block">
                            <ul class="flex flex-col">
                                <li><a href="{{ route('user.login') }}"
                                        class="block px-4 py-2 text-gray-700 hover:bg-gray-200">Login</a></li>
                                <li><a href="{{ route('user.register') }}"
                                        class="block px-4 py-2 text-gray-700 hover:bg-gray-200">Register</a></li>
                                <li><a href="#"
                                        class="block px-4 py-2 text-gray-700 hover:bg-gray-200">Profile</a></li>
                            </ul>
                        </div>
                    </li> --}}

                    <li class="relative">
                        <button onclick="toggleDropdown('accountDropdown')"
                            class="flex items-center hover:text-green-600 focus:outline-none" aria-expanded="false"
                            aria-haspopup="true">
                            Account
                            <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                        <div id="accountDropdown"
                            class="absolute hidden bg-white shadow-lg mt-2 rounded-md w-40 z-50 transition-all duration-200 ease-in-out"
                            aria-label="Account dropdown">
                            <ul class="flex flex-col py-1">
                                <li>
                                    <a href="{{ route('user.login') }}"
                                        class="block px-4 py-2 text-gray-700 hover:bg-gray-100 hover:text-green-600 transition-colors duration-200">
                                        Login
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('user.register') }}"
                                        class="block px-4 py-2 text-gray-700 hover:bg-gray-100 hover:text-green-600 transition-colors duration-200">
                                        Register
                                    </a>
                                </li>
                                <li>
                                    <a href="#"
                                        class="block px-4 py-2 text-gray-700 hover:bg-gray-100 hover:text-green-600 transition-colors duration-200">
                                        Profile
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>

                    <script>
                        // Add this to your JavaScript
                        function toggleDropdown(dropdownId) {
                            const dropdown = document.getElementById(dropdownId);
                            const button = dropdown.previousElementSibling;
                            const isExpanded = button.getAttribute('aria-expanded') === 'true';

                            // Close all other dropdowns first
                            document.querySelectorAll('[id$="Dropdown"]').forEach(d => {
                                if (d.id !== dropdownId) {
                                    d.classList.add('hidden');
                                    const btn = d.previousElementSibling;
                                    btn.setAttribute('aria-expanded', 'false');
                                }
                            });

                            // Toggle current dropdown
                            dropdown.classList.toggle('hidden');
                            button.setAttribute('aria-expanded', !isExpanded);
                        }

                        // Close dropdown when clicking outside
                        document.addEventListener('click', function(event) {
                            const dropdowns = document.querySelectorAll('[id$="Dropdown"]');
                            dropdowns.forEach(dropdown => {
                                const button = dropdown.previousElementSibling;
                                if (!dropdown.contains(event.target) && !button.contains(event.target)) {
                                    dropdown.classList.add('hidden');
                                    button.setAttribute('aria-expanded', 'false');
                                }
                            });
                        });

                        // Close dropdown when pressing Escape key
                        document.addEventListener('keydown', function(event) {
                            if (event.key === 'Escape') {
                                const dropdowns = document.querySelectorAll('[id$="Dropdown"]');
                                dropdowns.forEach(dropdown => {
                                    const button = dropdown.previousElementSibling;
                                    dropdown.classList.add('hidden');
                                    button.setAttribute('aria-expanded', 'false');
                                });
                            }
                        });
                    </script>

                </ul>
            </nav>
        </div>
        <nav class="md:hidden" x-show="isOpen" @click.away="isOpen = false">
            <ul class="bg-white border-t border-gray-200 py-2">
                <li><a href="#" class="block px-4 py-2 text-blue-600 font-semibold">Home</a></li>
                <li><a href="{{ route('news') }}" class="block px-4 py-2 hover:bg-gray-100">News</a></li>
                <li><a href="#" class="block px-4 py-2 hover:bg-gray-100">Obituary</a></li>
                <li><a href="#" class="block px-4 py-2 hover:bg-gray-100">History</a></li>
                <li><a href="#" class="block px-4 py-2 hover:bg-gray-100">Marketplace</a></li>

                <li class="relative group">
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
                </li>

                <!-- Language Selection -->
                <select class="border rounded-md p-2 text-gray-700 ml-6">
                    <option value="en">English</option>
                    <option value="fr">French</option>
                    <option value="es">Spanish</option>
                </select>
            </ul>
        </nav>
    </header>
    <div class="exchange-rate fixed top-16 left-0 right-0 z-40">
        <!-- Exchange Rate Ticker Component -->
        <div class="relative overflow-hidden">
            <marquee onmouseover="stop()" onmouseout="start()" scrollamount="10" class="marquee"
                style="display: flex; background-color:rgba(0,0,0,0.9); padding: 5px">
                <ul
                    style="
          width: 100%;
          list-style: none;
          display: flex;
          justify-content: center;
          align-items: center;
          gap: 30px;
        ">
                    <!-- -------------------------------- -->
                    <li
                        style="
            font-size: 12px;
            list-style: none;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 2px;
            border-right: 1px solid #ffffffdc;
            padding-right: 10px;
          ">
                        <img src="countries/GB.png" width="20px" alt="" />&nbsp;<span
                            style="color: #ffffff">EUR</span>
                        <span style="color: #21ca07">1.00</span>
                        &nbsp;
                        <img src="countries/NG.png" width="20px" alt="" />&nbsp;<span
                            style="color: #ffffff">NGN</span>
                        <span style="color: #ff0303">650.00</span> <!-- Static data for GBP to NGN rate -->
                    </li>
                    <!-- -------------------------------- -->
                    <li
                        style="
            font-size: 12px;
            list-style: none;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 2px;
            border-right: 1px solid #ffffffdc;
            padding-right: 10px;
          ">
                        <img src="countries/EUR.png" width="20px" alt="" />&nbsp;<span
                            style="color: #ffffff">GDP</span>
                        <span style="color: #21ca07">1.00</span>
                        &nbsp;
                        <img src="countries/NG.png" width="20px" alt="" />&nbsp;<span
                            style="color: #ffffff">NGN</span>
                        <span style="color: #ff0303">750.00</span> <!-- Static data for EUR to NGN rate -->
                    </li>
                    <!-- -------------------------------- -->
                    <li
                        style="
            font-size: 12px;
            list-style: none;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 2px;
            border-right: 1px solid #ffffffdc;
            padding-right: 10px;
          ">
                        <img src="countries/USA.png" width="20px" alt="" />&nbsp;<span
                            style="color: #ffffff">USA</span>
                        <span style="color: #21ca07">1.00</span>
                        &nbsp;
                        <img src="countries/NG.png" width="20px" alt="" />&nbsp;<span
                            style="color: #ffffff">NGN</span>
                        <span style="color: lightgreen;">880.00</span> <!-- Static data for USD to NGN rate -->
                    </li>
                    <!-- -------------------------------- -->
                    <li
                        style="
            font-size: 12px;
            list-style: none;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 2px;
            border-right: 1px solid #ffffffdc;
            padding-right: 10px;
          ">
                        <img src="countries/SA.png" width="20px" alt="" />&nbsp;<span
                            style="color: #ffffff">SA</span>
                        <span style="color: #21ca07">1.00</span>
                        &nbsp;
                        <img src="countries/NG.png" width="20px" alt="" />&nbsp;<span
                            style="color: #ffffff">NGN</span>
                        <span style="color: #ff0303">235.00</span> <!-- Static data for SAR to NGN rate -->
                    </li>
                    <!-- -------------------------------- -->
                    <li
                        style="
            font-size: 12px;
            list-style: none;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 2px;
            border-right: 1px solid #ffffffdc;
            padding-right: 10px;
          ">
                        <img src="countries/JPN.png" width="20px" alt="" />&nbsp;<span
                            style="color: #ffffff">JPN</span>
                        <span style="color: #21ca07">1.00</span>
                        &nbsp;
                        <img src="countries/NG.png" width="20px" alt="" />&nbsp;<span
                            style="color: #ffffff">NGN</span>
                        <span style="color: #ff0303">930.00</span> <!-- Static data for JPY to NGN rate -->
                    </li>
                    <!-- -------------------------------- -->
                    <li
                        style="
            font-size: 12px;
            list-style: none;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 2px;
            border-right: 1px solid #ffffffdc;
            padding-right: 10px;
          ">
                        <img src="countries/GH.png" width="20px" alt="" />&nbsp;<span
                            style="color: #ffffff">GHN</span>
                        <span style="color: #21ca07">1.00</span>
                        &nbsp;
                        <img src="countries/NG.png" width="20px" alt="" />&nbsp;<span
                            style="color: #ffffff">NGN</span>
                        <span style="color: #ff0303">125.00</span> <!-- Static data for GHS to NGN rate -->
                    </li>
                </ul>
            </marquee>
        </div>

        <style>
            @keyframes ticker {
                0% {
                    transform: translateX(0);
                }

                100% {
                    transform: translateX(-50%);
                }
            }

            .animate-ticker {
                animation: ticker 30s linear infinite;
            }
        </style>
    </div> <br><br><br>

    <div class="content py-6">
        @yield('content')
    </div>

    <div id="whatsapp-widget" class="fixed bottom-8 left-8 z-50">
        <!-- Toggle Button -->
        <button onclick="toggleWidget()"
            class="absolute -top-12 left-0 px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-800 rounded-t-lg shadow-md transition-colors duration-300 flex items-center gap-2">
            <span id="toggle-text">Hide Contact</span>
        </button>

        <!-- Your existing widget content -->
        <div id="widget-content" class="bg-white rounded-lg shadow-lg p-6 max-w-sm">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Contact Us via WhatsApp</h2>
            {{-- Sales Button --}}
            <a href="https://wa.me/2348127025378?text=Hello%2C%20I%20need%20sales%20support" target="_blank"
                class="group flex items-center gap-2 mb-3 px-6 py-3 bg-[#25D366] hover:bg-[#128C7E] text-white rounded-full transition-colors duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                    <path
                        d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z" />
                </svg>
                <span class="font-medium">Chat with Sales</span>
            </a>
            {{-- Support Button --}}
            <a href="https://wa.me/2348148413982?text=Hello%2C%20I%20need%20support%20assistance" target="_blank"
                class="group flex items-center gap-2 px-6 py-3 bg-[#25D366] hover:bg-[#128C7E] text-white rounded-full transition-colors duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                    <path
                        d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z" />
                </svg>
                <span class="font-medium">Chat with Support</span>
            </a>
        </div>
    </div>

    <script>
        function toggleWidget() {
            const content = document.getElementById('widget-content');
            const toggleText = document.getElementById('toggle-text');

            if (content.style.display === 'none') {
                content.style.display = 'block';
                toggleText.textContent = 'Hide Contact';
            } else {
                content.style.display = 'none';
                toggleText.textContent = 'Show Contact';
            }
        }
    </script>

    <footer class="bg-gray-800 text-gray-300">
        <div class="max-w-7xl mx-auto px-4 py-12 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <!-- Company Info -->
                <div>
                    <h3 class="text-white text-lg font-semibold mb-4">Essential Nigeria News</h3>
                    <p class="text-sm">Bringing you the latest and most important news from around the world, 24/7.</p>
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
                <div>
                    <h4 class="text-white text-lg font-semibold mb-4">Stay Updated</h4>
                    <p class="text-sm mb-4">Subscribe to our newsletter for daily news updates.</p>
                    <form class="flex">
                        <input type="email" placeholder="Your email"
                            class="flex-grow px-3 py-2 text-gray-700 bg-white rounded-l-md focus:outline-none"
                            required>
                        <button type="submit"
                            class="bg-blue-500 text-white px-4 py-2 rounded-r-md hover:bg-blue-600 transition">Subscribe</button>
                    </form>
                </div>
            </div>

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
                    <a href="#" class="inline-block px-2 hover:text-white transition">Terms of Service</a>
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
                        <p class="text-sm text-gray-600 mb-2">A new visitor is someone who hasn't been tracked before.
                        </p>
                        <h2 id="newVisitors" class="text-3xl text-green-600">Loading...</h2>
                    </div>

                    {{-- Active Visitors Card --}}
                    <div class="bg-white shadow-md rounded-lg p-6 text-center">
                        <div class="text-5xl mb-4 text-indigo-500">
                            <i class="bi bi-person-check"></i>
                        </div>
                        <h5 class="text-xl font-semibold mb-2">Active Visitors</h5>
                        <p class="text-sm text-gray-600 mb-2">Active visitors are those who have visited the site
                            recently.</p>
                        <h2 id="activeVisitors" class="text-3xl text-indigo-600">Loading...</h2>
                    </div>

                    {{-- Returning Visitors Card --}}
                    <div class="bg-white shadow-md rounded-lg p-6 text-center">
                        <div class="text-5xl mb-4 text-yellow-500">
                            <i class="bi bi-person-check"></i>
                        </div>
                        <h5 class="text-xl font-semibold mb-2">Returning Visitors</h5>
                        <p class="text-sm text-gray-600 mb-2">A returning visitor is one who has previously visited the
                            site, but is coming back.</p>
                        <h2 id="returningVisitors" class="text-3xl text-yellow-600">Loading...</h2>
                    </div>

                    {{-- Daily Visitors Card --}}
                    <div class="bg-white shadow-md rounded-lg p-6 text-center">
                        <div class="text-5xl mb-4 text-gray-500">
                            <i class="bi bi-person-check"></i>
                        </div>
                        <h5 class="text-xl font-semibold mb-2">Daily Visitors</h5>
                        <p class="text-sm text-gray-600 mb-2">This counts unique visitors who visited the site today.
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
                            // You might want to add CSRF token if needed
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

    <button id="scrollToTop"
        class="fixed bottom-4 right-4 bg-blue-500 text-white p-2 rounded-full shadow-lg hover:bg-blue-600 transition duration-300 transform hover:scale-105 hidden"
        aria-label="Scroll to Top">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
            stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12H9m0 0l3-3m-3 3l3 3" />
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
    </script>
    <!--End of Tawk.to Script-->


    @stack('scripts')
</body>

</html>
