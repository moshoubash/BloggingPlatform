<x-app-layout>
    <div class="relative flex items-top justify-center sm:items-center py-4 sm:pt-0">
        <section class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if($posts)
            <header class="text-center py-5 mt-5 mb-8">
                <h1 class="text-4xl font-extrabold text-gray-900 dark:text-white my-3">
                    {{ config('app.name') }}
                    @if(config('blog.demoMode'))
                        <span class="bg-green-500 text-green-900 text-sm rounded-lg px-2 py-1 my-1 ml-3 absolute">Demo Mode</span>
                    @endif
                </h1>
                <h2 class="text-2xl font-medium text-gray-700 dark:text-white">Latest Blog Posts</h2>
            </header>

            <livewire:latest-blog-posts />

            @else
                <header class="text-center py-5 mt-5 mb-8">
                    <h2 class="text-2xl font-medium text-gray-700 dark:text-white">There are no posts here!</h2>
                </header>
            @endif
        </section>
    </div>
    <!-- Include Pricing Table Here -->
    @include('pricing')
</x-app-layout>