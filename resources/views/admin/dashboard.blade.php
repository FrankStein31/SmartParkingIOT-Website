@extends('layouts.admin')

@section('title', 'Dashboard - Admin Panel')

@php
    $pageTitle = 'Dashboard';
    $pageDescription = 'Welcome to admin dashboard overview';
@endphp

@section('content')
<div class="row">
    <!-- Stats Cards -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card stats-card h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title text-white-50 mb-1">Total Parkir</h6>
                        <h3 class="text-white mb-0">1,234</h3>
                        <small class="text-white-50">
                            <i class="bi bi-arrow-up"></i> 12% from last month
                        </small>
                    </div>
                    <div class="display-6 text-white-50">
                        <i class="bi bi-people"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card stats-card stats-card-success h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title text-white-50 mb-1">Parkir Terisi</h6>
                        <h3 class="text-white mb-0">$45,678</h3>
                        <small class="text-white-50">
                            <i class="bi bi-arrow-up"></i> 8% from last month
                        </small>
                    </div>
                    <div class="display-6 text-white-50">
                        <i class="bi bi-currency-dollar"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card stats-card stats-card-warning h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title text-white-50 mb-1">Parkir Kosong</h6>
                        <h3 class="text-white mb-0">892</h3>
                        <small class="text-white-50">
                            <i class="bi bi-arrow-down"></i> 3% from last month
                        </small>
                    </div>
                    <div class="display-6 text-white-50">
                        <i class="bi bi-cart"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card stats-card stats-card-info h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="card-title text-white-50 mb-1">Products</h6>
                        <h3 class="text-white mb-0">156</h3>
                        <small class="text-white-50">
                            <i class="bi bi-arrow-up"></i> 5% from last month
                        </small>
                    </div>
                    <div class="display-6 text-white-50">
                        <i class="bi bi-box"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Recent Activities -->
    <div class="col-lg-8 mb-4">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">
                    <i class="bi bi-activity me-2"></i>Recent Activities
                </h5>
                <a href="#" class="btn btn-sm btn-outline-primary">View All</a>
            </div>
            <div class="card-body">
                <div class="timeline">
                    <div class="d-flex mb-3">
                        <div class="flex-shrink-0">
                            <div class="bg-primary rounded-circle p-2">
                                <i class="bi bi-person-plus text-white"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="mb-1">New user registered</h6>
                            <p class="text-muted mb-1">John Doe created a new account</p>
                            <small class="text-muted">2 minutes ago</small>
                        </div>
                    </div>

                    <div class="d-flex mb-3">
                        <div class="flex-shrink-0">
                            <div class="bg-success rounded-circle p-2">
                                <i class="bi bi-cart-check text-white"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="mb-1">Order completed</h6>
                            <p class="text-muted mb-1">Order #12345 has been completed</p>
                            <small class="text-muted">15 minutes ago</small>
                        </div>
                    </div>

                    <div class="d-flex mb-3">
                        <div class="flex-shrink-0">
                            <div class="bg-warning rounded-circle p-2">
                                <i class="bi bi-exclamation-triangle text-white"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="mb-1">System alert</h6>
                            <p class="text-muted mb-1">Server memory usage is high</p>
                            <small class="text-muted">1 hour ago</small>
                        </div>
                    </div>

                    <div class="d-flex">
                        <div class="flex-shrink-0">
                            <div class="bg-info rounded-circle p-2">
                                <i class="bi bi-upload text-white"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="mb-1">File uploaded</h6>
                            <p class="text-muted mb-1">New product images uploaded</p>
                            <small class="text-muted">2 hours ago</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="col-lg-4 mb-4">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="bi bi-lightning me-2"></i>Quick Actions
                </h5>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <button class="btn btn-primary">
                        <i class="bi bi-person-plus me-2"></i>Add New User
                    </button>
                    <button class="btn btn-success">
                        <i class="bi bi-plus-circle me-2"></i>Create Product
                    </button>
                    <button class="btn btn-info">
                        <i class="bi bi-file-earmark-text me-2"></i>Generate Report
                    </button>
                    <button class="btn btn-warning">
                        <i class="bi bi-gear me-2"></i>System Settings
                    </button>
                </div>
            </div>
        </div>

        <!-- System Status -->
        <div class="card mt-4">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="bi bi-hdd me-2"></i>System Status
                </h5>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <div class="d-flex justify-content-between mb-1">
                        <span>CPU Usage</span>
                        <span>65%</span>
                    </div>
                    <div class="progress" style="height: 8px;">
                        <div class="progress-bar bg-primary" style="width: 65%"></div>
                    </div>
                </div>

                <div class="mb-3">
                    <div class="d-flex justify-content-between mb-1">
                        <span>Memory</span>
                        <span>82%</span>
                    </div>
                    <div class="progress" style="height: 8px;">
                        <div class="progress-bar bg-warning" style="width: 82%"></div>
                    </div>
                </div>

                <div class="mb-0">
                    <div class="d-flex justify-content-between mb-1">
                        <span>Storage</span>
                        <span>45%</span>
                    </div>
                    <div class="progress" style="height: 8px;">
                        <div class="progress-bar bg-success" style="width: 45%"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Recent Users Table -->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">
                    <i class="bi bi-people me-2"></i>Recent Users
                </h5>
                <a href="#" class="btn btn-sm btn-outline-primary">Manage Users</a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Status</th>
                                <th>Joined</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="bg-primary rounded-circle p-2 me-2">
                                            <i class="bi bi-person text-white"></i>
                                        </div>
                                        John Doe
                                    </div>
                                </td>
                                <td>john@example.com</td>
                                <td><span class="badge bg-primary">Admin</span></td>
                                <td><span class="badge bg-success">Active</span></td>
                                <td>2024-01-15</td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-warning">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="bg-success rounded-circle p-2 me-2">
                                            <i class="bi bi-person text-white"></i>
                                        </div>
                                        Jane Smith
                                    </div>
                                </td>
                                <td>jane@example.com</td>
                                <td><span class="badge bg-info">User</span></td>
                                <td><span class="badge bg-success">Active</span></td>
                                <td>2024-01-14</td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-warning">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="bg-warning rounded-circle p-2 me-2">
                                            <i class="bi bi-person text-white"></i>
                                        </div>
                                        Bob Wilson
                                    </div>
                                </td>
                                <td>bob@example.com</td>
                                <td><span class="badge bg-secondary">Moderator</span></td>
                                <td><span class="badge bg-warning">Pending</span></td>
                                <td>2024-01-13</td>
                                <td>
                                    <button class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                    <button class="btn btn-sm btn-outline-warning">
                                        <i class="bi bi-pencil"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Custom dashboard scripts
    console.log('Dashboard loaded successfully');
</script>
@endpush