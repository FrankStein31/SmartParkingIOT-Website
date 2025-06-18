<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Admin Dashboard')</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">

    <style>
        body {

            background: linear-gradient(135deg, #428eff 0%, #00026e 100%);
            /* background-color: #f8f9fa; */
        }

        .navbar-brand {

            font-weight: bold;
            font-size: 1.5rem;
        }

        .navbar {
            background: linear-gradient(135deg, #428eff 0%, #00026e 100%);
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .main-content {
            margin-top: 20px;
            min-height: calc(100vh - 120px);
        }

        .card {
            border: none;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            border-radius: 10px;
        }

        .stats-card {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 15px;
        }

        .stats-card-success {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        }

        .stats-card-warning {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        }

        .stats-card-info {
            background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
        }

        .dropdown-menu {
            border: none;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }

        .nav-link:hover {
            background-color: rgba(255,255,255,0.1);
            border-radius: 5px;
        }



    </style>

    @stack('styles')
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <!-- Brand -->
            <a class="navbar-brand" href="{{ route('dashboard') }}">
                <i class="bi bi-speedometer2 me-2"></i>
                Admin Panel
            </a>

            <!-- Toggle button for mobile -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Navigation Menu -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}"
                           href="{{ route('dashboard') }}">
                            <i class="bi bi-house-door me-1"></i>
                            Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link "
                           href="">
                            <i class="bi bi-people me-1"></i>
                            Users
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="bi bi-gear me-1"></i>
                            Manajemen Parkir
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#"><i class="bi bi-sliders me-2"></i>Parkir Motor</a></li>
                            <li><a class="dropdown-item" href="#"><i class="bi bi-shield-lock me-2"></i>Parkir Mobil</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="bi bi-gear me-1"></i>
                            Data Master
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href=""><i class="bi bi-sliders me-2"></i>Data Mahasiswa</a></li>
                            <li><a class="dropdown-item" href="{{ route('admin.portal.index') }}"><i class="bi bi-shield-lock me-2"></i>kelola Portal</a></li>
                        </ul>
                    </li>
                </ul>

                <!-- Right side menu -->
                <ul class="navbar-nav">
                    <!-- Notifications -->
                    <li class="nav-item dropdown">
                        <a class="nav-link position-relative" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="bi bi-bell"></i>
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                3
                            </span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><h6 class="dropdown-header">Notifications</h6></li>
                            <li><a class="dropdown-item" href="#">New user registered</a></li>
                            <li><a class="dropdown-item" href="#">System update available</a></li>
                            <li><a class="dropdown-item" href="#">Server maintenance scheduled</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item text-center" href="#">View all notifications</a></li>
                        </ul>
                    </li>

                    <!-- User Menu -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="bi bi-person-circle me-1"></i>

                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="#"><i class="bi bi-person me-2"></i>Profile</a></li>
                            <li><a class="dropdown-item" href="#"><i class="bi bi-gear me-2"></i>Account Settings</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="" class="d-inline">
                                    @csrf
                                    <button type="submit" class="dropdown-item">
                                        <i class="bi bi-box-arrow-right me-2"></i>Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container-fluid main-content">
        <!-- Page Header -->
        @if(isset($pageTitle))
        <div class="row mb-4">
            <div class="col-12">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h2 class="fw-bold text-dark">{{ $pageTitle }}</h2>
                        @if(isset($pageDescription))
                            <p class="text-muted mb-0">{{ $pageDescription }}</p>
                        @endif
                    </div>
                    @if(isset($pageActions))
                        <div>
                            {!! $pageActions !!}
                        </div>
                    @endif
                </div>
            </div>
        </div>
        @endif

        <!-- Flash Messages -->
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-triangle me-2"></i>
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        @if(session('warning'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-triangle me-2"></i>
            {{ session('warning') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        <!-- Page Content -->
        @yield('content')
    </div>

    <!-- Footer -->

    <footer class="text-center py-3 mt-5" style="background: linear-gradient(135deg, #428eff 0%, #00026e 100%);">
        <div class="container">
            <p class="mb-0" style="color: #ffffff;">
                &copy; {{ date('Y') }} RPL-4K. All rights reserved.
            </p>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom Scripts -->
    <script>
        // Auto hide alerts after 5 seconds
        document.addEventListener('DOMContentLoaded', function() {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(function(alert) {
                setTimeout(function() {
                    const bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                }, 5000);
            });
        });
    </script>

    @stack('scripts')
</body>
</html>