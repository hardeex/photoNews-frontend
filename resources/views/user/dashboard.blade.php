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
    <div class="min-h-screen bg-gray-50">
        <!-- Hero Section -->
        <div class="bg-gradient-to-r from-blue-600 via-purple-600 to-indigo-800 text-white">
            <div class="container mx-auto px-4 py-12">
                <div class="text-center">
                    <h1 class="text-4xl md:text-5xl font-bold mb-4">
                        Welcome to <span class="text-yellow-300">Essential Nigeria News</span>
                    </h1>
                    <p class="text-xl mb-8 text-blue-100 max-w-3xl mx-auto">
                        Your voice matters! Help us bring important stories from every corner of Nigeria to light.
                    </p>
                    <div class="flex justify-center items-center space-x-6 text-lg">
                        <div class="flex items-center">
                            <div class="w-3 h-3 bg-green-400 rounded-full mr-2 animate-pulse"></div>
                            <span>Live Updates</span>
                        </div>
                        <div class="flex items-center">
                            <div class="w-3 h-3 bg-yellow-400 rounded-full mr-2"></div>
                            <span>Community Driven</span>
                        </div>
                        <div class="flex items-center">
                            <div class="w-3 h-3 bg-red-400 rounded-full mr-2"></div>
                            <span>Breaking News</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container mx-auto px-4 py-8">
            <!-- Impact Statistics -->
            {{-- <div class="bg-white rounded-xl shadow-lg p-8 mb-8">
                <h2 class="text-2xl font-bold text-center text-gray-800 mb-8">Our Community Impact</h2>
                
                <div class="grid md:grid-cols-4 gap-6">
                    <div class="text-center">
                        <div class="text-3xl font-bold text-blue-600 mb-2">2,847</div>
                        <div class="text-gray-600">Stories Published</div>
                        <div class="text-sm text-gray-500">This month</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-bold text-green-600 mb-2">156</div>
                        <div class="text-gray-600">Missing Persons Found</div>
                        <div class="text-sm text-gray-500">Through our platform</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-bold text-purple-600 mb-2">89</div>
                        <div class="text-gray-600">Stolen Vehicles Recovered</div>
                        <div class="text-sm text-gray-500">Community reports</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-bold text-orange-600 mb-2">1.2M</div>
                        <div class="text-gray-600">Nigerians Informed</div>
                        <div class="text-sm text-gray-500">Monthly readers</div>
                    </div>
                </div>
            </div> --}}

            <!-- Why Your Voice Matters -->
            <div class="bg-gradient-to-r from-green-50 to-blue-50 rounded-xl p-8 mb-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Why Your Voice Matters</h2>
                <div class="grid md:grid-cols-2 gap-8">
                    <div>
                        <h3 class="text-xl font-semibold text-gray-800 mb-4">🏘️ Local Events, Global Impact</h3>
                        <p class="text-gray-600 mb-4">
                            Every community has stories that matter. From school graduations to local business openings, 
                            your neighborhood news connects us all and builds stronger communities.
                        </p>
                        <ul class="space-y-2 text-gray-600">
                            <li class="flex items-center">
                                <span class="w-2 h-2 bg-green-400 rounded-full mr-3"></span>
                                Community development updates
                            </li>
                            <li class="flex items-center">
                                <span class="w-2 h-2 bg-green-400 rounded-full mr-3"></span>
                                Local government activities
                            </li>
                            <li class="flex items-center">
                                <span class="w-2 h-2 bg-green-400 rounded-full mr-3"></span>
                                Cultural celebrations and events
                            </li>
                        </ul>
                    </div>
                    <div>
                        <h3 class="text-xl font-semibold text-gray-800 mb-4">🚨 Emergency & Safety Reports</h3>
                        <p class="text-gray-600 mb-4">
                            Your quick reporting can save lives. Missing persons, security alerts, and emergency 
                            situations need immediate community attention and action.
                        </p>
                        <ul class="space-y-2 text-gray-600">
                            <li class="flex items-center">
                                <span class="w-2 h-2 bg-red-400 rounded-full mr-3"></span>
                                Missing person alerts
                            </li>
                            <li class="flex items-center">
                                <span class="w-2 h-2 bg-red-400 rounded-full mr-3"></span>
                                Security incident reports
                            </li>
                            <li class="flex items-center">
                                <span class="w-2 h-2 bg-red-400 rounded-full mr-3"></span>
                                Emergency announcements
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Success Stories -->
            <div class="bg-white rounded-xl shadow-lg p-8 mb-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Real Stories, Real Impact</h2>
                <div class="grid md:grid-cols-3 gap-6">
                    <div class="border-l-4 border-green-400 pl-4">
                        <h4 class="font-semibold text-gray-800 mb-2">Missing Child Found in Lagos</h4>
                        <p class="text-sm text-gray-600 mb-2">
                            "Thanks to a community editor's quick report, 8-year-old Kemi was reunited with her family within 6 hours."
                        </p>
                        <span class="text-xs text-green-600 font-medium">Editor: Adebayo M. - Lagos</span>
                    </div>
                    <div class="border-l-4 border-blue-400 pl-4">
                        <h4 class="font-semibold text-gray-800 mb-2">Stolen Vehicle Recovery</h4>
                        <p class="text-sm text-gray-600 mb-2">
                            "A timely report helped police recover a stolen commercial bus and arrest the thieves in Kano."
                        </p>
                        <span class="text-xs text-blue-600 font-medium">Editor: Fatima A. - Kano</span>
                    </div>
                    <div class="border-l-4 border-purple-400 pl-4">
                        <h4 class="font-semibold text-gray-800 mb-2">Community Development Alert</h4>
                        <p class="text-sm text-gray-600 mb-2">
                            "Local reporting exposed a fake charity scam, protecting hundreds of families from fraud."
                        </p>
                        <span class="text-xs text-purple-600 font-medium">Editor: Chidi E. - Abuja</span>
                    </div>
                </div>
            </div>

            <!-- Content Categories Grid -->
            <div class="bg-white rounded-xl shadow-lg p-8 mb-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">What You Can Report</h2>
                <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-5 gap-4">
                    <div class="bg-blue-50 rounded-lg p-4 text-center hover:bg-blue-100 transition-colors">
                        <div class="text-2xl mb-2">📰</div>
                        <div class="text-sm font-medium text-gray-700">Breaking News</div>
                        <div class="text-xs text-gray-500 mt-1">Local & National</div>
                    </div>
                    <div class="bg-red-50 rounded-lg p-4 text-center hover:bg-red-100 transition-colors">
                        <div class="text-2xl mb-2">🔍</div>
                        <div class="text-sm font-medium text-gray-700">Missing Person</div>
                        <div class="text-xs text-gray-500 mt-1">Help Find People</div>
                    </div>
                    <div class="bg-yellow-50 rounded-lg p-4 text-center hover:bg-yellow-100 transition-colors">
                        <div class="text-2xl mb-2">⚠️</div>
                        <div class="text-sm font-medium text-gray-700">Wanted Person</div>
                        <div class="text-xs text-gray-500 mt-1">Security Alerts</div>
                    </div>
                    <div class="bg-green-50 rounded-lg p-4 text-center hover:bg-green-100 transition-colors">
                        <div class="text-2xl mb-2">📋</div>
                        <div class="text-sm font-medium text-gray-700">Change of Name</div>
                        <div class="text-xs text-gray-500 mt-1">Legal Notices</div>
                    </div>
                    <div class="bg-purple-50 rounded-lg p-4 text-center hover:bg-purple-100 transition-colors">
                        <div class="text-2xl mb-2">🚗</div>
                        <div class="text-sm font-medium text-gray-700">Stolen Vehicle</div>
                        <div class="text-xs text-gray-500 mt-1">Recovery Reports</div>
                    </div>
                    <div class="bg-indigo-50 rounded-lg p-4 text-center hover:bg-indigo-100 transition-colors">
                        <div class="text-2xl mb-2">⚖️</div>
                        <div class="text-sm font-medium text-gray-700">Caveat</div>
                        <div class="text-xs text-gray-500 mt-1">Legal Warnings</div>
                    </div>
                    <div class="bg-gray-50 rounded-lg p-4 text-center hover:bg-gray-100 transition-colors">
                        <div class="text-2xl mb-2">🕊️</div>
                        <div class="text-sm font-medium text-gray-700">Obituary</div>
                        <div class="text-xs text-gray-500 mt-1">Memorial Notices</div>
                    </div>
                    <div class="bg-pink-50 rounded-lg p-4 text-center hover:bg-pink-100 transition-colors">
                        <div class="text-2xl mb-2">👶</div>
                        <div class="text-sm font-medium text-gray-700">Child Dedication</div>
                        <div class="text-xs text-gray-500 mt-1">Celebrations</div>
                    </div>
                    <div class="bg-teal-50 rounded-lg p-4 text-center hover:bg-teal-100 transition-colors">
                        <div class="text-2xl mb-2">💝</div>
                        <div class="text-sm font-medium text-gray-700">Remembrance</div>
                        <div class="text-xs text-gray-500 mt-1">Memorial Events</div>
                    </div>
                    <div class="bg-orange-50 rounded-lg p-4 text-center hover:bg-orange-100 transition-colors">
                        <div class="text-2xl mb-2">📢</div>
                        <div class="text-sm font-medium text-gray-700">Public Notice</div>
                        <div class="text-xs text-gray-500 mt-1">Community Info</div>
                    </div>
                </div>
            </div>

            <!-- How It Works -->
            <div class="bg-gradient-to-r from-blue-600 to-purple-600 text-white rounded-xl p-8 mb-8">
                <h2 class="text-2xl font-bold mb-6 text-center">How It Works</h2>
                <div class="grid md:grid-cols-3 gap-8">
                    <div class="text-center">
                        <div class="w-16 h-16 bg-white/20 rounded-full flex items-center justify-center mx-auto mb-4">
                            <span class="text-2xl">📝</span>
                        </div>
                        <h3 class="text-xl font-semibold mb-2">1. Apply to be an Editor</h3>
                        <p class="text-blue-100">Fill out our simple application form below. No experience required - we'll train you!</p>
                    </div>
                    <div class="text-center">
                        <div class="w-16 h-16 bg-white/20 rounded-full flex items-center justify-center mx-auto mb-4">
                            <span class="text-2xl">✅</span>
                        </div>
                        <h3 class="text-xl font-semibold mb-2">2. Get Approved</h3>
                        <p class="text-blue-100">Our team reviews your application quickly. Most approvals happen within 24 hours.</p>
                    </div>
                    <div class="text-center">
                        <div class="w-16 h-16 bg-white/20 rounded-full flex items-center justify-center mx-auto mb-4">
                            <span class="text-2xl">🚀</span>
                        </div>
                        <h3 class="text-xl font-semibold mb-2">3. Start Reporting</h3>
                        <p class="text-blue-100">Begin sharing stories that matter to your community and help make Nigeria better informed.</p>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
                <div class="flex flex-wrap justify-center gap-4">
                    <a href="/" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg transition font-medium">
                        🏠 Home
                    </a>
                    <a href="/news" class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg transition font-medium">
                        📰 Browse News
                    </a>
                    <a href="#editor-form" class="bg-purple-600 hover:bg-purple-700 text-white px-6 py-3 rounded-lg transition font-medium">
                        ✍️ Become an Editor
                    </a>
                    <a href="/logout" class="bg-gray-600 hover:bg-gray-700 text-white px-6 py-3 rounded-lg transition font-medium">
                        🚪 Logout
                    </a>
                </div>
            </div>

            <!-- Editor Application Form -->
            @include('editor.request')
        </div>
    </div>
@endsection