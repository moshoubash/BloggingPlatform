<x-app-layout>
  <x-slot name="title">
    {{ $title ?? 'Posts' }}
  </x-slot>

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
              Blog Posts
            </h1>
            
            <!-- Enhanced subtitle with better typography -->
            <p class="mt-5 text-xl text-gray-600 dark:text-gray-400 max-w-xl mx-auto font-normal leading-relaxed">
              @if(isset($filter))
                {{ $filter }}
              @else
                Exploring the latest insights and developments
              @endif
            </p>
          </div>
        </div>
      </section>

      <!-- Posts Section -->
      <section class="opacity-0 animate-fade-in animation-delay-700 duration-700">
        @if($posts->count())
          <div class="blog-posts-container space-y-8">
            <div class="flex flex-wrap items-center justify-between mb-8">
              <h2 class="text-xl font-semibold text-gray-900 dark:text-white flex items-center">
                @if(isset($filter))
                  {{ $filter }}
                @else
                  All Articles
                @endif
              </h2>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
              @foreach ($posts as $post)
                <x-post-card :post="$post" />
              @endforeach
            </div>
          </div>
        @else
          <div class="mt-10 py-16 text-center">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-400 dark:text-gray-600 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
            </svg>
            <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">
              @if(isset($filter))
                No posts found! Try resetting your filters.
              @else
                No posts found!
              @endif
            </h2>
            <p class="text-gray-600 dark:text-gray-400 max-w-md mx-auto mb-6">
              @if(isset($filter))
                The current filters didn't match any available posts.
              @else
                We're working on creating valuable content. Check back soon for new articles.
              @endif
            </p>
            
            <div class="inline-flex">
              @if(isset($filter))
                <a href="{{ route('posts.index') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                  Clear Filters
                </a>
              @else
                <a href="{{ route('home') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                  Back to Home
                </a>
              @endif
            </div>
          </div>
        @endif
      </section>
    </div>
  </div>

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