
       <section class="max-w-6xl mx-auto px-4 py-8">
    {{-- Topics Section --}}
    <div class="bg-gray-100 border-l-4 border-purple-500 p-4 mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Featured Topics</h2>
    </div>

    {{-- Topics Tags --}}
    @php
        $topics = [
            'Gold Market',
            'Nigeria\'s Inflation Rate Eases to 33.40%',
            'Adekunle Gold',
            'Nigeria and Guinea Strengthen Ties',
            'Nigeria\'s Economic Activity Declines Again'
        ];
    @endphp

    <div class="flex flex-wrap gap-3 mb-8">
        @foreach ($topics as $topic)
            <span class="bg-purple-100 text-purple-700 text-sm font-medium px-4 py-2 rounded-full border border-purple-200 hover:bg-purple-200 transition-colors">
                {{ $topic }}
            </span>
        @endforeach
    </div>

    {{-- Main Content Grid --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        {{-- News Services Hero Section --}}
        <div class="lg:col-span-2">
            <div class="bg-gradient-to-br from-slate-900 via-blue-900 to-indigo-900 rounded-xl overflow-hidden relative min-h-[500px] flex items-center justify-center">
                {{-- Background Pattern --}}
                <div class="absolute inset-0 opacity-10">
                    <div class="absolute inset-0 bg-grid-pattern"></div>
                    <div class="absolute top-8 left-12 w-16 h-16 bg-blue-400 rounded-full opacity-30 animate-float"></div>
                    <div class="absolute bottom-12 right-16 w-12 h-12 bg-purple-400 rounded-full opacity-30 animate-float-delayed"></div>
                    <div class="absolute top-24 right-24 w-8 h-8 bg-yellow-400 rounded-full opacity-30 animate-float-slow"></div>
                </div>
                
                {{-- Main Content --}}
                <div class="relative z-10 text-center px-8 max-w-2xl">
                    {{-- Live Status Badge --}}
                    <div class="inline-flex items-center bg-red-600 text-white px-4 py-2 rounded-full mb-6 shadow-lg">
                        <div class="w-2 h-2 bg-white rounded-full mr-2 animate-ping"></div>
                        <span class="font-semibold text-sm tracking-wide">LIVE NEWS SERVICES</span>
                    </div>
                    
                    {{-- Main Heading --}}
                    <h1 class="text-4xl md:text-5xl font-bold text-white mb-4 leading-tight">
                        Professional News
                        <span class="text-transparent bg-clip-text bg-gradient-to-r from-yellow-400 to-orange-500">
                            Reporting Services
                        </span>
                    </h1>
                    
                    {{-- Subtitle --}}
                    <p class="text-xl text-blue-100 mb-8 leading-relaxed">
                        Complete news coverage and professional reporting for all your communication needs
                    </p>
                    
                    {{-- Services Grid --}}
                    @php
                        $services = [
                            ['icon' => '📰', 'title' => 'News Articles', 'subtitle' => 'Professional Writing'],
                            ['icon' => '🔍', 'title' => 'Missing Persons', 'subtitle' => 'Search & Report'],
                            ['icon' => '⚖️', 'title' => 'Legal Notices', 'subtitle' => 'Official Reports'],
                            ['icon' => '🕊️', 'title' => 'Obituaries', 'subtitle' => 'Memorial Services'],
                            ['icon' => '💒', 'title' => 'Celebrations', 'subtitle' => 'Wedding & Events'],
                            ['icon' => '📢', 'title' => 'Public Notices', 'subtitle' => 'Community Info']
                        ];
                    @endphp

                    <div class="grid grid-cols-2 md:grid-cols-3 gap-4 mb-8">
                        @foreach ($services as $service)
                            <div class="bg-white/10 backdrop-blur-sm p-4 rounded-lg border border-white/20 hover:bg-white/15 transition-all duration-300">
                                <div class="text-2xl mb-2">{{ $service['icon'] }}</div>
                                <div class="text-sm font-semibold text-white">{{ $service['title'] }}</div>
                                <div class="text-xs text-blue-200">{{ $service['subtitle'] }}</div>
                            </div>
                        @endforeach
                    </div>
                    
                    {{-- Call to Action Buttons --}}
                    <div class="flex flex-col sm:flex-row items-center justify-center gap-4 mb-8">
                        <button class="bg-gradient-to-r from-blue-600 to-purple-600 text-white px-8 py-3 rounded-full font-semibold hover:from-blue-700 hover:to-purple-700 transition-all duration-300 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                            Submit Your Story
                        </button>
                        <button class="bg-white/20 backdrop-blur-sm text-white px-8 py-3 rounded-full font-semibold border border-white/30 hover:bg-white/30 transition-all duration-300">
                            Contact Newsroom
                        </button>
                    </div>
                    
                    {{-- Status Indicators --}}
                    <div class="pt-6 border-t border-white/20">
                        @php
                            $statuses = [
                                ['color' => 'green', 'text' => '24/7 Newsroom'],
                                ['color' => 'yellow', 'text' => 'Professional Reporters'],
                                ['color' => 'red', 'text' => 'Breaking News Coverage']
                            ];
                        @endphp

                        <div class="flex flex-wrap items-center justify-center gap-6 text-sm text-blue-200">
                            @foreach ($statuses as $status)
                                <div class="flex items-center">
                                    <div class="w-2 h-2 bg-{{ $status['color'] }}-400 rounded-full mr-2"></div>
                                    <span>{{ $status['text'] }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Sidebar Banners --}}
        <div class="space-y-6">
            {{-- EHotels Primary Banner --}}
            <div class="bg-gradient-to-br from-blue-800 to-indigo-900 p-6 text-white text-center rounded-xl relative overflow-hidden shadow-lg">
                <div class="absolute inset-0 opacity-10">
                    <div class="absolute top-2 right-2 w-8 h-8 border-2 border-white rounded-full"></div>
                    <div class="absolute bottom-2 left-2 w-6 h-6 border-2 border-white rounded-full"></div>
                </div>
                
                <div class="relative z-10">
                    <div class="text-3xl mb-3">🏨</div>
                    <h3 class="font-bold text-xl mb-2">EHotels Software</h3>
                    <p class="text-sm mb-4 text-blue-100">Complete Hotel Management System</p>
                    <div class="bg-white/20 px-4 py-2 rounded-full inline-block mb-3">
                        <span class="text-sm font-semibold">ehotels.ng</span>
                    </div>
                    <div class="text-xs text-blue-200">
                        Bookings • PMS • Analytics
                    </div>
                </div>
            </div>

            {{-- Analytics Banner --}}
            <div class="bg-gradient-to-r from-emerald-600 to-teal-700 p-5 text-center text-white rounded-xl relative shadow-lg">
                <div class="absolute top-2 right-2 text-yellow-300 text-lg">✨</div>
                <div class="absolute bottom-2 left-2 text-yellow-300 text-lg">⚡</div>
                
                <div class="text-2xl mb-2">📊</div>
                <h3 class="font-semibold text-lg mb-1">Hotel Analytics</h3>
                <p class="text-xs mb-3 text-emerald-100">Real-time Insights & Reports</p>
                <div class="bg-yellow-400 text-black px-4 py-2 rounded-full inline-block">
                    <span class="text-xs font-bold">ehotels.ng</span>
                </div>
            </div>

            {{-- Booking Management Banner --}}
            <div class="bg-gradient-to-br from-purple-700 to-red-600 p-5 text-white text-center rounded-xl relative overflow-hidden shadow-lg">
                <div class="absolute inset-0 opacity-20">
                    <div class="absolute top-2 left-3 w-2 h-2 bg-white rounded-full animate-pulse"></div>
                    <div class="absolute bottom-3 right-3 w-3 h-3 bg-yellow-300 rounded-full animate-pulse-delayed"></div>
                </div>
                
                <div class="relative z-10">
                    <div class="flex items-center justify-center mb-3">
                        <span class="text-2xl mr-2">🔧</span>
                        <span class="text-2xl">💼</span>
                    </div>
                    <h3 class="font-bold text-lg mb-1">Booking Management</h3>
                    <p class="text-xs mb-3 text-pink-100">Streamline Your Operations</p>
                    <div class="bg-white text-purple-800 px-4 py-2 rounded-full inline-block">
                        <span class="text-xs font-bold">EHOTELS.NG</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
    .bg-grid-pattern {
        background-image: radial-gradient(circle at 1px 1px, rgba(255,255,255,0.15) 1px, transparent 0);
        background-size: 20px 20px;
    }
    
    @keyframes float {
        0%, 100% { transform: translateY(0px); }
        50% { transform: translateY(-10px); }
    }
    
    @keyframes ping {
        75%, 100% {
            transform: scale(2);
            opacity: 0;
        }
    }
    
    .animate-float {
        animation: float 3s ease-in-out infinite;
    }
    
    .animate-float-delayed {
        animation: float 3s ease-in-out infinite;
        animation-delay: 1s;
    }
    
    .animate-float-slow {
        animation: float 4s ease-in-out infinite;
        animation-delay: 0.5s;
    }
    
    .animate-ping {
        animation: ping 1s cubic-bezier(0, 0, 0.2, 1) infinite;
    }
    
    .animate-pulse-delayed {
        animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        animation-delay: 500ms;
    }
</style>
