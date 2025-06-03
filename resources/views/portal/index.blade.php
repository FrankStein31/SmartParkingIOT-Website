@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header pb-0">
                <div class="d-flex justify-content-between">
                    <h6>Pengaturan Portal</h6>
                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addModal">Tambah Jadwal</button>
                </div>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Portal</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Hari</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Jam Mulai</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Jam Selesai</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Status</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="portalList">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="addModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Jadwal Portal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="addForm">
                    <div class="mb-3">
                        <label class="form-label">Nama Portal</label>
                        <select class="form-control" id="portal_name" required>
                            <option value="motor">Portal Motor</option>
                            <option value="mobil">Portal Mobil</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Hari</label>
                        <select class="form-control" id="day" required>
                            <option value="monday">Senin</option>
                            <option value="tuesday">Selasa</option>
                            <option value="wednesday">Rabu</option>
                            <option value="thursday">Kamis</option>
                            <option value="friday">Jumat</option>
                            <option value="saturday">Sabtu</option>
                            <option value="sunday">Minggu</option>
                            <option value="all">Setiap Hari</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Jam Mulai</label>
                        <input type="time" class="form-control" id="start_time" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Jam Selesai</label>
                        <input type="time" class="form-control" id="end_time" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Status Portal</label>
                        <select class="form-control" id="status" required>
                            <option value="closed">Tutup</option>
                            <option value="open">Buka</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script type="module">
    import { ref, get, set, remove, child } from "https://www.gstatic.com/firebasejs/10.8.0/firebase-database.js";

    try {
        const portalRef = ref(window.db, 'jadwal_portal');

        async function loadData() {
            try {
                const snapshot = await get(portalRef);
                const data = snapshot.val();
                let html = '';
                
                if (data) {
                    Object.entries(data).forEach(([key, schedule]) => {
                        html += `
                            <tr>
                                <td class="ps-3">
                                    <p class="text-xs font-weight-bold mb-0">${schedule.portal_name === 'motor' ? 'Portal Motor' : 'Portal Mobil'}</p>
                                </td>
                                <td>
                                    <p class="text-xs font-weight-bold mb-0">${getDayName(schedule.day)}</p>
                                </td>
                                <td>
                                    <p class="text-xs font-weight-bold mb-0">${schedule.start_time}</p>
                                </td>
                                <td>
                                    <p class="text-xs font-weight-bold mb-0">${schedule.end_time}</p>
                                </td>
                                <td>
                                    <span class="badge badge-sm bg-${schedule.status === 'closed' ? 'danger' : 'success'}">${schedule.status === 'closed' ? 'Tutup' : 'Buka'}</span>
                                </td>
                                <td>
                                    <button class="btn btn-danger btn-sm delete-btn" data-id="${key}">Hapus</button>
                                </td>
                            </tr>
                        `;
                    });
                } else {
                    html = '<tr><td colspan="6" class="text-center">Tidak ada data</td></tr>';
                }
                
                document.getElementById('portalList').innerHTML = html;
                attachActionListeners();
            } catch (error) {
                console.error('Error loading data:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Gagal memuat data: ' + error.message,
                });
            }
        }

        function getDayName(day) {
            const days = {
                'monday': 'Senin',
                'tuesday': 'Selasa',
                'wednesday': 'Rabu',
                'thursday': 'Kamis',
                'friday': 'Jumat',
                'saturday': 'Sabtu',
                'sunday': 'Minggu',
                'all': 'Setiap Hari'
            };
            return days[day] || day;
        }

        function attachActionListeners() {
            document.querySelectorAll('.delete-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const id = this.dataset.id;
                    deleteSchedule(id);
                });
            });
        }

        document.getElementById('addForm').addEventListener('submit', async (e) => {
            e.preventDefault();
            try {
                const portal_name = document.getElementById('portal_name').value;
                const day = document.getElementById('day').value;
                const start_time = document.getElementById('start_time').value;
                const end_time = document.getElementById('end_time').value;
                const status = document.getElementById('status').value;

                const newSchedule = {
                    portal_name,
                    day,
                    start_time,
                    end_time,
                    status
                };

                const newScheduleRef = child(portalRef, Date.now().toString());
                await set(newScheduleRef, newSchedule);
                
                document.getElementById('addForm').reset();
                const addModalElement = document.getElementById('addModal');
                const addModalInstance = bootstrap.Modal.getInstance(addModalElement);
                if (addModalInstance) {
                    addModalInstance.hide();
                }
                
                loadData();
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: 'Jadwal portal berhasil ditambahkan.',
                    timer: 1500,
                    showConfirmButton: false
                });
            } catch (error) {
                console.error('Error adding schedule:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Gagal menambahkan jadwal: ' + error.message,
                });
            }
        });

        async function deleteSchedule(id) {
            Swal.fire({
                title: 'Anda Yakin?',
                text: "Jadwal ini akan dihapus secara permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then(async (result) => {
                if (result.isConfirmed) {
                    try {
                        await remove(child(portalRef, id));
                        loadData();
                        Swal.fire(
                            'Dihapus!',
                            'Jadwal berhasil dihapus.',
                            'success'
                        );
                    } catch (error) {
                        console.error('Error deleting schedule:', error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Gagal menghapus jadwal: ' + error.message,
                        });
                    }
                }
            });
        }

        loadData();

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