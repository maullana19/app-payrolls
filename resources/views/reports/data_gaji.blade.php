@extends('layouts.app')

@section('title', 'Data Penggajian')

@section('contents')

    <div>
        @if (session('success'))
            <x-toasts-success>{{ session('success') }}</x-toasts-success>
        @endif

        @if (session('error'))
            <x-toasts-error>{{ session('error') }}</x-toasts-error>
        @endif
    </div>

    <div class="p-3 bg-white rounded mb-3 shadow-sm">
        <div>
            <h5>Buat Laporan Berperiode</h5>
        </div>
        <form method="GET" action="{{ route('laporan.gaji.detail') }}">
            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="start_date">Dari tgl:</label>
                    <input type="date" name="start_date" id="start_date" class="form-control form-control-sm"
                        value="{{ request('start_date') }}">
                </div>
                <div class="col-md-4">
                    <label for="end_date">Sampai Tgl:</label>
                    <input type="date" name="end_date" id="end_date" class="form-control form-control-sm"
                        value="{{ request('end_date') }}">
                </div>
                <div class="col align-self-end">
                    <button type="submit" class="btn btn-info btn-sm w-100">Buat</button>
                </div>
            </div>
        </form>
    </div>

    <div class="table-responsive bg-white rounded shadow-sm">
        <table class="table  align-middle ">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Karyawan</th>
                    <th>Jabatan</th>
                    <th>Gross Pay</th>
                    <th>Total Kehadiran</th>
                    <th>Total Lembur (jam)</th>
                    <th>Total Potongan</th>
                    <th>Total Gaji </th>
                    <th>Tgl Gaji</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($dataGaji as $gaji)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $gaji->absensi->karyawan->nama_lengkap }}</td>
                        <td>{{ $gaji->absensi->karyawan->jabatan->nama_jabatan }}</td>
                        <td>{{ 'Rp. ' . number_format($gaji->gaji_kotor, 0, ',', '.') }}</td>
                        <td>{{ $gaji->total_hari }}</td>
                        <td>{{ $gaji->total_lembur }}</td>
                        <td>{{ 'Rp. ' . number_format($gaji->total_potongan, 0, ',', '.') }}</td>
                        <td>{{ 'Rp. ' . number_format($gaji->total_gaji_bersih, 0, ',', '.') }}</td>
                        <td>{{ \Carbon\Carbon::parse($gaji->tgl_gaji)->format('d-m-Y') }}</td>
                        <td>
                            <div class="d-flex gap-2">
                                <form action="{{ route('cetak-slip-gaji', $gaji->id_penggajian) }}" method="GET">
                                    @csrf
                                    <button type="submit" class="btn btn-sm  btn-primary">Slip gaji</button>
                                </form>
                                <form action="{{ route('penggajian.delete', $gaji->id_penggajian) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"><i
                                            class="bi bi-trash"></i></button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endSection
