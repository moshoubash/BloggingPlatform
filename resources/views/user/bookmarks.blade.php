<x-app-layout>
    <div class="relative min-h-screen bg-white dark:bg-gray-900 overflow-hidden">
        <!-- Subtle background pattern -->
        <div class="absolute inset-0 bg-grid-pattern opacity-5 dark:opacity-10" aria-hidden="true"></div>
        <div class="absolute inset-0 bg-gradient-to-br from-blue-50/30 to-purple-50/30 dark:from-blue-900/10 dark:to-purple-900/10" aria-hidden="true"></div>
        
        <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <!-- Header Section -->
            <section class="relative opacity-0 animate-fade-in animation-delay-300 duration-700 mb-8">
                <div class="text-center mb-8">
                    <h2 class="text-3xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-gray-900 to-gray-700 dark:from-white dark:to-gray-300 tracking-tight">
                        Bookmarked Posts
                    </h2>
                    <div class="hidden sm:block absolute left-1/2 transform -translate-x-1/2 w-16 h-1 bg-gradient-to-r from-blue-400 to-purple-500 rounded-full mt-3"></div>
                </div>
            </section>
            
            <!-- Bookmarks Section -->
            <section class="relative opacity-0 animate-fade-in animation-delay-500 duration-700 mb-12">
                @if($bookmarkedPosts && count($bookmarkedPosts) > 0)
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($bookmarkedPosts as $bookmark)
                            <div class="bg-white dark:bg-gray-800 shadow-md rounded-xl overflow-hidden transform transition-transform hover:scale-105 duration-300">
                                <div class="p-6">
                                    <div class="flex items-center justify-between mb-3">
                                        <div class="flex items-center space-x-3">
                                            @if($bookmark->post->user->profile_photo_path)
                                                <img class="h-10 w-10 rounded-full object-cover" src="{{ Storage::url($bookmark->post->user->profile_photo_path) }}" alt="{{ $bookmark->post->user->name }}">
                                            @else
                                                <div class="h-10 w-10 rounded-full bg-gradient-to-r from-blue-400 to-purple-500 flex items-center justify-center text-white font-bold">
                                                    {{ substr($bookmark->post->user->name, 0, 1) }}
                                                </div>
                                            @endif
                                            <div>
                                                <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 truncate">{{ $bookmark->post->title }}</h3>
                                                <p class="text-sm text-gray-500 dark:text-gray-400">{{ $bookmark->post->user->name }}</p>
                                            </div>
                                        </div>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-500" fill="currentColor" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" />
                                        </svg>
                                    </div>
                                    <div class="mb-4">
                                        <p class="text-gray-600 dark:text-gray-300 line-clamp-3">{{ $bookmark->post->excerpt }}</p>
                                    </div>
                                    <div class="flex justify-between items-center">
                                        <div class="flex space-x-4 text-sm text-gray-500 dark:text-gray-400">
                                            <div class="flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                                {{ $bookmark->post->views_count ?? 0 }}
                                            </div>
                                            <div class="flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                                                </svg>
                                                {{ $bookmark->post->comments_count ?? 0 }}
                                            </div>
                                        </div>
                                        <span class="text-xs bg-gradient-to-r from-blue-100 to-indigo-100 dark:from-blue-900/30 dark:to-indigo-900/30 text-blue-800 dark:text-blue-300 px-2 py-1 rounded-full">
                                            {{ $bookmark->post->category->name ?? 'Uncategorized' }}
                                        </span>
                                    </div>
                                    <a href="{{ route('posts.show', $bookmark->post) }}" class="block text-center mt-4 py-2 px-4 bg-gradient-to-r from-indigo-500 to-purple-600 text-white rounded-lg text-sm font-medium hover:from-indigo-600 hover:to-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition">
                                        Read Post
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="opacity-0 animate-fade-in animation-delay-500 duration-700">
                        <div class="bg-white dark:bg-gray-800 shadow-md rounded-xl p-12 text-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-16 w-16 mx-auto text-gray-400 dark:text-gray-500 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z" />
                            </svg>
                            <h3 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-2">No Bookmarks Yet</h3>
                            <p class="text-gray-600 dark:text-gray-400 mb-6">You haven't saved any posts to your bookmarks collection.</p>
                      
                        </div>
                    </div>
                @endif
            </section>
        </div>
    </div>

    <!-- Matching animations for consistency -->
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
        
        /* Add line clamp for text truncation */
        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
</x-app-layout>