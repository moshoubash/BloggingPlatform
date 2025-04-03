<div
    class="relative flex items-top justify-center sm:items-center py-12 sm:pt-0 bg-gradient-to-br from-gray-100 to-gray-300 dark:from-gray-900 dark:to-gray-700 rounded-lg shadow-xl">
    <section class="max-w-7xl mx-auto sm:px-6 lg:px-8"> <!-- Header -->
        <header class="text-center py-5 mt-5 mb-8">
            <h1 class="text-4xl font-extrabold text-gray-800 dark:text-gray-100">Explore Your Options</h1>
            <p class="mt-4 text-lg text-gray-600 dark:text-gray-300">Choose the plan that fits your needs and unlock
                exclusive features.</p>
        </header> <!-- Pricing Plans -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-10"> <!-- Free Plan -->
            <div class="border border-gray-300 rounded-lg p-8 bg-white dark:bg-gray-800 shadow-md">
                <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-4">Free Plan</h3>
                <p class="text-gray-600 dark:text-gray-400">Perfect for casual readers exploring the basics.</p>
                <div class="mt-8">
                    <h3 class="text-3xl font-extrabold text-gray-900 dark:text-white">Free</h3>
                </div>
                <ul class="mt-8 space-y-4">
                    <li class="flex items-center text-gray-500 dark:text-gray-400"> <svg
                            xmlns="http://www.w3.org/2000/svg" width="20" class="mr-3 fill-green-500"
                            viewBox="0 0 24 24">
                            <path
                                d="M9.707 19.121a.997.997 0 0 1-1.414 0l-5.646-5.647a1.5 1.5 0 0 1 0-2.121l.707-.707a1.5 1.5 0 0 1 2.121 0L9 14.171l9.525-9.525a1.5 1.5 0 0 1 2.121 0l.707.707a1.5 1.5 0 0 1 0 2.121z" />
                        </svg> Access to most blogs </li>
                    <li class="flex items-center text-gray-500 dark:text-gray-400"> <svg
                            xmlns="http://www.w3.org/2000/svg" width="20" class="mr-3 fill-green-500"
                            viewBox="0 0 24 24">
                            <path
                                d="M9.707 19.121a.997.997 0 0 1-1.414 0l-5.646-5.647a1.5 1.5 0 0 1 0-2.121l.707-.707a1.5 1.5 0 0 1 2.121 0L9 14.171l9.525-9.525a1.5 1.5 0 0 1 2.121 0l.707.707a1.5 1.5 0 0 1 0 2.121z" />
                        </svg> Commenting enabled </li>
                </ul> <!-- Current Plan Button --> <button type="button"
                    class="mt-8 px-6 py-3 text-sm font-medium text-white bg-gray-600 rounded-lg hover:bg-gray-700 transition">
                    Current Plan </button>
            </div> <!-- Premium Plan -->
            <div
                class="border border-blue-500 rounded-lg p-8 bg-gradient-to-r from-indigo-100 via-white to-purple-100 dark:from-indigo-800 dark:to-purple-800 shadow-md">
                <h3 class="text-2xl font-bold text-blue-600 mb-4">Premium Plan</h3>
                <p class="text-gray-700 dark:text-gray-300">For Power Users and Teams who want premium content.</p>
                <div class="mt-8">
                    <h3 class="text-3xl font-extrabold text-blue-600">$9.99 <span
                            class="text-lg font-medium text-gray-500 dark:text-gray-300">/ month</span> </h3>
                </div>
                <ul class="mt-8 space-y-4">
                    <li class="flex items-center text-gray-500 dark:text-gray-300"> <svg
                            xmlns="http://www.w3.org/2000/svg" width="20" class="mr-3 fill-green-500"
                            viewBox="0 0 24 24">
                            <path
                                d="M9.707 19.121a.997.997 0 0 1-1.414 0l-5.646-5.647a1.5 1.5 0 0 1 0-2.121l.707-.707a1.5 1.5 0 0 1 2.121 0L9 14.171l9.525-9.525a1.5 1.5 0 0 1 2.121 0l.707.707a1.5 1.5 0 0 1 0 2.121z" />
                        </svg> Access to premium blogs </li>
                    <li class="flex items-center text-gray-500 dark:text-gray-300"> <svg
                            xmlns="http://www.w3.org/2000/svg" width="20" class="mr-3 fill-green-500"
                            viewBox="0 0 24 24">
                            <path
                                d="M9.707 19.121a.997.997 0 0 1-1.414 0l-5.646-5.647a1.5 1.5 0 0 1 0-2.121l.707-.707a1.5 1.5 0 0 1 2.121 0L9 14.171l9.525-9.525a1.5 1.5 0 0 1 2.121 0l.707.707a1.5 1.5 0 0 1 0 2.121z" />
                        </svg> All free features </li>
                </ul> <!-- Subscribe Now Button -->
                <form action="{{ route('checkout.process') }}" method="POST" class="mt-8"> @csrf <button
                        class="px-6 py-3 text-sm font-medium text-white bg-gradient-to-r from-indigo-700 to-purple-700 rounded-lg hover:bg-purple-800 transition">
                        Subscribe Now </button> </form>
            </div>
        </div>
    </section>
</div>
