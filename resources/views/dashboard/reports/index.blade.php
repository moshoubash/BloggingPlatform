@extends('layouts.dashboardlayout')
@section('title', 'Reports Management')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body p-4">
                    <h5 class="card-title fw-semibold mb-4">Reports Management</h5>
                    
                    <div class="row mb-4">
                        <div class="col-md-6 col-lg-3 mb-3">
                            <div class="card border-0 shadow-sm">
                                <div class="card-body p-3">
                                    <h6 class="mb-3">User Activity</h6>
                                    <p class="text-muted small mb-2">Track user registrations and logins</p>
                                    <button class="btn btn-primary btn-sm">Generate Report</button>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6 col-lg-3 mb-3">
                            <div class="card border-0 shadow-sm">
                                <div class="card-body p-3">
                                    <h6 class="mb-3">Content Analysis</h6>
                                    <p class="text-muted small mb-2">Post metrics and engagement data</p>
                                    <button class="btn btn-primary btn-sm">Generate Report</button>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6 col-lg-3 mb-3">
                            <div class="card border-0 shadow-sm">
                                <div class="card-body p-3">
                                    <h6 class="mb-3">Comment Trends</h6>
                                    <p class="text-muted small mb-2">Analyze comment engagement patterns</p>
                                    <button class="btn btn-primary btn-sm">Generate Report</button>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6 col-lg-3 mb-3">
                            <div class="card border-0 shadow-sm">
                                <div class="card-body p-3">
                                    <h6 class="mb-3">Premium Users</h6>
                                    <p class="text-muted small mb-2">Subscription and premium usage stats</p>
                                    <button class="btn btn-primary btn-sm">Generate Report</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card mb-4">
                        <div class="card-body p-4">
                            <h6 class="mb-3">Custom Report</h6>
                            <form>
                                <div class="row g-3">
                                    <div class="col-md-4">
                                        <label class="form-label">Report Type</label>
                                        <select class="form-select">
                                            <option selected>Select report type</option>
                                            <option>User Statistics</option>
                                            <option>Content Performance</option>
                                            <option>Engagement Metrics</option>
                                            <option>Tag Analysis</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Date Range</label>
                                        <select class="form-select">
                                            <option selected>Select date range</option>
                                            <option>Last 7 days</option>
                                            <option>Last 30 days</option>
                                            <option>Last 3 months</option>
                                            <option>Last year</option>
                                            <option>Custom range</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4">
                                        <label class="form-label">Format</label>
                                        <select class="form-select">
                                            <option selected>Select format</option>
                                            <option>PDF</option>
                                            <option>Excel</option>
                                            <option>CSV</option>
                                        </select>
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary mt-3">Generate Custom Report</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    
                    <div class="card">
                        <div class="card-body p-4">
                            <h6 class="mb-3">Recent Reports</h6>
                            <div class="table-responsive">
                                <table class="table text-nowrap mb-0 align-middle">
                                    <thead class="text-light fs-4">
                                        <tr>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Report Name</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Type</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Generated</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Format</h6>
                                            </th>
                                            <th class="border-bottom-0">
                                                <h6 class="fw-semibold mb-0">Actions</h6>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="border-bottom-0">
                                                <h6 class="fw-normal mb-0">Monthly User Activity</h6>
                                            </td>
                                            <td class="border-bottom-0">
                                                <p class="mb-0 fw-normal">User Statistics</p>
                                            </td>
                                            <td class="border-bottom-0">
                                                <p class="mb-0 fw-normal">Apr 8, 2025</p>
                                            </td>
                                            <td class="border-bottom-0">
                                                <div class="d-flex align-items-center gap-2">
                                                    <span class="badge bg-primary rounded-1 fw-semibold">PDF</span>
                                                </div>
                                            </td>
                                            <td class="border-bottom-0">
                                                <a href="#" class="btn btn-sm btn-outline-secondary me-1">View</a>
                                                <a href="#" class="btn btn-sm btn-outline-danger">Delete</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="border-bottom-0">
                                                <h6 class="fw-normal mb-0">Q1 Content Performance</h6>
                                            </td>
                                            <td class="border-bottom-0">
                                                <p class="mb-0 fw-normal">Content Analysis</p>
                                            </td>
                                            <td class="border-bottom-0">
                                                <p class="mb-0 fw-normal">Apr 1, 2025</p>
                                            </td>
                                            <td class="border-bottom-0">
                                                <div class="d-flex align-items-center gap-2">
                                                    <span class="badge bg-success rounded-1 fw-semibold">Excel</span>
                                                </div>
                                            </td>
                                            <td class="border-bottom-0">
                                                <a href="#" class="btn btn-sm btn-outline-secondary me-1">View</a>
                                                <a href="#" class="btn btn-sm btn-outline-danger">Delete</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="border-bottom-0">
                                                <h6 class="fw-normal mb-0">Tag Usage Analytics</h6>
                                            </td>
                                            <td class="border-bottom-0">
                                                <p class="mb-0 fw-normal">Tag Analysis</p>
                                            </td>
                                            <td class="border-bottom-0">
                                                <p class="mb-0 fw-normal">Mar 25, 2025</p>
                                            </td>
                                            <td class="border-bottom-0">
                                                <div class="d-flex align-items-center gap-2">
                                                    <span class="badge bg-warning rounded-1 fw-semibold">CSV</span>
                                                </div>
                                            </td>
                                            <td class="border-bottom-0">
                                                <a href="#" class="btn btn-sm btn-outline-secondary me-1">View</a>
                                                <a href="#" class="btn btn-sm btn-outline-danger">Delete</a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection