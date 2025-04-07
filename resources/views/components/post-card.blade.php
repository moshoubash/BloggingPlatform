@php
    $views = App\Models\PageView::where('page', '/posts/' . $post->slug)->count();   
@endphp

<article class="w-full sm:w-80 bg-white/80 backdrop-blur-lg rounded-xl shadow-lg transition-all duration-300 hover:shadow-2xl dark:bg-gray-900/80 overflow-hidden m-4 flex flex-col flex-grow">
    <header class="relative">
        <a href="{{ route('posts.show', $post) }}">
            <div class="relative w-full h-48 bg-cover bg-center rounded-t-xl" style="background-image: url('{{ $post->featured_image }}'); background-position: center; background-size: cover;">
                @if($post->is_premium)
                    <span class="absolute top-4 left-4 bg-yellow-500 text-white text-xs font-semibold px-3 py-1 rounded-lg shadow-md flex items-center gap-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2L15.09 8.26L22 9.27L17 14.14L18.18 21.02L12 17.77L5.82 21.02L7 14.14L2 9.27L8.91 8.26L12 2Z"/></svg>
                        Premium
                    </span>
                @endif
            </div>
        </a>
    </header>

    <div class="p-5 h-full flex flex-col">
        @if(config('blog.withTags') && config('blog.showTagsOnPostCard') && $post->tags)
            <x-post-tags :tags="$post->tags" class="text-xs" />
        @endif

        <a href="{{ route('posts.show', $post) }}" class="block">
            <h3 class="text-xl font-semibold text-gray-900 dark:text-white transition-colors duration-200 hover:text-blue-500">
                @if($post->isPublished())
                    {{ $post->title }}
                @else
                    <span class="opacity-75 text-gray-500">Draft:</span> <i>{{ $post->title }}</i>
                @endif
            </h3>
        </a>

        <p class="mt-2 text-sm text-gray-700 dark:text-gray-300 line-clamp-2">
            {{ $post->description }}
        </p>

        <div class="mt-auto flex items-center justify-between text-sm text-gray-500 dark:text-gray-400">
            <span class="flex items-center gap-1">
                <!-- Refined Eye Icon -->
                <svg class="w-5 h-5 fill-current text-gray-600 dark:text-gray-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z"/></svg>
                {{ $views }}
            </span>

            @if(config('blog.allowComments'))
                <a href="{{ route('posts.show', $post) }}#comments" class="flex items-center gap-1 hover:text-blue-500 transition-colors">
                    <!-- Refined Comment Icon -->
                    <svg class="w-5 h-5 fill-current text-gray-600 dark:text-gray-300" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M21.99 4c0-1.1-.89-2-1.99-2H4c-1.1 0-2 .9-2 2v12c0 1.1.9 2 2 2h14l4 4-.01-18zM18 14H6v-2h12v2zm0-3H6V9h12v2zm0-3H6V6h12v2z"/></svg>
                    {{ $post->comments->count() }}
                </a>
            @endif
        </div>

        <a href="{{ route('posts.show', $post) }}" class="mt-4 w-full inline-flex items-center justify-center py-2 px-4 text-sm font-medium text-white bg-blue-600 rounded-lg hover:bg-blue-700 transition-all duration-300">
            {{ __('Read more') }}
            <svg class="ml-2 w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd"/></svg>
        </a>
    </div>
</article>
