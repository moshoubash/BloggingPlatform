<x-app-layout>
  <div class="relative flex items-center justify-center min-h-screen bg-gradient-to-br from-gray-100 to-gray-300 dark:from-gray-900 dark:to-gray-700 rounded-lg shadow-xl overflow-hidden">
    <!-- Background Glow Effect -->
    <div class="absolute inset-0 animate-soft-glow"></div>

    <!-- Floating Particles -->
    <div class="absolute inset-0 pointer-events-none">
      <div class="absolute top-10 left-10 w-12 h-12 bg-white rounded-full opacity-80 animate-float blur-2xl"></div>
      <div class="absolute bottom-10 right-5 w-8 h-8 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full opacity-90 animate-float delay-1000 blur-xl"></div>
      <div class="absolute left-1/4 top-1/3 w-10 h-10 bg-gradient-to-r from-pink-500 to-yellow-400 rounded-full opacity-80 animate-float delay-2000 blur-lg"></div>
      <div class="absolute top-1/4 left-1/2 w-14 h-14 bg-gradient-to-r from-green-400 to-teal-500 rounded-full opacity-75 animate-float delay-3000 blur-xl"></div>
    </div>

    <section class="max-w-6xl mx-auto px-6 lg:px-8 relative z-10 text-center opacity-0 animate-fade-in">
      <!-- Header with Glow & Depth -->
      <header class="py-12">
        <h1 class="text-6xl md:text-7xl font-extrabold text-transparent bg-clip-text bg-gradient-to-r from-teal-400 via-purple-500 to-pink-600 tracking-tight drop-shadow-2xl leading-tight">
          {{ config('app.name') }}
          @if(config('blog.demoMode'))
            <span class="bg-gradient-to-r from-green-400 to-lime-500 text-white text-sm font-bold rounded-full px-4 py-1 ml-3 shadow-md">
              Demo Mode
            </span>
          @endif
        </h1>
        <p class="mt-4 text-xl text-gray-700 dark:text-gray-300 leading-relaxed">
          Explore the latest posts, insights, and stories from our community.
        </p>
      </header>

      <!-- Blog Posts -->
      <livewire:latest-blog-posts />

      <!-- No Posts Available -->
      @if(!$posts)
        <div class="mt-12 p-6 bg-gray-200 dark:bg-gray-800 rounded-lg shadow-md">
          <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-300">
            No posts available yet.
          </h2>
          <p class="mt-3 text-gray-500 dark:text-gray-400">Check back soon for new content.</p>
        </div>
      @endif
    </section>
  </div>

  <!-- Pricing Section -->
  @include('pricing')
</x-app-layout>
