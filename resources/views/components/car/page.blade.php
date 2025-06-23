<div class="container">
    <h2 class="section-title">Manajemen Parkir Mobil</h2>
    <x-car.summary />
    <x-car.charts />
    <div class="content-card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3>Status Slot Parkir Mobil</h3>
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
    <x-car.trend />
    <div class="content-card">
        <div class="card-header pb-3">
            <x-car.header />
        </div>
        <div class="card-body">
            <div class="table-responsive p-0">
                <table class="table align-items-center mb-0 table-dark-custom">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Waktu</th>
                            <th>NIM</th>
                            <th>Nama</th>
                            <th>Jurusan</th>
                            <th>Akses</th>
                        </tr>
                    </thead>
                    <tbody id="mobilList">
                    </tbody>
                </table>
            </div>
            <x-car.pagination-controls />
        </div>
    </div>
</div>
