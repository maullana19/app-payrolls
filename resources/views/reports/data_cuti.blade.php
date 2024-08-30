@extends('layouts.app')

@section('title', 'Form Pengajuan Cuti')

@section('contents')

    <div>
        @if (session('success'))
            <x-toasts-success>{{ session('success') }}</x-toasts-success>
        @endif

        @if (session('error'))
            <x-toasts-error>{{ session('error') }}</x-toasts-error>
        @endif

        @if (session('accessDenied'))
            <x-toasts-error>{{ session('accessDenied') }}</x-toasts-error>
        @endif
    </div>

    <div class="p-3 bg-white rounded mb-3 shadow-sm">
        <div>
            <h5>Buat Laporan Cuti</h5>
        </div>
        <form method="GET" action="{{ route('laporan.cuti.detail') }}">
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

    <div class=" bg-white shadow-sm p-4 rounded">
        <table class="table text-center">
            <thead>
                <tr>
                    <th>No</th>
                    <th>NIK</th>
                    <th>Nama</th>
                    <th>Posisi</th>
                    <th>Jenis Cuti</th>
                    <th>Tgl Mulai</th>
                    <th>Tgl Selesai</th>
                    <th>Lama Cuti</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($dataCuti as $cuti)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $cuti->karyawan->nik }}</td>
                        <td>{{ $cuti->karyawan->nama_lengkap }}</td>
                        <td>{{ $cuti->karyawan->jabatan->nama_jabatan }}</td>
                        <td>{{ $cuti->jenis_cuti }}</td>
                        <td>{{ \Carbon\Carbon::parse($cuti->tgl_mulai)->locale('id')->isoFormat('D MMMM Y') }}</td>
                        <td>{{ \Carbon\Carbon::parse($cuti->tgl_selesai)->locale('id')->isoFormat('D MMMM Y') }}</td>
                        <td>{{ $cuti->lama_cuti }} (hari)</td>
                        <td><span
                                class="badge {{ $cuti->status == 'pending' ? 'bg-info' : ($cuti->status == 'disetujui' ? 'bg-success' : 'bg-danger') }}">
                                {{ $cuti->status }}</span></td>
                        <td>
                            <div class="dropdown">
                                <button class="btn btn-sm btn-primary dropdown-toggle" type="button"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    Aksi
                                </button>
                                <ul class="dropdown-menu">

                                    <li><a href="#" class="dropdown-item" data-bs-toggle="modal"
                                            data-bs-target="#editCuti{{ $cuti->id_cuti }}">Edit
                                        </a>
                                    </li>

                                    <li>
                                        <form action="{{ route('cetak-slip-cuti', $cuti->id_cuti) }}" method="GET">
                                            <button type="submit" class="dropdown-item">Cetak PDF</button>
                                        </form>
                                    </li>

                                    <li>
                                        <form action="{{ route('delete-cuti', $cuti->id_cuti) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="dropdown-item text-danger">Hapus</button>
                                        </form>
                                    </li>


                                </ul>
                                <x-modals id="editCuti{{ $cuti->id_cuti }}" title="Cek Pengajuan Cuti Karyawan"
                                    size="modal-lg">
                                    <form action="{{ route('update-status-cuti', $cuti->id_cuti) }}" method="POST">

                                        @csrf
                                        @method('PUT')
                                        <div>
                                            <p class="fw-bold">Keterangan.</p>
                                            <p>{{ $cuti->alasan_cuti }}</p>
                                        </div>
                                        <br>
                                        <div>
                                            <select name="status" id="status" class="form-select" required>
                                                <option value="" disabled>{{ old('status', $cuti->status) }}
                                                </option>
                                                <option value="pending">Pending</option>
                                                <option value="disetujui">Setujui</option>
                                                <option value="ditolak">Tolak</option>
                                            </select>
                                        </div>
                                        <br>
                                        <div class="text-end">
                                            <button type="submit" class="btn btn-primary">Simpan</button>
                                        </div>
                                    </form>
                                </x-modals>
                            </div>
                        </td>
                    </tr>
                @endforeach
        </table>

    </div>




@endSection
