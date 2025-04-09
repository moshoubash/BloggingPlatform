<x-app-layout>
    <div class="relative min-h-screen bg-white dark:bg-gray-900 overflow-hidden">
        <!-- Subtle background pattern -->
        <div class="absolute inset-0 bg-grid-pattern opacity-5 dark:opacity-10" aria-hidden="true"></div>
        <div class="absolute inset-0 bg-gradient-to-br from-blue-50/30 to-purple-50/30 dark:from-blue-900/10 dark:to-purple-900/10" aria-hidden="true"></div>
        
        <div class="relative z-10 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Cover Image Section - Improved styling to match DevBlog -->
            <div class="relative bg-gradient-to-r from-gray-800 to-gray-900 flex items-center justify-center rounded-b-xl shadow-md overflow-hidden h-48 sm:h-56 md:h-64 animation-delay-300 animate-fade-in opacity-0">
                @if ($cover_image)
                    <img src="{{ asset('storage/'.$user->cover_image) }}" alt="user cover image" class="w-full h-full object-cover opacity-80">
                @else
                    <img src='https://t3.ftcdn.net/jpg/04/67/96/14/360_F_467961418_UnS1ZAwAqbvVVMKExxqUNi0MUFTEJI83.jpg' alt="user cover image" class="w-full h-full object-cover opacity-80">
                @endif
                
                <!-- Subtle overlay gradient -->
                <div class="absolute inset-0 bg-gradient-to-t from-gray-900/60 to-transparent"></div>
            </div>

            <!-- Profile Picture and User Info Section - Redesigned to match DevBlog -->
            <div class="relative -mt-20 sm:-mt-24 mb-12 animation-delay-500 animate-fade-in opacity-0">
                <div class="flex flex-col items-center">
                    <!-- Profile picture with improved styling -->
                    <div class="w-32 h-32 sm:w-40 sm:h-40 rounded-full border-4 border-white dark:border-gray-800 shadow-lg bg-white dark:bg-gray-800 overflow-hidden">
                        @if($profile_image)
                            <img src="{{ asset('storage/'.$user->profile_image) }}" alt="user profile picture" class="w-full h-full object-cover">
                        @else
                            <img src='https://i.ibb.co/sddfSJ9L/user.png' alt="user profile picture" class="w-full h-full object-cover">
                        @endif
                    </div>

                    <!-- User info with improved typography -->
                    <div class="mt-4 text-center">
                        <h2 class="text-2xl font-bold text-gray-900 dark:text-white flex items-center justify-center">
                            {{ $user->name ?? 'User Full Name' }}
                            @if ($user->stripe_subscription_id)
                                <span class="ml-2 text-yellow-500" title="Premium User">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="#FFD700" height="20px" width="20px" version="1.1" viewBox="0 0 220 220" class="ml-1">
                                        <path d="M220,98.865c0-12.728-10.355-23.083-23.083-23.083s-23.083,10.355-23.083,23.083c0,5.79,2.148,11.084,5.681,15.14  l-23.862,21.89L125.22,73.002l17.787-20.892l-32.882-38.623L77.244,52.111l16.995,19.962l-30.216,63.464l-23.527-21.544  c3.528-4.055,5.671-9.344,5.671-15.128c0-12.728-10.355-23.083-23.083-23.083C10.355,75.782,0,86.137,0,98.865  c0,11.794,8.895,21.545,20.328,22.913l7.073,84.735H192.6l7.073-84.735C211.105,120.41,220,110.659,220,98.865z"/>
                                    </svg>
                                </span>
                            @endif
                        </h2>

                        <!-- Bio with improved styling -->
                        <p class="mt-2 text-gray-600 dark:text-gray-400 max-w-md mx-auto">{{ $bio }}</p>

                        <!-- Action buttons with consistent styling -->
                        <div class="mt-4">
                            @if (Auth::check() && Auth::user()->id != $user_id)
                                <form action="{{ route('users.follow', $user->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    <button type="submit" class="px-4 py-1.5 rounded-full text-sm font-medium text-white transition duration-300 shadow-sm" 
                                            style="background-color: {{ $isFollowing ? '#FF5757' : 'rgb(59, 130, 246)' }}">
                                        {{ $isFollowing ? 'Unfollow' : 'Follow' }}
                                    </button>
                                </form>
                            @else
                                @auth
                                    <a href="{{ route('user.edit', ['user' => $user]) }}" class="px-4 py-1.5 rounded-full text-sm font-medium text-white bg-blue-500 hover:bg-blue-600 transition duration-300 shadow-sm">
                                        Edit Profile
                                    </a>
                                @endauth
                            @endif
                        </div>

                        <!-- Followers/Following with improved styling -->
                        <div class="flex justify-center space-x-8 mt-4 text-sm">
                            <a href="#" onclick="toggleModal('followersModal')" class="text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white transition-colors">
                                <span class="font-bold text-gray-900 dark:text-white">{{ $user->followers->count() ?? '0' }}</span> Followers
                            </a>
                            <a href="#" onclick="toggleModal('followingModal')" class="text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white transition-colors">
                                <span class="font-bold text-gray-900 dark:text-white">{{ $user->following->count() ?? '0' }}</span> Following
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal styling improved to match DevBlog -->
            <!-- Followers Modal -->
            <div id="followersModal" class="fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center hidden z-50">
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-xl max-w-lg w-full mx-4 p-5 transform transition-all animation-delay-300 animate-fade-in">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white">Followers</h3>
                        <button onclick="toggleModal('followersModal')" class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    <ul class="divide-y divide-gray-200 dark:divide-gray-700 max-h-96 overflow-y-auto">
                        @foreach ($user->followers as $follower)
                            <li class="py-3 flex justify-between items-center">
                                <div class="flex items-center space-x-3">
                                    <div class="flex-shrink-0 h-10 w-10 rounded-full overflow-hidden bg-gray-100 dark:bg-gray-700">
                                        <img src="
                                        @if ($follower->profile_image)
                                            {{ asset('storage/'.$follower->profile_image) }}
                                        @else
                                            https://i.ibb.co/sddfSJ9L/user.png
                                        @endif
                                        " alt="{{ $follower->name }}" class="h-full w-full object-cover">
                                    </div>
                                    <div class="text-sm font-medium text-gray-900 dark:text-white">
                                        <a href="/profile/{{$follower->id}}" class="hover:underline">{{ $follower->name }}</a>
                                    </div>
                                </div>
                                <form action="{{ route('users.follow', $follower->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="px-3 py-1 rounded-full text-xs font-medium text-white transition duration-300" 
                                            style="background-color: {{ Auth::check() && Auth::user()->isFollowing($follower) ? '#FF5757' : 'rgb(59, 130, 246)' }}">
                                        {{ Auth::check() && Auth::user()->isFollowing($follower) ? 'Unfollow' : 'Follow' }}
                                    </button>
                                </form>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <!-- Following Modal -->
            <div id="followingModal" class="fixed inset-0 bg-black bg-opacity-75 flex items-center justify-center hidden z-50">
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-xl max-w-lg w-full mx-4 p-5 transform transition-all animation-delay-300 animate-fade-in">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-white">Following</h3>
                        <button onclick="toggleModal('followingModal')" class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    <ul class="divide-y divide-gray-200 dark:divide-gray-700 max-h-96 overflow-y-auto">
                        @foreach ($user->following as $following)
                            <li class="py-3 flex justify-between items-center">
                                <div class="flex items-center space-x-3">
                                    <div class="flex-shrink-0 h-10 w-10 rounded-full overflow-hidden bg-gray-100 dark:bg-gray-700">
                                        <img src="
                                        @if ($following->profile_image)
                                            {{ asset('storage/'.$following->profile_image) }}
                                        @else
                                            https://i.ibb.co/sddfSJ9L/user.png
                                        @endif
                                        " alt="{{ $following->name }}" class="h-full w-full object-cover">
                                    </div>
                                    <div class="text-sm font-medium text-gray-900 dark:text-white">
                                        <a href="/profile/{{$following->id}}" class="hover:underline">{{ $following->name }}</a>
                                    </div>
                                </div>
                                <form action="{{ route('users.follow', $following->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="px-3 py-1 rounded-full text-xs font-medium text-white transition duration-300" 
                                            style="background-color: {{ Auth::check() && Auth::user()->isFollowing($following) ? '#FF5757' : 'rgb(59, 130, 246)' }}">
                                        {{ Auth::check() && Auth::user()->isFollowing($following) ? 'Unfollow' : 'Follow' }}
                                    </button>
                                </form>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <!-- Main Content Section - Posts -->
            <div class="relative animation-delay-700 animate-fade-in opacity-0">
                <div class="mb-6 flex items-center justify-between">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white flex items-center">
                        {{ $user->name }}'s Articles
                    </h3>
                </div>

                @if(isset($user->posts) && $user->posts->count() > 0)
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-2 gap-6 mb-12">
                        @foreach ($posts as $post)
                            <x-post-card :post="$post" />
                        @endforeach
                    </div>
                @else
                    <div class="py-12 text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 mx-auto text-gray-400 dark:text-gray-600 mb-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                        </svg>
                        <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">
                            No articles published yet
                        </h2>
                        <p class="text-gray-600 dark:text-gray-400 max-w-md mx-auto">
                            This user hasn't created any content. Check back later for updates.
                        </p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <script>
        function toggleModal(modalId) {
            const modal = document.getElementById(modalId);
            modal.classList.toggle('hidden');
        }
    </script>

    <!-- Added matching animations -->
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