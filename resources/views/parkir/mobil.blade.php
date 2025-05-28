@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card mb-4">
            <div class="card-header pb-0">
                <h6>Daftar Parkir Mobil</h6>
                <p class="text-sm mb-0">
                    <i class="fa fa-clock text-success" aria-hidden="true"></i>
                    <span class="font-weight-bold ms-1">Terakhir diperbarui:</span> {{ date('d M Y H:i:s') }}
                </p>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
                <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Slot</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Status</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Waktu Masuk</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Durasi</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Sensor</th>
                            </tr>
                        </thead>
                        <tbody>
                            @for($i = 1; $i <= 5; $i++)
                            <tr>
                                <td>
                                    <div class="d-flex px-3">
                                        <div class="my-auto">
                                            <h6 class="mb-0 text-sm">Mobil {{ $i }}</h6>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge badge-sm bg-gradient-{{ $i % 2 == 0 ? 'success' : 'danger' }}">
                                        {{ $i % 2 == 0 ? 'Kosong' : 'Terisi' }}
                                    </span>
                                </td>
                                <td class="align-middle text-center">
                                    <span class="text-secondary text-sm font-weight-bold">
                                        {{ $i % 2 == 0 ? '-' : '23 Jan 2024 08:00' }}
                                    </span>
                                </td>
                                <td class="align-middle text-center">
                                    <span class="text-secondary text-sm font-weight-bold">
                                        {{ $i % 2 == 0 ? '-' : '2 jam' }}
                                    </span>
                                </td>
                                <td class="align-middle text-center">
                                    <span class="text-secondary text-sm font-weight-bold">
                                        <i class="fas fa-circle text-{{ $i % 2 == 0 ? 'success' : 'danger' }}"></i>
                                    </span>
                                </td>
                            </tr>
                            @endfor
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <div class="col-lg-12">
        <div class="card z-index-2">
            <div class="card-header pb-0">
                <h6>Denah Parkir Mobil</h6>
                <p class="text-sm">
                    <i class="fa fa-info-circle text-info" aria-hidden="true"></i>
                    <span class="font-weight-bold">Status:</span> Merah = Terisi, Hijau = Kosong
                </p>
            </div>
            <div class="card-body p-3">
                <div class="row">
                    @for($i = 1; $i <= 5; $i++)
                    <div class="col">
                        <div class="card bg-gradient-{{ $i % 2 == 0 ? 'success' : 'danger' }} border-0">
                            <div class="card-body p-3">
                                <div class="row">
                                    <div class="col-8">
                                        <div class="numbers">
                                            <h5 class="text-white mb-0 text-center">
                                                Mobil {{ $i }}
                                            </h5>
                                        </div>
                                    </div>
                                    <div class="col-4 text-end">
                                        <div class="icon icon-shape bg-white shadow text-center border-radius-md">
                                            <i class="fas fa-car text-lg opacity-10" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endfor
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 