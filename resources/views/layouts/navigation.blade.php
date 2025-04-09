<nav x-data="{ open: false }" class="bg-white dark:bg-gray-800 border-b border-gray-100 dark:border-gray-900">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <!-- Logo Section with Animation -->
            <div class="mb-8 opacity-0 animate-fade-in animation-delay-300 duration-700 mt-1">
                <a href="/" aria-label="Go to homepage" class="flex flex-col items-center">
                    <span class="sr-only">Home</span>
                    <!-- Main Logo with Enhanced Gradient from login page -->
                    <span aria-hidden="true" class=" text-xl sm:text-4xl font-black text-transparent bg-clip-text bg-gradient-to-r from-teal-400 via-purple-500 to-pink-600 tracking-tighter drop-shadow-lg transform transition-all hover:scale-105 duration-300">
                        {{env('APP_NAME')}}
                    </span>
                    <span class="text-sm text-gray-400 font-medium">
                        Share. Learn. Grow.
                    </span>
                </a>
            </div>

            <!-- Navigation Links -->
            <div class="hidden space-x-6 sm:-my-px sm:ml-10 sm:flex">
                <x-nav-link :href="route('home')" :active="request()->routeIs('home')" class="text-gray-600 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400">
                    Home
                </x-nav-link>

                <x-nav-link :href="route('posts.index')" :active="request()->routeIs('posts.index')" class="text-gray-600 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400">
                    Articles
                </x-nav-link>

                @auth
                    @if (Auth::user()->is_admin === true)
                        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-gray-600 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400">
                            Dashboard
                        </x-nav-link>
                    @endif
                @endauth

                @guest
                    @if(Route::has('register'))
                        <x-nav-link :href="route('login')" :active="request()->routeIs('login')" class="text-gray-600 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400">
                            Log in
                        </x-nav-link>

                        <x-nav-link :href="route('register')" :active="request()->routeIs('register')" class="text-gray-600 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400">
                            Register
                        </x-nav-link>
                    @endif
                @endguest

                <!-- Settings Dropdown -->
                @auth
                    <div class="hidden sm:flex sm:items-center">
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button class="flex items-center text-sm font-medium text-gray-600 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 focus:outline-none transition duration-150 ease-in-out">
                                    <div>{{ Auth::user()->name }}</div>

                                    <div class="ml-1">
                                        <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                        </svg>
                                    </div>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <!-- Authentication -->
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <x-dropdown-link :href="route('profile', ['user' => Auth::user()])">
                                        {{ __('Profile') }}
                                    </x-dropdown-link>

                                    <x-dropdown-link :href="route('bookmarks.index', ['user' => Auth::user()])">
                                        {{ __('Bookmarks') }}
                                    </x-dropdown-link>

                                    <x-dropdown-link :href="route('user.stats', ['user' => Auth::user()])">
                                        {{ __('Stats') }}
                                    </x-dropdown-link>

                                    <x-dropdown-link :href="route('logout')"
                                            onclick="event.preventDefault();
                                                        this.closest('form').submit();">
                                        {{ __('Log Out') }}
                                    </x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    </div>
                @endauth

                @auth
                    <div class="flex items-center">
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button class="flex items-center text-sm font-medium text-gray-600 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400 focus:outline-none transition duration-150 ease-in-out" title="Notifications" style="position: relative;">
                                    <i class="fa-solid fa-bell"></i>
                                    @php
                                        $unreadCount = Auth::user()->notifications->where('is_read', false)->count();
                                    @endphp
                                    @if ($unreadCount > 0)
                                        <span class="inline-flex items-center justify-center text-xs font-bold leading-none text-white bg-indigo-600 dark:bg-indigo-500 rounded-full absolute -top-1 -right-1 w-4 h-4">  
                                            {{ $unreadCount }}
                                        </span>
                                    @endif
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                @forelse (Auth::user()->notifications->sortByDesc('created_at')->take(5) as $notification)
                                    <div class="flex items-center justify-between px-4 py-2 text-sm {{ $notification->is_read ? 'bg-gray-100 dark:bg-gray-700' : 'bg-white dark:bg-gray-600' }} text-gray-700 dark:text-gray-300">
                                        <div class="flex items-center">
                                            @if ($notification->type === 'like')
                                                <i class="fa-solid fa-thumbs-up text-indigo-500 mr-2"></i>
                                            @elseif ($notification->type === 'comment')
                                                <i class="fa-solid fa-comment text-green-500 mr-2"></i>
                                            @elseif ($notification->type === 'follow')
                                                <i class="fa-solid fa-user-plus text-purple-500 mr-2"></i>
                                            @endif
                                            <span>{{ $notification->content }}</span>
                                        </div>
                                        <form method="POST" action="{{ route('notifications.markAsRead', $notification->id) }}">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="text-xs text-gray-500 hover:text-indigo-500 dark:hover:text-indigo-400">
                                                <i class="fa-solid fa-eye"></i>
                                            </button>
                                        </form>
                                    </div>
                                @empty
                                    <div class="px-4 py-2 text-sm text-gray-500 dark:text-gray-400">
                                        {{ __('No notifications') }}
                                    </div>
                                @endforelse
                            </x-slot>
                        </x-dropdown>
                    </div>
                @endauth

                @can('create', \App\Models\Post::class)
                <x-nav-link :href="route('posts.create')" :active="request()->routeIs('posts.create')" class="px-4 py-2">
                    <x-button class="bg-indigo-600 hover:bg-indigo-700 text-white dark:bg-indigo-500 dark:hover:bg-indigo-600">
                        {{ __('New Post') }}
                    </x-button>
                </x-nav-link>
                @endcan
            </div>
            
            <!-- Hamburger -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('home')" :active="request()->routeIs('home')" class="text-gray-600 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400">
                {{ __('Home') }}
            </x-responsive-nav-link>
            
            <x-responsive-nav-link :href="route('posts.index')" :active="request()->routeIs('posts.index')" class="text-gray-600 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400">
                {{ __('Articles') }}
            </x-responsive-nav-link>
            
            @auth
                @if (Auth::user()->is_admin === true)
                <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-gray-600 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400">
                    {{ __('Dashboard') }}
                </x-responsive-nav-link>
                @endif
            @else
                @if(Route::has('register'))
                <x-responsive-nav-link :href="route('login')" :active="request()->routeIs('login')" class="text-gray-600 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400">
                    {{ __('Log in') }}
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('register')" :active="request()->routeIs('register')" class="text-gray-600 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400">
                    {{ __('Register') }}
                </x-responsive-nav-link>
                @endif
            @endauth
        </div>

        <!-- Responsive Settings Options -->
        @auth
        <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-700">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800 dark:text-gray-200">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500 dark:text-gray-400">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile', ['user' => Auth::user()])" class="text-gray-600 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('bookmarks.index', ['user' => Auth::user()])" class="text-gray-600 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400">
                    {{ __('Bookmarks') }}
                </x-responsive-nav-link>

                <x-responsive-nav-link :href="route('user.stats', ['user' => Auth::user()])" class="text-gray-600 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400">
                    {{ __('Stats') }}
                </x-responsive-nav-link>
                
                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();"
                            class="text-gray-600 dark:text-gray-300 hover:text-indigo-600 dark:hover:text-indigo-400">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
        @endauth

        @can('create', \App\Models\Post::class)
        <div class="py-3 border-t border-gray-200 dark:border-gray-700">
            <x-responsive-nav-link :href="route('posts.create')" :active="request()->routeIs('posts.create')">
                <x-button class="w-full bg-indigo-600 hover:bg-indigo-700 text-white dark:bg-indigo-500 dark:hover:bg-indigo-600">
                    {{ __('New Post') }}
                </x-button>
            </x-responsive-nav-link>
        </div>
        @endcan
    </div>
</nav>