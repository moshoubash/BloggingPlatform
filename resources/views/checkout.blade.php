<div class="relative flex items-top justify-center sm:items-center py-12 sm:pt-0 bg-gradient-to-br from-indigo-50 to-gray-100 dark:from-gray-800 dark:to-gray-900 rounded-lg shadow-xl">
    <section class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <!-- Checkout Confirmation Header -->
        <header class="text-center py-5 mt-5 mb-10">
            <h1 class="text-3xl font-extrabold text-gray-800 dark:text-gray-100">Review & Confirm Your Subscription</h1>
            <p class="mt-4 text-md text-gray-600 dark:text-gray-300">You're almost there! Double-check your plan and complete your payment below.</p>
        </header>

        <!-- Selected Plan Confirmation -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 mb-6 text-center">
            <h2 class="text-xl font-bold text-blue-600 mb-4">Premium Plan Selected</h2>
            <p class="text-md text-gray-600 dark:text-gray-300">Gain access to all premium features including exclusive blogs and priority support.</p>
            <div class="mt-4">
                <span class="text-3xl font-extrabold text-gray-800 dark:text-white">$9.99</span>
                <span class="text-sm font-medium text-gray-500 dark:text-gray-400">/ month</span>
            </div>
        </div>

        <!-- Pricing Table (Checkout-Specific Style) -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-10">
            <!-- Free Plan (De-emphasized) -->
            <div class="border border-gray-300 rounded-lg p-8 bg-gray-100 dark:bg-gray-700 shadow-sm opacity-75">
                <h3 class="text-2xl font-bold text-gray-600 dark:text-gray-400 mb-4">Free Plan</h3>
                <p class="text-gray-500 dark:text-gray-400">Access most blogs and basic features.</p>
                <div class="mt-8">
                    <h3 class="text-3xl font-extrabold text-gray-600 dark:text-gray-400">Free</h3>
                </div>
                <button disabled type="button" class="w-full mt-8 px-6 py-3 text-sm font-medium text-white bg-gray-400 rounded-lg cursor-not-allowed">
                    Current Plan
                </button>
            </div>

            <!-- Premium Plan (Highlighted) -->
            <div class="border border-blue-500 rounded-lg p-8 bg-gradient-to-r from-indigo-100 to-purple-100 dark:from-indigo-800 dark:to-purple-800 shadow-lg transform scale-105">
                <h3 class="text-2xl font-bold text-blue-600 mb-4">Premium Plan</h3>
                <p class="text-gray-700 dark:text-gray-300">Exclusive access to all premium content and features.</p>
                <div class="mt-8">
                    <h3 class="text-3xl font-extrabold text-blue-600">$9.99 
                        <span class="text-lg font-medium text-gray-500 dark:text-gray-300">/ month</span>
                    </h3>
                </div>
                <form action="{{ route('checkout.process') }}" method="POST" class="mt-8">
                    @csrf
                    <button class="w-full px-6 py-3 text-sm font-medium text-white bg-blue-500 rounded-lg hover:bg-blue-600 transition">
                        Proceed to Payment
                    </button>
                </form>
            </div>
        </div>

        <!-- Progress Indicator -->
        <div class="mt-10 text-center">
            <div class="flex items-center justify-center space-x-4">
                <div class="w-8 h-8 bg-blue-500 text-white rounded-full flex items-center justify-center font-bold">1</div>
                <div class="w-8 h-8 bg-gray-300 dark:bg-gray-600 text-white rounded-full flex items-center justify-center font-bold">2</div>
                <div class="w-8 h-8 bg-gray-300 dark:bg-gray-600 text-white rounded-full flex items-center justify-center font-bold">3</div>
            </div>
            <p class="mt-4 text-gray-600 dark:text-gray-400">Step 2 of 3: Complete Your Checkout</p>
        </div>
    </section>
</div>
