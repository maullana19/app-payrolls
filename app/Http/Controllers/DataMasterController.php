<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Cuti;
use App\Models\Departement;
use App\Models\Karyawan;
use App\Models\Jabatan;
use App\Models\Potongan;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DataMasterController extends Controller
{
    // DATA MASTER KARYAWAN
    public function dataKaryawan()
    {
        $jabatans = Jabatan::all();
        $karyawans = Karyawan::all();
        $dataCuti = Cuti::all();

        return view('datamaster.karyawan', compact('karyawans', 'jabatans', 'dataCuti'));
    }

    public function getNikKaryawan($nik)
    {
        $karyawans = Karyawan::where('nik', $nik)->get();
        return response()->json($karyawans);
    }


    public function tambahDataKaryawan(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'nik' => 'required|string|max:6',
                'no_ktp' => 'required|string|max:16',
                'nama_lengkap' => 'required|string|max:60',
                'tgl_lahir' => 'required|date',
                'tempat_lahir' => 'required|string|max:50',
                'jenis_kelamin' => 'required|in:laki-laki,perempuan',
                'email' => 'required|email|max:80',
                'no_hp' => 'required|string|max:16',
                'agama' => 'required|string|max:20',
                'pendidikan_terakhir' => 'required|string|max:20',
                'status_pernikahan' => 'required|in:menikah,belum menikah',
                'status_kerja' => 'required|in:tetap,kontrak',
                'no_rekening' => 'required|string|max:16',
                'npwp' => 'required|string|max:16',
                'id_jabatan' => 'required|integer',
                'alamat' => 'required',
                'tgl_mulai' => 'required|date',
                'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:3000',
            ]);

            if ($request->hasFile('foto')) {
                $fileName = time() . '.' . $request->foto->extension();
                $request->foto->move(public_path('images'), $fileName);
                $validatedData['foto'] = $fileName;
            }

            Karyawan::create($validatedData);
            return redirect()->route('data-karyawan')->with('success', 'Data Karyawan Berhasil Ditambahkan');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat validasi data karyawan: ' . $th->getMessage());
        }
    }

    public function editKaryawanProcess(Request $request, $id)
    {
        try {
            $karyawan = Karyawan::findOrFail($id);

            $validatedData = $request->validate([
                'nik' => 'required|string|max:6',
                'no_ktp' => 'required|string|max:16',
                'nama_lengkap' => 'required|string',
                'tgl_lahir' => 'required|date',
                'tempat_lahir' => 'required|string',
                'jenis_kelamin' => 'required|in:laki-laki,perempuan',
                'email' => 'required|email',
                'no_hp' => 'required|string|max:16',
                'agama' => 'required|string',
                'pendidikan_terakhir' => 'required|string',
                'status_pernikahan' => 'required|string',
                'status_kerja' => 'required|string',
                'no_rekening' => 'nullable|string|max:20',
                'npwp' => 'nullable|string|max:16',
                'id_jabatan' => 'required|integer',
                'alamat' => 'required|string',
                'tgl_mulai' => 'required|date',
                'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:3000',
            ]);

            if ($request->hasFile('foto')) {
                $fileName = time() . '.' . $request->foto->extension();
                $request->foto->move(public_path('images'), $fileName);
                $validatedData['foto'] = $fileName;
            }

            $karyawan->update($validatedData);

            return redirect()->route('data-karyawan')->with('success', 'Data Karyawan Berhasil Diperbarui');
        } catch (\Exception $th) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui data karyawan');
        }
    }

    public function hapusDataKaryawan($id)
    {
        $karyawan = Karyawan::find($id);
        $karyawan->delete();
        return redirect()->route('data-karyawan')->with('success', 'Data Karyawan Berhasil Dihapus');
    }

    // CetakDataKaryawanPDF
    public function CetakDataKaryawanPDF($id)
    {
        $karyawans = Karyawan::findOrFail($id);
        $cuti = Cuti::where('id_karyawan', $id)->get();
        $pdf = PDF::loadView('pdf.data_karyawan', compact('karyawans', 'cuti'));
        return $pdf->stream();
    }

    // Data Departement
    public function dataDepartement()
    {
        $departements = Departement::all();
        return view('datamaster.departement', compact('departements'));
    }

    public function tambahDataDepartement(Request $request)
    {
        $validatedData = $request->validate([
            'nama_dept' => 'required|string|max:50',
            'kode_dept' => [
                'required',
                'string',
                'max:3',
                function ($attribute, $value, $fail) {
                    $departement = Departement::where('kode_dept', $value)->first();
                    if ($departement && $departement->id != request()->id) {
                        return $fail('Kode departement sudah terdaftar');
                    }
                },
            ],
            'desk_dept' => 'nullable',
        ]);

        try {
            Departement::create($validatedData);

            return redirect()->route('data-departemen')->with('success', 'Data Departement Berhasil Ditambahkan');
        } catch (\Exception $th) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menambahkan data departement');
        }
    }

    public function editFormDepartement($id)
    {
        $departement = Departement::findOrFail($id);
        return view('datamaster.edit_departement', compact('departement'));
    }

    public function editDepartementProcess(Request $request, $id)
    {
        $validatedData = $request->validate([
            'nama_dept' => 'required|string|max:50',
            'kode_dept' => 'required|string|max:3',
            'desk_dept' => 'nullable',
        ]);


        $departement = Departement::findOrFail($id);
        $departement->update($validatedData);
        return redirect()->route('data-departemen')->with('success', 'Data Departement Berhasil Diperbarui');
    }

    public function hapusDataDepartement($id)
    {
        $departement = Departement::find($id);
        $departement->delete();
        return redirect()->route('data-departemen')->with('success', 'Data Departement Berhasil Dihapus');
    }

    // DATA MASTER JABATAN
    public function dataJabatan()
    {
        $departements = Departement::all();

        $jabatans = Jabatan::all();
        return view('datamaster.jabatan', compact('jabatans', 'departements'));
    }

    public function tambahDataJabatan(Request $request)
    {
        $validatedData = $request->validate([
            'nama_jabatan' => 'required|string|max:30',
            'id_departement' => 'required|integer',
            'gaji_harian' => 'required|numeric',
            'tunjangan_makan' => 'required|numeric',
            'tunjangan_transport' => 'required|numeric',
            'tunjangan_kesehatan' => 'required|numeric',
            'tunjangan_lainnya' => 'required|numeric',
            'bonus' => 'required|numeric',
        ]);

        $gross = ($validatedData['gaji_harian']  + $validatedData['tunjangan_makan'] + $validatedData['tunjangan_transport'] + $validatedData['tunjangan_kesehatan'] + $validatedData['tunjangan_lainnya'] + $validatedData['bonus']) * 26;
        $validatedData['gross'] = $gross;


        // $gaji_pokok = ($validatedData['gaji_harian'] * 26) + $validatedData['tunjangan_makan'] + $validatedData['tunjangan_transport'];
        // $validatedData['gaji_pokok'] = $gaji_pokok;

        try {
            Jabatan::create($validatedData);
            return redirect()->route('data-jabatan')->with('success', 'Data Jabatan Berhasil Ditambahkan');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menambahkan data jabatan');
        }
    }

    public function editFormJabatan($id)
    {
        $jabatan = Jabatan::findOrFail($id);
        $departements = Departement::all();
        return view('datamaster.edit_jabatan', compact('jabatan', 'departements'));
    }

    public function editDataJabatan(Request $request, $id)
    {
        try {
            $validatedData = $request->validate([
                'nama_jabatan' => 'required|string|max:255',
                'id_departement' => 'required|integer',
                'gaji_harian' => 'required|numeric',
                'tunjangan_makan' => 'required|numeric',
                'tunjangan_transport' => 'required|numeric',
                'tunjangan_kesehatan' => 'required|numeric',
                'tunjangan_lainnya' => 'required|numeric',
                'bonus' => 'required|numeric',
            ]);

            $gross = ($validatedData['gaji_harian']  + $validatedData['tunjangan_makan'] + $validatedData['tunjangan_transport'] + $validatedData['tunjangan_kesehatan'] + $validatedData['tunjangan_lainnya'] + $validatedData['bonus']) * 26;
            $validatedData['gross'] = $gross;

            // $gaji_pokok = ($validatedData['gaji_harian'] * 26) + $validatedData['tunjangan_makan'] + $validatedData['tunjangan_transport'];
            // $validatedData['gaji_pokok'] = $gaji_pokok;

            $jabatan = Jabatan::findOrFail($id);
            $jabatan->update($validatedData);

            return redirect()->route('data-jabatan')->with('success', 'Data Jabatan Berhasil Diperbarui');
        } catch (\Exception $th) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui data jabatan ');
        }
    }

    public function hapusDataJabatan($id)
    {
        $jabatan = Jabatan::find($id);
        $jabatan->delete();
        return redirect()->route('data-jabatan')->with('success', 'Data Jabatan Berhasil Dihapus');
    }

    public function potonganGaji()
    {
        $dataPotongan = Potongan::all();
        return view('datamaster.potongan', compact('dataPotongan'));
    }

    public function tambahPotongan(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'nama_potongan' => 'required|string|max:255',
                'nominal' => 'required|numeric',
            ]);

            Potongan::create($validatedData);

            return redirect()->route('data-potongan')->with('success', 'Data Potongan Berhasil Ditambahkan');
        } catch (\Exception $th) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menambahkan data potongan');
        }
    }

    public function editPotonganProcess(Request $request, $id)
    {
        $potongan = Potongan::findOrFail($id);

        $validatedData = $request->validate([
            'nama_potongan' => 'required|string|max:255',
            'nominal' => 'required|numeric',
        ]);

        $potongan->update($validatedData);

        return redirect()->route('data-potongan')->with('success', 'Data Potongan Berhasil Diperbarui');
    }

    public function hapusPotongan($id)
    {
        $potongan = Potongan::find($id);
        $potongan->delete();
        return redirect()->route('data-potongan')->with('success', 'Data Potongan Berhasil Dihapus');
    }

    public function rekapanAbensi()
    {
        $dataKaryawan = Karyawan::all();
        $dataPotongan = Potongan::all();
        $dataAbsensi = Absensi::all();
        return view('datamaster.absensi', compact('dataAbsensi', 'dataKaryawan', 'dataPotongan'));
    }

    public function tambahAbsensi(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'id_karyawan' => 'required',
                'dari_tanggal' => 'required',
                'sampai_tanggal' => 'required',
                'total_lembur' => 'required',
                'total_alpa' => 'required',
                'total_hadir' => 'required',
                'total_sakit' => 'required',
                'total_izin' => 'required',
            ]);

            Absensi::create($validatedData);
            return redirect()->route('data-absensi')->with('success', 'Data Absensi Berhasil Ditambahkan');
        } catch (\Exception $th) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menambahkan data absensi');
        }
    }

    public function editAbsensiProcess(Request $request, $id)
    {
        try {
            $absensi = Absensi::findOrFail($id);
            $validatedData = $request->validate([
                'id_karyawan' => 'required',
                'dari_tanggal' => 'required',
                'sampai_tanggal' => 'required',
                'total_lembur' => 'required',
                'total_alpa' => 'required',
                'total_hadir' => 'required',
                'total_sakit' => 'required',
                'total_izin' => 'required',
                'status_validasi' => 'required',
            ]);

            $absensi->update($validatedData);

            return redirect()->route('data-absensi')->with('success', 'Data Absensi Berhasil Diperbarui, Validasi Absensi :' . $absensi->status_validasi);
        } catch (\Exception $th) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui data absensi');
        }
    }

    public function hapusAbsensi($id)
    {
        $absensi = Absensi::find($id);
        $absensi->delete();
        return redirect()->route('data-absensi')->with('success', 'Data Absensi Berhasil Dihapus');
    }

    public function validateAllAbsensi(Request $request)
    {
        Absensi::query()->update(['status_validasi' => 'validate']);
        return redirect()->route('data-absensi')->with('success', 'Semua Absensi Berhasil Valid');
    }
}
