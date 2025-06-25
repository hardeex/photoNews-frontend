<!-- Public Notice Section -->
<div class="bg-gray-100 p-6 rounded-xl">
    <h2 class="text-3xl font-bold mb-6 bg-gradient-to-r from-blue-600 to-red-600 text-white p-4 rounded-lg text-center">
        📢 Public Notice
    </h2>
    
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        @if (count($publicNotice) > 0)
            @php $latestPost = $publicNotice[0]; @endphp
            <!-- Recent Post (Takes 2/3 of the space) -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-xl shadow-lg overflow-hidden group hover:shadow-2xl transition-all duration-300 h-full">
                    <!-- Featured Image -->
                    <div class="relative overflow-hidden h-64">
                        @if ($latestPost['featured_image'])
                            <img src="{{ $latestPost['featured_image'] }}" 
                                 alt="{{ ucwords(strtolower($latestPost['title'])) }}"
                                 class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-300">
                        @else
                            <img src="https://picsum.photos/seed/notice{{ $latestPost['id'] ?? 'default' }}/800/400" 
                                 alt="{{ ucwords(strtolower($latestPost['title'])) }}"
                                 class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-300">
                        @endif
                        
                        <!-- "LATEST" Badge -->
                        <div class="absolute top-4 left-4">
                            <span class="bg-red-600 text-white text-sm font-bold px-4 py-2 rounded-full shadow-lg animate-pulse">
                                🔥 LATEST
                            </span>
                        </div>
                        
                        <!-- Category Badge -->
                        @if (isset($latestPost['category_names']) || (isset($latestPost['category']) && isset($latestPost['category']['name'])))
                            <div class="absolute top-4 right-4">
                                <span class="bg-blue-600 text-white text-xs font-bold px-3 py-1 rounded-full shadow-md">
                                    {{ isset($latestPost['category_names'])
                                        ? strtoupper($latestPost['category_names'])
                                        : strtoupper($latestPost['category']['name']) }}
                                </span>
                            </div>
                        @endif
                    </div>

                    <!-- Content -->
                    <div class="p-6">
                        <div class="mb-4">
                            <h3 class="text-2xl font-bold mb-3 group-hover:text-blue-600 transition-colors leading-tight">
                                {{ $latestPost['title'] ?? 'Untitled Notice' }}
                            </h3>
                            
                            <p class="text-gray-600 mb-4 text-base leading-relaxed">
                                {{ strip_tags(strlen($latestPost['meta_description'] ?? '') > 200 ? substr($latestPost['meta_description'], 0, 200) . '...' : $latestPost['meta_description'] ?? substr(strip_tags($latestPost['content'] ?? ''), 0, 200) . '...') }}
                            </p>
                        </div>

                        <!-- Meta Information -->
                       <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-4 pb-4 border-b border-gray-200 space-y-2 sm:space-y-0">
    <!-- Left side: Date and time -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:space-x-4 space-y-1 sm:space-y-0">
        <span class="inline-flex items-center text-sm bg-blue-100 text-blue-800 px-3 py-1 rounded-full">
            📅 {{ \Carbon\Carbon::parse($latestPost['created_at'])->format('M d, Y') }}
        </span>
        <span class="text-sm text-gray-500">
            {{ \Carbon\Carbon::parse($latestPost['created_at'])->diffForHumans() }}
        </span>
    </div>

    <!-- Right side: More notices -->
    @if(isset($totalPublicNoticePosts) && $totalPublicNoticePosts > 1)
    <div class="text-sm text-blue-600 font-medium">
        📋 {{ $totalPublicNoticePosts - 1 }} more notices
    </div>
    @endif
