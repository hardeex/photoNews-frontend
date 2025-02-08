<div x-data="{
    showModal: false,
    modalType: '',
    modalMessage: '',
    loading: false,
    async submitForm(e) {
        e.preventDefault();
        this.loading = true;

        try {
            const form = e.target;
            const formData = new FormData(form);

            const response = await fetch(form.action, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content,
                    'Accept': 'application/json',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    email: formData.get('email')
                })
            });

            const data = await response.json();

            // Handle different response types
            if (response.status === 409) {
                this.modalType = 'info';
            } else if (response.ok) {
                this.modalType = 'success';
                form.reset();
            } else {
                this.modalType = 'error';
            }

            this.modalMessage = data.message;
            this.showModal = true;

            // Auto-close only for success
            if (this.modalType === 'success') {
                setTimeout(() => {
                    this.showModal = false;
                }, 3000);
            }
        } catch (error) {
            this.modalType = 'error';
            this.modalMessage = 'An error occurred. Please try again later.';
            this.showModal = true;
        } finally {
            this.loading = false;
        }
    }
}">
    <div>
        <h4 class="text-white text-lg font-semibold mb-4">Stay Updated</h4>
        <p class="text-sm mb-4">Subscribe to our newsletter for daily news updates.</p>
        <form class="flex" @submit="submitForm" action="{{ route('newsltter.subscribe') }}">
            @csrf
            <input type="email" placeholder="Your email" name="email"
                class="flex-grow px-3 py-2 text-gray-700 bg-white rounded-l-md focus:outline-none" required>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-r-md hover:bg-blue-600 transition"
                :disabled="loading">
                <span x-show="!loading">Subscribe</span>
                <span x-show="loading" class="inline-flex items-center">
                    <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor"
                            stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor"
                            d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                        </path>
                    </svg>
                    Processing...
                </span>
            </button>
        </form>
    </div>

    <!-- Response Modal -->
    <div x-show="showModal" x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 transform scale-90" x-transition:enter-end="opacity-100 transform scale-100"
        x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100 transform scale-100"
        x-transition:leave-end="opacity-0 transform scale-90"
        class="fixed inset-0 z-50 flex items-center justify-center" @click.self="showModal = false">

        <div class="absolute inset-0 bg-black opacity-50"></div>

        <div class="relative bg-white rounded-lg p-6 max-w-md w-full mx-4 shadow-xl">
            <div class="text-center">
                <div class="mb-4">
                    <!-- Success Icon -->
                    <template x-if="modalType === 'success'">
                        <svg class="mx-auto h-12 w-12 text-green-500" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </template>
                    <!-- Info Icon -->
                    <template x-if="modalType === 'info'">
                        <svg class="mx-auto h-12 w-12 text-blue-500" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </template>
                    <!-- Error Icon -->
                    <template x-if="modalType === 'error'">
                        <svg class="mx-auto h-12 w-12 text-red-500" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </template>
                </div>

                <h3 class="text-lg font-medium mb-2"
                    :class="{
                        'text-green-600': modalType === 'success',
                        'text-blue-600': modalType === 'info',
                        'text-red-600': modalType === 'error'
                    }"
                    x-text="modalMessage"></h3>

                <div class="mt-4">
                    <button @click="showModal = false"
                        class="px-4 py-2 bg-gray-100 text-gray-700 rounded-md hover:bg-gray-200 transition">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
