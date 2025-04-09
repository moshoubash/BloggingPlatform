@php
    // Efficiently cache view count to prevent duplicate queries
    $cacheKey = 'post_views_' . $post->id;
    $views = Cache::remember($cacheKey, now()->addHours(3), function () use ($post) {
        return App\Models\PageView::where('page', '/posts/' . $post->slug)->count();
    });
    
    // Format published date once
    $publishedDate = $post->isPublished() 
        ? $post->published_at->format('M d, Y') 
        : null;
        
    // Extract common values
    $postUrl = route('posts.show', $post);
    $authorUrl = route('profile', ['user' => $post->author]);
    $commentsCount = $post->comments_count ?? ($post->comments ? $post->comments->count() : 0);
    $isCommentsEnabled = config('blog.allowComments');
    $readTime = $post->read_time ?? ceil(str_word_count(strip_tags($post->content)) / 200) . ' min read';
@endphp

<article 
    class="post-card border-b border-gray-200 dark:border-gray-700 pb-8 mb-8 last:border-0 w-full max-w-full md:max-w-3xl mx-auto transition-all duration-300 hover:translate-y-[-2px]"
    data-post-id="{{ $post->id }}"
    aria-labelledby="post-title-{{ $post->id }}"
>
    <div class="flex flex-col space-y-4">
        <!-- Author Info & Date -->
        <div class="flex items-center space-x-3">
            <a href="{{ $authorUrl }}" class="flex-shrink-0">
                @if(isset($post->author->profile_photo_url))
                    <img 
                        src="{{ $post->author->profile_photo_url }}" 
                        alt="{{ $post->author->name }}" 
                        class="w-9 h-9 rounded-full object-cover ring-2 ring-white dark:ring-gray-800 shadow-sm"
                        loading="lazy"
                    >
                @else
                    <div class="w-9 h-9 rounded-full bg-gradient-to-br from-gray-300 to-gray-400 dark:from-gray-600 dark:to-gray-700 flex items-center justify-center text-lg font-medium text-white">
                        {{ substr($post->author->name, 0, 1) }}
                    </div>
                @endif
            </a>
            
            <div class="flex flex-col text-sm">
                <a 
                    href="{{ $authorUrl }}" 
                    rel="author" 
                    class="font-medium text-gray-900 dark:text-gray-100 hover:text-gray-700 dark:hover:text-gray-300 transition-colors"
                >
                    {{ $post->author->name }}
                </a>
                
                <div class="flex items-center text-gray-500 dark:text-gray-400 space-x-2 text-sm">
                    @if($publishedDate)
                        <time datetime="{{ $post->published_at->toIso8601String() }}">
                            {{ $publishedDate }}
                        </time>
                        <span>·</span>
                    @endif
                    <span>{{ $readTime }}</span>
                    
                    @if($post->is_premium)
                        <span>·</span>
                        <span class="flex items-center text-amber-600 dark:text-amber-400 font-medium">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                            </svg>
                            Premium
                        </span>
                    @endif
                </div>
            </div>
        </div>
        
        <!-- Flexible Content Layout -->
        <div class="flex flex-col md:flex-row md:space-x-6 space-y-4 md:space-y-0">
            <!-- Text Content -->
            <div class="md:w-2/3 flex flex-col space-y-3 order-2 md:order-1">
                <a href="{{ $postUrl }}" class="group">
                    <h2 
                        id="post-title-{{ $post->id }}" 
                        class="text-xl sm:text-2xl font-bold text-gray-900 dark:text-gray-100 group-hover:text-gray-700 dark:group-hover:text-gray-300 transition-colors leading-tight"
                    >
                        {{ $post->title }}
                    </h2>
                </a>
                
                <p class="text-base text-gray-600 dark:text-gray-300 leading-relaxed">
                    {{ $post->description }}
                </p>
                
                <!-- Engagement Stats & Actions -->
                <div class="flex items-center justify-between pt-3 text-sm text-gray-500 dark:text-gray-400">
                    <div class="flex items-center space-x-4">
                        <!-- Read Indicator -->
                        <a 
                            href="{{ $postUrl }}" 
                            class="inline-flex items-center font-medium text-emerald-600 dark:text-emerald-400 hover:text-emerald-700 dark:hover:text-emerald-300 transition-colors"
                        >
                            Read more
                            <svg class="ml-1 w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </a>
                        
                        <!-- Views -->
                        <span class="flex items-center" title="{{ number_format($views) }} views">
                            <svg class="w-4 h-4 mr-1.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            {{ number_format($views) }}
                        </span>
                        
                        <!-- Comments if enabled -->
                        @if($isCommentsEnabled)
                            <a 
                                href="{{ $postUrl }}#comments" 
                                class="flex items-center hover:text-gray-700 dark:hover:text-gray-300 transition-colors" 
                            >
                                <svg class="w-4 h-4 mr-1.5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z" />
                                </svg>
                                {{ number_format($commentsCount) }}
                            </a>
                        @endif
                    </div>
                    
                    <!-- Share Dropdown -->
                    <div x-data="{ showShare: false }" class="relative">
                        <button 
                            @click="showShare = !showShare" 
                            @click.away="showShare = false"
                            class="flex items-center hover:text-gray-700 dark:hover:text-gray-300 transition-colors"
                            aria-label="Share post"
                        >
                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
                            </svg>
                        </button>
                        
                        <div 
                            x-show="showShare" 
                            x-transition 
                            class="absolute right-0 bottom-full mb-2 bg-white dark:bg-gray-800 rounded-lg shadow-lg p-2 flex gap-2 z-10"
                        >
                            <a 
                                href="https://twitter.com/intent/tweet?url={{ urlencode(url($postUrl)) }}&text={{ urlencode($post->title) }}" 
                                target="_blank" 
                                rel="noopener noreferrer"
                                class="text-blue-500 hover:text-blue-600"
                                aria-label="Share on Twitter"
                            >
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84"></path>
                                </svg>
                            </a>
                            
                            <a 
                                href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url($postUrl)) }}" 
                                target="_blank" 
                                rel="noopener noreferrer"
                                class="text-blue-700 hover:text-blue-800"
                                aria-label="Share on Facebook"
                            >
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd"></path>
                                </svg>
                            </a>
                            
                            <a 
                                href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(url($postUrl)) }}" 
                                target="_blank" 
                                rel="noopener noreferrer"
                                class="text-blue-600 hover:text-blue-700"
                                aria-label="Share on LinkedIn"
                            >
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z" clip-rule="evenodd"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Featured Image (Conditional, only shown on large screens) -->
            @if($post->featured_image)
                <div class="md:w-1/3 order-1 md:order-2">
                    <a href="{{ $postUrl }}" class="block overflow-hidden rounded-lg shadow-sm hover:shadow-md transition-shadow duration-300">
                        <img 
                            src="{{ $post->featured_image }}" 
                            alt="{{ $post->title }}" 
                            class="w-full h-40 md:h-32 lg:h-40 object-cover transform hover:scale-105 transition-transform duration-500" 
                            loading="lazy"
                        />
                    </a>
                </div>
            @endif
        </div>
    </div>
</article>