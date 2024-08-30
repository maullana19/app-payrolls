@extends('layouts.app')

@section('title', 'Penggajian Form')

@section('contents')

    @if (session('success'))
        <x-toasts-success>{{ session('success') }}</x-toasts-success>
    @endif

    @if (session('error'))
        <x-toasts-error>{{ session('error') }}</x-toasts-error>
    @endif
    <div class="row">
        <div class="col-md-12">
            <div class="text-center">
                <h4 class="fw-bold">Form Perhitungan Gaji</h4>
            </div>
            <br>

            <form action="{{ route('penggajian.proses', $absensis->id_absensi) }}" method="POST">
                @csrf
                <div class="p-4 rounded bg-white shadow">
                    <table class="table " width="100%">
                        <tr>
                            <th>Kode Rekap</th>
                            <td>{{ $absensis->id_absensi }}</td>
                            <input type="hidden" name="id_absensi" id="id_absensi" value="{{ $absensis->id_absensi }}">
                        </tr>
                        <tr>
                            <th>Nama Karyawan</th>
                            <td>{{ $absensis->karyawan->nama_lengkap }}</td>
                        </tr>
                        <tr>
                            <th>Posisi</th>
                            <td>{{ $absensis->karyawan->jabatan->nama_jabatan }}</td>
                        </tr>
                        <tr>
                            <th>Periode</th>
                            <td>
                                {{ \Carbon\Carbon::parse($absensis->dari_tanggal)->locale('id')->isoFormat('D MMMM Y') }}
                                -
                                {{ \Carbon\Carbon::parse($absensis->sampai_tanggal)->locale('id')->isoFormat('D MMMM Y') }}
                            </td>
                        </tr>
                        <tr>
                            <th>Total Alpa</th>
                            <td>{{ $absensis->total_alpa }}</td>
                        </tr>
                        <tr>
                            <th>Total Sakit</th>
                            <td>{{ $absensis->total_sakit }}</td>
                        </tr>
                        <tr>
                            <th>Total Izin</th>
                            <td>{{ $absensis->total_izin }}</td>
                        </tr>
                        <tr>
                            <th>Total Hadir </th>
                            <td>{{ $totalHari }}</td>
                            <input type="hidden" name="total_hari" id="total_hari" value="{{ $totalHari }}" readonly>
                        </tr>
                        <tr>
                            <th>Total Lembur (jam)</th>
                            <td>{{ $absensis->total_lembur }}</td>
                            <input type="hidden" name="total_lembur" id="total_lembur"
                                value="{{ $absensis->total_lembur }}">
                        </tr>

                        <tr>
                            <th>Gross (Tunjangan + overtime) </th>
                            <td class="fw-bold">{{ 'Rp. ' . number_format($totalGajiKotor, 0, ',', '.') }}</td>
                            <input type="hidden" name="gaji_kotor" id="gaji_kotor" value="{{ $totalGajiKotor }}">
                        </tr>

                        <tr>
                            <th>Pilih Potongan</th>
                            <td>
                                @foreach ($dataPotongan as $potongan)
                                    <div class="form-check">
                                        <input class="form-check-input potongan-checkbox" type="checkbox"
                                            id="potongan{{ $potongan->id_potongan }}" value="{{ $potongan->nominal }}"
                                            onchange="hitungPotongan()">
                                        <label class="form-check-label" for="potongan{{ $potongan->id_potongan }}">
                                            {{ $potongan->nama_potongan }} ({{ $potongan->nominal * 100 }}%)
                                        </label>
                                    </div>
                                @endforeach
                            </td>
                        </tr>

                        <tr>
                            <th>Total Potongan</th>
                            <td id="totalPotonganDisplay">{{ 'Rp. ' . number_format($bpjsKes + $bpjsKet, 0, ',', '.') }}
                            </td>
                            <input type="hidden" name="total_potongan" id="total_potongan">
                        </tr>
                        <tr>
                            <th>Total Gaji</th>
                            <td class="fw-bold" id="totalGajiDisplay">
                                {{ 'Rp. ' . number_format($potonganGaji, 0, ',', '.') }}</td>
                            <input type="hidden" name="total_gaji_bersih" id="total_gaji_bersih"
                                value="{{ $potonganGaji }}">
                        </tr>

                        <tr>
                            <th>Input tanggal gaji</th>
                            <td><input type="date" name="tgl_gaji" id="tgl_gaji" class="form-control">
                            </td>
                        </tr>
                    </table>
                    <br>
                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('penggajian') }}" class="btn btn-danger me-3"
                            onclick="document.getElementById('absensiId').value = '';">Batal</a>
                        <button type="submit" class="btn btn-success">Proses</button>
                    </div>
                </div>
            </form>

            <script>
                function hitungPotongan() {
                    var checkboxes = document.querySelectorAll('.potongan-checkbox');
                    var totalPotongan = 0;
                    var gajiKotor = parseFloat(document.getElementById('gaji_kotor').value);

                    checkboxes.forEach(function(checkbox) {
                        if (checkbox.checked) {
                            totalPotongan += gajiKotor * parseFloat(checkbox.value);
                        }
                    });

                    var totalGajiBersih = gajiKotor - totalPotongan;

                    document.getElementById('total_potongan').value = totalPotongan;
                    document.getElementById('total_gaji_bersih').value = totalGajiBersih;

                    document.getElementById('totalPotonganDisplay').innerText = 'Rp. ' + totalPotongan.toLocaleString('id', {
                        minimumFractionDigits: 0,
                        maximumFractionDigits: 0
                    });
                    document.getElementById('totalGajiDisplay').innerText = 'Rp. ' + totalGajiBersih.toLocaleString('id', {
                        minimumFractionDigits: 0,
                        maximumFractionDigits: 0
                    });
                }

                document.addEventListener('DOMContentLoaded', function() {
                    hitungPotongan();
                });
            </script>
        </div>
    </div>


@endSection
