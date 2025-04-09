<x-guest-layout>
    <div class="relative min-h-screen bg-gradient-to-br from-gray-900 via-gray-800 to-gray-700 overflow-hidden">
        <!-- Enhanced Background Elements -->
        <div class="absolute inset-0 bg-grid-pattern opacity-10" aria-hidden="true"></div>
        <div class="absolute inset-0 bg-noise-texture mix-blend-overlay opacity-30" aria-hidden="true"></div>
        
        <!-- Animated Background Glow Effects -->
        <div class="absolute -top-20 -left-20 w-96 h-96 bg-gradient-to-r from-teal-400/20 to-blue-500/20 rounded-full filter blur-3xl opacity-50 animate-pulse-slow" aria-hidden="true"></div>
        <div class="absolute -bottom-32 -right-20 w-80 h-80 bg-gradient-to-r from-purple-500/20 to-pink-600/20 rounded-full filter blur-3xl opacity-50 animate-pulse-slow animation-delay-2000" aria-hidden="true"></div>
        
        <!-- Floating Particles -->
        <div class="absolute inset-0 pointer-events-none overflow-hidden" aria-hidden="true">
            @foreach(range(1, 6) as $i)
                <div 
                    class="absolute particle-element w-{{ rand(4, 10) }} h-{{ rand(4, 10) }} 
                           bg-gradient-to-r {{ ['from-teal-400/30 to-blue-500/30', 'from-purple-500/30 to-pink-600/30'][rand(0, 1)] }} 
                           rounded-full filter blur-{{ rand(1, 2) }}xl opacity-{{ rand(5, 8) }}0 
                           animate-float-random"
                    style="top: {{ rand(0, 100) }}%; left: {{ rand(0, 100) }}%; animation-delay: {{ $i * 0.75 }}s; animation-duration: {{ rand(15, 25) }}s;"
                ></div>
            @endforeach
        </div>

        <div class="relative z-10 flex flex-col items-center justify-center min-h-screen p-6">
            <!-- Logo Section with Animation -->
            <div class="mb-8 opacity-0 animate-fade-in animation-delay-300 duration-700">
                <a href="/" aria-label="Go to homepage" class="flex flex-col items-center">
                    <span class="sr-only">Home</span>
                    <!-- Main Logo with Enhanced Gradient -->
                    <span aria-hidden="true" class="text-4xl sm:text-5xl font-black text-transparent bg-clip-text bg-gradient-to-r from-teal-400 via-purple-500 to-pink-600 tracking-tighter mb-2 drop-shadow-lg transform transition-all hover:scale-105 duration-300">
                        DevBlog
                    </span>
                    <span class="text-sm text-gray-400 font-medium">
                        Share. Learn. Grow.
                    </span>
                </a>
            </div>

            <!-- Auth Card with Modern Styling -->
            <div class="w-full max-w-md opacity-0 animate-fade-in animation-delay-500 duration-700">
                <div class="bg-gray-800/90 backdrop-blur-sm rounded-2xl shadow-xl overflow-hidden border border-gray-700/50 transform transition-all hover:scale-[1.01] duration-300">
                    <!-- Card Header with Decorative Element -->
                    <div class="relative h-3 bg-gradient-to-r from-teal-400 via-purple-500 to-pink-600"></div>
                    
                    <div class="p-8">
                        <!-- Validation Errors -->
                        <x-auth-validation-errors class="mb-6 bg-red-900/20 text-red-400 p-4 rounded-lg text-sm" :errors="$errors" />

                        <h2 class="text-2xl font-bold text-white mb-6 flex items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-purple-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                            </svg>
                            Create an Account
                        </h2>

                        <form method="POST" action="{{ route('register') }}">
                            @csrf

                            <!-- Name -->
                            <div class="mb-5">
                                <x-label for="name" :value="__('Name')" class="text-gray-300 font-medium mb-1" />
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                    </div>
                                    <x-input 
                                        id="name" 
                                        class="pl-10 w-full rounded-lg border-gray-600 focus:border-purple-500 focus:ring focus:ring-purple-500/20 bg-gray-700 text-white transition-colors" 
                                        type="text" 
                                        name="name" 
                                        :value="old('name')" 
                                        required 
                                        autofocus 
                                        placeholder="Your full name"
                                    />
                                </div>
                            </div>

                            <!-- Email Address -->
                            <div class="mb-5">
                                <x-label for="email" :value="__('Email')" class="text-gray-300 font-medium mb-1" />
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                                        </svg>
                                    </div>
                                    <x-input 
                                        id="email" 
                                        class="pl-10 w-full rounded-lg border-gray-600 focus:border-purple-500 focus:ring focus:ring-purple-500/20 bg-gray-700 text-white transition-colors" 
                                        type="email" 
                                        name="email" 
                                        :value="old('email')" 
                                        required 
                                        placeholder="your@email.com"
                                    />
                                </div>
                            </div>

                            <!-- Password -->
                            <div class="mb-5">
                                <x-label for="password" :value="__('Password')" class="text-gray-300 font-medium mb-1" />
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                        </svg>
                                    </div>
                                    <x-input 
                                        id="password" 
                                        class="pl-10 w-full rounded-lg border-gray-600 focus:border-purple-500 focus:ring focus:ring-purple-500/20 bg-gray-700 text-white transition-colors"
                                        type="password"
                                        name="password"
                                        required 
                                        autocomplete="new-password"
                                        placeholder="••••••••"
                                    />
                                </div>
                                <p class="mt-1 text-xs text-gray-400">Must be at least 8 characters</p>
                            </div>

                            <!-- Confirm Password -->
                            <div class="mb-6">
                                <x-label for="password_confirmation" :value="__('Confirm Password')" class="text-gray-300 font-medium mb-1" />
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                        </svg>
                                    </div>
                                    <x-input 
                                        id="password_confirmation" 
                                        class="pl-10 w-full rounded-lg border-gray-600 focus:border-purple-500 focus:ring focus:ring-purple-500/20 bg-gray-700 text-white transition-colors"
                                        type="password"
                                        name="password_confirmation" 
                                        required
                                        placeholder="••••••••"
                                    />
                                </div>
                            </div>

                            <div class="flex items-center justify-between mb-6">
                                <a class="text-sm font-medium text-purple-400 hover:text-purple-300 transition-colors" href="{{ route('login') }}">
                                    {{ __('Already registered?') }}
                                </a>

                                <button type="submit" class="bg-gradient-to-r from-teal-500 to-purple-600 hover:from-teal-600 hover:to-purple-700 text-white font-medium py-2.5 px-6 rounded-lg shadow-md hover:shadow-lg transition-all focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </form>

                        <div class="flex items-center my-6">
                            <hr class="flex-1 border-gray-700">
                            <span class="px-4 text-sm text-gray-400">Or</span>
                            <hr class="flex-1 border-gray-700">
                        </div>

                        <a href="{{ route('google.login') }}"
                           class="flex items-center justify-center w-full px-5 py-3 bg-gray-700 border border-gray-600 text-white font-medium rounded-lg shadow-sm hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500 transition-colors">
                            <svg class="w-5 h-5 mr-2" viewBox="0 0 48 48">
                                <path fill="#EA4335" d="M24 9.5c3.3 0 6.2 1.2 8.5 3.2l6.3-6.3C34.7 2.4 29.7 0 24 0 14.8 0 6.8 5.5 2.8 13.5l7.6 5.9c1.7-5 6.5-8.4 12-8.4z"/>
                                <path fill="#4285F4" d="M46.1 24.6c0-1.5-.1-3-.4-4.4H24v8.5h12.8c-.6 3-2.2 5.5-4.6 7.2l7.6 5.9c4.5-4.1 7.3-10.1 7.3-17.2z"/>
                                <path fill="#FBBC05" d="M10.4 28.4c-.8-2.4-1.3-5-.1-7.3l-7.6-5.9c-2.9 5.8-2.9 12.8 0 18.7l7.6-5.5z"/>
                                <path fill="#34A853" d="M24 48c6.5 0 11.8-2.2 15.8-5.9l-7.6-5.9c-2.2 1.5-5 2.4-8.2 2.4-5.5 0-10.3-3.4-12-8.4l-7.6 5.9c4 8 12 13.5 21.2 13.5z"/>
                            </svg>
                            Continue with Google
                        </a>
                    </div>
                </div>
            </div>
            
            <!-- Footer -->
            <p class="mt-8 text-sm text-center text-gray-400 opacity-0 animate-fade-in animation-delay-700 duration-700">
                © {{ date('Y') }} DevBlog. All rights reserved.
            </p>
        </div>
    </div>
    
    <!-- Animation Styles -->
    <style>
        @keyframes soft-glow {
            0%, 100% { opacity: 0.5; }
            50% { opacity: 0.8; }
        }
        
        @keyframes float-random {
            0% { transform: translate(0, 0) rotate(0deg); }
            33% { transform: translate(30px, -30px) rotate(5deg); }
            66% { transform: translate(-20px, 20px) rotate(-5deg); }
            100% { transform: translate(0, 0) rotate(0deg); }
        }
        
        @keyframes pulse-slow {
            0%, 100% { opacity: 0.6; transform: scale(1); }
            50% { opacity: 0.8; transform: scale(1.05); }
        }
        
        @keyframes fade-in {
            0% { opacity: 0; transform: translateY(20px); }
            100% { opacity: 1; transform: translateY(0); }
        }
        
        .animation-delay-300 { animation-delay: 300ms; }
        .animation-delay-500 { animation-delay: 500ms; }
        .animation-delay-700 { animation-delay: 700ms; }
        .animation-delay-2000 { animation-delay: 2000ms; }
        
        .animate-soft-glow { animation: soft-glow 8s infinite ease-in-out; }
        .animate-pulse-slow { animation: pulse-slow 8s infinite ease-in-out; }
        .animate-float-random { animation: float-random 20s infinite ease-in-out; }
        .animate-fade-in { animation: fade-in 1s forwards ease-out; }
        
        .bg-grid-pattern {
            background-image: linear-gradient(to right, rgba(255,255,255,.1) 1px, transparent 1px),
                             linear-gradient(to bottom, rgba(255,255,255,.1) 1px, transparent 1px);
            background-size: 20px 20px;
        }
        
        .bg-noise-texture {
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noiseFilter'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.65' numOctaves='3' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noiseFilter)'/%3E%3C/svg%3E");
        }
    </style>
</x-guest-layout>