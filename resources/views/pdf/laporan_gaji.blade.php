<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Gaji Periode {{ $startDate }} - {{ $endDate }}</title>

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

        td,
        th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
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
    </div>
    <hr>
    <div>
        <h3>Laporan Gaji Karyawan Periode {{ \Carbon\Carbon::parse($startDate)->format('d-m-Y') }} /
            {{ \Carbon\Carbon::parse($endDate)->format('d-m-Y') }} </h3>
    </div>
    <br>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>No. Pegawai</th>
                <th>Nama</th>
                <th>Gross Pay</th>
                <th>Kehadiran</th>
                <th>Lembur (jam)</th>
                <th>Potongan</th>
                <th>Gaji</th>
                <th>Tgl Gaji</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($dataGaji as $gaji)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $gaji->absensi->karyawan->nik }}</td>
                    <td>{{ $gaji->absensi->karyawan->nama_lengkap }}</td>
                    <td>{{ 'Rp. ' . number_format($gaji->gaji_kotor, 0, ',', '.') }}</td>
                    <td>{{ $gaji->total_hari }}</td>
                    <td>{{ $gaji->total_lembur }}</td>
                    <td>{{ 'Rp. ' . number_format($gaji->total_potongan, 0, ',', '.') }}</td>
                    <td>{{ 'Rp. ' . number_format($gaji->total_gaji_bersih, 0, ',', '.') }}</td>
                    <td>{{ \Carbon\Carbon::parse($gaji->tgl_gaji)->format('d-m-Y') }}</td>
                </tr>
            @endforeach
        </tbody>
        <tfoot style="background: darkcyan; color: white; font-weight: bold">
            <tr>
                <td colspan="3">Total</td>
                <td>{{ 'Rp. ' . number_format($dataGaji->sum('gaji_kotor'), 0, ',', '.') }}</td>
                <td>{{ $dataGaji->sum('total_hari') }}</td>
                <td>{{ $dataGaji->sum('total_lembur') }}</td>
                <td>{{ 'Rp. ' . number_format($dataGaji->sum('total_potongan'), 0, ',', '.') }}</td>
                <td>{{ 'Rp. ' . number_format($dataGaji->sum('total_gaji_bersih'), 0, ',', '.') }}</td>
                <td></td>
            </tr>
        </tfoot>
    </table>

    <div style="position: absolute; bottom: 0; right: 0; text-align: right;">
        <h4>Tanggal : ______________</h4>
        <br>
        <h4>Mengetahui</h4>
        <br>
        <br>
        <h4 style="text-align: right; text-decoration: underline;">HR Manager</h4>
    </div>
</body>

</html>
