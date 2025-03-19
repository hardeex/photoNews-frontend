{{-- @extends('base.base')
@section('title', 'User Dashboard - Essential Nigeria News')
@section('content')
    <div class="container mx-auto px-4 py-8">
        <!-- Loading overlay that will be shown during redirect -->
        <div id="redirect-overlay" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
            <div class="bg-white p-6 rounded-lg shadow-lg text-center">
                <div
                    class="loader mb-4 inline-block w-12 h-12 border-4 border-t-4 border-gray-200 border-t-blue-600 rounded-full animate-spin">
                </div>
                <p class="text-lg font-medium">Redirecting to homepage...</p>
            </div>
        </div>

        <!-- Dashboard Header -->
        <div class="bg-white shadow rounded-lg mb-6 p-4">
            <div class="flex flex-col md:flex-row items-center justify-between">
                <div class="mb-4 md:mb-0">
                    <h1 class="text-2xl font-bold text-gray-800">Welcome to Essential Nigeria News</h1>
                    <p class="text-gray-600">Your trusted source for accurate and timely Nigerian news</p>
                </div>
                <div class="flex space-x-2">
                    <button class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition">My
                        Profile</button>
                    <button
                        class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-lg transition">Logout</button>
                </div>
            </div>
        </div>

        <!-- Dashboard Content -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Latest News -->
            <div class="md:col-span-2">
                <div class="bg-white shadow rounded-lg p-6">
                    <h2 class="text-xl font-bold mb-4 text-gray-800">Latest News</h2>
                    <div class="space-y-4">
                        @for ($i = 0; $i < 3; $i++)
                            <div class="border-b pb-4 last:border-b-0 last:pb-0">
                                <div class="flex flex-col sm:flex-row">
                                    <div class="sm:w-1/4 mb-3 sm:mb-0">
                                        <div class="bg-gray-200 h-24 rounded-lg"></div>
                                    </div>
                                    <div class="sm:w-3/4 sm:pl-4">
                                        <h3 class="font-semibold text-lg text-gray-800">Sample News Headline</h3>
                                        <p class="text-gray-600 text-sm mb-2">2 hours ago • Politics</p>
                                        <p class="text-gray-700">Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                            Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                        <a href="#"
                                            class="text-blue-600 hover:text-blue-800 text-sm font-medium mt-2 inline-block">Read
                                            More</a>
                                    </div>
                                </div>
                            </div>
                        @endfor
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="md:col-span-1">
                <!-- User Stats -->
                <div class="bg-white shadow rounded-lg p-6 mb-6">
                    <h2 class="text-xl font-bold mb-4 text-gray-800">Your Activity</h2>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="bg-blue-50 p-4 rounded-lg text-center">
                            <span class="block text-2xl font-bold text-blue-600">12</span>
                            <span class="text-sm text-gray-600">Saved Articles</span>
                        </div>
                        <div class="bg-green-50 p-4 rounded-lg text-center">
                            <span class="block text-2xl font-bold text-green-600">5</span>
                            <span class="text-sm text-gray-600">Comments</span>
                        </div>
                        <div class="bg-purple-50 p-4 rounded-lg text-center">
                            <span class="block text-2xl font-bold text-purple-600">3</span>
                            <span class="text-sm text-gray-600">Bookmarks</span>
                        </div>
                        <div class="bg-yellow-50 p-4 rounded-lg text-center">
                            <span class="block text-2xl font-bold text-yellow-600">8</span>
                            <span class="text-sm text-gray-600">Notifications</span>
                        </div>
                    </div>
                </div>

                <!-- Categories -->
                <div class="bg-white shadow rounded-lg p-6">
                    <h2 class="text-xl font-bold mb-4 text-gray-800">Categories</h2>
                    <ul class="space-y-2">
                        <li><a href="#"
                                class="flex items-center justify-between text-gray-700 hover:text-blue-600">Politics <span
                                    class="bg-gray-200 px-2 py-1 rounded-full text-xs">24</span></a></li>
                        <li><a href="#"
                                class="flex items-center justify-between text-gray-700 hover:text-blue-600">Business <span
                                    class="bg-gray-200 px-2 py-1 rounded-full text-xs">16</span></a></li>
                        <li><a href="#"
                                class="flex items-center justify-between text-gray-700 hover:text-blue-600">Sports <span
                                    class="bg-gray-200 px-2 py-1 rounded-full text-xs">32</span></a></li>
                        <li><a href="#"
                                class="flex items-center justify-between text-gray-700 hover:text-blue-600">Entertainment
                                <span class="bg-gray-200 px-2 py-1 rounded-full text-xs">18</span></a></li>
                        <li><a href="#"
                                class="flex items-center justify-between text-gray-700 hover:text-blue-600">Technology <span
                                    class="bg-gray-200 px-2 py-1 rounded-full text-xs">9</span></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Redirect to homepage after 5 seconds
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(function() {
                // Show redirect overlay
                document.getElementById('redirect-overlay').classList.remove('hidden');

                // Wait 2 seconds more with the overlay before redirecting
                setTimeout(function() {
                    window.location.href = '/';
                }, 2000);
            }, 5000);
        });
    </script>
