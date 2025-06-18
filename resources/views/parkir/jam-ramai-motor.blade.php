@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="card z-index-2">
            <div class="card-header pb-0">
                <h6>Grafik Jam Paling Ramai Parkir Motor</h6>
            </div>
            <div class="card-body">
                <canvas id="jamRamaiChart" height="100"></canvas>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script type="module">
    import {
        ref,
        onValue
    } from "https://www.gstatic.com/firebasejs/10.8.0/firebase-database.js";

    try {
        const parkirRef = ref(window.db, 'parkir/Motor');

        onValue(parkirRef, (snapshot) => {
            const data = snapshot.val() || {};
            const jamCount = {};

            Object.keys(data).forEach(tanggal => {
                Object.keys(data[tanggal]).forEach(jam => {
                    const hour = jam.split(':')[0];
                    jamCount[hour] = (jamCount[hour] || 0) + 1;
                });
            });

            const sortedHours = Object.keys(jamCount).sort((a, b) => a - b);
            const labels = sortedHours.map(j => `${j}:00`);
            const counts = sortedHours.map(j => jamCount[j]);

            const ctx = document.getElementById('jamRamaiChart').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Jumlah Parkir per Jam',
                        data: counts,
                        backgroundColor: 'rgba(75, 192, 192, 0.7)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                            suggestedMax: 10,
                            title: {
                                display: true,
                                text: 'Jumlah Parkir'
                            },
                            ticks: {
                                precision: 0,
                                stepSize: 1
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'Jam'
                            }
                        }
                    }
                }
            });
        });

    } catch (error) {
        console.error('Firebase Chart Error:', error);
        alert('Gagal memuat data chart: ' + error.message);
    }
</script>
@endpush
@endsection