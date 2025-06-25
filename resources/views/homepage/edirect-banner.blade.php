
<section class="w-full">
  <div class="relative w-full h-full bg-gradient-to-r from-green-600 via-blue-700 to-purple-800 overflow-hidden">
    <!-- Background Pattern -->
    <div class="absolute inset-0 opacity-10">
      <div class="absolute top-4 left-8 w-20 h-20 bg-white rounded-full"></div>
      <div class="absolute bottom-6 right-12 w-16 h-16 bg-white rounded-full"></div>
      <div class="absolute top-12 right-20 w-12 h-12 bg-white rounded-full"></div>
    </div>
    
    <!-- Main Content -->
    <div class="relative flex items-center justify-between h-full px-8">
      <!-- Left Side - Text Content -->
      <div class="flex-1 text-white">
        <div class="mb-4">
          <h1 class="text-4xl font-bold mb-2">Essential Direct Business Directory</h1>
          <p class="text-xl font-semibold text-yellow-300">Nigeria's Premier Business Network</p>
        </div>
        
        <div class="mb-6">
          <p class="text-lg mb-2">✓ List Your Business • Find Services • Connect Locally</p>
          <p class="text-lg mb-2">✓ Agent Payment System • Secure Transactions</p>
          <p class="text-lg">✓ Grow Your Network • Boost Your Visibility</p>
        </div>
        
        <div class=" space-x-4">
          <div class="bg-white bg-opacity-20 px-6 py-3 rounded-full">
            <a href="https://edirect.ng/signup" class="text-xl font-bold">Register Now!</span>
          </div>
         
        </div>
      </div>
      
      <!-- Right Side - Visual Elements -->
      <div class="ml-8 flex flex-col items-center">
        <div class="relative">
          <!-- Business Icons -->
          <div class="bg-white bg-opacity-20 p-6 rounded-2xl backdrop-blur-sm">
            <div class="grid grid-cols-2 gap-4 mb-4">
              <div class="bg-white bg-opacity-30 p-3 rounded-lg text-center">
                <div class="text-2xl mb-1">🏢</div>
                <p class="text-xs font-semibold">Businesses</p>
              </div>
              <div class="bg-white bg-opacity-30 p-3 rounded-lg text-center">
                <div class="text-2xl mb-1">💳</div>
                <p class="text-xs font-semibold">Payments</p>
              </div>
              <div class="bg-white bg-opacity-30 p-3 rounded-lg text-center">
                <div class="text-2xl mb-1">🤝</div>
                <p class="text-xs font-semibold">Agents</p>
              </div>
              <div class="bg-white bg-opacity-30 p-3 rounded-lg text-center">
                <div class="text-2xl mb-1">📍</div>
                <p class="text-xs font-semibold">Local</p>
              </div>
            </div>
            
            <!-- Nigeria Flag Colors Accent -->
            <div class="flex space-x-1 justify-center">
              <div class="w-4 h-2 bg-green-500 rounded-sm"></div>
              <div class="w-4 h-2 bg-white rounded-sm"></div>
              <div class="w-4 h-2 bg-green-500 rounded-sm"></div>
            </div>
          </div>
        </div>
        
        <!-- Call to Action Arrow -->
        <div class="mt-4 animate-bounce">
          <div class="text-yellow-300 text-3xl">👆</div>
        </div>
      </div>
    </div>
    
    <!-- Bottom Accent Line -->
    <div class="absolute bottom-0 left-0 right-0 h-2 bg-gradient-to-r from-green-500 via-white to-green-500"></div>
  </div>
</section>

<style>
  @keyframes bounce {
    0%, 20%, 53%, 80%, 100% {
      transform: translateY(0);
    }
    40%, 43% {
      transform: translateY(-10px);
    }
    70% {
      transform: translateY(-5px);
    }
  }
  .animate-bounce {
    animation: bounce 2s infinite;
  }
</style>
