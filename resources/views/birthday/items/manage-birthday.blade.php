<section class="w-full py-6 px-4 sm:px-6 lg:px-8">
    <div class="mb-8">
        <h2 class="text-3xl font-bold text-gray-900 mb-2">🎉 Birthday Posts Manager</h2>
        <p class="text-gray-600">Manage and view all your birthday celebrations</p>
    </div>

    <!-- Success/Error Messages -->
    @if (session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
            {{ session('error') }}
        </div>
    @endif

    @if (!empty($message))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
            {{ $message }}
        </div>
    @endif

    <!-- Stats Cards -->
    @if (!empty($posts['data']))
        @php
            $totalPosts = count($posts['data']);
            $publishedPosts = collect($posts['data'])->where('status', 'published')->count();
            $pendingPosts = collect($posts['data'])->where('status', 'pending')->count();
        @endphp

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white p-6 rounded-lg shadow-sm border">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-blue-100 text-blue-600 mr-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.746 0 3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18c-1.746 0-3.332.477-4.5 1.253">
                            </path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-600">Total Posts</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $totalPosts }}</p>
                    </div>
                </div>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-sm border">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-green-100 text-green-600 mr-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-600">Published</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $publishedPosts }}</p>
                    </div>
                </div>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-sm border">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-yellow-100 text-yellow-600 mr-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-600">Pending</p>
                        <p class="text-2xl font-bold text-gray-900">{{ $pendingPosts }}</p>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Posts Table -->
    <div class="bg-white shadow-sm rounded-lg border overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-200">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between">
                <h3 class="text-lg font-semibold text-gray-900">Birthday Posts</h3>
                <div class="mt-4 sm:mt-0">
                    <a href="{{ route('create.birthday') }}"
                        class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Create New Birthday Post
                    </a>
                </div>
            </div>
        </div>

        @if (!empty($posts['data']) && count($posts['data']) > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Celebrant
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Age
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Created
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Actions
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($posts['data'] as $post)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap" data-label="Celebrant">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10">
                                            @php
                                                $initials = strtoupper(substr($post['title'], 0, 2));
                                                $colors = [
                                                    'from-purple-400 to-pink-400',
                                                    'from-blue-400 to-cyan-400',
                                                    'from-green-400 to-blue-400',
                                                    'from-yellow-400 to-red-400',
                                                    'from-indigo-400 to-purple-400',
                                                ];
                                                $colorClass = $colors[array_rand($colors)];
                                            @endphp
                                            <div
                                                class="h-10 w-10 rounded-full bg-gradient-to-r {{ $colorClass }} flex items-center justify-center text-white font-semibold text-sm">
                                                {{ $initials }}
                                            </div>
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">{{ $post['title'] }}</div>
                                            <div class="text-sm text-gray-500">DOB: {{ $post['dob'] ?? 'N/A' }}</div>
                                        </div>
                                    </div>
                                </td>

                                {{-- <pre>{{ print_r($post) }}</pre>
                                @php
    dd($post);
@endphp
 --}}


                                <td class="px-6 py-4 whitespace-nowrap" data-label="Age">
                                    <div class="text-sm font-semibold text-gray-900">{{ $post['celebrant_age'] }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap" data-label="Status">
                                    <span
                                        class="inline-flex px-2 py-1 text-xs font-semibold rounded-full 
                                        {{ $post['status'] === 'published' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                        {{ ucfirst($post['status']) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500" data-label="Created">
                                    {{ \Carbon\Carbon::parse($post['created_at'])->diffForHumans() }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2"
                                    data-label="Actions">
                                    <button onclick="openModal('modal-{{ $post['id'] }}')"
                                        class="inline-flex items-center px-3 py-1 border border-transparent text-xs font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                                            </path>
                                        </svg>
                                        View
                                    </button>
                                    <a href="#"
                                        class="inline-flex items-center px-3 py-1 border border-transparent text-xs font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                                        <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                            </path>
                                        </svg>
                                        Edit
                                    </a>
                                    @if ($post['status'] === 'pending')
                                        {{-- <a href="{{ route('post.payment.initiate', ['postType' => $post['post_type'], 'slug' => $post['slug']]) }}"
                                            class="inline-flex items-center px-3 py-1 border border-transparent text-xs font-medium rounded-md text-white bg-green-600 hover:bg-green-700">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z">
                                                </path>
                                            </svg>
                                            Pay
                                        </a> --}}
                                        <form action="{{ route('post.payment.initiate', ['postType' => $post['post_type'], 'slug' => $post['slug']]) }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="inline-flex items-center px-3 py-1 border border-transparent text-xs font-medium rounded-md text-white bg-green-600 hover:bg-green-700">
                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z">
                                </path>
                            </svg>
                            Pay
                        </button>
                    </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <!-- Empty State -->
            <div class="text-center py-12">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z">
                    </path>
                </svg>
                <h3 class="mt-2 text-sm font-medium text-gray-900">No birthday posts found</h3>
                <p class="mt-1 text-sm text-gray-500">Get started by creating your first birthday post.</p>
            </div>
        @endif
    </div>

    <!-- Modal Backdrop -->
    <div id="modalBackdrop"
        class="fixed inset-0 bg-black bg-opacity-50 backdrop-blur-sm z-40 hidden transition-opacity duration-300">
    </div>

    <!-- Dynamic Modals -->
    @if (!empty($posts['data']))
        @foreach ($posts['data'] as $post)
            <div id="modal-{{ $post['id'] }}" class="fixed inset-0 z-50 hidden overflow-y-auto">
                <div class="flex items-center justify-center min-h-screen p-4">
                    <div class="bg-white rounded-lg shadow-xl transform transition-all w-full max-w-4xl">
                        <div class="px-6 py-4 border-b border-gray-200">
                            <div class="flex items-center justify-between">
                                <h3 class="text-xl font-semibold text-gray-900">🎂 {{ $post['title'] }} (Age:
                                    {{ $post['celebrant_age'] }})</h3>
                                <button onclick="closeModal('modal-{{ $post['id'] }}')"
                                    class="text-gray-400 hover:text-gray-600 text-2xl font-bold">
                                    &times;
                                </button>
                            </div>
                        </div>

                        <div class="px-6 py-4 max-h-96 overflow-y-auto">
                            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                                <div>
                                    @if ($post['featured_image'])
                                        <img src="{{ $post['featured_image'] }}" alt="Birthday celebration"
                                            class="w-full h-48 object-cover rounded-lg shadow-sm">
                                    @else
                                        <div
                                            class="w-full h-48 bg-gradient-to-r from-purple-400 to-pink-400 rounded-lg shadow-sm flex items-center justify-center">
                                            <div class="text-white text-center">
                                                <svg class="w-12 h-12 mx-auto mb-2" fill="none"
                                                    stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2"
                                                        d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z">
                                                    </path>
                                                </svg>
                                                <p class="text-sm">No Image</p>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <div class="space-y-4">
                                    <div>
                                        <p class="text-sm font-medium text-gray-700">Date of Birth:</p>
                                        <p class="text-sm text-gray-900">{{ $post['dob'] ?? 'N/A' }}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-700">Status:</p>
                                        <span
                                            class="inline-flex px-2 py-1 text-xs font-semibold rounded-full 
                                            {{ $post['status'] === 'published' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                            {{ ucfirst($post['status']) }}
                                        </span>
                                    </div>
                                    @if ($post['gift_suggestions'])
                                        <div>
                                            <p class="text-sm font-medium text-gray-700">Gift Suggestions:</p>
                                            <p class="text-sm text-gray-900">{{ $post['gift_suggestions'] }}</p>
                                        </div>
                                    @endif
                                    @if ($post['event_location'])
                                        <div>
                                            <p class="text-sm font-medium text-gray-700">Event Location:</p>
                                            <p class="text-sm text-gray-900">{{ $post['event_location'] }}</p>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            @if ($post['content'])
                                <div class="mt-6">
                                    <p class="text-sm font-medium text-gray-700 mb-2">Birthday Message:</p>
                                    <div class="prose prose-sm max-w-none bg-gray-50 p-4 rounded-lg">
                                        {!! $post['content'] !!}
                                    </div>
                                </div>
                            @endif

                            <p class="mt-4 text-xs text-gray-500">Created:
                                {{ \Carbon\Carbon::parse($post['created_at'])->toDayDateTimeString() }}</p>
                        </div>

                        <div class="px-6 py-4 border-t border-gray-200 flex justify-end space-x-3">
                            <a href="#"
                                class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 rounded-md hover:bg-gray-200">
                                Edit Post
                            </a>
                            @if ($post['status'] === 'pending')
                                {{-- <a href="{{ route('birthday.pay', $post['slug']) }}"
                                    class="px-4 py-2 text-sm font-medium text-white bg-green-600 rounded-md hover:bg-green-700">
                                    Make Payment
                                </a> --}}
                                <form action="{{ route('post.payment.initiate', ['postType' => $post['post_type'], 'slug' => $post['slug']]) }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="inline-flex items-center px-3 py-1 border border-transparent text-xs font-medium rounded-md text-white bg-green-600 hover:bg-green-700">
                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z">
                                </path>
                            </svg>
                            Pay
                        </button>
                    </form>
                            @endif
                            <button onclick="closeModal('modal-{{ $post['id'] }}')"
                                class="px-4 py-2 text-sm font-medium text-white bg-gray-600 rounded-md hover:bg-gray-700">
                                Close
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endif
</section>

<script>
    // Modal functionality
    function openModal(modalId) {
        const modal = document.getElementById(modalId);
        const backdrop = document.getElementById('modalBackdrop');

        if (modal && backdrop) {
            backdrop.classList.remove('hidden');
            modal.classList.remove('hidden');

            // Add show class for animations
            setTimeout(() => {
                backdrop.classList.add('opacity-100');
                modal.querySelector('.bg-white').classList.add('scale-100');
            }, 10);

            // Prevent body scroll
            document.body.style.overflow = 'hidden';

            // Focus trap
            modal.focus();
        }
    }

    function closeModal(modalId) {
        const modal = document.getElementById(modalId);
        const backdrop = document.getElementById('modalBackdrop');

        if (modal && backdrop) {
            // Remove show classes
            backdrop.classList.remove('opacity-100');
            modal.querySelector('.bg-white').classList.remove('scale-100');

            // Hide after animation
            setTimeout(() => {
                backdrop.classList.add('hidden');
                modal.classList.add('hidden');
            }, 300);

            // Restore body scroll
            document.body.style.overflow = '';
        }
    }

    // Close modal when clicking backdrop
    document.getElementById('modalBackdrop')?.addEventListener('click', function() {
        const visibleModal = document.querySelector('[id^="modal-"]:not(.hidden)');
        if (visibleModal) {
            closeModal(visibleModal.id);
        }
    });

    // Close modal with Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            const visibleModal = document.querySelector('[id^="modal-"]:not(.hidden)');
            if (visibleModal) {
                closeModal(visibleModal.id);
            }
        }
    });
</script>

<style>
    .modal {
        transition: all 0.3s ease;
    }

    .modal .bg-white {
        transform: scale(0.95);
        transition: transform 0.3s ease;
    }

    .modal .bg-white.scale-100 {
        transform: scale(1);
    }

    #modalBackdrop {
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    #modalBackdrop.opacity-100 {
        opacity: 1;
    }

    /* Responsive table */
    @media (max-width: 640px) {

        table,
        thead,
        tbody,
        th,
        td,
        tr {
            display: block;
        }

        thead tr {
            position: absolute;
            top: -9999px;
            left: -9999px;
        }

        tr {
            border: 1px solid #ccc;
            margin-bottom: 10px;
            padding: 10px;
            border-radius: 8px;
            background: white;
        }

        td {
            border: none;
            position: relative;
            padding-left: 50% !important;
            padding-top: 8px;
            padding-bottom: 8px;
        }

        td:before {
            content: attr(data-label);
            position: absolute;
            left: 6px;
            width: 45%;
            padding-right: 10px;
            white-space: nowrap;
            font-weight: 600;
            color: #374151;
        }
    }
</style>
