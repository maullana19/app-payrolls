<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Pegawai | {{ $dataCuti->karyawan->nama_lengkap }} | PDF</title>

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
    </style>
</head>

<body>

    <div class="container">

        <div style="display: flex; align-items: stretch;">
            <div style="width: 100%;">
                <img src="{{ asset('icons/logouci.jpg') }}" alt="logo" border="0" width="64px" height="54px">
            </div>
            <div>
                <h2 style="font-display: inline">PT. Unggulcipta Indramegah</h2>
                <p>Jl. Kayu Besar V No.82D RT005/011 Kel.Tegal Alur Kec. Kalideres Jakarta Barat. 11820</p>
                <p>Telp. (021) 5552121 | Fax. (021) 55962379 | Email : mail@unggulcipta.com</p>
            </div>
        </div>
        <hr>

        <br>

        <h3>DATA PERMOHONAN CUTI PEGAWAI</h3>

        <br>

        <table>
            <tr>
                <td><b>Nik</b></td>
                <td>: {{ $dataCuti->karyawan->nik }}</td>
            </tr>
            <tr>
                <td><b>Nama Lengkap</b></td>
                <td>: {{ $dataCuti->karyawan->nama_lengkap }}</td>
            </tr>
            <tr>
                <td><b>Keterangan Cuti </b></td>
                <td>: {{ $dataCuti->jenis_cuti }}</td>
            </tr>
            <tr>
                <td><b>Lama Hari</b></td>
                <td>:
                    {{ \Carbon\Carbon::parse($dataCuti->tgl_mulai)->diffInDays(\Carbon\Carbon::parse($dataCuti->tgl_selesai)) }}
                    Hari</td> Hari</td>
            </tr>
            <tr>
                <td><b>Dari/Sampai Tanggal</b></td>
                <td>: {{ \Carbon\Carbon::parse($dataCuti->tgl_mulai)->locale('id')->isoFormat('D MMMM Y') }} -
                    {{ \Carbon\Carbon::parse($dataCuti->tgl_selesai)->locale('id')->isoFormat('D MMMM Y') }}</td>
            </tr>
            <tr>
                <td><b>Alasan Cuti</b></td>
                <td>: {{ $dataCuti->alasan_cuti }}</td>
            </tr>
            <tr>
                <td><b>Status</b></td>
                <td>: {{ $dataCuti->status }}</td>
            </tr>
        </table>

        <hr>

        <div style="position: absolute; bottom: 0; left: 0; text-align: center;">
            <img src="{{ asset('images/foto-cuti/' . $dataCuti->foto_cuti) }}" alt="dokumen cuti" width="300px">
        </div>

        <div style="position: absolute; bottom: 0; right: 0; text-align: right;">
            <h4>{{ \Carbon\Carbon::now()->locale('id')->isoFormat('D MMMM Y') }}</h4>
            <br>
            <h4>Mengetahui</h4>
            <br>
            <br>
            <h4 style="text-align: right; text-decoration: underline;">HR Manager</h4>
        </div>
    </div>


</body>

</html>
