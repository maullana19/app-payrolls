@extends('layouts.app')

@section('title', 'Search Results')

@section('contents')

    @if (count($karyawans) == 0)
        <p>Data Not Found</p>
    @else
        @foreach ($karyawans as $karyawan)
            <div>

                <img src="{{ asset('storage/' . $karyawan->foto) }}" class="card-img-top" alt="...">

                <div class="card-body">
                    <h5 class="card-title">{{ $karyawan->nama_lengkap }}</h5>
                    <p class="card-text">{{ $karyawan->jabatan ? $karyawan->jabatan->nama_jabatan : '-' }}</p>
                </div>

                <ul class="list-group list-group-flush">
                    <li class="list-group-item">NIK : {{ $karyawan->nik }}</li>
                    <li class="list-group-item">Jabatan : {{ $karyawan->jabatan ? $karyawan->jabatan->nama_jabatan : '-' }}
                    </li>
                    <li class="list-group-item">NIP : {{ $karyawan->nik }}</li>
                    <li class="list-group-item">Email : {{ $karyawan->email }}</li>
                </ul>

            </div>
        @endforeach
    @endif

@endSection