@endsection --}}



@extends('base.base')
@section('title', 'User Dashboard - Essential Nigeria News')
@section('content')
    <div class="container mx-auto px-4 py-6">
        <!-- Simple Header -->
        <div class="bg-white shadow rounded-lg mb-6 p-4">
            <h1 class="text-2xl font-bold text-gray-800 text-center">Essential Nigeria News Dashboard</h1>
            <p class="text-gray-600 text-center">Welcome to your personalized news hub</p>
        </div>

        <!-- Main Content Area -->
        <div class="bg-white shadow rounded-lg p-6 mb-6">
            <h2 class="text-xl font-bold mb-4 text-gray-800">Latest Updates</h2>

            <!-- Simple News List -->
            <ul class="space-y-4 mb-6">
                <li class="border-b pb-3">
                    <h3 class="font-semibold text-gray-800">Welcome to Essential Nigeria News</h3>
                    <p class="text-gray-600 text-sm">20 minutes ago</p>
                    <p class="text-gray-700 mt-1">Get the latest updates on Nigerian news, politics, business, and more.</p>
                </li>
                <li class="border-b pb-3">
                    <h3 class="font-semibold text-gray-800">Become an Editor</h3>
                    <p class="text-gray-600 text-sm">2 hours ago</p>
                    <p class="text-gray-700 mt-1">You can now apply to become an editor. Fill out the form below to request
                        editor access.</p>
                </li>
            </ul>

            <!-- Quick Links -->
            <div class="flex flex-wrap gap-2 mb-6">
                <a href="/"
                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition text-sm">Home</a>
                <a href="/news"
                    class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-lg transition text-sm">Browse
                    News</a>
                {{-- <a href="/profile"
                    class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-lg transition text-sm">My
                    Profile</a> --}}
                <a href="/logout"
                    class="bg-gray-200 hover:bg-gray-300 text-gray-800 px-4 py-2 rounded-lg transition text-sm">Logout</a>
            </div>
        </div>

        <!-- Editor Request Form -->
        <div class="bg-white shadow rounded-lg p-6">
            <h2 class="text-xl font-bold mb-4 text-gray-800">Request Editor Access</h2> <small><strong>The features in this
                    form below is yet to be implemented. Enjoy!!</strong></small>
            <form action="/request-editor" method="POST" class="space-y-4">
                @csrf

                <div>
                    <label for="full_name" class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                    <input type="text" id="full_name" name="full_name"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required>
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                    <input type="email" id="email" name="email"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required>
                </div>

                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
                    <input type="tel" id="phone" name="phone"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required>
                </div>

                <div>
                    <label for="experience" class="block text-sm font-medium text-gray-700 mb-1">Journalistic
                        Experience</label>
                    <select id="experience" name="experience"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required>
                        <option value="">Select your experience level</option>
                        <option value="none">No prior experience</option>
                        <option value="beginner">Beginner (0-1 year)</option>
                        <option value="intermediate">Intermediate (1-3 years)</option>
                        <option value="advanced">Advanced (3+ years)</option>
                        <option value="professional">Professional journalist</option>
                    </select>
                </div>

                <div>
                    <label for="category" class="block text-sm font-medium text-gray-700 mb-1">Preferred News
                        Category</label>
                    <select id="category" name="category"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required>
                        <option value="">Select a category</option>
                        <option value="politics">Politics</option>
                        <option value="business">Business</option>
                        <option value="sports">Sports</option>
                        <option value="entertainment">Entertainment</option>
                        <option value="technology">Technology</option>
                        <option value="health">Health</option>
                        <option value="education">Education</option>
                        <option value="others">Others</option>
                    </select>
                </div>

                <div>
                    <label for="motivation" class="block text-sm font-medium text-gray-700 mb-1">Why do you want to be an
                        editor?</label>
                    <textarea id="motivation" name="motivation" rows="4"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required></textarea>
                </div>

                <div>
                    <label for="sample" class="block text-sm font-medium text-gray-700 mb-1">Writing Sample (paste a short
                        article or news piece you've written)</label>
                    <textarea id="sample" name="sample" rows="4"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required></textarea>
                </div>

                <div class="flex items-center">
                    <input type="checkbox" id="terms" name="terms"
                        class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded" required>
                    <label for="terms" class="ml-2 block text-sm text-gray-700">I agree to the terms and
                        conditions</label>
                </div>

                <button type="submit"
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-4 rounded-lg transition">Submit
                    Application</button>
            </form>
        </div>
    </div>

    {{-- <script>
        // Redirect to homepage after 8 seconds
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(function() {
                window.location.href = '/';
            }, 8000);
        });
    </script> --}}
@endsection
