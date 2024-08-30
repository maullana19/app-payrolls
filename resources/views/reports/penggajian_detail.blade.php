@extends('layouts.app')

@section('title', 'Laporan Gaji Karyawan')

@section('contents')
    <div>
        <div class="table-responsive bg-white rounded shadow-sm p-3">
            <div class="text-center mb-3">
                <h5 class="fw-bold">Laporan Gaji Karyawan Periode {{ \Carbon\Carbon::parse($startDate)->format('d-m-Y') }}
                    sampai
                    {{ \Carbon\Carbon::parse($endDate)->format('d-m-Y') }}</h5>
            </div>
            <table class="table table-bordered  align-middle text-center">
                @php
                    $totalGaji = 0;
                    $totalPotongan = 0;
                    $totalLembur = 0;
                    $totalHari = 0;
                    foreach ($dataGaji as $gaji) {
                        $totalGaji += $gaji->total_gaji_bersih;
                        $totalPotongan += $gaji->total_potongan;
                        $totalLembur += $gaji->total_lembur;
                        $totalHari += $gaji->total_hari;
                    }

                @endphp
                <caption style="color: #131842; font-weight: bold;">Total Gaji :
                    {{ 'Rp. ' . number_format($totalGaji, 0, ',', '.') }} |
                    Total Lembur : {{ $totalLembur }} | Total Potongan :
                    {{ 'Rp. ' . number_format($totalPotongan, 0, ',', '.') }} | Total Kehadiran : {{ $totalHari }}
                </caption>
                <thead class="table-info align-middle">
                    <tr>
                        <th>No</th>
                        <th>Nik</th>
                        <th>Nama</th>
                        <th>Departement</th>
                        <th>Gross Pay</th>
                        <th>Total Kehadiran</th>
                        <th>Total Lembur (jam)</th>
                        <th>Total Potongan</th>
                        <th>Total Gaji</th>
                        <th>Tgl Gaji</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($dataGaji as $gaji)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $gaji->absensi->karyawan->nik }}</td>
                            <td>{{ $gaji->absensi->karyawan->nama_lengkap }}</td>
                            <td>{{ $gaji->absensi->karyawan->jabatan->departement->nama_dept }}</td>
                            <td>{{ 'Rp. ' . number_format($gaji->gaji_kotor, 0, ',', '.') }}</td>
                            <td>{{ $gaji->total_hari }}</td>
                            <td>{{ $gaji->total_lembur }}</td>
                            <td>{{ 'Rp. ' . number_format($gaji->total_potongan, 0, ',', '.') }}</td>
                            <td>{{ 'Rp. ' . number_format($gaji->total_gaji_bersih, 0, ',', '.') }}</td>
                            <td>{{ $gaji->tgl_gaji }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('data-gaji') }}" class="btn btn-danger btn-sm">Kembali</a>
                <form action="{{ route('cetak-laporan-gaji-detail') }}" method="GET" target="_blank">
                    <input type="hidden" name="start_date" value="{{ $startDate }}">
                    <input type="hidden" name="end_date" value="{{ $endDate }}">
                    <button type="submit" class="btn btn-info btn-sm">Cetak PDF</button>
                </form>
            </div>
        </div>
    </div>
@endsection
