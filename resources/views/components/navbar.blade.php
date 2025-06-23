<nav id="mainNavbar" class="navbar navbar-expand-lg navbar-dark">
    <div class="container">
        <a class="navbar-brand" href="#" onclick="showSection('home')">Smart Parking IOT</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link" onclick="showSection('home')">Home</a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Manajemen Parkir</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" onclick="showSection('parkir-motor')">Parkir Motor</a></li>
                        <li><a class="dropdown-item" onclick="showSection('parkir-mobil')">Parkir Mobil</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Data Master</a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" onclick="showSection('mahasiswa')">Data Mahasiswa</a></li>
                        <li><a class="dropdown-item" onclick="showSection('portal')">Kelola Portal</a></li>
                    </ul>
                </li>
                <li class="nav-item ms-lg-3"><a href="/dashboard" class="btn btn-dashboard-nav">Dashboard</a></li>
            </ul>
        </div>
    </div>
</nav> 