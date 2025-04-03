<x-app-layout>
    <div class="relative items-top justify-center sm:items-center py-4 sm:pt-0">
        <section class="max-w-7xl mx-auto px-0 sm:px-6 lg:px-8">
            <header class="text-center py-5 mt-5 mb-3">
            <h2 class="text-2xl font-medium dark:text-white">User Statistics</h2>
            </header>
            <div class="flex flex-wrap justify-between">
                <div class="bg-white shadow-md rounded-lg p-6 sm:w-1/4" style="width: 240px;">
                    <h3 class="text-lg font-semibold mb-4">Total Posts</h3>
                    <p class="text-gray-700 text-xl font-bold">{{ $postsCount }}</p>
                </div>

                <div class="bg-white shadow-md rounded-lg p-6 sm:w-1/4" style="width: 240px;">
                    <h3 class="text-lg font-semibold mb-4">Followers</h3>
                    <p class="text-gray-700 text-xl font-bold">{{ $followersCount }}</p>
                </div>

                <div class="bg-white shadow-md rounded-lg p-6 sm:w-1/4" style="width: 240px;">
                    <h3 class="text-lg font-semibold mb-4">Following</h3>
                    <p class="text-gray-700 text-xl font-bold">{{ $followingCount }}</p>
                </div>

                <div class="bg-white shadow-md rounded-lg p-6 sm:w-1/4" style="width: 240px;">
                    <h3 class="text-lg font-semibold mb-4">Total Posts Views</h3>
                    <p class="text-gray-700 text-xl font-bold">{{ $viewsCount }}</p>
                </div>
            </div>
        </section>
        <section class="max-w-7xl mx-auto px-0 sm:px-6 lg:px-8 mt-8">
            <canvas id="postsChart" width="400" height="200"></canvas>
        </section>

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            const ctx = document.getElementById('postsChart').getContext('2d');
            const postsChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: @json($days), // Array of days (e.g., ['Monday', 'Tuesday', ...])
                    datasets: [{
                        label: 'Total Posts',
                        data: @json($postsPerDay), // Array of post counts for each day
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 2,
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            display: true,
                            position: 'top'
                        }
                    },
                    scales: {
                        x: {
                            title: {
                                display: true,
                                text: 'Days of the Week'
                            }
                        },
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Number of Posts'
                            }
                        }
                    }
                }
            });
        </script>
    </div>
</x-app-layout>