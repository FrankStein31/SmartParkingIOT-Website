import './bootstrap';
import { db } from './modules/firebase.config.js';
import MotorcycleDashboard from './modules/parkings/motorcycle/motorcycle.dashboard.js';

let motorcycleDashboard = null;

document.addEventListener('DOMContentLoaded', function() {
    try {
        if (!window.db && !db) {
            throw new Error('Firebase database not initialized');
        }

        const database = window.db || db;

        motorcycleDashboard = new MotorcycleDashboard(database);

        window.motorcycleDashboard = motorcycleDashboard;

        console.log('Application initialized successfully');

    } catch (error) {
        console.error('Application initialization failed:', error);

        if (typeof Swal !== 'undefined') {
            Swal.fire({
                icon: 'error',
                title: 'Kesalahan Aplikasi',
                text: 'Gagal menginisialisasi aplikasi: ' + error.message,
                confirmButtonText: 'OK'
            });
        } else {
            alert('Error inisialisasi aplikasi: ' + error.message);
        }
    }
});

window.addEventListener('beforeunload', function() {
    if (motorcycleDashboard) {
        motorcycleDashboard.cleanup();
    }
});

export { motorcycleDashboard };
