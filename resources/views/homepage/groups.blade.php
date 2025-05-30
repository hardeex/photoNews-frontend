
    <section class="container mx-auto px-4 py-8">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold">Groups You May Like</h2>
            <a href="#" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">Join
                The Topic Discussions</a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ([
            [
                'title' => 'Current Affairs',
                'description' => 'Stay informed with the latest developments in the world. Discuss current events, analyze their impact, and engage in meaningful debates about the issues that shape our lives.',
                'action' => 'Join!',
            ],
            [
                'title' => 'Diverse Perspectives',
                'description' => 'Join a diverse community of thinkers and share your unique viewpoints, challenging thoughts, and innovative ideas. Expand your worldview by engaging with different perspectives in this vibrant forum.',
                'action' => 'Join!',
            ],
            [
                'title' => 'Voice Your Opinions',
                'description' => 'Have your say on the topics that matter to you. Share your insights, views, and solutions to global challenges that help shape public opinion. Our community values every voice that can make a real difference.',
                'action' => 'Join!',
            ],
            [
                'title' => 'Connect with Like-Minded Individuals',
                'description' => 'Connect with others who share your interests and passions. Engage in stimulating conversations where you can find like-minded individuals to connect with, learn from, and build relationships with.',
                'action' => 'Join!',
            ],
            [
                'title' => 'Access Expert Analysis',
                'description' => 'Gain access to in-depth analysis and commentary on leading issues from experts in various fields. Engage in discussions with professionals and experts to enhance your understanding and broaden your knowledge.',
                'action' => 'Join!',
            ],
            [
                'title' => 'Stay Civically Engaged',
                'description' => 'Being part of our discussion groups is not just about debating ideas, it\'s about actively participating in civil discourse and contributing to a more informed and engaged society. Join us in fostering constructive dialogue and civic engagement.',
                'action' => 'Join!',
            ],
        ] as $group)
                <div class="bg-gray-100 p-6 rounded-lg shadow">
                    <h3 class="text-xl font-semibold mb-3">{{ $group['title'] }}</h3>
                    <p class="mb-4">{{ $group['description'] }}</p>
                    <a href="#"
                        class="inline-block bg-orange-500 text-white px-4 py-2 rounded hover:bg-orange-600 transition">{{ $group['action'] }}</a>
                </div>
            @endforeach
        </div>

        <div class="mt-12 bg-gray-900 text-white p-6 rounded-lg flex flex-col md:flex-row items-center justify-between">
            <div class="mb-4 md:mb-0">
                <h3 class="text-xl font-semibold mb-2">Subscribe To Our Newsletter</h3>
                <p>Don't miss out on latest updates and information</p>
            </div>
            <form class="flex w-full md:w-auto">
                <input type="email" placeholder="Enter your email"
                    class="px-4 py-2 rounded-l text-gray-900 w-full md:w-64">
                <button type="submit"
                    class="bg-red-500 text-white px-4 py-2 rounded-r hover:bg-red-600 transition">Subscribe</button>
            </form>
        </div>
    </section>
