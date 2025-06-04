@extends('base.base')
@section('title', 'Reset Password - Essential News Nigeria')

@section('content')
<div class="items-center justify-center min-h-screen bg-gradient-to-br from-gray-50 via-blue-50 to-red-50 px-4">
    <div class="w-full max-w-lg bg-white p-6 rounded-lg shadow-md">
        <!-- Main Card -->
        <div class="bg-white shadow-4xl rounded-2xl overflow-hidden">
            <!-- Header Section -->
            <div class="bg-gradient-to-r from-red-600 to-blue-600 px-8 py-6 text-center">
                <div class="flex items-center justify-center mb-4">
                    <div class="w-16 h-16 bg-white bg-opacity-20 rounded-full flex items-center justify-center mr-3">
                        <img src="https://images.unsplash.com/photo-1504711434969-e33886168f5c?w=64&h=64&fit=crop&crop=center" 
                             alt="Essential News Nigeria" class="w-12 h-12 rounded-full object-cover">
                    </div>
                    <div>
                        <h1 class="text-xl font-bold text-white">Essential News Nigeria</h1>
                        <p class="text-blue-100 text-sm">Your trusted news source</p>
                    </div>
                </div>
                <div class="w-20 h-1 bg-white bg-opacity-40 mx-auto rounded-full"></div>
            </div>

            <!-- Form Content -->
            <div class="px-8 py-8">
                <div class="text-center mb-8">
                    <div class="w-20 h-20 bg-gradient-to-br from-blue-100 to-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-10 h-10 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m0 0a2 2 0 012 2m-2-2v6a2 2 0 01-2 2m-2-2H9m10-2a2 2 0 002-2m0 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0a2 2 0 012 2m-2-2v10a2 2 0 01-2 2m-2-2v4a2 2 0 002 2m2-2v4a2 2 0 002 2"></path>
                        </svg>
                    </div>
                    <h2 class="text-3xl font-bold text-gray-800 mb-2">Reset Your Password</h2>
                    <p class="text-gray-600">Create a new secure password for your account</p>
                </div>

                <!-- Success Message -->
                @if (session('success'))
                    <div class="mb-6 p-4 bg-gradient-to-r from-green-50 to-green-100 border-l-4 border-green-500 rounded-lg">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-green-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-green-800 font-medium">{{ session('success') }}</span>
                        </div>
                    </div>
                @endif

                <!-- Error Message -->
                @if ($errors->has('reset_error'))
                    <div class="mb-6 p-4 bg-gradient-to-r from-red-50 to-red-100 border-l-4 border-red-500 rounded-lg">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 text-red-500 mr-3" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                            </svg>
                            <span class="text-red-800 font-medium">{{ $errors->first('reset_error') }}</span>
                        </div>
                    </div>
                @endif

                <!-- Form -->
                <form action="{{ route('user.reset-password.submit') }}" method="POST" class="space-y-6">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                    <input type="hidden" name="email" value="{{ $email }}">

                    {{-- Debug --}}
