<div class="min-h-screen bg-gray-50">
    {{-- Header --}}
    <header class="bg-white shadow-sm sticky top-0 z-10">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <h1 class="text-xl md:text-2xl font-bold text-gray-900">Categories Management</h1>
                </div>
                <nav class="flex items-center space-x-4">
                    <a href="#"
                        class="text-gray-500 hover:text-gray-700 px-3 py-2 rounded-md text-sm font-medium hidden md:block">Dashboard</a>
                    <a href="#"
                        class="bg-blue-100 text-blue-700 px-3 py-2 rounded-md text-sm font-medium">Categories</a>
                </nav>
            </div>
        </div>
    </header>

    <meta name="api-token" content="{{ session('api_token') }}">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="grid grid-cols-12 gap-6">
            {{-- Sidebar - Collapsible on mobile --}}
            <aside class="col-span-12 md:col-span-3 lg:col-span-2">
                <div class="bg-white shadow rounded-lg p-4 sticky top-20">
                    <div class="flex justify-between items-center md:block">
                        <h2 class="text-lg font-semibold text-gray-900 mb-0 md:mb-4">Quick Actions</h2>
                        <button class="md:hidden" onclick="toggleSidebar()">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 12h16m-7 6h7" />
                            </svg>
                        </button>
                    </div>
                    <ul id="sidebarMenu" class="hidden md:block space-y-2 mt-2 md:mt-0">
                        <li>
                            <a href="{{ route('news.create-post') }}"
                                class="block p-2 text-gray-600 hover:text-blue-600 hover:bg-blue-50 rounded-md transition-colors">
                                <span class="flex items-center space-x-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 4v16m8-8H4" />
                                    </svg>
                                    <span>Create Post</span>
                                </span>
                            </a>
                        </li>
                        <li>
                            <a href="#create-category-form"
                                class="block p-2 text-gray-600 hover:text-blue-600 hover:bg-blue-50 rounded-md transition-colors">
                                <span class="flex items-center space-x-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 4v16m8-8H4" />
                                    </svg>
                                    <span>New Category</span>
                                </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </aside>

            {{-- Main Content --}}
            <main class="col-span-12 md:col-span-9 lg:col-span-10 space-y-6">
                {{-- Category List Section --}}
                <section class="bg-white shadow rounded-lg p-4 md:p-6">
                    <div
                        class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6 space-y-4 md:space-y-0">
                        <h2 class="text-xl font-semibold text-gray-900">All Categories</h2>
                        <div class="w-full md:w-auto">
                            <input id="search" type="search" placeholder="Search categories..."
                                class="w-full md:w-64 px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                                onkeyup="searchTable()">
                        </div>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th
                                        class="px-3 md:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        S/N</th>
                                    <th
                                        class="px-3 md:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Category Name</th>
                                    <th
                                        class="px-3 md:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider hidden md:table-cell">
                                        Slug</th>
                                    <th
                                        class="px-3 md:px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($categoriesForDisplay as $index => $category)
                                    <tr class="hover:bg-gray-50">
                                        <td
                                            class="px-3 md:px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            {{ ($pagination['current_page'] - 1) * 10 + $index + 1 }}
                                        </td>
                                        <td class="px-3 md:px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $category['name'] }}
                                        </td>
                                        <td
                                            class="px-3 md:px-6 py-4 whitespace-nowrap text-sm text-gray-500 hidden md:table-cell">
                                            {{ $category['slug'] }}
                                        </td>
                                        <td class="px-3 md:px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            <div class="flex space-x-2">
                                                <!-- Edit Button -->
                                                <a href="#"
                                                    class="text-blue-600 hover:text-blue-800 font-medium text-sm flex items-center space-x-1">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M16 4h5v5M12 2l7 7-5 5H6L2 12 12 2z" />
                                                    </svg>
                                                    <span>Edit</span>
                                                </a>
                                                <!-- Delete Button -->
                                                <form action="#" method="POST" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="text-red-600 hover:text-red-800 font-medium text-sm flex items-center space-x-1">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2"
                                                                d="M6 2L4 6M2 6h16m-3-6h-4l-1 4H7L6 2H2" />
                                                        </svg>
                                                        <span>Delete</span>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{-- Enhanced Pagination --}}
                    @if ($pagination['last_page'] > 1)
                        <div class="mt-4 px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
                            <div class="flex-1 flex justify-between sm:hidden">
                                @if ($pagination['prev_page_url'])
                                    <a href="{{ $pagination['prev_page_url'] }}"
                                        class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                                        Previous
                                    </a>
                                @endif
                                @if ($pagination['next_page_url'])
                                    <a href="javascript:void(0)"
                                        onclick="loadPage('{{ $pagination['next_page_url'] }}')"
                                        class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                        <span class="sr-only">Next</span>
                                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                            fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </a>
                                @endif
                            </div>
                            <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                                <div>
                                    <p class="text-sm text-gray-700">
                                        Showing
                                        <span
                                            class="font-medium">{{ ($pagination['current_page'] - 1) * 10 + 1 }}</span>
                                        to
                                        <span
                                            class="font-medium">{{ min($pagination['current_page'] * 10, $pagination['total']) }}</span>
                                        of
                                        <span class="font-medium">{{ $pagination['total'] }}</span>
                                        results
                                    </p>
                                </div>
                                <div>
                                    <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px"
                                        aria-label="Pagination">
                                        {{-- Previous Page Link --}}
                                        @if ($pagination['prev_page_url'])
                                            <a href="{{ $pagination['prev_page_url'] }}"
                                                class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                                <span class="sr-only">Previous</span>
                                                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd"
                                                        d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </a>
                                        @endif

                                        {{-- Page Numbers --}}
                                        @for ($i = 1; $i <= $pagination['last_page']; $i++)
                                            @if ($i == $pagination['current_page'])
                                                <span
                                                    class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-blue-50 text-sm font-medium text-blue-600">
                                                    {{ $i }}
                                                </span>
                                            @else
                                                <a href="{{ str_replace('page=' . $pagination['current_page'], 'page=' . $i, request()->fullUrl()) }}"
                                                    class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">
                                                    {{ $i }}
                                                </a>
                                            @endif
                                        @endfor

                                        {{-- Next Page Link --}}
                                        @if ($pagination['next_page_url'])
                                            <a href="{{ $pagination['next_page_url'] }}"
                                                class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                                <span class="sr-only">Next</span>
                                                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg"
                                                    viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd"
                                                        d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </a>
                                        @endif
                                    </nav>
                                </div>
                            </div>
                        </div>
                    @endif
                </section>

                {{-- Create Category Form --}}
                <section id="create-category-form" class="bg-white shadow rounded-lg p-6">
                    <h2 class="text-xl font-semibold text-gray-900 mb-6">Create New Category</h2>

                    @include('feedback')

                    <form class="space-y-6" method="POST" action="{{ route('submit-category-seeder') }}">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="category-name" class="block text-sm font-medium text-gray-700">Category
                                    Name</label>
                                <input type="text" id="category-name" name="name" value="{{ old('name') }}"
                                    required
                                    class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            </div>
                        </div>

                        <div class="flex flex-col sm:flex-row sm:space-x-4 space-y-3 sm:space-y-0">
                            <button type="submit"
                                class="inline-flex justify-center items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                                Save Category
                            </button>
                            <button type="button" onclick="window.history.back()"
                                class="inline-flex justify-center items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Cancel
                            </button>
                        </div>
                    </form>
                </section>
            </main>
        </div>
    </div>
