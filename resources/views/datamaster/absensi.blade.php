@extends('layouts.app')

@section('title', 'Data Absensi ')

@section('contents')
    <div>
        @if (session('success'))
            <x-toasts-success>{{ session('success') }}</x-toasts-success>
        @endif

        @if (session('error'))
            <x-toasts-error>{{ session('error') }}</x-toasts-error>
        @endif
    </div>

    <x-headings title="Data Karyawan">
        <div class="d-flex align-items-center gap-2">
            <form action="{{ route('absensi.validate_all') }}" method="POST" id="validateAllForm">
                @csrf
                <button type="button" class="btn btn-primary btn-sm" onclick="validateAll()">Validate All</button>
            </form>
            |
            <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#importAbsensiExcel">
                Import
            </button>
            <form action="{{ route('data_absensi.export') }}" enctype="multipart/form-data" method="GET">
                @csrf
                <button type="submit" class="btn btn-sm btn-danger">Export</button>
            </form>
            <button type="button" class="btn btn-sm btn-success me-2" data-bs-toggle="modal" data-bs-target="#addAbsensi">
                Input
            </button>
        </div>

    </x-headings>


    <div class="card">
        <div class="card-body p-2">
            <div class="table-responsive">
                <table class="table table-borderless datatable">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">NIK</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Dari Tgl</th>
                            <th scope="col">Sampai Tgl</th>
                            <th scope="col">Total Hadir</th>
                            <th scope="col">Total Lembur</th>
                            <th scope="col">Total Alpa</th>
                            <th scope="col">Total sakit</th>
                            <th scope="col">Total Izin</th>
                            <th scope="col">Status validasi</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($dataAbsensi as $absensi)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $absensi->karyawan->nik }}</td>
                                <td>{{ $absensi->karyawan->nama_lengkap }}</td>
                                <td>{{ $absensi->dari_tanggal }}</td>
                                <td>{{ $absensi->sampai_tanggal }}</td>
                                <td>{{ $absensi->total_hadir }}</td>
                                <td>{{ $absensi->total_lembur }}</td>
                                <td>{{ $absensi->total_alpa }}</td>
                                <td>{{ $absensi->total_sakit }}</td>
                                <td>{{ $absensi->total_izin }}</td>
                                <td>
                                    @if ($absensi->status_validasi === 'validate')
                                        <span class="badge bg-success">Validate</span>
                                    @else
                                        <span class="badge bg-danger">onvalidate</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-primary dropdown-toggle" type="button"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            Aksi
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><button type="button" class="dropdown-item" data-bs-toggle="modal"
                                                    data-bs-target="#editAbsensi{{ $absensi->id_absensi }}"><i
                                                        class="bi bi-pencil"></i> Edit</button>
                                            </li>

                                            <li>
                                                <form action="{{ route('delete-absensi', $absensi->id_absensi) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="dropdown-item text-danger"><i
                                                            class="bi bi-trash"></i> Hapus</button>
                                                </form>
                                            </li>

                                        </ul>


                                    </div>
                                </td>
                            </tr>

                            <x-modals id="editAbsensi{{ $absensi->id_absensi }}" title="Edit Absensi" size="modal-lg">
                                <form action="{{ route('edit-absensi-process', $absensi->id_absensi) }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <div class="mb-3 row">
                                        <label for="id_karyawan" class="col-sm-4 col-form-label fw-bold">Nama
                                            Pegawai</label>
                                        <div class="col-sm-8">
                                            <input type="hidden" readonly class="form-control-plaintext" id="id_karyawan"
                                                name="id_karyawan" value="{{ $absensi->id_karyawan }}">
                                            <input type="text" readonly class="form-control-plaintext" id="id_karyawan"
                                                value="{{ $absensi->karyawan->nama_lengkap }}">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="dari_tanggal" class="col-sm-4 col-form-label fw-bold">Dari Tgl</label>
                                        <div class="col-sm-8">
                                            <input type="date" class="form-control" name="dari_tanggal" id="dari_tanggal"
                                                value="{{ $absensi->dari_tanggal }}">
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label for="sampai_tanggal" class="col-sm-4 col-form-label fw-bold">Sampai
                                            Tgl</label>
                                        <div class="col-sm-8">
                                            <input type="date" class="form-control" name="sampai_tanggal"
                                                id="sampai_tanggal" value="{{ $absensi->sampai_tanggal }}">
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label for="total_lembur" class="col-sm-4 col-form-label fw-bold">Total
                                            Lembur</label>
                                        <div class="col-sm-8">
                                            <input type="number" class="form-control" name="total_lembur" id="total_lembur"
                                                value="{{ $absensi->total_lembur }}">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="total_alpa" class="col-sm-4 col-form-label fw-bold">Total Alpa</label>
                                        <div class="col-sm-8">
                                            <input type="number" class="form-control" name="total_alpa" id="total_alpa"
                                                value="{{ $absensi->total_alpa }}">
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label for="total_hadir" class="col-sm-4 col-form-label fw-bold">Total
                                            Hadir</label>
                                        <div class="col-sm-8">
                                            <input type="number" class="form-control" name="total_hadir"
                                                id="total_hadir" value="{{ $absensi->total_hadir }}">
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label for="total_sakit" class="col-sm-4 col-form-label fw-bold">Total
                                            Sakit</label>
                                        <div class="col-sm-8">
                                            <input type="number" class="form-control" name="total_sakit"
                                                id="total_sakit" value="{{ $absensi->total_sakit }}">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="total_izin" class="col-sm-4 col-form-label fw-bold">Total
                                            Izin</label>
                                        <div class="col-sm-8">
                                            <input type="number" class="form-control" name="total_izin" id="total_izin"
                                                value="{{ $absensi->total_izin }}">
                                        </div>
                                    </div>

                                    <div>
                                        <p class="text-danger">*Silahkan cek dan validasi apakah data yang diinputkan sudah
                                            benar</p>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="status_validasi" class="col-sm-4 col-form-label fw-bold">Status
                                            Validasi</label>
                                        <div class="col-sm-8">
                                            <select class="form-select" name="status_validasi" id="status_validasi">
                                                <option value="onvalidate"
                                                    {{ $absensi->status_validasi == 'onvalidate' ? 'selected' : '' }}>On
                                                    Validate</option>
                                                <option value="validate"
                                                    {{ $absensi->status_validasi == 'validate' ? 'selected' : '' }}>
                                                    Validate</option>
                                            </select>
                                        </div>
                                    </div>


                                    <br>

                                    <div>
                                        <button type="submit" class="btn btn-primary w-100">Ubah &
                                            Simpan</button>
                                    </div>

                                </form>
                            </x-modals>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <x-modals id="addAbsensi" title="Input Absensi" size="modal-lg">
        <form action="{{ route('add-absensi-process') }}" method="POST">
            @csrf

            <div class="mb-3 row">
                <label for="id_karyawan" class="col-sm-4 col-form-label fw-bold">Nama
                    Pegawai</label>
                <div class="col-sm-8">
                    <select class="form-select" name="id_karyawan" id="id_karyawan" required>
                        <option value="">--- Pilih Karyawan ---</option>
                        @foreach ($dataKaryawan as $karyawan)
                            <option value="{{ $karyawan->id_karyawan }}">
                                {{ $karyawan->nama_lengkap }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="mb-3 row">
                <label for="dari_tanggal" class="col-sm-4 col-form-label fw-bold">Dari Tgl</label>
                <div class="col-sm-8">
                    <input type="date" class="form-control" name="dari_tanggal" id="dari_tanggal" required>
                </div>
            </div>

            <div class="mb-3 row">
                <label for="sampai_tanggal" class="col-sm-4 col-form-label fw-bold">Sampai Tgl</label>
                <div class="col-sm-8">
                    <input type="date" class="form-control" name="sampai_tanggal" id="sampai_tanggal" required>
                </div>
            </div>

            <div class="mb-3 row">
                <label for="total_hadir" class="col-sm-4 col-form-label fw-bold">Total
                    Hadir</label>
                <div class="col-sm-8">
                    <input type="number" class="form-control" name="total_hadir" id="total_hadir">
                </div>
            </div>

            <div class="mb-3 row">
                <label for="total_lembur" class="col-sm-4 col-form-label fw-bold">Total
                    Lembur (jam)</label>
                <div class="col-sm-8">
                    <input type="number" class="form-control" name="total_lembur" id="total_lembur">
                </div>
            </div>

            <div class="mb-3 row">
                <label for="total_alpa" class="col-sm-4 col-form-label fw-bold">Total Alpa</label>
                <div class="col-sm-8">
                    <input type="number" class="form-control" name="total_alpa" id="total_alpa">
                </div>
            </div>

            <div class="mb-3 row">
                <label for="total_sakit" class="col-sm-4 col-form-label fw-bold">Total
                    Sakit</label>
                <div class="col-sm-8">
                    <input type="number" class="form-control" name="total_sakit" id="total_sakit">
                </div>
            </div>

            <div class="mb-3 row">
                <label for="total_izin" class="col-sm-4 col-form-label fw-bold">Total Izin</label>
                <div class="col-sm-8">
                    <input type="number" class="form-control" name="total_izin" id="total_izin">
                </div>
            </div>

            <input type="hidden" name="status_validasi" value="onvalidate">
            <br>
            <div class="text-end">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>

        </form>
    </x-modals>

    <x-modals id="importAbsensiExcel" title="Import Excel" size="modal-lg">
        <form action="{{ route('data_absensi.import') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="d-flex">
                <div class="input-group">
                    <input class="form-control" type="file" id="file" name="file" required>
                </div>
                <button type="submit" class="btn btn-primary">Import</button>
            </div>
        </form>

    </x-modals>

    <script>
        function validateAll() {
            if (confirm('Apakah Anda yakin ingin memvalidasi semua absensi?')) {
                document.getElementById('validateAllForm').submit();
            }
        }
    </script>

@endsection
