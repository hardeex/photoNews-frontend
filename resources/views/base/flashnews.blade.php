<div class="bg-red-600 text-white py-3 overflow-hidden relative">
    <div class="flex items-center">
        <button onclick="toggleAnimation(this)" class="ml-4 focus:outline-none">
            <i class="fas fa-pause text-yellow-300"></i>
        </button>
        <div class="flash-news-container ml-8 md:ml-12">
            <div class="flash-news-scroll">
                {{-- Priority 1: Breaking News --}}
                @foreach ($breakingPostsData ?? [] as $news)
                    <span class="mx-12">
                        <i class="fas fa-exclamation-circle text-sm text-yellow-300"></i>
                        <a href="{{ route('post.details', $news['slug'] ?? '#') }}"
                           class="hover:text-gray-200 hover:underline ml-2">
                           {{ ucwords(strtolower($news['title'])) }}
                        </a>
                    </span>
                @endforeach

                {{-- Priority 2: Missing Persons --}}
                @foreach ($missingPosts ?? [] as $news)
                    <span class="mx-12">
                        <i class="fas fa-exclamation-triangle text-sm text-yellow-300"></i>
                        <a href="{{ route('missing-wanted.details', ['slug' => $news['slug']]) }}"
                           class="hover:text-gray-200 hover:underline ml-2">
                           MISSING PERSON: {{ ucwords(strtolower($news['title'] ?? '')) }}
                        </a>
                    </span>
                @endforeach

                {{-- Priority 3: Wanted Persons --}}
                @foreach ($wantedPosts ?? [] as $news)
                    <span class="mx-12">
                        <i class="fas fa-search text-sm text-yellow-300"></i>
                        <a href="{{ route('missing-wanted.details', ['slug' => $news['slug']]) }}"
                           class="hover:text-gray-200 hover:underline ml-2">
                           WANTED: {{ ucwords(strtolower($news['title'] ?? '')) }}
                        </a>
                    </span>
                @endforeach

                {{-- Priority 4: Obituaries --}}
                @foreach ($listObituaryPostsData['obituaryPostsData'] ?? [] as $news)
                    <span class="mx-12">
                        <i class="fas fa-heart text-sm"></i>
                        <a href="{{ route('posts-public-notice-details', ['slug' => $news['slug']]) }}"
                           class="hover:text-gray-200 hover:underline ml-2">
                           IN MEMORY: {{ ucwords(strtolower($news['title'] ?? '')) }}
                        </a>
                    </span>
                @endforeach

                {{-- Priority 5: Hot Gists --}}
                @foreach ($hotGistsPostsData ?? [] as $news)
                    <span class="mx-12">
                        <i class="fas fa-fire text-sm text-orange-300"></i>
                        <a href="{{ route('post.details', $news['slug'] ?? '#') }}"
                           class="hover:text-gray-200 hover:underline ml-2">
                           TRENDING: {{ ucwords(strtolower($news['title'] ?? '')) }}
                        </a>
                    </span>
                @endforeach

                {{-- Priority 6: Public Notice --}}
                @foreach ($publicNotice ?? [] as $news)
                    <span class="mx-12">
                        <i class="fas fa-bullhorn text-sm"></i>
                        <a href="{{ route('posts-public-notice-details', ['slug' => $news['slug']]) }}"
                           class="hover:text-gray-200 hover:underline ml-2">
                           PUBLIC NOTICE: {{ ucwords(strtolower($news['title'] ?? '')) }}
                        </a>
                    </span>
                @endforeach

                {{-- Priority 7: Today's Local News --}}
                @foreach ($localPostsData['posts'] ?? [] as $news)
                    @if (!empty($news['created_at']) && \Carbon\Carbon::parse($news['created_at'])->isToday())
                        <span class="mx-12">
                            <i class="fas fa-newspaper text-sm"></i>
                            <a href="{{ route('post.details', $news['slug'] ?? '#') }}"
                               class="hover:text-gray-200 hover:underline ml-2">
                               LOCAL: {{ ucwords(strtolower($news['title'] ?? '')) }}
                            </a>
                        </span>
                    @endif
                @endforeach

                {{-- Priority 8: Today's International News --}}
                @foreach ($internationalPostsData['posts'] ?? [] as $news)
                    @if (!empty($news['created_at']) && \Carbon\Carbon::parse($news['created_at'])->isToday())
                        <span class="mx-12">
                            <i class="fas fa-globe text-sm"></i>
                            <a href="{{ route('post.details', $news['slug'] ?? '#') }}"
                               class="hover:text-gray-200 hover:underline ml-2">
                               WORLD: {{ ucwords(strtolower($news['title'] ?? '')) }}
                            </a>
                        </span>
                    @endif
                @endforeach
            </div>
        </div>
    </div>

    <style>
        .flash-news-container {
            background: rgba(0, 0, 0, 0.1);
            width: calc(100% - 9rem);
            overflow: hidden;
            position: relative;
        }

        .flash-news-scroll {
            display: inline-flex;
            white-space: nowrap;
            padding-right: 50px;
            transition: transform .9s ease;
            transform: translateX(0);
        }

        .flash-news-scroll.clone {
            position: absolute;
            top: 0;
            left: 100%;
        }

        .flash-news-scroll.animated {
            animation: tickerScroll 900s linear infinite;
        }

        .flash-news-scroll.paused {
            animation-play-state: paused;
        }

        .flash-news-scroll:hover {
            animation-play-state: paused;
        }

        .flash-news-scroll a {
            font-size: 1.125rem;
        }

        @keyframes tickerScroll {
            0% { transform: translateX(0); }
            100% { transform: translateX(-100%); }
        }

        @media (max-width: 768px) {
            .flash-news-scroll.animated {
                animation-duration: 900s;
            }
            .flash-news-scroll a {
                font-size: 1.125rem;
            }
        }

        @media (min-width: 768px) {
            .flash-news-scroll a {
                font-size: 1.25rem;
            }
        }

        @media (prefers-reduced-motion: reduce) {
            .flash-news-scroll.animated {
                animation-duration: 900s;
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const scrollElements = document.querySelectorAll('.flash-news-scroll');
            const container = document.querySelector('.flash-news-container');
            const originalScroll = document.querySelector('.flash-news-scroll');

            // Start scrolling by adding animated class
            scrollElements.forEach(el => el.classList.add('animated'));

            // Clone content for seamless scrolling if needed
            if (originalScroll.scrollWidth < container.offsetWidth * 2) {
                const clone = originalScroll.cloneNode(true);
                clone.classList.add('clone');
                container.appendChild(clone);
            }

            // Auto-pause on hover with delay
            originalScroll.addEventListener('mouseenter', function() {
                setTimeout(() => {
                    this.classList.add('paused');
                }, 500);
            });
            originalScroll.addEventListener('mouseleave', function() {
                if (!document.querySelector('.flash-news-scroll.paused:not(:hover)')) {
                    this.classList.remove('paused');
                }
            });
        });

        function toggleAnimation(button) {
            const tickers = document.querySelectorAll('.flash-news-scroll');
            const icon = button.querySelector('i');

            tickers.forEach(ticker => {
                if (ticker.classList.contains('paused')) {
                    ticker.classList.remove('paused');
                    ticker.classList.add('animated');
                    icon.classList.remove('fa-play');
                    icon.classList.add('fa-pause');
                } else {
                    ticker.classList.add('paused');
                    ticker.classList.remove('animated');
                    icon.classList.remove('fa-pause');
                    icon.classList.add('fa-play');
                }
            });
        }
    </script>
</div>