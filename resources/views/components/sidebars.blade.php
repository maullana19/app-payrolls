<aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-heading">Menu Utama</li>
        <li class="nav-item ">
            <a class="nav-link {{ request()->routeIs('dashboard') ? '' : 'collapsed' }} " href="{{ route('dashboard') }}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs(['data-karyawan', 'data-jabatan', 'data-absensi', 'data-potongan']) ? '' : 'collapsed' }}"
                data-bs-target="#dataMaster" data-bs-toggle="collapse" href="#">
                <i class="bi bi-database"></i><span>Data Master</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="dataMaster"
                class="nav-content collapse {{ request()->routeIs(['data-karyawan', 'data-departemen', 'data-jabatan', 'data-absensi', 'data-potongan']) ? 'show' : '' }}"
                data-bs-parent="#sidebar-nav">
                <li>
                    <a href="{{ route('data-karyawan') }}"
                        class="{{ request()->routeIs('data-karyawan') ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>Data Karyawan</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('data-departemen') }}"
                        class="{{ request()->routeIs('data-departemen') ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>Data Departemen</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('data-jabatan') }}"
                        class="{{ request()->routeIs('data-jabatan') ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>Data Jabatan</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('data-potongan') }}"
                        class="{{ request()->routeIs('data-potongan') ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>Data Potongan</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('data-absensi') }}"
                        class="{{ request()->routeIs('data-absensi') ? 'active' : '' }}">
                        <i class="bi bi-circle"></i><span>Rekap Absensi</span>
                    </a>
                </li>

            </ul>
        </li>


        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('penggajian') ? '' : 'collapsed' }}"
                href="{{ route('penggajian') }}">
                <i class="bi bi-wallet2"></i>
                <span>Penggajian</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('laporan') ? '' : 'collapsed' }}" href="{{ route('laporan') }}">
                <i class="bi bi-journals"></i>
                <span>Laporan</span>
            </a>
        </li>

        @if (auth()->user()->id_role == 1)
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('data-user') ? '' : 'collapsed' }}"
                    href="{{ route('data-user') }}">
                    <i class="bi bi-person"></i>
                    <span>Data User (Admin)</span>
                </a>
            </li>
        @endif

        <li class="nav-heading">Lainnya</li>

        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('tentang-perusahaans') ? '' : 'collapsed' }}"
                href="{{ route('tentang-perusahaans') }}">
                <i class="bi bi-exclamation-circle"></i>
                <span>Tentang</span>
            </a>
        </li>
    </ul>

</aside>
