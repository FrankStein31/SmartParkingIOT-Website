class MotorcycleChart {
    constructor() {
        this.aksesChart = null;
        this.hourlyChart = null;
        this.initializeChartJS();
    }

    initializeChartJS() {
        Chart.register(ChartDataLabels);
    }

    analyzeHourlyData(data) {
        const hourlyStats = {};

        for(let i = 0; i < 24; i++) {
            hourlyStats[i] = 0;
        }

        Object.keys(data).forEach(key => {
            const entry = data[key];
            const hour = parseInt(entry.waktu.split(':')[0]);
            hourlyStats[hour]++;
        });

        return hourlyStats;
    }

    updateHourlyChart(data) {
        const hourlyStats = this.analyzeHourlyData(data);
        const ctx = document.getElementById('hourlyChart').getContext('2d');

        if (this.hourlyChart) {
            this.hourlyChart.destroy();
        }

        const hours = Object.keys(hourlyStats);
        const values = Object.values(hourlyStats);

        this.hourlyChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: hours.map(h => h + ':00'),
                datasets: [{
                    label: 'Jumlah Akses',
                    data: values,
                    borderColor: '#5e72e4',
                    backgroundColor: 'rgba(94, 114, 228, 0.1)',
                    borderWidth: 2,
                    fill: true,
                    tension: 0.4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    }
                }
            }
        });

        this.updatePeakHourInfo(hours, values);
    }

    updatePeakHourInfo(hours, values) {
        const maxCount = Math.max(...values);
        const peakHourIndex = values.indexOf(maxCount);
        const peakHour = hours[peakHourIndex];

        document.getElementById('peakHour').textContent = peakHour + ':00';
        document.getElementById('peakCount').textContent = maxCount;

        const totalHours = values.filter(v => v > 0).length;
        const avgPerHour = totalHours > 0 ? Math.round(values.reduce((a, b) => a + b, 0) / totalHours) : 0;
        document.getElementById('avgPerHour').textContent = avgPerHour;
    }

    calculateAccessStats(data) {
        let ktmCount = 0;
        let petugasCount = 0;
        let totalCount = 0;

        Object.keys(data).forEach(key => {
            const entry = data[key];
            totalCount++;

            if (entry.akses === 'ktm') {
                ktmCount++;
            } else if (entry.akses === 'petugas') {
                petugasCount++;
            }
        });

        return {
            ktm: ktmCount,
            petugas: petugasCount,
            total: totalCount
        };
    }

    updateAccessChart(stats) {
        const canvas = document.getElementById('aksesChart')
        const ctx = canvas.getContext('2d');

        const existingChart = Chart.getChart(canvas);
        if (existingChart) {
            existingChart.destroy();
        }

        const total = stats.ktm + stats.petugas;

        this.aksesChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: [`Akses via KTM`, `Akses via Petugas`],
                datasets: [{
                    data: [stats.ktm, stats.petugas],
                    backgroundColor: [
                        '#5e72e4',
                        '#2dce89'
                    ],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                const label = context.label || '';
                                const value = context.parsed;
                                return label + ': ' + value + ' akses';
                            }
                        }
                    },
                    datalabels: {
                        display: true,
                        color: 'white',
                        font: {
                            weight: 'bold',
                            size: 14
                        },
                        formatter: function(value, context) {
                            const total = context.dataset.data.reduce((a, b) => a + b, 0);
                            const percentage = total > 0 ? Math.round((value / total) * 100) : 0;
                            return percentage > 5 ? percentage + '%' : '';
                        }
                    }
                }
            }
        });
    }

    updateStats(stats) {
        document.getElementById('totalKtm').textContent = stats.ktm;
        document.getElementById('totalPetugas').textContent = stats.petugas;
        document.getElementById('totalAkses').textContent = stats.total;
        this.updateAccessChart(stats);
    }

    destroy() {
        if (this.aksesChart) {
            this.aksesChart.destroy();
        }
        if (this.hourlyChart) {
            this.hourlyChart.destroy();
        }
    }
}

export default MotorcycleChart;
