<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Cuti;
use App\Models\Karyawan;
use Illuminate\Http\Request;
use App\Models\Jabatan;
use App\Models\Penggajian;
use App\Models\User;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->input('filter', 'all');

        switch ($filter) {
            case 'today':
                $dataPegawai = Karyawan::whereDate('created_at', now()->toDateString())->get();
                $dataJabatan = Jabatan::whereDate('created_at', now()->toDateString())->get();
                $dataPengguna = User::whereDate('created_at', now()->toDateString())->get();
                $dataAbsensi = Absensi::whereDate('created_at', now()->toDateString())->get();
                break;
            case 'this_month':
                $dataPegawai = Karyawan::whereMonth('created_at', now()->month)
                    ->whereYear('created_at', now()->year)
                    ->get();
                $dataJabatan = Jabatan::whereMonth('created_at', now()->month)
                    ->whereYear('created_at', now()->year)
                    ->get();
                $dataPengguna = User::whereMonth('created_at', now()->month)
                    ->whereYear('created_at', now()->year)
                    ->get();
                $dataAbsensi = Absensi::whereMonth('created_at', now()->month)
                    ->whereYear('created_at', now()->year)
                    ->get();
                break;
            case 'this_year':
                $dataPegawai = Karyawan::whereYear('created_at', now()->year)->get();
                $dataJabatan = Jabatan::whereYear('created_at', now()->year)->get();
                $dataPengguna = User::whereYear('created_at', now()->year)->get();
                $dataAbsensi = Absensi::whereYear('created_at', now()->year)->get();
                break;
            default:
                $dataPegawai = Karyawan::all();
                $dataJabatan = Jabatan::all();
                $dataPengguna = User::all();
                $dataAbsensi = Absensi::all();
                break;
        }

        $dataPenggajian = Penggajian::all();
        $dataCutiPegawai = Cuti::all();

        return view('dashboard', compact('dataPegawai', 'dataJabatan', 'dataPengguna', 'dataAbsensi', 'filter', 'dataPenggajian', 'dataCutiPegawai'));
    }
}
