<x-app-layout>
  <div class="relative min-h-screen bg-gradient-to-br from-gray-900 via-gray-800 to-gray-700 overflow-hidden">
    <!-- Enhanced Background Elements -->
    <div class="absolute inset-0 bg-grid-pattern opacity-10" aria-hidden="true"></div>
    <div class="absolute inset-0 bg-noise-texture mix-blend-overlay opacity-30" aria-hidden="true"></div>
    
    <!-- Animated Background Glow Effects -->
    <div class="absolute -top-20 -left-20 w-96 h-96 bg-gradient-to-r from-teal-400/20 to-blue-500/20 rounded-full filter blur-3xl opacity-50 animate-pulse-slow" aria-hidden="true"></div>
    <div class="absolute -bottom-32 -right-20 w-80 h-80 bg-gradient-to-r from-purple-500/20 to-pink-600/20 rounded-full filter blur-3xl opacity-50 animate-pulse-slow animation-delay-2000" aria-hidden="true"></div>
    
    <!-- Advanced Floating Particles -->
    <div class="absolute inset-0 pointer-events-none overflow-hidden" aria-hidden="true">
      @foreach(range(1, 6) as $i)
        <div 
          class="absolute particle-element w-{{ rand(4, 10) }} h-{{ rand(4, 10) }} 
                 bg-gradient-to-r {{ ['from-teal-400/30 to-blue-500/30', 'from-purple-500/30 to-pink-600/30'][rand(0, 1)] }} 
                 rounded-full filter blur-{{ rand(1, 2) }}xl opacity-{{ rand(5, 8) }}0 
                 animate-float-random"
          style="top: {{ rand(0, 100) }}%; left: {{ rand(0, 100) }}%; animation-delay: {{ $i * 0.75 }}s; animation-duration: {{ rand(15, 25) }}s;"
        ></div>
      @endforeach
    </div>

    <!-- Main Content Container -->
    <div class="relative z-10 container max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16 sm:py-24">
      <!-- Hero Section with Animation -->
      <section class="relative opacity-0 animate-fade-in animation-delay-300 duration-700">
        <div class="text-center mb-16 sm:mb-24">
          <div class="inline-block relative">
            <!-- Decorative Elements -->
            <div class="absolute -top-8 -right-8 w-16 h-16">
              <svg class="w-full h-full text-teal-500/70 dark:text-teal-400/70 animate-spin-slow" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M12 2L14.1213 7.87868L20 10L14.1213 12.1213L12 18L9.87868 12.1213L4 10L9.87868 7.87868L12 2Z" fill="currentColor"/>
              </svg>
            </div>
            <div class="absolute -bottom-6 -left-10 w-12 h-12">
              <svg class="w-full h-full text-purple-500/70 dark:text-purple-400/70 animate-pulse" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" fill="currentColor"/>
              </svg>
            </div>
            
            <!-- Main Title with Enhanced Gradient -->
            <div class="flex flex-col items-center">
              <h1 class="text-6xl sm:text-7xl lg:text-8xl font-black text-transparent bg-clip-text bg-gradient-to-r from-teal-400 via-purple-500 to-pink-600 tracking-tighter leading-tight mb-2 drop-shadow-xl transform transition-all hover:scale-[1.01] duration-300">
                DevBlog
              </h1>
              <span class="text-lg sm:text-xl text-gray-400 font-medium">
                Share. Learn. Grow.
              </span>
            </div>
          </div>
          
          @if(config('blog.demoMode'))
            <div class="inline-flex items-center justify-center mt-4 animate-bounce-gentle">
              <span class="bg-gradient-to-r from-green-500 to-emerald-600 text-white text-sm font-bold rounded-full px-4 py-2 shadow-lg flex items-center gap-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                </svg>
                Demo Mode
              </span>
            </div>
          @endif
          
          <!-- Subtitle with Enhanced Typography -->
          <p class="mt-6 text-xl sm:text-2xl text-gray-300 leading-relaxed max-w-3xl mx-auto font-medium">
            <span class="relative inline-block">
              <span class="relative z-10">Explore the latest posts, insights, and stories from our community.</span>
              <span class="absolute bottom-0 left-0 right-0 h-3 bg-gradient-to-r from-teal-400/20 to-purple-500/20 -z-10"></span>
            </span>
          </p>
        </div>
      </section>

      <!-- Blog Posts Grid with Advanced Layout -->
      <section class="opacity-0 animate-fade-in animation-delay-700 duration-700">
        <div class="flex flex-wrap items-center justify-between mb-8">
          <h2 class="text-3xl font-bold text-white flex items-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 mr-3 text-purple-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
            </svg>
            Latest Articles
          </h2>
        </div>
        
        <!-- Livewire Component with Skeleton Loader -->
        <div class="blog-posts-container" wire:loading.class="opacity-50 transition-opacity duration-300">
          <div wire:loading class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach(range(1, 6) as $i)
              <div class="animate-pulse bg-gray-800/80 rounded-2xl overflow-hidden h-[450px]">
                <div class="bg-gray-700 h-60"></div>
                <div class="p-6">
                  <div class="h-8 bg-gray-700 rounded-lg mb-4"></div>
                  <div class="h-4 bg-gray-600 rounded mb-2"></div>
                  <div class="h-4 bg-gray-600 rounded mb-2 w-2/3"></div>
                  <div class="h-20 bg-gray-600 rounded mt-4"></div>
                  <div class="h-10 bg-gray-700 rounded-lg mt-6"></div>
                </div>
              </div>
            @endforeach
          </div>
          
          <livewire:latest-blog-posts />
        </div>

        <!-- No Posts Available - Enhanced -->
        @if(!$posts)
          <div class="mt-12 p-10 bg-gray-800/90 backdrop-blur-sm rounded-xl shadow-xl text-center transform transition-all hover:scale-[1.02] duration-500 border border-gray-700/50">
            <div class="mb-6">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-20 w-20 mx-auto text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19.5 12h-15m0 0l6.75 6.75M4.5 12l6.75-6.75" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 10v5a2 2 0 01-2 2H7m10-11v-1a2 2 0 00-2-2H9a2 2 0 00-2 2v1m0 4v8a2 2 0 002 2h3.5" />
              </svg>
            </div>
            <h2 class="text-3xl font-bold text-gray-200 mb-3">
              Coming Soon!
            </h2>
            <p class="mt-3 text-xl text-gray-400 max-w-lg mx-auto">
              We're working on creating amazing content for you. Check back soon for new articles and insights.
            </p>
            
            <!-- Email Notification Form -->
            <div class="mt-8 max-w-md mx-auto">
              <form class="flex gap-2">
                <input type="email" placeholder="Enter your email" class="flex-1 py-3 px-4 rounded-lg focus:ring-2 focus:ring-purple-500 border-0 bg-gray-700 text-white" required>
                <button type="submit" class="bg-gradient-to-r from-teal-500 to-purple-600 text-white font-medium py-3 px-6 rounded-lg hover:shadow-lg transition-all">
                  Notify Me
                </button>
              </form>
              <p class="text-sm text-gray-400 mt-2">
                We'll let you know when new content is available.
              </p>
            </div>
          </div>
        @endif
      </section>
      

    </div>
  </div>

  <!-- Enhanced Pricing Section -->
  @include('pricing')
  
  <!-- Add Custom Animations -->
  <style>
    @keyframes soft-glow {
      0%, 100% { opacity: 0.5; }
      50% { opacity: 0.8; }
    }
    
    @keyframes float-random {
      0% { transform: translate(0, 0) rotate(0deg); }
      33% { transform: translate(30px, -30px) rotate(5deg); }
      66% { transform: translate(-20px, 20px) rotate(-5deg); }
      100% { transform: translate(0, 0) rotate(0deg); }
    }
    
    @keyframes pulse-slow {
      0%, 100% { opacity: 0.6; transform: scale(1); }
      50% { opacity: 0.8; transform: scale(1.05); }
    }
    
    @keyframes fade-in {
      0% { opacity: 0; transform: translateY(20px); }
      100% { opacity: 1; transform: translateY(0); }
    }
    
    @keyframes bounce-gentle {
      0%, 100% { transform: translateY(0); }
      50% { transform: translateY(-5px); }
    }
    
    @keyframes spin-slow {
      from { transform: rotate(0deg); }
      to { transform: rotate(360deg); }
    }
    
    .animation-delay-300 { animation-delay: 300ms; }
    .animation-delay-500 { animation-delay: 500ms; }
    .animation-delay-700 { animation-delay: 700ms; }
    .animation-delay-900 { animation-delay: 900ms; }
    .animation-delay-2000 { animation-delay: 2000ms; }
    
    .animate-soft-glow { animation: soft-glow 8s infinite ease-in-out; }
    .animate-pulse-slow { animation: pulse-slow 8s infinite ease-in-out; }
    .animate-float-random { animation: float-random 20s infinite ease-in-out; }
    .animate-fade-in { animation: fade-in 1s forwards ease-out; }
    .animate-bounce-gentle { animation: bounce-gentle 2s infinite ease-in-out; }
    .animate-spin-slow { animation: spin-slow 20s infinite linear; }
    
    .bg-grid-pattern {
      background-image: linear-gradient(to right, rgba(255,255,255,.1) 1px, transparent 1px),
                        linear-gradient(to bottom, rgba(255,255,255,.1) 1px, transparent 1px);
      background-size: 20px 20px;
    }
    
    .bg-noise-texture {
      background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noiseFilter'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.65' numOctaves='3' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noiseFilter)'/%3E%3C/svg%3E");
    }
  </style>

  <!-- Alpine.js Logic -->
  <script>
    document.addEventListener('alpine:init', () => {
      // Auto-advance the featured carousel
      setInterval(() => {
        const carousel = document.querySelector('.featured-carousel')?.__x;
        if (carousel) {
          carousel.activeSlide = (carousel.activeSlide === 2) ? 0 : carousel.activeSlide + 1;
        }
      }, 8000);
    });
  </script>
</x-app-layout>