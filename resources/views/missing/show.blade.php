@extends('base.base')
@section('title', $post['title'] ?? 'Post Details')

@section('content')
    @if ($post)
        <div class="bg-gray-100 min-h-screen pb-12">
            <main class="max-w-7xl mx-auto mt-8 px-4 sm:px-6 lg:px-8">
                <article class="bg-white rounded-lg shadow-lg overflow-hidden">
                    <!-- Image Section -->

                    <!-- Featured image -->
                    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
                        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                            <!-- Featured Image Section -->
                            <div class="relative">
                                <div class="aspect-w-16 aspect-h-9">
                                    @if ($post['featured_image'])
                                        <img src="{{ $post['featured_image'] }}"
                                            alt="{{ ucwords(strtolower($post['title'])) }}" class="w-full h-full object-cover"
                                            loading="lazy">
                                    @else
                                        <img src="https://picsum.photos/seed/news/1200/600"
                                            alt="{{ ucwords(strtolower($post['title'])) }}"
                                            class="w-full h-full object-cover" loading="lazy">
                                    @endif
                                </div>

                                <!-- Category Badge -->
                                @if (isset($post['category_names']) || (isset($post['category']) && isset($post['category']['name'])))
                                    <div class="absolute top-4 right-4">
                                        <span
                                            class="inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold bg-red-600 text-white shadow-lg transform hover:scale-105 transition-transform duration-200">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                            </svg>
                                            {{ isset($post['category_names'])
                                                ? ucwords(strtolower($post['category_names']))
                                                : ucwords(strtolower($post['category']['name'])) }}
                                        </span>
                                    </div>
                                @endif
                            </div>

                            <!-- Article Header Content -->
                            <div class="p-6 sm:p-8 lg:p-10">
                                <!-- Title -->
                                <h1 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-gray-900 tracking-tight mb-6">
                                    {{ ucwords(strtolower($post['title'])) }}
                                </h1>

                                <!-- Article Meta Information -->
                                <div class="flex flex-wrap gap-6 text-base text-gray-600 mb-8">
                                    <!-- Publication Date -->
                                    <div class="flex items-center">
                                        <div class="p-2 bg-gray-100 rounded-full mr-3">
                                            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                            </svg>
                                        </div>
                                        <span>
                                            Published on {{ \Carbon\Carbon::parse($post['created_at'])->format('F d, Y') }}
                                        </span>
                                    </div>

                                    <!-- Author -->
                                    <div class="flex items-center">
                                        <div class="p-2 bg-gray-100 rounded-full mr-3">
                                            <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                            </svg>
                                        </div>
                                        {{-- <span>
                                            By {{ $post['created_by_name'] }}
                                        </span> --}}
                                    </div>

                                    <!-- Category -->
                                    @if (isset($category_names))
                                        <div class="flex items-center">
                                            <div class="p-2 bg-gray-100 rounded-full mr-3">
                                                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                                </svg>
                                            </div>
                                            <span>
                                                {{ ucwords(strtolower($category_name['name'])) }}
                                            </span>
                                        </div>
                                    @endif
                                </div>

                                <!-- Optional Divider -->
                                <hr class="border-gray-200 mb-8">
                            </div>
                        </div>
                    </div>




                    <!-- Content Section -->
                    <div>

                        <div class="container mx-auto">
                            {{-- <div class="flex flex-col md:flex-row gap-5">
                                <div class="flex-1 p-5 bg-white rounded shadow">
                                    {!! $post['content'] !!}
                                </div>
                            </div> --}}

                            {{-- <div class="flex flex-col md:grid md:grid-cols-2 lg:grid-cols-3 gap-5">
                                <div class="flex-1 p-5 bg-white rounded shadow">
                                    {!! $post['content'] !!}
                                </div>
                            </div> --}}

                            <article class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
                                <div class="bg-white rounded-xl shadow-md">
                                    <div class="p-6 sm:p-8 lg:p-10">
                                        {{-- Article Content with Enhanced Typography --}}
                                        <div
                                            class="prose prose-lg lg:prose-xl max-w-none 
                                                   prose-headings:mb-8 
                                                   prose-p:mb-8 
                                                   prose-p:leading-relaxed 
                                                   prose-p:text-gray-800 
                                                   prose-li:mb-4 
                                                   prose-img:my-12
                                                   prose-blockquote:my-12">

                                            {{-- Custom styles for links to make them more noticeable --}}
                                            <div
                                                class="[&_a]:text-blue-600 
                                                        [&_a]:underline 
                                                        [&_a]:decoration-2 
                                                        [&_a]:underline-offset-2 
                                                        [&_a:hover]:text-blue-800">

                                                {{-- Add extra paragraph spacing --}}
                                                <div
                                                    class="[&>p:not(:last-child)]:mb-8
                                                           [&>ul]:my-8 
                                                           [&>ol]:my-8
                                                           [&>h2]:mt-12
                                                           [&>h3]:mt-10">
                                                    {!! $post['content'] !!}
                                                </div>
                                            </div>
                                        </div>

                                        {{-- Optional Section Break --}}
                                        <hr class="my-10 border-gray-200">

                                        {{-- Tags Section with Improved Visibility --}}
                                        {{-- @if (isset($post['tags']) && count($post['tags']) > 0)
                                            <div class="flex flex-wrap gap-3 mt-8">
                                                @foreach ($post['tags'] as $tag)
                                                    <span
                                                        class="px-4 py-2 text-base bg-gray-100 text-gray-700 rounded-full hover:bg-gray-200 transition-colors duration-200">
                                                        {{ $tag }}
                                                    </span>
                                                @endforeach
                                            </div>
                                        @endif --}}

                                        {{-- Optional Reading Progress Indicator --}}
                                        <div class="fixed top-0 left-0 w-full h-1 bg-gray-100">
                                            <div class="h-full bg-blue-500 transition-all duration-200"
                                                id="reading-progress" style="width: 0%">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </article>

                            {{-- Add Reading Progress Script --}}
                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    window.addEventListener('scroll', function() {
                                        const winScroll = document.body.scrollTop || document.documentElement.scrollTop;
                                        const height = document.documentElement.scrollHeight - document.documentElement
                                            .clientHeight;
                                        const scrolled = (winScroll / height) * 100;
                                        document.getElementById('reading-progress').style.width = scrolled + '%';
                                    });
                                });
                            </script>



                            <!-- Social Share -->
                            <div>
                                <div class="max-w-3xl  bg-white rounded-lg  p-6">
                                    <h4 class="text-lg font-semibold mb-4">Share this article:</h4>
                                    <div class="flex flex-wrap gap-2">
                                        <button
                                            class="share-button bg-blue-600 hover:bg-blue-700 text-white font-medium py-2 px-3 rounded-full text-sm flex items-center transition duration-300"
                                            data-platform="facebook">
                                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                                <path
                                                    d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                                            </svg>
                                            Facebook
                                        </button>
                                        <button
                                            class="share-button bg-blue-400 hover:bg-blue-500 text-white font-medium py-2 px-3 rounded-full text-sm flex items-center transition duration-300"
                                            data-platform="twitter">
                                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                                <path
                                                    d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z" />
                                            </svg>
                                            Twitter
                                        </button>
                                        <button
                                            class="share-button bg-blue-700 hover:bg-blue-800 text-white font-medium py-2 px-3 rounded-full text-sm flex items-center transition duration-300"
                                            data-platform="linkedin">
                                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                                <path
                                                    d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z" />
                                            </svg>
                                            LinkedIn
                                        </button>
                                        <button
                                            class="bg-red-600 hover:bg-red-700 text-white font-medium py-2 px-3 rounded-full text-sm flex items-center transition duration-300">
                                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                                <path
                                                    d="M12 2C6.477 2 2 6.477 2 12s4.477 10 10 10 10-4.477 10-10S17.523 2 12 2zm3.18 15.293l-1.414 1.414L12 15.414l-1.764 1.764-1.414-1.414L10.586 12 8.828 10.243l1.414-1.414L12 10.586l1.764-1.764 1.414 1.414L13.414 12l1.764 1.764z" />
                                            </svg>
                                            Google
                                        </button>
                                        <button
                                            class="bg-orange-600 hover:bg-orange-700 text-white font-medium py-2 px-3 rounded-full text-sm flex items-center transition duration-300">
                                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                                <path
                                                    d="M12 2C6.477 2 2 6.477 2 12s4.477 10 10 10 10-4.477 10-10S17.523 2 12 2zm0 18c-4.418 0-8-3.582-8-8s3.582-8 8-8 8 3.582 8 8-3.582 8-8 8zm-1-13h2v6h-2zm0 8h2v2h-2z" />
                                            </svg>
                                            Reddit
                                        </button>
                                        <button
                                            class="bg-green-500 hover:bg-green-600 text-white font-medium py-2 px-3 rounded-full text-sm flex items-center transition duration-300">
                                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                                <path
                                                    d="M12 1.5C5.645 1.5 1 6.146 1 12c0 5.024 4.157 10.004 10.074 10.004C18.433 22.004 22 17.198 22 12c0-5.854-4.645-10.5-10-10.5zm1.2 15.3h-2.4v-2.4h2.4v2.4zm0-3.6h-2.4V7.2h2.4v6.6z" />
                                            </svg>
                                            WhatsApp
                                        </button>
                                        <button
                                            class="bg-gray-600 hover:bg-gray-700 text-white font-medium py-2 px-3 rounded-full text-sm flex items-center transition duration-300">
                                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                                <path
                                                    d="M21 1H3C1.346 1 0 2.346 0 4v16c0 1.654 1.346 3 3 3h18c1.654 0 3-1.346 3-3V4c0-1.654-1.346-3-3-3zm-1 18H4c-.553 0-1-.447-1-1s.447-1 1-1h16c.553 0 1 .447 1 1s-.447 1-1 1zm0-4H4c-.553 0-1-.447-1-1s.447-1 1-1h16c.553 0 1 .447 1 1s-.447 1-1 1zm0-4H4c-.553 0-1-.447-1-1s.447-1 1-1h16c.553 0 1 .447 1 1s-.447 1-1 1zm0-4H4c-.553 0-1-.447-1-1s.447-1 1-1h16c.553 0 1 .447 1 1s-.447 1-1 1z" />
                                            </svg>
                                            Copy Link
                                        </button>
                                        <button
                                            class="bg-black hover:bg-gray-800 text-white font-medium py-2 px-3 rounded-full text-sm flex items-center transition duration-300">
                                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                                <path
                                                    d="M19.745 4.092a1 1 0 00-.168 1.415c.324.367.768.542 1.21.542h.01c.44 0 .884-.175 1.207-.493a1 1 0 00-.042-1.455l-4.123-3.88a1 1 0 00-1.36.094L14.646 6.96c-.375.495-.234 1.195.28 1.568a1 1 0 001.445-.197l2.888-3.356 1.308 1.252-1.537 1.755a1 1 0 00.45 1.537c.577.285 1.283.134 1.693-.287a1 1 0 00.195-1.44L17.8 7.079c.463-.548.374-1.465-.246-1.786-.621-.332-1.467-.112-1.786.246l-2.69 3.188a1 1 0 00.174 1.397c.268.202.608.285.927.197.318-.088.624-.292.798-.592.162-.293.194-.617.094-.94l2.393-2.628c.161-.193.084-.477-.146-.637l-2.576-1.737a1 1 0 00-1.392.135L9.658 11.48l-3.993 2.686c-.606.407-1.5.263-1.905-.343-.404-.605-.263-1.5.344-1.905L9.22 9.143l-3.198-2.023c-.58-.379-.731-1.141-.354-1.724.373-.557 1.052-.706 1.608-.354l3.407 2.17 4.646-4.308c.178-.165.423-.26.673-.272.25-.012.482.073.658.229l.213.173 3.278 3.069zm-5.517 1.984a1 1 0 10-1.414 1.415l.348.348c-.325.292-.515.662-.515 1.067 0 .63.237 1.193.654 1.62a1 1 0 001.414-1.415l-.348-.348c.325-.292.515-.662.515-1.067 0-.63-.237-1.193-.654-1.62z" />
                                            </svg>
                                            TikTok
                                        </button>
                                        <button
                                            class="bg-yellow-400 hover:bg-yellow-500 text-white font-medium py-2 px-3 rounded-full text-sm flex items-center transition duration-300">
                                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                                <path
                                                    d="M15.7 3.2c-.2 0-.5 0-.7.1-.4.1-.8.2-1.2.4-.3.2-.5.5-.5.9v4c0 .3.1.5.4.6l1.6.6c.2.1.3.3.3.5v7.7c0 .3.2.5.5.5h2.3c.3 0 .5-.2.5-.5V12c0-2.2-1.8-4-4-4h-.3V4c0-.3-.1-.5-.3-.7-.2-.2-.4-.2-.7-.2zm-1.4 1c.4 0 .7.3.7.7v6.5h2.2c1.2 0 2.1.9 2.1 2.1v5.6h-1.7V10h-4V5.2c0-.5.3-.9.8-.9z" />
                                            </svg>
                                            Snapchat
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                </article>

                <script>
                    // The sharing ability-->

                    // Define a function to get the URL of the current page dynamically.
                    function getShareUrl() {
                        return window.location.href; // I will add custom url later
                    }

                    // Attach event listeners to the share buttons.
                    document.querySelectorAll('.share-button').forEach(button => {
                        button.addEventListener('click', function() {
                            const platform = this.getAttribute('data-platform');
                            const shareUrl = getShareUrl();

                            // Determine the platform and open the respective share link.
                            switch (platform) {
                                case 'facebook':
                                    window.open(
                                        `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(shareUrl)}`,
                                        '_blank');
                                    break;
                                case 'twitter':
                                    window.open(`https://twitter.com/intent/tweet?url=${encodeURIComponent(shareUrl)}`,
                                        '_blank');
                                    break;
                                case 'linkedin':
                                    window.open(
                                        `https://www.linkedin.com/shareArticle?mini=true&url=${encodeURIComponent(shareUrl)}`,
                                        '_blank');
                                    break;
                                case 'google':
                                    window.open(`https://plus.google.com/share?url=${encodeURIComponent(shareUrl)}`,
                                        '_blank');
                                    break;
                                case 'whatsapp':
                                    window.open(`https://api.whatsapp.com/send?text=${encodeURIComponent(shareUrl)}`,
                                        '_blank');
                                    break;
                                case 'reddit':
                                    window.open(`https://www.reddit.com/submit?url=${encodeURIComponent(shareUrl)}`,
                                        '_blank');
                                    break;
                                case 'tiktok':
                                    alert(
                                        "TikTok sharing isn't supported directly by URL, you can copy the link instead!"
                                    );
                                    break;
                                case 'snapchat':
                                    alert(
                                        "Snapchat sharing isn't supported directly by URL, you can copy the link instead!"
                                    );
                                    break;
                                case 'copy':
                                    navigator.clipboard.writeText(shareUrl).then(() => {
                                        alert("Link copied to clipboard!");
                                    });
                                    break;
                                default:
                                    alert("Sharing not available for this platform.");
                            }
                        });
                    });
                </script>

                <!--- comment section for each blog start-->
                <div class="mt-12 bg-white rounded-lg shadow-lg p-6 sm:p-10">
                    <h2 class="text-2xl font-bold mb-6">Comments (15)</h2>

                    <!-- Updated Comment Form -->
                    <form class="mb-8">
                        <div class="grid grid-cols-1 gap-6">
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                                <input type="text" name="name" id="name"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                    placeholder="Your name" required>
                            </div>
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                                <input type="email" name="email" id="email"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                    placeholder="your@email.com" required>
                            </div>
                            <div>
                                <label for="comment" class="block text-sm font-medium text-gray-700">Your comment</label>
                                <textarea id="comment" name="comment" rows="3"
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                    placeholder="What are your thoughts?" required></textarea>
                            </div>
                        </div>
                        <div class="flex justify-end mt-4">
                            <button type="submit"
                                class="px-4 py-2 bg-gradient-to-r from-red-500 to-white text-blue-900 rounded-md 
                                   hover:from-red-600 hover:to-red-300 
                                   focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 
                                   transition duration-300 ease-in-out">
                                Post Comment
                            </button>
                        </div>


                    </form>

                    <!-- The rest of the comment section remains the same -->
                    <!-- Comments List -->
                    <div class="space-y-6">
                        <!-- Sample Comment -->
                        <div class="flex space-x-4">
                            <div class="flex-shrink-0">
                                <img class="h-10 w-10 rounded-full" src="/images/news-image.jpeg" alt="User avatar">
                            </div>
                            <div class="flex-grow">
                                <div class="flex items-center justify-between">
                                    <h3 class="text-sm font-medium text-gray-900">Jane Doe</h3>
                                    <p class="text-sm text-gray-500">2 hours ago</p>
                                </div>
                                <div class="mt-1 text-sm text-gray-700">
                                    <p>This article provides a comprehensive overview of the current situation. I appreciate
                                        the
                                        balanced reporting and the inclusion of various perspectives. It's crucial to have
                                        access to such well-researched information in today's fast-paced news environment.
                                    </p>
                                </div>
                                <div class="mt-2 flex items-center space-x-4">
                                    <button class="text-sm text-gray-500 hover:text-blue-600 flex items-center space-x-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5" />
                                        </svg>
                                        <span>Like (23)</span>
                                    </button>
                                    <button class="text-sm text-gray-500 hover:text-blue-600">Reply</button>
                                </div>
                            </div>
                        </div>

                        <!-- More comments would be listed here -->
                        @for ($i = 0; $i < 2; $i++)
                            <div class="flex space-x-4">
                                <div class="flex-shrink-0">
                                    <img class="h-10 w-10 rounded-full" src="/images/news-image.jpeg" alt="User avatar">
                                </div>
                                <div class="flex-grow">
                                    <div class="flex items-center justify-between">
                                        <h3 class="text-sm font-medium text-gray-900">User {{ $i + 1 }}</h3>
                                        <p class="text-sm text-gray-500">{{ $i + 3 }} hours ago</p>
                                    </div>
                                    <div class="mt-1 text-sm text-gray-700">
                                        <p>This is a placeholder comment. In a real application, this would be replaced with
                                            actual user comments.</p>
                                    </div>
                                    <div class="mt-2 flex items-center space-x-4">
                                        <button
                                            class="text-sm text-gray-500 hover:text-blue-600 flex items-center space-x-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5" />
                                            </svg>
                                            <span>Like ({{ 10 - $i }})</span>
                                        </button>
                                        <button class="text-sm text-gray-500 hover:text-blue-600">Reply</button>
                                    </div>
                                </div>
                            </div>
                        @endfor
                    </div>

                    <!-- Pagination -->
                    <div class="mt-8 flex justify-center">
                        <nav class="relative z-0 inline-flex rounded-md shadow-sm -space-x-px" aria-label="Pagination">
                            <a href="#"
                                class="relative inline-flex items-center px-2 py-2 rounded-l-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                <span class="sr-only">Previous</span>
                                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                    fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd"
                                        d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                        clip-rule="evenodd" />
                                </svg>
                            </a>
                            <a href="#"
                                class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">
                                1 </a>
                            <a href="#"
                                class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">
                                2 </a>
                            <a href="#"
                                class="relative inline-flex items-center px-4 py-2 border border-gray-300 bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">
                                3 </a>
                            <a href="#"
                                class="relative inline-flex items-center px-2 py-2 rounded-r-md border border-gray-300 bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                <span class="sr-only">Next</span>
                                <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                    fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd"
                                        d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                        clip-rule="evenodd" />
                                </svg>
                            </a>
                        </nav>
                    </div>
                </div>

                <!--- comment section for each blog ends-->


            </main>
        @else
            <p>Post not found.</p>
    @endif
    </div>
@endsection
