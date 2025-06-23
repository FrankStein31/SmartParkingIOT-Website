class MotorcycleSlot {
    constructor() {
        this.totalSlots = 4;
    }

    loadSlotStatus(data) {
        let html = '';

        for (let i = 1; i <= this.totalSlots; i++) {
            const status = data['slot' + i] || 'available';
            const isAvailable = status === 'available';

            html += `
                <div class="col-3">
                    <div class="card bg-gradient-${isAvailable ? 'success' : 'danger'} border-0">
                        <div class="card-body p-3">
                            <div class="row">
                                <div class="col-8">
                                    <div class="numbers">
                                        <h5 class="text-white mb-0 text-center">
                                            Slot ${i}
                                        </h5>
                                        <p class="text-white text-sm mb-0 text-center">
                                            ${isAvailable ? 'Kosong' : 'Terisi'}
                                        </p>
                                    </div>
                                </div>
                                <div class="col-4 text-end">
                                    <div class="icon icon-shape bg-white shadow text-center border-radius-md">
                                        <i class="fas fa-motorcycle text-dark text-lg opacity-10" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            `;
        }

        const slotMotorList = document.getElementById('slotMotorList');
        if (slotMotorList) {
            slotMotorList.innerHTML = html;
        }
    }

    getSlotStatusSummary(data) {
        let availableSlots = 0;
        let occupiedSlots = 0;

        for (let i = 1; i <= this.totalSlots; i++) {
            const status = data['slot' + i] || 'available';
            if (status === 'available') {
                availableSlots++;
            } else {
                occupiedSlots++;
            }
        }

        return {
            available: availableSlots,
            occupied: occupiedSlots,
            total: this.totalSlots
        };
    }
}

export default MotorcycleSlot;
