@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header pb-0">
                <div class="d-flex justify-content-between">
                    <h6>Data Mahasiswa</h6>
                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addModal">Tambah Mahasiswa</button>
                </div>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">NIM</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Nama</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Jurusan</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Aksi</th>
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

<div class="modal fade" id="addModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Tambah Mahasiswa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="addForm">
                    <div class="mb-3">
                        <label class="form-label">NIM</label>
                        <input type="text" class="form-control" id="nim" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nama</label>
                        <input type="text" class="form-control" id="nama" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Jurusan</label>
                        <input type="text" class="form-control" id="jurusan" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Mahasiswa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="editForm">
                    <div class="mb-3">
                        <label class="form-label">NIM</label>
                        <input type="text" class="form-control" id="edit_nim" readonly>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nama</label>
                        <input type="text" class="form-control" id="edit_nama" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Jurusan</label>
                        <input type="text" class="form-control" id="edit_jurusan" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Pastikan SweetAlert2 sudah di-load, bisa di layout utama atau di sini --}}
{{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script> --}}
{{-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css"> --}}

@push('scripts')
<script type="module">
    import { ref, get, set, remove, child } from "https://www.gstatic.com/firebasejs/10.8.0/firebase-database.js";

    try {
        const mahasiswaRef = ref(window.db, 'mahasiswa');

        // Fungsi untuk memuat data
        async function loadData() {
            try {
                const snapshot = await get(mahasiswaRef);
                const data = snapshot.val();
                let html = '';
                
                if (data) {
                    Object.entries(data).forEach(([nim, mhs]) => {
                        html += `
                            <tr>
                                <td class="ps-3">
                                    <p class="text-xs font-weight-bold mb-0">${nim}</p>
                                </td>
                                <td>
                                    <p class="text-xs font-weight-bold mb-0">${mhs.nama}</p>
                                </td>
                                <td>
                                    <p class="text-xs font-weight-bold mb-0">${mhs.jurusan}</p>
                                </td>
                                <td>
                                    <button class="btn btn-info btn-sm edit-btn" 
                                        data-nim="${nim}"
                                        data-nama="${mhs.nama}"
                                        data-jurusan="${mhs.jurusan}">Edit</button>
                                    <button class="btn btn-danger btn-sm delete-btn" data-nim="${nim}">Hapus</button>
                                </td>
                            </tr>
                        `;
                    });
                } else {
                    html = '<tr><td colspan="4" class="text-center">Tidak ada data</td></tr>';
                }
                
                document.getElementById('mahasiswaList').innerHTML = html;
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

        function attachActionListeners() {
            document.querySelectorAll('.edit-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const nim = this.dataset.nim;
                    const nama = this.dataset.nama;
                    const jurusan = this.dataset.jurusan;
                    window.editMahasiswa(nim, nama, jurusan);
                });
            });

            document.querySelectorAll('.delete-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const nim = this.dataset.nim;
                    window.deleteMahasiswa(nim);
                });
            });
        }

        loadData();

        document.getElementById('addForm').addEventListener('submit', async (e) => {
            e.preventDefault();
            try {
                const nim = document.getElementById('nim').value.trim();
                const nama = document.getElementById('nama').value.trim();
                const jurusan = document.getElementById('jurusan').value.trim();

                if (!nim || !nama || !jurusan) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Input Tidak Lengkap',
                        text: 'Semua field harus diisi!',
                    });
                    return;
                }

                // Cek duplikat NIM
                const nimRef = child(mahasiswaRef, nim);
                const snapshot = await get(nimRef);
                if (snapshot.exists()) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal Menambah',
                        text: 'NIM sudah terdaftar!',
                    });
                    return;
                }

                const newData = {
                    nama,
                    jurusan
                };

                await set(nimRef, newData);
                
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
                    text: 'Data mahasiswa berhasil ditambahkan.',
                    timer: 1500,
                    showConfirmButton: false
                });
            } catch (error) {
                console.error('Error adding data:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Gagal menambahkan data: ' + error.message,
                });
            }
        });

        window.editMahasiswa = (nim, nama, jurusan) => {
            document.getElementById('edit_nim').value = nim;
            document.getElementById('edit_nama').value = nama;
            document.getElementById('edit_jurusan').value = jurusan;
            
            const editModalElement = document.getElementById('editModal');
            const editModalInstance = new bootstrap.Modal(editModalElement);
            editModalInstance.show();
        };

        document.getElementById('editForm').addEventListener('submit', async (e) => {
            e.preventDefault();
            try {
                const nim = document.getElementById('edit_nim').value;
                const nama = document.getElementById('edit_nama').value.trim();
                const jurusan = document.getElementById('edit_jurusan').value.trim();

                if (!nama || !jurusan) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Input Tidak Lengkap',
                        text: 'Semua field harus diisi!',
                    });
                    return;
                }

                const updatedData = {
                    nama,
                    jurusan
                };

                await set(child(mahasiswaRef, nim), updatedData);
                
                const editModalElement = document.getElementById('editModal');
                const editModalInstance = bootstrap.Modal.getInstance(editModalElement);
                if (editModalInstance) {
                    editModalInstance.hide();
                }
                
                loadData();
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: 'Data mahasiswa berhasil diupdate.',
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
        });

        window.deleteMahasiswa = async (nim) => {
            Swal.fire({
                title: 'Anda Yakin?',
                text: "Data mahasiswa ini akan dihapus secara permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
            }).then(async (result) => {
                if (result.isConfirmed) {
                    try {
                        await remove(child(mahasiswaRef, nim));
                        loadData();
                        Swal.fire(
                            'Dihapus!',
                            'Data mahasiswa berhasil dihapus.',
                            'success'
                        );
                    } catch (error) {
                        console.error('Error deleting data:', error);
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Gagal menghapus data: ' + error.message,
                        });
                    }
                }
            });
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