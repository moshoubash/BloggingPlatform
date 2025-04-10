@extends('layouts.dashboardlayout')
@section('title', 'Tags Analytics')

@section('content')
<!-- Main Stats Cards -->
<div class="row mb-4">
    <div class="col-md-3">
        <div class="card card-hover">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="me-3">
                        <span class="bg-primary-subtle text-primary p-2 rounded-circle d-inline-flex align-items-center justify-content-center">
                            <i class="ti ti-tag fs-5"></i>
                        </span>
                    </div>
                    <div>
                        <h4 class="mb-0 fw-semibold">{{ $totalTags }}</h4>
                        <span class="text-muted fs-6">Total Tags</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-hover">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="me-3">
                        <span class="bg-success-subtle text-success p-2 rounded-circle d-inline-flex align-items-center justify-content-center">
                            <i class="ti ti-activity fs-5"></i>
                        </span>
                    </div>
                    <div>
                        <h4 class="mb-0 fw-semibold">{{ $mostUsedTag->name ?? 'None' }}</h4>
                        <span class="text-muted fs-6">Most Used Tag</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-hover">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="me-3">
                        <span class="bg-warning-subtle text-warning p-2 rounded-circle d-inline-flex align-items-center justify-content-center">
                            <i class="ti ti-calendar fs-5"></i>
                        </span>
                    </div>
                    <div>
                        <h4 class="mb-0 fw-semibold">{{ $recentlyAddedTags }}</h4>
                        <span class="text-muted fs-6">New Tags This Month</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-hover">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <div class="me-3">
                        <span class="bg-danger-subtle text-danger p-2 rounded-circle d-inline-flex align-items-center justify-content-center">
                            <i class="ti ti-alert-triangle fs-5"></i>
                        </span>
                    </div>
                    <div>
                        <h4 class="mb-0 fw-semibold">{{ $unusedTags }}</h4>
                        <span class="text-muted fs-6">Unused Tags</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Tag Distribution Chart -->
<div class="row mb-4">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-body">
                <div class="d-md-flex align-items-center mb-4">
                    <div>
                        <h5 class="card-title fw-semibold">Tag Distribution</h5>
                        <span class="card-subtitle">Top 10 tags by post count</span>
                    </div>
                    <div class="ms-auto mt-3 mt-md-0">
                        <ul class="nav nav-tabs" id="chartTimeRange" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-bs-toggle="tab" href="#allTime" role="tab">All Time</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#thisMonth" role="tab">This Month</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="tab-content">
                    <div class="tab-pane active" id="allTime" role="tabpanel">
                        <div style="height: 340px">
                            <canvas id="tagDistributionChart"></canvas>
                        </div>
                    </div>
                    <div class="tab-pane" id="thisMonth" role="tabpanel">
                        <div style="height: 340px">
                            <canvas id="tagMonthlyDistributionChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Tag Growth</h5>
                <div style="height: 340px">
                    <canvas id="tagGrowthChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Tag Relationships and Trends -->
