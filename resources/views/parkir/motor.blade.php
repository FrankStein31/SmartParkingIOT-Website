@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header pb-0">
                <h6>Daftar Parkir Motor</h6>
                <p class="text-sm mb-0">
                    <i class="fa fa-clock text-success" aria-hidden="true"></i>
                    <span class="font-weight-bold ms-1">Terakhir diperbarui:</span> <span id="last_updated"></span>
                </p>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Tanggal</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Waktu</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">NIM</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Jurusan</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Akses</th>
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

<div class="row mt-4">
    <div class="col-lg-12">
        <div class="card z-index-2">
            <div class="card-header pb-0">
                <h6>Status Slot Parkir Motor</h6>
                <p class="text-sm">
                    <i class="fa fa-info-circle text-info" aria-hidden="true"></i>
                    <span class="font-weight-bold">Status:</span> Merah = Terisi, Hijau = Kosong
                </p>
            </div>
            <div class="card-body p-3">
                <div class="row" id="slotMotorList">
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script type="module">
    import { ref, onValue } from "https://www.gstatic.com/firebasejs/10.8.0/firebase-database.js";

    try {
        const parkirRef = ref(window.db, 'parkir/Motor');
        const tempatParkirRef = ref(window.db, 'tempat_parkir/Motor');

        // Fungsi untuk memuat data parkir
        function loadParkirData(snapshot) {
            const data = snapshot.val() || {};
            let html = '';
            let entries = [];

            // Mengubah struktur data menjadi array
            Object.keys(data).forEach(date => {
                Object.keys(data[date]).forEach(time => {
                    entries.push({
                        date: date,
                        time: time,
                        ...data[date][time]
                    });
                });
            });

            // Mengurutkan berdasarkan tanggal dan waktu terbaru
            entries.sort((a, b) => {
                const dateA = new Date(a.date + ' ' + a.time);
                const dateB = new Date(b.date + ' ' + b.time);
                return dateB - dateA;
            });

            if (entries.length > 0) {
                entries.forEach(entry => {
                    html += `
                        <tr>
                            <td class="ps-3">
                                <p class="text-xs font-weight-bold mb-0">${entry.date}</p>
                            </td>
                            <td>
                                <p class="text-xs font-weight-bold mb-0">${entry.time}</p>
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
                                <p class="text-xs font-weight-bold mb-0">${entry.akses}</p>
                            </td>
                        </tr>
                    `;
                });
            } else {
                html = '<tr><td colspan="6" class="text-center">Tidak ada data</td></tr>';
            }

            document.getElementById('motorList').innerHTML = html;
            document.getElementById('last_updated').textContent = new Date().toLocaleString('id-ID');
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
                                            <i class="fas fa-motorcycle text-lg opacity-10" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
            }

            document.getElementById('slotMotorList').innerHTML = html;
        }

        // Debug: Tampilkan data yang diterima dari Firebase
        onValue(parkirRef, (snapshot) => {
            console.log('Data Parkir Motor:', snapshot.val());
            loadParkirData(snapshot);
        });

        onValue(tempatParkirRef, (snapshot) => {
            console.log('Data Slot Motor:', snapshot.val());
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