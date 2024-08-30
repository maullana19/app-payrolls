<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Slip Gaji - {{ $dataGaji->absensi->karyawan->nik }}</title>

    <style>
        body {
            font-family: 'Nunito', sans-serif;
            font-size: 14px;
            padding: 0;
            margin: 0;
        }

        .container {
            padding: 12px;
            margin: 0 auto;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }
    </style>
</head>

<body>
    <div class="container">
        <div style="display: flex; align-items: stretch;">
            <div>
                <img src="{{ asset('icons/logouci.jpg') }}" alt="logo" border="0" width="64px" height="54px">
            </div>
            <div>
                <h2 style="font-display: inline">PT. Unggulcipta Indramegah</h2>
                <p>Jl. Kayu Besar V No.82D RT005/011 Kel.Tegal Alur Kec. Kalideres Jakarta Barat. 11820</p>
                <p>Telp. (021) 5552121 | Fax. (021) 55962379 | Email : mail@unggulcipta.com</p>
            </div>
        </div>
        <hr>
        <div>
            <h3>SLIP GAJI PEGAWAI</h3>
        </div>
        <br>
        <div>
            <table>
                <tr>
                    <td>NAMA</td>
                    <td>: {{ $dataGaji->absensi->karyawan->nama_lengkap }}</td>
                </tr>
                <tr>
                    <td>NIK</td>
                    <td>: {{ $dataGaji->absensi->karyawan->nik }}</td>
                </tr>
                <tr>
                    <td>JABATAN / POSISI</td>
                    <td>: {{ $dataGaji->absensi->karyawan->jabatan->nama_jabatan }}</td>
                </tr>
                <tr>
                    <td>KODE DEPARTEMENT</td>
                    <td>: {{ $dataGaji->absensi->karyawan->jabatan->departement->kode_dept }}</td>
                </tr>
                <tr>
                    <td>PERIODE</td>
                    <td>:
                        {{ \Carbon\Carbon::parse($dataGaji->absensi->dari_tanggal)->locale('id')->isoFormat('D MMMM Y') }}
                        -
                        {{ \Carbon\Carbon::parse($dataGaji->absensi->sampai_tanggal)->locale('id')->isoFormat('D MMMM Y') }}
                    </td>
                </tr>
            </table>
        </div>
        <br>
        <div>
            <h4>KETERANGAN</h4>
        </div>
        <div>
            <table>
                <tr>
                    <td>Pendapatan</td>
                    <td>: {{ 'Rp. ' . number_format($dataGaji->gaji_kotor, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td>Total Hari Kerja</td>
                    <td>: {{ number_format($dataGaji->total_hari, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td>Total Ketidakhadiran</td>
                    <td>: {{ number_format($dataGaji->absensi->total_alpa, 0, ',', '.') }}</td>
                </tr>
                @php
                    $biayaLembur = 30000;
                    $totalBiayaLembur = $dataGaji->absensi->total_lembur * $biayaLembur;
                @endphp
                <tr>
                    <td>Total Lemburan</td>
                    <td>: {{ number_format($dataGaji->total_lembur, 0, ',', '.') }} </td>
                </tr>
                <tr>
                    <td>Nominal Lemburan </td>
                    <td>: {{ 'Rp. ' . number_format($totalBiayaLembur, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td>Total Potongan (BPJS : Kes, JHT, JP)</td>
                    <td>: {{ 'Rp. ' . number_format($dataGaji->total_potongan, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <td style="font-weight: bold;">Total Gaji Keseluruhan</td>
                    <td style="font-weight: bold;">:
                        {{ 'Rp. ' . number_format($dataGaji->total_gaji_bersih, 0, ',', '.') }}</td>
                </tr>
            </table>
            <br>
        </div>
        <hr>

        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <div style="text-align: right;">
            <h4>Tanggal :
                {{ \Carbon\Carbon::parse($dataGaji->tgl_gaji)->locale('id')->isoFormat('D MMMM Y') }}
            </h4>

        </div>
        <br>
        <br>
        <div style="text-align: right;">
            <h4>Mengetahui</h4>
        </div>
        <br>
        <br>
        <br>
        <div>
            <h4 style="text-align: right; text-decoration: underline;">HR Manager</h4>
        </div>
    </div>

</body>

</html>
