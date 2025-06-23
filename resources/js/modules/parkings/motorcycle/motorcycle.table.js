class MotorcycleTable {
    constructor() {
        this.allEntries = [];
        this.currentPage = 1;
        this.entriesPerPage = 10;
        this.initializeEventListeners();
    }

    initializeEventListeners() {
        const entriesSelect = document.getElementById('entriesPerPage');
        if (entriesSelect) {
            entriesSelect.addEventListener('change', (e) => {
                this.entriesPerPage = parseInt(e.target.value);
                this.currentPage = 1;
                this.renderTable();
            });
        }

        window.changePage = (page) => this.changePage(page);
    }

    loadData(data) {
        this.allEntries = [];

        Object.keys(data).forEach(key => {
            this.allEntries.push({
                key: key,
                ...data[key]
            });
        });

        this.allEntries.sort((a, b) => {
            const dateA = new Date(a.tanggal + ' ' + a.waktu);
            const dateB = new Date(b.tanggal + ' ' + b.waktu);
            return dateB - dateA;
        });

        this.currentPage = 1;
        this.renderTable();
        this.updateLastUpdated();
    }

    renderPagination() {
        const totalPages = Math.ceil(this.allEntries.length / this.entriesPerPage);
        const pagination = document.getElementById('pagination');

        if (!pagination) return;

        let paginationHtml = '';

        paginationHtml += `
            <li class="page-item ${this.currentPage === 1 ? 'disabled' : ''}">
                <a class="page-link" href="#" onclick="changePage(${this.currentPage - 1})" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
        `;

        const startPage = Math.max(1, this.currentPage - 2);
        const endPage = Math.min(totalPages, this.currentPage + 2);

        if (startPage > 1) {
            paginationHtml += `<li class="page-item"><a class="page-link" href="#" onclick="changePage(1)">1</a></li>`;
            if (startPage > 2) {
                paginationHtml += `<li class="page-item disabled"><span class="page-link">...</span></li>`;
            }
        }

        for (let i = startPage; i <= endPage; i++) {
            paginationHtml += `
                <li class="page-item ${i === this.currentPage ? 'active' : ''}">
                    <a class="page-link" href="#" onclick="changePage(${i})">${i}</a>
                </li>
            `;
        }

        if (endPage < totalPages) {
            if (endPage < totalPages - 1) {
                paginationHtml += `<li class="page-item disabled"><span class="page-link">...</span></li>`;
            }
            paginationHtml += `<li class="page-item"><a class="page-link" href="#" onclick="changePage(${totalPages})">${totalPages}</a></li>`;
        }

        paginationHtml += `
            <li class="page-item ${this.currentPage === totalPages ? 'disabled' : ''}">
                <a class="page-link" href="#" onclick="changePage(${this.currentPage + 1})" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        `;

        pagination.innerHTML = paginationHtml;
        this.updatePaginationInfo();
    }

    updatePaginationInfo() {
        const start = (this.currentPage - 1) * this.entriesPerPage + 1;
        const end = Math.min(this.currentPage * this.entriesPerPage, this.allEntries.length);

        const showingStart = document.getElementById('showingStart');
        const showingEnd = document.getElementById('showingEnd');
        const totalEntries = document.getElementById('totalEntries');

        if (showingStart) showingStart.textContent = this.allEntries.length > 0 ? start : 0;
        if (showingEnd) showingEnd.textContent = end;
        if (totalEntries) totalEntries.textContent = this.allEntries.length;
    }

    renderTable() {
        const start = (this.currentPage - 1) * this.entriesPerPage;
        const end = start + this.entriesPerPage;
        const pageEntries = this.allEntries.slice(start, end);

        let html = '';

        if (pageEntries.length > 0) {
            pageEntries.forEach(entry => {
                html += `
                    <tr>
                        <td class="ps-3">
                            <p class="text-xs font-weight-bold mb-0">${entry.tanggal}</p>
                        </td>
                        <td>
                            <p class="text-xs font-weight-bold mb-0">${entry.waktu}</p>
                        </td>
                        <td>
                            <p class="text-xs font-weight-bold mb-0">${entry.nim}</p>
                        </td>
                        <td>
                            <p class="text-xs font-weight-bold mb-0">${entry.nama}</p>
                        </td>
                        <td>
                            <p class="text-xs font-weight-bold mb-0">${entry.jurusan}</p>
                        </td>
                        <td>
                            <span class="badge badge-sm bg-gradient-${entry.akses === 'ktm' ? 'primary' : 'success'}">${entry.akses}</span>
                        </td>
                    </tr>
                `;
            });
        } else {
            html = '<tr><td colspan="6" class="text-center">Tidak ada data</td></tr>';
        }

        const motorList = document.getElementById('motorList');
        if (motorList) {
            motorList.innerHTML = html;
        }

        this.renderPagination();
    }

    changePage(page) {
        const totalPages = Math.ceil(this.allEntries.length / this.entriesPerPage);
        if (page >= 1 && page <= totalPages) {
            this.currentPage = page;
            this.renderTable();
        }
    }

    updateLastUpdated() {
        const lastUpdated = document.getElementById('last_updated');
        if (lastUpdated) {
            lastUpdated.textContent = new Date().toLocaleString('id-ID');
        }
    }
}

export default MotorcycleTable;