</div>



<script>
    let debounceTimeout;

    function toggleSidebar() {
        const menu = document.getElementById('sidebarMenu');
        menu.classList.toggle('hidden');
    }

    function searchTable() {
        const input = document.getElementById('search');
        const filter = input.value.toLowerCase();
        const table = document.querySelector('table');
        const rows = table.getElementsByTagName('tr');

        // Clear the previous debounce timeout
        clearTimeout(debounceTimeout);

        // Set a new debounce timeout to trigger search after 300ms
        debounceTimeout = setTimeout(() => {
            for (let i = 1; i < rows.length; i++) {
                const cells = rows[i].getElementsByTagName('td');
                let found = false;

                for (let j = 0; j < cells.length; j++) {
                    const cell = cells[j];
                    if (cell) {
                        const text = cell.textContent || cell.innerText;
                        if (text.toLowerCase().indexOf(filter) > -1) {
                            found = true;
                            break;
                        }
                    }
                }

                rows[i].style.display = found ? '' : 'none';
            }
        }, 300); // Delay of 300ms
    }

    // Attach the searchTable function to the input's keyup event
    document.getElementById('search').addEventListener('keyup', searchTable);

    // Smooth scroll for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function(e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
                // Close mobile sidebar if open
                const sidebarMenu = document.getElementById('sidebarMenu');
                if (!sidebarMenu.classList.contains('hidden') && window.innerWidth < 768) {
                    toggleSidebar();
                }
            }
        });
    });

    // Handle responsive table on window resize
    window.addEventListener('resize', function() {
        if (window.innerWidth >= 768) {
            const sidebarMenu = document.getElementById('sidebarMenu');
            sidebarMenu.classList.remove('hidden');
        }
    });

    // Flash messages fade out
    document.addEventListener('DOMContentLoaded', function() {
        const flashMessages = document.querySelectorAll('.alert');
        flashMessages.forEach(message => {
            setTimeout(() => {
                message.style.transition = 'opacity 0.5s ease-in-out';
                message.style.opacity = '0';
                setTimeout(() => {
                    message.remove();
                }, 500);
            }, 5000);
        });
    });

    function loadPage(url) {
        fetch(url, {
                headers: {
                    'Authorization': `Bearer ${document.querySelector('meta[name="api-token"]').content}`,
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                // Update the table body
                const tbody = document.querySelector('table tbody');
                tbody.innerHTML = '';

                data.data.categories.forEach((category, index) => {
                    const currentPage = data.data.pagination.current_page;
                    const rowNumber = (currentPage - 1) * 10 + index + 1;

                    tbody.innerHTML += `
                <tr class="hover:bg-gray-50">
                    <td class="px-3 md:px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                        ${rowNumber}
                    </td>
                    <td class="px-3 md:px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        ${category.name}
                    </td>
                    <td class="px-3 md:px-6 py-4 whitespace-nowrap text-sm text-gray-500 hidden md:table-cell">
                        ${category.slug}
                    </td>
                    <td class="px-3 md:px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                        <div class="flex space-x-2">
                            <a href="#" class="text-blue-600 hover:text-blue-800 font-medium text-sm flex items-center space-x-1">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 4h5v5M12 2l7 7-5 5H6L2 12 12 2z" />
                                </svg>
                                <span>Edit</span>
                            </a>
                            <form action="#" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800 font-medium text-sm flex items-center space-x-1">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 2L4 6M2 6h16m-3-6h-4l-1 4H7L6 2H2" />
                                    </svg>
                                    <span>Delete</span>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
            `;
                });

                // Update pagination links
                updatePagination(data.data.pagination);
            })
            .catch(error => console.error('Error:', error));
    }

    function updatePagination(pagination) {
        const paginationContainer = document.querySelector('nav[aria-label="Pagination"]');
        if (!paginationContainer) return;

        let html = '';

        // Previous button
        if (pagination.prev_page_url) {
            html += `
            <a href="javascript:void(0)" onclick="loadPage('${pagination.prev_page_url}')" 
               class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                <span class="sr-only">Previous</span>
                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                </svg>
            </a>`;
        }

        // Page numbers
        for (let i = 1; i <= pagination.last_page; i++) {
            if (i === pagination.current_page) {
                html += `
                <span class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-blue-50 text-sm font-medium text-blue-600">
                    ${i}
                </span>`;
            } else {
                const pageUrl = pagination.first_page_url.replace(`page=1`, `page=${i}`);
                html += `
                <a href="javascript:void(0)" onclick="loadPage('${pageUrl}')"
                   class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">
                    ${i}
                </a>`;
            }
        }

        // Next button
        if (pagination.next_page_url) {
            html += `
            <a href="javascript:void(0)" onclick="loadPage('${pagination.next_page_url}')"
               class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                <span class="sr-only">Next</span>
                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                </svg>
            </a>`;
        }

        paginationContainer.innerHTML = html;
    }
</script>

<style>
    /* Custom scrollbar for webkit browsers */
    ::-webkit-scrollbar {
        width: 8px;
        height: 8px;
    }

    ::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 4px;
    }

    ::-webkit-scrollbar-thumb {
        background: #888;
        border-radius: 4px;
    }

    ::-webkit-scrollbar-thumb:hover {
        background: #666;
    }

    /* Responsive table adjustments */
    @media (max-width: 768px) {
        .table-responsive {
            display: block;
            width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }
    }

    /* Smooth transitions */
    .transition-all {
        transition: all 0.3s ease-in-out;
    }

    /* Custom animations */
    @keyframes fadeIn {
        from {
            opacity: 0;
        }

        to {
            opacity: 1;
        }
    }

    .fade-in {
        animation: fadeIn 0.3s ease-in-out;
    }
</style>
