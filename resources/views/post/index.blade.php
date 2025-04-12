<x-app-layout>
  <x-slot name="title">
    {{ $title ?? 'Posts' }}
  </x-slot>

  <div class="relative min-h-screen bg-white dark:bg-gray-900 overflow-hidden">
    <!-- Enhanced subtle background with gradient overlay -->
    <div class="absolute inset-0 bg-grid-pattern opacity-5 dark:opacity-10" aria-hidden="true"></div>
    <div class="absolute inset-0 bg-gradient-to-br from-blue-50/30 to-purple-50/30 dark:from-blue-900/10 dark:to-purple-900/10" aria-hidden="true"></div>
    
    <!-- Main Content Container with Sidebar Layout -->
    <div class="relative z-10 container max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12 sm:py-16">
      <!-- Enhanced Hero Section -->
      <section class="relative opacity-0 animate-fade-in animation-delay-300 duration-700">
        <div class="text-center mb-12">
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

      <!-- Main content area with sidebar -->
      <div class="flex flex-col lg:flex-row gap-8">
        <!-- Sidebar - Popular Topics Section -->
        <aside class="lg:w-1/4 opacity-0 animate-fade-in animation-delay-500 duration-700">
          <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm p-6 sticky top-8">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4 flex items-center">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-500" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M12.395 2.553a1 1 0 00-1.45-.385c-.345.23-.614.558-.822.88-.214.33-.403.713-.57 1.116-.334.804-.614 1.768-.84 2.734a31.365 31.365 0 00-.613 3.58 2.64 2.64 0 01-.945-1.067c-.328-.68-.398-1.534-.398-2.654A1 1 0 005.05 6.05 6.981 6.981 0 003 11a7 7 0 1011.95-4.95c-.592-.591-.98-.985-1.348-1.467-.363-.476-.724-1.063-1.207-2.03zM12.12 15.12A3 3 0 017 13s.879.5 2.5.5c0-1 .5-4 1.25-4.5.5 1 .786 1.293 1.371 1.879A2.99 2.99 0 0113 13a2.99 2.99 0 01-.879 2.121z" clip-rule="evenodd" />
              </svg>
              Popular Topics
            </h3>
            
            <!-- Popular Tags from Posts -->
            <div class="space-y-3">
              @php
                // Collect all tags across posts
                $tagCounts = [];
                foreach ($posts as $post) {
                  if (!empty($post->tags)) {
                    foreach ($post->tags as $tag) {
                      if (!isset($tagCounts[$tag])) {
                        $tagCounts[$tag] = 0;
                      }
                      $tagCounts[$tag]++;
                    }
                  }
                }
                
                // Sort by count (descending)
                arsort($tagCounts);
                
                // Colors for tags
                $colors = ['blue', 'purple', 'green', 'indigo', 'pink', 'red', 'yellow', 'orange'];
                $colorIndex = 0;
                
                // Take top 8 tags
                $popularTags = array_slice($tagCounts, 0, 8, true);
              @endphp
              
              @foreach($popularTags as $tag => $count)
                <a href="{{ route('posts.index', ['filterByTag' => $tag]) }}" 
                   class="flex items-center justify-between py-2 px-3 rounded-lg transition hover:bg-gray-100 dark:hover:bg-gray-700">
                  <span class="flex items-center">
                    <span class="w-2 h-2 rounded-full bg-{{ $colors[$colorIndex % count($colors)] }}-500 mr-2"></span>
                    <span class="text-gray-700 dark:text-gray-300">{{ $tag }}</span>
                  </span>
                  <span class="bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-400 text-xs px-2 py-1 rounded-full">
                    {{ $count }}
                  </span>
                </a>
                @php $colorIndex++; @endphp
              @endforeach
            </div>
            
            <!-- Popular Authors -->
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white mt-8 mb-4 flex items-center">
              <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 text-blue-500" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
              </svg>
              Popular Authors
            </h3>
            
            <div class="space-y-4">
              @php
                // Get authors with post counts
                $authors = [];
                foreach ($posts as $post) {
                  if ($post->user) {
                    $authorId = $post->user->id;
                    if (!isset($authors[$authorId])) {
                      $authors[$authorId] = [
                        'name' => $post->user->name,
                        'count' => 0,
                      ];
                    }
                    $authors[$authorId]['count']++;
                  }
                }
                
                // Sort by post count (descending)
                uasort($authors, function($a, $b) {
                  return $b['count'] - $a['count'];
                });
                
                // Take top 5 authors
                $topAuthors = array_slice($authors, 0, 5, true);
              @endphp
              
              @foreach($topAuthors as $authorId => $author)
                <a href="{{ route('posts.index', ['author' => $authorId]) }}" class="flex items-center justify-between py-2 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg px-3">
                  <span class="text-sm font-medium text-gray-700 dark:text-gray-300">{{ $author['name'] }}</span>
                  <span class="bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-400 text-xs px-2 py-1 rounded-full">
                    {{ $author['count'] }} posts
                  </span>
                </a>
              @endforeach
            </div>
          </div>
        </aside>
        
        <!-- Main Posts Content -->
        <div class="lg:w-3/4 opacity-0 animate-fade-in animation-delay-700 duration-700">
          @if($posts->count())
            <div class="blog-posts-container space-y-8">
              <!-- Sorting and filter options -->
              <div class="flex flex-wrap items-center justify-between mb-8 bg-white dark:bg-gray-800 rounded-xl shadow-sm p-4">
                <h2 class="text-xl font-semibold text-gray-900 dark:text-white flex items-center">
                  @if(isset($filter))
                    {{ $filter }}
                  @else
                    All Articles
                  @endif
                </h2>
                
                <!-- Sort dropdown with form submission -->
                <form method="GET" action="{{ route('posts.index') }}" class="flex items-center mt-3 sm:mt-0">
                  <!-- Preserve any existing query parameters -->
                  @if(request()->has('filterByTag'))
                    <input type="hidden" name="filterByTag" value="{{ request('filterByTag') }}">
                  @endif
                  
                  @if(request()->has('author'))
                    <input type="hidden" name="author" value="{{ request('author') }}">
                  @endif
                  
                  <label for="sortOrder" class="mr-2 text-sm text-gray-600 dark:text-gray-400">Sort by:</label>
                  <select id="sortOrder" name="sort" onchange="this.form.submit()" 
                          class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="newest" {{ request('sort') == 'newest' || !request('sort') ? 'selected' : '' }}>Newest First</option>
                    <option value="oldest" {{ request('sort') == 'oldest' ? 'selected' : '' }}>Oldest First</option>
                    <option value="popular" {{ request('sort') == 'popular' ? 'selected' : '' }}>Most Popular</option>
                    <option value="comments" {{ request('sort') == 'comments' ? 'selected' : '' }}>Most Commented</option>
                  </select>
                </form>
              </div>
              
              <!-- Posts grid with reading time -->
              <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @foreach ($posts as $post)
                  <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm overflow-hidden hover:shadow-md transition-shadow duration-300">
                    <!-- Image container with fixed aspect ratio -->
                    <div class="relative h-48 overflow-hidden">
                      @if($post->featured_image)
                        <img src="{{ $post->featured_image }}" alt="{{ $post->title }}" class="object-cover w-full h-full">
                      @else
                        <div class="w-full h-full bg-gradient-to-br from-gray-100 to-gray-200 dark:from-gray-700 dark:to-gray-600 flex items-center justify-center">
                          <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-gray-400 dark:text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                          </svg>
                        </div>
                      @endif
                      
                      <!-- Tags display over image -->
                      @if(!empty($post->tags))
                        <div class="absolute top-3 left-3 flex flex-wrap gap-2">
                          @foreach(array_slice($post->tags, 0, 2) as $tag)
                            <a href="{{ route('posts.index', ['filterByTag' => $tag]) }}" 
                               class="px-2 py-1 text-xs rounded-md bg-blue-500/80 text-white backdrop-blur-sm hover:bg-blue-600/80 transition">
                              {{ $tag }}
                            </a>
                          @endforeach
                          
                          @if(count($post->tags) > 2)
                            <span class="px-2 py-1 text-xs rounded-md bg-gray-500/80 text-white backdrop-blur-sm">
                              +{{ count($post->tags) - 2 }}
                            </span>
                          @endif
                        </div>
                      @endif
                      
                      <!-- Premium badge if applicable -->
                      @if($post->is_premium)
                        <div class="absolute top-3 right-3">
                          <span class="px-2 py-1 text-xs rounded-md bg-yellow-500/90 text-white backdrop-blur-sm flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3 mr-1" viewBox="0 0 20 20" fill="currentColor">
                              <path fill-rule="evenodd" d="M5 2a1 1 0 011 1v1h1a1 1 0 010 2H6v1a1 1 0 01-2 0V6H3a1 1 0 010-2h1V3a1 1 0 011-1zm0 10a1 1 0 011 1v1h1a1 1 0 110 2H6v1a1 1 0 11-2 0v-1H3a1 1 0 110-2h1v-1a1 1 0 011-1zM12 2a1 1 0 01.967.744L14.146 7.2 17.5 9.134a1 1 0 010 1.732l-3.354 1.935-1.18 4.455a1 1 0 01-1.933 0L9.854 12.8 6.5 10.866a1 1 0 010-1.732l3.354-1.935 1.18-4.455A1 1 0 0112 2z" clip-rule="evenodd" />
                            </svg>
                            Premium
                          </span>
                        </div>
                      @endif
                    </div>
                    
                    <!-- Content -->
                    <div class="p-5">
                      <!-- Meta info with reading time -->
                      <div class="flex items-center justify-between text-sm text-gray-500 dark:text-gray-400 mb-3">
                        <span class="flex items-center">
                          <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                          </svg>
                          {{ $post->created_at->format('M d, Y') }}
                        </span>
                        
                        <!-- Reading time estimate -->
                        <span class="flex items-center">
                          <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                          </svg>
                          @php
                            // Calculate reading time: Assume average reading speed of 200 words per minute
                            $wordCount = str_word_count(strip_tags($post->body ?? ''));
                            $readingTime = max(1, ceil($wordCount / 200));
                          @endphp
                          {{ $readingTime }} min read
                        </span>
                      </div>
                      
                      <!-- Title -->
                      <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2 line-clamp-2">
                        <a href="{{ route('posts.show', $post) }}" class="hover:text-blue-600 dark:hover:text-blue-400">
                          {{ $post->title }}
                        </a>
                      </h3>
                      
                      <!-- Excerpt -->
                      <p class="text-gray-600 dark:text-gray-300 text-sm mb-4 line-clamp-3">
                        {{ $post->excerpt ?? Str::limit(strip_tags($post->body ?? ''), 150) }}
                      </p>
                      
                      <!-- Author info and post stats -->
                      <div class="flex items-center justify-between">
                        <div class="flex items-center">
                          <div class="h-8 w-8 rounded-full bg-gray-200 dark:bg-gray-700 overflow-hidden mr-2">
                            @if($post->user && $post->user->avatar)
                              <img src="{{ $post->user->avatar }}" alt="{{ $post->user->name }}" class="h-full w-full object-cover">
                            @else
                              <svg xmlns="http://www.w3.org/2000/svg" class="h-full w-full text-gray-400 dark:text-gray-500 p-1" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                              </svg>
                            @endif
                          </div>
                          <a href="{{ route('posts.index', ['author' => $post->user->id]) }}" class="text-sm font-medium text-gray-700 dark:text-gray-300 hover:underline">
                            {{ $post->user->name ?? 'Anonymous' }}
                          </a>
                        </div>
                        
                        <div class="flex items-center space-x-3">
                          <span class="flex items-center text-gray-500 dark:text-gray-400 text-xs">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                            </svg>
                            {{ $post->likes->count() }}
                          </span>
                          
                          <a href="{{ route('posts.show', $post) }}" class="text-sm font-medium text-blue-600 dark:text-blue-400 hover:underline">
                            Read more →
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                @endforeach
              </div>
              
              <!-- Pagination - if using Laravel's pagination -->
              @if(method_exists($posts, 'links'))
                <div class="mt-8">
                  {{ $posts->links() }}
                </div>
              @endif
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
        </div>
      </div>
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
    
    /* Line clamp for text truncation */
    .line-clamp-2 {
      display: -webkit-box;
      -webkit-line-clamp: 2;
      -webkit-box-orient: vertical;
      overflow: hidden;
    }
    
    .line-clamp-3 {
      display: -webkit-box;
      -webkit-line-clamp: 3;
      -webkit-box-orient: vertical;
      overflow: hidden;
    }
  </style>
</x-app-layout>