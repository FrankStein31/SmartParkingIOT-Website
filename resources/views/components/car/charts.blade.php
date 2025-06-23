<!-- Grafik Perbandingan -->
<div class="row mb-4">
    <div class="col-lg-4">
        <div class="card z-index-2">
            <div class="card-header pb-0">
                <h6>Perbandingan Akses Parkir Mobil</h6>
                <p class="text-sm">
                    <i class="fa fa-chart-pie text-primary" aria-hidden="true"></i>
                    Distribusi parkir mobil berdasarkan cara akses
                </p>
            </div>
            <div class="card-body p-3">
                <canvas id="aksesChartMobil" width="400" height="200"></canvas>
            </div>
        </div>
    </div>
    <div class="col-lg-8">
        <div class="card z-index-2">
            <div class="card-header pb-0">
                <h6>Trend Akses Parkir Mobil ( Jam / Hari )</h6>
                <p class="text-sm">
                    <i class="fa fa-clock text-warning" aria-hidden="true"></i>
                    Distribusi parkir mobil berdasarkan jam dalam sehari
                </p>
            </div>
            <div class="card-body p-3">
                <canvas id="hourlyChartMobil" width="400" height="200"></canvas>
            </div>
        </div>
    </div>
</div>
