<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Smart Parking IOT - Ultimate Dashboard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --primary-color: #1A2980;
            --secondary-color: #26D0CE;
            --bg-dark: #0f172a;
            --bg-light-transparent: rgba(255, 255, 255, 0.07);
            --border-color: rgba(255, 255, 255, 0.1);
            --text-primary: #ffffff;
            --text-secondary: #a0aec0;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--bg-dark);
            color: var(--text-secondary);
            overflow-x: hidden;
        }

        /* --- Navbar --- */
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1030;
            padding: 1rem 0;
            background-color: rgba(15, 23, 42, 0.95);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
        }

        .navbar-brand {
            color: var(--text-primary) !important;
            font-weight: 700;
            font-size: 1.75rem;
        }

        .nav-link {
            color: var(--text-secondary) !important;
            font-weight: 500;
            transition: color 0.3s ease;
            cursor: pointer;
        }
        .nav-link:hover, .navbar-brand:hover, .nav-link.active {
            color: var(--secondary-color) !important;
        }

        .dropdown-menu {
            background-color: rgba(30, 41, 59, 0.9);
            border: 1px solid var(--border-color);
            border-radius: 0.75rem;
        }
        .dropdown-item {
            color: var(--text-secondary);
            cursor: pointer;
        }
        .dropdown-item:hover {
            background-color: var(--bg-light-transparent);
            color: var(--secondary-color);
        }

        .btn-dashboard-nav {
            background: var(--secondary-color);
            color: var(--bg-dark);
            border: 2px solid var(--secondary-color);
            padding: 8px 24px;
            border-radius: 50px;
            transition: all 0.3s ease;
            font-weight: 600;
        }
        .btn-dashboard-nav:hover {
            background: transparent;
            color: var(--secondary-color);
        }

        /* --- Main Content Area --- */
        .main-content {
            margin-top: 80px;
            min-height: calc(100vh - 80px);
            padding: 2rem 0;
        }

        .content-section {
            display: none;
            animation: fadeIn 0.5s ease-in-out;
        }

        .content-section.active {
            display: block;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* --- Hero Section --- */
        .hero-section {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--bg-dark) 100%);
            min-height: calc(100vh - 80px);
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .hero-section .display-3 { font-weight: 700; }
        .hero-section .lead { font-size: 1.25rem; color: var(--text-secondary); }
        .btn-cta {
            background: var(--secondary-color);
            color: var(--bg-dark);
            border-radius: 50px;
            padding: 16px 40px;
            font-weight: 600;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
            cursor: pointer;
        }
        .btn-cta:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(38, 208, 206, 0.2);
        }

        /* --- Cards & Components --- */
        .content-card {
            background: var(--bg-light-transparent);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid var(--border-color);
            border-radius: 24px;
            padding: 2.5rem;
            color: var(--text-primary);
            box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.15);
            margin-bottom: 2rem;
        }
        .content-card .card-header {
            background: transparent;
            border-bottom: 1px solid var(--border-color);
            padding: 0 0 1.5rem 0;
            margin-bottom: 1.5rem;
        }

        .section-title {
            color: var(--text-primary);
            font-weight: 700;
            margin-bottom: 2rem;
            text-align: center;
        }

        /* --- Form & Table Enhancements --- */
        .form-label { color: var(--text-secondary); font-weight: 500; }
        .form-control, .form-select {
            background-color: rgba(0,0,0,0.25);
            color: var(--text-primary);
            border: 1px solid var(--border-color);
            padding: 0.75rem 1rem;
            border-radius: 0.5rem;
        }
        .form-control:focus, .form-select:focus {
            background-color: rgba(0,0,0,0.3);
            color: var(--text-primary);
            border-color: var(--secondary-color);
            box-shadow: 0 0 0 0.25rem rgba(38, 208, 206, 0.25);
        }
        .modal-content {
            background-color: #1e293b;
            border: 1px solid var(--secondary-color);
            border-radius: 1rem;
        }
        .table { color: var(--text-secondary); }
        .table thead th {
            color: var(--text-primary);
            border: none;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .table tbody tr { border-color: var(--border-color); }
        .table > :not(caption) > * > * { padding: 1rem; }

        /* --- Enhanced Parking Slot Status --- */
        .slot-card {
            background: var(--bg-light-transparent);
            border-radius: 1rem;
            padding: 1.5rem;
            text-align: center;
            border: 1px solid var(--border-color);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .slot-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }
        .slot-card .slot-icon { font-size: 2.5rem; }
        .slot-card .slot-number { font-size: 1.5rem; font-weight: 600; color: var(--text-primary); margin-top: 1rem; }
        .slot-card .slot-status { font-weight: 500; }
        .slot-card.available .slot-icon, .slot-card.available .slot-status { color: #34d399; }
        .slot-card.occupied .slot-icon, .slot-card.occupied .slot-status { color: #f87171; }

        /* --- Loading Spinner --- */
        .spinner {
            width: 40px;
            height: 40px;
            border: 4px solid var(--border-color);
            border-top: 4px solid var(--secondary-color);
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin: 2rem auto;
        }
        .table-dark-custom {
    background-color: black !important;
    color: white !important;
}

.table-dark-custom th,
.table-dark-custom td {
    background-color: #1e293b !important;
    color: white !important;
    border-color: #333 !important;
}
        @keyframes spin { 0% { transform: rotate(0deg); } 100% { transform: rotate(360deg); } }
    </style>
</head>

<body>
    @include('components.navbar')
    <div class="main-content">
        <div id="home" class="content-section active">
            @include('components.hero')
        </div>
        <div id="parkir-motor" class="content-section">
            @include('components.parkir-motor')
        </div>
        <div id="parkir-mobil" class="content-section">
            @include('components.parkir-mobil')
        </div>
        <div id="mahasiswa" class="content-section">
            @include('components.mahasiswa')
        </div>
        <div id="portal" class="content-section">
            @include('components.portal')
        </div>
    </div>
    <footer class="py-4" style="background-color: var(--bg-dark); border-top: 1px solid var(--border-color);">
        <div class="container text-center text-secondary">
            <p class="mb-0">&copy; <span id="currentYear"></span> Smart Parking IOT. Crafted for a Smarter Future.</p>
        </div>
    </footer>

    <!-- Modals -->
    <div class="modal fade" id="addModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered"><div class="modal-content">
            <div class="modal-header"><h5 class="modal-title">Tambah Mahasiswa</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
            <div class="modal-body">
                <form id="addForm">
                    <div class="mb-3"><label class="form-label">NIM</label><input type="text" class="form-control" id="nim" required></div>
                    <div class="mb-3"><label class="form-label">Nama</label><input type="text" class="form-control" id="nama" required></div>
                    <div class="mb-3"><label class="form-label">Jurusan</label><input type="text" class="form-control" id="jurusan" required></div>
                    <button type="submit" class="btn btn-primary w-100">Simpan</button>
                </form>
            </div>
        </div></div>
    </div>

    <div class="modal fade" id="editModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered"><div class="modal-content">
            <div class="modal-header"><h5 class="modal-title">Edit Mahasiswa</h5><button type="button" class="btn-close" data-bs-dismiss="modal"></button></div>
            <div class="modal-body">
                <form id="editForm">
                    <input type="hidden" id="edit_nim">
                    <div class="mb-3"><label class="form-label">NIM</label><input type="text" class="form-control" id="view_nim" readonly></div>
                    <div class="mb-3"><label class="form-label">Nama</label><input type="text" class="form-control" id="edit_nama" required></div>
                    <div class="mb-3"><label class="form-label">Jurusan</label><input type="text" class="form-control" id="edit_jurusan" required></div>
                    <button type="submit" class="btn btn-primary w-100">Update</button>
                </form>
            </div>
        </div></div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        // Navigation System
        function showSection(sectionId) {
            // Hide all sections
            const sections = document.querySelectorAll('.content-section');
            sections.forEach(section => {
                section.classList.remove('active');
            });

            // Show selected section
            const targetSection = document.getElementById(sectionId);
            if (targetSection) {
                targetSection.classList.add('active');
            }

            // Update navbar active state
            const navLinks = document.querySelectorAll('.nav-link');
            navLinks.forEach(link => {
                link.classList.remove('active');
            });

            // Close mobile navbar if open
            const navbarCollapse = document.getElementById('navbarNav');
            if (navbarCollapse.classList.contains('show')) {
                const bsCollapse = new bootstrap.Collapse(navbarCollapse);
                bsCollapse.hide();
            }
        }
    </script>

<script type="module">
    import { initializeApp } from "https://www.gstatic.com/firebasejs/10.8.0/firebase-app.js";
    import { getDatabase, ref, get, set, remove, child, onValue } from "https://www.gstatic.com/firebasejs/10.8.0/firebase-database.js";

    const firebaseConfig = {
        apiKey: "AIzaSyBW3o5yLi2KL6ukMvBAasmFLU9YHN2IpY8",
        authDomain: "steinlie-realtime.firebaseapp.com",
        databaseURL: "https://steinlie-realtime-default-rtdb.asia-southeast1.firebasedatabase.app",
        projectId: "steinlie-realtime",
        storageBucket: "steinlie-realtime.appspot.com",
        messagingSenderId: "324833723114",
        appId: "1:324833723114:web:e0f40337c88722f20c0d93",
    };

    const app = initializeApp(firebaseConfig);
    const db = getDatabase(app);

    // --- Global Functions & Helpers ---
    window.updateJadwal = updateJadwal;
    window.editMahasiswa = editMahasiswa;
    window.deleteMahasiswa = deleteMahasiswa;

    const loadingSpinner = '<tr><td colspan="4"><div class="spinner"></div></td></tr>';
    const noDataFound = (cols, text) => `<tr><td colspan="${cols}" class="text-center py-5">${text}</td></tr>`;

    // --- Mahasiswa Management ---
    const mahasiswaRef = ref(db, 'Mahasiswa');
    const mhsListEl = document.getElementById('mahasiswaList');

    async function loadMahasiswaData() {
        mhsListEl.innerHTML = loadingSpinner;
        try {
            const snapshot = await get(mahasiswaRef);
            const data = snapshot.val();
            let html = '';
            if (data) {
                Object.entries(data).forEach(([nim, mhs]) => {
                    html += `<tr>
                        <td><p class="mb-0">${nim}</p></td><td><p class="mb-0">${mhs.Nama || mhs.nama}</p></td>
                        <td><p class="mb-0">${mhs.Jurusan || mhs.jurusan}</p></td>
                        <td>
                            <button class="btn btn-info btn-sm" onclick="editMahasiswa('${nim}', '${mhs.Nama || mhs.nama}', '${mhs.Jurusan || mhs.jurusan}')"><i class="fas fa-edit"></i></button>
                            <button class="btn btn-danger btn-sm" onclick="deleteMahasiswa('${nim}')"><i class="fas fa-trash"></i></button>
                        </td></tr>`;
                });
            } else { html = noDataFound(4, "Tidak ada data mahasiswa."); }
            mhsListEl.innerHTML = html;
            tampilkanGrafikJurusan();

        } catch (error) { console.error(error); mhsListEl.innerHTML = noDataFound(4, "Gagal memuat data."); }
    }
    async function tampilkanGrafikJurusan() {
            try {
                const snapshot = await get(mahasiswaRef);
                const data = snapshot.val();
                const jurusanCount = {};

                if (data) {
                    Object.values(data).forEach(mhs => {
                        jurusanCount[mhs.Jurusan] = (jurusanCount[mhs.Jurusan] || 0) + 1;
                    });


                    if (window.jurusanChart instanceof Chart) {
                        window.jurusanChart.destroy();
                    }

                    const ctx = document.getElementById('jurusanChart').getContext('2d');
                    window.jurusanChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: Object.keys(jurusanCount),
                            datasets: [{
                                label: 'Jumlah Mahasiswa',
                                data: Object.values(jurusanCount),
                                backgroundColor: 'rgba(75, 192, 192, 0.6)',
                                borderColor: 'rgba(75, 192, 192, 1)',
                                borderWidth: 1
                            }]
                        },
                        options: {
                            responsive: true,
                            plugins: {
                                legend: {
                                    display: false
                                },
                                title: {
                                    display: false
                                }
                            },
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    ticks: {
                                        stepSize: 1,
                                        precision: 0
                                    }
                                }
                            }
                        }
                    });
                }
            } catch (error) {
                console.error("Gagal memuat grafik jurusan:", error);
            }
        }
    document.getElementById('addForm').addEventListener('submit', async (e) => {
        e.preventDefault();
        const nim = document.getElementById('nim').value.trim();
        const nama = document.getElementById('nama').value.trim();
        const jurusan = document.getElementById('jurusan').value.trim();
        if (!nim || !nama || !jurusan) return;

        const nimRef = child(mahasiswaRef, nim);
        const snapshot = await get(nimRef);
        if (snapshot.exists()) {
            Swal.fire({ icon: 'error', title: 'Gagal', text: 'NIM sudah terdaftar!' });
            return;
        }
        await set(nimRef, { nama, jurusan });
        document.getElementById('addForm').reset();
        bootstrap.Modal.getInstance(document.getElementById('addModal')).hide();
        loadMahasiswaData();
        Swal.fire({ icon: 'success', title: 'Berhasil!', text: 'Data mahasiswa ditambahkan.', timer: 1500, showConfirmButton: false });
    });

    function editMahasiswa(nim, nama, jurusan) {
        document.getElementById('edit_nim').value = nim;
        document.getElementById('view_nim').value = nim;
        document.getElementById('edit_nama').value = nama;
        document.getElementById('edit_jurusan').value = jurusan;
        new bootstrap.Modal(document.getElementById('editModal')).show();
    }

    document.getElementById('editForm').addEventListener('submit', async (e) => {
        e.preventDefault();
        const nim = document.getElementById('edit_nim').value;
        const nama = document.getElementById('edit_nama').value.trim();
        const jurusan = document.getElementById('edit_jurusan').value.trim();
        if (!nama || !jurusan) return;
        await set(child(mahasiswaRef, nim), { nama, jurusan });
        bootstrap.Modal.getInstance(document.getElementById('editModal')).hide();
        loadMahasiswaData();
        Swal.fire({ icon: 'success', title: 'Berhasil!', text: 'Data mahasiswa diupdate.', timer: 1500, showConfirmButton: false });
    });

    function deleteMahasiswa(nim) {
        Swal.fire({ title: 'Anda Yakin?', text: "Data ini akan dihapus permanen!", icon: 'warning', showCancelButton: true, confirmButtonColor: '#d33', confirmButtonText: 'Ya, Hapus!'})
        .then(async (result) => {
            if (result.isConfirmed) {
                await remove(child(mahasiswaRef, nim));
                loadMahasiswaData();
                Swal.fire('Dihapus!', 'Data mahasiswa berhasil dihapus.', 'success');
            }
        });
    }

    // --- Parking Management ---
    function setupParkingListeners(type) {
        const typeDb = type === 'Motor' ? 'Motor' : 'Mobil';
        const parkirRef = ref(db, `parkir/${typeDb}`);
        const tempatParkirRef = ref(db, `tempat_parkir/${typeDb}`);
        const listEl = document.getElementById(`${type.toLowerCase()}List`);
        const slotListEl = document.getElementById(`slot${type}List`);
        const iconClass = type === 'Motor' ? 'fa-motorcycle' : 'fa-car';

        listEl.innerHTML = loadingSpinner;
        slotListEl.innerHTML = '<div class="col-12"><div class="spinner"></div></div>';

        onValue(parkirRef, (snapshot) => {
            const data = snapshot.val() || {};
            let html = '', entries = [];
            Object.entries(data).forEach(([dateTime, value]) => {
                if (typeof value === 'object' && (value.nim || value.NIM)) {
                    entries.push({
                        tanggal: value.tanggal || '',
                        waktu: value.waktu || '',
                        nim: value.nim || value.NIM || '',
                        nama: value.nama || value.Nama || '',
                        jurusan: value.jurusan || value.Jurusan || '',
                        akses: value.akses || '',
                    });
                }
            });
            entries.sort((a, b) => (b.tanggal + ' ' + b.waktu).localeCompare(a.tanggal + ' ' + a.waktu));
            if (entries.length) {
                entries.forEach(e => { html += `<tr><td>${e.tanggal} ${e.waktu}</td><td>${e.nim}</td><td>${e.nama}</td><td>${e.akses}</td></tr>`; });
            } else { html = noDataFound(4, "Tidak ada riwayat parkir."); }
            listEl.innerHTML = html;
        });

        onValue(tempatParkirRef, (snapshot) => {
            const data = snapshot.val() || {};
            let html = '';
            for (let i = 1; i <= 4; i++) {
                const status = (data['slot' + i] || 'available');
                const isAvailable = status === 'available';
                html += `<div class="col-6 col-md-3">
                    <div class="slot-card ${isAvailable ? 'available' : 'occupied'}">
                        <i class="fas ${iconClass} slot-icon"></i>
                        <div class="slot-number">Slot ${i}</div>
                        <p class="slot-status mb-0">${isAvailable ? 'Kosong' : 'Terisi'}</p>
                    </div></div>`;
            }
            slotListEl.innerHTML = html;
        });
    }

    // --- Portal Management ---
    const jadwalRef = ref(db, 'jadwal_sistem');
    async function loadJadwalData() {
        const snapshot = await get(jadwalRef);
        const data = snapshot.val() || {};
        ['motor', 'mobil'].forEach(jenis => {
            if(data[jenis]) {
                document.getElementById(`${jenis}_jam_mulai`).value = data[jenis].jam_mulai || '';
                document.getElementById(`${jenis}_jam_selesai`).value = data[jenis].jam_selesai || '';
                document.getElementById(`${jenis}_operasional`).value = data[jenis].operasional || 'off';
            }
        });
    }
    async function updateJadwal(jenis) {
        const jamMulai = document.getElementById(`${jenis}_jam_mulai`).value;
        const jamSelesai = document.getElementById(`${jenis}_jam_selesai`).value;
        const operasional = document.getElementById(`${jenis}_operasional`).value;
        if (!jamMulai || !jamSelesai) {
            Swal.fire({ icon: 'warning', title: 'Input Tidak Lengkap!', text: 'Jam mulai dan selesai harus diisi!' }); return;
        }
        await set(child(jadwalRef, jenis), { jam_mulai: jamMulai, jam_selesai: jamSelesai, operasional });
        Swal.fire({ icon: 'success', title: 'Berhasil!', text: `Jadwal ${jenis} berhasil diupdate.`, timer: 1500, showConfirmButton: false });
    }

    // --- Initial Load ---
    document.addEventListener('DOMContentLoaded', () => {
        loadMahasiswaData();
        setupParkingListeners('Motor');
        setupParkingListeners('Mobil');
        loadJadwalData();
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const navbar = document.getElementById('mainNavbar');
        const scrollToTopBtn = document.getElementById("scrollToTopBtn");
        const scrollAnimateElements = document.querySelectorAll('.scroll-animate');

        // Navbar Scroll Effect
        const handleNavScroll = () => {
            if (window.scrollY > 50) navbar.classList.add('scrolled');
            else navbar.classList.remove('scrolled');
        };

        // Scroll to Top Button
        const handleScrollBtn = () => {
            if (document.body.scrollTop > 200 || document.documentElement.scrollTop > 200) {
                scrollToTopBtn.style.display = "block";
            } else {
                scrollToTopBtn.style.display = "none";
            }
        };
        scrollToTopBtn.addEventListener('click', () => window.scrollTo({top: 0, behavior: 'smooth'}));

        // Animate on Scroll
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('is-visible');
                }
            });
        }, { threshold: 0.1 });
        scrollAnimateElements.forEach(el => observer.observe(el));

        // Event Listeners
        window.addEventListener('scroll', () => {
            handleNavScroll();
            handleScrollBtn();
        });

        // Initial calls
        document.getElementById('currentYear').textContent = new Date().getFullYear();
    });
</script>
</body>
</html>