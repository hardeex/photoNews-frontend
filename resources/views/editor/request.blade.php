<div id="editor-form" class="bg-white shadow-xl rounded-xl p-8">
                <div class="text-center mb-8">
                    <h2 class="text-3xl font-bold text-gray-800 mb-4">Join Our Editor Community</h2>
                    <p class="text-gray-600 max-w-2xl mx-auto">
                        Ready to make a difference? Apply to become an editor and help us bring important stories 
                        from your community to light. Your voice can help save lives, connect families, and build stronger communities.
                    </p>
                    <div class="mt-4 p-4 bg-yellow-50 border border-yellow-200 rounded-lg">
                        <small class="text-yellow-800">
                            <strong>Note:</strong> Your response will go through approval. We'll get back to you with 24-48 working hours.
                        </small>
                    </div>
                </div>

                @include('feedback')
                <form action="{{route('user.request-editor')}}" method="POST" class="max-w-4xl mx-auto">
                    @csrf
                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <label for="full_name" class="block text-sm font-medium text-gray-700 mb-2">
                                Full Name <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="full_name" name="full_name"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                placeholder="Enter your full name" required>
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                                Email Address <span class="text-red-500">*</span>
                            </label>
                            <input type="email" id="email" name="email"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                placeholder="your.email@example.com" value="{{ $user['email'] ?? '' }}"
readonly required>
                        </div>

                        <div>
                            <label for="phone" class="block text-sm font-medium text-gray-700 mb-2">
                                Phone Number <span class="text-red-500">*</span>
                            </label>
                            <input type="tel" id="phone" name="phone"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                placeholder="+234 XXX XXX XXXX" required>
                        </div>

                        <div>
                            <label for="experience" class="block text-sm font-medium text-gray-700 mb-2">
                                Journalistic Experience <span class="text-red-500">*</span>
                            </label>
                            <select id="experience" name="experience"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                required>
                                <option value="">Select your experience level</option>
                                <option value="none">No prior experience (We'll train you!)</option>
                                <option value="beginner">Beginner (0-1 year)</option>
                                <option value="intermediate">Intermediate (1-3 years)</option>
                                <option value="advanced">Advanced (3+ years)</option>
                                <option value="professional">Professional journalist</option>
                            </select>
                        </div>
                    </div>

                    <div class="mt-6">
                        <label for="category" class="block text-sm font-medium text-gray-700 mb-2">
                            Preferred News Category <span class="text-red-500">*</span>
                        </label>
                        <select id="category" name="category"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            required>
                            <option value="">Select a category you're most interested in</option>
                            <option value="breaking-news">Breaking News & Current Events</option>
                            <option value="columnist">Columnist</option>
                            <option value="missing-persons">Missing Persons & Safety Alerts</option>
                            <option value="community">Community Development</option>
                            <option value="politics">Politics & Governance</option>
                            <option value="business">Business & Economy</option>
                            <option value="sports">Sports</option>
                            <option value="entertainment">Entertainment</option>
                            <option value="technology">Technology</option>
                            <option value="health">Health & Medical</option>
                            <option value="education">Education</option>
                            <option value="legal-notices">Legal Notices & Public Announcements</option>
                            <option value="others">Others</option>
                        </select>
                    </div>

                    <div class="mt-6">
                        <label for="motivation" class="block text-sm font-medium text-gray-700 mb-2">
                            Why do you want to be an editor? <span class="text-red-500">*</span>
                        </label>
                        <textarea id="motivation" name="motivation" rows="4"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            placeholder="Tell us what motivates you to share stories and help your community..." required></textarea>
                    </div>

                    <div class="mt-6">
                        <label for="sample" class="block text-sm font-medium text-gray-700 mb-2">
                            Writing Sample <span class="text-red-500">*</span>
                        </label>
                        <textarea id="sample" name="sample" rows="6"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                            placeholder="Paste a short article, news piece, or even a social media post you've written. Don't worry if you don't have much - we're looking for potential, not perfection!" required></textarea>
                    </div>

                    <div class="mt-6 flex items-start">
                        <input type="checkbox" id="terms" name="terms"
                            class="h-5 w-5 text-blue-600 focus:ring-blue-500 border-gray-300 rounded mt-1" required>
                        <label for="terms" class="ml-3 block text-sm text-gray-700">
                            I agree to the <a href="/terms" class="text-blue-600 hover:underline">terms and conditions</a> 
                            and understand that I will help maintain the quality and accuracy of news reporting on this platform.
                        </label>
                    </div>

                    <div class="mt-8 text-center">
                        <button type="submit"
                            class="bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 text-white font-bold py-4 px-8 rounded-lg shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-300 text-lg">
                            🚀 Submit My Application
                        </button>
                        <p class="mt-4 text-sm text-gray-500">
                            We typically review applications within 24 hours
                        </p>
                    </div>
                </form>
            </div>