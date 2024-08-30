@extends('layouts.app')

@section('title', 'Penggajian Form')

@section('contents')

    <x-headings title="Note">
        <p>*Hanya pegawai/karyawan yang sudah tervalidasi dalam rekapan sebelum bisa melanjutkan ke proses gaji</p>
    </x-headings>

    @if (count($absensis) > 0)
        <div class="row">
            <div class="col-md-12">
                <div class="d-flex justify-content-center py-4">
                    <div class="col-md-8">
                        <div class="mb-3 row">
                            <label for="id_absensi" class="col-md-12 col-form-label fw-bold">Pilih Pegawai</label>
                            <div class="col-md-12">
                                <select name="id_absensi" id="id_absensi" class="form-select" onchange="submitForm()">
                                    <option value="">--- Pilih Karyawan ---</option>
                                    @foreach ($absensis as $absensi)
                                        <option value="{{ $absensi->id_absensi }}">
                                            {{ $absensi->karyawan->nama_lengkap }}
                                        </option>
                                    @endforeach
                                </select>
                                <form action="{{ route('penggajian.form') }}" method="GET" id="form-penggajian">
                                    @csrf
                                    <input type="hidden" name="id_absensi" id="absensiId">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="d-flex justify-content-center py-4">
            <div class="alert alert-info">
                Data Rekapan Karyawan tidak ditemukan.
            </div>
        </div>
    @endif

    <script>
        function submitForm() {
            var select = document.getElementById("id_absensi");
            var absensiId = select.value;
            if (absensiId) {
                var form = document.getElementById("form-penggajian");
                document.getElementById("absensiId").value = absensiId;
                form.submit();
            } else {
                alert('Pilih Karyawan terlebih dahulu');
            }
        }
    </script>






@endSection
