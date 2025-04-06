<x-app-layout>
    <div class="relative" style="max-width: 1200px; margin: auto;">
        <!-- Cover Image Section -->
            <div class="bg-black flex items-center justify-center" style="height: 200px; border-radius: 0 0 20px 20px; overflow: hidden;">
                @if ($cover_image)
                    <img src="{{ asset('storage/'.$user->cover_image) }}" alt="user cover image" class="w-full h-full object-cover">
                @else
                    <img src='https://t3.ftcdn.net/jpg/04/67/96/14/360_F_467961418_UnS1ZAwAqbvVVMKExxqUNi0MUFTEJI83.jpg' alt="user cover image" class="w-full h-full object-cover">
                @endif
            </div>

            <!-- Profile Picture and User Info Section -->
            <div class="flex flex-col items-center pb-6 px-4 text-center dark:text-white" style="position: relative; top: -125px; border-radius: 20px; padding: 20px; width: 100%; max-width: 400px; margin: auto;">
                <div class="w-32 h-32 border-white flex items-center justify-center mb-4" style="width: 200px; height: 200px; border-radius: 50%; border: 4px solid white; overflow: hidden;">
                    @if($profile_image)
                        <img src="{{ asset('storage/'.$user->profile_image) }}" alt="user profile picture" style="width: 100%; height: 100%; object-fit: cover;">
                    @else
                        <img src='https://i.ibb.co/sddfSJ9L/user.png' alt="user profile picture" style="width: 100%; height: 100%; object-fit: cover;">
                    @endif
                </div>

                <h2 class="text-xl font-semibold flex items-center justify-center">
                    {{ $user->name ?? 'User Full Name' }}
                    @if ($user->stripe_subscription_id)
                        <span class="ml-2 text-yellow-500" title="Premium User">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#FFD700" height="20px" width="20px" version="1.1" id="Capa_1" viewBox="0 0 220 220" xml:space="preserve">
                                <path d="M220,98.865c0-12.728-10.355-23.083-23.083-23.083s-23.083,10.355-23.083,23.083c0,5.79,2.148,11.084,5.681,15.14  l-23.862,21.89L125.22,73.002l17.787-20.892l-32.882-38.623L77.244,52.111l16.995,19.962l-30.216,63.464l-23.527-21.544  c3.528-4.055,5.671-9.344,5.671-15.128c0-12.728-10.355-23.083-23.083-23.083C10.355,75.782,0,86.137,0,98.865  c0,11.794,8.895,21.545,20.328,22.913l7.073,84.735H192.6l7.073-84.735C211.105,120.41,220,110.659,220,98.865z"/>
                            </svg>
                        </span>
                    @endif
                </h2>

                <p class="text-sm">{{ $bio }}</p>

                @if (Auth::check() && Auth::user()->id != $user_id)
                <form action="{{ route('users.follow', $user->id) }}" method="POST" class="mt-1">
                    @csrf
                    <button type="submit" class="px-3 py-1 rounded-full transition duration-300" style="background-color: {{ $isFollowing ? '#FF1919' : '#1DA1F2' }}; color: white; border-radius: 5px;">
                        @if ($isFollowing)
                            Unfollow
                        @else
                            Follow
                        @endif
                    </button>
                </form>
                @else
                    @auth
                        <div class="mt-2">
                            <a href="{{ route('user.edit', ['user' => $user]) }}" class="px-3 py-1 rounded-full transition duration-300" style="background-color: #1DA1F2; color: white; border-radius: 5px;">
                                Edit Profile
                            </a>
                        </div>   
                    @endauth
                @endif

                <div class="flex justify-center space-x-8 mt-2 text-sm text-gray-300">
                    <!-- Followers Link -->
                    <a href="#" onclick="toggleModal('followersModal')">{{ $user->followers->count() ?? '0' }} Followers</a>
                    <!-- Following Link -->
                    <a href="#" onclick="toggleModal('followingModal')">{{ $user->following->count() ?? '0' }} Following</a>
                </div>

                <!-- Followers Modal -->
                <div id="followersModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden" style="opacity:0.97">
                    <div class="bg-white rounded-lg shadow-lg w-100 p-4" style="min-width: 600px;">
                        <h3 class="text-lg font-semibold mb-4 dark:text-black">Followers</h3>
                        <ul>
                            @foreach ($user->followers as $follower)
                                <li class="flex justify-between items-center mb-2">
                                    <div class="flex items-center space-x-2">
                                        <img src="
                                        @if ($follower->profile_image)
                                            {{ asset('storage/'.$follower->profile_image) }}
                                        @else
                                            https://i.ibb.co/sddfSJ9L/user.png
                                        @endif
                                        " alt="user profile picture" style="width: 50px; height: 50px; object-fit: cover; border-radius:50%;">
                                        <span class="dark:text-black"><a href="/profile/{{$follower->id}}">{{ $follower->name }}</a></span>
                                    </div>
                                    <form action="{{ route('users.follow', $follower->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="text-sm px-2 py-1 rounded-full transition duration-300" style="background-color: {{ Auth::check() && Auth::user()->isFollowing($follower) ? '#FF1919' : '#1DA1F2' }}; color: white; border-radius: 5px;">
                                            {{ Auth::check() && Auth::user()->isFollowing($follower) ? 'Unfollow' : 'Follow' }}
                                        </button>
                                    </form>
                                </li>
                            @endforeach
                        </ul>
                        <button onclick="toggleModal('followersModal')" class="mt-4 px-4 py-2 bg-gray-300 rounded">Close</button>
                    </div>
                </div>

                <!-- Following Modal -->
                <div id="followingModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden" style="opacity:0.97;">
                    <div class="bg-white rounded-lg shadow-lg w-100 p-5" style="min-width: 600px;">
                        <h3 class="text-lg font-semibold mb-4 dark:text-black">Following</h3>
                        <ul>
                            @foreach ($user->following as $following)
                                <li class="flex justify-between items-center mb-2">
                                    <div class="flex items-center ">
                                        <img src="
                                        @if ($following->profile_image)
                                            {{ asset('storage/'.$following->profile_image) }}
                                        @else
                                            https://i.ibb.co/sddfSJ9L/user.png
                                        @endif
                                        " alt="user profile picture" style="width: 50px; height: 50px; object-fit: cover; border-radius:50%;" class="mr-2">
                                        <span class="dark:text-black"><a href="/profile/{{$following->id}}">{{ $following->name }}</a></span>
                                    </div>
                                    <form action="{{ route('users.follow', $following->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="text-sm px-2 py-1 rounded-full transition duration-300" style="background-color: {{Auth::check() && Auth::user()->isFollowing($following) ? '#FF1919' : '#1DA1F2' }}; color: white; border-radius: 5px;">
                                            {{ Auth::check() && Auth::user()->isFollowing($following) ? 'Unfollow' : 'Follow' }}
                                        </button>
                                    </form>
                                </li>
                            @endforeach
                        </ul>
                        <button onclick="toggleModal('followingModal')" class="mt-4 px-4 py-2 bg-gray-300 rounded">Close</button>
                    </div>
                </div>

                <script>
                    function toggleModal(modalId) {
                        const modal = document.getElementById(modalId);
                        modal.classList.toggle('hidden');
                    }
                </script>
            </div>

        <!-- Main Content Section -->
        <div class="flex flex-col md:flex-row">
            <!-- Left Side - Posts -->
            <div class="w-full p-4">
                <h3 class="text-xl font-semibold mb-4 text-gray-800 dark:text-white">{{ $user->name }} Posts</h3>

                @if(isset($user->posts) && $user->posts->count() > 0)
                    <div class="flex flex-row flex-wrap justify-start">
                        @foreach ($posts as $post)
                            <x-post-card :post="$post" />
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
