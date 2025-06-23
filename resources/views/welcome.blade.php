<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart Parking IOT - Ultimate Dashboard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="#" onclick="showSection('home')">SmartParking</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                 <span class="navbar-toggler-icon" style="background-image: url(\"data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba(255,255,255,0.8)' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e\");"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav align-items-center">
                    <li class="nav-item"><a class="nav-link active" onclick="showSection('home')">Beranda</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Manajemen Parkir</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" onclick="showSection('parkir-motor')">Parkir Motor</a></li>
                            <li><a class="dropdown-item" onclick="showSection('parkir-mobil')">Parkir Mobil</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownPusatPemantauan" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Pusat Pemantauan
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownPusatPemantauan">
                            <li><a class="dropdown-item" href="#" onclick="showSection('pusat-pemantauan-dashboard-parkir-motor')">Dashboard Motor</a></li>
                            <li><a class="dropdown-item" href="#" onclick="showSection('pusat-pemantauan-dashboard-parkir-mobil')">Dashboard Mobil</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                         <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Data Master</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" onclick="showSection('mahasiswa')">Data Mahasiswa</a></li>
                            <li><a class="dropdown-item" onclick="showSection('portal')">Kelola Portal</a></li>
                        </ul>
                    </li>
                    <li class="nav-item ms-lg-3"><a href="/dashboard" class="btn btn-dashboard-nav">Dashboard</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content Area -->
    <div class="main-content">
        <!-- Home Section -->
        <div id="home" class="content-section active">
            <div class="hero-section">
                <div class="container">
                    <div class="row w-100">
                        <div class="col-lg-7 text-center text-lg-start">
                            <h1 class="display-3 mb-4">Solusi Parkir Cerdas di Ujung Jari Anda</h1>
                            <p class="lead mb-5">Kelola, pantau, dan analisis semua kebutuhan parkir Anda dari satu platform terpusat. Efisien, modern, dan terintegrasi dengan IoT.</p>
                            <button class="btn btn-cta" onclick="showSection('parkir-motor')">Mulai Kelola</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Parkir Motor Section -->
        <div id="parkir-motor" class="content-section">
            <div class="container">
                <h2 class="section-title">Manajemen Parkir Motor</h2>
                <div class="content-card">
                     <div class="card-header d-flex justify-content-between align-items-center">
                        <h6>Status Slot Parkir Motor</h6>
                        <p class="text-sm mb-0">
                            <i class="fa-solid fa-circle text-success me-1"></i> Kosong
                            <i class="fa-solid fa-circle text-danger ms-3 me-1"></i> Terisi
                        </p>
                    </div>
                    <div class="card-body p-3">
                        <div class="row gy-4" id="slotMotorList">
                            </div>
                    </div>
                </div>
                <div class="content-card">
                    <div class="card-header">
                        <h6><i class="fas fa-history me-2"></i>Riwayat Parkir Motor</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0 table-dark-custom">
                                <thead>
                                    <tr>
                                        <th>Tanggal & Waktu</th>
                                        <th>NIM</th>
                                        <th>Nama</th>
                                        <th>Akses</th>
                                    </tr>
                                </thead>
                                <tbody id="motorList">
                                    </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Parkir Mobil Section -->
        <div id="parkir-mobil" class="content-section">
            <div class="container">
                <h2 class="section-title">Manajemen Parkir Mobil</h2>
                <div class="content-card">
                     <div class="card-header d-flex justify-content-between align-items-center">
                        <h6>Status Slot Parkir Mobil</h6>
                        <p class="text-sm mb-0">
                            <i class="fa-solid fa-circle text-success me-1"></i> Kosong
                            <i class="fa-solid fa-circle text-danger ms-3 me-1"></i> Terisi
                        </p>
                    </div>
                    <div class="card-body p-3">
                        <div class="row gy-4" id="slotMobilList">
                            </div>
                    </div>
                </div>
                <div class="content-card">
                    <div class="card-header">
                         <h6><i class="fas fa-history me-2"></i>Riwayat Parkir Mobil</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0 table-dark-custom">
                                <thead>
                                    <tr>
                                        <th>Tanggal & Waktu</th>
                                        <th>NIM</th>
                                        <th>Nama</th>
                                        <th>Akses</th>
                                    </tr>
                                </thead>
                                <tbody id="mobilList">
                                    </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Pusat Pemantauan Dashboard Parkir Motor --}}
        <div id="pusat-pemantauan-dashboard-parkir-motor" class="content-section">
            <div class="container">
                <div class="row mb-5">
                    <div class="col-12">
                        <h1 class="header-title section-title">SmartParking Dashboard</h1>
                        <p class="header-subtitle">Monitoring Parkir Motor Real-time</p>
                    </div>
                </div>

                <div class="row mb-5 align-items-stretch">
                    <div class="col-lg-7 col-md-12 mb-4 mb-lg-4">
                        <div class="glass-card h-100 d-flex flex-column gap-3">
                            <div class="p-4 border-bottom border-secondary">
                                <h5 class="text-white mb-0"><i class="fa-solid fa-motorcycle me-2"></i>Status Slot Parkir</h5>
                            </div>
                            <div class="slot-grid px-4" id="slotGridMotor"></div>
                            <div class="pb-4 px-4">
                                <div class="system-health mt-auto d-flex flex-row align-items-center">
                                    <div>
                                        <span id="statusIndicatorMotor" class="status-indicator"></span>
                                        <strong class="text-white">Sistem Operasional</strong>
                                    </div>
                                    <div class="text-end">
                                        <span id="jamOperasionalMotor">Memuat...</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-5 col-md-12 mb-4 mb-lg-4">
                        <div class="row h-100">
                            <div class="col-6 mb-4">
                                <div class="glass-card metric-card h-100">
                                    <div class="d-flex flex-column align-items-center justify-content-center h-100 text-center">
                                        <div class="metric-number" id="occupancyRateMotor">0%</div>
                                        <div class="metric-label">
                                            <i class="fa-solid fa-chart-pie me-2"></i>Tingkat Okupansi
                                        </div>
                                        <div class="progress-custom mt-3 w-100">
                                            <div class="progress-bar-custom" id="progressBarMotor" style="width: 0%"></div>
                                        </div>
                                        <small class="text-secondary d-block mt-2 w-100" style="font-size: 0.75rem;">Persentase slot terisi dari total</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 mb-4">
                                <div class="glass-card metric-card h-100">
                                    <div class="d-flex flex-column align-items-center justify-content-center h-100">
                                        <div class="metric-number" style="color: var(--success-color);" id="todayEntryMotor">0</div>
                                        <div class="metric-label">
                                            <i class="fa-solid fa-right-to-bracket me-2"></i>Kendaraan Masuk Hari Ini
                                        </div>
                                        <small class="text-secondary d-block mt-2" style="font-size: 0.75rem;">Total mobil masuk per hari ini</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="glass-card metric-card h-100">
                                    <div class="d-flex flex-column align-items-center justify-content-center h-100">
                                        <div class="metric-number" style="color: var(--warning-color);" id="peakHourMotor">--:--</div>
                                        <div class="metric-label">
                                            <i class="fa-solid fa-clock me-2"></i>Jam Masuk Paling Ramai
                                        </div>
                                        <small class="text-secondary d-block mt-2 text-center" style="font-size: 0.75rem;">Waktu paling banyak kendaraan masuk hari ini</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="glass-card metric-card h-100">
                                    <div class="metric-number" style="color: var(--info-color);" id="lastEntryTimeMotor">--:--</div>
                                    <div class="metric-label">
                                        <i class="fa-solid fa-clock me-2"></i>Kendaraan Masuk Terakhir
                                    </div>
                                    <small class="text-secondary d-block mt-2" style="font-size: 0.75rem;">Berdasarkan waktu masuk terakhir hari ini</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mb-5">
                    <div class="col-lg-8 col-md-12 mb-4">
                        <div class="glass-card h-100">
                            <div class="d-flex justify-content-between align-items-center p-4 border-bottom border-secondary">
                                <h5 class="text-white mb-0"><i class="bi bi-graph-up me-2"></i>Penggunaan Parkir</h5>
                                <div class="btn-group btn-group-sm" role="group">
                                    <button type="button" class="btn btn-outline-light active" onclick="toggleChartMotor('hourly')">Per Jam</button>
                                    <button type="button" class="btn btn-outline-light" onclick="toggleChartMotor('weekly')">Mingguan</button>
                                </div>
                            </div>
                            <div class="chart-container" style="height: 380px;">
                                <canvas id="usageChartMotor"></canvas>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-12 mb-4">
                        <div class="glass-card h-100">
                            <div class="p-4 border-bottom border-secondary">
                                <h5 class="text-white mb-0"><i class="bi bi-pie-chart me-2"></i>Metode Akses</h5>
                            </div>
                            <div class="chart-container">
                                <canvas id="accessChartMotor"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mb-5">
                    <div class="col-lg-4 col-md-12 mb-4">
                        <div class="glass-card h-100">
                            <div class="p-4 border-bottom border-secondary">
                                <h5 class="text-white mb-0"><i class="bi bi-speedometer2 me-2"></i>Quick Stats</h5>
                            </div>
                            <div class="quick-stats p-4">
                                <div class="quick-stat-item">
                                    <div class="quick-stat-number" id="currentAvailableSlotsMotor">XX</div>
                                    <div class="quick-stat-label">Slot Tersedia</div>
                                </div>
                                <div class="quick-stat-item">
                                    <div class="quick-stat-number" id="topDepartmentMotor">TI</div>
                                    <div class="quick-stat-label">Top Jurusan</div>
                                </div>
                                <div class="quick-stat-item">
                                    <div class="quick-stat-number" id="trafficComparisonMotor">+15%</div>
                                    <div class="quick-stat-label">Lalu Lintas vs Kemarin</div>
                                </div>
                                <div class="quick-stat-item">
                                    <div class="quick-stat-number" id="topAccessMotor">...</div>
                                    <div class="quick-stat-label">Akses Terbanyak</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-8 col-md-12 mb-4">
                        <div class="glass-card h-100">
                            <div class="p-4 border-bottom border-secondary">
                                <h5 class="text-white mb-0"><i class="fa fa-building me-2"></i>Distribusi Jurusan</h5>
                            </div>
                            <div class="chart-container">
                                <canvas id="departmentChartMotor" style="height: 300px;"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12 col-md-12 mb-4">
                        <div class="glass-card h-100">
                            <div class="p-4 border-bottom border-secondary">
                                <h5 class="text-white mb-0"><i class="bi bi-clock-history me-2"></i>Aktivitas Terbaru</h5>
                            </div>
                            <div id="recentActivityMotor" style="max-height: 680px; overflow-y: auto;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Pusat Pemantauan Dashboard Parkir Mobil --}}
        <div id="pusat-pemantauan-dashboard-parkir-mobil" class="content-section">
            <div class="container">
                <div class="row mb-5">
                    <div class="col-12">
                        <h1 class="header-title section-title">SmartParking Dashboard</h1>
                        <p class="header-subtitle">Monitoring Parkir Mobil Real-time</p>
                    </div>
                </div>

                <div class="row mb-5 align-items-stretch">
                    <div class="col-lg-7 col-md-12 mb-4 mb-lg-4">
                        <div class="glass-card h-100 d-flex flex-column gap-3">
                            <div class="p-4 border-bottom border-secondary">
                                <h5 class="text-white mb-0"><i class="bi bi-car-front me-2"></i>Status Slot Parkir</h5>
                            </div>
                            <div class="slot-grid px-4" id="slotGridMobil"></div>
                            <div class="pb-4 px-4">
                                <div class="system-health mt-auto d-flex flex-row align-items-center">
                                    <div>
                                        <span id="statusIndicatorMobil" class="status-indicator"></span>
                                        <strong class="text-white">Sistem Operasional</strong>
                                    </div>
                                    <div class="text-end">
                                        <span id="jamOperasionalMobil">Memuat...</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-5 col-md-12 mb-4 mb-lg-4">
                        <div class="row h-100">
                            <div class="col-6 mb-4">
                                <div class="glass-card metric-card h-100">
                                    <div class="d-flex flex-column align-items-center justify-content-center h-100 text-center">
                                        <div class="metric-number" id="occupancyRateMobil">0%</div>
                                        <div class="metric-label">
                                            <i class="fa-solid fa-chart-pie me-2"></i>Tingkat Okupansi
                                        </div>
                                        <div class="progress-custom mt-3 w-100">
                                            <div class="progress-bar-custom" id="progressBarMobil" style="width: 0%"></div>
                                        </div>
                                        <small class="text-secondary d-block mt-2 w-100" style="font-size: 0.75rem;">Persentase slot terisi dari total</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 mb-4">
                                <div class="glass-card metric-card h-100">
                                    <div class="d-flex flex-column align-items-center justify-content-center h-100">
                                        <div class="metric-number" style="color: var(--success-color);" id="todayEntryMobil">0</div>
                                        <div class="metric-label">
                                            <i class="fa-solid fa-right-to-bracket me-2"></i>Kendaraan Masuk Hari Ini
                                        </div>
                                        <small class="text-secondary d-block mt-2" style="font-size: 0.75rem;">Total mobil masuk per hari ini</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="glass-card metric-card h-100">
                                    <div class="d-flex flex-column align-items-center justify-content-center h-100">
                                        <div class="metric-number" style="color: var(--warning-color);" id="peakHourMobil">--:--</div>
                                        <div class="metric-label">
                                            <i class="fa-solid fa-clock me-2"></i>Jam Masuk Paling Ramai
                                        </div>
                                        <small class="text-secondary d-block mt-2 text-center" style="font-size: 0.75rem;">Waktu paling banyak kendaraan masuk hari ini</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="glass-card metric-card h-100">
                                    <div class="metric-number" style="color: var(--info-color);" id="lastEntryTimeMobil">--:--</div>
                                    <div class="metric-label">
                                        <i class="fa-solid fa-clock me-2"></i>Kendaraan Masuk Terakhir
                                    </div>
                                    <small class="text-secondary d-block mt-2" style="font-size: 0.75rem;">Berdasarkan waktu masuk terakhir hari ini</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mb-5">
                    <div class="col-lg-8 col-md-12 mb-4">
                        <div class="glass-card h-100">
                            <div class="d-flex justify-content-between align-items-center p-4 border-bottom border-secondary">
                                <h5 class="text-white mb-0"><i class="bi bi-graph-up me-2"></i>Penggunaan Parkir</h5>
                                <div class="btn-group btn-group-sm" role="group">
                                    <button type="button" class="btn btn-outline-light active" onclick="toggleChart('hourly')">Per Jam</button>
                                    <button type="button" class="btn btn-outline-light" onclick="toggleChart('weekly')">Mingguan</button>
                                </div>
                            </div>
                            <div class="chart-container" style="height: 380px;">
                                <canvas id="usageChartMobil"></canvas>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-12 mb-4">
                        <div class="glass-card h-100">
                            <div class="p-4 border-bottom border-secondary">
                                <h5 class="text-white mb-0"><i class="bi bi-pie-chart me-2"></i>Metode Akses</h5>
                            </div>
                            <div class="chart-container">
                                <canvas id="accessChartMobil"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row mb-5">
                    <div class="col-lg-4 col-md-12 mb-4">
                        <div class="glass-card h-100">
                            <div class="p-4 border-bottom border-secondary">
                                <h5 class="text-white mb-0"><i class="bi bi-speedometer2 me-2"></i>Quick Stats</h5>
                            </div>
                            <div class="quick-stats p-4">
                                <div class="quick-stat-item">
                                    <div class="quick-stat-number" id="currentAvailableSlotsMobil">XX</div>
                                    <div class="quick-stat-label">Slot Tersedia</div>
                                </div>
                                <div class="quick-stat-item">
                                    <div class="quick-stat-number" id="topDepartmentMobil">TI</div>
                                    <div class="quick-stat-label">Top Jurusan</div>
                                </div>
                                <div class="quick-stat-item">
                                    <div class="quick-stat-number" id="trafficComparisonMobil">+15%</div>
                                    <div class="quick-stat-label">Lalu Lintas vs Kemarin</div>
                                </div>
                                <div class="quick-stat-item">
                                    <div class="quick-stat-number" id="topAccessMobil">...</div>
                                    <div class="quick-stat-label">Akses Terbanyak</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-8 col-md-12 mb-4">
                        <div class="glass-card h-100">
                            <div class="p-4 border-bottom border-secondary">
                                <h5 class="text-white mb-0"><i class="fa fa-building me-2"></i>Distribusi Jurusan</h5>
                            </div>
                            <div class="chart-container">
                                <canvas id="departmentChartMobil" style="height: 300px;"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12 col-md-12 mb-4">
                        <div class="glass-card h-100">
                            <div class="p-4 border-bottom border-secondary">
                                <h5 class="text-white mb-0"><i class="bi bi-clock-history me-2"></i>Aktivitas Terbaru</h5>
                            </div>
                            <div id="recentActivityMobil" style="max-height: 680px; overflow-y: auto;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Mahasiswa Section -->
        <div id="mahasiswa" class="content-section">
            <div class="container">
                <h2 class="section-title">Data Master Mahasiswa</h2>
                <div class="content-card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h6><i class="fas fa-users me-2"></i>Daftar Mahasiswa Terdaftar</h6>
                            <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addModal">
                                <i class="fas fa-plus me-1"></i> Tambah Mahasiswa
                            </button>
                        </div>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0 table-dark-custom">
                                <thead>
                                    <tr>
                                        <th>NIM</th><th>Nama</th><th>Jurusan</th><th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody id="mahasiswaList">
                                    </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Portal Section -->
        <div id="portal" class="content-section">
            <div class="container">
                <h2 class="section-title">Kelola Portal & Jadwal Sistem</h2>
                <div class="content-card">
                    <div class="card-header">
                        <h6><i class="fas fa-cogs me-2"></i>Pengaturan Jadwal Operasional Portal</h6>
                    </div>
                    <div class="card-body">
                        <div class="row gy-5">
                            <div class="col-md-6">
                                <h5 class="mb-4 text-light"><i class="fas fa-motorcycle me-2"></i>Portal Motor</h5>
                                <div class="mb-3"><label class="form-label">Jam Mulai</label><input type="time" class="form-control" id="motor_jam_mulai"></div>
                                <div class="mb-3"><label class="form-label">Jam Selesai</label><input type="time" class="form-control" id="motor_jam_selesai"></div>
                                <div class="mb-3"><label class="form-label">Status Operasional</label><select class="form-select" id="motor_operasional"><option value="on">On</option><option value="off">Off</option></select></div>
                                <button class="btn btn-info" onclick="updateJadwal('motor')">Update Jadwal Motor</button>
                            </div>
                            <div class="col-md-6">
                                <h5 class="mb-4 text-light"><i class="fas fa-car me-2"></i>Portal Mobil</h5>
                                <div class="mb-3"><label class="form-label">Jam Mulai</label><input type="time" class="form-control" id="mobil_jam_mulai"></div>
                                <div class="mb-3"><label class="form-label">Jam Selesai</label><input type="time" class="form-control" id="mobil_jam_selesai"></div>
                                 <div class="mb-3"><label class="form-label">Status Operasional</label><select class="form-select" id="mobil_operasional"><option value="on">On</option><option value="off">Off</option></select></div>
                                <button class="btn btn-info" onclick="updateJadwal('mobil')">Update Jadwal Mobil</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <footer class="py-4" style="background-color: var(--bg-dark); border-top: 1px solid var(--border-color);">
        <div class="container text-center text-secondary">
            <p class="mb-0">&copy; <span id="currentYear"></span> Smart Parking IOT. Crafted for a Smarter Future.</p>
        </div>
    </footer>

    <!-- Modals -->
    <div class="modal fade" id="addModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered"><div class="modal-content">
            <div class="modal-header"><h5 class="modal-title">Tambah Mahasiswa</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
            <div class="modal-body">
                <form id="addForm">
                    <div class="mb-3"><label class="form-label">NIM</label><input type="text" class="form-control" id="nim" required></div>
                    <div class="mb-3"><label class="form-label">Nama</label><input type="text" class="form-control" id="nama" required></div>
                    <div class="mb-3"><label class="form-label">Jurusan</label><input type="text" class="form-control" id="jurusan" required></div>
                    <button type="submit" class="btn btn-primary w-100">Simpan</button>
                </form>
            </div>
        </div></div>
    </div>

    <div class="modal fade" id="editModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered"><div class="modal-content">
            <div class="modal-header"><h5 class="modal-title">Edit Mahasiswa</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
            <div class="modal-body">
                <form id="editForm">
                    <input type="hidden" id="edit_nim">
                    <div class="mb-3"><label class="form-label">NIM</label><input type="text" class="form-control" id="view_nim" readonly></div>
                    <div class="mb-3"><label class="form-label">Nama</label><input type="text" class="form-control" id="edit_nama" required></div>
                    <div class="mb-3"><label class="form-label">Jurusan</label><input type="text" class="form-control" id="edit_jurusan" required></div>
                    <button type="submit" class="btn btn-primary w-100">Update</button>
                </form>
            </div>
        </div></div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

    <script>
        // Navigation System
        function showSection(sectionId) {
            // Hide all sections
            const sections = document.querySelectorAll('.content-section');
            sections.forEach(section => {
                section.classList.remove('active');
            });

            // Show selected section
            const targetSection = document.getElementById(sectionId);
            if (targetSection) {
                targetSection.classList.add('active');
            }

            // Update navbar active state
            const navLinks = document.querySelectorAll('.nav-link');
            navLinks.forEach(link => {
                link.classList.remove('active');
            });

            // Close mobile navbar if open
            const navbarCollapse = document.getElementById('navbarNav');
            if (navbarCollapse.classList.contains('show')) {
                const bsCollapse = new bootstrap.Collapse(navbarCollapse);
                bsCollapse.hide();
            }
        }
    </script>

