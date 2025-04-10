@extends('layouts.dashboardlayout')
@section('title', 'Dashboard Overview')

@section('content')
    <div class="row">
        <div class="col-sm-6 col-md-6 col-lg-3">
            <!-- Engagement Stats -->
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-start">
                        <div class="col-8">
                            <h5 class="card-title mb-9 fw-semibold">Users</h5>
                            <h4 class="fw-semibold mb-3">{{ $analytics['total_users'] }}</h4>
                        </div>
                        <div class="col-4">
                            <div class="d-flex justify-content-end">
                                <div
                                    class="text-white bg-secondary rounded-circle p-6 d-flex align-items-center justify-content-center">
                                    <i class="fa-solid fa-users" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="engagement"></div>
            </div>
        </div>
        <div class="col-sm-6 col-md-6 col-lg-3">
            <!-- Engagement Stats -->
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-start">
                        <div class="col-8">
                            <h5 class="card-title mb-9 fw-semibold">Posts</h5>
                            <h4 class="fw-semibold mb-3">{{ $analytics['total_posts'] }}</h4>
                        </div>
                        <div class="col-4">
                            <div class="d-flex justify-content-end">
                                <div
                                    class="text-white bg-secondary rounded-circle p-6 d-flex align-items-center justify-content-center">
                                    <i class="fa-solid fa-file" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="engagement"></div>
            </div>
        </div>
        <div class="col-sm-6 col-md-6 col-lg-3">
            <!-- Engagement Stats -->
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-start">
                        <div class="col-8">
                            <h5 class="card-title mb-9 fw-semibold">Comments</h5>
                            <h4 class="fw-semibold mb-3">{{ $analytics['total_comments'] }}</h4>
                        </div>
                        <div class="col-4">
                            <div class="d-flex justify-content-end">
                                <div
                                    class="text-white bg-secondary rounded-circle p-6 d-flex align-items-center justify-content-center">
                                    <i class="fa-solid fa-message" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="engagement"></div>
            </div>
        </div>
        <div class="col-sm-6 col-md-6 col-lg-3">
            <!-- Engagement Stats -->
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-start">
                        <div class="col-8">
                            <h5 class="card-title mb-9 fw-semibold">Views</h5>
                            <h4 class="fw-semibold mb-3">{{ $analytics['total_views'] }}</h4>
                        </div>
                        <div class="col-4">
                            <div class="d-flex justify-content-end">
                                <div
                                    class="text-white bg-secondary rounded-circle p-6 d-flex align-items-center justify-content-center">
                                    <i class="fa-solid fa-eye" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="engagement"></div>
            </div>
        </div>
    </div>
    <div class="row">
        <!-- Left column taking two rows -->
        <div class="col-lg-6 d-flex">
            <div class="card w-100 overflow-hidden">
                <div class="card-body p-4">
                    <h5 class="card-title mb-9 fw-semibold">Top Three Posters</h5>
                    <div class="row align-items-center">
                        <div class="col-12">
                            <div style="position: relative; width: 100%; height: 350px;">
                                <canvas id="topPostersChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right column: two stacked cards -->
        <div class="col-lg-6">
            <div class="row h-100">
                <!-- First right-side card -->
                <div class="col-12 mb-3">
                    <div class="card w-100 h-100">
                        <div class="card-body">
                            <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                                <div class="mb-3 mb-sm-0">
                                    <h5 class="card-title fw-semibold">Traffic Data</h5>
                                </div>
                            </div>
                            <canvas id="trafficChart" style="width: 100%; max-height: 350px;"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 d-flex align-items-stretch">
            <div class="card w-100 p-4">
                <h5 class="card-title fw-semibold mb-4">Recent Posts</h5>
                <div class="table-responsive">
                    <table class="table text-nowrap mb-0 align-middle">
                        <thead class="text-dark fs-4">
                        <tr>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Id</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Image</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Title</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Author</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Created At</h6>
                            </th>
                            <th class="border-bottom-0">
                                <h6 class="fw-semibold mb-0">Actions</h6>
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($posts->sortByDesc('created_at')->take(7) as $post)
                            <tr>
                                <td class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">{{$post->id}}</h6>
                                </td>
                                <td class="border-bottom-0">
                                    <img src="{{$post->featured_image}}" alt="image" class="img-fluid rounded" style="width: 50px; height: 50px; object-fit: cover;">
                                </td>
                                <td class="border-bottom-0">
                                    <h6 class="fw-semibold mb-1">
                                        <a href="/posts/{{$post->slug}}">{{$post->title}}</a>
                                    </h6>
                                </td>
                                <td class="border-bottom-0">
                                    <h6 class="fw-semibold mb-1">{{$post->user->name}}</h6>
                                </td>
                                <td class="border-bottom-0">
                                    <h6 class="fw-semibold mb-1">{{$post->created_at->diffForHumans()}}</h6>
                                </td>
                                <td class="border-bottom-0">
                                    <div class="d-flex align-items-center gap-2">
                                        <a href="{{route('dashboard.posts.edit', $post->id)}}" class="btn btn-sm btn-primary"><i class="fa-solid fa-pen-to-square"></i></a>
                                        <form action="{{route('dashboard.posts.destroy', $post->id)}}"  method="post">
                                            @method('POST')
                                            @csrf
                                            <button class="btn btn-sm btn-danger">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const doughnutCtx = document.getElementById('topPostersChart').getContext('2d');
        const topPosters = @json($analytics['topPosters']);

        new Chart(doughnutCtx, {
            type: 'doughnut',
            data: {
                labels: [topPosters[0].name, topPosters[1].name, topPosters[2].name],
                datasets: [{
                    label: 'Number of Posts',
                    data: [topPosters[0].posts, topPosters[1].posts, topPosters[2].posts],
                    backgroundColor: ['#3b82f6', '#60a5fa', '#93c5fd'],
                    borderColor: '#1e293b',
                    borderWidth: 4,
                    hoverOffset: 10
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            color: '#e5e7eb', // Tailwind's gray-200
                            font: {
                                family: 'Inter, sans-serif',
                                size: 12,
                            }
                        }
                    },
                    title: {
                        display: true,
                        color: '#f9fafb', // Tailwind's gray-50
                        font: {
                            size: 16,
                            weight: 'bold',
                            family: 'Inter, sans-serif'
                        },
                        padding: {
                            top: 10,
                            bottom: 20
                        }
                    },
                    tooltip: {
                        backgroundColor: '#1f2937', // Tailwind gray-800
                        titleColor: '#f9fafb',
                        bodyColor: '#d1d5db',
                        borderColor: '#374151',
                        borderWidth: 1
                    }
                }
            }
        });
    </script>
    <script>
        const ctx = document.getElementById('trafficChart').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: @json($analytics['traffic_data']['dates']),
                datasets: [
                    {
                        label: 'Page Views',
                        data: @json($analytics['traffic_data']['views']),
                        backgroundColor: 'rgba(59, 130, 246, 0.8)', // Blue
                        borderRadius: 5,
                        barThickness: 16
                    },
                    {
                        label: 'Unique Visitors',
                        data: @json($analytics['traffic_data']['unique']),
                        backgroundColor: 'rgba(147, 197, 253, 0.8)', // Light Blue
                        borderRadius: 5,
                        barThickness: 16
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                interaction: {
                    mode: 'index',
                    intersect: false
                },
                animation: {
                    duration: 0 // optional: disables the bar slide-in animation
                },
                plugins: {
                    legend: {
                        labels: {
                            color: '#fff'
                        }
                    }
                },
                scales: {
                    x: {
                        ticks: {
                            color: '#fff'
                        },
                        grid: {
                            color: 'rgba(255, 255, 255, 0.05)'
                        },
                        stacked: false
                    },
                    y: {
                        beginAtZero: true,
                        ticks: {
                            color: '#fff'
                        },
                        grid: {
                            color: 'rgba(255, 255, 255, 0.05)'
                        }
                    }
                }
            }
        });
    </script>
@endsection