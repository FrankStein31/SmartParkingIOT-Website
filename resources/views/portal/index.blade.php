@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header pb-0">
                <div class="d-flex justify-content-between">
                    <h6>Jadwal Sistem</h6>
                </div>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                    <div class="p-3">
                        <h6 class="mb-3">Motor</h6>
                        <div class="mb-3">
                            <label class="form-label">Jam Mulai</label>
                            <input type="time" class="form-control" id="motor_jam_mulai">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Jam Selesai</label>
                            <input type="time" class="form-control" id="motor_jam_selesai">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Operasional</label>
                            <select class="form-control" id="motor_operasional">
                                <option value="on">On</option>
                                <option value="off">Off</option>
                            </select>
                        </div>
                        <button class="btn btn-primary btn-sm" onclick="updateJadwal('motor')">Update Motor</button>

                        <h6 class="mb-3 mt-5">Mobil</h6>
                        <div class="mb-3">
                            <label class="form-label">Jam Mulai</label>
                            <input type="time" class="form-control" id="mobil_jam_mulai">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Jam Selesai</label>
                            <input type="time" class="form-control" id="mobil_jam_selesai">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Operasional</label>
                            <select class="form-control" id="mobil_operasional">
                                <option value="on">On</option>
                                <option value="off">Off</option>
                            </select>
                        </div>
                        <button class="btn btn-primary btn-sm" onclick="updateJadwal('mobil')">Update Mobil</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script type="module">
    import { ref, get, set, child } from "https://www.gstatic.com/firebasejs/10.8.0/firebase-database.js";

    try {
        const jadwalRef = ref(window.db, 'jadwal_sistem');

        // Fungsi untuk memuat data
        async function loadData() {
            try {
                const snapshot = await get(jadwalRef);
                const data = snapshot.val() || {};
                
                // Set nilai untuk motor
                if (data.motor) {
                    document.getElementById('motor_jam_mulai').value = data.motor.jam_mulai || '';
                    document.getElementById('motor_jam_selesai').value = data.motor.jam_selesai || '';
                    document.getElementById('motor_operasional').value = data.motor.operasional || 'off';
                }
                
                // Set nilai untuk mobil
                if (data.mobil) {
                    document.getElementById('mobil_jam_mulai').value = data.mobil.jam_mulai || '';
                    document.getElementById('mobil_jam_selesai').value = data.mobil.jam_selesai || '';
                    document.getElementById('mobil_operasional').value = data.mobil.operasional || 'off';
                }
            } catch (error) {
                console.error('Error loading data:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Gagal memuat data: ' + error.message,
                });
            }
        }

        // Load data saat halaman dimuat
        loadData();

        // Fungsi untuk update jadwal
        window.updateJadwal = async (jenis) => {
            try {
                const jamMulai = document.getElementById(`${jenis}_jam_mulai`).value;
                const jamSelesai = document.getElementById(`${jenis}_jam_selesai`).value;
                const operasional = document.getElementById(`${jenis}_operasional`).value;

                if (!jamMulai || !jamSelesai) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Input Tidak Lengkap',
                        text: 'Jam mulai dan jam selesai harus diisi!',
                    });
                    return;
                }

                const jadwalData = {
                    jam_mulai: jamMulai,
                    jam_selesai: jamSelesai,
                    operasional: operasional
                };

                await set(child(jadwalRef, jenis), jadwalData);
                
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: `Jadwal ${jenis} berhasil diupdate.`,
                    timer: 1500,
                    showConfirmButton: false
                });
            } catch (error) {
                console.error('Error updating data:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Gagal mengupdate data: ' + error.message,
                });
            }
        };

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