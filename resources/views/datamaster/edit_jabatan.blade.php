@extends('layouts.app')

@section('title', 'Edit Jabatan')

@section('contents')
    <div>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
    </div>

    <div class="card">
        <div class="card-body p-4">
            <form action="{{ route('edit-jabatan-process', $jabatan->id_jabatan) }}" method="post">
                @csrf
                @method('PUT')

                @if ($jabatan->departement != null)
                    <div class="mb-3 row">
                        <label for="id_departement" class="col-sm-4 col-form-label fw-bold">Kode Departement</label>
                        <div class="col-sm-8">
                            <input type="text" class=" form-control form-text" id="id_departement" name="id_departement"
                                value="{{ $jabatan->departement->kode_dept }}" readonly>
                            <input type="hidden" class=" form-control form-text" id="id_departement" name="id_departement"
                                value="{{ $jabatan->id_departement }}" readonly>
                        </div>
                    </div>
                @else
                    <div class="mb-3 row">
                        <label for="id_departement" class="col-sm-4 col-form-label fw-bold">Kode Departement</label>
                        <div class="col-sm-8">
                            <select class="form-select" name="id_departement" id="id_departement">
                                <option value="">Pilih Departement</option>
                                @foreach ($departements as $departement)
                                    <option value="{{ $departement->id_departement }}">{{ $departement->nama_dept }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                @endif

                <div class="mb-3 row">
                    <label for="nama_jabatan" class="col-sm-4 col-form-label fw-bold">Nama Jabatan</label>
                    <div class="col-sm-8">
                        <input type="text" class=" form-control " id="nama_jabatan" name="nama_jabatan"
                            value="{{ $jabatan->nama_jabatan }}">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="gaji_harian" class="col-sm-4 col-form-label fw-bold">Gaji Perhari</label>
                    <div class="col-sm-8">
                        <input type="number" class=" form-control " id="gaji_harian" name="gaji_harian"
                            value="{{ $jabatan->gaji_harian }}">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="tunjangan_makan" class="col-sm-4 col-form-label fw-bold">Tunjangan Makan</label>
                    <div class="col-sm-8">
                        <input type="number" class=" form-control " id="tunjangan_makan" name="tunjangan_makan"
                            value="{{ $jabatan->tunjangan_makan }}">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="tunjangan_transport" class="col-sm-4 col-form-label fw-bold">Tunjangan Transport</label>
                    <div class="col-sm-8">
                        <input type="number" class=" form-control " id="tunjangan_transport" name="tunjangan_transport"
                            value="{{ $jabatan->tunjangan_transport }}">
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="tunjangan_kesehatan" class="col-sm-4 col-form-label fw-bold">Tunjangan Kesehatan</label>
                    <div class="col-sm-8">
                        <input type="number" class=" form-control " id="tunjangan_kesehatan" name="tunjangan_kesehatan"
                            value="{{ $jabatan->tunjangan_kesehatan }}">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="tunjangan_lainnya" class="col-sm-4 col-form-label fw-bold">Tunjangan Lain</label>
                    <div class="col-sm-8">
                        <input type="number" class=" form-control " id="tunjangan_lainnya" name="tunjangan_lainnya"
                            value="{{ $jabatan->tunjangan_lainnya }}">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="bonus" class="col-sm-4 col-form-label fw-bold">Bonus</label>
                    <div class="col-sm-8">
                        <input type="number" class=" form-control " id="bonus" name="bonus"
                            value="{{ $jabatan->bonus }}">
                    </div>
                </div>
                <div class="mb-3">
                    <small class="text-danger">*Gaji Pokok Akan dikalkulasikan dari Gaji Harian beserta tunjangan
                        lainnya.</small>
                </div>
                <br>
                <input type="hidden" name="gaji_bruto" id="gaji_bruto" value="{{ $jabatan->pokok }}">
                <div class="text-end">
                    <button type="submit" class="btn btn-primary ">Simpan</button>
                </div>
            </form>
        </div>
    </div>
@endsection
