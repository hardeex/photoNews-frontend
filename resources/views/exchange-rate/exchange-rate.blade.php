<div class="relative overflow-x-hidden bg-gradient-to-r from-blue-900 to-blue-700 h-8">
    @if(!empty($exchangeRates))
        <div class="animate-scroll whitespace-nowrap flex items-center h-8 w-max">
            @for($i = 0; $i < 2; $i++)
                @foreach ($exchangeRates as $rate)
                    <div class="flex items-center gap-1 px-3 border-r border-white/20 h-8">
                        <img src="{{ asset('countries/' . strtolower($rate['base']) . '.png') }}" 
                             class="w-3 h-2 rounded-sm object-cover" alt="{{ $rate['base'] }}" />
                        <span class="text-white text-xs font-medium">{{ $rate['base'] }}</span>
                        <span class="text-green-400 text-xs font-bold">1.00</span>
                        <span class="text-white/60 text-xs">→</span>
                        <img src="{{ asset('countries/' . strtolower($rate['target']) . '.png') }}" 
                             class="w-3 h-2 rounded-sm object-cover" alt="{{ $rate['target'] }}" />
                        <span class="text-white text-xs font-medium">{{ $rate['target'] }}</span>
                        <span class="text-red-400 text-xs font-bold">{{ number_format($rate['value'], 2) }}</span>
                    </div>
                @endforeach
            @endfor
        </div>
    @else
        <div class="flex items-center justify-center h-8 text-red-400 text-xs">
            No exchange rate data available
        </div>
    @endif
</div>

<style>
@keyframes scroll {
    0% { transform: translateX(0); }
    100% { transform: translateX(-50%); }
}

.animate-scroll {
    animation: scroll 30s linear infinite;
    will-change: transform;
}

.animate-scroll:hover {
    animation-play-state: paused;
}
</style>


 <!-- Exchange Rate Ticker Component -->



 <style>
     @keyframes ticker {
         0% {
             transform: translateX(0);
         }

         100% {
             transform: translateX(-50%);
         }
     }

     .animate-ticker {
         animation: ticker 30s linear infinite;
     }
 </style>
 </div>
