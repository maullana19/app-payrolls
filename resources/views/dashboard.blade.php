@extends('layouts.app')

@section('title', 'Dashboard')

@section('contents')

    @if (session('accessDenied'))
        <x-toasts-error>{{ session('accessDenied') }}</x-toasts-error>
    @endif
    <section class="section dashboard">
        <div class="row">

            <!-- Left side columns -->
            <div class="col-lg-8">
                <div class="row">
                    <div class="col-xxl-4 col-md-6">
                        <x-card-info title="Karyawan" subtitle="Total" value="{{ $dataPegawai->count() }}" icon="bi bi-people"
                            color="primary" />
                    </div>

                    <div class="col-xxl-4 col-md-6">
                        <x-card-info title="Jabatan" subtitle="Total" value="{{ $dataJabatan->count() }}"
                            icon="bi bi-clipboard-data" color="primary" />
                    </div>

                    <div class="col-xxl-4 col-md-6">
                        <x-card-info title="User" subtitle="Total" value="{{ $dataPengguna->count() }}"
                            icon="bi bi-person-check" color="primary" />
                    </div>

                    <div class="col-xxl-4 col-md-6">
                        <x-card-info title="Rekap Absen" subtitle="Total" value="{{ $dataAbsensi->count() }}"
                            icon="bi bi-box-arrow-in-up-right" color="primary" />
                    </div>

                    <div class="col-12">
                        <div class="card recent-sales overflow-auto">

                            <div class="filter">
                                <a class="icon" href="#" data-bs-toggle="dropdown"><i
                                        class="bi bi-three-dots"></i></a>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                    <li class="dropdown-header text-start">
                                        <h6>Filter</h6>
                                    </li>

                                    <li><a class="dropdown-item" href="#">Today</a></li>
                                    <li><a class="dropdown-item" href="#">This Month</a></li>
                                    <li><a class="dropdown-item" href="#">This Year</a></li>
                                </ul>
                            </div>

                            <div class="card-body">
                                <h5 class="card-title">Data Rekapan <span>| Status </span></h5>

                                <div class="table-responsive">
                                    <table class="table datatable">
                                        <thead>
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">Nama Pegawai</th>
                                                <th scope="col">Dari. Tgl</th>
                                                <th scope="col">Smp. Tgl</th>
                                                <th scope="col">Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($dataAbsensi as $absensi)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $absensi->karyawan->nama_lengkap }}</td>
                                                    <td>{{ $absensi->dari_tanggal }}</td>
                                                    <td>{{ $absensi->sampai_tanggal }}</td>
                                                    <td><span
                                                            class="badge {{ $absensi->status_validasi === 'validate' ? 'bg-success' : 'bg-danger' }}">{{ $absensi->status_validasi }}</span>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>

            <div class="col-lg-4">

                <div class="card">
                    <div class="card-body ">
                        <h5 class="card-title">Cuti Pegawai <span>| List</span></h5>

                        <div class="activity overflow-auto" style="max-height: 610px">
                            @if ($dataCutiPegawai->count() == 0)
                                <p class="text-center">Tidak ada data</p>
                            @else
                                @foreach ($dataCutiPegawai as $cuti)
                                    <div class="p-2 rounded bg-white border-bottom">
                                        <div class="d-flex justify-content-between ">
                                            <p class="fw-bold">{{ $cuti->karyawan->nama_lengkap }}</p>
                                            <form action="{{ route('cetak-slip-cuti', $cuti->id_cuti) }}" method="GET">
                                                <button type="submit" class="btn btn-sm "><small>Cetak</small></button>
                                            </form>

                                        </div>
                                        <div class="activity-item d-flex mb-2">
                                            <div class="activite-label">Tgl Mulai</div>
                                            <i
                                                class='bi bi-circle-fill activity-badge text-danger align-self-start'>{{ $cuti->tgl_mulai }}</i>
                                            <div class="activity-content">

                                            </div>
                                        </div>

                                        <div class="activity-item d-flex">
                                            <div class="activite-label">Tgl Selesai</div>
                                            <i
                                                class='bi bi-circle-fill activity-badge text-success align-self-start'>{{ $cuti->tgl_selesai }}</i>
                                            <div class="activity-content">

                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
@endSection
