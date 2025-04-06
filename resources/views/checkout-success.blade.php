<x-app-layout>
    <x-slot name="header">
        <header class="relative text-center py-6 bg-gradient-to-br from-gray-100 to-gray-300 dark:from-gray-900 dark:to-gray-700 rounded-lg shadow-xl">
            <h2 class="text-4xl font-extrabold text-gray-800 dark:text-gray-100">
                Payment Confirmed
            </h2>
            <p class="mt-4 text-lg text-gray-600 dark:text-gray-300">
                Welcome to a world of premium features and exclusive content!
            </p>
        </header>
    </x-slot>

    <div class="max-w-7xl mx-auto px-6 sm:px-8 py-12">
        <section class="relative bg-gradient-to-br from-white to-gray-100 dark:from-gray-800 dark:to-gray-700 rounded-lg shadow-xl p-10 text-center">
            <h2 class="text-4xl font-extrabold text-green-700 dark:text-green-300 mb-6">Payment Successful!</h2>
            <p class="text-xl text-gray-700 dark:text-gray-300 mb-4">
                Thank you for your subscription. Your Premium access is now live, unlocking exclusive features inspired by global excellence.
            </p>

            <div class="mt-8">
                <a href="{{ route('home') }}" class="inline-block bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-600 hover:to-purple-700 text-white font-bold px-12 py-4 rounded-lg shadow-lg transition-transform transform hover:scale-110">
                    Explore Your Dashboard
                </a>
            </div>

            <div class="mt-6">
                <p class="text-md text-gray-600 dark:text-gray-400">
                    Begin your journey and enjoy the finest curated content with your Premium membership.
                </p>
            </div>
        </section>
    </div>
</x-app-layout>