<p>Email from hidden input: {{ $email }}</p>
                    
                    <!-- New Password Field -->
                    <div class="space-y-2">
                        <label for="password" class="flex items-center text-sm font-semibold text-gray-700">
                            <svg class="w-4 h-4 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                            New Password
                        </label>
                        <div class="relative">
                            <input type="password" 
                                   id="password" 
                                   name="password" 
                                   class="w-full px-4 py-3 pl-12 pr-12 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-200 @error('password') border-red-500 @enderror" 
                                   placeholder="Enter your new password"
                                   required>
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                </svg>
                            </div>
                            <button type="button" 
                                    onclick="togglePassword('password')" 
                                    class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-500 hover:text-gray-700 focus:outline-none">
                                <svg id="password-eye-open" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                                <svg id="password-eye-closed" class="w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L12 12m-3.878-3.878l6.364 6.364M21 21l-6.364-6.364"></path>
                                </svg>
                            </button>
                        </div>
                        @error('password')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                        <div class="text-xs text-gray-500 mt-1">
                            <p>Password must be at least 8 characters long</p>
                        </div>
                    </div>

                    <!-- Confirm Password Field -->
                    <div class="space-y-2">
                        <label for="password_confirmation" class="flex items-center text-sm font-semibold text-gray-700">
                            <svg class="w-4 h-4 mr-2 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Confirm New Password
                        </label>
                        <div class="relative">
                            <input type="password" 
                                   id="password_confirmation" 
                                   name="password_confirmation" 
                                   class="w-full px-4 py-3 pl-12 pr-12 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-red-500 focus:ring-2 focus:ring-red-200 transition-all duration-200" 
                                   placeholder="Confirm your new password"
                                   required>
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <button type="button" 
                                    onclick="togglePassword('password_confirmation')" 
                                    class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-500 hover:text-gray-700 focus:outline-none">
                                <svg id="password_confirmation-eye-open" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                                <svg id="password_confirmation-eye-closed" class="w-5 h-5 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L12 12m-3.878-3.878l6.364 6.364M21 21l-6.364-6.364"></path>
                                </svg>
                            </button>
                        </div>
                    </div>

                    <!-- Security Tips -->
                    <div class="bg-gradient-to-r from-blue-50 to-red-50 border border-blue-200 rounded-xl p-4">
                        <h4 class="text-sm font-semibold text-gray-800 mb-2 flex items-center">
                            <svg class="w-4 h-4 mr-2 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                            </svg>
                            Password Security Tips
                        </h4>
                        <ul class="text-xs text-gray-600 space-y-1">
                            <li>• Use a mix of uppercase and lowercase letters</li>
                            <li>• Include numbers and special characters</li>
                            <li>• Avoid using personal information</li>
                        </ul>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" 
                            class="w-full bg-gradient-to-r from-red-600 to-blue-600 hover:from-red-700 hover:to-blue-700 text-white font-bold py-4 rounded-xl transform hover:scale-105 transition-all duration-200 shadow-lg hover:shadow-xl focus:outline-none focus:ring-4 focus:ring-blue-200">
                        <div class="flex items-center justify-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m0 0a2 2 0 012 2m-2-2v6a2 2 0 01-2 2m-2-2H9m10-2a2 2 0 002-2m0 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0a2 2 0 012 2m-2-2v10a2 2 0 01-2 2m-2-2v4a2 2 0 002 2m2-2v4a2 2 0 002 2"></path>
                            </svg>
                            Reset Password
                        </div>
                    </button>
                </form>

                <!-- Footer Links -->
                <div class="mt-8 pt-6 border-t border-gray-200">
                    <div class="flex items-center justify-center space-x-6 text-sm">
                        <a href="{{ route('user.login') }}" 
                           class="flex items-center text-blue-600 hover:text-blue-800 font-medium transition-colors duration-200">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            Back to Login
                        </a>
                        <span class="text-gray-300">|</span>
                        <a href="#" class="text-gray-600 hover:text-gray-800 transition-colors duration-200">Need Help?</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bottom Footer -->
        <div class="text-center mt-6 text-sm text-gray-500">
            <p>© 2025 Essential News Nigeria. All rights reserved.</p>
            <p class="mt-1">Secure password reset powered by advanced encryption</p>
        </div>
    </div>

    <!-- Background Decoration -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none">
        <div class="absolute -top-40 -right-40 w-80 h-80 bg-blue-400 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-pulse"></div>
        <div class="absolute -bottom-40 -left-40 w-80 h-80 bg-red-400 rounded-full mix-blend-multiply filter blur-xl opacity-20 animate-pulse" style="animation-delay: 2s;"></div>
    </div>

    <!-- JavaScript for Password Toggle -->
    <script>
        function togglePassword(fieldId) {
            const passwordField = document.getElementById(fieldId);
            const eyeOpen = document.getElementById(fieldId + '-eye-open');
            const eyeClosed = document.getElementById(fieldId + '-eye-closed');
            
            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                eyeOpen.classList.add('hidden');
                eyeClosed.classList.remove('hidden');
            } else {
                passwordField.type = 'password';
                eyeOpen.classList.remove('hidden');
                eyeClosed.classList.add('hidden');
            }
        }
    </script>
<div>
@endsection