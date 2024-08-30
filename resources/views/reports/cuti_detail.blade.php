@extends('layouts.app')

@section('title', 'Laporan Cuti ')

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
        <div class="text-center">
            <h4>Laporan Cuti Karyawan</h4>
            <p><span class="badge bg-primary"> - {{ \Carbon\Carbon::parse($startDate)->format('d-m-Y') }} s/d
                    {{ \Carbon\Carbon::parse($endDate)->format('d-m-Y') }} - </span></p>
        </div>

        </p>


        @if (session('error'))
            <div class="alert alert-danger mt-3">
                {{ session('error') }}
            </div>
        @endif

        @if (isset($cutis) && count($cutis) > 0)
            <div class="table-responsive bg-white rounded shadow-sm p-3 mt-4">
                <table class="table ">
                    <thead class="table-info align-middle">
                        <tr>
                            <th>No</th>
                            <th>No. Karyawan</th>
                            <th>Nama</th>
                            <th>Kode/Jabatan</th>
                            <th>Tanggal Mulai</th>
                            <th>Tanggal Selesai</th>
                            <th>Hari</th>

                            <th>Keterangan</th>
                        </tr>
                    </thead>
                    <tbody class="align-middle">
                        @foreach ($cutis as $cuti)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $cuti->karyawan->nik }}</td>
                                <td>{{ $cuti->karyawan->nama_lengkap }}</td>
                                <td>{{ $cuti->karyawan->jabatan->departement->kode_dept }} /
                                    {{ $cuti->karyawan->jabatan->nama_jabatan }}</td>
                                <td>{{ \Carbon\Carbon::parse($cuti->tgl_mulai)->format('d-m-Y') }}</td>
                                <td>{{ \Carbon\Carbon::parse($cuti->tgl_selesai)->format('d-m-Y') }}</td>
                                <td>{{ $cuti->lama_cuti }}</td>
                                <td>{{ $cuti->status == 'pending' ? 'Menunggu Approval' : ($cuti->status == 'disetujui' ? 'Accept' : 'Reject') }}
                                </td>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div>
                    <h6 class="fw-bold">-- Rincian --</h6>
                    <p>Jumlah data dalam periode : {{ $cutis->count() }}</p>
                    <p>Jumlah Hari cuti dalam periode: {{ $cutis->sum('lama_cuti') }} (hari)</p>
                </div>

                <div class="d-flex justify-content-end gap-2">
                    <a href="{{ route('data-cuti') }}" class="btn btn-danger btn-sm">Kembali</a>
                    <form action="{{ route('cetak-laporan-cuti-detail') }}" method="GET" target="_blank">
                        <input type="hidden" name="start_date" value="{{ $startDate }}">
                        <input type="hidden" name="end_date" value="{{ $endDate }}">
                        <button type="submit" class="btn btn-info btn-sm">Cetak PDF</button>
                    </form>
                </div>
            </div>
        @else
            <div class="alert alert-danger mt-3">
                Tidak ada data cuti yang ditemukan.
            </div>
        @endif
    </div>

@endSection
