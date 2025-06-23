<style>
    /* Root Variables for Color Palette */
    :root {
        --dark-bg: #1e2a3a;
        --light-text: #ffffff;
        --muted-text: #cfd8dc;
        --radius-md: 0.75rem;
        --shadow-md: 0 0.5rem 1rem rgba(0, 0, 0, 0.2);
    }

    /* Card Container */
    .card {
        background-color: var(--dark-bg);
        border: none;
        border-radius: var(--radius-md);
        box-shadow: var(--shadow-md);
        color: var(--light-text);
        margin-bottom: 1.5rem;
        transition: all 0.3s ease-in-out;
    }

    .card:hover {
        transform: translateY(-2px);
        box-shadow: 0 0.75rem 1.5rem rgba(0, 0, 0, 0.3);
    }

    /* Card Body */
    .card-body {
        padding: 1rem 1.25rem;
    }

    /* Statistik Number Display */
    .numbers h5 {
        font-size: 1.5rem;
        font-weight: 700;
        margin: 0;
        color: var(--light-text);
    }

    .numbers p {
        font-size: 0.875rem;
        margin-bottom: 0.25rem;
        font-weight: 600;
        color: var(--muted-text);
        text-transform: capitalize;
    }

    /* Icon Container */
    .icon-shape {
        width: 48px;
        height: 48px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: var(--radius-md);
    }

    .text-center {
        text-align: center !important;
    }

    .text-end {
        text-align: end !important;
    }

    /* Gradients */
    .bg-gradient-primary {
        background: linear-gradient(87deg, #007bff, #5e72e4);
        color: #fff;
    }

    .bg-gradient-success {
        background: linear-gradient(87deg, #28a745, #2dce89);
        color: #fff;
    }

    .bg-gradient-info {
        background: linear-gradient(87deg, #11cdef, #1171ef);
        color: #fff;
    }

    /* Font Weight Utilities */
    .font-weight-bold {
        font-weight: 700 !important;
    }

    .font-weight-bolder {
        font-weight: 900 !important;
    }

    /* Font Size Utility */
    .text-sm {
        font-size: 0.875rem !important;
    }

    .text-lg {
        font-size: 1.25rem !important;
    }

    .mb-0 {
        margin-bottom: 0 !important;
    }

    .mb-4 {
        margin-bottom: 1.5rem !important;
    }

    /* Opacity utility */
    .opacity-10 {
        opacity: 0.8;
    }

    /* Border Radius Utility */
    .border-radius-md {
        border-radius: var(--radius-md);
    }
</style>

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
                            <i class="fas fa-id-card text-lg opacity-10" aria-hidden="true"></i>
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
                            <i class="fas fa-user text-lg opacity-10" aria-hidden="true"></i>
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
