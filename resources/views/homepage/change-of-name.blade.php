<section class="min-h-screen  py-8">
    <div class="container mx-auto px-4 max-w-6xl">
        <!-- Hero Header -->
        <div class="text-center mb-12">
            <div class="inline-flex items-center justify-center w-20 h-20 bg-gradient-to-r from-blue-600 to-red-600 rounded-full mb-6 shadow-lg">
                <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
            </div>
            <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-4">
                Name Change
                <span class="bg-gradient-to-r from-blue-600 to-red-600 bg-clip-text text-transparent">Publications</span>
            </h1>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                Official legal documentation of name changes in our community. All records are verified and legally binding.
            </p>
        </div>

        <div class="grid lg:grid-cols-3 gap-8">
            <!-- Main Content Area -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Dynamic Name Change Cards -->
                @if (count($listChangeOfNamePostsData['changeOfNamePostsData']) > 0)
                    <div class="space-y-6">
                        @foreach ($listChangeOfNamePostsData['changeOfNamePostsData'] as $index => $post)
                            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition-all duration-300">
                                <div class="p-6">
                                    <div class="flex flex-col sm:flex-row sm:items-center justify-between mb-4">
                                        <div class="flex items-center space-x-3 mb-3 sm:mb-0">
                                            @if ($post['is_featured'])
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                    Featured
                                                </span>
                                            @else
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                                    Official Notice
                                                </span>
                                            @endif
                                            <span class="text-sm text-gray-500">
                                                {{ \Carbon\Carbon::parse($post['created_at'])->format('M d, Y') }}
                                            </span>
                                        </div>
                                        <div class="flex items-center space-x-2">
                                            <span class="w-2 h-2 bg-green-500 rounded-full"></span>
                                            <span class="text-sm text-green-600 font-medium">Active</span>
                                        </div>
                                    </div>
                                    
                                    <!-- Featured Image if available -->
                                    @if ($post['featured_image'])
                                        <div class="mb-6 rounded-xl overflow-hidden">
                                            <img class="w-full h-48 object-cover" 
                                                 src="{{ $post['featured_image'] }}" 
                                                 alt="Name change from {{ $post['old_name'] }} to {{ $post['new_name'] }}">
                                        </div>
                                    @endif
                                    
                                    <div class="flex items-center justify-center py-8 mb-6 bg-gradient-to-r {{ $post['is_featured'] ? 'from-red-50 to-blue-50' : 'from-blue-50 to-red-50' }} rounded-xl">
                                        <div class="text-center">
                                            <h3 class="text-2xl font-bold text-gray-900 mb-2">
                                                {{ $post['old_name'] }}
                                            </h3>
                                            <div class="flex items-center justify-center text-gray-500 mb-2">
                                                <svg class="w-5 h-5 mx-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                                </svg>
                                            </div>
                                            <h3 class="text-2xl font-bold text-transparent bg-gradient-to-r {{ $post['is_featured'] ? 'from-red-600 to-blue-600' : 'from-blue-600 to-red-600' }} bg-clip-text">
                                                {{ $post['new_name'] }}
                                            </h3>
                                        </div>
                                    </div>
                                    
                                    <p class="text-gray-600 mb-4 leading-relaxed">
                                        I, formerly known as {{ $post['old_name'] }}, now go by the name {{ $post['new_name'] }}. 
                                        All former documents remain valid. Authorities and the general public please take note.
                                    </p>
                                    
                                    @if ($post['meta_description'])
                                        <div class="text-gray-600 mb-4 line-clamp-3 leading-relaxed">
                                            {!! $post['meta_description'] !!}
                                        </div>
                                    @endif
                                    
                                    <div class="flex flex-col sm:flex-row gap-3">
                                        <a href="{{ route('change-of-name.details', ['slug' => $post['slug']]) }}" 
                                           class="flex-1 px-4 py-2 bg-gradient-to-r {{ $post['is_featured'] ? 'from-red-600 to-blue-600' : 'from-blue-600 to-red-600' }} text-white rounded-lg font-medium hover:shadow-lg transition-all duration-200 text-center">
                                            View Full Details
                                        </a>
                                        {{-- <button class="px-4 py-2 border border-gray-200 text-gray-700 rounded-lg font-medium hover:bg-gray-50 transition-colors">
                                            Download PDF
                                        </button> --}}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Pagination if needed -->
                    {{-- @if (isset($listChangeOfNamePostsData['pagination']))
                        <div class="text-center pt-8">
                            <div class="flex justify-center items-center space-x-2">
                                {{ $listChangeOfNamePostsData['pagination'] }}
                            </div>
                        </div>
                    @endif --}}
                @else
                    <!-- Empty State -->
                    <div class="bg-white rounded-2xl p-12 text-center shadow-sm border border-gray-100">
                        <div class="w-20 h-20 bg-gradient-to-r from-blue-100 to-red-100 rounded-full flex items-center justify-center mx-auto mb-6">
                            <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-800 mb-4">No Name Changes Published</h3>
                        <p class="text-gray-600 max-w-md mx-auto mb-6">
                            There are currently no name change records available. Check back later for new publications.
                        </p>
                        <button class="px-6 py-3 bg-gradient-to-r from-blue-600 to-red-600 text-white rounded-xl font-medium hover:shadow-lg transition-all duration-200">
                            Submit New Application
                        </button>
                    </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Legal Notice Card -->
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-gradient-to-r from-blue-600 to-red-600 rounded-xl flex items-center justify-center mr-4">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900">Legal Notice</h3>
                    </div>
                    <p class="text-gray-600 mb-4">Name changes published here are official and legally binding documents.</p>
                    <div class="space-y-3">
                        <div class="flex items-start">
                            <svg class="w-5 h-5 text-green-500 mr-3 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span class="text-sm text-gray-600">Legally binding documentation</span>
                        </div>
                        <div class="flex items-start">
                            <svg class="w-5 h-5 text-green-500 mr-3 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span class="text-sm text-gray-600">Government recognition required</span>
                        </div>
                        <div class="flex items-start">
                            <svg class="w-5 h-5 text-green-500 mr-3 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span class="text-sm text-gray-600">Immediate effect upon publication</span>
                        </div>
                    </div>
                </div>

                <!-- How to Apply Card -->
                <div class="hidden sm:block bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
                <div class="bg-gradient-to-br from-blue-600 to-red-600 rounded-2xl p-6 text-white">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center mr-4">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold">Apply for Name Change</h3>
                    </div>
                    <p class="mb-6 text-blue-100">Ready to change your name? Follow our simple process.</p>
                    
                    <div class="space-y-4 mb-6">
                        <div class="flex items-center">
                            <div class="w-8 h-8 bg-white/20 rounded-full flex items-center justify-center text-sm font-bold mr-3">1</div>
                            <span class="text-sm">Complete application form</span>
                        </div>
                        <div class="flex items-center">
                            <div class="w-8 h-8 bg-white/20 rounded-full flex items-center justify-center text-sm font-bold mr-3">2</div>
                            <span class="text-sm">Submit required documents</span>
                        </div>
                        <div class="flex items-center">
                            <div class="w-8 h-8 bg-white/20 rounded-full flex items-center justify-center text-sm font-bold mr-3">3</div>
                            <span class="text-sm">Pay processing fee</span>
                        </div>
                        <div class="flex items-center">
                            <div class="w-8 h-8 bg-white/20 rounded-full flex items-center justify-center text-sm font-bold mr-3">4</div>
                            <span class="text-sm">Await approval & publication</span>
                        </div>
                    </div>
                    
                    <button class="w-full px-4 py-3 bg-white text-blue-600 rounded-xl font-bold hover:bg-gray-50 transition-colors">
                        Download Application Form
                    </button>
                </div>

                <!-- Recent Activity -->
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100">
                    <h3 class="text-lg font-bold text-gray-900 mb-4">Recent Activity</h3>
                    <div class="space-y-4">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-3">
                                <div class="w-2 h-2 bg-blue-500 rounded-full"></div>
                                <span class="text-sm text-gray-600">New publication</span>
                            </div>
                            <span class="text-xs text-gray-500">2 hours ago</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-3">
                                <div class="w-2 h-2 bg-red-500 rounded-full"></div>
                                <span class="text-sm text-gray-600">Featured update</span>
                            </div>
                            <span class="text-xs text-gray-500">1 day ago</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-3">
                                <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                                <span class="text-sm text-gray-600">Application approved</span>
                            </div>
                            <span class="text-xs text-gray-500">3 days ago</span>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
</section>

<style>
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.line-clamp-3 {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>

<script>
// Add some interactivity
document.addEventListener('DOMContentLoaded', function() {
    // Add hover effects to cards
    const cards = document.querySelectorAll('.bg-white');
    cards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-2px)';
        });
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
        });
    });
});
</script>