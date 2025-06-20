<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3" id="sidenav-main">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href="/">
            <i class="fas fa-parking fa-2x text-primary"></i>
            <span class="ms-1 font-weight-bold">Smart Parking IOT</span>
        </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse w-auto max-height-vh-100 h-100" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link {{ request()->is('dashboard') ? 'active' : '' }}" href="/dashboard">
                    <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fas fa-home {{ request()->is('dashboard') ? 'text-white' : 'text-dark' }}"></i>
                    </div>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>
            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Manajemen Parkir</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('parkir-motor*') ? 'active' : '' }}" href="/parkir-motor">
                    <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fas fa-motorcycle {{ request()->is('parkir-motor*') ? 'text-white' : 'text-dark' }}"></i>
                    </div>
                    <span class="nav-link-text ms-1">Parkir Motor</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('parkir-mobil*') ? 'active' : '' }}" href="/parkir-mobil">
                    <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fas fa-car {{ request()->is('parkir-mobil*') ? 'text-white' : 'text-dark' }}"></i>
                    </div>
                    <span class="nav-link-text ms-1">Parkir Mobil</span>
                </a>
            </li>

            <!-- Jam Ramai Motor -->
            <li class="nav-item">
                <a class="nav-link {{ request()->is('jam-ramai-motor*') ? 'active' : '' }}" href="/jam-ramai-motor">
                    <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fas fa-chart-bar {{ request()->is('jam-ramai-motor*') ? 'text-white' : 'text-dark' }}"></i>
                    </div>
                    <span class="nav-link-text ms-1">Jam Ramai Motor</span>
                </a>
            </li>


            <li class="nav-item mt-3">
                <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Data Master</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('mahasiswa*') ? 'active' : '' }}" href="/mahasiswa">
                    <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fas fa-users {{ request()->is('mahasiswa*') ? 'text-white' : 'text-dark' }}"></i>
                    </div>
                    <span class="nav-link-text ms-1">Mahasiswa</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('portal*') ? 'active' : '' }}" href="/portal">
                    <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fas fa-door-open {{ request()->is('portal*') ? 'text-white' : 'text-dark' }}"></i>
                    </div>
                    <span class="nav-link-text ms-1">Kelola Portal</span>
                </a>
            </li>
        </ul>
    </div>
</aside>