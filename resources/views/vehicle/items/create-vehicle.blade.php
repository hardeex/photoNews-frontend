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
                <h1 class="text-2xl font-semibold">Create Stolen Vehicle Post</h1>
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
            <form action="{{ route('submit.vehicle') }}" method="POST" enctype="multipart/form-data">
                @csrf


                <input type="hidden" name="post_id" id="post_id" value="{{ $post->id ?? '' }}">

                <!-- Title -->
                <div class="mb-6">
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Title / Name of the Vehicle
                        *</label>
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



                <!-- Featured Image -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Image of the Vehicle *</label>
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



                <!-- Vehicle Make and Model -->
                <div class="mb-6">
                    <label for="vehicle_make" class="block text-sm font-medium text-gray-700 mb-2">Vehicle Make and Model
                        *</label>
                    <input type="text" id="vehicle_make" name="vehicle_make"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500"
                        value="{{ old('vehicle_make', $post->vehicle_make ?? '') }}" required>
                </div>

                <!-- Vehicle Year -->
                <div class="mb-6">
                    <label for="vehicle_year" class="block text-sm font-medium text-gray-700 mb-2">Vehicle Year *</label>
                    <input type="text" id="vehicle_year" name="vehicle_year"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500"
                        value="{{ old('vehicle_year', $post->vehicle_year ?? '') }}" required>
                </div>

                <!-- Vehicle Color -->
                <div class="mb-6">
                    <label for="vehicle_color" class="block text-sm font-medium text-gray-700 mb-2">Vehicle Color *</label>
                    <input type="text" id="vehicle_color" name="vehicle_color"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500"
                        value="{{ old('vehicle_color', $post->vehicle_color ?? '') }}" required>
                </div>

                <!-- Vehicle License Plate -->
                <div class="mb-6">
                    <label for="license_plate" class="block text-sm font-medium text-gray-700 mb-2">License Plate *</label>
                    <input type="text" id="license_plate" name="license_plate"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500"
                        value="{{ old('license_plate', $post->license_plate ?? '') }}" required>
                </div>

                <!-- Stolen Location -->
                <div class="mb-6">
                    <label for="stolen_location" class="block text-sm font-medium text-gray-700 mb-2">Location of Theft
                        *</label>
                    <textarea id="stolen_location" name="stolen_location"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500"
                        rows="3" required>{{ old('stolen_location', $post->stolen_location ?? '') }}</textarea>
                </div>

                <!-- Date and Time of Theft -->
                <div class="mb-6">
                    <label for="theft_date" class="block text-sm font-medium text-gray-700 mb-2">Date and Time of Theft
                        *</label>
                    <input type="datetime-local" id="theft_date" name="theft_date"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-1 focus:ring-blue-500"
                        value="{{ old('theft_date', $post->theft_date ?? '') }}" required>
                </div>



                <!-- Content -->
                <div class="mb-6">
                    <label for="content" class="block text-sm font-medium text-gray-700 mb-2">Description of the Theft
                        and/or More Information *</label>
                    <textarea id="editor" rows="10" name="content" class="w-full" required>{{ old('content', $post->content ?? '') }}</textarea>

                </div>






                <!-- Publishing Options (Admin Only) -->
                <div class="bg-gray-50 p-6 rounded-lg">
                    <h3 class="font-semibold text-lg mb-4">Post Settings</h3>

                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                        <div class="flex items-center">
                            <input type="checkbox" id="is_featured" name="is_featured"
                                class="rounded border-gray-300 text-blue-600 focus:ring focus:ring-blue-200"
                                value="1" {{ old('is_featured') ? 'checked' : '' }}>
                            <label for="is_featured" class="ml-2 text-sm text-gray-700">Feature this post</label>
                        </div>



                        <div class="flex items-center">
                            <input type="checkbox" id="is_draft" name="is_draft"
                                class="rounded border-gray-300 text-blue-600 focus:ring focus:ring-blue-200 transition duration-300 ease-in-out"
                                value="1" {{ old('is_draft') ? 'checked' : '' }}>
                            <label for="is_draft" class="ml-2 text-sm text-gray-700">Save as Draft</label>
                        </div>

                        <div class="flex items-center">
                            <input type="checkbox" id="is_scheduled" name="is_scheduled"
                                class="rounded border-gray-300 text-blue-600 focus:ring focus:ring-blue-200"
                                value="1" {{ old('is_scheduled') ? 'checked' : '' }}>
                            <label for="is_scheduled" class="ml-2 text-sm text-gray-700">Schedule this post</label>
                        </div>

                        <div class="flex items-center">
                            <input type="checkbox" id="allow_comments" name="allow_comments"
                                class="rounded border-gray-300 text-blue-600 focus:ring focus:ring-blue-200"
                                value="1"
                                {{ old('allow_comments', $post->allow_comments ?? true) ? 'checked' : '' }}>
                            <label for="allow_comments" class="ml-2 text-sm text-gray-700">Allow Comments</label>
                        </div>
                    </div>

                    <div id="schedule_date" x-show="document.getElementById('is_scheduled').checked" x-cloak
                        class="mt-4 hidden">
                        <label for="scheduled_time" class="block text-sm font-medium text-gray-700 mb-2">
                            Scheduled Date & Time
                        </label>
                        <input type="datetime-local" id="scheduled_time" name="scheduled_time"
                            class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                            value="{{ old('scheduled_time', $post->scheduled_time ?? '') }}">
                    </div>
                </div>



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

            <!-- start of the signifier -->
            <div id="caveat-bubble" class="fixed bottom-4 right-4 animate-bounce-in">
                <div class="relative group">
                    <!-- Main bubble -->
                    <div
                        class="bg-violet-500 text-white px-6 py-3 rounded-full shadow-lg flex items-center space-x-2 cursor-pointer hover:bg-yellow-600 transition-all duration-300">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="font-medium">Stolen Vehicle Mode Active</span>
                    </div>

                    <!-- Animated rings -->
                    <div class="absolute inset-0 -z-10">
                        <div class="absolute inset-0 animate-ping-slow rounded-full bg-yellow-500 opacity-20"></div>
                        <div class="absolute inset-0 animate-ping-slower rounded-full bg-yellow-500 opacity-10"></div>
                    </div>
                </div>
            </div>

            <style>
                @keyframes bounceIn {
                    0% {
                        transform: translateY(100px);
                        opacity: 0;
                    }

                    60% {
                        transform: translateY(-10px);
                        opacity: 1;
                    }

                    100% {
                        transform: translateY(0);
                        opacity: 1;
                    }
                }

                @keyframes ping-slow {
                    0% {
                        transform: scale(1);
                        opacity: 0.2;
                    }

                    100% {
                        transform: scale(2);
                        opacity: 0;
                    }
                }

                @keyframes ping-slower {
                    0% {
                        transform: scale(1);
                        opacity: 0.1;
                    }

                    100% {
                        transform: scale(2.5);
                        opacity: 0;
                    }
                }

                .animate-bounce-in {
                    animation: bounceIn 1s cubic-bezier(0.68, -0.55, 0.265, 1.55);
                }

                .animate-ping-slow {
                    animation: ping-slow 2s cubic-bezier(0, 0, 0.2, 1) infinite;
                }

                .animate-ping-slower {
                    animation: ping-slower 3s cubic-bezier(0, 0, 0.2, 1) infinite;
                }
            </style>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const bubble = document.getElementById('caveat-bubble');

                    // Optional: Add click to dismiss
                    bubble.addEventListener('click', function() {
                        bubble.style.opacity = '0';
                        bubble.style.transform = 'translateY(20px)';
                        setTimeout(() => {
                            bubble.style.display = 'none';
                        }, 300);
                    });
                });
            </script>
            <!--- end of signifier-->
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
