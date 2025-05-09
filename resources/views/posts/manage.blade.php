<div class="max-w-7xl mx-auto p-6 bg-white rounded-lg shadow-sm">
    @if (session('error'))
        <div class="p-4 mb-4 text-red-700 bg-red-100 rounded-lg">
            {{ session('error') }}
        </div>
    @endif

    @if (isset($message))
        <div class="p-4 mb-4 text-green-700 bg-green-100 rounded-lg">
            {{ $message }}
        </div>
    @endif

    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Manage Posts</h1>
        <div class="relative">
            <input type="search" id="search" placeholder="Search posts..."
                class="pl-10 pr-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
            <svg class="w-5 h-5 text-gray-400 absolute left-3 top-2.5" fill="none" stroke="currentColor"
                viewBox="0 0 24 24">
                <path d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" stroke-linecap="round" stroke-linejoin="round"
                    stroke-width="2" />
            </svg>
        </div>
    </div>

    <form id="filterForm" class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
        <div class="space-y-1">
            <label for="status" class="text-sm font-medium text-gray-700">Filter by Status</label>
            <select name="status" id="status" class="w-full border rounded-lg p-2 focus:ring-2 focus:ring-blue-500">
                <option value="all">All Posts</option>
                <option value="published">Published</option>
                <option value="draft">Drafts</option>
                <option value="scheduled">Scheduled</option>
            </select>
        </div>
        <div class="space-y-1">
            <label for="per_page" class="text-sm font-medium text-gray-700">Posts per Page</label>
            <select name="per_page" id="per_page"
                class="w-full border rounded-lg p-2 focus:ring-2 focus:ring-blue-500">
                <option value="10">10 per page</option>
                <option value="20">20 per page</option>
                <option value="50">50 per page</option>
            </select>
        </div>
    </form>

    @if (isset($posts['data']) && count($posts['data']) > 0)
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">S/N
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Category</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Scheduled Time</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Stats
                        </th>
                        <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($posts['data'] as $index => $post)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $posts['from'] + $index }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="font-medium text-gray-900 capitalize">{{ $post['title'] }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $post['category_names'] }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @php
                                    $statusClass = $post['is_draft']
                                        ? 'bg-yellow-100 text-yellow-800'
                                        : ($post['is_scheduled']
                                            ? 'bg-blue-100 text-blue-800'
                                            : 'bg-green-100 text-green-800');
                                    $status = $post['is_draft']
                                        ? 'Draft'
                                        : ($post['is_scheduled']
                                            ? 'Scheduled'
                                            : 'Published');
                                @endphp
                                <span
                                    class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $statusClass }}">
                                    {{ $status }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $post['scheduled_time'] ? date('M d, Y H:i', strtotime($post['scheduled_time'])) : 'N/A' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <div class="flex space-x-4">
                                    <span title="Views">👁 {{ $post['views'] }}</span>
                                    <span title="Shares">🔄 {{ $post['shares'] }}</span>
                                    <span title="Likes">👍 {{ $post['likes'] }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-2">
                                <a href="{{ route('post.details', $post['slug'] ?? '#') }}" target="_blank"
                                    class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-md text-white bg-gray-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    View
                                </a>

                                {{-- <a href="{{ isset($post['slug']) ? route('edit-posts', ['slug' => $post['slug']]) : '#' }}"
                                    class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    Edit  {{ route('edit-posts', ['slug' => $post['slug']]) }}
                                </a> --}}

                                {{-- <form action="" method="GET" style="display:inline;">
                                    @csrf --}}
                                <a href="{{ route('fetch.post.edit', ['slug' => $post['slug']]) }}"
                                    class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                    Edit
                                </a>
                                {{-- </form> --}}


                                {{-- <form action="{{ route('admin.delete-post', ['slug' => $post['slug']]) }}"
                                    method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700 transition-colors"
                                        title="Delete Post"
                                        onclick="return confirm('Are you sure you want to delete this post?')">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                            fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </form> --}}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        <div class="mt-4 flex justify-between items-center">
            <div class="text-sm text-gray-600">
                Showing {{ $posts['from'] }} to {{ $posts['to'] }} of {{ $posts['total'] }} posts
            </div>
            <div class="flex space-x-4">
                @if ($posts['prev_page_url'])
                    <a href="{{ $posts['prev_page_url'] }}"
                        class="px-3 py-2 bg-gray-200 rounded-md hover:bg-gray-300">Previous</a>
                @endif

                @if ($posts['next_page_url'])
                    <a href="{{ $posts['next_page_url'] }}"
                        class="px-3 py-2 bg-gray-200 rounded-md hover:bg-gray-300">Next</a>
                @endif
            </div>
        </div>
    @else
        <div class="text-center py-8 text-gray-500">
            No posts found.
        </div>
    @endif
</div>

<script>
    function deletePost(postId) {
        if (confirm('Are you sure you want to delete this post?')) {
            // Implement your delete logic here
        }
    }
</script>

<script>
    // Get the necessary elements
    const searchInput = document.getElementById('search');
    const statusSelect = document.getElementById('status');
    const tableBody = document.querySelector('tbody');
    const noPostsDiv = document.querySelector('.text-center.py-8');

    // Store the original table rows for filtering
    let originalRows = Array.from(tableBody.querySelectorAll('tr'));

    // Function to filter posts based on search input and status
    function filterPosts() {
        const searchTerm = searchInput.value.toLowerCase();
        const selectedStatus = statusSelect.value;

        // Hide the table and show "No posts found" if there are no rows
        const table = tableBody.closest('table');
        const paginationDiv = document.querySelector('.mt-4.flex.justify-between');

        // Filter the rows based on search term and status
        const filteredRows = originalRows.filter(row => {
            const title = row.querySelector('td:nth-child(2)').textContent.toLowerCase();
            const status = row.querySelector('td:nth-child(4)').textContent.trim();

            const matchesSearch = title.includes(searchTerm);
            const matchesStatus = selectedStatus === 'all' || status.toLowerCase() === selectedStatus
                .toLowerCase();

            return matchesSearch && matchesStatus;
        });

        // Clear the current table body
        tableBody.innerHTML = '';

        // Add filtered rows back to the table
        filteredRows.forEach(row => {
            tableBody.appendChild(row.cloneNode(true));
        });

        // Show/hide table and no posts message based on results
        if (filteredRows.length === 0) {
            if (table) table.style.display = 'none';
            if (paginationDiv) paginationDiv.style.display = 'none';
            if (!noPostsDiv) {
                const newNoPostsDiv = document.createElement('div');
                newNoPostsDiv.className = 'text-center py-8 text-gray-500';
                newNoPostsDiv.textContent = 'No posts found.';
                table.parentNode.appendChild(newNoPostsDiv);
            } else {
                noPostsDiv.style.display = 'block';
            }
        } else {
            if (table) table.style.display = 'table';
            if (paginationDiv) paginationDiv.style.display = 'flex';
            if (noPostsDiv) noPostsDiv.style.display = 'none';
        }
    }

    // Add event listeners for real-time filtering
    searchInput.addEventListener('input', filterPosts);
    statusSelect.addEventListener('change', filterPosts);

    // Initial store of original rows when the page loads
    document.addEventListener('DOMContentLoaded', () => {
        originalRows = Array.from(tableBody.querySelectorAll('tr'));
    });
</script>
