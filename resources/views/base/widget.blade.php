{{-- <div id="whatsapp-widget" class="fixed bottom-8 left-8 z-50">

    <button onclick="toggleWidget()"
        class="absolute -top-12 left-0 px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-800 rounded-t-lg shadow-md transition-colors duration-300 flex items-center gap-2">
        <span id="toggle-text">Hide Contact</span>
    </button>

  
    <div id="widget-content" class="bg-white rounded-lg shadow-lg p-6 max-w-sm">
        <h2 class="text-xl font-semibold text-gray-800 mb-4">Contact Us via WhatsApp</h2>
        
        <a href="https://wa.me/2348127025378?text=Hello%2C%20I%20need%20sales%20support" target="_blank"
            class="group flex items-center gap-2 mb-3 px-6 py-3 bg-[#25D366] hover:bg-[#128C7E] text-white rounded-full transition-colors duration-300">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                <path
                    d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z" />
            </svg>
            <span class="font-medium">Chat with Sales</span>
        </a>
        
        <a href="https://wa.me/2348148413982?text=Hello%2C%20I%20need%20support%20assistance" target="_blank"
            class="group flex items-center gap-2 px-6 py-3 bg-[#25D366] hover:bg-[#128C7E] text-white rounded-full transition-colors duration-300">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                <path
                    d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z" />
            </svg>
            <span class="font-medium">Chat with Support</span>
        </a>
    </div>
</div>

<script>
    function toggleWidget() {
        const content = document.getElementById('widget-content');
        const toggleText = document.getElementById('toggle-text');

        if (content.style.display === 'none') {
            content.style.display = 'block';
            toggleText.textContent = 'Hide Contact';
        } else {
            content.style.display = 'none';
            toggleText.textContent = 'Show Contact';
        }
    }
</script> --}}



<div id="whatsapp-widget" class="fixed bottom-8 left-8 z-50 transition-all duration-300">
    <!-- Collapsed State - Just the Icon -->
    <div id="widget-collapsed"
        class="cursor-pointer bg-[#25D366] p-3 rounded-full shadow-lg hover:bg-[#128C7E] transition-colors duration-300"
        onclick="expandWidget()">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 24 24">
            <path
                d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z" />
        </svg>
        <!-- Notification Dot (Optional) -->
        <div class="absolute -top-1 -right-1 h-4 w-4 bg-red-500 rounded-full border-2 border-white"></div>
    </div>

    <!-- Expanded State - Full Widget -->
    <div id="widget-expanded" class="hidden">
        <!-- Close Button -->
        <button onclick="collapseWidget()"
            class="absolute -top-3 -right-3 bg-gray-200 hover:bg-gray-300 rounded-full p-1 shadow-md z-10">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600" fill="none" viewBox="0 0 24 24"
                stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>

        <!-- Widget Content -->
        <div class="bg-white rounded-lg shadow-lg p-6 max-w-sm mt-4">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Contact Us via WhatsApp</h2>

            {{-- Sales Button --}}
            <a href="https://wa.me/2348127025378?text=Hello%2C%20I%20need%20sales%20support" target="_blank"
                class="group flex items-center gap-2 mb-3 px-6 py-3 bg-[#25D366] hover:bg-[#128C7E] text-white rounded-full transition-colors duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                    <path
                        d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z" />
                </svg>
                <span class="font-medium">Chat with Sales</span>
            </a>

            {{-- Support Button --}}
            <a href="https://wa.me/2348148413982?text=Hello%2C%20I%20need%20support%20assistance" target="_blank"
                class="group flex items-center gap-2 px-6 py-3 bg-[#25D366] hover:bg-[#128C7E] text-white rounded-full transition-colors duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                    <path
                        d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z" />
                </svg>
                <span class="font-medium">Chat with Support</span>
            </a>

            {{-- Remember My Choice --}}
            <div class="mt-4 flex items-center text-sm text-gray-600">
                <input type="checkbox" id="remember-choice" class="mr-2">
                <label for="remember-choice">Don't show again for 24 hours</label>
            </div>
        </div>
    </div>
</div>

<script>
    // Set initial state based on localStorage
    document.addEventListener('DOMContentLoaded', function() {
        // Check if user has hidden the widget
        const hideUntil = localStorage.getItem('whatsappWidgetHideUntil');
        if (hideUntil && new Date(hideUntil) > new Date()) {
            document.getElementById('whatsapp-widget').classList.add('opacity-50');
        }
    });

    function expandWidget() {
        document.getElementById('widget-collapsed').classList.add('hidden');
        document.getElementById('widget-expanded').classList.remove('hidden');
    }

    function collapseWidget() {
        document.getElementById('widget-expanded').classList.add('hidden');
        document.getElementById('widget-collapsed').classList.remove('hidden');

        // Check if "don't show again" is checked
        if (document.getElementById('remember-choice').checked) {
            // Hide for 24 hours
            const hideUntil = new Date(new Date().getTime() + 24 * 60 * 60 * 1000);
            localStorage.setItem('whatsappWidgetHideUntil', hideUntil.toISOString());
            document.getElementById('whatsapp-widget').classList.add('opacity-50');
        }
    }
</script>
