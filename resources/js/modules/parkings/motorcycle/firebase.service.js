import { ref, onValue } from "https://www.gstatic.com/firebasejs/10.8.0/firebase-database.js";

class FirebaseService {
    constructor(database) {
        this.db = database;
        this.parkirRef = ref(this.db, 'parkir/Motor');
        this.tempatParkirRef = ref(this.db, 'tempat_parkir/Motor');
        this.listeners = [];
    }

    onParkirDataChange(callback) {
        const unsubscribe = onValue(this.parkirRef, (snapshot) => {
            console.log('Data Parkir Motor:', snapshot.val());
            const data = snapshot.val() || {};
            callback(data);
        }, (error) => {
            console.error('Error listening to parkir data:', error);
            this.handleError(error);
        });

        this.listeners.push(unsubscribe);
        return unsubscribe;
    }

    onSlotStatusChange(callback) {
        const unsubscribe = onValue(this.tempatParkirRef, (snapshot) => {
            console.log('Data Slot Motor:', snapshot.val());
            const data = snapshot.val() || {};
            callback(data);
        }, (error) => {
            console.error('Error listening to slot data:', error);
            this.handleError(error);
        });

        this.listeners.push(unsubscribe);
        return unsubscribe;
    }

    handleError(error) {
        console.error('Firebase error:', error);

        if (typeof Swal !== 'undefined') {
            Swal.fire({
                icon: 'error',
                title: 'Kesalahan Firebase',
                text: 'Gagal terhubung ke database: ' + error.message,
                confirmButtonText: 'OK'
            });
        } else {
            alert('Error Firebase: ' + error.message);
        }
    }

    cleanup() {
        this.listeners.forEach(unsubscribe => {
            if (typeof unsubscribe === 'function') {
                unsubscribe();
            }
        });
        this.listeners = [];
    }

    async getParkirDataOnce() {
        try {
            return new Promise((resolve, reject) => {
                onValue(this.parkirRef, (snapshot) => {
                    resolve(snapshot.val() || {});
                }, reject, { onlyOnce: true });
            });
        } catch (error) {
            console.error('Error getting parkir data:', error);
            throw error;
        }
    }

    async getSlotDataOnce() {
        try {
            return new Promise((resolve, reject) => {
                onValue(this.tempatParkirRef, (snapshot) => {
                    resolve(snapshot.val() || {});
                }, reject, { onlyOnce: true });
            });
        } catch (error) {
            console.error('Error getting slot data:', error);
            throw error;
        }
    }
}

export default FirebaseService;
