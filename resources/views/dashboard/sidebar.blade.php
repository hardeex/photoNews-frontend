<div id="sidebar"
    class="bg-gray-600 text-white w-64 space-y-6 py-7 px-2 absolute inset-y-0 left-0 transform -translate-x-full md:relative md:translate-x-0 transition-all duration-300 ease-in-out overflow-y-auto h-screen"
    aria-hidden="true">
    <style>
        #sidebar {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            /* Add shadow */
        }

        /* Adjust submenu styles */
        .submenu {
            border-left: 4px solid #38a169;
            /* Darker green */
        }
    </style>
    <a href="{{ route('welcome') }}" class="inline-block px-4">
        <div class="flex items-center justify-center w-32 h-12 bg-green-700 rounded-lg overflow-hidden shadow-lg">
            <span class="text-2xl font-bold" style="text-shadow: 1px 1px 2px rgba(0,0,0,0.3);">
                <span class="text-white">E-</span>
                <span class="text-green-900">News</span>
            </span>
        </div>
    </a>

    <nav class="space-y-2">
        <!-- Dashboard -->
        <div class="menu-item">
            <a href="#"
                class="block py-2.5 px-4 rounded transition duration-200 hover:bg-green-500 hover:text-white">
                <i class="fas fa-tachometer-alt mr-2"></i> Dashboard
            </a>
        </div>

        <!-- News Menu -->
        <div class="menu-item">
            <a href="#"
                class="block py-2.5 px-4 rounded transition duration-200 hover:bg-green-500 hover:text-white flex justify-between items-center">
                <span><i class="fas fa-newspaper mr-2"></i> News</span>
                <i class="fas fa-chevron-down text-xs"></i>
            </a>
            <div class="submenu pl-4 bg-green-700">
                <a href="{{ route('news.create-post') }}"
                    class="block py-2 px-4 text-sm hover:bg-green-500 rounded">Create Post</a>
                <a href="{{ route('create-category-seeder') }}"
                    class="block py-2 px-4 text-sm hover:bg-green-500 rounded">Create Category</a>
                <a href="{{ route('manage-posts') }}" class="block py-2 px-4 text-sm hover:bg-green-500 rounded">Manage
                    Posts</a>
                {{-- <form action="{{ route('manage-posts') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="block py-2 px-4 text-sm hover:bg-green-500 rounded">
                        Manage Posts
                    </button>
                </form> --}}

                {{-- <a href="{{ route('create-category') }}"
                    class="block py-2 px-4 text-sm hover:bg-green-500 rounded">Create Category</a>
                <a href="{{ route('create-tag') }}" class="block py-2 px-4 text-sm hover:bg-green-500 rounded">Create
                    Tag</a> --}}
            </div>
        </div>


        <!-- Caveat -->
        <div class="menu-item">
            <a href="#"
                class="block py-2.5 px-4 rounded transition duration-200 hover:bg-green-500 hover:text-white flex justify-between items-center">
                <span><i class="fas fa-exclamation-triangle mr-2"></i> Caveat</span>
                <i class="fas fa-chevron-down text-xs"></i>
            </a>
            <div class="submenu pl-4 bg-yellow-700">
                <a href="{{ route('caveat.create') }}"
                    class="block py-2 px-4 text-sm hover:bg-yellow-500 rounded">Create</a>
                <a href="#" class="block py-2 px-4 text-sm hover:bg-yellow-500 rounded">Manage</a>
            </div>
        </div>


        <div class="w-64 shadow-lg rounded-lg">
            <div class="menu-item">
                <button id="celebration-button"
                    class="w-full py-2.5 px-4 rounded transition duration-200 hover:bg-yellow-500 hover:text-white flex justify-between items-center"
                    onclick="toggleCategory('celebration')">
                    <span class="flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2"
                                d="M13 10V3L4 14h7v7l9-11h-7z" />
                        </svg>
                        Celebration
                    </span>
                    <svg class="w-4 h-4 transform transition-transform" id="celebration-arrow" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>

                <div id="celebration-submenu" class="pl-4 hidden">
                    @php
                        $categories = [
                            ['name' => 'Birthday', 'id' => 'birthday'],
                            ['name' => 'Wedding', 'id' => 'wedding'],
                            ['name' => 'Dedication', 'id' => 'dedication'],
                        ];
                    @endphp
                    @foreach ($categories as $category)
                        <div class="relative">
                            <button id="category-{{ $category['id'] }}-button"
                                class="w-full py-2.5 px-4 rounded transition duration-200 hover:bg-yellow-500 hover:text-white flex justify-between items-center"
                                onclick="toggleSubmenu('{{ $category['id'] }}')">
                                <span>{{ $category['name'] }}</span>
                                <svg class="w-4 h-4 transform transition-transform"
                                    id="category-{{ $category['id'] }}-arrow" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path strokeLinecap="round" strokeLinejoin="round" strokeWidth="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>

                            <div id="category-{{ $category['id'] }}-submenu" class="pl-4 hidden">
                                <a href="{{ route('create.' . $category['id']) }}"
                                    class="block py-2 px-4 text-sm hover:bg-yellow-500 hover:text-white rounded">Create</a>
                                <a href="{{ route('manage.' . $category['id']) }}"
                                    class="block py-2 px-4 text-sm hover:bg-yellow-500 hover:text-white rounded">Manage</a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <script>
            let openCategory = null;
            let openSubmenu = null;

            function toggleCategory(category) {
                const celebrationSubmenu = document.getElementById('celebration-submenu');
                const celebrationArrow = document.getElementById('celebration-arrow');

                if (openCategory === category) {
                    openCategory = null;
                    celebrationSubmenu.classList.add('hidden');
                    celebrationArrow.classList.remove('rotate-180');
                } else {
                    openCategory = category;
                    celebrationSubmenu.classList.remove('hidden');
                    celebrationArrow.classList.add('rotate-180');
                }
            }

            function toggleSubmenu(categoryId) {
                const submenu = document.getElementById(`category-${categoryId}-submenu`);
                const arrow = document.getElementById(`category-${categoryId}-arrow`);

                if (openSubmenu === categoryId) {
                    openSubmenu = null;
                    submenu.classList.add('hidden');
                    arrow.classList.remove('rotate-180');
                } else {
                    openSubmenu = categoryId;
                    submenu.classList.remove('hidden');
                    arrow.classList.add('rotate-180');
                }
            }
        </script>

        <!-- Public Notice -->
        <div class="menu-item">
            <a href="#"
                class="block py-2.5 px-4 rounded transition duration-200 hover:bg-green-500 hover:text-white flex justify-between items-center">
                <span><i class="fas fa-bullhorn mr-2"></i> Public Notice</span>
                <i class="fas fa-chevron-down text-xs"></i>
            </a>
            <div class="submenu pl-4 bg-green-700">
                <a href="{{ route('public-notice.create') }}"
                    class="block py-2 px-4 text-sm hover:bg-green-500 rounded">Create</a>
                <a href="#" class="block py-2 px-4 text-sm hover:bg-green-500 rounded">Manage</a>
            </div>
        </div>



        <!-- Misplaced & Found -->
        <div class="menu-item">
            <a href="#"
                class="block py-2.5 px-4 rounded transition duration-200 hover:bg-green-500 hover:text-white flex justify-between items-center">
                <span><i class="fas fa-search-location mr-2"></i> Misplaced & Found</span>
                <i class="fas fa-chevron-down text-xs"></i>
            </a>
            <div class="submenu pl-4 bg-green-700">
                <a href="{{ route('misplaced.create') }}"
                    class="block py-2 px-4 text-sm hover:bg-green-500 rounded">Create</a>
                <a href="#" class="block py-2 px-4 text-sm hover:bg-green-500 rounded">Manage</a>
            </div>
        </div>

        {{-- <!-- Loss of Documents -->
        <div class="menu-item">
            <a href="#"
                class="block py-2.5 px-4 rounded transition duration-200 hover:bg-green-500 hover:text-white flex justify-between items-center">
                <span><i class="fas fa-file-alt mr-2"></i> Loss of Documents</span>
                <i class="fas fa-chevron-down text-xs"></i>
            </a>
            <div class="submenu pl-4 bg-green-700">
                <a href="#" class="block py-2 px-4 text-sm hover:bg-green-500 rounded">Create</a>
                <a href="#" class="block py-2 px-4 text-sm hover:bg-green-500 rounded">Manage</a>
            </div>
        </div> --}}

        <!-- Missing Person -->
        <div class="menu-item">
            <a href="#"
                class="block py-2.5 px-4 rounded transition duration-200 hover:bg-green-500 hover:text-white flex justify-between items-center">
                <span><i class="fas fa-user-missing mr-2"></i> Missing &amp; Wanted Person</span>
                <i class="fas fa-chevron-down text-xs"></i>
            </a>
            <div class="submenu pl-4 bg-green-700">
                <a href="{{ route('missing.create') }}"
                    class="block py-2 px-4 text-sm hover:bg-green-500 rounded">Create</a>
                <a href="#" class="block py-2 px-4 text-sm hover:bg-green-500 rounded">Manage</a>
            </div>
        </div>



        <!-- Obituary -->
        <div class="menu-item">
            <a href="#"
                class="block py-2.5 px-4 rounded transition duration-200 hover:bg-green-500 hover:text-white flex justify-between items-center">
                <span><i class="fas fa-burn mr-2"></i> Obituary</span>
                <i class="fas fa-chevron-down text-xs"></i>
            </a>
            <div class="submenu pl-4 bg-green-700">
                <a href="{{ route('obituary.create') }}"
                    class="block py-2 px-4 text-sm hover:bg-green-500 rounded">Create</a>
                <a href="#" class="block py-2 px-4 text-sm hover:bg-green-500 rounded">Manage</a>
            </div>
        </div>

        <!-- Remembrance -->
        <div class="menu-item">
            <a href="#"
                class="block py-2.5 px-4 rounded transition duration-200 hover:bg-green-500 hover:text-white flex justify-between items-center">
                <span><i class="fas fa-heart mr-2"></i> Remembrance</span>
                <i class="fas fa-chevron-down text-xs"></i>
            </a>
            <div class="submenu pl-4 bg-green-700">
                <a href="{{ route('remembrance.create') }}"
                    class="block py-2 px-4 text-sm hover:bg-green-500 rounded">Create</a>
                <a href="#" class="block py-2 px-4 text-sm hover:bg-green-500 rounded">Manage</a>
            </div>
        </div>

        <!-- Change of Name -->
        <div class="menu-item">
            <a href="#"
                class="block py-2.5 px-4 rounded transition duration-200 hover:bg-green-500 hover:text-white flex justify-between items-center">
                <span><i class="fas fa-id-card mr-2"></i> Change of Name</span>
                <i class="fas fa-chevron-down text-xs"></i>
            </a>
            <div class="submenu pl-4 bg-green-700">
                <a href="{{ route('change-of-name.create') }}"
                    class="block py-2 px-4 text-sm hover:bg-green-500 rounded">Create</a>
                <a href="#" class="block py-2 px-4 text-sm hover:bg-green-500 rounded">Manage</a>
            </div>
        </div>

        <!-- Stolen Vehicle -->
        <div class="menu-item">
            <a href="#"
                class="block py-2.5 px-4 rounded transition duration-200 hover:bg-green-500 hover:text-white flex justify-between items-center">
                <span><i class="fas fa-id-card mr-2"></i> Stolen Vehicle</span>
                <i class="fas fa-chevron-down text-xs"></i>
            </a>
            <div class="submenu pl-4 bg-green-700">
                <a href="{{ route('create.vehicle') }}"
                    class="block py-2 px-4 text-sm hover:bg-green-500 rounded">Create</a>
                <a href="#" class="block py-2 px-4 text-sm hover:bg-green-500 rounded">Manage</a>
            </div>
        </div>


        <!-- Profile Menu -->
        <div class="menu-item">
            <a href="#"
                class="block py-2.5 px-4 rounded transition duration-200 hover:bg-green-500 hover:text-white flex justify-between items-center">
                <span><i class="fas fa-user-circle mr-2"></i> Profile</span>
                <i class="fas fa-chevron-down text-xs"></i>
            </a>
            <div class="submenu pl-4 bg-green-700">
                <a href="#" class="block py-2 px-4 text-sm hover:bg-green-500 rounded">Edit</a>
                <a href="#" class="block py-2 px-4 text-sm hover:bg-green-500 rounded">Password</a>
            </div>
        </div>

        <!-- Settings Menu -->
        {{-- <div class="menu-item">
            <a href="#"
                class="block py-2.5 px-4 rounded transition duration-200 hover:bg-green-500 hover:text-white flex justify-between items-center">
                <span><i class="fas fa-cogs mr-2"></i> Settings</span>
                <i class="fas fa-chevron-down text-xs"></i>
            </a>
            <div class="submenu pl-4 bg-green-700">
                <a href="#" class="block py-2 px-4 text-sm hover:bg-green-500 rounded">General</a>
                <a href="#" class="block py-2 px-4 text-sm hover:bg-green-500 rounded">Notifications</a>
                <a href="#" class="block py-2 px-4 text-sm hover:bg-green-500 rounded">Security</a>
            </div>
        </div> --}}


        <!-- Live Video -->
        <div class="menu-item">
            <a href="{{route('youtube-link')}}"
                class="block py-2.5 px-4 rounded transition duration-200 hover:bg-green-500 hover:text-white">
                <i class="fas fa-video mr-2"></i> Live Video
            </a>
        </div>



        <!-- Help -->
        <div class="menu-item">
            <a href="#"
                class="block py-2.5 px-4 rounded transition duration-200 hover:bg-green-500 hover:text-white">
                <i class="fas fa-question-circle mr-2"></i> Help
            </a>
        </div>

        <!-- Logout -->
        <div class="menu-item">
            <a href="#"
                class="block py-2.5 px-4 rounded transition duration-200 hover:bg-green-500 hover:text-white"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt mr-2"></i> Logout
            </a>
            <form id="logout-form" action="{{ route('user.logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>

    </nav>
</div>

<style>
    #sidebar {
        height: 100vh;
        position: fixed;
        top: 0;
        left: 0;
        bottom: 0;
    }

    body {
        padding-left: 16rem;
    }

    /* For mobile responsiveness */
    @media (max-width: 768px) {
        #sidebar {
            transform: translateX(-100%);
        }

        body {
            padding-left: 0;
        }
    }
</style>
