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
        <div class="flex items-center justify-center w-32 h-12 bg-gray-700 rounded-lg overflow-hidden shadow-lg">
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
                <a href="#" class="block py-2 px-4 text-sm hover:bg-green-500 rounded">All News</a>
                <form action="{{ route('admin-pending-posts') }}" method="POST">
                    @csrf
                    <button type="submit" class="block py-2 px-4 text-sm hover:bg-green-500 rounded">
                        Pending News
                    </button>
                </form>

                <a href="#" class="block py-2 px-4 text-sm hover:bg-green-500 rounded">Create
                    Tag</a>
            </div>
        </div>

        <!-- Public Notice -->
        <div class="menu-item">
            <a href="#"
                class="block py-2.5 px-4 rounded transition duration-200 hover:bg-green-500 hover:text-white flex justify-between items-center">
                <span><i class="fas fa-bullhorn mr-2"></i> Upload Headline Image</span>
                <i class="fas fa-chevron-down text-xs"></i>
            </a>
            <div class="submenu pl-4 bg-green-700">
                <a href="{{route('upload-photo')}}" class="block py-2 px-4 text-sm hover:bg-green-500 rounded">Upload</a>
                <a href="{{route('manage-photos')}}" class="block py-2 px-4 text-sm hover:bg-green-500 rounded">Manage</a>
            </div>
        </div>



        <!-- Editor -->
         <div class="menu-item">
            <a href="{{route('manage-editor')}}"
                class="block py-2.5 px-4 rounded transition duration-200 hover:bg-green-500 hover:text-white">
                <i class="fas fa-tachometer-alt mr-2"></i> Manage Editor
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
