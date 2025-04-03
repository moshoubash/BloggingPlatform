<x-app-layout>
    <x-slot name="header">
        <header class="relative text-center py-6 bg-gradient-to-br from-gray-100 to-gray-300 dark:from-gray-900 dark:to-gray-700 rounded-lg shadow-xl">
            <h2 class="text-4xl font-extrabold text-gray-800 dark:text-gray-100">
                Subscription Cancelled
            </h2>
            <p class="mt-4 text-lg text-gray-600 dark:text-gray-300">
                We're sorry to see you go. You can always return for more premium features and exclusive content!
            </p>
        </header>
    </x-slot>

    <div class="max-w-7xl mx-auto px-6 sm:px-8 py-12">
        <section class="relative bg-gradient-to-br from-white to-gray-100 dark:from-gray-800 dark:to-gray-700 rounded-lg shadow-xl p-10 text-center">
            <h2 class="text-4xl font-extrabold text-red-700 dark:text-red-300 mb-6">Subscription Cancelled</h2>
            <p class="text-xl text-gray-700 dark:text-gray-300 mb-4">
                Your subscription has been cancelled. If you change your mind, you can reactivate your account anytime.
            </p>

            <div class="mt-8">
                <a href="{{ route('home') }}" class="inline-block bg-gradient-to-r from-gray-500 to-gray-600 hover:from-gray-600 hover:to-gray-700 text-white font-bold px-12 py-4 rounded-lg shadow-lg transition-transform transform hover:scale-110">
                    Return to Dashboard
                </a>
            </div>

            <div class="mt-6">
                <p class="text-md text-gray-600 dark:text-gray-400">
                    Thank you for being a part of our platform. We hope to serve you again in the future.
                </p>
            </div>
        </section>
    </div>
</x-app-layout>
