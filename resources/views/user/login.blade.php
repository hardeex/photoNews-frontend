@extends('base.base')
@section('title', 'Login - Essential Nigeria News')

@section('content')

    <div class="bg-gradient-to-br from-blue-900 to-purple-900 min-h-screen flex items-center justify-center">
        <div class="bg-white bg-opacity-10 p-8 rounded-lg shadow-2xl backdrop-blur-md w-full max-w-md"
            x-data="{ showPassword: false }">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('api_error'))
                <div class="alert alert-danger">
                    {{ session('api_error') }}
                </div>
            @endif


            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif


            <h2 class="text-3xl font-bold mb-6 text-center text-white">Essential News Login</h2>

            <div class="mb-6 relative">
                <img src="{{ asset('images/new-outpost.jpg') }}" alt="News Collage"
                    class="w-full h-32 object-cover rounded-lg mb-4">
                <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center rounded-lg">
                    <span class="text-white text-xl font-semibold">Stay Informed</span>
                </div>
            </div>

            <form action="{{ route('user.login.submit') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="email" class="block text-white mb-2">Email or Username or Phone</label>
                    <input type="email" id="email" name="email" required
                        class="w-full px-3 py-2 bg-white bg-opacity-20 rounded-md text-white placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-400"
                        placeholder="your@email.com">
                </div>
                <div class="mb-6 relative">
                    <label for="password" class="block text-white mb-2">Password</label>
                    <input :type="showPassword ? 'text' : 'password'" id="password" name="password" required
                        class="w-full px-3 py-2 bg-white bg-opacity-20 rounded-md text-white placeholder-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-400"
                        placeholder="••••••••">
                    <button type="button" @click="showPassword = !showPassword" class="absolute right-3 top-9 text-white">
                        <svg x-show="!showPassword" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <svg x-show="showPassword" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 10-4.243-4.243m4.242 4.242L9.88 9.88" />
                        </svg>
                    </button>
                </div>
                <div class="flex items-center justify-between mb-6">
                    <label class="flex items-center text-white">
                        <input type="checkbox" class="form-checkbox h-5 w-5 text-blue-500">
                        <span class="ml-2">Remember me</span>
                    </label>
                    <a href="#" class="text-blue-300 hover:text-blue-200">Forgot password?</a>
                </div>
                <button type="submit"
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-md transition duration-300 flex items-center justify-center">
                    <span>Log In</span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-5 h-5 ml-2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5" />
                    </svg>
                </button>
            </form>
            <div class="mt-6 text-center">
                <p class="text-white">Don't have an account? <a href="{{ route('user.register') }}"
                        class="text-blue-300 hover:text-blue-200">Sign up</a></p>
            </div>
        </div>
    </div>

@endsection