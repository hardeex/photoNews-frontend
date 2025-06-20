@extends('base.base')
@section('title', ucwords(strtolower($post['title'])))

@section('content')
    <meta name="api-base-url" content="{{ config('api.base_url') }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700;900&family=Source+Serif+Pro:wght@300;400;600;700&family=Inter:wght@300;400;500;600&display=swap" rel="stylesheet">

    <style>
        /* Newspaper Typography */
        .newspaper-font {
            font-family: 'Source Serif Pro', 'Times New Roman', serif;
        }
        
        .headline-font {
            font-family: 'Playfair Display', 'Times New Roman', serif;
        }
        
        .modern-font {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
        }

        /* Newspaper Layout Styles */
        .newspaper-border {
            border: 3px double #1e40af;
        }
        
        .newspaper-divider {
            height: 2px;
            background: linear-gradient(to right, #dc2626, #1e40af);
        }
        
        .drop-cap {
            float: left;
            font-family: 'Playfair Display', serif;
            font-size: 4.5rem;
            line-height: 3.5rem;
            padding-right: 8px;
            padding-top: 3px;
            color: #dc2626;
            font-weight: 700;
        }
        
        .newspaper-column {
            column-count: 1;
            column-gap: 2rem;
            text-align: justify;
            hyphens: auto;
        }
        
        @media (min-width: 768px) {
            .newspaper-column {
                column-count: 2;
            }
        }
        
        .newspaper-quote {
            border-left: 4px solid #dc2626;
            background: #f8fafc;
            font-style: italic;
            position: relative;
        }
        
        .newspaper-quote::before {
            content: '"';
            font-size: 4rem;
            color: #1e40af;
            position: absolute;
            left: -10px;
            top: -20px;
            font-family: 'Playfair Display', serif;
        }

        /* Brand Color Animations */
        @keyframes highlight {
            0% { background-color: transparent; }
            50% { background-color: rgba(30, 64, 175, 0.1); }
            100% { background-color: transparent; }
        }

        .highlight {
            animation: highlight 2s ease-out;
        }

        @keyframes pulse-brand {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.7; }
        }

        .pulse-brand {
            animation: pulse-brand 2s infinite;
        }

        /* Masthead Style */
        .masthead {
            background: linear-gradient(135deg, #1e40af 0%, #dc2626 100%);
            border-bottom: 3px solid #000;
        }

        /* Byline styling */
        .byline {
            border-top: 1px solid #e5e7eb;
            border-bottom: 1px solid #e5e7eb;
            background: #f9fafb;
        }

        /* Reading progress */
        .reading-progress {
            background: linear-gradient(to right, #dc2626, #1e40af);
        }

        /* Newspaper dateline */
        .dateline {
            font-variant: small-caps;
            letter-spacing: 1px;
            font-weight: 600;
        }

        /* Section headers */
        .section-header {
            background: #1e40af;
            color: white;
            font-variant: small-caps;
            letter-spacing: 2px;
        }

        /* Edition styling */
        .edition-badge {
            background: linear-gradient(45deg, #dc2626, #b91c1c);
            transform: rotate(-5deg);
            box-shadow: 0 4px 8px rgba(0,0,0,0.2);
        }
    </style>

    @if ($post)
        <div class="bg-gray-50 min-h-screen newspaper-font">
            <!-- Newspaper Masthead -->
            <div class="masthead text-white py-4">
                <div class="max-w-7xl mx-auto px-4 text-center">
                    <div class="text-sm dateline mb-2">{{ \Carbon\Carbon::now()->format('l, F d, Y') }}</div>
                    <h1 class="headline-font text-3xl md:text-5xl font-black tracking-wide">ESSENTIAL NEWS</h1>
                    <div class="text-sm mt-2 opacity-90">Breaking News • Analysis • Opinion</div>
                </div>
            </div>

            <!-- Main Content -->
            <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                <!-- Article Container -->
                <article class="bg-white newspaper-border shadow-2xl">
                    <!-- Edition Badge -->
                    <div class="relative">
                        <div class="absolute -top-4 -right-4 edition-badge text-white px-4 py-2 rounded-full text-xs font-bold z-10">
                            LATEST EDITION
                        </div>
                    </div>

                    <!-- Category Banner -->
                    @if (isset($post['category_names']) || (isset($post['category']) && isset($post['category']['name'])))
                        <div class="section-header text-center py-3">
                            <h2 class="text-lg font-bold">
                                {{ isset($post['category_names']) 
                                    ? strtoupper($post['category_names']) 
                                    : strtoupper($post['category']['name']) }}
                            </h2>
                        </div>
                    @endif

                    <!-- Featured Image -->
                    <div class="relative">
                        @if ($post['featured_image'])
                            <img src="{{ $post['featured_image'] }}" 
                                 alt="{{ ucwords(strtolower($post['title'])) }}"
                                 class="w-full h-96 object-cover border-b-2 border-gray-200" loading="lazy">
                        @else
                            <img src="https://picsum.photos/seed/news/1200/600" 
                                 alt="{{ ucwords(strtolower($post['title'])) }}"
                                 class="w-full h-96 object-cover border-b-2 border-gray-200" loading="lazy">
                        @endif
                        
                        <!-- Photo Credit -->
                        <div class="absolute bottom-2 right-2 bg-black bg-opacity-70 text-white text-xs px-2 py-1">
                            Photo: Staff Photographer
                        </div>
                    </div>

                    <!-- Article Header -->
                    <div class="px-8 py-6">
                        <!-- Headline -->
                        <h1 class="headline-font text-4xl md:text-6xl font-black text-gray-900 leading-tight mb-6 text-center">
                            {{ strtoupper($post['title']) }}
                        </h1>

                        <!-- Newspaper Divider -->
                        <div class="newspaper-divider mb-6"></div>

                        <!-- Byline Section -->
                        <div class="byline px-6 py-4 mb-6">
                            <div class="flex flex-wrap justify-between items-center text-sm">
                                <div class="flex items-center space-x-6">
                                    <div class="font-semibold">
                                        By <span class="text-blue-800 font-bold">{{ strtoupper($post['created_by_name']) }}</span>
                                    </div>
                                    <div class="text-gray-600">
                                        Staff Reporter
                                    </div>
                                </div>
                                <div class="text-gray-700 font-medium dateline">
                                    {{ \Carbon\Carbon::parse($post['created_at'])->format('F d, Y') }}
                                </div>
                            </div>
                        </div>

                        <!-- Article Stats -->
                        <div class="flex flex-wrap justify-center gap-8 text-sm mb-8 modern-font">
                            <div class="flex items-center text-blue-600">
                                <i class="fas fa-eye mr-2"></i>
                                <span class="views-count font-semibold">{{ number_format($post['views']) }}</span>
                                <span class="ml-1">readers</span>
                            </div>
                            <div class="flex items-center text-green-600">
                                <i class="fas fa-share mr-2"></i>
                                <span class="share-count font-semibold">{{ number_format($post['shares']) }}</span>
                                <span class="ml-1">shares</span>
                            </div>
                            <div class="flex items-center text-red-600">
                                <i class="fas fa-heart mr-2"></i>
                                <span class="likes-count font-semibold">{{ number_format($post['likes']) }}</span>
                                <span class="ml-1">reactions</span>
                            </div>
                        </div>
                    </div>

                    <!-- Article Content -->
                    <div class="px-8 pb-8">
                        <div class="max-w-6xl mx-auto">
                            <!-- Drop Cap Paragraph -->
                            <div class="text-lg leading-relaxed text-gray-800 mb-8">
                                <span class="drop-cap">{{ substr(strip_tags($post['content']), 0, 1) }}</span>
                                <div class="newspaper-column">
                                    {!! $post['content'] !!}
                                </div>
                            </div>

                            <!-- Pull Quote (if content contains quotes) -->
                            <div class="my-12 mx-auto max-w-3xl">
                                <blockquote class="newspaper-quote p-6 text-xl italic text-gray-700 leading-relaxed">
                                    "This represents a significant development in our ongoing coverage of current events."
                                </blockquote>
                                <cite class="block text-right text-sm text-gray-600 mt-2">— Editorial Board</cite>
                            </div>
                        </div>
                    </div>

                    <!-- Engagement Section -->
                    <div class="border-t-2 border-gray-200 bg-gray-50 px-8 py-6">
                        <div class="text-center mb-6">
                            <h3 class="headline-font text-2xl font-bold text-gray-800 mb-4">READER ENGAGEMENT</h3>
                            <div class="newspaper-divider w-32 mx-auto mb-6"></div>
                        </div>

                        <!-- Interactive Buttons -->
                        <div class="flex justify-center gap-12 engagement-buttons mb-8">
                            <button class="like-button group flex flex-col items-center space-y-2 transition-all duration-300 hover:transform hover:scale-110" 
                                    data-slug="{{ $post['slug'] }}">
                                <div class="w-16 h-16 bg-red-100 rounded-full flex items-center justify-center group-hover:bg-red-200 transition-colors">
                                    <i class="fas fa-heart text-2xl text-red-600"></i>
                                </div>
                                <span class="modern-font font-semibold text-gray-700">APPRECIATE</span>
                                <span class="likes-count text-sm bg-red-600 text-white px-3 py-1 rounded-full">
                                    {{ number_format($post['likes']) }}
                                </span>
                            </button>

                            <button class="dislike-button group flex flex-col items-center space-y-2 transition-all duration-300 hover:transform hover:scale-110" 
                                    data-slug="{{ $post['slug'] }}">
                                <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center group-hover:bg-gray-200 transition-colors">
                                    <i class="fas fa-thumbs-down text-2xl text-gray-600"></i>
                                </div>
                                <span class="modern-font font-semibold text-gray-700">DISAGREE</span>
                                <span class="dislikes-count text-sm bg-gray-600 text-white px-3 py-1 rounded-full">
                                    {{ number_format($post['dislikes']) }}
                                </span>
                            </button>
                        </div>

                        <div class="alert-message hidden text-center bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                            You must be logged in to engage with this article!
                        </div>

                        <!-- Share Section -->
                        <div class="border-t border-gray-300 pt-6">
                            <h4 class="headline-font text-xl font-bold text-center mb-6 text-gray-800">SHARE THIS STORY</h4>
                            
                            <div class="flex flex-wrap justify-center gap-4">
                                <a href="{{ 'https://twitter.com/intent/tweet?url=' . urlencode(request()->url()) . '&text=' . urlencode($post['title']) }}"
                                   target="_blank" rel="noopener noreferrer"
                                   class="share-button flex items-center gap-2 bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition-colors"
                                   data-slug="{{ $post['slug'] }}" data-platform="twitter">
                                    <i class="fab fa-twitter"></i>
                                    <span class="font-medium">Twitter</span>
                                </a>

                                <a href="{{ 'https://www.facebook.com/sharer/sharer.php?u=' . urlencode(request()->url()) }}"
                                   target="_blank" rel="noopener noreferrer"
                                   class="share-button flex items-center gap-2 bg-blue-700 hover:bg-blue-800 text-white px-4 py-2 rounded-lg transition-colors"
                                   data-slug="{{ $post['slug'] }}" data-platform="facebook">
                                    <i class="fab fa-facebook"></i>
                                    <span class="font-medium">Facebook</span>
                                </a>

                                <a href="{{ 'https://www.linkedin.com/shareArticle?mini=true&url=' . urlencode(request()->url()) . '&title=' . urlencode($post['title']) }}"
                                   target="_blank" rel="noopener noreferrer"
                                   class="share-button flex items-center gap-2 bg-blue-800 hover:bg-blue-900 text-white px-4 py-2 rounded-lg transition-colors"
                                   data-slug="{{ $post['slug'] }}" data-platform="linkedin">
                                    <i class="fab fa-linkedin"></i>
                                    <span class="font-medium">LinkedIn</span>
                                </a>

                                <a href="{{ 'https://wa.me/?text=' . urlencode($post['title'] . ' ' . request()->url()) }}"
                                   target="_blank" rel="noopener noreferrer"
                                   class="share-button flex items-center gap-2 bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg transition-colors"
                                   data-slug="{{ $post['slug'] }}" data-platform="whatsapp">
                                    <i class="fab fa-whatsapp"></i>
                                    <span class="font-medium">WhatsApp</span>
                                </a>

                                <button class="share-button copy-link-btn flex items-center gap-2 bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg transition-colors"
                                        data-slug="{{ $post['slug'] }}" data-platform="copy" data-url="{{ request()->url() }}">
                                    <i class="fas fa-link"></i>
                                    <span class="font-medium">Copy Link</span>
                                </button>
                            </div>

                            <div id="copyAlert" class="hidden mt-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded text-center">
                                <i class="fas fa-check-circle mr-2"></i>
                                Link copied to clipboard!
                            </div>
                        </div>
                    </div>

                    <!-- Reading Progress Bar -->
                    <div class="fixed top-0 left-0 w-full h-1 bg-gray-200 z-50">
                        <div class="h-full reading-progress transition-all duration-200" id="reading-progress" style="width: 0%"></div>
                    </div>
                </article>

                <!-- Related Articles Section -->
                <section class="mt-12 bg-white newspaper-border shadow-lg">
                    <div class="section-header text-center py-4">
                        <h2 class="text-xl font-bold">MORE FROM THIS EDITION</h2>
                    </div>
                    <div class="p-8 text-center text-gray-600">
                        <i class="fas fa-newspaper text-4xl mb-4 text-blue-600"></i>
                        <p class="italic">Additional articles loading...</p>
                    </div>
                </section>
            </main>
        </div>

        <!-- JavaScript remains the same -->
        <script>
            // Reading Progress Bar
            window.addEventListener('scroll', () => {
                const winScroll = document.body.scrollTop || document.documentElement.scrollTop;
                const height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
                const scrolled = (winScroll / height) * 100;
                document.getElementById('reading-progress').style.width = scrolled + '%';
            });

            // Get the API base URL from meta tag
            const API_BASE_URL = document.querySelector('meta[name="api-base-url"]').content;

            // Function to track the share action and update the share count
            async function trackShare(slug, platform) {
                console.log('Tracking share for slug:', slug, 'on platform:', platform);
                try {
                    const response = await fetch(`${API_BASE_URL}/posts/${slug}/share`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        }
                    });

                    const data = await response.json();
                    console.log('Response from server:', data);

                    if (data.status === 'success') {
                        const shareCountElement = document.querySelector('.share-count');
                        if (shareCountElement) {
                            shareCountElement.textContent = data.shares;
                        }
                    }
                } catch (error) {
                    console.error('Error tracking share:', error);
                }
            }

            // Function to handle social media sharing
            function handleShare(e) {
                e.preventDefault();
                const button = e.currentTarget;
                const platform = button.dataset.platform;
                const slug = button.dataset.slug;
                const url = button.href;

                // Track the share first
                trackShare(slug, platform);

                // Then open the share dialog
                window.open(url, '_blank', 'width=600,height=400');
            }

            // Function to copy to clipboard and track share
            function copyToClipboard(text, slug) {
                const copyOperation = navigator.clipboard ?
                    navigator.clipboard.writeText(text) :
                    new Promise((resolve, reject) => {
                        const textArea = document.createElement('textarea');
                        textArea.value = text;
                        document.body.appendChild(textArea);
                        textArea.select();
                        try {
                            document.execCommand('copy');
                            document.body.removeChild(textArea);
                            resolve();
                        } catch (err) {
                            document.body.removeChild(textArea);
                            reject(err);
                        }
                    });

                copyOperation.then(() => {
                    const alert = document.getElementById('copyAlert');
                    alert.classList.remove('hidden');
                    setTimeout(() => alert.classList.add('hidden'), 3000);

                    if (slug) {
                        trackShare(slug, 'copy');
                    }
                }).catch(err => console.error('Failed to copy text: ', err));
            }

            // Initialize event listeners when DOM is loaded
            document.addEventListener('DOMContentLoaded', () => {
                // Share buttons
                document.querySelectorAll('.share-button').forEach(button => {
                    if (button.classList.contains('copy-link-btn')) {
                        button.addEventListener('click', function() {
                            const postUrl = this.dataset.url;
                            const slug = this.dataset.slug;
                            copyToClipboard(postUrl, slug);
                        });
                    } else {
                        button.addEventListener('click', handleShare);
                    }
                });

                // Engagement handling
                const API_BASE_URL = document.querySelector('meta[name="api-base-url"]').content;

                async function handleEngagement(action, button) {
                    const slug = button.dataset.slug;
                    const token = "{{ session('api_token') }}";

                    if (!token) {
                        const alertMessage = document.querySelector('.alert-message');
                        if (alertMessage) {
                            alertMessage.classList.remove('hidden');
                            setTimeout(() => alertMessage.classList.add('hidden'), 3000);
                        }
                        return;
                    }

                    try {
                        const response = await fetch(`${API_BASE_URL}/posts/${slug}/${action}`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'Accept': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                                'X-Requested-With': 'XMLHttpRequest',
                                'Authorization': `Bearer ${token}`,
                            },
                            credentials: 'include',
                            mode: 'cors',
                        });

                        if (response.status === 401) {
                            window.location.href = '/login';
                            return;
                        }

                        const data = await response.json();

                        if (!response.ok) {
                            throw new Error(data.message || 'An error occurred');
                        }

                        if (data.status === 'success') {
                            updateEngagementCounts(data, button);
                            updateButtonStates(action, button);
                        }

                    } catch (error) {
                        console.error(`Error handling ${action}:`, error);
                        alert(error.message || `Failed to ${action} the post`);
                    }
                }

                function updateEngagementCounts(data, button) {
                    const container = button.closest('.engagement-buttons');
                    const likesCounter = container.querySelector('.likes-count');
                    const dislikesCounter = container.querySelector('.dislikes-count');

                    if (likesCounter) {
                        likesCounter.textContent = new Intl.NumberFormat().format(data.likes);
                    }
                    if (dislikesCounter) {
                        dislikesCounter.textContent = new Intl.NumberFormat().format(data.dislikes);
                    }
                }

                function updateButtonStates(action, activeButton) {
                    const container = activeButton.closest('.engagement-buttons');
                    const likeButton = container.querySelector('.like-button');
                    const dislikeButton = container.querySelector('.dislike-button');

                    // Add visual feedback
                    activeButton.querySelector('div').classList.add('pulse-brand');
                    setTimeout(() => {
                        activeButton.querySelector('div').classList.remove('pulse-brand');
                    }, 1000);
                }

                // Add event listeners
                document.querySelectorAll('.like-button').forEach(button => {
                    button.addEventListener('click', () => handleEngagement('like', button));
                });

                document.querySelectorAll('.dislike-button').forEach(button => {
                    button.addEventListener('click', () => handleEngagement('dislike', button));
                });
            });
        </script>

    @else
        <div class="min-h-screen flex items-center justify-center bg-gray-50">
            <div class="text-center">
                <i class="fas fa-exclamation-triangle text-6xl text-red-600 mb-4"></i>
                <h1 class="headline-font text-4xl font-bold text-gray-800 mb-2">ARTICLE NOT FOUND</h1>
                <p class="text-gray-600">The requested article could not be located in our archives.</p>
            </div>
        </div>
    @endif
@endsection