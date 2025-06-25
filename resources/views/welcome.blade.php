@extends('base.base')
@section('title', 'Home - Essential Nigeria News')

@section('content')

    <div class="bg-gray-100 min-h-screen">


        <main class="container mx-auto px-4 py-8">
          @include('homepage.search')


            @include('headline-photo')
            @include('homepage.headline')
            @include('homepage.stats')
            @include('homepage.live-video')
            @include('base.ereport-banner')
            @include('homepage.latest')
            @include('banner.editor')
            @include('homepage.public-notice')
            @include('homepage.category')
            {{-- @include('homepage.annocement') --}}
            @include('homepage.edirect-banner')
            @include('homepage.entertainment')
            @include('homepage.caveat')
            @include('homepage.hot-gist')
            @include('homepage.birthday')
            @include('homepage.missing-and-wanted')
            @include('homepage.event')
            @include('homepage.featured-topic')
            @include('homepage.missing-wanted-data')
            
            @include('homepage.top-topic')

@include('homepage.obituary')


@include('homepage.change-of-name')

   @include('homepage.pride-of-nigeria')
@include('homepage.event-ticket')

{{-- @include('homepage.who-is-taken') --}}


  @include('homepage.hotel-intro')

@include('homepage.stolen-vehicle')

@include('homepage.wedding')


@include('homepage.naming')
@include('homepage.what-you-missed')

  
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
