<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use Illuminate\Http\Request;
use App\Models\Karyawan;
use App\Models\Penggajian;
use App\Models\Potongan;

class PenggajianController extends Controller
{
    public function index()
    {
        $karyawans = Karyawan::all();
        $absensis = Absensi::where('status_validasi', 'validate')->get();

        return view('penggajian', compact('karyawans', 'absensis'));
    }

    public function formPenggajian(Request $request)
    {
        $id = $request->input('id_absensi');
        $absensis = Absensi::findOrFail($id);
        $dataPotongan = Potongan::all();

        // Kalkulasi
        $totalHari = $absensis->total_hadir - $absensis->total_alpa;

        // Total lembur
        $biayaLembur = 30000;
        $totalBiayaLembur = $absensis->total_lembur * $biayaLembur;

        // Total potongan
        $potonganBpjsKes = $dataPotongan->where('id_potongan', 1)->first()->nominal;
        $potonganBpjsKet = $dataPotongan->where('id_potongan', 2)->first()->nominal;

        // Variable gaji
        $gajiHarian = $absensis->karyawan->jabatan->gaji_harian;
        $tunjHarianMakan = $absensis->karyawan->jabatan->tunjangan_makan;
        $tunjHarianTransport = $absensis->karyawan->jabatan->tunjangan_transport;
        $tunjanganKesehatan = $absensis->karyawan->jabatan->tunjangan_kesehatan;
        $tunjanganLainnya = $absensis->karyawan->jabatan->tunjangan_lainnya;
        $bonus = $absensis->karyawan->jabatan->bonus;
        $totalGajiperbulan = $absensis->karyawan->jabatan->gaji_pokok;

        $totalGajiKotor =
            ($gajiHarian +
                $tunjHarianMakan +
                $tunjHarianTransport +
                $tunjanganKesehatan +
                $tunjanganLainnya +
                $bonus) *
            $totalHari +
            $totalBiayaLembur;

        // Variable potongan
        $bpjsKes = $totalGajiKotor * $potonganBpjsKes;
        $bpjsKet = $totalGajiKotor * $potonganBpjsKet;
        $potonganGaji = $totalGajiKotor - $bpjsKes - $bpjsKet;

        return view('payrolls.form_penggajian', compact(
            'absensis',
            'dataPotongan',
            'totalHari',
            'totalGajiKotor',
            'bpjsKes',
            'bpjsKet',
            'potonganGaji',
        ));
    }

    public function prosesPenggajian(Request $request, $id)
    {
        $absensi = Absensi::findOrFail($id);
        $potongan = Potongan::all();

        try {
            $validatedData = $request->validate([
                'total_hari' => 'required',
                'total_lembur' => 'required',
                'gaji_kotor' => 'required',
                'total_potongan' => 'required',
                'total_gaji_bersih' => 'required',
                'tgl_gaji' => 'required',
            ]);

            // Tambahkan absensi_id ke dalam data yang divalidasi
            $validatedData['id_absensi'] = $absensi->id_absensi;

            // Simpan data ke dalam tabel laporan
            Penggajian::create([
                'total_hari' => $validatedData['total_hari'],
                'total_lembur' => $validatedData['total_lembur'],
                'gaji_kotor' => $validatedData['gaji_kotor'],
                'total_potongan' => $validatedData['total_potongan'],
                'total_gaji_bersih' => $validatedData['total_gaji_bersih'],
                'tgl_gaji' => $validatedData['tgl_gaji'],
                'id_absensi' => $validatedData['id_absensi'],
            ]);

            return redirect()->route('laporan')->with('success', 'Data Laporan Berhasil Ditambahkan');
        } catch (\Exception $th) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menambahkan data penggajian');
        }
    }

    public function destroy($id)
    {
        $data = Penggajian::findOrFail($id);
        $data->delete();
        return redirect()->route('laporan')->with('success', 'Data Laporan Berhasil Dihapus');
    }
}
