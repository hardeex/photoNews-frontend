{{-- Compact Auto-Scrolling Flash News --}}
<div class="fixed top-27 left-0 right-0 z-50 overflow-hidden bg-red-600 text-white h-8 flex items-center">
    {{-- Play/Pause Button --}}
    <button onclick="toggleAnimation(this)" class="px-2 focus:outline-none flex-shrink-0 h-full border-r border-red-500">
        <i class="fas fa-pause text-yellow-300 text-xs"></i>
    </button>
    
    {{-- News Container --}}
    <div class="flex-1 overflow-hidden">
        <div class="flex animate-news-scroll whitespace-nowrap">
            {{-- Duplicate content for seamless loop --}}
            @for($i = 0; $i < 2; $i++)
                {{-- Priority 1: Breaking News --}}
                @foreach ($breakingPostsData ?? [] as $news)
                    <span class="inline-flex items-center gap-1 mx-4">
                        <i class="fas fa-exclamation-circle text-yellow-300 text-xs"></i>
                        <a href="{{ route('post.details', $news['slug'] ?? '#') }}"
                           class="hover:text-gray-200 hover:underline text-xs font-medium">
                           {{ Str::limit(ucwords(strtolower($news['title'])), 40) }}
                        </a>
                    </span>
                @endforeach

                {{-- Priority 2: Missing Persons --}}
                @foreach ($missingPosts ?? [] as $news)
                    <span class="inline-flex items-center gap-1 mx-4">
                        <i class="fas fa-exclamation-triangle text-yellow-300 text-xs"></i>
                        <a href="{{ route('missing-wanted.details', ['slug' => $news['slug']]) }}"
                           class="hover:text-gray-200 hover:underline text-xs font-medium">
                           MISSING: {{ Str::limit(ucwords(strtolower($news['title'] ?? '')), 35) }}
                        </a>
                    </span>
                @endforeach

                {{-- Priority 3: Wanted Persons --}}
                @foreach ($wantedPosts ?? [] as $news)
                    <span class="inline-flex items-center gap-1 mx-4">
                        <i class="fas fa-search text-yellow-300 text-xs"></i>
                        <a href="{{ route('missing-wanted.details', ['slug' => $news['slug']]) }}"
                           class="hover:text-gray-200 hover:underline text-xs font-medium">
                           WANTED: {{ Str::limit(ucwords(strtolower($news['title'] ?? '')), 35) }}
                        </a>
                    </span>
                @endforeach

                {{-- Priority 4: Obituaries --}}
                @foreach ($listObituaryPostsData['obituaryPostsData'] ?? [] as $news)
                    <span class="inline-flex items-center gap-1 mx-4">
                        <i class="fas fa-heart text-pink-300 text-xs"></i>
                        <a href="{{ route('posts-public-notice-details', ['slug' => $news['slug']]) }}"
                           class="hover:text-gray-200 hover:underline text-xs font-medium">
                           MEMORY: {{ Str::limit(ucwords(strtolower($news['title'] ?? '')), 35) }}
                        </a>
                    </span>
                @endforeach

                {{-- Priority 5: Hot Gists --}}
                @foreach ($hotGistsPostsData ?? [] as $news)
                    <span class="inline-flex items-center gap-1 mx-4">
                        <i class="fas fa-fire text-orange-300 text-xs"></i>
                        <a href="{{ route('post.details', $news['slug'] ?? '#') }}"
                           class="hover:text-gray-200 hover:underline text-xs font-medium">
                           HOT: {{ Str::limit(ucwords(strtolower($news['title'] ?? '')), 40) }}
                        </a>
                    </span>
                @endforeach

                {{-- Priority 6: Public Notice --}}
                @foreach ($publicNotice ?? [] as $news)
                    <span class="inline-flex items-center gap-1 mx-4">
                        <i class="fas fa-bullhorn text-blue-300 text-xs"></i>
                        <a href="{{ route('posts-public-notice-details', ['slug' => $news['slug']]) }}"
                           class="hover:text-gray-200 hover:underline text-xs font-medium">
                           NOTICE: {{ Str::limit(ucwords(strtolower($news['title'] ?? '')), 35) }}
                        </a>
                    </span>
                @endforeach

                {{-- Priority 7: Today's Local News --}}
                @foreach ($localPostsData['posts'] ?? [] as $news)
                    @if (!empty($news['created_at']) && \Carbon\Carbon::parse($news['created_at'])->isToday())
                        <span class="inline-flex items-center gap-1 mx-4">
                            <i class="fas fa-newspaper text-green-300 text-xs"></i>
                            <a href="{{ route('post.details', $news['slug'] ?? '#') }}"
                               class="hover:text-gray-200 hover:underline text-xs font-medium">
                               LOCAL: {{ Str::limit(ucwords(strtolower($news['title'] ?? '')), 35) }}
                            </a>
                        </span>
                    @endif
                @endforeach

                {{-- Priority 8: Today's International News --}}
                @foreach ($internationalPostsData['posts'] ?? [] as $news)
                    @if (!empty($news['created_at']) && \Carbon\Carbon::parse($news['created_at'])->isToday())
                        <span class="inline-flex items-center gap-1 mx-4">
                            <i class="fas fa-globe text-cyan-300 text-xs"></i>
                            <a href="{{ route('post.details', $news['slug'] ?? '#') }}"
                               class="hover:text-gray-200 hover:underline text-xs font-medium">
                               WORLD: {{ Str::limit(ucwords(strtolower($news['title'] ?? '')), 35) }}
                            </a>
                        </span>
                    @endif
                @endforeach
            @endfor
        </div>
    </div>
</div>

<style>
@keyframes news-scroll {
    0% {
        transform: translateX(0);
    }
    100% {
        transform: translateX(-50%);
    }
}

.animate-news-scroll {
    animation: news-scroll 60s linear infinite;
}

.animate-news-scroll:hover {
    animation-play-state: paused;
}

.animate-news-scroll.paused {
    animation-play-state: paused;
}
</style>

<script>
function toggleAnimation(button) {
    const ticker = document.querySelector('.animate-news-scroll');
    const icon = button.querySelector('i');
    
    if (ticker.classList.contains('paused')) {
        ticker.classList.remove('paused');
        icon.classList.remove('fa-play');
        icon.classList.add('fa-pause');
    } else {
        ticker.classList.add('paused');
        icon.classList.remove('fa-pause');
        icon.classList.add('fa-play');
    }
}
</script>