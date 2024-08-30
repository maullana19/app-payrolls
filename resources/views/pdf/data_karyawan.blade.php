<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Pegawai | {{ $karyawans->nama_lengkap }} | PDF</title>

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
                <h1>PT. UNGGUL CIPTA INDRA MEGAH</h1>
                <h3>Data Pegawai</h3>
            </div>
        </div>
        <hr>
        <br>

        <div>
            <h6>Foto</h6>
            <img src="{{ asset('storage/' . $karyawans->foto) }}" alt="logo" border="0" width="64px"
                height="54px">
        </div>

        <br>

        <table style="width: 100%">
            <tr>
                <td>NAMA LENGKAP</td>
                <td>: {{ $karyawans->nama_lengkap }}</td>
            </tr>
            <tr>
                <td>NIK</td>
                <td>: {{ $karyawans->nik }}</td>
            </tr>
            <tr>
                <td>JABATAN / POSISI</td>
                <td>: {{ $karyawans->jabatan->nama_jabatan }}</td>
            </tr>
            <tr>
                <td>DEPARTEMENT</td>
                <td>: {{ $karyawans->jabatan->departement->nama_dept }} -
                    {{ $karyawans->jabatan->departement->kode_dept }}</td>
            </tr>
            <tr>
                <td>EMAIL</td>
                <td>: {{ $karyawans->email }}</td>
            </tr>
            <tr>
                <td>NO. TELP</td>
                <td>: {{ $karyawans->no_hp }}</td>
            </tr>
            <tr>
                <td>ALAMAT</td>
                <td>: {{ $karyawans->alamat }}</td>
            </tr>
            <tr>
                <td>STATUS</td>
                <td>: {{ $karyawans->status_kerja }}</td>
            </tr>
            <tr>
                <td>NO REK</td>
                <td>: {{ $karyawans->no_rekening }}</td>
            </tr>
            <tr>
                <td>NPWP</td>
                <td>: {{ $karyawans->npwp }}</td>
            </tr>
            <tr>
                <td>MULAI BERGABUNG</td>
                <td>: {{ \Carbon\Carbon::parse($karyawans->tgl_mulai)->locale('id')->isoFormat('D MMMM Y') }}</td>
            </tr>
            <tr>
                <td>Total Cuti</td>
                <td>: {{ $cuti->count() }}</td>
            </tr>
        </table>
        <br>
        <hr>

        <div>
            <p>Note: Data Karyawan ini bersifat rahasia mohon untuk tidak menyebarluaskan kepada pihak lain, Hanya
                digunakan untuk keperluan perusahaan.</p>
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
