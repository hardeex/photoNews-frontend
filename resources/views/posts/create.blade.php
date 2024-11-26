@extends('dashboard.base')

@section('styles')
    <style>
        .draft-saved {
            animation: fadeOut 2s forwards;
        }


        .ck-editor__editable {
            min-height: 300px;
        }

        .draft-saved {
            animation: fadeOut 2s forwards;
        }

        @keyframes fadeOut {
            0% {
                opacity: 1;
            }

            70% {
                opacity: 1;
            }

            100% {
                opacity: 0;
            }
        }


        @keyframes fadeOut {
            0% {
                opacity: 1;
            }

            70% {
                opacity: 1;
            }

            100% {
                opacity: 0;
            }
        }
    </style>
@endsection

@section('content')
    <div class="container mx-auto px-6 py-8">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-2xl font-semibold">Create New Post</h1>
                <p class="text-sm text-gray-600" id="saveStatus"></p>
            </div>
            <div class="flex gap-4">
                <a href="#" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    My Drafts
                </a>
                <a href="#" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">
                    Back to Posts
                </a>
            </div>
        </div>


        <!--- server feedback to the user -->
        <div class="space-y-4 mb-6">
            @if ($errors->any())
                <div class="bg-red-50 border-l-4 border-red-500 rounded-lg p-4 shadow-sm">
                    <div class="flex items-center mb-2">
                        <svg class="w-5 h-5 text-red-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                                clip-rule="evenodd" />
                        </svg>
                        <h3 class="text-red-800 font-medium">There were some errors with your submission</h3>
                    </div>
                    <ul class="list-disc list-inside text-red-700 space-y-1">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('success'))
                <div class="bg-green-50 border-l-4 border-green-500 rounded-lg p-4 shadow-sm">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                clip-rule="evenodd" />
                        </svg>
                        <p class="text-green-700 font-medium">{{ session('success') }}</p>
                    </div>
                </div>
            @endif
        </div>


        <div class="bg-white rounded-lg shadow-lg p-6">
            <form action="{{ route('posts.submit') }}" method="POST" enctype="multipart/form-data">
                @csrf


                <input type="hidden" name="post_id" id="post_id" value="{{ $post->id ?? '' }}">

                <!-- Title -->
                <div class="mb-6">
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Title *</label>
                    <input type="text" id="title" name="title"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500"
                        value="{{ old('title', $post->title ?? '') }}" required>
                </div>

                <!-- Slug -->
                <div class="mb-6">
                    <label for="slug" class="block text-sm font-medium text-gray-700 mb-2">Slug</label>
                    <input type="text" id="slug" name="slug"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md bg-gray-200 focus:outline-none focus:ring-1 focus:ring-blue-500"
                        value="{{ old('slug', $post->slug ?? '') }}" required>
                </div>


                <div class="mb-6">
                    <label for="categories" class="block text-sm font-medium text-gray-700 mb-2">Categories</label>
                    <div class="relative">
                        <input type="text" id="category_search" placeholder="Search categories..."
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            oninput="filterCategories()">

                        <select id="categories" name="categories[]" class="w-full select2"
                            onchange="handleCategoryChange(this)" required>
                            <option value="">Select a category</option>
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
                </div>



                <!-- Featured Image -->
                {{-- <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Featured Image *</label>
                    <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                        <div class="space-y-1 text-center">
                            <div class="flex text-sm text-gray-600">
                                <label for="featured_image"
                                    class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500">
                                    <span>Upload a file</span>
                                    <input id="featured_image" name="featured_image" type="file" class="sr-only"
                                        accept="image/*" {{ !isset($post) ?: '' }}>
                                </label>
                            </div>
                            <p class="text-xs text-gray-500">PNG, JPG, GIF up to 2MB</p>
                        </div>
                    </div>
                    <div id="image-preview" class="mt-2 {{ isset($post->featured_image) ? '' : 'hidden' }}">
                        @if (isset($post->featured_image))
                            <img src="{{ $post->featured_image }}" alt="Preview" class="max-h-48 rounded">
                        @else
                            <img src="" alt="Preview" class="max-h-48 rounded">
                        @endif
                    </div>
                </div> --}}

                <!-- Featured Image -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Featured Image *</label>
                    <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                        <div class="space-y-1 text-center">
                            <div class="flex text-sm text-gray-600">
                                <label for="featured_image"
                                    class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500">
                                    <span>Upload a file</span>
                                    <input id="featured_image" name="featured_image" type="file" class="sr-only"
                                        accept="image/*">
                                </label>
                            </div>
                            <p class="text-xs text-gray-500">PNG, JPG, GIF up to 2MB</p>
                        </div>
                    </div>

                    <div id="image-preview" class="mt-2 {{ isset($post->featured_image) ? '' : 'hidden' }}">
                        @if (isset($post->featured_image))
                            <img src="{{ $post->featured_image }}" alt="Preview" class="max-h-48 rounded">
                        @else
                            <img src="" alt="Preview" class="max-h-48 rounded">
                        @endif
                    </div>
                </div>



                <!-- Content -->
                <div class="mb-6">
                    <label for="content" class="block text-sm font-medium text-gray-700 mb-2">Content *</label>
                    <textarea id="editor" rows="10" name="content" class="w-full" required>{{ old('content', $post->content ?? '') }}</textarea>

                </div>





                <div class="mb-6">
                    <label for="tags" class="block text-sm font-medium text-gray-700 mb-2">Tags</label>
                    <div class="relative">
                        <input type="text" id="tag_search" placeholder="Search tags..."
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            oninput="filterTags()">

                        <select id="tags" name="tags[]" class="w-full select2" multiple>

                            @forelse ($tags as $tag)
                                <option value="{{ $tag['id'] }}"
                                    {{ old('parent_id') == $tag['id'] ? 'selected' : '' }}>
                                    {{ $tag['name'] }}
                                </option>
                            @empty
                                <option disabled>No tags available</option>
                            @endforelse
                        </select>

                    </div>
                </div>

                <!-- Publishing Options (Admin Only) -->
                <div class="grid grid-cols-1 md:grid-cols-1 gap-6">
                    <div class="p-4 bg-gray-50 rounded-lg">
                        <h3 class="font-medium mb-3">Post Settings</h3>
                        <div class="flex flex-wrap md:flex-nowrap items-center">
                            <div class="flex items-center mr-4">
                                <input type="checkbox" id="is_featured" name="is_featured"
                                    class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                                    value="1" {{ old('is_featured') ? 'checked' : '' }}>
                                <label for="is_featured" class="ml-2 text-sm text-gray-700">Feature this post</label>
                            </div>


                            <div class="flex items-center mr-4">
                                <input type="checkbox" id="is_breaking" name="is_breaking"
                                    class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                                    value="1" {{ old('is_breaking') ? 'checked' : '' }}>
                                <label for="is_breaking" class="ml-2 text-sm text-gray-700">Breaking News</label>
                            </div>

                            <div class="flex items-center mr-4">
                                <input type="checkbox" id="hot_gist" name="hot_gist"
                                    class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                                    value="1" {{ old('hot_gist') ? 'checked' : '' }}>
                                <label for="hot_gist" class="ml-2 text-sm text-gray-700">Hot Gist</label>
                            </div>

                            <div class="flex items-center mr-4">
                                <input type="checkbox" id="event" name="event"
                                    class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                                    value="1" {{ old('event') ? 'checked' : '' }}>
                                <label for="event" class="ml-2 text-sm text-gray-700">Event</label>
                            </div>

                            <div class="flex items-center mr-4">
                                <input type="checkbox" id="top_topic" name="top_topic"
                                    class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                                    value="1" {{ old('top_topic') ? 'checked' : '' }}>
                                <label for="top_topic" class="ml-2 text-sm text-gray-700">Top Topic</label>
                            </div>

                            <div class="flex items-center mr-4">
                                <input type="checkbox" id="is_draft" name="is_draft"
                                    class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50 transition duration-300 ease-in-out hover:bg-blue-50"
                                    value="1" {{ old('is_draft') ? 'checked' : '' }}>
                                <label for="is_draft" class="ml-2 text-sm text-gray-700">Save as Draft</label>
                            </div>


                            <div class="flex items-center mr-4">
                                <input type="checkbox" id="is_scheduled" name="is_scheduled"
                                    class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                                    value="1" {{ old('is_scheduled') ? 'checked' : '' }}>
                                <label for="is_scheduled" class="ml-2 text-sm text-gray-700">Schedule this post</label>
                            </div>

                            <div id="schedule_date" class="mb-6"
                                style="display: {{ old('is_scheduled', $post->is_scheduled ?? false) ? 'block' : 'none' }};">
                                <label for="scheduled_time" class="block text-sm font-medium text-gray-700 mb-2">Scheduled
                                    Date & Time</label>
                                <input type="datetime-local" id="scheduled_time" name="scheduled_time"
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    value="{{ old('scheduled_time', $post->scheduled_time ?? '') }}">
                            </div>




                            <div class="flex items-center mr-4">
                                <input type="checkbox" id="allow_comments" name="allow_comments" value="1"
                                    class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                                    {{ old('allow_comments', $post->allow_comments ?? true) ? 'checked' : '' }}>
                                <label for="allow_comments" class="ml-2 text-sm text-gray-700">Allow Comments</label>
                            </div>

                        </div>


                    </div>
                </div>


                {{-- 
                <div class="mb-6">
                    <label for="meta_title" class="block text-sm font-medium text-gray-700 mb-2">Meta Title</label>
                    <input type="text" id="meta_title" name="meta_title"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        value="{{ old('meta_title', $post->meta_title ?? '') }}">
                </div> --}}

                <div class="mb-6">
                    <label for="meta_title" class="block text-sm font-medium text-gray-700 mb-2">Meta Title</label>
                    <input type="text" id="meta_title" name="meta_title"
                        class="shadow appearance-none border rounded w-full py-3 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline h-14"
                        value="{{ old('meta_title', $post->meta_title ?? '') }}">
                    <p id="char_count" class="text-sm text-gray-500 mt-2">0 / 155 characters</p>
                </div>




                <div class="mb-6">
                    <label for="meta_description" class="block text-sm font-medium text-gray-700 mb-2">Meta
                        Description</label>
                    <textarea id="meta_description" name="meta_description"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        {{ old('meta_description', Str::limit(strip_tags($post->content ?? ''), 155)) }}
                    </textarea>
                </div>
                <!-- End of the publishing option--->

                <!-- Admin Review Section -->
                @if (auth()->check() && auth()->user()->hasRole('admin') && isset($post) && $post->status == 'pending')
                    <div class="mb-6 p-4 bg-yellow-50 rounded-lg">
                        <h3 class="font-medium mb-3">Review Feedback</h3>
                        <textarea name="review_feedback"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500"
                            rows="3" placeholder="Provide feedback for the author (optional)">{{ old('review_feedback', $post->review_feedback ?? '') }}</textarea>
                    </div>
                @endif



                <button
                    class="relative inline-block px-6 py-2 font-semibold text-white bg-gray-800 rounded-lg overflow-hidden group active:bg-transparent">
                    <span
                        class="absolute inset-0 w-full h-full bg-gradient-to-r from-blue-500 via-indigo-600 to-purple-700 transform scale-0 group-active:scale-100 transition-all duration-500 ease-out"></span>
                    Publish
                </button>


            </form>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const metaTitleInput = document.getElementById('meta_title');
            const charCountDisplay = document.getElementById('char_count');
            const maxLength = 155;

            // Initialize with current character count
            charCountDisplay.textContent = `0 / ${maxLength} characters`;

            // Event listener for the input field
            metaTitleInput.addEventListener('input', function() {
                const currentLength = metaTitleInput.value.length;
                const remainingChars = maxLength - currentLength;

                // Update the character count display
                charCountDisplay.textContent = `${currentLength} / ${maxLength} characters`;

                // Provide feedback if the character limit is exceeded
                if (remainingChars < 0) {
                    charCountDisplay.style.color = 'red';
                } else {
                    charCountDisplay.style.color = 'gray';
                }
            });
        });
    </script>


    <script>
        // handling post image upload from the client side
        // document.addEventListener('DOMContentLoaded', function() {
        //     const imageInput = document.getElementById('featured_image');
        //     const imagePreview = document.getElementById('image-preview');

        //     if (imageInput) {
        //         imageInput.addEventListener('change', function() {
        //             const file = this.files[0];

        //             // Validate file size (2MB)
        //             if (file.size > 2 * 1024 * 1024) {
        //                 alert('File size must be less than 2MB');
        //                 this.value = '';
        //                 return;
        //             }

        //             // Validate file type
        //             if (!file.type.match('image.*')) {
        //                 alert('Please upload an image file');
        //                 this.value = '';
        //                 return;
        //             }

        //             if (file) {
        //                 // Show the preview container
        //                 imagePreview.classList.remove('hidden');

        //                 const reader = new FileReader();
        //                 reader.onload = function(event) {
        //                     const previewImg = imagePreview.querySelector('img');
        //                     if (previewImg) {
        //                         previewImg.src = event.target.result;
        //                     }
        //                 };

        //                 reader.readAsDataURL(file);
        //             }
        //         });
        //     }
        // });

        document.addEventListener('DOMContentLoaded', function() {
            const imageInput = document.getElementById('featured_image');
            const imagePreview = document.getElementById('image-preview');

            // If an image is already uploaded (on page load after an error)
            if (imagePreview && imagePreview.querySelector('img').src !== '') {
                imagePreview.classList.remove('hidden');
            }

            if (imageInput) {
                imageInput.addEventListener('change', function() {
                    const file = this.files[0];

                    // Validate file size (2MB)
                    if (file.size > 2 * 1024 * 1024) {
                        alert('File size must be less than 2MB');
                        this.value = ''; // Reset file input
                        return;
                    }

                    // Validate file type
                    if (!file.type.match('image.*')) {
                        alert('Please upload an image file');
                        this.value = ''; // Reset file input
                        return;
                    }

                    if (file) {
                        // Show the preview container
                        imagePreview.classList.remove('hidden');

                        const reader = new FileReader();
                        reader.onload = function(event) {
                            const previewImg = imagePreview.querySelector('img');
                            if (previewImg) {
                                previewImg.src = event.target.result;
                            }
                        };

                        reader.readAsDataURL(file);
                    }
                });
            }
        });
    </script>



    <script>
        // Initialize CKEditor
        let editor;

        ClassicEditor
            .create(document.querySelector('#editor'), {
                toolbar: [
                    'heading', '|',
                    'bold', 'italic', 'underline', '|',
                    'bulletedList', 'numberedList', '|',
                    'blockQuote', '|',
                    'link', 'imageUpload', '|',
                    'undo', 'redo', '|',
                    'insertTable', 'mediaEmbed', '|',
                    'specialCharacters', 'horizontalLine'
                ],
                htmlEncodeOutput: false,
                removePlugins: ['Title'],
                placeholder: 'Start typing your content here...',
                image: {
                    toolbar: [
                        'imageTextAlternative', '|',
                        'imageStyle:alignLeft', 'imageStyle:alignCenter', 'imageStyle:alignRight',
                    ]
                }
            })
            .then(newEditor => {
                editor = newEditor;

                // Add change handler to update hidden textarea
                editor.model.document.on('change:data', () => {
                    document.querySelector('#editor').value = editor.getData();
                    if (editor.getData().trim() !== '') {
                        document.querySelector('#editor').setCustomValidity('');
                    }
                    clearTimeout(autoSaveTimeout);
                    autoSaveTimeout = setTimeout(autoSave, AUTOSAVE_DELAY);
                });

                // Set the editor content to the old content if validation failed
                const oldContent = @json(old('content', ''));
                if (oldContent) {
                    editor.setData(oldContent); // Set CKEditor content with old input
                }

                // Set up auto-save
                let autoSaveTimeout;
                const AUTOSAVE_DELAY = 30000; // 30 seconds

                function autoSave() {
                    const formData = new FormData(document.querySelector('form[action*="posts.store"]'));
                    formData.set('content', editor.getData());
                    formData.set('status', 'draft');

                    fetch(document.querySelector('form[action*="posts.store"]').action, {
                            method: 'POST',
                            body: formData,
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest'
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            const saveStatus = document.querySelector('#saveStatus');
                            if (saveStatus) {
                                saveStatus.textContent = 'Draft auto-saved at ' + new Date().toLocaleTimeString();
                                saveStatus.classList.add('draft-saved');
                            }
                        })
                        .catch(error => {
                            console.error('Auto-save error:', error);
                        });
                }

            })
            .catch(error => {
                console.error('CKEditor initialization failed:', error);
            });
    </script>



    @push('scripts')
        <script>
            // auto generating slug and meta tile from the post title
            document.getElementById('title').addEventListener('input', function() {
                const title = this.value;

                // Update the Meta Title to match the Title
                document.getElementById('meta_title').value = title;

                // Convert the title to slug format
                const slug = title
                    .toLowerCase() // Convert to lowercase
                    .replace(/[^a-z0-9 -]/g, '') // Remove invalid characters
                    .trim() // Trim whitespace
                    .replace(/ - /g, '-') // Replace spaces with hyphens
                    .replace(/ /g, '-') // Replace multiple spaces with a single hyphen
                    .replace(/--+/g, '-') // Replace multiple hyphens with a single hyphen
                    .replace(/^-+|-+$/g, ''); // Remove hyphens from start or end

                document.getElementById('slug').value = slug;
            });
        </script>


        <script>
            // Handling category creation and searching
            function handleCategoryChange(selectElement) {
                // Check if no category is selected
                if (selectElement.value === '') {
                    alert('Please select a category before submitting the form.');
                    return false; // Prevent form submission
                }

                // Check if 'create_new' is selected
                if (selectElement.value === 'create_new') {
                    // Prevent form submission and ask for category creation
                    alert('You must create a category before submitting.');
                    window.location.href = "#"; // Redirect to category creation
                    return false; // Prevent form submission
                }

                // Allow form submission
                return true;
            }

            function filterCategories() {
                const searchInput = document.getElementById('category_search').value.toLowerCase();
                const dropdown = document.getElementById('category_dropdown');
                const options = dropdown.getElementsByClassName('category-option');

                let hasMatches = false;

                for (let option of options) {
                    const optionText = option.textContent.toLowerCase();
                    if (optionText.includes(searchInput)) {
                        option.style.display = '';
                        hasMatches = true;
                    } else {
                        option.style.display = 'none';
                    }
                }

                dropdown.style.display = hasMatches ? 'block' : 'none';
            }

            document.getElementById('category_dropdown').addEventListener('click', function(e) {
                if (e.target.classList.contains('category-option')) {
                    const selectedValue = e.target.getAttribute('data-value');
                    if (selectedValue === 'create_new') {
                        window.location.href = '#';
                    } else {
                        document.getElementById('category_search').value = e.target.textContent;
                        document.getElementById('categories').value = selectedValue; // Set the select value
                    }
                    document.getElementById('category_dropdown').style.display =
                        'none'; // Hide the dropdown after selection
                }
            });

            document.addEventListener('click', function(e) {
                const dropdown = document.getElementById('category_dropdown');
                if (!dropdown.contains(e.target) && e.target.id !== 'category_search' && e.target.id !== 'categories') {
                    dropdown.style.display = 'none';
                }
            });
        </script>


        <script>
            // handling tag creation and search list
            function handleTagChange(selectElement) {
                if (selectElement.value === 'create_new') {
                    window.location.href = "#";
                }
            }

            function filterTags() {
                const searchInput = document.getElementById('tag_search').value.toLowerCase();
                const dropdown = document.getElementById('tag_dropdown');
                const options = dropdown.getElementsByClassName('tag-option');

                let hasMatches = false;

                for (let option of options) {
                    const optionText = option.textContent.toLowerCase();
                    if (optionText.includes(searchInput)) {
                        option.style.display = '';
                        hasMatches = true;
                    } else {
                        option.style.display = 'none';
                    }
                }

                dropdown.style.display = hasMatches ? 'block' : 'none';
            }

            document.getElementById('tag_dropdown').addEventListener('click', function(e) {
                if (e.target.classList.contains('tag-option')) {
                    const selectedValue = e.target.getAttribute('data-value');
                    const selectElement = document.getElementById('tags');

                    if (selectedValue === 'create_new') {
                        window.location.href = '#';
                    } else {
                        // Check if the option is already selected
                        const optionExists = Array.from(selectElement.options).some(option => option.value ===
                            selectedValue);

                        if (!optionExists) {
                            const newOption = new Option(e.target.textContent, selectedValue, true, true);
                            selectElement.add(newOption);
                        } else {
                            // Deselect the option if it's already selected
                            for (let option of selectElement.options) {
                                if (option.value === selectedValue) {
                                    option.selected = false;
                                }
                            }
                        }
                    }
                    document.getElementById('tag_dropdown').style.display = 'none'; // Hide the dropdown after selection
                }
            });

            document.addEventListener('click', function(e) {
                const dropdown = document.getElementById('tag_dropdown');
                if (!dropdown.contains(e.target) && e.target.id !== 'tag_search' && e.target.id !== 'tags') {
                    dropdown.style.display = 'none';
                }
            });
        </script>



        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const scheduledCheckbox = document.getElementById('is_scheduled');
                const scheduleDateDiv = document.getElementById('schedule_date');
                const scheduledTimeInput = document.getElementById('scheduled_time');

                // Toggle visibility of the schedule date input
                scheduledCheckbox.addEventListener('change', function() {
                    scheduleDateDiv.style.display = scheduledCheckbox.checked ? 'block' : 'none';
                });

                // Set the minimum date and time to the current date and time
                const now = new Date();
                const isoString = now.toISOString().slice(0, 16); // Format: YYYY-MM-DDTHH:MM
                scheduledTimeInput.setAttribute('min', isoString);
            });
        </script>
    @endpush
@endsection
