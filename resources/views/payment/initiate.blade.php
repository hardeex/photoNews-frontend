


@extends('dashboard.base')
@Section('title', 'Create Birthday Post')


@section('sidebar')
    @include('dashboard.sidebar')
@endsection


@section('content')
    {{-- @include('birthday.items.create-birthday') --}}
      <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full">
            <!-- Payment Card -->
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                <!-- Header Section -->
                <div class="bg-gradient-to-r from-blue-600 to-blue-700 px-8 py-10 text-center">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-white bg-opacity-20 rounded-full mb-4">
                        <i class="fas fa-credit-card text-white text-2xl"></i>
                    </div>
                    <h2 class="text-2xl font-bold text-white mb-2">Complete Payment</h2>
                    <p class="text-blue-100 text-sm">Secure payment processing with Paystack</p>
                </div>

                <!-- Content Section -->
                <div class="px-8 py-8">
                    <!-- Error Alert (if session error exists) -->
                    <div class="hidden mb-6 p-4 bg-red-50 border-l-4 border-red-400 rounded-lg" id="error-alert">
                        <div class="flex items-center">
                            <i class="fas fa-exclamation-triangle text-red-400 mr-3"></i>
                            <div>
                                <p class="text-red-800 font-medium">Payment Error</p>
                                <p class="text-red-600 text-sm mt-1">There was an issue processing your payment. Please try again.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Payment Info -->
                    <div class="mb-8">
                        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg mb-4">
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center mr-3">
                                    <i class="fas fa-birthday-cake text-blue-600"></i>
                                </div>
                                <div>
                                    <p class="font-medium text-gray-900">Birthday Post</p>
                                    <p class="text-sm text-gray-500">Premium feature</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="font-bold text-lg text-gray-900">₦2,500</p>
                                <p class="text-xs text-gray-500">One-time</p>
                            </div>
                        </div>

                        <!-- Security Notice -->
                        <div class="flex items-center p-3 bg-green-50 rounded-lg border border-green-200">
                            <i class="fas fa-shield-alt text-green-600 mr-3"></i>
                            <p class="text-sm text-green-800">
                                <span class="font-medium">Secure Payment:</span> Your payment is protected by 256-bit SSL encryption
                            </p>
                        </div>
                    </div>

                    <!-- Payment Form -->
                    <form method="POST" action="{{ route('payment.start', ['post_type' => 'birthday']) }}">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        
                        <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white font-semibold py-4 px-6 rounded-xl transition-all duration-300 transform hover:scale-105 shadow-lg focus:outline-none focus:ring-4 focus:ring-blue-300 focus:ring-opacity-50">
                            <div class="flex items-center justify-center">
                                <i class="fas fa-lock mr-3"></i>
                                <span>Proceed to Paystack</span>
                                <i class="fas fa-arrow-right ml-3"></i>
                            </div>
                        </button>
                    </form>

                    <!-- Trust Indicators -->
                    <div class="mt-6 pt-6 border-t border-gray-200">
                        <div class="flex items-center justify-center space-x-6 text-gray-400">
                            <div class="flex items-center">
                                <i class="fab fa-cc-visa text-2xl"></i>
                            </div>
                            <div class="flex items-center">
                                <i class="fab fa-cc-mastercard text-2xl"></i>
                            </div>
                            <div class="flex items-center">
                                <i class="fas fa-university text-xl"></i>
                            </div>
                            <div class="flex items-center">
                                <span class="text-sm font-medium">Paystack</span>
                            </div>
                        </div>
                        <p class="text-center text-xs text-gray-500 mt-3">
                            Powered by Paystack - Trusted by thousands of businesses
                        </p>
                    </div>
                </div>
            </div>

            <!-- Additional Info -->
            <div class="mt-6 text-center">
                <p class="text-sm text-gray-600">
                    <i class="fas fa-question-circle mr-1"></i>
                    Need help? <a href="#" class="text-blue-600 hover:text-blue-700 font-medium">Contact Support</a>
                </p>
            </div>
        </div>
    </div>

    <script>
        // Simulate showing error if needed (replace with actual Laravel session check)
        // if (/* session has error */) {
        //     document.getElementById('error-alert').classList.remove('hidden');
        // }
        
        // Add loading state to button
        document.querySelector('form').addEventListener('submit', function(e) {
            const button = this.querySelector('button[type="submit"]');
            button.innerHTML = `
                <div class="flex items-center justify-center">
                    <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <span>Processing...</span>
                </div>
            `;
            button.disabled = true;
        });
    </script>
@endsection