<div class="row mb-4">
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Tag Relationships</h5>
                <p class="card-subtitle mb-3">Commonly used together</p>
                <div style="height: 320px">
                    <canvas id="tagRelationshipsChart"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title fw-semibold mb-4">Tag Engagement Metrics</h5>
                <p class="card-subtitle mb-3">Average likes & comments per tag</p>
                <div style="height: 320px">
                    <canvas id="tagEngagementChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Tag Management Table -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="d-md-flex align-items-center mb-4">
                    <div>
                        <h5 class="card-title fw-semibold">Tags Management</h5>
                        <span class="card-subtitle">Overview of all tags with metrics</span>
                    </div>
                    <div class="ms-auto mt-3 mt-md-0">
                        <input type="text" id="tagSearch" class="form-control" placeholder="Search tags...">
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table text-nowrap mb-0 align-middle" id="tagsTable">
                        <thead class="text-dark fs-4">
                            <tr>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Tag Name</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Post Count</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Avg. Engagement</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Created</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Last Used</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Trend</h6>
                                </th>
                                <th class="border-bottom-0">
                                    <h6 class="fw-semibold mb-0">Actions</h6>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tags as $tag)
                            <tr>
                                <td class="border-bottom-0">
                                    <div class="d-flex align-items-center">
                                        <div class="rounded-circle tag-color-dot me-2" style="background-color: {{ $tag->color ?? '#' . substr(md5($tag->name), 0, 6) }}"></div>
                                        <h6 class="fw-semibold mb-0">{{ $tag->name }}</h6>
                                    </div>
                                </td>
                                <td class="border-bottom-0">
                                    <p class="mb-0 fw-normal">{{ $tag->post_count }}</p>
                                </td>
                                <td class="border-bottom-0">
                                    <p class="mb-0 fw-normal">{{ number_format($tag->avg_engagement, 1) }}</p>
                                </td>
                                <td class="border-bottom-0">
                                    <p class="mb-0 fw-normal">{{ $tag->created_at->format('M d, Y') }}</p>
                                </td>
                                <td class="border-bottom-0">
                                    <p class="mb-0 fw-normal">{{ $tag->last_used ? $tag->last_used->format('M d, Y') : 'Never' }}</p>
                                </td>
                                <td class="border-bottom-0">
                                    @if($tag->trend > 0)
                                        <span class="badge bg-success-subtle text-success rounded-pill">
                                            <i class="ti ti-arrow-up-right"></i> {{ $tag->trend }}%
                                        </span>
                                    @elseif($tag->trend < 0)
                                        <span class="badge bg-danger-subtle text-danger rounded-pill">
                                            <i class="ti ti-arrow-down-right"></i> {{ abs($tag->trend) }}%
                                        </span>
                                    @else
                                        <span class="badge bg-secondary-subtle text-secondary rounded-pill">
                                            <i class="ti ti-minus"></i> 0%
                                        </span>
                                    @endif
                                </td>
                                <td class="border-bottom-0">
                                    <div class="d-flex align-items-center gap-2">
                                        <a href="{{ route('dashboard.tags.show', $tag->name) }}" class="btn btn-sm btn-primary">
                                            <i class="ti ti-eye"></i>
                                        </a>
                                        <a href="{{ route('dashboard.tags.edit', $tag->name) }}" class="btn btn-sm btn-info">
                                            <i class="ti ti-edit"></i>
                                        </a>
                                        <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#deleteTagModal" 
                                                data-tag-name="{{ $tag->name }}" data-tag-id="{{ $tag->id }}">
                                            <i class="ti ti-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-end mt-3">
                    {{ $tags->links() }}
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Delete Tag Modal -->
<div class="modal fade" id="deleteTagModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Delete Tag</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete the tag "<span id="deleteTagName"></span>"?</p>
                <p class="text-danger">This action cannot be undone.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form id="deleteTagForm" method="POST" action="">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Charts configuration
    const colors = [
        '#3a86ff', '#ff006e', '#8338ec', '#fb5607', '#ffbe0b', 
        '#06d6a0', '#118ab2', '#ef476f', '#073b4c', '#84a59d'
    ];
    
    // Tag Distribution Chart
    const tagDistributionChart = new Chart(
        document.getElementById('tagDistributionChart'),
        {
            type: 'bar',
            data: {
                labels: {!! json_encode($topTags->pluck('name')) !!},
                datasets: [{
                    label: 'Number of Posts',
                    data: {!! json_encode($topTags->pluck('post_count')) !!},
                    backgroundColor: colors,
                    borderColor: colors.map(color => color),
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            display: true,
                            color: 'rgba(0, 0, 0, 0.05)'
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        }
    );
    
    // Monthly Tag Distribution Chart
    const monthlyTagDistributionChart = new Chart(
        document.getElementById('tagMonthlyDistributionChart'),
        {
            type: 'bar',
            data: {
                labels: {!! json_encode($topMonthlyTags->pluck('name')) !!},
                datasets: [{
                    label: 'Posts This Month',
                    data: {!! json_encode($topMonthlyTags->pluck('monthly_count')) !!},
                    backgroundColor: colors,
                    borderColor: colors.map(color => color),
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            display: true,
                            color: 'rgba(0, 0, 0, 0.05)'
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        }
    );
    
    // Tag Growth Over Time Chart
    const tagGrowthChart = new Chart(
        document.getElementById('tagGrowthChart'),
        {
            type: 'line',
            data: {
                labels: {!! json_encode($tagGrowthData->pluck('month')) !!},
                datasets: [{
                    label: 'New Tags',
                    data: {!! json_encode($tagGrowthData->pluck('count')) !!},
                    fill: true,
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            display: true,
                            color: 'rgba(0, 0, 0, 0.05)'
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        }
    );
    
    // Tag Relationships Chart
    const tagRelationshipsChart = new Chart(
        document.getElementById('tagRelationshipsChart'),
        {
            type: 'radar',
            data: {
                labels: {!! json_encode($relatedTags->pluck('name')) !!},
                datasets: [{
                    label: 'Co-occurrence',
                    data: {!! json_encode($relatedTags->pluck('co_occurrence')) !!},
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 2,
                    pointBackgroundColor: 'rgba(54, 162, 235, 1)',
                    pointRadius: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                elements: {
                    line: {
                        tension: 0.2
                    }
                },
                scales: {
                    r: {
                        beginAtZero: true,
                        ticks: {
                            display: false
                        }
                    }
                }
            }
        }
    );
    
    // Tag Engagement Chart
    const tagEngagementChart = new Chart(
        document.getElementById('tagEngagementChart'),
        {
            type: 'bar',
            data: {
                labels: {!! json_encode($tagEngagementData->pluck('name')) !!},
                datasets: [
                    {
                        label: 'Avg. Likes',
                        data: {!! json_encode($tagEngagementData->pluck('avg_likes')) !!},
                        backgroundColor: 'rgba(255, 99, 132, 0.7)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Avg. Comments',
                        data: {!! json_encode($tagEngagementData->pluck('avg_comments')) !!},
                        backgroundColor: 'rgba(54, 162, 235, 0.7)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            display: true,
                            color: 'rgba(0, 0, 0, 0.05)'
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        }
    );
    
    // Tag Search Functionality
    const tagSearch = document.getElementById('tagSearch');
    const tagsTable = document.getElementById('tagsTable');
    
    tagSearch.addEventListener('keyup', function() {
        const searchText = this.value.toLowerCase();
        const rows = tagsTable.querySelectorAll('tbody tr');
        
        rows.forEach(row => {
            const tagName = row.querySelector('td:first-child h6').textContent.toLowerCase();
            if (tagName.includes(searchText)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    });
    
    // Setup delete tag modal
    const deleteTagModal = document.getElementById('deleteTagModal');
    if (deleteTagModal) {
        deleteTagModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const tagName = button.getAttribute('data-tag-name');
            const tagId = button.getAttribute('data-tag-id');
            
            document.getElementById('deleteTagName').textContent = tagName;
            document.getElementById('deleteTagForm').action = `/dashboard/tags/${tagId}`;
        });
    }
    
    // Custom tag color dots styling
    const tagColorDots = document.querySelectorAll('.tag-color-dot');
    tagColorDots.forEach(dot => {
        dot.style.width = '10px';
        dot.style.height = '10px';
        dot.style.display = 'inline-block';
    });
});
</script>
@endsection

@section('styles')
<style>
    /* Custom styles for tag analytics */
    .card-hover {
        transition: transform 0.3s, box-shadow 0.3s;
    }
    
    .card-hover:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
    }
    
    .tag-color-dot {
        width: 10px;
        height: 10px;
        border-radius: 50%;
    }
    
    #tagSearch {
        max-width: 250px;
    }
    
    @media (max-width: 767px) {
        #tagSearch {
            max-width: 100%;
        }
    }
</style>
@endsection