</div>


                        <!-- Action Buttons -->
                        <div class="flex gap-3">
                            <a href="{{ route('posts-public-notice-details', ['slug' => $latestPost['slug']]) }}" 
                               class="flex-1 inline-flex items-center justify-center px-6 py-3 text-base font-semibold text-white bg-gradient-to-r from-blue-600 to-blue-700 rounded-lg hover:from-blue-700 hover:to-blue-800 transition-all duration-300 transform hover:-translate-y-1 hover:shadow-xl">
                                <span>Read Details</span>
                                {{-- <svg class="w-5 h-5 ml-2 transition-transform duration-300 group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                </svg> --}}
                            </a>
                            @if(isset($totalPublicNoticePosts) && $totalPublicNoticePosts > 1)
                            <a href="{{ route('lists-public-notice') }}" 
                               class="px-4 py-3 text-sm font-medium text-blue-600 bg-blue-50 rounded-lg hover:bg-blue-100 transition-colors">
                                View All
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @else
            <!-- No Posts Available - Show promotional banner only -->
            <div class="lg:col-span-2 flex items-center justify-center bg-white rounded-xl shadow-lg p-12">
                <div class="text-center">
                    <svg class="w-24 h-24 mx-auto text-gray-300 mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <h3 class="text-2xl font-bold text-gray-600 mb-2">No Public Notices Available</h3>
                    <p class="text-gray-500 mb-6">Be the first to share important information with the community!</p>
                    <a href="#" class="inline-flex items-center px-6 py-3 text-white bg-gradient-to-r from-blue-600 to-red-600 rounded-lg hover:from-blue-700 hover:to-red-700 transition-all duration-300">
                        Post First Notice
                        <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                    </a>
                </div>
            </div>
        @endif

        <!-- Promotional Banner (Takes 1/3 of the space) -->
        <div class="lg:col-span-1">
            <div class="bg-gradient-to-br from-red-500 via-red-600 to-blue-600 rounded-xl shadow-lg p-6 text-white h-full flex flex-col justify-center text-center relative overflow-hidden">
                <!-- Background Pattern -->
                <div class="absolute inset-0 opacity-10">
                    <div class="absolute top-0 left-0 w-32 h-32 bg-white rounded-full -translate-x-16 -translate-y-16"></div>
                    <div class="absolute bottom-0 right-0 w-24 h-24 bg-white rounded-full translate-x-12 translate-y-12"></div>
                </div>
                
                <div class="relative z-10">
                    <div class="text-4xl mb-4">📝</div>
                    <h3 class="text-xl font-bold mb-3">Need to Post a Public Notice?</h3>
                    <p class="text-sm mb-4 opacity-90 leading-relaxed">
                        Reach thousands of community members with your official announcements, legal notices, or public declarations
                    </p>
                    
                    <div class="mb-4">
                        <div class="flex items-center justify-center mb-2">
                            <span class="text-2xl font-bold">₦</span>
                            <span class="text-3xl font-bold ml-1">2,500</span>
                        </div>
                        <p class="text-xs opacity-75">Affordable & Professional</p>
                    </div>
                    
                    <div class="space-y-2 mb-6 text-xs">
                        <div class="flex items-center justify-center space-x-2">
                            <span>✅</span>
                            <span>Wide Community Reach</span>
                        </div>
                        <div class="flex items-center justify-center space-x-2">
                            <span>✅</span>
                            <span>24/7 Online Visibility</span>
                        </div>
                        <div class="flex items-center justify-center space-x-2">
                            <span>✅</span>
                            <span>Legal Compliance</span>
                        </div>
                    </div>
                    
                    <a href="{{route('public-notice.create')}}" class="block w-full px-4 py-3 bg-white text-red-600 rounded-lg font-bold text-sm hover:bg-gray-100 transition-all duration-300 transform hover:scale-105 shadow-lg">
                        Post Your Notice Now
                    </a>
                    
                    <p class="text-xs mt-3 opacity-75">
                        📞 Need help? Contact our support team
                    </p>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Quick Stats Bar -->
   @if(isset($totalPublicNoticePosts) && $totalPublicNoticePosts > 0)
<div class="mt-6 bg-white rounded-lg shadow-md p-4">
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between text-sm space-y-4 sm:space-y-0">
        
        <!-- Left section -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:space-x-6 space-y-2 sm:space-y-0">
            <!-- Active Notices -->
            <div class="flex items-center text-gray-600">
                <svg class="w-4 h-4 mr-2 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <span class="font-medium">{{ $totalPublicNoticePosts }}</span>
                <span class="ml-1">Active Notice{{ $totalPublicNoticePosts > 1 ? 's' : '' }}</span>
            </div>

            <!-- Verified & Official -->
            <div class="flex items-center text-gray-600">
                <svg class="w-4 h-4 mr-2 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                </svg>
                <span class="font-medium">Verified</span>
                <span class="ml-1">& Official</span>
            </div>

            <!-- Community Focused -->
            <div class="flex items-center text-gray-600">
                <svg class="w-4 h-4 mr-2 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"/>
                </svg>
                <span class="font-medium">Community</span>
                <span class="ml-1">Focused</span>
            </div>
        </div>

        <!-- Right section -->
        <div class="flex items-center justify-start sm:justify-end space-x-2">
            <span class="text-gray-500">Powered by</span>
            <span class="font-bold bg-gradient-to-r from-blue-600 to-red-600 bg-clip-text text-transparent">
                Essential NG
            </span>
        </div>
    </div>
</div>
@endif

</div>