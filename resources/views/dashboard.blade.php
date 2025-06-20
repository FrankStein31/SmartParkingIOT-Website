@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
            <div class="card-body p-3">
                <div class="row">
                    <div class="col-8">
                        <div class="numbers">
                            <p class="text-sm mb-0 text-capitalize font-weight-bold">Total Parkir</p>
                            <h5 class="font-weight-bolder mb-0">
                                <span id="total_parkir">0</span>
                                <span class="text-success text-sm font-weight-bolder">Slot</span>
                            </h5>
                        </div>
                    </div>
                    <div class="col-4 text-end">
                        <div class="icon icon-shape bg-gradient-info shadow text-center border-radius-md">
                            <i class="fas fa-parking text-lg opacity-10" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
            <div class="card-body p-3">
                <div class="row">
                    <div class="col-8">
                        <div class="numbers">
                            <p class="text-sm mb-0 text-capitalize font-weight-bold">Parkir Terisi</p>
                            <h5 class="font-weight-bolder mb-0">
                                <span id="parkir_terisi">0</span>
                                <span class="text-danger text-sm font-weight-bolder">Slot</span>
                            </h5>
                        </div>
                    </div>
                    <div class="col-4 text-end">
                        <div class="icon icon-shape bg-gradient-danger shadow text-center border-radius-md">
                            <i class="fas fa-car text-lg opacity-10" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
        <div class="card">
            <div class="card-body p-3">
                <div class="row">
                    <div class="col-8">
                        <div class="numbers">
                            <p class="text-sm mb-0 text-capitalize font-weight-bold">Parkir Kosong</p>
                            <h5 class="font-weight-bolder mb-0">
                                <span id="parkir_kosong">0</span>
                                <span class="text-success text-sm font-weight-bolder">Slot</span>
                            </h5>
                        </div>
                    </div>
                    <div class="col-4 text-end">
                        <div class="icon icon-shape bg-gradient-success shadow text-center border-radius-md">
                            <i class="fas fa-check text-lg opacity-10" aria-hidden="true"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header pb-0">
                <h6>Status Parkir Realtime</h6>
                <p class="text-sm mb-0">
                    <i class="fa fa-clock text-success" aria-hidden="true"></i>
                    <span class="font-weight-bold ms-1">Terakhir diperbarui:</span> <span id="last_updated"></span>
                </p>
            </div>
            <div class="card-body px-0 pb-2">
                <div class="table-responsive">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Jenis</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Waktu Masuk</th>
                            </tr>
                        </thead>
                        <!-- Data Firebase -->
                        <tbody id="status_parkir">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script type="module">
    import {
        ref,
        onValue
    } from "https://www.gstatic.com/firebasejs/10.8.0/firebase-database.js";

    try {
        const motorParkirRef = ref(window.db, 'tempat_parkir/Motor');
        const mobilParkirRef = ref(window.db, 'tempat_parkir/Mobil');

        function updateDashboard() {
            onValue(motorParkirRef, (snapshot) => {
                const motorData = snapshot.val() || {};
                updateParkingStats('Motor', motorData);
            });

            onValue(mobilParkirRef, (snapshot) => {
                const mobilData = snapshot.val() || {};
                updateParkingStats('Mobil', mobilData);
            });
        }

        function updateParkingStats(type, data) {
            let totalSlot = Object.keys(data).length;
            let terisi = 0;
            let statusHTML = '';
            let slotNumber = 1;

            Object.entries(data).forEach(([slot, status]) => {
                if (status === 'occupied') {
                    terisi++;
                }

                statusHTML += `
                    <tr>
                        <td>
                            <div class="d-flex px-3">
                                <h6 class="mb-0 text-sm">${slotNumber}</h6>
                            </div>
                        </td>
                        <td>
                            <p class="text-sm font-weight-bold mb-0">${type}</p>
                        </td>
                        <td class="align-middle text-center text-sm">
                            <span class="badge badge-sm bg-gradient-${status === 'available' ? 'success' : 'danger'}">
                                ${status === 'available' ? 'Kosong' : 'Terisi'}
                            </span>
                        </td>
                        <td class="align-middle text-center">
                            <span class="text-secondary text-sm font-weight-bold">
                                ${status === 'available' ? '-' : getLastUpdated()}
                            </span>
                        </td>
                    </tr>
                `;
                slotNumber++;
            });

            // Update total statistics
            const currentTotal = parseInt(document.getElementById('total_parkir').textContent);
            const currentTerisi = parseInt(document.getElementById('parkir_terisi').textContent);

            document.getElementById('total_parkir').textContent = currentTotal + totalSlot;
            document.getElementById('parkir_terisi').textContent = currentTerisi + terisi;
            document.getElementById('parkir_kosong').textContent =
                (currentTotal + totalSlot) - (currentTerisi + terisi);

            // Update status table
            const existingHTML = document.getElementById('status_parkir').innerHTML;
            document.getElementById('status_parkir').innerHTML = existingHTML + statusHTML;

            // Update last updated time
            document.getElementById('last_updated').textContent = getLastUpdated();
        }

        function getLastUpdated() {
            return new Date().toLocaleString('id-ID', {
                day: '2-digit',
                month: 'short',
                year: 'numeric',
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit'
            });
        }

        // Reset counters before updating
        document.getElementById('total_parkir').textContent = '0';
        document.getElementById('parkir_terisi').textContent = '0';
        document.getElementById('parkir_kosong').textContent = '0';
        document.getElementById('status_parkir').innerHTML = '';

        updateDashboard();

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