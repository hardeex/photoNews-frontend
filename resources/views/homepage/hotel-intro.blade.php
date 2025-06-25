  <section class="container mx-auto px-4 py-8">
    <a href="https://ebnbhotel.com/"></a>
        <h2 class="text-3xl font-bold mb-6">Book A Hotel Before Leaving</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
            <div class="relative">
                <img src="{{ asset('/images/hotel_image1.jpeg') }}" alt="Luxury hotel room"
                    class="w-full h-64 object-cover rounded-lg">
                <div class="absolute bottom-4 left-4 bg-white px-3 py-1 rounded">
                    <p class="text-sm font-semibold">Hundreds of 5-star reviews</p>
                </div>
                <a href="http://ebnbhotel.com/"
                    class="absolute bottom-4 right-4 bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 transition">Book
                    Now</a>
            </div>

            <div>
                <h3 class="text-2xl font-semibold mb-4 text-red-600">You will be amazed by what we have prepared
                    for you</h3>
                <p class="mb-4">Prepare to be enchanted by our warm hospitality and personalized service, crafted
                    to exceed your expectations. Whether you're here for business or leisure, our dedicated team is
                    committed to making your stay a memorable one.</p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <img src="{{ asset('/images/hotel_image2.jpeg') }}" alt="Hotel sign"
                    class="w-full h-48 object-cover rounded-lg">
            </div>
            <div>
                <img src="{{ asset('/images/hotel_image3.jpeg') }}" alt="Hotel exterior"
                    class="w-full h-48 object-cover rounded-lg">
            </div>
            <div>
                <img src="{{ asset('/images/hotel_image4.jpeg') }}" alt="Hotel entrance"
                    class="w-full h-48 object-cover rounded-lg">
            </div>
        </div>
    </a>
    </section>
