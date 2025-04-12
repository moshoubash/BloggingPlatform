@extends('layouts.dashboardlayout')
@section('title', 'Tags Statistics')

@section('content')
<div class="card shadow-sm">
    <div class="card-body p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="card-title fw-semibold">Tags Statistics</h5>
            <div class="dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" id="timeRangeDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    Last 30 Days
                </button>
                <ul class="dropdown-menu" aria-labelledby="timeRangeDropdown">
                    <li><a class="dropdown-item" href="#">Last 7 Days</a></li>
                    <li><a class="dropdown-item" href="#">Last 30 Days</a></li>
                    <li><a class="dropdown-item" href="#">Last 90 Days</a></li>
                    <li><a class="dropdown-item" href="#">This Year</a></li>
                    <li><a class="dropdown-item" href="#">All Time</a></li>
                </ul>
            </div>
        </div>

        <!-- Summary Cards Row -->
        <div class="row mb-4 g-3">
            <div class="col-md-3">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h6 class="fw-semibold text-muted">Total Tags</h6>
                        <h2 class="fw-bold">{{ $tags->count() }}</h2>
                        <div class="d-flex align-items-center">
                            <span class="badge bg-success rounded-3 me-2">+8%</span>
                            <small class="text-muted">vs last period</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h6 class="fw-semibold text-muted">Total Posts Tagged</h6>
                        <h2 class="fw-bold">{{ $tags->sum('posts_count') }}</h2>
                        <div class="d-flex align-items-center">
                            <span class="badge bg-success rounded-3 me-2">+12%</span>
                            <small class="text-muted">vs last period</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h6 class="fw-semibold text-muted">Most Used Tag</h6>
                        <h2 class="fw-bold">{{ $tags->sortByDesc('posts_count')->first()?->name ?? 'N/A' }}</h2>
                        <div class="d-flex align-items-center">
                            <span class="badge bg-primary rounded-3 me-2">{{ $tags->sortByDesc('posts_count')->first()?->posts_count ?? 0 }} posts</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h6 class="fw-semibold text-muted">Avg Posts Per Tag</h6>
                        <h2 class="fw-bold">{{ $tags->count() > 0 ? round($tags->sum('posts_count') / $tags->count(), 1) : 0 }}</h2>
                        <div class="d-flex align-items-center">
                            <span class="badge bg-danger rounded-3 me-2">-2%</span>
                            <small class="text-muted">vs last period</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content Area -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h6 class="fw-semibold mb-3">Top Tags</h6>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Tag</th>
                                        <th>Usage</th>
                                        <th>Percentage</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $totalPosts = $tags->sum('posts_count');
                                        $topTags = $tags->sortByDesc('posts_count')->take(5);
                                    @endphp
                                    
                                    @forelse($topTags as $tag)
                                        @php
                                            $percentage = $totalPosts > 0 ? round(($tag->posts_count / $totalPosts) * 100, 1) : 0;
                                            $color = '#' . substr(md5($tag->name), 0, 6);
                                        @endphp
                                        <tr>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="rounded-circle me-2" style="width: 12px; height: 12px; background-color: {{ $color }}"></div>
                                                    <span class="fw-semibold">{{ $tag->name }}</span>
                                                </div>
                                            </td>
                                            <td><span class="badge bg-primary rounded-3 fw-semibold">{{ $tag->posts_count }}</span></td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div class="progress flex-grow-1" style="height: 6px; width: 100px;">
                                                        <div class="progress-bar" role="progressbar" style="width: {{ $percentage }}%; background-color: {{ $color }};" 
                                                            aria-valuenow="{{ $percentage }}" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                    <span class="ms-2">{{ $percentage }}%</span>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="text-center">No tags found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Single Line Chart -->
        <div class="row mb-4">
            <div class="col-12">
                <div class="card border-0 shadow-sm">
                    <div class="card-body">
                        <h6 class="fw-semibold mb-3">Tag Usage Trend (Last 6 Months)</h6>
                        <div style="height: 300px;">
                            <canvas id="tagTrendChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tags Table -->
        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h6 class="fw-semibold mb-0">All Tags</h6>
                    <input type="text" class="form-control form-control-sm" placeholder="Search tags..." style="max-width: 200px;">
                </div>
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="text-dark fs-4">
                            <tr>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Name</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Posts Count</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Usage %</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Growth</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Last Used</h6>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($tags->sortByDesc('posts_count') as $tag)
                            <tr>
                                <td class="border-bottom-0">
                                    <div class="d-flex align-items-center">
                                        <div class="rounded-circle me-2" style="width: 12px; height: 12px; background-color: {{ '#' . substr(md5($tag->name), 0, 6) }}"></div>
                                        <h6 class="fw-semibold mb-0">{{ $tag->name }}</h6>
                                    </div>
                                </td>
                                <td class="border-bottom-0">
                                    <span class="badge bg-primary rounded-3 fw-semibold">{{ $tag->posts_count }}</span>
                                </td>
                                <td class="border-bottom-0">
                                    @php
                                        $totalPosts = $tags->sum('posts_count');
                                        $percentage = $totalPosts > 0 ? round(($tag->posts_count / $totalPosts) * 100, 1) : 0;
                                    @endphp
                                    <div class="d-flex align-items-center">
                                        <div class="progress flex-grow-1" style="height: 6px; width: 80px;">
                                            <div class="progress-bar" role="progressbar" style="width: {{ $percentage }}%;" aria-valuenow="{{ $percentage }}" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <span class="ms-2">{{ $percentage }}%</span>
                                    </div>
                                </td>
                                <td class="border-bottom-0">
                                    @php
                                        // Simulate growth data - in real app, this would come from DB
                                        $growth = rand(-20, 30);
                                        $growthClass = $growth > 0 ? 'text-success' : ($growth < 0 ? 'text-danger' : 'text-muted');
                                        $growthIcon = $growth > 0 ? 'up' : ($growth < 0 ? 'down' : 'right');
                                    @endphp
                                    <div class="d-flex align-items-center">
                                        <i class="ti ti-arrow-{{ $growthIcon }} {{ $growthClass }} me-1"></i>
                                        <span class="{{ $growthClass }}">{{ $growth }}%</span>
                                    </div>
                                </td>
                                <td class="border-bottom-0">
                                    <p class="mb-0 text-muted">{{ now()->subDays(rand(0, 30))->format('M d, Y') }}</p>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center">No tags found</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                <div class="d-flex justify-content-between align-items-center mt-3">
                    <span class="text-muted">Showing {{ $tags->count() }} tags</span>
                    <nav aria-label="Page navigation">
                        <ul class="pagination pagination-sm">
                            <li class="page-item disabled"><a class="page-link" href="#">Previous</a></li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">Next</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Get top 5 tags for chart
    const tags = @json($tags->sortByDesc('posts_count')->take(5)->pluck('name'));
    
    // Line Chart - Tag Trend
    const months = ['January', 'February', 'March', 'April', 'May', 'June'];
    const datasets = tags.map((tag, index) => {
        // Generate sample data
        const data = Array(6).fill().map(() => Math.floor(Math.random() * 20) + 1);
        const color = '#' + tag.split('').reduce((hash, char) => {
            return ((hash << 5) - hash) + char.charCodeAt(0) | 0;
        }, 0).toString(16).substring(0, 6);
        
        return {
            label: tag,
            data: data,
            borderColor: color,
            backgroundColor: 'transparent',
            tension: 0.4,
            borderWidth: 2,
            pointRadius: 3
        };
    });
    
    const ctx = document.getElementById('tagTrendChart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: months,
            datasets: datasets
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'top',
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        precision: 0
                    }
                }
            }
        }
    });
});
</script>
@endsection