<script type="module">
    import { initializeApp } from "https://www.gstatic.com/firebasejs/10.8.0/firebase-app.js";
    import { getDatabase, ref, get, set, remove, child, onValue } from "https://www.gstatic.com/firebasejs/10.8.0/firebase-database.js";

    const firebaseConfig = {
        apiKey: "AIzaSyBW3o5yLi2KL6ukMvBAasmFLU9YHN2IpY8",
        authDomain: "steinlie-realtime.firebaseapp.com",
        databaseURL: "https://steinlie-realtime-default-rtdb.asia-southeast1.firebasedatabase.app",
        projectId: "steinlie-realtime",
        storageBucket: "steinlie-realtime.appspot.com",
        messagingSenderId: "324833723114",
        appId: "1:324833723114:web:e0f40337c88722f20c0d93",
    };

    const app = initializeApp(firebaseConfig);
    const db = getDatabase(app);

    // --- Global Functions & Helpers ---
    window.updateJadwal = updateJadwal;
    window.editMahasiswa = editMahasiswa;
    window.deleteMahasiswa = deleteMahasiswa;

    const loadingSpinner = '<tr><td colspan="4"><div class="spinner"></div></td></tr>';
    const noDataFound = (cols, text) => `<tr><td colspan="${cols}" class="text-center py-5">${text}</td></tr>`;

    // --- Mahasiswa Management ---
    const mahasiswaRef = ref(db, 'mahasiswa');
    const mhsListEl = document.getElementById('mahasiswaList');

    async function loadMahasiswaData() {
        mhsListEl.innerHTML = loadingSpinner;
        try {
            const snapshot = await get(mahasiswaRef);
            const data = snapshot.val();
            let html = '';
            if (data) {
                Object.entries(data).forEach(([nim, mhs]) => {
                    html += `<tr>
                        <td><p class="mb-0">${nim}</p></td><td><p class="mb-0">${mhs.nama}</p></td>
                        <td><p class="mb-0">${mhs.jurusan}</p></td>
                        <td>
                            <button class="btn btn-info btn-sm" onclick="editMahasiswa('${nim}', '${mhs.nama}', '${mhs.jurusan}')"><i class="fas fa-edit"></i></button>
                            <button class="btn btn-danger btn-sm" onclick="deleteMahasiswa('${nim}')"><i class="fas fa-trash"></i></button>
                        </td></tr>`;
                });
            } else { html = noDataFound(4, "Tidak ada data mahasiswa."); }
            mhsListEl.innerHTML = html;
        } catch (error) { console.error(error); mhsListEl.innerHTML = noDataFound(4, "Gagal memuat data."); }
    }

    document.getElementById('addForm').addEventListener('submit', async (e) => {
        e.preventDefault();
        const nim = document.getElementById('nim').value.trim();
        const nama = document.getElementById('nama').value.trim();
        const jurusan = document.getElementById('jurusan').value.trim();
        if (!nim || !nama || !jurusan) return;

        const nimRef = child(mahasiswaRef, nim);
        const snapshot = await get(nimRef);
        if (snapshot.exists()) {
            Swal.fire({ icon: 'error', title: 'Gagal', text: 'NIM sudah terdaftar!' });
            return;
        }
        await set(nimRef, { nama, jurusan });
        document.getElementById('addForm').reset();
        bootstrap.Modal.getInstance(document.getElementById('addModal')).hide();
        loadMahasiswaData();
        Swal.fire({ icon: 'success', title: 'Berhasil!', text: 'Data mahasiswa ditambahkan.', timer: 1500, showConfirmButton: false });
    });

    function editMahasiswa(nim, nama, jurusan) {
        document.getElementById('edit_nim').value = nim;
        document.getElementById('view_nim').value = nim;
        document.getElementById('edit_nama').value = nama;
        document.getElementById('edit_jurusan').value = jurusan;
        new bootstrap.Modal(document.getElementById('editModal')).show();
    }

    document.getElementById('editForm').addEventListener('submit', async (e) => {
        e.preventDefault();
        const nim = document.getElementById('edit_nim').value;
        const nama = document.getElementById('edit_nama').value.trim();
        const jurusan = document.getElementById('edit_jurusan').value.trim();
        if (!nama || !jurusan) return;
        await set(child(mahasiswaRef, nim), { nama, jurusan });
        bootstrap.Modal.getInstance(document.getElementById('editModal')).hide();
        loadMahasiswaData();
        Swal.fire({ icon: 'success', title: 'Berhasil!', text: 'Data mahasiswa diupdate.', timer: 1500, showConfirmButton: false });
    });

    function deleteMahasiswa(nim) {
        Swal.fire({ title: 'Anda Yakin?', text: "Data ini akan dihapus permanen!", icon: 'warning', showCancelButton: true, confirmButtonColor: '#d33', confirmButtonText: 'Ya, Hapus!'})
        .then(async (result) => {
            if (result.isConfirmed) {
                await remove(child(mahasiswaRef, nim));
                loadMahasiswaData();
                Swal.fire('Dihapus!', 'Data mahasiswa berhasil dihapus.', 'success');
            }
        });
    }

    // --- Parking Management ---
    function setupParkingListeners(type) {
        const parkirRef = ref(db, `parkir/${type}`);
        const tempatParkirRef = ref(db, `tempat_parkir/${type}`);
        const listEl = document.getElementById(`${type.toLowerCase()}List`);
        const slotListEl = document.getElementById(`slot${type}List`);
        const iconClass = type === 'Motor' ? 'fa-motorcycle' : 'fa-car';

        listEl.innerHTML = loadingSpinner;
        slotListEl.innerHTML = '<div class="col-12"><div class="spinner"></div></div>';

        onValue(parkirRef, (snapshot) => {
            const data = snapshot.val() || {};
            let html = '', entries = [];
            Object.keys(data).forEach(date => Object.keys(data[date]).forEach(time => entries.push({ date, time, ...data[date][time] })));
            entries.sort((a, b) => new Date(`${b.date} ${b.time}`) - new Date(`${a.date} ${a.time}`));
            if (entries.length) {
                entries.forEach(e => { html += `<tr><td>${e.date} ${e.time}</td><td>${e.nim}</td><td>${e.nama}</td><td>${e.akses}</td></tr>`; });
            } else { html = noDataFound(4, "Tidak ada riwayat parkir."); }
            listEl.innerHTML = html;
        });

        onValue(tempatParkirRef, (snapshot) => {
            const data = snapshot.val() || {};
            let html = '';
            for (let i = 1; i <= 4; i++) {
                const status = (data['slot' + i] || 'available');
                const isAvailable = status === 'available';
                html += `<div class="col-6 col-md-3">
                    <div class="slot-card ${isAvailable ? 'available' : 'occupied'}">
                        <i class="fas ${iconClass} slot-icon"></i>
                        <div class="slot-number">Slot ${i}</div>
                        <p class="slot-status mb-0">${isAvailable ? 'Kosong' : 'Terisi'}</p>
                    </div></div>`;
            }
            slotListEl.innerHTML = html;
        });
    }

    const chartColors = {
        primary: '#1A2980',
        secondary: '#26D0CE',
        success: '#10b981',
        warning: '#f59e0b',
        danger: '#ef4444',
        info: '#3b82f6'
    };

    // Dashboard Mobil
    function setupDashboardMobil() {
        const slotRef = ref(db, 'tempat_parkir/Mobil');
        const jadwalRef = ref(db, 'jadwal_sistem/mobil');
        const parkirRef = ref(db, 'parkir/Mobil');

        const slotGrid = document.getElementById('slotGridMobil');
        const occupancyRateEl = document.getElementById('occupancyRateMobil');
        const progressBar = document.getElementById('progressBarMobil');
        const jamOperasionalEl = document.getElementById('jamOperasionalMobil');
        const indicator = document.getElementById('statusIndicatorMobil');
        const todayEntryEl = document.getElementById('todayEntryMobil');

        const accessChartCanvas = document.getElementById('accessChartMobil');
        const accessChartCtx = accessChartCanvas ? accessChartCanvas.getContext('2d') : null;
        const departmentChartCanvas = document.getElementById('departmentChartMobil');
        const departmentChartCtx = departmentChartCanvas ? departmentChartCanvas.getContext('2d') : null;

        const recentActivityContainer = document.getElementById('recentActivityMobil');

        let accessChart;
        let departmentChart;

        // Quick Stats
        const availableSlotEl = document.getElementById('currentAvailableSlotsMobil');
        const peakHourEl = document.getElementById('peakHourMobil');
        const topDepartmentEl = document.getElementById('topDepartmentMobil');
        const trafficComparisonEl = document.getElementById('trafficComparisonMobil');
        const topAccessEl = document.getElementById('topAccessMobil');
        const lastEntryTimeEl = document.getElementById('lastEntryTimeMobil');

        // Tampilkan spinner loading
        slotGrid.innerHTML = `
            <div class="d-flex justify-content-center align-items-center flex-column text-white">
                <div class="spinner-border mb-2" role="status"></div>
                <div>Memuat data slot parkir...</div>
            </div>
        `;

        if (recentActivityContainer) {
            recentActivityContainer.innerHTML = `
                <div class="d-flex justify-content-center align-items-center flex-column text-white py-4">
                    <div class="spinner-border mb-2" role="status"></div>
                    <div>Memuat aktivitas terbaru...</div>
                </div>
            `;
        }

        // --- Listener Slot Parkir ---
        onValue(slotRef, (snapshot) => {
            const data = snapshot.val();
            slotGrid.innerHTML = ''; // Bersihkan

            if (!data) {
                slotGrid.innerHTML = `
                    <div class="d-flex justify-content-center align-items-center flex-column text-white">
                        <p class="text-white mb-0">⚠️ Data slot tidak ditemukan.</p>
                    </div>
                `;
                updateOccupancyStatsMobil(0, 0);
                return;
            }

            let occupied = 0, total = 0;
            Object.entries(data).forEach(([slotKey, status], index) => {
                const slotDiv = document.createElement('div');
                slotDiv.classList.add('parking-slot', status);
                slotDiv.id = slotKey;

                const isOccupied = status === 'occupied';
                if (isOccupied) occupied++;
                total++;

                slotDiv.innerHTML = `
                    <i class="fas fa-car slot-icon" aria-hidden="true"></i>
                    <div class="slot-info">Slot ${index + 1}</div>
                    <div class="slot-status">${isOccupied ? 'Terisi' : 'Kosong'}</div>
                `;

                slotGrid.appendChild(slotDiv);
            });

            updateOccupancyStatsMobil(occupied, total);
            // Quick Stats Slot Tersedia
            if (availableSlotEl) availableSlotEl.textContent = (total - occupied).toString();
        }, () => {
            slotGrid.innerHTML = `<p class="text-white">❌ Gagal memuat data slot parkir.</p>`;
        });

        if (jamOperasionalEl) {
            jamOperasionalEl.innerHTML = `
                <div class="d-flex align-items-center gap-2 text-white">
                    <div class="spinner-border spinner-border-sm" role="status"></div>
                    <div>Memuat jadwal...</div>
                </div>
            `;
        }

        // --- Listener Jadwal Operasional ---
        onValue(jadwalRef, (snapshot) => {
            const data = snapshot.val();
            const jamMulai = data?.jam_mulai ?? '06:00';
            const jamSelesai = data?.jam_selesai ?? '18:00';
            const status = data?.operasional ?? 'off';

            window.jamOperasionalMulai = jamMulai;
            window.jamOperasionalSelesai = jamSelesai;

            if (jamOperasionalEl) {
                jamOperasionalEl.textContent = `${jamMulai} - ${jamSelesai} WIB`;
            }
            if (indicator) {
                indicator.classList.remove('status-online', 'status-offline');
                indicator.classList.add(status === 'on' ? 'status-online' : 'status-offline');
            }
        });

        // --- Listener Kendaraan Masuk Hari Ini ---
        const today = new Date().toISOString().slice(0, 10);
        if (todayEntryEl) todayEntryEl.textContent = '...';

        onValue(parkirRef, (snapshot) => {
            const data = snapshot.val() || {};
            let count = 0;
            let weeklyCount = [0, 0, 0, 0, 0, 0, 0];
            let hourlyMap = {};
            let aksesCount = {
                ktm: 0,
                petugas: 0
            };
            let aksesData = {};
            let jurusanCount = {};
            let yesterdayCount = 0;
            const yesterday = new Date(Date.now() - 86400000).toISOString().slice(0, 10);
            let lastEntryTime = '';

            Object.values(data).forEach(entry => {
                const isFilled = (value) => value && value.trim() !== '' && value !== '-';
                const isValid = isFilled(entry.nama) && isFilled(entry.nim) && isFilled(entry.jurusan);
                const isToday = entry.tanggal === today;

                if (isToday && isValid) {
                    count++;

                    const jam = entry.waktu?.slice(0, 2);
                    if (jam) {
                        hourlyMap[jam] = (hourlyMap[jam] || 0) + 1;
                    }

                    if (entry.waktu) {
                        if (!lastEntryTime || entry.waktu > lastEntryTime) {
                            lastEntryTime = entry.waktu;
                        }
                    }
                }

                if (entry.tanggal && isValid) {
                    const dayIdx = new Date(entry.tanggal).getDay();
                    const index = dayIdx === 0 ? 6 : dayIdx - 1;
                    weeklyCount[index]++;
                }

                if (isValid) {
                    const akses = entry.akses?.toLowerCase();
                    if (akses === 'ktm') aksesCount.ktm++;
                    else if (akses === 'petugas') aksesCount.petugas++;
                    
                    aksesData[akses] = (aksesData[akses] || 0) + 1;

                    const jurusan = entry.jurusan.trim();
                    jurusanCount[jurusan] = (jurusanCount[jurusan] || 0) + 1;
                }

                if (entry.tanggal === yesterday && isValid) {
                    yesterdayCount++;
                }
            });

            // Kendaaran Masuk Hari Ini
            if (todayEntryEl) todayEntryEl.textContent = count;

            // Jam Paling Ramai
            if (peakHourEl) {
                const sortedHours = Object.entries(hourlyMap).sort((a, b) => b[1] - a[1]);
                const jamRamai = sortedHours[0]?.[0] || '--';
                peakHourEl.textContent = `${jamRamai}:00`;
            }

            // Kendaraan Masuk Terakhir
            if (lastEntryTimeEl) {
                lastEntryTimeEl.textContent = lastEntryTime ? lastEntryTime.slice(0, 5) : '--:--';
            }

            // Update Quick Stats
            // Top Jurusan
            if (topDepartmentEl) {
                const sorted = Object.entries(jurusanCount).sort((a, b) => b[1] - a[1]);
                topDepartmentEl.textContent = sorted[0]?.[0] || '-';
            }

            // Lalu Lintas vs Kemarin
            if (trafficComparisonEl) {
                let percentage = 0;
                if (yesterdayCount > 0) {
                    percentage = (((count - yesterdayCount) / yesterdayCount) * 100).toFixed(1);
                } else if (count > 0) {
                    percentage = 100;
                }
                const prefix = percentage >= 0 ? '+' : '';
                trafficComparisonEl.textContent = `${prefix}${percentage}%`;
            }

            // Akses Terbanyak
            if (topAccessEl) {
                const label = aksesCount.ktm > aksesCount.petugas ? 
                    `KTM (${aksesCount.ktm})` : 
                    `Petugas (${aksesCount.petugas})`;
                topAccessEl.textContent = label;
            }

            // Update Department Chart
            if (departmentChartCtx) {
                const sorted = Object.entries(jurusanCount).sort((a, b) => b[1] - a[1]);
                const labels = sorted.map(([jur]) => jur);
                const values = sorted.map(([, val]) => val);
                const colors = labels.map((_, i) => [
                    chartColors.primary,
                    chartColors.secondary,
                    chartColors.success,
                    chartColors.warning,
                    chartColors.info,
                    chartColors.danger
                ][i % 6]);

                if (!departmentChart) {
                    departmentChart = new Chart(departmentChartCtx, {
                        type: 'bar',
                        data: {
                            labels,
                            datasets: [{
                                label: 'Jumlah Kendaraan',
                                data: values,
                                backgroundColor: colors,
                                borderColor: colors,
                                borderWidth: 1,
                                borderRadius: 5
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: { display: false }
                            },
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    grid: {
                                        color: 'rgba(255,255,255,0.08)',
                                        drawBorder: false
                                    },
                                    ticks: { color: '#a0aec0' }
                                },
                                x: {
                                    grid: {
                                        color: 'rgba(255,255,255,0.08)',
                                        drawBorder: false
                                    },
                                    ticks: { color: '#a0aec0' }
                                }
                            }
                        }
                    });
                } else {
                    window.departmentChart.data.labels = labels;
                    window.departmentChart.data.datasets[0].data = values;
                    window.departmentChart.update();
                }
            }

            window.latestHourlyMap = hourlyMap;
            window.latestWeeklyCount = weeklyCount;

            if (window.currentChartMode === 'weekly') {
                updateWeeklyChartMobil(weeklyCount);
            } else {
                updateHourlyChartMobil(hourlyMap);
            }

            if (accessChartCtx) {
                if (!accessChart) {
                    // const total = aksesCount.ktm + aksesCount.petugas;
                    // const persenKTM = total ? ((aksesCount.ktm / total) * 100).toFixed(1) : 0;
                    // const persenPetugas = total ? ((aksesCount.petugas / total) * 100).toFixed(1) : 0;

                    const aksesLabels = Object.keys(aksesData);
                    const aksesValues = Object.values(aksesData);
                    const total = aksesValues.reduce((sum, val) => sum + val, 0);
                    const backgroundColors = aksesLabels.map((_, i) => [
                        chartColors.info,
                        chartColors.warning,
                        chartColors.primary,
                        chartColors.danger,
                        chartColors.success
                    ][i % 5]);

                    // Persentase dari masing-masing akses
                    const aksesPercentages = aksesValues.map(val =>
                        total ? ((val / total) * 100).toFixed(1) : 0
                    );

                    accessChart = new Chart(accessChartCtx, {
                        type: 'doughnut',
                        data: {
                            labels: aksesLabels.map(label => label.toUpperCase()),
                            datasets: [{
                                data: aksesPercentages,
                                backgroundColor: [chartColors.info, chartColors.warning],
                                hoverOffset: 5
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            layout: { padding: 5 },
                            plugins: {
                                legend: {
                                    position: 'bottom',
                                    labels: {
                                        color: '#a0aec0',
                                        font: { size: 12 },
                                        padding: 30
                                    }
                                },
                                tooltip: {
                                    padding: 12,
                                    boxPadding: 6,
                                    cornerRadius: 6,
                                    titleFont: { size: 13 },
                                    bodyFont: { size: 13 },
                                    callbacks: {
                                        label: function(context) {
                                            let label = context.label || '';
                                            if (label) label += ': ';
                                            if (context.parsed !== null) label += context.parsed + '%';
                                            return label;
                                        }
                                    }
                                }
                            },
                        }
                    });
                } else {
                    accessChart.data.datasets[0].data = [aksesCount.ktm, aksesCount.petugas];
                    accessChart.update();
                }
            }   
        }, () => {
            if (todayEntryEl) todayEntryEl.textContent = '0';
        });

        // --- Listener Aktivitas Terbaru ---
        if (recentActivityContainer) {
            onValue(parkirRef, (snapshot) => {
                const data = snapshot.val();
                if (!data) return;

                const isFilled = (value) => value && value.trim() !== '' && value !== '-';
                const isValid = (entry) => isFilled(entry.nama) && isFilled(entry.nim) && isFilled(entry.jurusan);

                const sorted = Object.values(data).filter(isValid).sort((a, b) => {
                    const dateTimeA = `${a.tanggal} ${a.waktu}`;
                    const dateTimeB = `${b.tanggal} ${b.waktu}`;

                    const dateA = new Date(dateTimeA);
                    const dateB = new Date(dateTimeB);

                    return dateB.getTime() - dateA.getTime();
                }).slice(0, 14);

                recentActivityContainer.innerHTML = sorted.map((entry, index) => {
                    const aksesUpper = (entry.akses || '').toUpperCase();

                    const borderClass = (index < sorted.length - 1) ? 'border-bottom border-secondary' : '';

                    return `
                        <div class="activity-item d-flex align-items-center py-2 px-3 ${borderClass}">
                            <div class="activity-icon entry me-3">
                            <i class="bi bi-arrow-up"></i>
                        </div>
                        <div>
                            <h6 class="text-white mb-1">${entry.nama}</h6>
                            <small class="text-secondary">${entry.nim} • ${entry.jurusan} • ${entry.waktu} • ${aksesUpper}</small>
                        </div>
                    </div>`;
                }).join('');
            });
        }

        function updateOccupancyStatsMobil(occupied, total) {
            const rate = total > 0 ? Math.round((occupied / total) * 100) : 0;
            if (occupancyRateEl) occupancyRateEl.textContent = `${rate}%`;
            if (progressBar) progressBar.style.width = `${rate}%`;
        }

        window.toggleChart = function (mode) {
            document.querySelectorAll('.btn-group .btn').forEach(btn => btn.classList.remove('active'));
            document.querySelector(`.btn[onclick="toggleChart('${mode}')"]`)?.classList.add('active');

            window.currentChartMode = mode;
            if (mode === 'hourly') {
                updateHourlyChartMobil(window.latestHourlyMap || {});
            } else if (mode === 'weekly') {
                updateWeeklyChartMobil(window.latestWeeklyCount || []);
            }
        };
    }

    function updateWeeklyChartMobil(data) {
        if (window.usageChartMobilInstance) {
            window.usageChartMobilInstance.data = {
                labels: ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'],
                datasets: [{
                    label: 'Total Masuk',
                    data,
                    backgroundColor: [
                        chartColors.secondary,
                        chartColors.primary,
                        chartColors.success,
                        chartColors.warning,
                        chartColors.info,
                        `${chartColors.secondary}AA`,
                        `${chartColors.primary}AA`
                    ],
                    borderColor: [
                        chartColors.secondary,
                        chartColors.primary,
                        chartColors.success,
                        chartColors.warning,
                        chartColors.info,
                        chartColors.secondary,
                        chartColors.primary
                    ],
                    borderWidth: 1
                }]
            };
            window.usageChartMobilInstance.options.scales.y.max = Math.max(...data, 5) + 2;
            window.usageChartMobilInstance.type = 'bar';
            window.usageChartMobilInstance.update();
        }
    }

    function updateHourlyChartMobil(hourlyMap) {
        if (window.usageChartMobilInstance) {
            const labels = [];
            const values = [];

            const startHour = parseInt(('06:00').split(':')[0]);
            const endHour = parseInt(('24:00').split(':')[0]);

            // const startHour = parseInt((window.jamOperasionalMulai || '06:00').split(':')[0]);
            // const endHour = parseInt((window.jamOperasionalSelesai || '18:00').split(':')[0]);

            for (let hour = startHour; hour <= endHour; hour++) {
                const label = `${hour.toString().padStart(2, '0')}:00`;
                labels.push(label);
                values.push(hourlyMap[hour.toString().padStart(2, '0')] || 0);
            }

            window.usageChartMobilInstance.data = {
                labels,
                datasets: [{
                    label: 'Mobil Parkir',
                    data: values,
                    borderColor: chartColors.secondary,
                    backgroundColor: (context) => {
                        const chart = context.chart;
                        const {ctx, chartArea} = chart;
                        if (!chartArea) return null;
                        const gradient = ctx.createLinearGradient(0, chartArea.bottom, 0, chartArea.top);
                        gradient.addColorStop(0, `${chartColors.secondary}00`);
                        gradient.addColorStop(1, `${chartColors.secondary}40`);
                        return gradient;
                    },
                    fill: true,
                    tension: 0.4,
                    borderWidth: 3,
                    pointBackgroundColor: chartColors.secondary,
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                    pointRadius: 6,
                    pointHoverRadius: 8,
                }]
            };

            window.usageChartMobilInstance.options.scales.y.max = Math.max(...values, 5);
            window.usageChartMobilInstance.type = 'line';
            window.usageChartMobilInstance.update();
        }
    }

    function setupDashboardMotor() {
        // Referensi database untuk Motor
        const slotRef = ref(db, 'tempat_parkir/Motor');
        const jadwalRef = ref(db, 'jadwal_sistem/motor');
        const parkirRef = ref(db, 'parkir/Motor');

        // Elemen HTML untuk Motor
        const slotGrid = document.getElementById('slotGridMotor');
        const occupancyRateEl = document.getElementById('occupancyRateMotor');
        const progressBar = document.getElementById('progressBarMotor');
        const jamOperasionalEl = document.getElementById('jamOperasionalMotor');
        const indicator = document.getElementById('statusIndicatorMotor');
        const todayEntryEl = document.getElementById('todayEntryMotor');

        const accessChartCanvas = document.getElementById('accessChartMotor');
        const accessChartCtx = accessChartCanvas ? accessChartCanvas.getContext('2d') : null;
        const departmentChartCanvas = document.getElementById('departmentChartMotor');
        const departmentChartCtx = departmentChartCanvas ? departmentChartCanvas.getContext('2d') : null;

        const recentActivityContainer = document.getElementById('recentActivityMotor');

        let accessChartMotor; // Perhatikan perubahan nama variabel chart
        let departmentChartMotor; // Perhatikan perubahan nama variabel chart

        // Quick Stats untuk Motor
        const availableSlotEl = document.getElementById('currentAvailableSlotsMotor');
        const peakHourEl = document.getElementById('peakHourMotor');
        const topDepartmentEl = document.getElementById('topDepartmentMotor');
        const trafficComparisonEl = document.getElementById('trafficComparisonMotor');
        const topAccessEl = document.getElementById('topAccessMotor');
        const lastEntryTimeEl = document.getElementById('lastEntryTimeMotor');

        // Tampilkan spinner loading
        if (slotGrid) { // Tambahkan pengecekan jika elemen ada
            slotGrid.innerHTML = `
                <div class="d-flex justify-content-center align-items-center flex-column text-white">
                    <div class="spinner-border mb-2" role="status"></div>
                    <div>Memuat data slot parkir motor...</div>
                </div>
            `;
        }

        if (recentActivityContainer) {
            recentActivityContainer.innerHTML = `
                <div class="d-flex justify-content-center align-items-center flex-column text-white py-4">
                    <div class="spinner-border mb-2" role="status"></div>
                    <div>Memuat aktivitas terbaru motor...</div>
                </div>
            `;
        }

        // --- Listener Slot Parkir Motor ---
        onValue(slotRef, (snapshot) => {
            const data = snapshot.val();
            if (slotGrid) slotGrid.innerHTML = ''; // Bersihkan

            if (!data) {
                if (slotGrid) {
                    slotGrid.innerHTML = `
                        <div class="d-flex justify-content-center align-items-center flex-column text-white">
                            <p class="text-white mb-0">⚠️ Data slot motor tidak ditemukan.</p>
                        </div>
                    `;
                }
                updateOccupancyStatsMotor(0, 0); // Panggil fungsi update untuk Motor
                return;
            }

            let occupied = 0, total = 0;
            Object.entries(data).forEach(([slotKey, status], index) => {
                const slotDiv = document.createElement('div');
                slotDiv.classList.add('parking-slot', status);
                slotDiv.id = slotKey;

                const isOccupied = status === 'occupied';
                if (isOccupied) occupied++;
                total++;

                slotDiv.innerHTML = `
                    <i class="fas fa-motorcycle slot-icon" aria-hidden="true"></i> <div class="slot-info">Slot ${index + 1}</div>
                    <div class="slot-status">${isOccupied ? 'Terisi' : 'Kosong'}</div>
                `;

                if (slotGrid) slotGrid.appendChild(slotDiv);
            });

            updateOccupancyStatsMotor(occupied, total); // Panggil fungsi update untuk Motor
            // Quick Stats Slot Tersedia
            if (availableSlotEl) availableSlotEl.textContent = (total - occupied).toString();
        }, () => {
            if (slotGrid) slotGrid.innerHTML = `<p class="text-white">❌ Gagal memuat data slot parkir motor.</p>`;
        });

        if (jamOperasionalEl) {
            jamOperasionalEl.innerHTML = `
                <div class="d-flex align-items-center gap-2 text-white">
                    <div class="spinner-border spinner-border-sm" role="status"></div>
                    <div>Memuat jadwal...</div>
                </div>
            `;
        }

        // --- Listener Jadwal Operasional Motor ---
        onValue(jadwalRef, (snapshot) => {
            const data = snapshot.val();
            const jamMulai = data?.jam_mulai ?? '06:00';
            const jamSelesai = data?.jam_selesai ?? '18:00';
            const status = data?.operasional ?? 'off';

            window.jamOperasionalMulaiMotor = jamMulai; // Simpan di window scope dengan nama unik
            window.jamOperasionalSelesaiMotor = jamSelesai; // Simpan di window scope dengan nama unik

            if (jamOperasionalEl) {
                jamOperasionalEl.textContent = `${jamMulai} - ${jamSelesai} WIB`;
            }
            if (indicator) {
                indicator.classList.remove('status-online', 'status-offline');
                indicator.classList.add(status === 'on' ? 'status-online' : 'status-offline');
            }
        });

        // --- Listener Kendaraan Masuk Hari Ini Motor ---
        const today = new Date().toISOString().slice(0, 10);
        if (todayEntryEl) todayEntryEl.textContent = '...';

        onValue(parkirRef, (snapshot) => {
            const data = snapshot.val() || {};
            let count = 0;
            let weeklyCount = [0, 0, 0, 0, 0, 0, 0];
            let hourlyMap = {};
            let aksesCount = {
                ktm: 0,
                petugas: 0
            };
            let aksesData = {};
            let jurusanCount = {};
            let yesterdayCount = 0;
            const yesterday = new Date(Date.now() - 86400000).toISOString().slice(0, 10);
            let lastEntryTime = '';

            Object.values(data).forEach(entry => {
                const isFilled = (value) => value && value.trim() !== '' && value !== '-';
                const isValid = isFilled(entry.nama) && isFilled(entry.nim) && isFilled(entry.jurusan);
                const isToday = entry.tanggal === today;

                if (isToday && isValid) {
                    count++;

                    const jam = entry.waktu?.slice(0, 2);
                    if (jam) {
                        hourlyMap[jam] = (hourlyMap[jam] || 0) + 1;
                    }

                    if (entry.waktu) {
                        if (!lastEntryTime || entry.waktu > lastEntryTime) {
                            lastEntryTime = entry.waktu;
                        }
                    }
                }

                if (entry.tanggal && isValid) {
                    const dayIdx = new Date(entry.tanggal).getDay();
                    const index = dayIdx === 0 ? 6 : dayIdx - 1; // Senin (1) -> 0, Minggu (0) -> 6
                    weeklyCount[index]++;
                }

                if (isValid) {
                    const akses = entry.akses?.toLowerCase();
                    if (akses === 'ktm') aksesCount.ktm++;
                    else if (akses === 'petugas') aksesCount.petugas++;
                    
                    // Kumpulkan data akses secara dinamis (untuk labels di chart)
                    aksesData[akses] = (aksesData[akses] || 0) + 1;

                    const jurusan = entry.jurusan.trim();
                    jurusanCount[jurusan] = (jurusanCount[jurusan] || 0) + 1;
                }

                if (entry.tanggal === yesterday && isValid) {
                    yesterdayCount++;
                }
            });

            // Kendaaran Masuk Hari Ini
            if (todayEntryEl) todayEntryEl.textContent = count;

            // Jam Paling Ramai
            if (peakHourEl) {
                const sortedHours = Object.entries(hourlyMap).sort((a, b) => b[1] - a[1]);
                const jamRamai = sortedHours[0]?.[0] || '--';
                peakHourEl.textContent = `${jamRamai}:00`;
            }

             // Kendaraan Masuk Terakhir
            if (lastEntryTimeEl) {
                lastEntryTimeEl.textContent = lastEntryTime ? lastEntryTime.slice(0, 5) : '--:--';
            }

            // Update Quick Stats Motor
            // Top Jurusan
            if (topDepartmentEl) {
                const sorted = Object.entries(jurusanCount).sort((a, b) => b[1] - a[1]);
                topDepartmentEl.textContent = sorted[0]?.[0] || '-';
            }

            // Lalu Lintas vs Kemarin
            if (trafficComparisonEl) {
                let percentage = 0;
                if (yesterdayCount > 0) {
                    percentage = (((count - yesterdayCount) / yesterdayCount) * 100).toFixed(1);
                } else if (count > 0) {
                    percentage = 100;
                }
                const prefix = percentage >= 0 ? '+' : '';
                trafficComparisonEl.textContent = `${prefix}${percentage}%`;
            }

            // Akses Terbanyak
            if (topAccessEl) {
                const label = aksesCount.ktm > aksesCount.petugas ? 
                    `KTM (${aksesCount.ktm})` : 
                    `Petugas (${aksesCount.petugas})`;
                topAccessEl.textContent = label;
            }

            // Update Department Chart Motor
            if (departmentChartCtx) {
                const sorted = Object.entries(jurusanCount).sort((a, b) => b[1] - a[1]);
                const labels = sorted.map(([jur]) => jur);
                const values = sorted.map(([, val]) => val);
                const colors = labels.map((_, i) => [
                    chartColors.primary,
                    chartColors.secondary,
                    chartColors.success,
                    chartColors.warning,
                    chartColors.info,
                    chartColors.danger
                ][i % 6]);

                if (!departmentChartMotor) { // Gunakan departmentChartMotor
                    departmentChartMotor = new Chart(departmentChartCtx, {
                        type: 'bar',
                        data: {
                            labels,
                            datasets: [{
                                label: 'Jumlah Kendaraan',
                                data: values,
                                backgroundColor: colors,
                                borderColor: colors,
                                borderWidth: 1,
                                borderRadius: 5
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: { display: false }
                            },
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    grid: {
                                        color: 'rgba(255,255,255,0.08)',
                                        drawBorder: false
                                    },
                                    ticks: { color: '#a0aec0' }
                                },
                                x: {
                                    grid: {
                                        color: 'rgba(255,255,255,0.08)',
                                        drawBorder: false
                                    },
                                    ticks: { color: '#a0aec0' }
                                }
                            }
                        }
                    });
                } else {
                    departmentChartMotor.data.labels = labels; // Update departmentChartMotor
                    departmentChartMotor.data.datasets[0].data = values; // Update departmentChartMotor
                    departmentChartMotor.update(); // Update departmentChartMotor
                }
            }

            // Simpan data terbaru di window scope dengan nama unik
            window.latestHourlyMapMotor = hourlyMap;
            window.latestWeeklyCountMotor = weeklyCount;

            // Perbarui chart utama (hourly/weekly) untuk Motor
            if (window.currentChartModeMotor === 'weekly') { // Gunakan currentChartModeMotor
                updateWeeklyChartMotor(weeklyCount);
            } else {
                updateHourlyChartMotor(hourlyMap);
            }

            // Update Access Chart Motor
            if (accessChartCtx) {
                if (!accessChartMotor) { // Gunakan accessChartMotor
                    const aksesLabels = Object.keys(aksesData);
                    const aksesValues = Object.values(aksesData);
                    const total = aksesValues.reduce((sum, val) => sum + val, 0);
                    const backgroundColors = aksesLabels.map((_, i) => [
                        chartColors.info,
                        chartColors.warning,
                        chartColors.primary,
                        chartColors.danger,
                        chartColors.success
                    ][i % 5]);

                    // Persentase dari masing-masing akses
                    const aksesPercentages = aksesValues.map(val =>
                        total ? parseFloat(((val / total) * 100).toFixed(1)) : 0
                    );

                    accessChartMotor = new Chart(accessChartCtx, { // Buat accessChartMotor
                        type: 'doughnut',
                        data: {
                            labels: aksesLabels.map(label => label.toUpperCase()),
                            datasets: [{
                                data: aksesPercentages,
                                backgroundColor: backgroundColors, // Gunakan backgroundColors yang dinamis
                                hoverOffset: 5
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            layout: { padding: 5 },
                            plugins: {
                                legend: {
                                    position: 'bottom',
                                    labels: {
                                        color: '#a0aec0',
                                        font: { size: 12 },
                                        padding: 30
                                    }
                                },
                                tooltip: {
                                    padding: 12,
                                    boxPadding: 6,
                                    cornerRadius: 6,
                                    titleFont: { size: 13 },
                                    bodyFont: { size: 13 },
                                    callbacks: {
                                        label: function(context) {
                                            let label = context.label || '';
                                            if (label) label += ': ';
                                            if (context.parsed !== null) label += context.parsed + '%';
                                            return label;
                                        }
                                    }
                                }
                            },
                        }
                    });
                } else {
                    // Update data untuk accessChartMotor
                    const aksesLabels = Object.keys(aksesData);
                    const aksesValues = Object.values(aksesData);
                    const total = aksesValues.reduce((sum, val) => sum + val, 0);
                    const aksesPercentages = aksesValues.map(val =>
                        total ? parseFloat(((val / total) * 100).toFixed(1)) : 0
                    );

                    accessChartMotor.data.labels = aksesLabels.map(label => label.toUpperCase());
                    accessChartMotor.data.datasets[0].data = aksesPercentages;
                    accessChartMotor.update();
                }
            }   
        }, () => {
            if (todayEntryEl) todayEntryEl.textContent = '0';
        });

        // --- Listener Aktivitas Terbaru Motor ---
        if (recentActivityContainer) {
            onValue(parkirRef, (snapshot) => {
                const data = snapshot.val();
                if (!data) {
                    recentActivityContainer.innerHTML = `
                        <div class="d-flex justify-content-center align-items-center flex-column text-white py-4">
                            <p class="text-white mb-0">Tidak ada aktivitas terbaru.</p>
                        </div>
                    `;
                    return;
                }

                const isFilled = (value) => value && value.trim() !== '' && value !== '-';
                const isValid = (entry) => isFilled(entry.nama) && isFilled(entry.nim) && isFilled(entry.jurusan);

                const sorted = Object.values(data).filter(isValid).sort((a, b) => {
                    const dateTimeA = `${a.tanggal} ${a.waktu}`;
                    const dateTimeB = `${b.tanggal} ${b.waktu}`;

                    const dateA = new Date(dateTimeA);
                    const dateB = new Date(dateTimeB);

                    return dateB.getTime() - dateA.getTime();
                }).slice(0, 14);

                recentActivityContainer.innerHTML = sorted.map((entry, index) => {
                    const aksesUpper = (entry.akses || '').toUpperCase();

                    const borderClass = (index < sorted.length - 1) ? 'border-bottom border-secondary' : '';

                    return `
                        <div class="activity-item d-flex align-items-center py-2 px-3 ${borderClass}">
                            <div class="activity-icon entry me-3">
                                <i class="fas fa-arrow-up"></i> </div>
                            <div>
                                <h6 class="text-white mb-1">${entry.nama}</h6>
                                <small class="text-secondary">${entry.nim} • ${entry.jurusan} • ${entry.waktu} • ${aksesUpper}</small>
                            </div>
                        </div>`;
                }).join('');
            });
        }

        // Fungsi helper untuk update statistik okupansi Motor
        function updateOccupancyStatsMotor(occupied, total) {
            const rate = total > 0 ? Math.round((occupied / total) * 100) : 0;
            if (occupancyRateEl) occupancyRateEl.textContent = `${rate}%`;
            if (progressBar) progressBar.style.width = `${rate}%`;
        }

        // Fungsi toggle chart untuk Motor
        window.toggleChartMotor = function (mode) { // Ganti nama fungsi toggleChart
            document.querySelectorAll('.btn-group-motor .btn').forEach(btn => btn.classList.remove('active')); // Sesuaikan selektor button group
            document.querySelector(`.btn-motor[onclick="toggleChartMotor('${mode}')"]`)?.classList.add('active'); // Sesuaikan selektor button

            window.currentChartModeMotor = mode; // Gunakan currentChartModeMotor
            if (mode === 'hourly') {
                updateHourlyChartMotor(window.latestHourlyMapMotor || {});
            } else if (mode === 'weekly') {
                updateWeeklyChartMotor(window.latestWeeklyCountMotor || []);
            }
        };
    }

    // Fungsi update chart mingguan untuk Motor
    function updateWeeklyChartMotor(data) {
        if (window.usageChartMotorInstance) { // Gunakan usageChartMotorInstance
            window.usageChartMotorInstance.data = {
                labels: ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'],
                datasets: [{
                    label: 'Total Masuk',
                    data,
                    backgroundColor: [
                        chartColors.secondary,
                        chartColors.primary,
                        chartColors.success,
                        chartColors.warning,
                        chartColors.info,
                        `${chartColors.secondary}AA`,
                        `${chartColors.primary}AA`
                    ],
                    borderColor: [
                        chartColors.secondary,
                        chartColors.primary,
                        chartColors.success,
                        chartColors.warning,
                        chartColors.info,
                        chartColors.secondary,
                        chartColors.primary
                    ],
                    borderWidth: 1
                }]
            };
            window.usageChartMotorInstance.options.scales.y.max = Math.max(...data, 5) + 2;
            window.usageChartMotorInstance.type = 'bar';
            window.usageChartMotorInstance.update();
        }
    }

    // Fungsi update chart per jam untuk Motor
    function updateHourlyChartMotor(hourlyMap) {
        if (window.usageChartMotorInstance) { // Gunakan usageChartMotorInstance
            const labels = [];
            const values = [];

            const startHour = parseInt(('06:00').split(':')[0]);
            const endHour = parseInt(('24:00').split(':')[0]);

            // Gunakan jam operasional spesifik untuk motor
            // const startHour = parseInt((window.jamOperasionalMulaiMotor || '06:00').split(':')[0]);
            // const endHour = parseInt((window.jamOperasionalSelesaiMotor || '18:00').split(':')[0]);

            for (let hour = startHour; hour <= endHour; hour++) {
                const label = `${hour.toString().padStart(2, '0')}:00`;
                labels.push(label);
                values.push(hourlyMap[hour.toString().padStart(2, '0')] || 0);
            }

            window.usageChartMotorInstance.data = {
                labels,
                datasets: [{
                    label: 'Motor Parkir',
                    data: values,
                    borderColor: chartColors.secondary,
                    backgroundColor: (context) => {
                        const chart = context.chart;
                        const {ctx, chartArea} = chart;
                        if (!chartArea) return null;
                        const gradient = ctx.createLinearGradient(0, chartArea.bottom, 0, chartArea.top);
                        gradient.addColorStop(0, `${chartColors.secondary}00`);
                        gradient.addColorStop(1, `${chartColors.secondary}40`);
                        return gradient;
                    },
                    fill: true,
                    tension: 0.4,
                    borderWidth: 3,
                    pointBackgroundColor: chartColors.secondary,
                    pointBorderColor: '#fff',
                    pointBorderWidth: 2,
                    pointRadius: 6,
                    pointHoverRadius: 8,
                }]
            };

            window.usageChartMotorInstance.options.scales.y.max = Math.max(...values, 5);
            window.usageChartMotorInstance.type = 'line';
            window.usageChartMotorInstance.update();
        }
    }

    // --- Portal Management ---
    const jadwalRef = ref(db, 'jadwal_sistem');
    async function loadJadwalData() {
        const snapshot = await get(jadwalRef);
        const data = snapshot.val() || {};
        ['motor', 'mobil'].forEach(jenis => {
            if(data[jenis]) {
                document.getElementById(`${jenis}_jam_mulai`).value = data[jenis].jam_mulai || '';
                document.getElementById(`${jenis}_jam_selesai`).value = data[jenis].jam_selesai || '';
                document.getElementById(`${jenis}_operasional`).value = data[jenis].operasional || 'off';
            }
        });
    }
    async function updateJadwal(jenis) {
        const jamMulai = document.getElementById(`${jenis}_jam_mulai`).value;
        const jamSelesai = document.getElementById(`${jenis}_jam_selesai`).value;
        const operasional = document.getElementById(`${jenis}_operasional`).value;
        if (!jamMulai || !jamSelesai) {
            Swal.fire({ icon: 'warning', title: 'Input Tidak Lengkap!', text: 'Jam mulai dan selesai harus diisi!' }); return;
        }
        await set(child(jadwalRef, jenis), { jam_mulai: jamMulai, jam_selesai: jamSelesai, operasional });
        Swal.fire({ icon: 'success', title: 'Berhasil!', text: `Jadwal ${jenis} berhasil diupdate.`, timer: 1500, showConfirmButton: false });
    }

    document.addEventListener('DOMContentLoaded', () => {
        // --- Chart for Mobil ---
        const ctxMobil = document.getElementById('usageChartMobil')?.getContext('2d');
        if (ctxMobil) {
            window.usageChartMobilInstance = new Chart(ctxMobil, {
                type: 'line',
                data: {
                    labels: [],
                    datasets: []
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            max: 5,
                            ticks: { color: '#a0aec0' },
                            grid: { color: 'rgba(255,255,255,0.08)', drawBorder: false }
                        },
                        x: {
                            ticks: { color: '#a0aec0' },
                            grid: { color: 'rgba(255,255,255,0.08)', drawBorder: false }
                        }
                    }
                }
            });
        }
        // Initialize default chart mode for Mobil
        window.currentChartMode = 'hourly';
        // Setup the Mobil dashboard
        setupDashboardMobil();

        // --- Chart for Motor ---
        const ctxMotor = document.getElementById('usageChartMotor')?.getContext('2d'); // Get context for Motor chart
        if (ctxMotor) {
            window.usageChartMotorInstance = new Chart(ctxMotor, { // Create instance for Motor
                type: 'line',
                data: {
                    labels: [],
                    datasets: []
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            max: 5,
                            ticks: { color: '#a0aec0' },
                            grid: { color: 'rgba(255,255,255,0.08)', drawBorder: false }
                        },
                        x: {
                            ticks: { color: '#a0aec0' },
                            grid: { color: 'rgba(255,255,255,0.08)', drawBorder: false }
                        }
                    }
                }
            });
        }
        // Initialize default chart mode for Motor
        window.currentChartModeMotor = 'hourly'; // Set specific mode variable for Motor
        // Setup the Motor dashboard
        setupDashboardMotor();


        // Load other shared data after charts are ready
        loadMahasiswaData();
        setupParkingListeners('Motor');
        setupParkingListeners('Mobil');
        loadJadwalData();
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const navbar = document.getElementById('mainNavbar');
        const scrollToTopBtn = document.getElementById("scrollToTopBtn");
        const scrollAnimateElements = document.querySelectorAll('.scroll-animate');

        // Navbar Scroll Effect
        const handleNavScroll = () => {
            if (window.scrollY > 50) navbar.classList.add('scrolled');
            else navbar.classList.remove('scrolled');
        };

        // Scroll to Top Button
        const handleScrollBtn = () => {
            if (document.body.scrollTop > 200 || document.documentElement.scrollTop > 200) {
                scrollToTopBtn.style.display = "block";
            } else {
                scrollToTopBtn.style.display = "none";
            }
        };
        scrollToTopBtn.addEventListener('click', () => window.scrollTo({top: 0, behavior: 'smooth'}));

        // Animate on Scroll
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                }
            });
        }, { threshold: 0.1 });
        scrollAnimateElements.forEach(el => observer.observe(el));

        // Event Listeners
        window.addEventListener('scroll', () => {
            handleNavScroll();
            handleScrollBtn();
        });

        // Initial calls
        document.getElementById('currentYear').textContent = new Date().getFullYear();
    });
</script>
</body>
</html>