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
@endphp

<article 
    class="group post-card relative w-full sm:w-80 bg-gradient-to-br from-white/90 to-gray-100 dark:from-gray-800/90 dark:to-gray-700 backdrop-blur-xl shadow-lg hover:shadow-2xl transition duration-500 rounded-2xl overflow-hidden m-4 flex flex-col min-h-[450px]"
    data-post-id="{{ $post->id }}"
    aria-labelledby="post-title-{{ $post->id }}"
>
    {{-- Featured Image Header --}}
    <header class="relative">
        <a href="{{ $postUrl }}" class="block focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-offset-2 rounded-t-2xl" aria-label="View post: {{ $post->title }}">
            <div 
                class="relative w-full h-60 bg-cover bg-center transition duration-500 rounded-t-2xl" 
                style="background-image: url('{{ $post->featured_image }}')"
                aria-hidden="true"
            >
                {{-- Premium Badge --}}
                @if($post->is_premium)
                    <span class="absolute top-4 left-4 bg-gradient-to-r from-amber-500 to-yellow-600 text-white text-xs font-bold px-3 py-1 rounded-full shadow-md transform rotate-[1deg] z-10">
                        <span class="flex items-center gap-1">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                            </svg>
                            Premium
                        </span>
                    </span>
                @endif

                {{-- Image Overlay with Stats --}}
                <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/40 to-transparent opacity-80 group-hover:opacity-90 transition-opacity duration-300 flex items-end justify-between text-center rounded-t-2xl p-4">
                    <div class="flex gap-6 text-white transition-transform duration-300 transform translate-y-2 group-hover:translate-y-0">
                        <span class="flex items-center gap-2 font-medium text-sm">
                            <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z"/>
                            </svg>
                            {{ number_format($views) }}
                        </span>
                        
                        @if($isCommentsEnabled)
                            <a href="{{ $postUrl }}#comments" class="flex items-center gap-2 text-white hover:text-teal-300 transition-colors text-sm font-medium">
                                <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M21.99 4c0-1.1-.89-2-1.99-2H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h14l4 4-.01-18zM18 14H6v-2h12v2zm0-3H6V9h12v2zm0-3H6V6h12v2z"/>
                                </svg>
                                {{ number_format($commentsCount) }}
                            </a>
                        @endif
                    </div>
                    
                    <div class="opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                        <span class="inline-flex items-center text-xs bg-white/20 backdrop-blur-sm px-2 py-1 rounded-full text-white">
                            {{ $post->read_time ?? ceil(str_word_count(strip_tags($post->content)) / 200) . ' min read' }}
                        </span>
                    </div>
                </div>
            </div>
        </a>
    </header>

    {{-- Content Area --}}
    <div class="p-6 flex flex-col flex-1 bg-white/95 dark:bg-gray-900/95 rounded-b-2xl">
        {{-- Tags section removed as requested --}}

        {{-- Title --}}
        <a href="{{ $postUrl }}" class="group/title block mb-3">
            <h3 
                id="post-title-{{ $post->id }}" 
                class="text-xl font-bold text-gray-900 dark:text-gray-100 group-hover/title:text-teal-600 dark:group-hover/title:text-teal-400 transition-colors duration-300"
            >
                {{ $post->title }}
            </h3>
        </a>

        {{-- Author & Date --}}
        <div class="text-sm text-gray-600 dark:text-gray-400 mb-4 flex items-center gap-2">
            <a 
                href="{{ $authorUrl }}" 
                rel="author" 
                class="font-medium hover:text-teal-600 dark:hover:text-teal-400 transition-colors flex items-center gap-2"
            >
                @if(isset($post->author->profile_photo_url))
                    <img 
                        src="{{ $post->author->profile_photo_url }}" 
                        alt="{{ $post->author->name }}" 
                        class="w-5 h-5 rounded-full object-cover"
                        loading="lazy"
                    >
                @endif
                {{ $post->author->name }}
            </a>
            
            @if($publishedDate)
                <span class="text-gray-400 dark:text-gray-500">•</span>
                <time datetime="{{ $post->published_at->toIso8601String() }}" title="{{ $post->published_at->format('F j, Y') }}">
                    {{ $publishedDate }}
                </time>
            @endif
        </div>

        {{-- Description --}}
        <p class="text-sm text-gray-700 dark:text-gray-300 leading-relaxed line-clamp-3 mb-4">
            {{ $post->description }}
        </p>

        {{-- Footer with Stats --}}
        <div class="mt-auto flex items-center justify-between text-xs text-gray-500 dark:text-gray-400 mb-4">
            <div class="flex items-center gap-4">
                <span class="flex items-center gap-1" title="{{ number_format($views) }} views">
                    <svg class="w-4 h-4 text-gray-400 dark:text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z"/>
                    </svg>
                    {{ number_format($views) }}
                </span>
                
                @if($isCommentsEnabled)
                    <a 
                        href="{{ $postUrl }}#comments" 
                        class="flex items-center gap-1 hover:text-teal-500 transition-colors" 
                        title="{{ number_format($commentsCount) }} comments"
                    >
                        <svg class="w-4 h-4 text-gray-400 dark:text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M21.99 4c0-1.1-.89-2-1.99-2H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h14l4 4-.01-18zM18 14H6v-2h12v2zm0-3H6V9h12v2zm0-3H6V6h12v2z"/>
                        </svg>
                        {{ number_format($commentsCount) }}
                    </a>
                @endif
                
                {{-- Category section removed as it used the bycategory route --}}
            </div>
            
            <div x-data="{ showShare: false }" class="relative">
                <button 
                    @click="showShare = !showShare" 
                    @click.away="showShare = false"
                    class="flex items-center gap-1 hover:text-teal-500 transition-colors"
                    aria-label="Share post"
                >
                    <svg class="w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
                    </svg>
                </button>
                
                <div 
                    x-show="showShare" 
                    x-transition 
                    class="absolute right-0 bottom-full mb-2 bg-white dark:bg-gray-800 rounded-lg shadow-lg p-2 flex gap-2"
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

        {{-- CTA Button --}}
        <a 
            href="{{ $postUrl }}" 
            class="inline-flex items-center justify-center py-2 px-4 text-sm font-medium text-white bg-gradient-to-r from-teal-500 to-emerald-600 rounded-lg shadow-md hover:from-teal-600 hover:to-emerald-700 transform hover:scale-[1.02] focus:ring-2 focus:ring-offset-2 focus:ring-teal-500 focus:outline-none transition"
        >
            <span>Read Article</span>
            <svg class="ml-2 w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
            </svg>
        </a>
    </div>
    
    {{-- Add hover effect decoration --}}
    <div class="absolute -z-10 inset-0 bg-gradient-to-br from-teal-400/20 to-emerald-600/20 transform scale-[0.8] opacity-0 group-hover:opacity-100 group-hover:scale-105 rounded-2xl transition-all duration-500 blur-xl"></div>
</article>