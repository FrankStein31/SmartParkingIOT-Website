import CarChart from './car.chart.js';
import CarTable from './car.table.js';
import CarSlot from './car.slot.js';
import FirebaseService from './firebase.service.js';

class CarDashboard {
    constructor(database) {
        this.carChart = new CarChart();
        this.carTable = new CarTable();
        this.carSlot = new CarSlot();
        this.firebaseService = new FirebaseService(database);

        this.initialize();
    }

    initialize() {
        try {
            this.setupFirebaseListeners();
            console.log('Car Dashboard initialized successfully');
        } catch (error) {
            console.error('Failed to initialize Car Dashboard:', error);
            this.handleInitializationError(error);
        }
    }

    setupFirebaseListeners() {
        this.firebaseService.onParkirDataChange((data) => {
            this.handleParkirDataUpdate(data);
        });

        this.firebaseService.onSlotStatusChange((data) => {
            this.handleSlotStatusUpdate(data);
        });
    }

    handleParkirDataUpdate(data) {
        try {
            this.carTable.loadData(data);

            const stats = this.carChart.calculateAccessStats(data);
            this.carChart.updateStats(stats);
            this.carChart.updateHourlyChart(data);

            console.log('Parkir data updated successfully');
        } catch (error) {
            console.error('Error updating parkir data:', error);
        }
    }

    handleSlotStatusUpdate(data) {
        try {
            this.carSlot.loadSlotStatus(data);
            console.log('Slot status updated successfully');
        } catch (error) {
            console.error('Error updating slot status:', error);
        }
    }

    handleInitializationError(error) {
        console.error('Dashboard initialization error:', error);

        if (typeof Swal !== 'undefined') {
            Swal.fire({
                icon: 'error',
                title: 'Kesalahan Inisialisasi Dashboard',
                text: 'Gagal menginisialisasi dashboard: ' + error.message,
                confirmButtonText: 'OK'
            });
        } else {
            alert('Error inisialisasi dashboard: ' + error.message);
        }
    }

    // Method untuk mendapatkan summary data
    async getDashboardSummary() {
        try {
            const [parkirData, slotData] = await Promise.all([
                this.firebaseService.getParkirDataOnce(),
                this.firebaseService.getSlotDataOnce()
            ]);

            const accessStats = this.carChart.calculateAccessStats(parkirData);
            const slotSummary = this.carSlot.getSlotStatusSummary(slotData);

            return {
                access: accessStats,
                slots: slotSummary,
                totalEntries: Object.keys(parkirData).length
            };
        } catch (error) {
            console.error('Error getting dashboard summary:', error);
            throw error;
        }
    }

    async refreshData() {
        try {
            const [parkirData, slotData] = await Promise.all([
                this.firebaseService.getParkirDataOnce(),
                this.firebaseService.getSlotDataOnce()
            ]);

            this.handleParkirDataUpdate(parkirData);
            this.handleSlotStatusUpdate(slotData);

            console.log('Data refreshed successfully');
        } catch (error) {
            console.error('Error refreshing data:', error);
            throw error;
        }
    }

    cleanup() {
        try {
            this.firebaseService.cleanup();
            this.carChart.destroy();
            console.log('Dashboard cleanup completed');
        } catch (error) {
            console.error('Error during cleanup:', error);
        }
    }
}

export default CarDashboard;
