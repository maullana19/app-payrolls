<ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Main menu</a></li>
    @if (in_array(Route::currentRouteName(), [
            'data-karyawan',
            'data-departemen',
            'data-jabatan',
            'data-absensi',
            'data-potongan',
        ]))
        <li class="breadcrumb-item"><a href="#">Data Master</a></li>
    @endif

    @if (in_array(Route::currentRouteName(), ['data-gaji', 'data-cuti', 'form-cuti']))
        <li class="breadcrumb-item"><a href="{{ route('laporan') }}">Laporan</a></li>
    @endif

    <li class="breadcrumb-item active">
        @switch(Route::currentRouteName())
            @case('dashboard')
                Dashboard
            @break

            @case('data-karyawan')
                Data Karyawan
            @break

            @case('data-departemen')
                Data Departemen
            @break

            @case('data-jabatan')
                Data Jabatan
            @break

            @case('data-absensi')
                Rekapan Absensi
            @break

            @case('data-potongan')
                Data Potongan
            @break

            @case('datamaster')
                Data Master
            @break

            @case('penggajian')
                Penggajian
            @break

            @case('penggajian.form')
                Form Penggajian
            @break

            @case('laporan')
                Laporan
            @break

            @case('data-user')
                Data User
            @break

            @case('profile')
                User Profile / {{ Auth::user()->name }}
            @break

            @case('tentang-perusahaans')
                Tentang
            @break

            @default
                -
        @endswitch
    </li>
</ol>
