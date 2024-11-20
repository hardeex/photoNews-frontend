<div id="sidebar"
    class="bg-green-600 text-white w-64 space-y-6 py-7 px-2 absolute inset-y-0 left-0 transform -translate-x-full md:relative md:translate-x-0 transition-all duration-300 ease-in-out overflow-y-auto h-screen"
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
                <a href="{{ route('create-category') }}"
                    class="block py-2 px-4 text-sm hover:bg-green-500 rounded">Create Category</a>
                <a href="{{ route('create-tag') }}" class="block py-2 px-4 text-sm hover:bg-green-500 rounded">Create
                    Tag</a>
            </div>
        </div>

        <!-- Public Notice -->
        <div class="menu-item">
            <a href="#"
                class="block py-2.5 px-4 rounded transition duration-200 hover:bg-green-500 hover:text-white flex justify-between items-center">
                <span><i class="fas fa-bullhorn mr-2"></i> Public Notice</span>
                <i class="fas fa-chevron-down text-xs"></i>
            </a>
            <div class="submenu pl-4 bg-green-700">
                <a href="#" class="block py-2 px-4 text-sm hover:bg-green-500 rounded">Create</a>
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
                <a href="#" class="block py-2 px-4 text-sm hover:bg-green-500 rounded">Create</a>
                <a href="#" class="block py-2 px-4 text-sm hover:bg-green-500 rounded">Manage</a>
            </div>
        </div>

        <!-- Loss of Documents -->
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
        </div>

        <!-- Missing Person -->
        <div class="menu-item">
            <a href="#"
                class="block py-2.5 px-4 rounded transition duration-200 hover:bg-green-500 hover:text-white flex justify-between items-center">
                <span><i class="fas fa-user-missing mr-2"></i> Missing Person</span>
                <i class="fas fa-chevron-down text-xs"></i>
            </a>
            <div class="submenu pl-4 bg-green-700">
                <a href="#" class="block py-2 px-4 text-sm hover:bg-green-500 rounded">Create</a>
                <a href="#" class="block py-2 px-4 text-sm hover:bg-green-500 rounded">Manage</a>
            </div>
        </div>

        <!-- Wanted Person -->
        <div class="menu-item">
            <a href="#"
                class="block py-2.5 px-4 rounded transition duration-200 hover:bg-green-500 hover:text-white flex justify-between items-center">
                <span><i class="fas fa-exclamation-circle mr-2"></i> Wanted Person</span>
                <i class="fas fa-chevron-down text-xs"></i>
            </a>
            <div class="submenu pl-4 bg-green-700">
                <a href="#" class="block py-2 px-4 text-sm hover:bg-green-500 rounded">Create</a>
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
                <a href="#" class="block py-2 px-4 text-sm hover:bg-green-500 rounded">Create</a>
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
                <a href="#" class="block py-2 px-4 text-sm hover:bg-green-500 rounded">Create</a>
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
                <a href="#" class="block py-2 px-4 text-sm hover:bg-green-500 rounded">Create</a>
                <a href="#" class="block py-2 px-4 text-sm hover:bg-green-500 rounded">Manage</a>
            </div>
        </div>

        <!-- Pride of Nigeria -->
        <div class="menu-item">
            <a href="#"
                class="block py-2.5 px-4 rounded transition duration-200 hover:bg-green-500 hover:text-white flex justify-between items-center">
                <span><i class="fas fa-globe-africa mr-2"></i> Pride of Nigeria</span>
                <i class="fas fa-chevron-down text-xs"></i>
            </a>
            <div class="submenu pl-4 bg-green-700">
                <a href="#" class="block py-2 px-4 text-sm hover:bg-green-500 rounded">Create</a>
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
        <div class="menu-item">
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
            <form id="logout-form" action="#" method="POST" style="display: none;">
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
