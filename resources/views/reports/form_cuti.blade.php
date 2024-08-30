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
    </div>

    <div class="p-4 rounded bg-white shadow">
        <div class="d-flex align-items-center justify-content-between">
            <h3>Form Pengajuan Cuti</h3>
            <button class="btn " style="text-decoration: underline;" type="button" data-bs-toggle="modal"
                data-bs-target="#ketentuan">Ketentuan</button>
        </div>
        <x-modals id="ketentuan" title="Ketentuan" size="modal-lg">
            <div>
                <h6 class="fw-bold">Cuti Tahunan (Paid)</h6>
                <ul>
                    <li>
                        Setiap karyawan yang sudah selama 12 bulan bekerja dapat mengajukan cuti sebanyak 12 hari.
                    </li>
                </ul>
                <h6 class="fw-bold">Cuti Sakit (Paid)</h6>
                <ul>
                    <li>
                        Setiap karyawan yang memiliki riwayat sakit dapat mengajukan cuti sakit, dengan surat keterangan
                        dari dokter.
                    </li>
                </ul>
                <h6 class="fw-bold">Cuti Melahirkan (Paid)</h6>
                <ul>
                    <li>
                        Karyawan mengajukan surat permohonan cuti melahirkan dengan melampirkan surat keterangan dari dokter
                        kandungan atau bidan.
                    </li>
                </ul>
                <h6 class="fw-bold">Cuti Lainnya (Paid/Unpaid)</h6>
                <ul>
                    <li>
                        Tergantung keterangan dan alasan yang jelas terkait permohonan cuti.
                    </li>
                </ul>
            </div>
        </x-modals>
        <br>
        <form action="{{ route('proses-cuti') }}" class="mb-3" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3 row">
                <label for="id_karyawan" class="col-sm-4 col-form-label fw-bold">Nama
                    karyawan <x-required-star /> </label>
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
                <label for="jenis_cuti" class="col-sm-4 col-form-label fw-bold">Jenis Cuti <x-required-star /> </label>
                <div class="col-sm-8">
                    <select class="form-select" name="jenis_cuti" id="jenis_cuti" required>
                        <option value="">--- Pilih Jenis Cuti ---</option>
                        <option value="cuti tahunan">Cuti Tahunan</option>
                        <option value="cuti sakit">Cuti Sakit</option>
                        <option value="cuti melahirkan">Cuti Melahirkan</option>
                        <option value="cuti lainnya">Cuti Lainnya</option>
                    </select>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="tgl_mulai" class="col-sm-4 col-form-label fw-bold">Mulai Tanggal </label>
                <div class="col-sm-8">
                    <input type="date" class="form-control" id="tgl_mulai" name="tgl_mulai" required>
                </div>
            </div>
            <div class="mb-3 row">
                <label for="tgl_selesai" class="col-sm-4 col-form-label fw-bold">Sampai Tanggal </label>
                <div class="col-sm-8">
                    <input type="date" class="form-control" id="tgl_selesai" name="tgl_selesai" required>
                </div>
            </div>

            <input type="hidden" name="status" id="status" value="pending">
            <input type="hidden" name="lama_cuti" id="lama_cuti" value="">

            <div class="mb-3 row">
                <label for="foto_cuti" class="col-sm-4 col-form-label fw-bold">Unggah Surat</label>
                <div class="col-sm-8">
                    <input type="file" class="form-control" id="foto_cuti" name="foto_cuti">
                </div>
            </div>

            <div class="mb-3 row">
                <label for="alasan_cuti" class="col-sm-4 col-form-label fw-bold">Keterangan Cuti </label>
                <div class="col-sm-8">
                    <textarea class="form-control" id="alasan_cuti" name="alasan_cuti" required></textarea>
                </div>
            </div>

            <br>

            <div class="mb-3 d-flex justify-content-between">
                <small class="text-muted">* Pastikan data yang dimasukkan benar, proses pengajuan cuti akan diproses oleh
                    pihak
                    manager.</small>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>


@endSection
