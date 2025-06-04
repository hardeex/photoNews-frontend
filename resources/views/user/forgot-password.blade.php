@extends('base.base')
@section('title', 'Forgot Password - Essential Nigeria News')

@section('content')
    <div class="min-h-screen bg-gray-50 relative overflow-hidden">
        <!-- Background Pattern -->
        <div class="absolute inset-0 opacity-5">
            <div class="absolute inset-0" style="background-image: url('data:image/svg+xml,<svg width="60" height="60" viewBox="0 0 60 60" xmlns="http://www.w3.org/2000/svg"><g fill="none" fill-rule="evenodd"><g fill="%23000000" fill-opacity="0.1"><path d="M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z"/></g></g></svg>'); background-size: 60px 60px;"></div>
        </div>

        <div class="flex min-h-screen">
            <!-- Left Section - News Branding -->
            <div class="hidden lg:flex lg:w-1/2 bg-gradient-to-br from-purple-600 via-purple-700 to-purple-800 relative overflow-hidden">
                <!-- News Background Image -->
                <div class="absolute inset-0 opacity-20">
                    <img src="https://images.unsplash.com/photo-1434030216411-0b793f4b4173?ixlib=rb-4.0.3&auto=format&fit=crop&w=2340&q=80" 
                         alt="News Background" 
                         class="w-full h-full object-cover">
                </div>
                
                <!-- Content Overlay -->
                <div class="relative z-10 flex flex-col justify-center px-12 py-16 text-white">
                    <!-- Logo/Brand Area -->
                    <div class="mb-8">
                        <div class="flex items-center mb-4">
                            <div class="w-12 h-12 bg-white bg-opacity-20 rounded-lg flex items-center justify-center mr-4 backdrop-blur-sm">
                                <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M2 5a2 2 0 012-2h8a2 2 0 012 2v10a2 2 0 002 2H4a2 2 0 01-2-2V5zm3 1h6v4H5V6zm6 6H5v2h6v-2z" clip-rule="evenodd"/>
                                    <path d="M15 7h1a2 2 0 012 2v5.5a1.5 1.5 0 01-3 0V9a1 1 0 00-1-1h-1v-.5A1.5 1.5 0 0115 6z"/>
                                </svg>
                            </div>
                            <div>
                                <h1 class="text-2xl font-bold">Essential Nigeria News</h1>
                                <p class="text-purple-200 text-sm">Account Recovery</p>
                            </div>
                        </div>
                    </div>

                    <!-- Recovery Message -->
                    <div class="space-y-6">
                        <div>
                            <h2 class="text-3xl font-bold leading-tight mb-4">
                                Forgot Your Password?
                            </h2>
                            <p class="text-xl text-purple-100 leading-relaxed">
                                No worries! We'll help you get back to reading the latest news. 
                                Enter your email address and we'll send you a secure reset link.
                            </p>
                        </div>

                        <!-- Security Features -->
                        <div class="space-y-4 pt-6 border-t border-purple-500 border-opacity-30">
                            <div class="flex items-center space-x-3">
                                <svg class="w-5 h-5 text-purple-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                </svg>
                                <span class="text-purple-100">Secure password reset process</span>
                            </div>
                            <div class="flex items-center space-x-3">
                                <svg class="w-5 h-5 text-purple-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                </svg>
                                <span class="text-purple-100">Link expires in 60 minutes</span>
                            </div>
                            <div class="flex items-center space-x-3">
                                <svg class="w-5 h-5 text-purple-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                </svg>
                                <span class="text-purple-100">Check your email inbox</span>
                            </div>
                            <div class="flex items-center space-x-3">
                                <svg class="w-5 h-5 text-purple-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                                </svg>
                                <span class="text-purple-100">Quick and easy recovery</span>
                            </div>
                        </div>
                    </div>

                    <!-- Support Note -->
                    <div class="mt-12 pt-6 border-t border-purple-500 border-opacity-30">
                        <p class="text-purple-200">
                            Need help? <a href="#" class="text-white font-medium hover:underline">Contact our support team</a> 
                            or <a href="{{ route('user.login') }}" class="text-white font-medium hover:underline">return to login</a>.
                        </p>
                    </div>
                </div>
            </div>

            <!-- Right Section - Recovery Form -->
            <div class="w-full lg:w-1/2 flex items-center justify-center p-8 sm:p-12">
                <div class="w-full max-w-md bg-white rounded-xl shadow-lg overflow-hidden p-8 sm:p-10">
                    <div class="text-center mb-8 lg:hidden">
                        <div class="flex items-center justify-center mb-4">
                            <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center mr-4">
                                <svg class="w-6 h-6 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M2 5a2 2 0 012-2h8a2 2 0 012 2v10a2 2 0 002 2H4a2 2 0 01-2-2V5zm3 1h6v4H5V6zm6 6H5v2h6v-2z" clip-rule="evenodd"/>
                                    <path d="M15 7h1a2 2 0 012 2v5.5a1.5 1.5 0 01-3 0V9a1 1 0 00-1-1h-1v-.5A1.5 1.5 0 0115 6z"/>
                                </svg>
                            </div>
                            <h1 class="text-2xl font-bold text-gray-800">Essential Nigeria News</h1>
                        </div>
                        <h2 class="text-xl font-semibold text-gray-700">Password Recovery</h2>
                    </div>

                    @if (session('status'))
                        <div class="mb-6 bg-green-50 border border-green-200 rounded-lg p-4 text-sm text-green-600">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
                        @csrf

                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email address</label>
                            <div class="relative">
                                <input 
                                    id="email" 
                                    name="email" 
                                    type="email" 
                                    required 
                                    autofocus
                                    value="{{ old('email') }}"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500 @error('email') border-red-500 @enderror"
                                    placeholder="your@email.com">
                                @error('email')
                                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                        </svg>
                                    </div>
                                @enderror
                            </div>
                            @error('email')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <button type="submit" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-lg shadow-sm text-sm font-medium text-white bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transition-colors duration-200">
                                Send Password Reset Link
                            </button>
                        </div>
                    </form>

                   <div class="relative z-10 mt-6 text-center text-sm text-gray-500">
    <p>
        Remember your password? 
        <a href="{{ route('user.login') }}" class="font-medium text-purple-600 hover:text-purple-500 hover:underline">
            Sign in here
        </a>
    </p>
</div>

                </div>
            </div>
        </div>
    </div>
@endsection