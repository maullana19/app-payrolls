<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Laporan Cuti {{ $startDate }} - {{ $endDate }}</title>

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
        <h3>Laporan Cuti Karyawan Periode {{ \Carbon\Carbon::parse($startDate)->format('d-m-Y') }} /
            {{ \Carbon\Carbon::parse($endDate)->format('d-m-Y') }} </h3>
    </div>
    <br>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>NIK</th>
                <th>Nama</th>
                <th>Dept/Jabatan</th>
                <th>Jenis Cuti</th>
                <th>Tgl. Mulai</th>
                <th>Tgl. Selesai</th>
                <th>Lama</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($dataCuti as $cuti)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $cuti->karyawan->nik }}</td>
                    <td>{{ $cuti->karyawan->nama_lengkap }}</td>
                    <td> {{ $cuti->karyawan->jabatan->departement->nama_dept }}/{{ $cuti->karyawan->jabatan->nama_jabatan }}
                    </td>
                    <td>{{ $cuti->jenis_cuti }}</td>
                    <td>{{ \Carbon\Carbon::parse($cuti->tgl_mulai)->format('d-m-Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($cuti->tgl_selesai)->format('d-m-Y') }}</td>
                    <td>{{ $cuti->lama_cuti }} (hari)</td>
                    <td>{{ $cuti->status == 'pending' ? 'Menunggu Approval' : ($cuti->status == 'disetujui' ? 'Accept' : 'Reject') }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div>
        <h4>Rincian :</h4>
        <h5>Terhitung Mulai Tgl. : {{ \Carbon\Carbon::parse($startDate)->format('d-m-Y') }} s/d
            {{ \Carbon\Carbon::parse($endDate)->format('d-m-Y') }}</h5>
        <h5>Diprint pada : {{ \Carbon\Carbon::now()->format('d-m-Y H:i:s') }}</h5>
        <h5>Dicetak Oleh : {{ Auth::user()->name }}</h5>

        <h5>Total Hari : {{ $dataCuti->sum('lama_cuti') }} </h5>
        <h5>Total : {{ $dataCuti->count() }} data</h5>
    </div>



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
