<?php

namespace App\Http\Controllers;

use App\Models\Karyawan;
use App\Models\Penggajian;
use Carbon\Carbon;
use App\Models\Cuti;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function index()
    {
        return view('laporan');
    }

    public function laporanGaji()
    {
        $dataGaji = Penggajian::all();

        return view('reports.data_gaji', compact('dataGaji'));
    }

    public function laporanGajiDetail(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $query = Penggajian::query();

        if ($startDate && $endDate) {
            $query->whereBetween('tgl_gaji', [$startDate, $endDate]);
        }

        $dataGaji = $query->with('absensi.karyawan.jabatan')->get();

        if ($request->has('export')) {
            $pdf = PDF::loadView('pdf.penggajian_detail', compact('dataGaji', 'startDate', 'endDate'));
            return $pdf->stream('penggajian_detail.pdf');
        }

        return view('reports.penggajian_detail', compact('dataGaji', 'startDate', 'endDate'));
    }

    public function cetakLaporanGajiDetailPdf(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $query = Penggajian::query();

        if ($startDate && $endDate) {
            $query->whereBetween('tgl_gaji', [$startDate, $endDate]);
        }

        $dataGaji = $query->with('absensi.karyawan.jabatan')->get();

        $pdf = PDF::loadView('pdf.laporan_gaji', compact('dataGaji', 'startDate', 'endDate'));

        return $pdf->stream('laporan_gaji_periode' . $startDate . '-' . $endDate . '.pdf');
    }


    public function cetakDataKaryawanPdf(Request $request)
    {

        return view('laporan.cetak_data_karyawan_pdf');
    }

    public function cetakSlipGajiPdf(Request $request, $id)
    {
        $dataGaji = Penggajian::findOrFail($id);

        $pdf = PDF::loadView('pdf.slip_gaji', compact('dataGaji'));
        return $pdf->stream('slip_gaji_' . $dataGaji->absensi->karyawan->nama_lengkap . '.pdf');
    }

    public function dataCuti()
    {
        $dataCuti = Cuti::all();
        return view('reports.data_cuti', compact('dataCuti'));
    }


    public function formCuti()
    {
        $dataKaryawan = Karyawan::all();
        return view('reports.form_cuti', compact('dataKaryawan'));
    }

    public function cutiProcess(Request $request)
    {
        try {

            $request->validate([
                'id_karyawan' => 'required',
                'jenis_cuti' => 'required',
                'tgl_mulai' => 'required',
                'tgl_selesai' => 'required',
                'status' => 'required',
                'foto_cuti' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
                'alasan_cuti' => 'required',
            ]);

            $dataCuti = new Cuti();
            $dataCuti->id_karyawan = $request->id_karyawan;
            $dataCuti->jenis_cuti = $request->jenis_cuti;
            $dataCuti->tgl_mulai = $request->tgl_mulai;
            $dataCuti->tgl_selesai = $request->tgl_selesai;
            $dataCuti->status = $request->status;
            $dataCuti->lama_cuti = \Carbon\Carbon::parse($request->tgl_mulai)->diffInDays($request->tgl_selesai);
            $dataCuti->alasan_cuti = $request->alasan_cuti;

            if ($request->hasFile('foto_cuti')) {
                $image = $request->file('foto_cuti');
                $filename = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('images/foto-cuti'), $filename);
                $dataCuti->foto_cuti = $filename;
            }

            $dataCuti->save();

            return redirect()->back()->with('success', 'Data cuti berhasil ditambahkan.');
        } catch (\Exception $th) {
            return redirect()->back()->with('error', 'Gagal menambahkan data cuti');
        }
    }

    public function editCutiProcess(Request $request, $id)
    {

        $request->validate([
            'status' => 'required',
        ]);

        $dataCuti = Cuti::find($id);
        $dataCuti->status = $request->status;
        $dataCuti->save();
        return redirect()->back()->with('success', 'status dengan NIK ' . $dataCuti->karyawan->nik . ' berhasil diubah');
    }

    public function deleteCuti($id)
    {
        $dataCuti = Cuti::find($id);
        $dataCuti->delete();
        return redirect()->back()->with('success', 'Data cuti dengan NIK ' . $dataCuti->karyawan->nik . ' berhasil dihapus');
    }


    public function cetakSlipCutiPdf(Request $request, $id)
    {
        $dataCuti = Cuti::findOrFail($id);
        $pdf = PDF::loadView('pdf.data_cuti', compact('dataCuti'));
        return $pdf->stream('slip_cuti.pdf');
    }

    public function laporanCutiDetail(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Validate that startDate is less than or equal to endDate
        if ($startDate && $endDate && $startDate > $endDate) {
            return redirect()->back()->with('error', 'Tanggal mulai harus lebih kecil atau sama dengan tanggal selesai.');
        }

        // Query to get cuti data within the specified date range
        $cutis = Cuti::when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
            $query->whereBetween('tgl_mulai', [$startDate, $endDate])
                ->orWhereBetween('tgl_selesai', [$startDate, $endDate]);
        })->with('karyawan.jabatan')->get();

        return view('reports.cuti_detail', compact('cutis', 'startDate', 'endDate'));
    }

    public function cetakLaporanCutiDetailPdf(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $query = Cuti::query();

        if ($startDate && $endDate) {
            $query->whereBetween('tgl_mulai', [$startDate, $endDate])
                ->orWhereBetween('tgl_selesai', [$startDate, $endDate]);
        }

        $dataCuti = $query->with('karyawan.jabatan')->get();

        $pdf = PDF::loadView('pdf.laporan_cuti', compact('dataCuti', 'startDate', 'endDate'));
        return $pdf->stream('laporan_cuti' . $startDate . '-' . $endDate . '.pdf');
    }
}
