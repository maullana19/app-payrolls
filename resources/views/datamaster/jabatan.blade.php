@extends('layouts.app')

@section('title', 'Data Jabatan')

@section('contents')
    <div>
        @if (session('success'))
            <x-toasts-success>{{ session('success') }}</x-toasts-success>
        @endif

        @if (session('error'))
            <x-toasts-error>{{ session('error') }}</x-toasts-error>
        @endif
    </div>

    <div class="card">
        <div class="card-body p-0">
            <div class="d-flex align-items-center justify-content-between">
                <div>
                    <h5 class="card-title fw-bold">Data Jabatan</h5>
                </div>
                <button type="button" class="btn btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#addJabatan">
                    Input Jabatan
                </button>
            </div>


        </div>
    </div>

    <div class="card">
        <div class="card-body p-2">
            <div class="table-responsive">
                <table class="table  table-borderless">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama jabatan</th>
                            <th scope="col">Kode Dept</th>
                            <th scope="col">Gaji Harian</th>
                            <th scope="col">Tj. Makan</th>
                            <th scope="col">Tj. Transport</th>
                            <th scope="col">Tj. Kesehatan</th>
                            <th scope="col">Tj. Lainnya</th>
                            <th scope="col">Bonus</th>
                            <th scope="col">Std Hari</th>
                            <th scope="col">Gross</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($jabatans as $jabatan)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $jabatan->nama_jabatan }}</td>
                                <td>
                                    @if ($jabatan->departement)
                                        <span class="badge"
                                            style="background-color: #4793AF">{{ $jabatan->departement->kode_dept }}</span>
                                    @endif
                                </td>
                                <td>{{ 'Rp' . number_format($jabatan->gaji_harian, 0, ',', '.') }}</td>
                                <td>{{ 'Rp' . number_format($jabatan->tunjangan_makan, 0, ',', '.') }}</td>
                                <td>{{ 'Rp' . number_format($jabatan->tunjangan_transport, 0, ',', '.') }}</td>
                                <td>{{ 'Rp' . number_format($jabatan->tunjangan_kesehatan, 0, ',', '.') }}</td>
                                <td>{{ 'Rp' . number_format($jabatan->tunjangan_lainnya, 0, ',', '.') }}</td>
                                <td>{{ 'Rp' . number_format($jabatan->bonus, 0, ',', '.') }}</td>
                                <td>26</td>
                                <td><span class="badge"
                                        style="background-color: #5A639C">{{ 'Rp' . number_format($jabatan->gross, 0, ',', '.') }}</span>
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-primary dropdown-toggle" type="button"
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                            Aksi
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a href="{{ route('form-edit-jabatan', $jabatan->id_jabatan) }}"
                                                    class="dropdown-item">Edit
                                                </a>
                                            </li>
                                            <li>
                                                <form action="{{ route('delete-jabatan', $jabatan->id_jabatan) }}"
                                                    method="POST" class="">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="dropdown-item text-danger">Hapus</button>
                                                </form>
                                            </li>

                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal Add Jabatan -->
    <div class="modal fade" id="addJabatan" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambahkan Jabatan</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <form action="{{ route('add-jabatan-process') }}" method="POST">
                        @csrf
                        <div class="mb-3 row">
                            <label for="nama_jabatan" class="col-sm-4 col-form-label fw-bold">Nama Jabatan</label>
                            <div class="col-sm-8">
                                <input type="text" class=" form-control " id="nama_jabatan" name="nama_jabatan" required>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="id_departement" class="col-sm-4 col-form-label fw-bold">Departement</label>
                            <div class="col-sm-8">
                                <select class="form-select" name="id_departement" id="id_departement" required>
                                    <option value="">Pilih Departement</option>
                                    @foreach ($departements as $departement)
                                        <option value="{{ $departement->id_departement }}">{{ $departement->nama_dept }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="gaji_harian" class="col-sm-4 col-form-label fw-bold">Gaji Perhari</label>
                            <div class="col-sm-8">
                                <input type="number" class=" form-control " id="gaji_harian" name="gaji_harian">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="tunjangan_makan" class="col-sm-4 col-form-label fw-bold">Tunjangan Makan</label>
                            <div class="col-sm-8">
                                <input type="number" class=" form-control " id="tunjangan_makan" name="tunjangan_makan"
                                    min="0">
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="tunjangan_transport" class="col-sm-4 col-form-label fw-bold">Tunjangan
                                Transport</label>
                            <div class="col-sm-8">
                                <input type="number" class=" form-control " id="tunjangan_transport"
                                    name="tunjangan_transport">
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="tunjangan_kesehatan" class="col-sm-4 col-form-label fw-bold">Tunjangan
                                Tunjangan Kesehatan</label>
                            <div class="col-sm-8">
                                <input type="number" class=" form-control " id="tunjangan_kesehatan"
                                    name="tunjangan_kesehatan">
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="tunjangan_lainnya" class="col-sm-4 col-form-label fw-bold">Tunjangan
                                Lainnya</label>
                            <div class="col-sm-8">
                                <input type="number" class=" form-control " id="tunjangan_lainnya"
                                    name="tunjangan_lainnya">
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="bonus" class="col-sm-4 col-form-label fw-bold">Bonus</label>
                            <div class="col-sm-8">
                                <input type="number" class=" form-control " id="bonus" name="bonus">
                            </div>
                        </div>

                        <div class="mb-3">
                            <small class="text-muted">*Gaji Pokok Akan dikalkulasikan dari Gaji Harian beserta tunjangan
                                lainnya.</small>
                        </div>
                        <br>

                        <input type="hidden" name="gaji_pokok" id="gaji_pokok">

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-info">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endSection
