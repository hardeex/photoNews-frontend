<div class="bg-gray-50">
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <h1 class="text-2xl font-bold text-gray-900">Categories</h1>
                </div>
                <nav class="flex space-x-4">
                    <a href="#"
                        class="text-gray-500 hover:text-gray-700 px-3 py-2 rounded-md text-sm font-medium">Dashboard</a>
                    <a href="#"
                        class="bg-blue-100 text-blue-700 px-3 py-2 rounded-md text-sm font-medium">Categories</a>
                </nav>
            </div>
        </div>
    </header>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="grid grid-cols-12 gap-6">
            <!-- Sidebar -->
            <aside class="col-span-12 md:col-span-3 lg:col-span-2">
                <div class="bg-white shadow rounded-lg p-4">
                    <h2 class="text-lg font-semibold text-gray-900 mb-4">Categories</h2>
                    <ul class="space-y-2">
                        <li><a href="{{ route('news.create-post') }}" class="text-gray-600 hover:text-blue-600">Create a
                                New Post</a></li>
                        <li><a href="#" id="create-category-link" class="text-gray-600 hover:text-blue-600">Create
                                New Category</a></li>
                    </ul>
                </div>
            </aside>

            <!-- Main Content -->
            <main class="col-span-12 md:col-span-9 lg:col-span-10 space-y-6">
                <!-- Category List Section -->
                <section class="bg-white shadow rounded-lg p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-xl font-semibold text-gray-900">All Categories</h2>
                        <button onclick="history.back()" class="text-gray-600 hover:text-gray-900">Back</button>
                    </div>

                    <div class="mb-6">
                        <form action="#" method="GET">
                            <input type="search" name="search" id="search" placeholder="Search..."
                                value="{{ request('search') }}"
                                class="w-full md:w-64 px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500"
                                onkeyup="searchTable()">
                        </form>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200" id="categoryTable">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        S/N
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Category Name
                                    </th>
                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Description
                                    </th>

                                    <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Parent Category
                                    </th>
                                    {{-- <th
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Actions
                                    </th> --}}
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse($categoriesForDisplay['categories'] as $index => $category)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $index + 1 }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $category['name'] }}</td>
                                        <td class="px-6 py-4">{{ $category['description'] }}</td>
                                        <td class="px-6 py-4">
                                            {{ optional($category['parent_id']) ? $category['parent_name'] : 'None' }}

                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex space-x-2">
                                                @auth

                                                    <a href="{{ route('categories.edit', $category['id']) }}"
                                                        class="px-3 py-1 bg-blue-100 text-blue-700 rounded hover:bg-blue-200">
                                                        Edit
                                                    </a>
                                                    {{-- <form action="#" method="POST" class="inline"
                                                        onsubmit="return confirm('Are you sure you want to delete this category?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="px-3 py-1 bg-red-100 text-red-700 rounded hover:bg-red-200">
                                                            Delete
                                                        </button>
                                                    </form> --}}
                                                    <a href="#"
                                                        class="px-3 py-1 bg-green-100 text-green-700 rounded hover:bg-green-200">
                                                        Manage
                                                    </a>
                                                @elseif(auth()->id() === $category['created_by'])
                                                    <a href="#"
                                                        class="px-3 py-1 bg-blue-100 text-blue-700 rounded hover:bg-blue-200">
                                                        Edit
                                                    </a>
                                    @endif


                        </div>
                        </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                                No categories found
                            </td>
                        </tr>
                        @endforelse
                        </tbody>


                        <!-- Pagination controls (optional) -->
                        @if (isset($categoriesForDisplay['pagination']))
                            <tfoot>
                                <tr>
                                    <td colspan="5" class="px-6 py-4">
                                        <div class="flex justify-between">
                                            <!-- Previous Page Link -->
                                            @if ($categoriesForDisplay['pagination']['prev_page_url'])
                                                <a href="{{ $categoriesForDisplay['pagination']['prev_page_url'] }}"
                                                    class="text-blue-500">Previous</a>
                                            @else
                                                <span class="text-gray-500">Previous</span>
                                            @endif

                                            <!-- Next Page Link -->
                                            @if ($categoriesForDisplay['pagination']['next_page_url'])
                                                <a href="{{ $categoriesForDisplay['pagination']['next_page_url'] }}"
                                                    class="text-blue-500">Next</a>
                                            @else
                                                <span class="text-gray-500">Next</span>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            </tfoot>
                        @endif

                        </table>
            </div>

            <!-- Pagination -->
            {{-- <div class="mt-6">
                        {{ $categories->links() }}
                    </div> --}}
            </section>

            <!-- Create Category Form -->
            <section id="create-category-form" class="bg-white shadow rounded-lg p-6">
                <h2 class="text-xl font-semibold text-gray-900 mb-6">Create New Category</h2>

                @include('feedback')


                <form class="space-y-6" method="POST" action="{{ route('submit-category') }}">
                    @csrf
                    <div>
                        <label for="category-name" class="block text-sm font-medium text-gray-700">Category
                            Name</label>
                        <input type="text" id="category-name" name="category_name" value="{{ old('category_name') }}"
                            required
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <div>
                        <label for="parent-category" class="block text-sm font-medium text-gray-700">Parent
                            Category</label>
                        <select id="parent-category" name="parent_id"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                            <option value="">None</option>
                            @forelse ($categories as $category)
                                <option value="{{ $category['id'] }}"
                                    {{ old('parent_id') == $category['id'] ? 'selected' : '' }}>
                                    {{ $category['name'] }}
                                </option>
                            @empty
                                <option disabled>No categories available</option>
                            @endforelse
                        </select>


                    </div>

                    <div>
                        <label for="category-desc" class="block text-sm font-medium text-gray-700">Description</label>
                        <textarea id="category-desc" name="description" rows="3"
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">{{ old('description') }}</textarea>
                    </div>

                    <div class="flex space-x-4">
                        <button type="submit"
                            class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">Save</button>
                        <button type="button" onclick="window.history.back()"
                            class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2">Cancel</button>
                    </div>
                </form>
            </section>

            </main>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Create category link scroll behavior
            document.getElementById('create-category-link').addEventListener('click', function(event) {
                event.preventDefault();
                document.getElementById('create-category-form').scrollIntoView({
                    behavior: 'smooth'
                });
            });

            // Delete confirmation
            const deleteButtons = document.querySelectorAll('button:contains("Delete")');
            deleteButtons.forEach(button => {
                button.addEventListener('click', function(event) {
                    if (!confirm('Are you sure you want to delete this category?')) {
                        event.preventDefault();
                    }
                });
            });
        });
    </script>
    </div>



    <script>
        // Function to filter the table based on the search input
        function searchTable() {
            const input = document.getElementById('search'); // Get the search input field
            const filter = input.value.toLowerCase(); // Convert search term to lowercase
            const table = document.getElementById('categoryTable'); // Get the table
            const rows = table.getElementsByTagName('tr'); // Get all the rows in the table

            // Loop through all table rows (except the header)
            for (let i = 1; i < rows.length; i++) {
                const cells = rows[i].getElementsByTagName('td'); // Get the cells in each row
                let found = false;

                // Check if any cell contains the search term
                for (let j = 0; j < cells.length; j++) {
                    const cell = cells[j];
                    if (cell.textContent.toLowerCase().includes(filter)) {
                        found = true; // If a match is found, mark it as true
                        break;
                    }
                }

                // Show or hide the row based on the search match
                if (found) {
                    rows[i].style.display = ''; // Show row
                } else {
                    rows[i].style.display = 'none'; // Hide row
                }
            }
        }
    </script>

    </html>
