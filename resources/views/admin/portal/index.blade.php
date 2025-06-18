@extends('layouts.admin')

@section('title', 'Dashboard - Admin Panel')



@section('content')

<div class="container">
    <div class="wrap">
        <h2 class="section-title scroll-animate">Kelola Portal & Jadwal Sistem</h2>
        <div class="content-card scroll-animate">
            <div class="card-header">
                <h6><i class="fas fa-cogs me-2"></i>Pengaturan Jadwal Operasional Portal</h6>
            </div>
            <div class="card-body">
                <div class="row gy-5">
                    <div class="col-md-6">
                        <h5 class="mb-4 text-light"><i class="fas fa-motorcycle me-2"></i>Portal Motor</h5>
                        <div class="mb-3"><label class="form-label">Jam Mulai</label><input type="time" class="form-control" id="motor_jam_mulai"></div>
                        <div class="mb-3"><label class="form-label">Jam Selesai</label><input type="time" class="form-control" id="motor_jam_selesai"></div>
                        <div class="mb-3"><label class="form-label">Status Operasional</label><select class="form-select" id="motor_operasional"><option value="on">On</option><option value="off">Off</option></select></div>
                        <button class="btn btn-info" onclick="updateJadwal('motor')">Update Jadwal Motor</button>
                    </div>
                    <div class="col-md-6">
                        <h5 class="mb-4 text-light"><i class="fas fa-car me-2"></i>Portal Mobil</h5>
                        <div class="mb-3"><label class="form-label">Jam Mulai</label><input type="time" class="form-control" id="mobil_jam_mulai"></div>
                        <div class="mb-3"><label class="form-label">Jam Selesai</label><input type="time" class="form-control" id="mobil_jam_selesai"></div>
                         <div class="mb-3"><label class="form-label">Status Operasional</label><select class="form-select" id="mobil_operasional"><option value="on">On</option><option value="off">Off</option></select></div>
                        <button class="btn btn-info" onclick="updateJadwal('mobil')">Update Jadwal Mobil</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
