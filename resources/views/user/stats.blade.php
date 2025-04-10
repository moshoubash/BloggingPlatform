<x-app-layout>
    <div class="relative min-h-screen bg-white dark:bg-gray-900 overflow-hidden">
        <!-- Subtle background pattern -->
        <div class="absolute inset-0 bg-grid-pattern opacity-5 dark:opacity-10" aria-hidden="true"></div>
        <div class="absolute inset-0 bg-gradient-to-br from-blue-50/30 to-purple-50/30 dark:from-blue-900/10 dark:to-purple-900/10" aria-hidden="true"></div>
        
        <div class="relative z-10 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <!-- Header Section -->
            <section class="relative opacity-0 animate-fade-in animation-delay-300 duration-700 mb-8">
                <div class="text-center mb-8">
                    <h2 class="text-3xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-gray-900 to-gray-700 dark:from-white dark:to-gray-300 tracking-tight">
                        User Statistics
                    </h2>
                    <div class="hidden sm:block absolute left-1/2 transform -translate-x-1/2 w-16 h-1 bg-gradient-to-r from-blue-400 to-purple-500 rounded-full mt-3"></div>
                </div>
            </section>
            
            <!-- Stats Cards Section -->
            <section class="relative opacity-0 animate-fade-in animation-delay-500 duration-700 mb-12">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    <!-- Total Posts Card -->
                    <div class="bg-white dark:bg-gray-800 shadow-md rounded-xl p-6 transform transition-transform hover:scale-105 duration-300">
                        <div class="flex items-center justify-between mb-3">
                            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Total Posts</h3>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                            </svg>
                        </div>
                        <p class="text-3xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-blue-500 to-blue-700">{{ $postsCount }}</p>
                    </div>

                    <!-- Followers Card -->
                    <div class="bg-white dark:bg-gray-800 shadow-md rounded-xl p-6 transform transition-transform hover:scale-105 duration-300">
                        <div class="flex items-center justify-between mb-3">
                            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Followers</h3>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-purple-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                        </div>
                        <p class="text-3xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-purple-500 to-purple-700">{{ $followersCount }}</p>
                    </div>

                    <!-- Following Card -->
                    <div class="bg-white dark:bg-gray-800 shadow-md rounded-xl p-6 transform transition-transform hover:scale-105 duration-300">
                        <div class="flex items-center justify-between mb-3">
                            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Following</h3>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-teal-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </div>
                        <p class="text-3xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-teal-500 to-teal-700">{{ $followingCount }}</p>
                    </div>

                    <!-- Total Views Card -->
                    <div class="bg-white dark:bg-gray-800 shadow-md rounded-xl p-6 transform transition-transform hover:scale-105 duration-300">
                        <div class="flex items-center justify-between mb-3">
                            <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200">Total Views</h3>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-amber-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </div>
                        <p class="text-3xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-amber-500 to-amber-700">{{ $viewsCount }}</p>
                    </div>
                </div>
            </section>
            
            <!-- Chart Section -->
            <section class="relative opacity-0 animate-fade-in animation-delay-700 duration-700 mb-12">
                <div class="bg-white dark:bg-gray-800 shadow-md rounded-xl p-6">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4">Posts Activity</h3>
                    <div class="h-64">
                        <canvas id="postsChart"></canvas>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const ctx = document.getElementById('postsChart').getContext('2d');
            
            // Chart.js configuration
            const postsChart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: @json($days),
                    datasets: [{
                        label: 'Posts Activity',
                        data: @json($postsPerDay),
                        backgroundColor: 'rgba(79, 70, 229, 0.2)',
                        borderColor: 'rgba(79, 70, 229, 1)',
                        borderWidth: 2,
                        pointBackgroundColor: 'rgba(79, 70, 229, 1)',
                        pointBorderColor: '#fff',
                        pointHoverBackgroundColor: '#fff',
                        pointHoverBorderColor: 'rgba(79, 70, 229, 1)',
                        pointRadius: 4,
                        pointHoverRadius: 6,
                        tension: 0.4,
                        fill: true
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: true,
                            position: 'top',
                            labels: {
                                font: {
                                    family: 'Inter, system-ui, sans-serif',
                                    size: 12
                                },
                                color: 'white'
                            }
                        },
                        tooltip: {
                            backgroundColor: 'rgba(255, 255, 255, 0.95)',
                            titleColor: '#1F2937',
                            bodyColor: '#4B5563',
                            bodyFont: {
                                family: 'Inter, system-ui, sans-serif'
                            },
                            borderColor: 'rgba(0, 0, 0, 0.1)',
                            borderWidth: 1,
                            padding: 12,
                            boxPadding: 6,
                            usePointStyle: true,
                            callbacks: {
                                label: function(context) {
                                    return `Posts: ${context.raw}`;
                                }
                            }
                        }
                    },
                    scales: {
                        x: {
                            grid: {
                                color: window.matchMedia('(prefers-color-scheme: dark)').matches ? 'rgba(255, 255, 255, 0.1)' : 'rgba(0, 0, 0, 0.05)',
                                drawBorder: false
                            },
                            ticks: {
                                color: "white",
                                font: {
                                    family: 'Inter, system-ui, sans-serif'
                                }
                            }
                        },
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: window.matchMedia('(prefers-color-scheme: dark)').matches ? 'rgba(255, 255, 255, 0.1)' : 'rgba(0, 0, 0, 0.05)',
                                drawBorder: false
                            },
                            ticks: {
                                precision: 0,
                                color: "white",
                                font: {
                                    family: 'Inter, system-ui, sans-serif'
                                }
                            }
                        }
                    },
                    interaction: {
                        mode: 'index',
                        intersect: false
                    },
                    hover: {
                        mode: 'nearest',
                        intersect: true
                    }
                }
            });
            
            // Update chart colors on theme change
            window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', function() {
                postsChart.options.plugins.legend.labels.color = window.matchMedia('(prefers-color-scheme: dark)').matches ? 'rgba(255, 255, 255, 0.8)' : 'rgba(0, 0, 0, 0.8)';
                postsChart.options.scales.x.grid.color = window.matchMedia('(prefers-color-scheme: dark)').matches ? 'rgba(255, 255, 255, 0.1)' : 'rgba(0, 0, 0, 0.05)';
                postsChart.options.scales.y.grid.color = window.matchMedia('(prefers-color-scheme: dark)').matches ? 'rgba(255, 255, 255, 0.1)' : 'rgba(0, 0, 0, 0.05)';
                postsChart.options.scales.x.ticks.color = window.matchMedia('(prefers-color-scheme: dark)').matches ? 'rgba(255, 255, 255, 0.7)' : 'rgba(0, 0, 0, 0.7)';
                postsChart.options.scales.y.ticks.color = window.matchMedia('(prefers-color-scheme: dark)').matches ? 'rgba(255, 255, 255, 0.7)' : 'rgba(0, 0, 0, 0.7)';
                postsChart.update();
            });
        });
    </script>

    <!-- Matching animations for consistency -->
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