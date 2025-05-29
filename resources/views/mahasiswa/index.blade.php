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
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Jobdeck</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="mahasiswaList">
                            <!-- Data akan diisi oleh JavaScript -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tambah -->
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
                        <label class="form-label">Jobdeck</label>
                        <input type="text" class="form-control" id="jobdeck" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal Edit -->
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
                        <label class="form-label">Jobdeck</label>
                        <input type="text" class="form-control" id="edit_jobdeck" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>

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
                    Object.entries(data).forEach(([key, mhs]) => {
                        html += `
                            <tr>
                                <td class="ps-3">
                                    <p class="text-xs font-weight-bold mb-0">${key}</p>
                                </td>
                                <td>
                                    <p class="text-xs font-weight-bold mb-0">${mhs.nama}</p>
                                </td>
                                <td>
                                    <p class="text-xs font-weight-bold mb-0">${mhs.jobdeck}</p>
                                </td>
                                <td>
                                    <button class="btn btn-info btn-sm" onclick="window.editMahasiswa('${key}', '${mhs.nama}', '${mhs.jobdeck}')">Edit</button>
                                    <button class="btn btn-danger btn-sm" onclick="window.deleteMahasiswa('${key}')">Hapus</button>
                                </td>
                            </tr>
                        `;
                    });
                } else {
                    html = '<tr><td colspan="4" class="text-center">Tidak ada data</td></tr>';
                }
                
                document.getElementById('mahasiswaList').innerHTML = html;
            } catch (error) {
                console.error('Error loading data:', error);
                alert('Error: ' + error.message);
            }
        }

        // Load data pertama kali
        loadData();

        // Tambah data
        document.getElementById('addForm').addEventListener('submit', async (e) => {
            e.preventDefault();
            try {
                const nim = document.getElementById('nim').value.trim();
                if (!nim) {
                    alert('NIM tidak boleh kosong!');
                    return;
                }

                // Cek duplikat NIM
                const nimRef = child(mahasiswaRef, nim);
                const snapshot = await get(nimRef);
                if (snapshot.exists()) {
                    alert('NIM sudah terdaftar!');
                    return;
                }

                const newData = {
                    nama: document.getElementById('nama').value.trim(),
                    jobdeck: document.getElementById('jobdeck').value.trim()
                };

                await set(nimRef, newData);
                document.getElementById('addForm').reset();
                document.getElementById('addModal').querySelector('.btn-close').click();
                loadData();
                alert('Data berhasil ditambahkan!');
            } catch (error) {
                console.error('Error:', error);
                alert('Error: ' + error.message);
            }
        });

        // Edit data
        window.editMahasiswa = (nim, nama, jobdeck) => {
            document.getElementById('edit_nim').value = nim;
            document.getElementById('edit_nama').value = nama;
            document.getElementById('edit_jobdeck').value = jobdeck;
            new bootstrap.Modal(document.getElementById('editModal')).show();
        };

        document.getElementById('editForm').addEventListener('submit', async (e) => {
            e.preventDefault();
            try {
                const nim = document.getElementById('edit_nim').value;
                const updatedData = {
                    nama: document.getElementById('edit_nama').value.trim(),
                    jobdeck: document.getElementById('edit_jobdeck').value.trim()
                };

                await set(child(mahasiswaRef, nim), updatedData);
                document.getElementById('editModal').querySelector('.btn-close').click();
                loadData();
                alert('Data berhasil diupdate!');
            } catch (error) {
                console.error('Error:', error);
                alert('Error: ' + error.message);
            }
        });

        // Hapus data
        window.deleteMahasiswa = async (nim) => {
            if (confirm('Yakin ingin menghapus data ini?')) {
                try {
                    await remove(child(mahasiswaRef, nim));
                    loadData();
                    alert('Data berhasil dihapus!');
                } catch (error) {
                    console.error('Error:', error);
                    alert('Error: ' + error.message);
                }
            }
        };

    } catch (error) {
        console.error('Firebase initialization error:', error);
        alert('Error: ' + error.message);
    }
</script>
@endpush
@endsection 