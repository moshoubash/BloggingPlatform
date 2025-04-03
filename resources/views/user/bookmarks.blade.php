<x-app-layout>
    <div class="relative flex items-top justify-center sm:items-center py-4 sm:pt-0">
        <section class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if($bookmarkedPosts)
            <header class="text-center py-5 mt-5 mb-3">
                <h2 class="text-2xl font-medium dark:text-white">Bookmarked Posts</h2>
            </header>

            <div class="flex flex-row flex-wrap justify-start">
                @foreach ($bookmarkedPosts as $bookmark)
                    <x-post-card :post="$bookmark->post" />
                @endforeach
            </div>

            @else
            <header class="text-center py-5 mt-5 mb-3">
                <h2 class="text-2xl font-medium dark:text-white">There are no posts here!</h2>
            </header>
            @endif
        </section>
    </div>
</x-app-layout>
