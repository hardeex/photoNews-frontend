<div class="container mx-auto px-4 py-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold text-gray-800">Pending Posts</h1>

        <div class="flex space-x-4">
            {{-- Search Input --}}
            <div class="relative">
                <input type="text" id="post-search" placeholder="Search posts..."
                    class="pl-10 pr-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 transition-all w-64">
                <svg xmlns="http://www.w3.org/2000/svg" class="absolute left-3 top-3 text-gray-400 h-5 w-5"
                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>

            {{-- Status Filter --}}
            <select id="status-filter" name="status"
                class="px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500">
                <option value="">All Statuses</option>
                <option value="pending">Pending</option>
                <option value="draft">Draft</option>
                <option value="scheduled">Scheduled</option>
            </select>
        </div>
    </div>

    @if (empty($postsData))
        <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded-lg">
            <p>No pending posts found.</p>
        </div>
    @else
        <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200" id="posts-table">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Title
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Categories</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tags
                        </th>
                        {{-- <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Status</th> --}}
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Scheduled Time</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Created At</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200" id="posts-body">
                    @foreach ($postsData as $post)
                        <tr class="hover:bg-gray-50 transition-colors duration-200"
                            data-status="{{ strtolower($post['status'] ?? '') }}"
                            data-title="{{ strtolower($post['title'] ?? '') }}"
                            data-categories="{{ strtolower($post['category_names'] ?? '') }}"
                            data-tags="{{ strtolower($post['tag_names'] ?? '') }}">
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $post['id'] ?? 'N/A' }}
                            </td>
                            {{-- <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                <a href="{{ route('post.details', $post['slug'] ?? '#') }}"
                                    class="hover:text-blue-600 transition-colors">
                                    {{ $post['title'] ?? 'Untitled' }}
                                </a>
                            </td> --}}

                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                <a href="{{ route('post.details', $post['slug'] ?? '#') }}"
                                    class="hover:text-blue-600 transition-colors truncate w-full">
                                    {{ \Illuminate\Support\Str::words($post['title'] ?? 'Untitled', 3, '...') }}
                                </a>
                            </td>



                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $post['category_names'] ?? 'N/A' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $post['tag_names'] ?? 'N/A' }}</td>
                            {{-- <td class="px-6 py-4 whitespace-nowrap">
                                <span
                                    class="
                                    px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    {{ isset($post['status']) && $post['status'] == 'pending'
                                        ? 'bg-yellow-100 text-yellow-800'
                                        : (isset($post['status']) && $post['status'] == 'draft'
                                            ? 'bg-gray-100 text-gray-800'
                                            : 'bg-green-100 text-green-800') }}
                                ">
                                    {{ ucfirst($post['status'] ?? 'Unknown') }}
                                </span>
                            </td> --}}
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ isset($post['scheduled_time']) ? \Carbon\Carbon::parse($post['scheduled_time'])->format('d M Y H:i') : 'N/A' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ isset($post['created_at']) ? \Carbon\Carbon::parse($post['created_at'])->format('d M Y H:i') : 'N/A' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <div class="flex space-x-2">
                                    {{-- View Details --}}
                                    <a href="{{ route('post.details', $post['slug'] ?? '#') }}"
                                        class="text-blue-500 hover:text-blue-700 transition-colors" title="View Details"
                                        target="_blank">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                            fill="currentColor">
                                            <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                            <path fill-rule="evenodd"
                                                d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </a>

                                    {{-- Approve Post --}}
                                    <form action="{{ route('admin.approve-post', ['slug' => $post['slug']]) }}"
                                        method="POST" class="inline">
                                        @csrf

                                        <button type="submit"
                                            class="text-green-500 hover:text-green-700 transition-colors"
                                            title="Approve Post"
                                            onclick="return confirm('Are you sure you want to approve this post?')">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20"
                                                fill="currentColor">
                                                <path fill-rule="evenodd"
                                                    d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </form>

                                    {{-- Delete Post --}}
                                    <form action="{{ route('admin.delete-post', ['slug' => $post['slug']]) }}"
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
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if (isset($pagination) && $pagination['total'] > 0 && $pagination['last_page'] > 1)
            <div class="flex justify-center mt-6">
                <nav aria-label="Pagination" class="flex space-x-2">
                    @if ($pagination['prev_page_url'])
                        <a href="{{ $pagination['prev_page_url'] }}"
                            class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-100">
                            Previous
                        </a>
                    @endif

                    @for ($i = 1; $i <= $pagination['last_page']; $i++)
                        <a href="{{ str_replace('page=1', "page={$i}", $pagination['next_page_url']) }}"
                            class="px-4 py-2 text-sm font-medium {{ $i == $pagination['current_page'] ? 'bg-blue-500 text-white' : 'text-gray-700 bg-white hover:bg-gray-100' }} border border-gray-300 rounded-lg">
                            {{ $i }}
                        </a>
                    @endfor

                    @if ($pagination['next_page_url'])
                        <a href="{{ $pagination['next_page_url'] }}"
                            class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-100">
                            Next
                        </a>
                    @endif
                </nav>
            </div>
        @endif
    @endif
</div>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        const searchInput = document.getElementById('post-search');
        const statusFilter = document.getElementById('status-filter');

        function applyStatusFilter() {
            const statusTerm = statusFilter.value.toLowerCase();

            // If a status is selected, perform client-side filtering
            if (statusTerm) {
                const tableRows = document.querySelectorAll('#posts-body tr');
                tableRows.forEach(row => {
                    const status = row.dataset.status;
                    row.style.display = (statusTerm === '' || status === statusTerm) ? '' : 'none';
                });
            }
        }

        function applySearchFilter() {
            const searchTerm = searchInput.value.toLowerCase();
            const tableRows = document.querySelectorAll('#posts-body tr');

            tableRows.forEach(row => {
                const title = row.dataset.title;
                const categories = row.dataset.categories;
                const tags = row.dataset.tags;

                const matchesSearch =
                    title.includes(searchTerm) ||
                    categories.includes(searchTerm) ||
                    tags.includes(searchTerm);

                row.style.display = matchesSearch ? '' : 'none';
            });
        }

        searchInput.addEventListener('input', applySearchFilter);
        statusFilter.addEventListener('change', applyStatusFilter);
    });
</script>
