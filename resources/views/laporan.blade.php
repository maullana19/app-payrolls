@extends('layouts.app')

@section('title', 'Laporan')

@section('contents')
    <div>
        @if (session('success'))
            <x-toasts-success>{{ session('success') }}</x-toasts-success>
        @endif

        @if (session('error'))
            <x-toasts-error>{{ session('error') }}</x-toasts-error>
        @endif
    </div>

    <div>
        <h3 class="text-secondary">Menu Laporan</h3>
    </div>

    <div class="row rows-cols-3">

        <div class="col">
            <div class="card info-card " style="background: #DD761C;">
                <div class="card-body">
                    <h5 class="card-title text-white">List Gaji Karyawan<span></span></h5>
                    <div class="d-flex align-items-center text-white">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-journal-check"></i>
                        </div>
                        <div class="ps-3 ">
                            <h6><a href="{{ route('data-gaji') }}" class="text-white">Lihat</a></h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card info-card " style="background: #667BC6;">
                <div class="card-body">
                    <h5 class="card-title text-white">List Cuti Karyawan<span></span></h5>
                    <div class="d-flex align-items-center text-white">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-person-lines-fill"></i>
                        </div>
                        <div class="ps-3 ">
                            <h6><a href="{{ route('data-cuti') }}" class="text-white">Lihat</a></h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card info-card " style="background: #219C90;">
                <div class="card-body">
                    <h5 class="card-title text-white">Pengajuan Cuti <span></span></h5>
                    <div class="d-flex align-items-center text-white">
                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-file-text"></i>
                        </div>
                        <div class="ps-3 ">
                            <h6><a href="{{ route('form-cuti') }}" class="text-white">Buat</a></h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endSection
