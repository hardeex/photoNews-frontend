<li><a href="#" class="text-blue-600 font-semibold">Home</a></li>
        
<li class="relative">
    <button onclick="toggleDropdown('celebrationDropdown')"
        class="flex items-center hover:text-green-600 focus:outline-none" aria-expanded="false"
        aria-haspopup="true">
        Celebration
        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M19 9l-7 7-7-7" />
        </svg>
    </button>
    <div id="celebrationDropdown"
        class="absolute hidden bg-white shadow-lg mt-2 rounded-md w-40 z-50 transition-all duration-200 ease-in-out"
        aria-label="Celebration dropdown">
        <ul class="flex flex-col py-1">
            <li>
                <a href="{{ route('list.birthday-posts') }}"
                    class="block px-4 py-2 text-gray-700 hover:bg-gray-100 hover:text-green-600 transition-colors duration-200">
                    Birthday
                </a>
            </li>
            <li>
                <a href="{{ route('list.dedication') }}"
                    class="block px-4 py-2 text-gray-700 hover:bg-gray-100 hover:text-green-600 transition-colors duration-200">
                    Child Dedication
                </a>
            </li>
            <li>
                <a href="{{ route('lists.wedding') }}"
                    class="block px-4 py-2 text-gray-700 hover:bg-gray-100 hover:text-green-600 transition-colors duration-200">
                    Wedding
                </a>
            </li>
        </ul>
    </div>
</li>


<li><a href="{{ route('news') }}" class="hover:text-blue-600">News</a></li>

<li class="relative">
    <button onclick="toggleDropdown('memorialDropdown')"
        class="flex items-center hover:text-green-600 focus:outline-none" aria-expanded="false"
        aria-haspopup="true">
        In Memoriam
        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M19 9l-7 7-7-7" />
        </svg>
    </button>
    <div id="memorialDropdown"
        class="absolute hidden bg-white shadow-lg mt-2 rounded-md w-40 z-50 transition-all duration-200 ease-in-out"
        aria-label="In Memoriam dropdown">
        <ul class="flex flex-col py-1">
            <li>
                <a href="{{ route('list-remembrance') }}"
                    class="block px-4 py-2 text-gray-700 hover:bg-gray-100 hover:text-green-600 transition-colors duration-200">
                    Remembrance
                </a>
            </li>
            <li>
                <a href="{{ route('obituary.listObituaryPosts') }}"
                    class="block px-4 py-2 text-gray-700 hover:bg-gray-100 hover:text-green-600 transition-colors duration-200">
                    Obituary
                </a>
            </li>
        </ul>
    </div>
</li>

<li class="relative">
    <button onclick="toggleDropdown('legalNoticesDropdown')"
        class="flex items-center hover:text-green-600 focus:outline-none" aria-expanded="false"
        aria-haspopup="true">
         Notices
        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M19 9l-7 7-7-7" />
        </svg>
    </button>
    <div id="legalNoticesDropdown"
        class="absolute hidden bg-white shadow-lg mt-2 rounded-md w-40 z-50 transition-all duration-200 ease-in-out"
        aria-label="Legal Notices dropdown">
        <ul class="flex flex-col py-1">
            <li>
                <a href="{{ route('list-change-of-name') }}"
                    class="block px-4 py-2 text-gray-700 hover:bg-gray-100 hover:text-green-600 transition-colors duration-200">
                    Change of Name
                </a>
            </li>
            <li>
                <a href="{{ route('lists-public-notice') }}"
                    class="block px-4 py-2 text-gray-700 hover:bg-gray-100 hover:text-green-600 transition-colors duration-200">
                    Public Notice
                </a>
            </li>
            <li>
                <a href="{{ route('caveat.posts') }}"
                    class="block px-4 py-2 text-gray-700 hover:bg-gray-100 hover:text-green-600 transition-colors duration-200">
                    Caveat
                </a>
            </li>
        </ul>
    </div>
</li>




<li class="relative">
    <button onclick="toggleDropdown('findDropdown')"
        class="flex items-center hover:text-green-600 focus:outline-none" aria-expanded="false"
        aria-haspopup="true">
        Find
        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M19 9l-7 7-7-7" />
        </svg>
    </button>
    <div id="findDropdown"
        class="absolute hidden bg-white shadow-lg mt-2 rounded-md w-40 z-50 transition-all duration-200 ease-in-out"
        aria-label="Find dropdown">
        <ul class="flex flex-col py-1">
            <li>
                <a href="{{ route('lists-lost-and-found') }}"
                    class="block px-4 py-2 text-gray-700 hover:bg-gray-100 hover:text-green-600 transition-colors duration-200">
                    Lost &amp; Found
                </a>
            </li>
            <li>
                <a href="{{ route('missing-wanted-lists.details') }}"
                    class="block px-4 py-2 text-gray-700 hover:bg-gray-100 hover:text-green-600 transition-colors duration-200">
                    Missing / Wanted
                </a>
            </li>
            <li>
                <a href="{{ route('list-stolen-vehicles') }}"
                    class="block px-4 py-2 text-gray-700 hover:bg-gray-100 hover:text-green-600 transition-colors duration-200">
                    Stolen Vehicle
                </a>
            </li>
        </ul>
    </div>
</li>
{{-- <li><a href="#" class="hover:text-blue-600">Marketplace</a></li> --}}


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
    // JavaScript to toggle each dropdown
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
