<section class="max-w-4xl mx-auto p-6">
    @include('feedback')
    <div class="bg-white rounded-xl shadow-lg border border-gray-100">
        <!-- Header -->
        <div class="border-b border-gray-200 p-6">
            <h1 class="text-2xl font-bold text-gray-900 flex items-center gap-3">
                <svg class="w-7 h-7 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                Upload News Headline Image
            </h1>
            <p class="text-gray-600 mt-2">Upload high-quality images for your news headlines. Supported formats: JPEG, PNG, JPG, GIF (max 2MB)</p>
        </div>

        <div class="p-6">
            <!-- Success/Error Messages -->
            @if (session('success'))
                <div class="mb-6 bg-green-50 border border-green-200 rounded-lg p-4">
                    <div class="flex items-start">
                        <svg class="w-5 h-5 text-green-500 mt-0.5 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                        <div>
                            <p class="text-green-800 font-medium">{{ session('success') }}</p>
                            @if (session('image_url'))
                                <p class="text-green-700 mt-2">
                                    <span class="font-medium">Image URL:</span> 
                                    <a href="{{ session('image_url') }}" target="_blank" class="text-blue-600 hover:text-blue-800 underline break-all">
                                        {{ session('image_url') }}
                                    </a>
                                </p>
                            @endif
                        </div>
                    </div>
                </div>
            @endif

            @if (session('error'))
                <div class="mb-6 bg-red-50 border border-red-200 rounded-lg p-4">
                    <div class="flex items-start">
                        <svg class="w-5 h-5 text-red-500 mt-0.5 mr-3 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                        </svg>
                        <p class="text-red-800 font-medium">{{ session('error') }}</p>
                    </div>
                </div>
            @endif

            <!-- Upload Form -->
            <form action="{{ route('admin.upload-photo-news') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                
                <!-- Drag & Drop Upload Area -->
                <div class="upload-area border-2 border-dashed border-gray-300 rounded-lg p-8 text-center hover:border-blue-400 transition-colors duration-200 cursor-pointer" onclick="document.getElementById('image').click()">
                    <div class="space-y-4">
                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <div>
                            <p class="text-lg font-medium text-gray-900">Drop your image here, or <span class="text-blue-600">browse</span></p>
                            <p class="text-sm text-gray-500 mt-1">JPEG, PNG, JPG, GIF up to 2MB</p>
                        </div>
                    </div>
                </div>

                <!-- Hidden File Input -->
                <input type="file" 
                       class="hidden @error('image') is-invalid @enderror" 
                       id="image" 
                       name="image" 
                       accept="image/jpeg,image/png,image/jpg,image/gif">

                <!-- Validation Error -->
                @error('image')
                    <div class="text-red-600 text-sm font-medium">{{ $message }}</div>
                @enderror

                <!-- Selected File Info -->
                <div id="file-info" class="hidden bg-gray-50 rounded-lg p-4">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <svg class="w-5 h-5 text-gray-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-8 3 6 2-4 3 6z" clip-rule="evenodd"></path>
                            </svg>
                            <div>
                                <p id="file-name" class="text-sm font-medium text-gray-900"></p>
                                <p id="file-size" class="text-xs text-gray-500"></p>
                            </div>
                        </div>
                        <button type="button" onclick="clearFile()" class="text-red-500 hover:text-red-700 text-sm font-medium">
                            Remove
                        </button>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="flex justify-end">
                    <button type="submit" 
                            class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 px-6 rounded-lg transition-colors duration-200 flex items-center space-x-2 disabled:opacity-50 disabled:cursor-not-allowed">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                        </svg>
                        <span>Upload Image</span>
                    </button>
                </div>
            </form>

            <!-- Image Preview -->
            <div id="preview-section" class="mt-8 hidden">
                <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center gap-2">
                    <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                    </svg>
                    Image Preview
                </h3>
                <div class="bg-gray-50 rounded-lg p-4">
                    <img id="image-preview" 
                         src="" 
                         alt="Image Preview" 
                         class="max-w-full h-auto rounded-lg shadow-md max-h-96 mx-auto">
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript -->
    <script>
        const fileInput = document.getElementById('image');
        const fileInfo = document.getElementById('file-info');
        const fileName = document.getElementById('file-name');
        const fileSize = document.getElementById('file-size');
        const preview = document.getElementById('image-preview');
        const previewSection = document.getElementById('preview-section');
        const uploadArea = document.querySelector('.upload-area');

        // File input change handler
        fileInput.addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                // Show file info
                fileName.textContent = file.name;
                fileSize.textContent = formatFileSize(file.size);
                fileInfo.classList.remove('hidden');
                
                // Show preview
                preview.src = URL.createObjectURL(file);
                previewSection.classList.remove('hidden');
                
                // Update upload area appearance
                uploadArea.classList.add('border-green-400', 'bg-green-50');
                uploadArea.classList.remove('border-gray-300');
            }
        });

        // Drag and drop handlers
        uploadArea.addEventListener('dragover', function(e) {
            e.preventDefault();
            uploadArea.classList.add('border-blue-400', 'bg-blue-50');
        });

        uploadArea.addEventListener('dragleave', function(e) {
            e.preventDefault();
            uploadArea.classList.remove('border-blue-400', 'bg-blue-50');
        });

        uploadArea.addEventListener('drop', function(e) {
            e.preventDefault();
            uploadArea.classList.remove('border-blue-400', 'bg-blue-50');
            
            const files = e.dataTransfer.files;
            if (files.length > 0) {
                fileInput.files = files;
                fileInput.dispatchEvent(new Event('change'));
            }
        });

        // Clear file function
        function clearFile() {
            fileInput.value = '';
            fileInfo.classList.add('hidden');
            previewSection.classList.add('hidden');
            uploadArea.classList.remove('border-green-400', 'bg-green-50');
            uploadArea.classList.add('border-gray-300');
            URL.revokeObjectURL(preview.src);
        }

        // Format file size helper
        function formatFileSize(bytes) {
            if (bytes === 0) return '0 Bytes';
            const k = 1024;
            const sizes = ['Bytes', 'KB', 'MB', 'GB'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));
            return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
        }
    </script>
</section>