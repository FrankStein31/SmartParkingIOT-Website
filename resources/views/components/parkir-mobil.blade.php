<div class="container">
    <h2 class="section-title">Manajemen Parkir Mobil</h2>
    <div class="row mb-4">
        <div class="col-lg-4 col-md-6">
            <div class="content-card">
                <div class="card-header pb-0">
                    <h6>Perbandingan Akses Parkir Mobil</h6>
                    <p class="text-sm">
                        <i class="fa fa-chart-pie text-primary"></i>
                        Distribusi parkir mobil berdasarkan cara akses
                    </p>
                </div>
                <div class="card-body p-3">
                    <canvas id="aksesChartMobil" width="400" height="200"></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg-8 col-md-6">
            <div class="content-card">
                <div class="card-header pb-0">
                    <h6>Trend Parkir Mobil ( Jam / Hari )</h6>
                    <p class="text-sm">
                        <i class="fa fa-clock text-warning"></i>
                        Distribusi parkir mobil berdasarkan jam dalam sehari
                    </p>
                </div>
                <div class="card-body p-3">
                    <canvas id="hourlyChartMobil" width="400" height="200"></canvas>
                </div>
            </div>
        </div>
    </div>
    <div class="content-card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h6>Status Slot Parkir Mobil</h6>
            <p class="text-sm mb-0">
                <i class="fa-solid fa-circle text-success me-1"></i> Kosong
                <i class="fa-solid fa-circle text-danger ms-3 me-1"></i> Terisi
            </p>
        </div>
        <div class="card-body p-3">
            <div class="row gy-4" id="slotMobilList"></div>
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
                    <tbody id="mobilList"></tbody>
                </table>
            </div>
        </div>
    </div>
</div> 