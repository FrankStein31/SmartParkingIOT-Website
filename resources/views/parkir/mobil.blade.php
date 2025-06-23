@extends('layouts.app')

@section('content')
    <!-- Statistik Perbandingan Akses -->
    <div class="row mb-4">
        <div class="col-lg-4 col-md-6">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Akses KTM</p>
                                <h5 class="font-weight-bolder mb-0" id="totalKtm">0</h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                                <i class="ni ni-badge text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Akses Petugas</p>
                                <h5 class="font-weight-bolder mb-0" id="totalPetugas">0</h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-success shadow text-center border-radius-md">
                                <i class="ni ni-single-02 text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="card">
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-8">
                            <div class="numbers">
                                <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Akses</p>
                                <h5 class="font-weight-bolder mb-0" id="totalAkses">0</h5>
                            </div>
                        </div>
                        <div class="col-4 text-end">
                            <div class="icon icon-shape bg-gradient-info shadow text-center border-radius-md">
                                <i class="fas fa-key text-lg opacity-10" aria-hidden="true"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
                    <canvas id="aksesChart" width="400" height="200"></canvas>
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
                    <canvas id="hourlyChart" width="400" height="200"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Analisis Waktu dan Trend -->
    <div class="row mb-4">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header pb-0">
                    <h6>Jam Tersibuk</h6>
                    <p class="text-sm">
                        <i class="fa fa-fire text-danger" aria-hidden="true"></i>
                        Waktu dengan akses terbanyak
                    </p>
                </div>
                <div class="card-body p-3">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="text-center">
                                <h3 class="text-primary font-weight-bolder" id="peakHour">-</h3>
                                <p class="text-sm mb-0">Jam dengan <span id="peakCount">0</span> akses</p>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="text-center">
                                <h5 class="text-success font-weight-bolder" id="avgPerHour">0</h5>
                                <p class="text-sm mb-0">Rata-rata akses per jam</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="row align-items-center">
                        <div class="col-6">
                            <h6>Daftar Parkir Mobil</h6>
                            <p class="text-sm mb-0">
                                <i class="fa fa-clock text-success" aria-hidden="true"></i>
                                <span class="font-weight-bold ms-1">Terakhir diperbarui:</span> <span
                                    id="last_updated"></span>
                            </p>
                        </div>
                        <div class="col-6">
                            <div class="row align-items-center justify-content-end">
                                <div class="col-auto">
                                    <label for="entriesPerPage" class="form-label text-sm mb-0">Tampilkan:</label>
                                </div>
                                <div class="col-auto">
                                    <select id="entriesPerPage" class="form-select form-select-sm">
                                        <option value="10" selected>10</option>
                                        <option value="25">25</option>
                                        <option value="50">50</option>
                                        <option value="100">100</option>
                                    </select>
                                </div>
                                <div class="col-auto">
                                    <span class="text-sm">entri</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tanggal
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Waktu
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">NIM
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jurusan
                                    </th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Akses
                                    </th>
                                </tr>
                            </thead>
                            <tbody id="mobilList">
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination Controls -->
                    <div class="row align-items-center mt-3 px-3">
                        <div class="col-sm-12 col-md-5">
                            <div class="dataTables_info" id="dataTable_info" role="status" aria-live="polite">
                                Menampilkan <span id="showingStart">0</span> sampai <span id="showingEnd">0</span> dari
                                <span id="totalEntries">0</span> entri
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-7">
                            <div class="dataTables_paginate paging_simple_numbers">
                                <nav aria-label="Page navigation">
                                    <ul class="pagination justify-content-end mb-0" id="pagination">
                                    </ul>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-lg-12">
            <div class="card z-index-2">
                <div class="card-header pb-0">
                    <h6>Status Slot Parkir Mobil</h6>
                    <p class="text-sm">
                        <i class="fa fa-info-circle text-info" aria-hidden="true"></i>
                        <span class="font-weight-bold">Status:</span> Merah = Terisi, Hijau = Kosong
                    </p>
                </div>
                <div class="card-body p-3">
                    <div class="row" id="slotMobilList">
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2"></script>
        <script type="module">
            import {
                ref,
                onValue
            } from "https://www.gstatic.com/firebasejs/10.8.0/firebase-database.js";

            // Register the datalabels plugin
            Chart.register(ChartDataLabels);

            // Variabel untuk menyimpan chart
            let aksesChart = null;
            let hourlyChart = null;

            // Variabel untuk pagination
            let allEntries = [];
            let currentPage = 1;
            let entriesPerPage = 10;

            try {
                const parkirRef = ref(window.db, 'parkir/Mobil');
                const tempatParkirRef = ref(window.db, 'tempat_parkir/Mobil');

                // Fungsi untuk analisis waktu per jam
                function analyzeHourlyData(data) {
                    const hourlyStats = {};

                    // Initialize hours 0-23
                    for (let i = 0; i < 24; i++) {
                        hourlyStats[i] = 0;
                    }

                    Object.keys(data).forEach(key => {
                        const entry = data[key];
                        const hour = parseInt(entry.waktu.split(':')[0]);
                        hourlyStats[hour]++;
                    });

                    return hourlyStats;
                }

                // Fungsi untuk update chart jam
                function updateHourlyChart(data) {
                    const hourlyStats = analyzeHourlyData(data);
                    const ctx = document.getElementById('hourlyChart').getContext('2d');

                    if (hourlyChart) {
                        hourlyChart.destroy();
                    }

                    const hours = Object.keys(hourlyStats);
                    const values = Object.values(hourlyStats);

                    hourlyChart = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: hours.map(h => h + ':00'),
                            datasets: [{
                                label: 'Jumlah Akses',
                                data: values,
                                borderColor: '#5e72e4',
                                backgroundColor: 'rgba(94, 114, 228, 0.1)',
                                borderWidth: 2,
                                fill: true,
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
                                    ticks: {
                                        stepSize: 1
                                    }
                                }
                            }
                        }
                    });

                    // Update peak hour info
                    const maxCount = Math.max(...values);
                    const peakHourIndex = values.indexOf(maxCount);
                    const peakHour = hours[peakHourIndex];

                    document.getElementById('peakHour').textContent = peakHour + ':00';
                    document.getElementById('peakCount').textContent = maxCount;

                    const totalHours = values.filter(v => v > 0).length;
                    const avgPerHour = totalHours > 0 ? Math.round(values.reduce((a, b) => a + b, 0) / totalHours) : 0;
                    document.getElementById('avgPerHour').textContent = avgPerHour;
                }

                function calculateAccessStats(data) {
                    let ktmCount = 0;
                    let petugasCount = 0;
                    let totalCount = 0;

                    Object.keys(data).forEach(key => {
                        const entry = data[key];
                        totalCount++;

                        if (entry.akses === 'ktm') {
                            ktmCount++;
                        } else if (entry.akses === 'petugas') {
                            petugasCount++;
                        }
                    });

                    return {
                        ktm: ktmCount,
                        petugas: petugasCount,
                        total: totalCount
                    };
                }

                // Fungsi untuk memperbarui statistik
                function updateStats(stats) {
                    document.getElementById('totalKtm').textContent = stats.ktm;
                    document.getElementById('totalPetugas').textContent = stats.petugas;
                    document.getElementById('totalAkses').textContent = stats.total;

                    // Update chart
                    updateChart(stats);
                }

                // Fungsi untuk memperbarui chart
                function updateChart(stats) {
                    const ctx = document.getElementById('aksesChart').getContext('2d');

                    if (aksesChart) {
                        aksesChart.destroy();
                    }

                    // Hitung persentase dengan perbaikan untuk menghindari total > 100%
                    const total = stats.ktm + stats.petugas;
                    let persentaseKtm = 0;
                    let persentasePetugas = 0;

                    if (total > 0) {
                        // Hitung persentase mentah
                        const rawKtm = (stats.ktm / total) * 100;
                        const rawPetugas = (stats.petugas / total) * 100;

                        // Bulatkan persentase
                        persentaseKtm = Math.round(rawKtm);
                        persentasePetugas = Math.round(rawPetugas);

                        // Perbaiki jika total tidak 100%
                        const totalPersentase = persentaseKtm + persentasePetugas;

                        if (totalPersentase !== 100) {
                            // Cari selisih
                            const difference = 100 - totalPersentase;

                            // Tentukan mana yang memiliki sisa desimal terbesar
                            const decimalKtm = rawKtm - Math.floor(rawKtm);
                            const decimalPetugas = rawPetugas - Math.floor(rawPetugas);

                            if (difference > 0) {
                                // Jika kurang dari 100%, tambahkan ke yang memiliki desimal terbesar
                                if (decimalKtm > decimalPetugas) {
                                    persentaseKtm += difference;
                                } else {
                                    persentasePetugas += difference;
                                }
                            } else {
                                // Jika lebih dari 100%, kurangi dari yang memiliki desimal terkecil
                                if (decimalKtm < decimalPetugas) {
                                    persentaseKtm += difference; // difference negatif, jadi ini mengurangi
                                } else {
                                    persentasePetugas += difference;
                                }
                            }
                        }
                    }

                    aksesChart = new Chart(ctx, {
                        type: 'doughnut',
                        data: {
                            labels: [`Akses via KTM`, `Akses via Petugas`],
                            datasets: [{
                                data: [stats.ktm, stats.petugas],
                                backgroundColor: [
                                    '#5e72e4',
                                    '#2dce89'
                                ],
                                borderWidth: 0
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    position: 'bottom',
                                },
                                tooltip: {
                                    callbacks: {
                                        label: function(context) {
                                            const label = context.label || '';
                                            const value = context.parsed;
                                            const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                            const percentage = total > 0 ? Math.round((value / total) * 100) : 0;
                                            return label + ': ' + value + ' akses (' + percentage + '%)';
                                        }
                                    }
                                },
                                // Plugin untuk menampilkan persentase di dalam chart
                                datalabels: {
                                    display: true,
                                    color: 'white',
                                    font: {
                                        weight: 'bold',
                                        size: 14
                                    },
                                    formatter: function(value, context) {
                                        const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                        if (total === 0) return '';

                                        // Gunakan perhitungan persentase yang sudah diperbaiki
                                        let percentage;
                                        if (context.dataIndex === 0) {
                                            percentage = persentaseKtm;
                                        } else {
                                            percentage = persentasePetugas;
                                        }

                                        return percentage > 5 ? percentage + '%' : ''; // Hanya tampilkan jika > 5%
                                    }
                                }
                            }
                        }
                    });
                }

                // Fungsi untuk render pagination
                function renderPagination() {
                    const totalPages = Math.ceil(allEntries.length / entriesPerPage);
                    const pagination = document.getElementById('pagination');

                    let paginationHtml = '';

                    // Previous button
                    paginationHtml += `
                <li class="page-item ${currentPage === 1 ? 'disabled' : ''}">
                    <a class="page-link" href="#" onclick="changePage(${currentPage - 1})" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>
            `;

                    // Page numbers
                    const startPage = Math.max(1, currentPage - 2);
                    const endPage = Math.min(totalPages, currentPage + 2);

                    if (startPage > 1) {
                        paginationHtml +=
                            `<li class="page-item"><a class="page-link" href="#" onclick="changePage(1)">1</a></li>`;
                        if (startPage > 2) {
                            paginationHtml += `<li class="page-item disabled"><span class="page-link">...</span></li>`;
                        }
                    }

                    for (let i = startPage; i <= endPage; i++) {
                        paginationHtml += `
                    <li class="page-item ${i === currentPage ? 'active' : ''}">
                        <a class="page-link" href="#" onclick="changePage(${i})">${i}</a>
                    </li>
                `;
                    }

                    if (endPage < totalPages) {
                        if (endPage < totalPages - 1) {
                            paginationHtml += `<li class="page-item disabled"><span class="page-link">...</span></li>`;
                        }
                        paginationHtml +=
                            `<li class="page-item"><a class="page-link" href="#" onclick="changePage(${totalPages})">${totalPages}</a></li>`;
                    }

                    // Next button
                    paginationHtml += `
                <li class="page-item ${currentPage === totalPages ? 'disabled' : ''}">
                    <a class="page-link" href="#" onclick="changePage(${currentPage + 1})" aria-label="Next">
                        <span aria-hidden="true">&raquo;</span>
                    </a>
                </li>
            `;

                    pagination.innerHTML = paginationHtml;

                    // Update info
                    const start = (currentPage - 1) * entriesPerPage + 1;
                    const end = Math.min(currentPage * entriesPerPage, allEntries.length);

                    document.getElementById('showingStart').textContent = allEntries.length > 0 ? start : 0;
                    document.getElementById('showingEnd').textContent = end;
                    document.getElementById('totalEntries').textContent = allEntries.length;
                }

                // Fungsi untuk render tabel
                function renderTable() {
                    const start = (currentPage - 1) * entriesPerPage;
                    const end = start + entriesPerPage;
                    const pageEntries = allEntries.slice(start, end);

                    let html = '';

                    if (pageEntries.length > 0) {
                        pageEntries.forEach(entry => {
                            html += `
                        <tr>
                            <td class="ps-3">
                                <p class="text-xs font-weight-bold mb-0">${entry.tanggal}</p>
                            </td>
                            <td>
                                <p class="text-xs font-weight-bold mb-0">${entry.waktu}</p>
                            </td>
                            <td>
                                <p class="text-xs font-weight-bold mb-0">${entry.nim}</p>
                            </td>
                            <td>
                                <p class="text-xs font-weight-bold mb-0">${entry.nama}</p>
                            </td>
                            <td>
                                <p class="text-xs font-weight-bold mb-0">${entry.jurusan}</p>
                            </td>
                            <td>
                                <span class="badge badge-sm bg-gradient-${entry.akses === 'ktm' ? 'primary' : 'success'}">${entry.akses}</span>
                            </td>
                        </tr>
                    `;
                        });
                    } else {
                        html = '<tr><td colspan="6" class="text-center">Tidak ada data</td></tr>';
                    }

                    document.getElementById('mobilList').innerHTML = html;
                    renderPagination();
                }

                // Fungsi untuk mengubah halaman
                window.changePage = function(page) {
                    const totalPages = Math.ceil(allEntries.length / entriesPerPage);
                    if (page >= 1 && page <= totalPages) {
                        currentPage = page;
                        renderTable();
                    }
                };

                // Event listener untuk perubahan entries per page
                document.getElementById('entriesPerPage').addEventListener('change', function() {
                    entriesPerPage = parseInt(this.value);
                    currentPage = 1;
                    renderTable();
                });

                // Fungsi untuk memuat data parkir
                function loadParkirData(snapshot) {
                    const data = snapshot.val() || {};

                    allEntries = [];

                    // Mengubah struktur data menjadi array
                    Object.keys(data).forEach(key => {
                        allEntries.push({
                            key: key,
                            ...data[key]
                        });
                    });

                    // Mengurutkan berdasarkan tanggal dan waktu terbaru
                    allEntries.sort((a, b) => {
                        const dateA = new Date(a.tanggal + ' ' + a.waktu);
                        const dateB = new Date(b.tanggal + ' ' + b.waktu);
                        return dateB - dateA;
                    });

                    // Reset ke halaman pertama
                    currentPage = 1;
                    renderTable();

                    document.getElementById('last_updated').textContent = new Date().toLocaleString('id-ID');

                    // Hitung dan perbarui statistik
                    const stats = calculateAccessStats(data);
                    updateStats(stats);
                    updateHourlyChart(data);
                }

                // Fungsi untuk memuat status slot parkir
                function loadSlotStatus(snapshot) {
                    const data = snapshot.val() || {};
                    let html = '';

                    for (let i = 1; i <= 4; i++) {
                        const status = data['slot' + i] || 'available';
                        const isAvailable = status === 'available';

                        html += `
                    <div class="col-3">
                        <div class="card bg-gradient-${isAvailable ? 'success' : 'danger'} border-0">
                            <div class="card-body p-3">
                                <div class="row">
                                    <div class="col-8">
                                        <div class="numbers">
                                            <h5 class="text-white mb-0 text-center">
                                                Slot ${i}
                                            </h5>
                                            <p class="text-white text-sm mb-0 text-center">
                                                ${isAvailable ? 'Kosong' : 'Terisi'}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-4 text-end">
                                        <div class="icon icon-shape bg-white shadow text-center border-radius-md">
                                            <i class="fas fa-car text-dark text-lg opacity-10" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
                    }

                    document.getElementById('slotMobilList').innerHTML = html;
                }

                // Debug: Tampilkan data yang diterima dari Firebase
                onValue(parkirRef, (snapshot) => {
                    console.log('Data Parkir Mobil:', snapshot.val());
                    loadParkirData(snapshot);
                });

                onValue(tempatParkirRef, (snapshot) => {
                    console.log('Data Slot Mobil:', snapshot.val());
                    loadSlotStatus(snapshot);
                });

            } catch (error) {
                console.error('Firebase initialization error:', error);
                if (typeof Swal !== 'undefined') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Kesalahan Inisialisasi',
                        text: 'Gagal terhubung ke Firebase: ' + error.message,
                    });
                } else {
                    alert('Error inisialisasi Firebase: ' + error.message);
                }
            }
        </script>
    @endpush
@endsection
