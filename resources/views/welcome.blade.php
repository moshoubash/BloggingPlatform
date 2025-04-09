<x-app-layout>
  <div class="relative min-h-screen bg-white dark:bg-gray-900 overflow-hidden">
    <!-- Enhanced subtle background with gradient overlay -->
    <div class="absolute inset-0 bg-grid-pattern opacity-5 dark:opacity-10" aria-hidden="true"></div>
    <div class="absolute inset-0 bg-gradient-to-br from-blue-50/30 to-purple-50/30 dark:from-blue-900/10 dark:to-purple-900/10" aria-hidden="true"></div>
    
    <!-- Main Content Container -->
    <div class="relative z-10 container max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12 sm:py-16">
      <!-- Enhanced Hero Section -->
      <section class="relative opacity-0 animate-fade-in animation-delay-300 duration-700">
        <div class="text-center mb-16">
          <!-- Enhanced Main Title with subtle decoration -->
          <div class="inline-block relative mb-8">
            <!-- Decorative element above the title -->
            <div class="hidden sm:block absolute -top-8 left-1/2 transform -translate-x-1/2 w-16 h-1 bg-gradient-to-r from-blue-400 to-purple-500 rounded-full"></div>
            
            <!-- Main Logo Title with improved styling -->
            <h1 class="text-4xl sm:text-6xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-gray-900 to-gray-700 dark:from-white dark:to-gray-300 tracking-tight leading-none">
              DevBlog
            </h1>
            
            <!-- Enhanced subtitle with better typography -->
            <p class="mt-5 text-xl text-gray-600 dark:text-gray-400 max-w-xl mx-auto font-normal leading-relaxed">
              Tech insights from developers shaping tomorrow's solutions
            </p>
          </div>
          
          <!-- Demo mode badge with enhanced styling -->
          @if(config('blog.demoMode'))
            <div class="inline-flex items-center justify-center mt-3">
              <span class="bg-gradient-to-r from-blue-50 to-purple-50 dark:from-blue-900/20 dark:to-purple-900/20 text-gray-800 dark:text-gray-200 text-xs font-medium rounded-full px-4 py-1.5 flex items-center gap-1.5 shadow-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 text-blue-500 dark:text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" />
                </svg>
                Demo Mode
              </span>
            </div>
          @endif
        </div>
      </section>

      <!-- Rest of the content remains the same -->
      <section class="opacity-0 animate-fade-in animation-delay-700 duration-700">
        <!-- Content unchanged -->
        <div class="flex flex-wrap items-center justify-between mb-8">
          <h2 class="text-xl font-semibold text-gray-900 dark:text-white flex items-center">
            Latest Articles
          </h2>
  
          <div class="text-sm text-gray-600 dark:text-gray-400">
            <a href="#" class="hover:text-gray-900 dark:hover:text-white transition-colors">
              View all
            </a>
          </div>
        </div>
        
        <div class="blog-posts-container space-y-8" wire:loading.class="opacity-50 transition-opacity duration-300">
          
          <div wire:loading class="space-y-8">
            @foreach(range(1, 3) as $i)
              <div class="animate-pulse border-b border-gray-200 dark:border-gray-800 pb-8">
                <div class="flex items-center space-x-3 mb-3">
                  <div class="w-7 h-7 rounded-full bg-gray-200 dark:bg-gray-700"></div>
                  <div class="flex flex-col">
                    <div class="h-3 bg-gray-200 dark:bg-gray-700 rounded w-24 mb-1"></div>
                    <div class="h-2 bg-gray-100 dark:bg-gray-800 rounded w-16"></div>
                  </div>
                </div>
                <div class="flex flex-col md:flex-row md:space-x-5 space-y-4 md:space-y-0">
                  <div class="md:w-2/3">
                    <div class="h-6 bg-gray-200 dark:bg-gray-700 rounded mb-3"></div>
                    <div class="h-3 bg-gray-100 dark:bg-gray-800 rounded mb-2"></div>
                    <div class="h-3 bg-gray-100 dark:bg-gray-800 rounded mb-2"></div>
                    <div class="h-3 bg-gray-100 dark:bg-gray-800 rounded w-2/3 mb-4"></div>
                    <div class="flex items-center space-x-4">
                      <div class="h-2.5 bg-gray-100 dark:bg-gray-800 rounded w-16"></div>
                      <div class="h-2.5 bg-gray-100 dark:bg-gray-800 rounded w-12"></div>
                      <div class="h-2.5 bg-gray-100 dark:bg-gray-800 rounded w-20"></div>
                    </div>
                  </div>
                  <div class="md:w-1/3">
                    <div class="bg-gray-200 dark:bg-gray-700 rounded h-28"></div>
                  </div>
                </div>
              </div>
            @endforeach
          </div>
          
          <livewire:latest-blog-posts />
          
        </div>
        
        @if(!$posts)
          <div class="mt-10 py-16 text-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-400 dark:text-gray-600 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
            </svg>
            <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">
              No stories published yet
            </h2>
            <p class="text-gray-600 dark:text-gray-400 max-w-md mx-auto">
              We're working on creating valuable content. Check back soon for new articles.
            </p>
          </div>
        @endif
      </section>
    </div>
  </div>

  @include('pricing')
  
  <!-- Enhanced Animations with smoother transitions -->
  <style>
    @keyframes fade-in {
      0% { opacity: 0; transform: translateY(12px); }
      100% { opacity: 1; transform: translateY(0); }
    }
    
    .animation-delay-300 { animation-delay: 300ms; }
    .animation-delay-500 { animation-delay: 500ms; }
    .animation-delay-700 { animation-delay: 700ms; }
    
    .animate-fade-in { animation: fade-in 0.8s forwards cubic-bezier(0.18, 0.89, 0.32, 1.15); }
    
    .bg-grid-pattern {
      background-image: linear-gradient(to right, rgba(0,0,0,.05) 1px, transparent 1px),
                        linear-gradient(to bottom, rgba(0,0,0,.05) 1px, transparent 1px);
      background-size: 30px 30px;
    }
    
    /* Dark mode grid pattern */
    @media (prefers-color-scheme: dark) {
      .bg-grid-pattern {
        background-image: linear-gradient(to right, rgba(255,255,255,.05) 1px, transparent 1px),
                          linear-gradient(to bottom, rgba(255,255,255,.05) 1px, transparent 1px);
      }
    }
  </style>
</x-app-layout>