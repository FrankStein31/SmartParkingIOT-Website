<div class="container">
    <h2 class="section-title">Data Master Mahasiswa</h2>
    <div class="content-card">
        <div class="mt-4">
            <h6 class="text-white">Grafik Jumlah Mahasiswa per Jurusan</h6>
            <canvas id="jurusanChart" height="100"></canvas>
        </div>
    </div>
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
                    <tbody id="mahasiswaList"></tbody>
                </table>
            </div>
        </div>
    </div>
</div> 