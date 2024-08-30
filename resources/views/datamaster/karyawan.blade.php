@extends('layouts.app')

@section('title', 'Data Karyawan')

@section('contents')
    @if (session('success'))
        <x-toasts-success>{{ session('success') }}</x-toasts-success>
    @endif

    @if (session('error'))
        <x-toasts-error>{{ session('error') }}</x-toasts-error>
    @endif

    <x-headings title="Data Karyawan">
        <div class="d-flex align-items-center gap-2">
            <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#importExcel">
                Import
            </button>
            <form action="{{ route('data_karyawan.export') }}" enctype="multipart/form-data" method="GET">
                @csrf
                <button type="submit" class="btn btn-sm btn-danger">Export</button>
            </form>
            <button type="button" class="btn btn-sm btn-success me-2" data-bs-toggle="modal" data-bs-target="#addKaryawan">
                Input
            </button>
        </div>

    </x-headings>


    <div class="card">
        <div class="card-body p-2">
            <div class="table-responsive">
                <table class="table datatable  table-sm">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>
                                Nama Lengkap
                            </th>
                            <th>NIK</th>
                            <th>NO KTP</th>
                            <th data-type="date" data-format="DD/MM/YYYY">Tgl Lahir</th>
                            <th>Tempat Lahir</th>
                            <th>Jenis Kelamin</th>
                            <th>Email</th>
                            <th>No Hp</th>
                            <th>Agama</th>
                            <th>Pendidikan Terakhir</th>
                            <th>Status Nikah</th>
                            <th>Status Kerja</th>
                            <th>Total Cuti</th>
                            <th>No Rekening</th>
                            <th>NPWP</th>
                            <th>Jabatan</th>
                            <th>Alamat</th>
                            <th>Tgl Join</th>
                            <th>Foto</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($karyawans as $karyawan)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <p data-bs-toggle="tooltip" data-bs-title="{{ $karyawan->nama_lengkap }}">
                                        {{ Str::limit($karyawan->nama_lengkap, 15, '...') }}</p>
                                </td>
                                <td>{{ $karyawan->nik }}</td>
                                <td>{{ $karyawan->no_ktp }}</td>
                                <td>
                                    <p class="text-xs">{{ $karyawan->tgl_lahir }}</p>
                                </td>
                                <td>{{ $karyawan->tempat_lahir }}</td>
                                <td>{{ $karyawan->jenis_kelamin }}</td>
                                <td>{{ $karyawan->email }}</td>
                                <td>{{ $karyawan->no_hp }}</td>
                                <td>{{ $karyawan->agama }}</td>
                                <td>{{ $karyawan->pendidikan_terakhir }}</td>
                                <td>{{ $karyawan->status_pernikahan }}</td>
                                <td><span class="badge" style="background: #006989;">{{ $karyawan->status_kerja }}</span>
                                </td>
                                <td>{{ $dataCuti->where('id_karyawan', $karyawan->id_karyawan)->where('status', 'disetujui')->count() }}
                                </td>
                                <td>{{ $karyawan->no_rekening }}</td>
                                <td>{{ $karyawan->npwp }}</td>
                                <td><span class="badge"
                                        style="background: #8D493A;">{{ $karyawan->jabatan ? $karyawan->jabatan->nama_jabatan : '-' }}</span>
                                </td>
                                <td>
                                    <p data-bs-toggle="tooltip" data-bs-title="{{ $karyawan->alamat }}">
                                        {{ Str::limit($karyawan->alamat, 15, '...') }}</p>
                                </td>
                                <td>{{ $karyawan->tgl_mulai }}</td>
                                <td>
                                    <img src="{{ asset('icons/imagesprofile.png') }}" alt="image"
                                        style="width: 30px; height: 30px;" class="rounded">
                                </td>
                                {{-- <td>
                                    <img src="{{ asset('images/' . $karyawan->foto) }}" alt="image"
                                        style="width: 50px; height: 50px;" class="rounded">
                                </td> --}}
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-success dropdown-toggle" type="button"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            Aksi
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><button type="button" class="dropdown-item" data-bs-toggle="modal"
                                                    data-bs-target="#editKaryawan{{ $karyawan->id_karyawan }}"><i
                                                        class="bi bi-pencil"></i> Edit</button>
                                            </li>
                                            <li><a class="dropdown-item"
                                                    href="{{ route('generatepdf-pegawai', $karyawan->id_karyawan) }}"><i
                                                        class="bi bi-filetype-pdf"></i> Cetak Biodata</a>
                                            </li>
                                            <li>
                                                <form action="{{ route('delete-karyawan', $karyawan->id_karyawan) }}"
                                                    method="POST"
                                                    onsubmit="return confirm('Apakah Anda yakin ingin menghapus data ini ?')">
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

                            <x-modals id="editKaryawan{{ $karyawan->id_karyawan }}" title="Edit Karyawan" size="modal-lg">
                                <form action="{{ route('edit-karyawan-process', $karyawan->id_karyawan) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')


                                    <div class="mb-3 row">
                                        <label for="nama_lengkap" class="col-sm-4 col-form-label fw-bold">Nama
                                            Pegawai</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="nama_lengkap" name="nama_lengkap"
                                                value="{{ $karyawan->nama_lengkap }}">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="nik" class="col-sm-4 col-form-label fw-bold">NIK</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="nik" name="nik"
                                                value="{{ $karyawan->nik }}">
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label for="no_ktp" class="col-sm-4 col-form-label fw-bold">No. KTP</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="no_ktp" name="no_ktp"
                                                value="{{ $karyawan->no_ktp }}">
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label for="tgl_lahir" class="col-sm-4 col-form-label fw-bold">Tgl. Lahir</label>
                                        <div class="col-sm-8">
                                            <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir"
                                                value="{{ $karyawan->tgl_lahir }}">
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label for="tempat_lahir" class="col-sm-4 col-form-label fw-bold">Tempat
                                            Lahir</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="tempat_lahir"
                                                name="tempat_lahir" value="{{ $karyawan->tempat_lahir }}">
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label for="jenis_kelamin" class="col-sm-4 col-form-label fw-bold">Jenis
                                            Kelamin</label>
                                        <div class="col-sm-8">
                                            <select class="form-select" id="jenis_kelamin" name="jenis_kelamin">
                                                <option selected disabled>Pilih</option>
                                                <option value="laki-laki"
                                                    {{ $karyawan->jenis_kelamin == 'laki-laki' ? 'selected' : '' }}>Laki -
                                                    laki</option>
                                                <option value="perempuan"
                                                    {{ $karyawan->jenis_kelamin == 'perempuan' ? 'selected' : '' }}>
                                                    Perempuan</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label for="agama" class="col-sm-4 col-form-label fw-bold">Agama</label>
                                        <div class="col-sm-8">
                                            <select class="form-select" id="agama" name="agama">
                                                <option value="">Pilih</option>
                                                <option value="islam"
                                                    {{ $karyawan->agama == 'islam' ? 'selected' : '' }}>Islam</option>
                                                <option value="kristen"
                                                    {{ $karyawan->agama == 'kristen' ? 'selected' : '' }}>Kristen</option>
                                                <option value="budha"
                                                    {{ $karyawan->agama == 'budha' ? 'selected' : '' }}>Budha</option>
                                                <option value="hindu"
                                                    {{ $karyawan->agama == 'hindu' ? 'selected' : '' }}>Hindu</option>
                                                <option value="konghucu"
                                                    {{ $karyawan->agama == 'konghucu' ? 'selected' : '' }}>Konghucu
                                                </option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label for="status_pernikahan" class="col-sm-4 col-form-label fw-bold">Status
                                            Pernikahan</label>
                                        <div class="col-sm-8">
                                            <select class="form-select" id="status_pernikahan" name="status_pernikahan">
                                                <option value="">Pilih</option>
                                                <option value="menikah"
                                                    {{ $karyawan->status_pernikahan == 'menikah' ? 'selected' : '' }}>
                                                    Menikah</option>
                                                <option value="belum menikah"
                                                    {{ $karyawan->status_pernikahan == 'belum menikah' ? 'selected' : '' }}>
                                                    Belum Menikah</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label for="pendidikan_terakhir"
                                            class="col-sm-4 col-form-label fw-bold">Pendidikan Terakhir</label>
                                        <div class="col-sm-8">
                                            <select class="form-select" id="pendidikan_terakhir"
                                                name="pendidikan_terakhir">
                                                <option selected disabled>Pilih</option>
                                                <option value="SD"
                                                    {{ $karyawan->pendidikan_terakhir == 'SD' ? 'selected' : '' }}>SD
                                                </option>
                                                <option value="SMP"
                                                    {{ $karyawan->pendidikan_terakhir == 'SMP' ? 'selected' : '' }}>SMP
                                                </option>
                                                <option value="SMA"
                                                    {{ $karyawan->pendidikan_terakhir == 'SMA' ? 'selected' : '' }}>SMA
                                                </option>
                                                <option value="S1"
                                                    {{ $karyawan->pendidikan_terakhir == 'S1' ? 'selected' : '' }}>S1
                                                </option>
                                                <option value="S2"
                                                    {{ $karyawan->pendidikan_terakhir == 'S2' ? 'selected' : '' }}>S2
                                                </option>
                                                <option value="S3"
                                                    {{ $karyawan->pendidikan_terakhir == 'S3' ? 'selected' : '' }}>S3
                                                </option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label for="email" class="col-sm-4 col-form-label fw-bold">Email</label>
                                        <div class="col-sm-8">
                                            <input type="email" class="form-control" id="email" name="email"
                                                value="{{ $karyawan->email }}">
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label for="no_hp" class="col-sm-4 col-form-label fw-bold">No. Hp</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="no_hp" name="no_hp"
                                                value="{{ $karyawan->no_hp }}">
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label for="tgl_mulai" class="col-sm-4 col-form-label fw-bold">Tgl. Join</label>
                                        <div class="col-sm-8">
                                            <input type="date" class="form-control" id="tgl_mulai" name="tgl_mulai"
                                                value="{{ $karyawan->tgl_mulai }}">
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label for="status_kerja" class="col-sm-4 col-form-label fw-bold">Status
                                            Kerja</label>
                                        <div class="col-sm-8">
                                            <select class="form-select" id="status_kerja" name="status_kerja">
                                                <option selected disabled>Pilih</option>
                                                <option value="kontrak"
                                                    {{ $karyawan->status_kerja == 'kontrak' ? 'selected' : '' }}>Kontrak
                                                </option>
                                                <option value="tetap"
                                                    {{ $karyawan->status_kerja == 'tetap' ? 'selected' : '' }}>Tetap
                                                </option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label for="no_rekening" class="col-sm-4 col-form-label fw-bold">No. Rek</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="no_rekening"
                                                name="no_rekening" value="{{ $karyawan->no_rekening }}">
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label for="npwp" class="col-sm-4 col-form-label fw-bold">NPWP</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="npwp" name="npwp"
                                                value="{{ $karyawan->npwp }}">
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label for="id_jabatan" class="col-sm-4 col-form-label fw-bold">Jabatan</label>
                                        <div class="col-sm-8">
                                            <select class="form-select" id="id_jabatan" name="id_jabatan">
                                                <option value="">Pilih Jabatan</option>
                                                @foreach ($jabatans as $jabatan)
                                                    <option value="{{ $jabatan->id_jabatan }}"
                                                        {{ $karyawan->id_jabatan == $jabatan->id_jabatan ? 'selected' : '' }}>
                                                        {{ $jabatan->nama_jabatan }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="mb-3 row">
                                        <label for="alamat" class="col-sm-4 col-form-label fw-bold">Alamat</label>
                                        <div class="col-sm-8">
                                            <input type="text" class="form-control" id="alamat" name="alamat"
                                                value="{{ $karyawan->alamat }}">
                                        </div>
                                    </div>
                                    <div class="mb-3 row">
                                        <label for="foto" class="col-sm-4 col-form-label fw-bold">foto</label>
                                        <div class="col-sm-8">
                                            <input type="file" class="form-control" id="foto" name="foto">
                                        </div>
                                    </div>

                                    <br>

                                    <div class="col-12 text-end">
                                        <button type="submit" class="btn btn-primary">Ubah &
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

    {{-- Modal Add Karyawan --}}
    <x-modals id="addKaryawan" title="Silahkan Input Data Pegawai" size="modal-lg" size="modal-lg">
        <div class="p-2">
            <form action="{{ route('add-karyawan-process') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3 row">
                    <label for="nama_lengkap" class="col-sm-4 col-form-label fw-bold">Nama
                        Pegawai <x-required-star /> </label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control border-1" id="nama_lengkap" name="nama_lengkap"
                            required>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="nik" class="col-sm-4 col-form-label fw-bold">NIK <x-required-star /></label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="nik" name="nik" required>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="no_ktp" class="col-sm-4 col-form-label fw-bold">No. KTP <x-required-star /></label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="no_ktp" name="no_ktp">
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="tgl_lahir" class="col-sm-4 col-form-label fw-bold">Tgl. Lahir</label>
                    <div class="col-sm-8">
                        <input type="date" class="form-control" id="tgl_lahir" name="tgl_lahir">
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="tempat_lahir" class="col-sm-4 col-form-label fw-bold">Tempat Lahir</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir">
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="jenis_kelamin" class="col-sm-4 col-form-label fw-bold">Jenis Kelamin</label>
                    <div class="col-sm-8">
                        <select class="form-select" id="jenis_kelamin" name="jenis_kelamin">
                            <option selected disabled>Pilih</option>
                            <option value="laki-laki">Laki - laki</option>
                            <option value="perempuan">Perempuan</option>
                        </select>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="agama" class="col-sm-4 col-form-label fw-bold">Agama</label>
                    <div class="col-sm-8">
                        <select class="form-select" id="agama" name="agama">
                            <option selected disabled>Pilih</option>
                            <option value="islam">Islam</option>
                            <option value="kristen">Kristen</option>
                            <option value="budha">Budha</option>
                            <option value="hindu">Hindu</option>
                            <option value="konghucu">Konghucu</option>
                        </select>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="status_pernikahan" class="col-sm-4 col-form-label fw-bold">Status Pernikahan</label>
                    <div class="col-sm-8">
                        <select class="form-select" id="status_pernikahan" name="status_pernikahan">
                            <option selected disabled>Pilih</option>
                            <option value="menikah">Menikah</option>
                            <option value="belum menikah">Belum Menikah</option>
                        </select>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="pendidikan_terakhir" class="col-sm-4 col-form-label fw-bold">Pendidikan Terakhir</label>
                    <div class="col-sm-8">
                        <select class="form-select" id="pendidikan_terakhir" name="pendidikan_terakhir">
                            <option selected disabled>Pilih</option>
                            <option value="SD">SD</option>
                            <option value="SMP">SMP</option>
                            <option value="SMA">SMA</option>
                            <option value="S1">S1</option>
                            <option value="S2">S2</option>
                            <option value="S3">S3</option>
                        </select>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="email" class="col-sm-4 col-form-label fw-bold">Email</label>
                    <div class="col-sm-8">
                        <input type="email" class="form-control" id="email" name="email">
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="no_hp" class="col-sm-4 col-form-label fw-bold">No. Hp</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="no_hp" name="no_hp">
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="tgl_mulai" class="col-sm-4 col-form-label fw-bold">Tgl. Join</label>
                    <div class="col-sm-8">
                        <input type="date" class="form-control" id="tgl_mulai" name="tgl_mulai">
                    </div>
                </div>



                <div class="mb-3 row">
                    <label for="status_kerja" class="col-sm-4 col-form-label fw-bold">Status Kerja</label>
                    <div class="col-sm-8">
                        <select class="form-select" id="status_kerja" name="status_kerja">
                            <option selected disabled>Pilih</option>
                            <option value="kontrak">Kontrak</option>
                            <option value="tetap">Tetap</option>
                        </select>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="no_rekening" class="col-sm-4 col-form-label fw-bold">No. Rek</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="no_rekening" name="no_rekening">
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="npwp" class="col-sm-4 col-form-label fw-bold">NPWP</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="npwp" name="npwp">
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="id_jabatan" class="col-sm-4 col-form-label fw-bold">Jabatan</label>
                    <div class="col-sm-8">
                        <select class="form-select" id="id_jabatan" name="id_jabatan">
                            <option value="">Pilih Jabatan</option>
                            @foreach ($jabatans as $jabatan)
                                <option value="{{ $jabatan->id_jabatan }}">{{ $jabatan->nama_jabatan }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="alamat" class="col-sm-4 col-form-label fw-bold">Alamat</label>
                    <div class="col-sm-8">
                        <input type="text" class="form-control" id="alamat" name="alamat">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="foto" class="col-sm-4 col-form-label fw-bold">foto</label>
                    <div class="col-sm-8">
                        <div class="input-group">
                            <input type="file" class="form-control" id="foto" name="foto">
                        </div>
                    </div>
                </div>

                <br>
                <div class="col-12 text-end">
                    <x-button-primary type="submit">Simpan</x-button-primary>
                </div>

            </form>

        </div>
    </x-modals>

    <x-modals id="importExcel" title="Import Excel" size="modal-lg">
        <form action="{{ route('data_karyawan.import') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="d-flex">
                <div class="input-group">
                    <input class="form-control" type="file" id="file" name="file" required>
                </div>
                <button type="submit" class="btn btn-primary">Import</button>
            </div>
        </form>

    </x-modals>


@endSection
