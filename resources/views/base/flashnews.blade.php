<div class="bg-red-600 text-white py-3 overflow-hidden relative">
    
    <div class="flash-news-container ml-36 md:ml-44">
        <div class="flash-news-scroll">
            {{-- Priority 1: Breaking News --}}
            @foreach ($breakingPostsData ?? [] as $news)
                <span class="mx-10">
                    <i class="fas fa-exclamation-circle text-sm text-yellow-300"></i>
                    <a href="{{ route('post.details', $news['slug'] ?? '#') }}"
                        class="hover:text-gray-200 hover:underline ml-2 text-base md:text-lg">
                        {{ ucwords(strtolower($news['title'])) }}
                    </a>
                </span>
            @endforeach

            {{-- Priority 2: Missing Persons --}}
            @foreach ($missingPosts ?? [] as $news)
                <span class="mx-10">
                    <i class="fas fa-exclamation-triangle text-sm text-yellow-300"></i>
                    <a href="{{ route('missing-wanted.details', ['slug' => $post['slug']]) }}"
                        class="hover:text-gray-200 hover:underline ml-2 text-base md:text-lg">
                        MISSING PERSON: {{ ucwords(strtolower($news['title'] ?? '')) }}
                    </a>
                </span>
            @endforeach

            {{-- Priority 3: Wanted Persons --}}
            @foreach ($wantedPosts ?? [] as $news)
                <span class="mx-10">
                    <i class="fas fa-search text-sm text-yellow-300"></i>
                    <a href="{{ route('missing-wanted.details', ['slug' => $post['slug']]) }}"
                        class="hover:text-gray-200 hover:underline ml-2 text-base md:text-lg">
                        WANTED: {{ ucwords(strtolower($news['title'] ?? '')) }}
                    </a>
                </span>
            @endforeach

            {{-- Priority 4: Obituaries --}}
            @foreach ($listObituaryPostsData['obituaryPostsData'] ?? [] as $news)
                <span class="mx-10">
                    <i class="fas fa-heart text-sm"></i>
                    <a href="{{ route('posts-public-notice-details', ['slug' => $post['slug']]) }}"
                        class="hover:text-gray-200 hover:underline ml-2 text-base md:text-lg">
                        IN MEMORY: {{ ucwords(strtolower($news['title'] ?? '')) }}
                    </a>
                </span>
            @endforeach

            {{-- Priority 5: Hot Gists --}}
            @foreach ($hotGistsPostsData ?? [] as $news)
                <span class="mx-10">
                    <i class="fas fa-fire text-sm text-orange-300"></i>
                    <a href="{{ route('post.details', $news['slug'] ?? '#') }}"
                        class="hover:text-gray-200 hover:underline ml-2 text-base md:text-lg">
                        TRENDING: {{ ucwords(strtolower($news['title'] ?? '')) }}
                    </a>
                </span>
            @endforeach

            {{-- Priority 6: Public Notice --}}
            @foreach ($publicNotice ?? [] as $news)
                <span class="mx-10">
                    <i class="fas fa-bullhorn text-sm"></i>
                    <a href="{{ route('posts-public-notice-details', ['slug' => $post['slug']]) }}"
                        class="hover:text-gray-200 hover:underline ml-2 text-base md:text-lg">
                        PUBLIC NOTICE: {{ ucwords(strtolower($news['title'] ?? '')) }}
                    </a>
                </span>
            @endforeach

            {{-- Priority 7: Today's Local News --}}
            @foreach ($localPostsData['posts'] ?? [] as $news)
                @if (!empty($news['created_at']) && \Carbon\Carbon::parse($news['created_at'])->isToday())
                    <span class="mx-10">
                        <i class="fas fa-newspaper text-sm"></i>
                        <a href="{{ route('post.details', $news['slug'] ?? '#') }}"
                            class="hover:text-gray-200 hover:underline ml-2 text-base md:text-lg">
                            LOCAL: {{ ucwords(strtolower($news['title'] ?? '')) }}
                        </a>
                    </span>
                @endif
            @endforeach

            {{-- Priority 8: Today's International News --}}
            @foreach ($internationalPostsData['posts'] ?? [] as $news)
                @if (!empty($news['created_at']) && \Carbon\Carbon::parse($news['created_at'])->isToday())
                    <span class="mx-10">
                        <i class="fas fa-globe text-sm"></i>
                        <a href="{{ route('post.details', $news['slug'] ?? '#') }}"
                            class="hover:text-gray-200 hover:underline ml-2 text-base md:text-lg">
                            WORLD: {{ ucwords(strtolower($news['title'] ?? '')) }}
                        </a>
                    </span>
                @endif
            @endforeach
        </div>
    </div>



    <style>
        .flash-news-container {
            width: calc(100% - 9rem);
            overflow: hidden;
            position: relative;
        }

        .flash-news-scroll {
            display: inline-flex;
            white-space: nowrap;
            padding-right: 50px;
            animation: none;
            /* Remove default animation */
            transform: translateX(0);
            /* Start from visible position */
        }

        .flash-news-scroll.clone {
            position: absolute;
            top: 0;
            left: 100%;
        }

        .flash-news-scroll.animated {
            animation: tickerScroll 180s linear infinite;
            /* Much slower animation - 3 minutes per cycle */
            animation-delay: 0s;
            /* Start immediately */
        }

        .flash-news-scroll.paused {
            animation-play-state: paused;
        }

        .flash-news-scroll:hover {
            animation-play-state: paused;
        }

        @keyframes tickerScroll {
            0% {
                transform: translateX(0);
            }

            100% {
                transform: translateX(-100%);
            }
        }

        /* Slower on mobile for better readability */
        @media (max-width: 768px) {
            .flash-news-scroll.animated {
                animation-duration: 200s;
            }
        }

        /* Even slower for users who prefer reduced motion */
        @media (prefers-reduced-motion: reduce) {
            .flash-news-scroll.animated {
                animation-duration: 240s;
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Start animation as soon as the page loads
            const scrollElements = document.querySelectorAll('.flash-news-scroll');
            scrollElements.forEach(el => el.classList.add('animated'));

            // Clone content for seamless scrolling if needed
            const container = document.querySelector('.flash-news-container');
            const originalScroll = document.querySelector('.flash-news-scroll');

            // Ensure content fills viewport
            if (originalScroll.scrollWidth < container.offsetWidth * 2) {
                const clone = originalScroll.cloneNode(true);
                clone.classList.add('clone');
                container.appendChild(clone);
            }
        });

        function toggleAnimation(button) {
            const tickers = document.querySelectorAll('.flash-news-scroll');
            const icon = button.querySelector('i');

            tickers.forEach(ticker => {
                if (ticker.classList.contains('paused')) {
                    ticker.classList.remove('paused');
                    icon.classList.remove('fa-play');
                    icon.classList.add('fa-pause');
                } else {
                    ticker.classList.add('paused');
                    icon.classList.remove('fa-pause');
                    icon.classList.add('fa-play');
                }
            });
        }
    </script>
