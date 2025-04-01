<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-between mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-button class="ml-3">
                    {{ __('Log in') }}
                </x-button>
            </div>
        </form>

        <hr class="my-4">

        <div class="flex items-center justify-center my-4">
            <span class="text-gray-500 text-sm">Or</span>
        </div>

        <a href="{{ route('google.login') }}"
           class="flex items-center justify-center w-full px-4 py-2 bg-white border border-gray-300 text-gray-700 font-semibold rounded-lg shadow-sm hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500">
            <svg class="w-5 h-5 mr-2" viewBox="0 0 48 48">
                <path fill="#EA4335" d="M24 9.5c3.3 0 6.2 1.2 8.5 3.2l6.3-6.3C34.7 2.4 29.7 0 24 0 14.8 0 6.8 5.5 2.8 13.5l7.6 5.9c1.7-5 6.5-8.4 12-8.4z"/>
                <path fill="#4285F4" d="M46.1 24.6c0-1.5-.1-3-.4-4.4H24v8.5h12.8c-.6 3-2.2 5.5-4.6 7.2l7.6 5.9c4.5-4.1 7.3-10.1 7.3-17.2z"/>
                <path fill="#FBBC05" d="M10.4 28.4c-.8-2.4-1.3-5-.1-7.3l-7.6-5.9c-2.9 5.8-2.9 12.8 0 18.7l7.6-5.5z"/>
                <path fill="#34A853" d="M24 48c6.5 0 11.8-2.2 15.8-5.9l-7.6-5.9c-2.2 1.5-5 2.4-8.2 2.4-5.5 0-10.3-3.4-12-8.4l-7.6 5.9c4 8 12 13.5 21.2 13.5z"/>
            </svg>
            Login with Google
        </a>
    </x-auth-card>
</x-guest-layout>
