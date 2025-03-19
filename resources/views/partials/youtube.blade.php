<div class="container mx-auto py-6 px-4">
    <div class="flex flex-col lg:flex-row gap-6">
        {{-- @include('feedback') --}}
        <!-- Main Form Column -->
        <div class="lg:w-2/3 w-full">
            <!-- Main Form Card -->
            <div
                class="bg-white rounded-xl shadow-lg overflow-hidden mb-6 transition-transform duration-300 hover:shadow-xl">
                <div class="bg-gradient-to-r from-blue-600 to-blue-800 p-5">
                    <div class="flex items-center">
                        <i class="fab fa-youtube text-3xl text-white mr-3"></i>
                        <h3 class="text-xl font-bold text-white m-0">Add YouTube Video</h3>
                    </div>
                </div>
                <div class="p-6">
                    <form action="{{ route('submit-youtube-link') }}" method="POST">
                        @csrf

                        @if (session('success'))
                            <div class="bg-green-50 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded shadow-sm"
                                role="alert">
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <i class="fas fa-check-circle mt-1"></i>
                                    </div>
                                    <div class="ml-3">
                                        <p class="font-bold">Success!</p>
                                        <p>{{ session('success') }}</p>
                                    </div>
                                    <div class="ml-auto">
                                        <button type="button" class="text-green-700" data-dismiss-target="alert">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if ($errors->any())
                            <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 mb-6 rounded shadow-sm">
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <i class="fas fa-exclamation-triangle mt-1"></i>
                                    </div>
                                    <div class="ml-3">
                                        <p class="font-bold">Please correct the following errors:</p>
                                        <ul class="mt-2 list-disc list-inside">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <div class="grid md:grid-cols-3 gap-6 mb-6">
                            <div class="md:col-span-2">
                                <label for="title" class="block text-gray-700 font-semibold mb-2">Video Title</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                        <i class="fas fa-heading text-gray-400"></i>
                                    </div>
                                    <input type="text" id="title" name="title"
                                        class="pl-10 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                                        value="{{ old('title') }}" required placeholder="Enter video title">
                                </div>
                                <p class="mt-1 text-sm text-gray-500">Choose a descriptive title for better
                                    searchability</p>
                            </div>

                            <div>
                                <label for="category" class="block text-gray-700 font-semibold mb-2">Category</label>
                                <select id="category" name="category"
                                    class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                    <option value="">Select category</option>
                                    <option value="news" {{ old('category') == 'news' ? 'selected' : '' }}>News
                                    </option>
                                    <option value="tutorials" {{ old('category') == 'tutorials' ? 'selected' : '' }}>
                                        Tutorials</option>
                                    <option value="entertainment"
                                        {{ old('category') == 'entertainment' ? 'selected' : '' }}>Entertainment
                                    </option>
                                    <option value="educational"
                                        {{ old('category') == 'educational' ? 'selected' : '' }}>Educational</option>
                                    <option value="other" {{ old('category') == 'other' ? 'selected' : '' }}>Other
                                    </option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-6">
                            <label for="youtube_link" class="block text-gray-700 font-semibold mb-2">YouTube
                                Link</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <i class="fab fa-youtube text-red-500"></i>
                                </div>
                                <input type="url" id="youtube_link" name="youtube_url"
                                    class="pl-10 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                                    placeholder="https://www.youtube.com/watch?v=..." value="{{ old('youtube_link') }}"
                                    required>
                            </div>
                            <p class="mt-1 text-sm text-gray-500">Paste the full YouTube video URL from the address bar
                            </p>
                        </div>

                        <div class="mb-6">
                            <label for="description" class="block text-gray-700 font-semibold mb-2">Description</label>
                            <textarea id="description" name="description" rows="4"
                                class="block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                                placeholder="Enter video description">{{ old('description') }}</textarea>
                        </div>

                        <div class="flex flex-wrap items-center justify-between mb-2">
                            <div class="flex items-center mb-4 md:mb-0">
                                <div class="flex items-center h-5">
                                    <input id="featured" name="featured" type="checkbox" value="1"
                                        {{ old('featured') ? 'checked' : '' }}
                                        class="w-5 h-5 rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                                </div>
                                <div class="ml-3">
                                    <label for="featured" class="font-medium text-gray-700">Feature this video</label>
                                    <p class="text-sm text-gray-500">Featured videos appear on the homepage</p>
                                </div>
                            </div>
                            <button type="submit"
                                class="px-5 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg text-sm flex items-center transition-colors duration-300">
                                <i class="fas fa-plus-circle mr-2"></i>Add Video
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Video Preview Card -->
            <div
                class="bg-white rounded-xl shadow-lg overflow-hidden mb-6 transition-transform duration-300 hover:shadow-xl">
                <div class="bg-gray-800 text-white p-4">
                    <div class="flex items-center">
                        <i class="fas fa-film mr-2"></i>
                        <h5 class="text-lg font-semibold m-0">Video Preview</h5>
                    </div>
                </div>
                <div class="youtube-preview">
                    <div id="preview-placeholder" class="text-center p-12 bg-gray-100">
                        <i class="fas fa-film text-5xl text-gray-400 mb-4"></i>
                        <h5 class="text-gray-500 text-lg font-medium">Enter a YouTube URL to see preview</h5>
                    </div>
                    <div id="youtube-embed" class="hidden">
                        <div class="aspect-w-16 aspect-h-9">
                            <iframe id="youtube-iframe" src="" title="YouTube video" class="w-full h-full"
                                allowfullscreen></iframe>
                        </div>
                        <div class="p-5">
                            <h4 id="preview-title" class="text-xl font-bold mb-2"></h4>
                            <p id="preview-description" class="text-gray-600 mb-4"></p>
                            <div class="flex items-center text-sm text-gray-500">
                                <div class="flex items-center">
                                    <i class="fas fa-tag mr-1"></i>
                                    <span id="preview-category">Category: <span class="font-semibold">Not
                                            selected</span></span>
                                </div>
                                <div class="ml-auto flex items-center">
                                    <i class="fas fa-star mr-1"></i>
                                    <span id="preview-featured">Not featured</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar Column -->
        <div class="lg:w-1/3 w-full">
            <!-- Tips Card -->
            <div
                class="bg-white rounded-xl shadow-lg overflow-hidden mb-6 transition-transform duration-300 hover:shadow-xl">
                <div class="bg-gradient-to-r from-cyan-500 to-blue-500 p-4">
                    <div class="flex items-center">
                        <i class="fas fa-lightbulb text-white mr-2"></i>
                        <h5 class="text-lg font-semibold text-white m-0">Tips for Better Videos</h5>
                    </div>
                </div>
                <div class="bg-blue-50 p-4">
                    <p class="text-sm text-blue-600">Follow these tips to make your video submissions more effective:
                    </p>
                </div>
                <ul class="divide-y divide-gray-200">
                    <li class="p-4 hover:bg-gray-50">
                        <div class="flex">
                            <div class="flex-shrink-0 text-green-500">
                                <i class="fas fa-check-circle text-xl"></i>
                            </div>
                            <div class="ml-4">
                                <h6 class="font-semibold">Use complete URLs</h6>
                                <p class="text-sm text-gray-600">Copy the full YouTube link from your browser's address
                                    bar</p>
                            </div>
                        </div>
                    </li>
                    <li class="p-4 hover:bg-gray-50">
                        <div class="flex">
                            <div class="flex-shrink-0 text-green-500">
                                <i class="fas fa-check-circle text-xl"></i>
                            </div>
                            <div class="ml-4">
                                <h6 class="font-semibold">Write compelling titles</h6>
                                <p class="text-sm text-gray-600">Clear, descriptive titles improve searchability</p>
                            </div>
                        </div>
                    </li>
                    <li class="p-4 hover:bg-gray-50">
                        <div class="flex">
                            <div class="flex-shrink-0 text-green-500">
                                <i class="fas fa-check-circle text-xl"></i>
                            </div>
                            <div class="ml-4">
                                <h6 class="font-semibold">Choose the right category</h6>
                                <p class="text-sm text-gray-600">Proper categorization helps users find relevant
                                    content</p>
                            </div>
                        </div>
                    </li>
                    <li class="p-4 hover:bg-gray-50">
                        <div class="flex">
                            <div class="flex-shrink-0 text-green-500">
                                <i class="fas fa-check-circle text-xl"></i>
                            </div>
                            <div class="ml-4">
                                <h6 class="font-semibold">Add detailed descriptions</h6>
                                <p class="text-sm text-gray-600">Descriptions provide context and improve SEO</p>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>

            <!-- Recent Videos Card -->
            {{-- <div
                class="bg-white rounded-xl shadow-lg overflow-hidden transition-transform duration-300 hover:shadow-xl">
                <div class="bg-gradient-to-r from-green-500 to-emerald-600 p-4">
                    <div class="flex items-center">
                        <i class="fas fa-history text-white mr-2"></i>
                        <h5 class="text-lg font-semibold text-white m-0">Recently Added Videos</h5>
                    </div>
                </div>
                <ul class="divide-y divide-gray-200">
                    @forelse ($recentVideos ?? [] as $video)
                        <li class="p-4 hover:bg-gray-50">
                            <div class="flex">
                                <div class="flex-shrink-0 relative mr-3">
                                    <div
                                        class="bg-gray-900 rounded overflow-hidden w-20 h-12 flex items-center justify-center">
                                        <i class="fas fa-play text-white"></i>
                                    </div>
                                    @if ($video->featured)
                                        <span
                                            class="absolute -top-2 -left-2 bg-red-500 text-white rounded-full w-5 h-5 flex items-center justify-center text-xs">
                                            <i class="fas fa-star"></i>
                                        </span>
                                    @endif
                                </div>
                                <div>
                                    <h6 class="font-semibold truncate max-w-xs">{{ $video->title }}</h6>
                                    <div class="flex items-center text-xs text-gray-500 mt-1">
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                            {{ $video->category == 'news'
                                                ? 'bg-blue-100 text-blue-800'
                                                : ($video->category == 'tutorials'
                                                    ? 'bg-purple-100 text-purple-800'
                                                    : 'bg-gray-100 text-gray-800') }} mr-2">
                                            {{ ucfirst($video->category) }}
                                        </span>
                                        <span class="flex items-center">
                                            <i class="far fa-clock mr-1"></i>
                                            {{ $video->created_at->diffForHumans() }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </li>
                    @empty
                        <li class="py-12 text-center">
                            <div>
                                <i class="fas fa-video text-4xl text-gray-300 mb-3"></i>
                                <h5 class="text-gray-500 font-medium">No videos added yet</h5>
                                <p class="text-sm text-gray-400 mt-1">Videos you add will appear here</p>
                            </div>
                        </li>
                    @endforelse
                </ul>
                @if (!empty($recentVideos) && count($recentVideos) > 0)
                    <div class="p-4 bg-gray-50 border-t border-gray-200">
                        <a href="{{ route('youtube.index') }}"
                            class="block w-full py-2 px-4 bg-green-100 hover:bg-green-200 text-green-700 text-center rounded-md font-medium transition-colors duration-300">
                            <i class="fas fa-th-list mr-2"></i>View All Videos
                        </a>
                    </div>
                @endif
            </div> --}}

            <div
                class="bg-white rounded-xl shadow-lg overflow-hidden transition-transform duration-300 hover:shadow-xl">
                <div class="bg-gradient-to-r from-green-500 to-emerald-600 p-4">
                    <div class="flex items-center">
                        <i class="fas fa-history text-white mr-2"></i>
                        <h5 class="text-lg font-semibold text-white m-0">Recently Added Videos</h5>
                    </div>
                </div>
                <ul class="divide-y divide-gray-200">
                    @forelse ($videos as $video)
                        <li class="p-4 hover:bg-gray-50">
                            <div class="flex" onclick="openModal('{{ $video['video_url'] }}')">
                                <div class="flex-shrink-0 relative mr-3">
                                    <div
                                        class="bg-gray-900 rounded overflow-hidden w-20 h-12 flex items-center justify-center">
                                        <i class="fas fa-play text-white"></i>
                                    </div>
                                    @if ($video['featured'])
                                        <span
                                            class="absolute -top-2 -left-2 bg-red-500 text-white rounded-full w-5 h-5 flex items-center justify-center text-xs">
                                            <i class="fas fa-star"></i>
                                        </span>
                                    @endif
                                </div>
                                <div>
                                    <h6 class="font-semibold truncate max-w-xs">{{ $video['title'] }}</h6>
                                    <div class="flex items-center text-xs text-gray-500 mt-1">
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                {{ $video['category'] == 'news'
                                    ? 'bg-blue-100 text-blue-800'
                                    : ($video['category'] == 'tutorials'
                                        ? 'bg-purple-100 text-purple-800'
                                        : 'bg-gray-100 text-gray-800') }} mr-2">
                                            {{ ucfirst($video['category']) }}
                                        </span>
                                        <span class="flex items-center">
                                            <i class="far fa-clock mr-1"></i>
                                            {{ \Carbon\Carbon::parse($video['created_at'])->diffForHumans() }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </li>
                    @empty
                        <li class="py-12 text-center">
                            <div>
                                <i class="fas fa-video text-4xl text-gray-300 mb-3"></i>
                                <h5 class="text-gray-500 font-medium">No videos added yet</h5>
                                <p class="text-sm text-gray-400 mt-1">Videos you add will appear here</p>
                            </div>
                        </li>
                    @endforelse
                </ul>
                @if (!empty($videos) && count($videos) > 0)
                    <div class="p-4 bg-gray-50 border-t border-gray-200">
                        <a href="#"
                            class="block w-full py-2 px-4 bg-green-100 hover:bg-green-200 text-green-700 text-center rounded-md font-medium transition-colors duration-300">
                            <i class="fas fa-th-list mr-2"></i>View All Videos
                        </a>
                    </div>
                @endif
            </div>

            <!-- Modal (Hidden by default) -->
            <div id="videoModal" class="fixed inset-0 bg-black bg-opacity-50 hidden justify-center items-center z-50">
                <div class="bg-white rounded-xl w-4/5 md:w-3/5 lg:w-2/5 p-4">
                    <div class="flex justify-end">
                        <button id="closeModal" class="text-gray-500 hover:text-gray-700 text-2xl">&times;</button>
                    </div>
                    <div class="relative pt-56.25%"> <!-- Aspect ratio 16:9 -->
                        <iframe id="modalVideo" class="absolute top-0 left-0 w-full h-full" frameborder="0"
                            allowfullscreen></iframe>
                    </div>
                </div>
            </div>
            <script>
                function openModal(videoUrl) {
                    // Open the modal and set the video URL to iframe
                    document.getElementById('videoModal').classList.remove('hidden');
                    document.getElementById('modalVideo').src = videoUrl;
                }

                // Close modal event
                document.getElementById('closeModal').addEventListener('click', function() {
                    document.getElementById('videoModal').classList.add('hidden');
                    document.getElementById('modalVideo').src = ''; // Stop video when closing
                });
            </script>


        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const linkInput = document.getElementById('youtube_link');
        const titleInput = document.getElementById('title');
        const descInput = document.getElementById('description');
        const categorySelect = document.getElementById('category');
        const featuredCheckbox = document.getElementById('featured');

        const previewPlaceholder = document.getElementById('preview-placeholder');
        const youtubeEmbed = document.getElementById('youtube-embed');
        const youtubeIframe = document.getElementById('youtube-iframe');
        const previewTitle = document.getElementById('preview-title');
        const previewDesc = document.getElementById('preview-description');
        const previewCategory = document.getElementById('preview-category');
        const previewFeatured = document.getElementById('preview-featured');

        // Function to update preview
        function updatePreview() {
            const youtubeUrl = linkInput.value.trim();
            const youtubeID = extractYoutubeId(youtubeUrl);

            if (youtubeID) {
                // Show preview
                previewPlaceholder.style.display = 'none';
                youtubeEmbed.style.display = 'block';
                youtubeIframe.src = `https://www.youtube.com/embed/${youtubeID}`;

                // Update preview details
                previewTitle.textContent = titleInput.value || 'Video Title';
                previewDesc.textContent = descInput.value || 'No description provided';

                // Update category
                const selectedCategory = categorySelect.options[categorySelect.selectedIndex].text;
                previewCategory.innerHTML =
                    `Category: <span class="font-semibold">${selectedCategory !== 'Select category' ? selectedCategory : 'Not selected'}</span>`;

                // Update featured status
                if (featuredCheckbox.checked) {
                    previewFeatured.innerHTML = '<span class="text-yellow-500 font-semibold">Featured</span>';
                } else {
                    previewFeatured.textContent = 'Not featured';
                }
            } else {
                // Invalid or empty YouTube URL
                previewPlaceholder.style.display = 'block';
                youtubeEmbed.style.display = 'none';
            }
        }

        // Event listeners
        linkInput.addEventListener('input', updatePreview);
        titleInput.addEventListener('input', updatePreview);
        descInput.addEventListener('input', updatePreview);
        categorySelect.addEventListener('change', updatePreview);
        featuredCheckbox.addEventListener('change', updatePreview);

        // Function to extract YouTube ID from various URL formats
        function extractYoutubeId(url) {
            if (!url) return null;

            const regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=)([^#\&\?]*).*/;
            const match = url.match(regExp);
            return (match && match[2].length === 11) ? match[2] : null;
        }

        // Initialize preview on page load
        updatePreview();
    });
</script>
