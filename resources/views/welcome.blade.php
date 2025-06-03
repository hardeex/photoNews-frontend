@extends('base.base')
@section('title', 'Home - Essential Nigeria News')

@section('content')

    <div class="bg-gray-100 min-h-screen">


        <main class="container mx-auto px-4 py-8">
            <section class="bg-purple-700 text-white p-4 md:p-8 rounded-lg mb-8">
                <h1 class="text-2xl md:text-3xl font-bold mb-4">EXPLORE THE WORLD WITH US</h1>
                <form action="#" method="GET" class="flex">
                    <input type="text" name="query" placeholder="Search news, birthday, obituary..."
                        class="flex-grow p-2 rounded-l-lg text-black">
                    <button type="submit" class="bg-pink-500 p-2 rounded-r-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </button>
                </form>
            </section>


            @include('headline-photo')
            @include('homepage.headline')
            @include('homepage.stats')
            @include('homepage.live-video')
            @include('base.ereport-banner')
            @include('homepage.latest')
            @include('banner.editor')
            @include('homepage.public-notice')
            @include('homepage.annocement')
            @include('homepage.edirect-banner')
            @include('homepage.entertainment')
            @include('homepage.caveat')
            @include('homepage.hot-gist')
            @include('homepage.birthday')
            @include('homepage.missing-and-wanted')
            @include('homepage.event')
            @include('homepage.featured-topic')
            @include('homepage.missing-wanted-data')
            @include('homepage.category')
            @include('homepage.top-topic')

@include('homepage.obituary')


@include('homepage.change-of-name')

   @include('homepage.pride-of-nigeria')
@include('homepage.event-ticket')

@include('homepage.who-is-taken')


  @include('homepage.hotel-intro')

@include('homepage.stolen-vehicle')

@include('homepage.wedding')


@include('homepage.naming')

  
    </main>


    <!--- share code implementation--->
    <!-- Toast Notification for Share Success -->
    <div id="shareToast"
        class="fixed bottom-4 right-4 bg-green-500 text-white px-6 py-3 rounded-lg shadow-lg transform translate-y-full opacity-0 transition-all duration-300 hidden">
        Link copied to clipboard!
    </div>

    <!-- JavaScript for Share Functionality -->
    <script>
        function sharePost(url, title) {
            if (navigator.share) {
                // Use Web Share API if available (mostly mobile devices)
                navigator.share({
                    title: title,
                    url: url
                }).catch((error) => {
                    if (error.name !== 'AbortError') {
                        console.error('Error sharing:', error);
                        fallbackShare(url);
                    }
                });
            } else {
                // Fallback to clipboard
                fallbackShare(url);
            }
        }

        function fallbackShare(url) {
            navigator.clipboard.writeText(url)
                .then(() => showToast())
                .catch((error) => {
                    console.error('Failed to copy:', error);
                });
        }

        function showToast() {
            const toast = document.getElementById('shareToast');
            toast.classList.remove('hidden');
            // Wait a tiny bit before adding the show classes
            setTimeout(() => {
                toast.classList.remove('translate-y-full', 'opacity-0');
            }, 10);

            // Hide the toast after 3 seconds
            setTimeout(() => {
                toast.classList.add('translate-y-full', 'opacity-0');
                setTimeout(() => {
                    toast.classList.add('hidden');
                }, 300);
            }, 3000);
        }
    </script>

@endsection
