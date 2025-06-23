@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-datalabels@2"></script>
@endpush

<div class="container">
    <h2 class="section-title">Manajemen Parkir Motor</h2>

    @include('components.motorcycle.summary')
    @include('components.motorcycle.charts')
    <div class="content-card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3>Status Slot Parkir Motor</h3>
            <p class="text-sm mb-0">
                <i class="fa-solid fa-circle text-success me-1"></i> Kosong
                <i class="fa-solid fa-circle text-danger ms-3 me-1"></i> Terisi
            </p>
        </div>
        <div class="card-body p-3">
            <div class="row gy-4" id="slotMotorList">
            </div>
        </div>
    </div>
    @include('components.motorcycle.trend')
    <div class="content-card">
        <div class="card-header pb-3">
            @include('components.motorcycle.header')
        </div>
        <div class="card-body px-0 pt-0 pb-2">
            <div class="table-responsive p-0">
                <table class="table align-items-center mb-0 table-dark-custom">
                    <thead>
                        <tr>
                            <th>Tanggal</th>
                            <th>Waktu</th>
                            <th>NIM</th>
                            <th>Nama</th>
                            <th>Jurusan</th>
                            <th>Akses</th>
                        </tr>
                    </thead>
                    <tbody id="motorList">
                    </tbody>
                </table>
            </div>

            <x-motorcycle.pagination-control />
        </div>
    </div>
</div>

<script>
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

    function renderTable() {
        const start = (currentPage - 1) * entriesPerPage;
        const end = Math.min(start + entriesPerPage, allEntries.length);
        const pageEntries = allEntries.slice(start, end);

        // Update pagination info
        document.getElementById('showingStart').textContent = allEntries.length ? start + 1 : 0;
        document.getElementById('showingEnd').textContent = end;
        document.getElementById('totalEntries').textContent = allEntries.length;

        let html = '';

        if (pageEntries.length > 0) {
            pageEntries.forEach(entry => {
                const badgeClass = entry.akses === 'ktm' ? 'badge-ktm' : 'badge-other-access';
                html += `
            <tr>
                <td class="ps-3">
                    <p class="text-xs font-weight-bold mb-0">${entry.tanggal}</p>
                </td>
                <td>
                    <p class="text-xs font-weight-bold mb-0">${entry.nim}</p>
                </td>
                <td>
                    <p class="text-xs font-weight-bold mb-0">${entry.nama}</p>
                </td>
                <td>
                    <span class="badge badge-sm ${badgeClass}">
                        ${entry.akses}
                    </span>
                </td>
            </tr>
        `;
            });
        } else {
            html = '<tr><td colspan="4" class="text-center">Tidak ada data</td></tr>';
        }

        document.getElementById('motorList').innerHTML = html;
        document.getElementById('last_updated').textContent = getLastUpdated();
    }
</script>
