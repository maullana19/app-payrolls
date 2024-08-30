<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Karyawan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;


class ExcellController extends Controller
{

    public function exportDataKaryawan()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set header row
        $sheet->setCellValue('A1', 'ID');
        $sheet->setCellValue('B1', 'NIK');
        $sheet->setCellValue('C1', 'No KTP');
        $sheet->setCellValue('D1', 'Nama Lengkap');
        $sheet->setCellValue('E1', 'Tanggal Lahir');
        $sheet->setCellValue('F1', 'Tempat Lahir');
        $sheet->setCellValue('G1', 'Jenis Kelamin');
        $sheet->setCellValue('H1', 'Email');
        $sheet->setCellValue('I1', 'No HP');
        $sheet->setCellValue('J1', 'Agama');
        $sheet->setCellValue('K1', 'Pendidikan Terakhir');
        $sheet->setCellValue('L1', 'Status Pernikahan');
        $sheet->setCellValue('M1', 'Status Kerja');
        $sheet->setCellValue('N1', 'No Rekening');
        $sheet->setCellValue('O1', 'NPWP');
        $sheet->setCellValue('P1', 'ID Jabatan');
        $sheet->setCellValue('Q1', 'Alamat');
        $sheet->setCellValue('R1', 'Tanggal Mulai');
        $sheet->setCellValue('S1', 'Foto');

        // Get users and populate sheet
        $employees = Karyawan::all();
        $rowNumber = 2;
        foreach ($employees as $employee) {
            $sheet->setCellValue('A' . $rowNumber, $employee->id_karyawan);
            $sheet->setCellValue('B' . $rowNumber, $employee->nik);
            $sheet->setCellValue('C' . $rowNumber, $employee->no_ktp);
            $sheet->setCellValue('D' . $rowNumber, $employee->nama_lengkap);
            $sheet->setCellValue('E' . $rowNumber, Carbon::parse($employee->tgl_lahir)->format('Y-m-d'));
            $sheet->setCellValue('F' . $rowNumber, $employee->tempat_lahir);
            $sheet->setCellValue('G' . $rowNumber, $employee->jenis_kelamin);
            $sheet->setCellValue('H' . $rowNumber, $employee->email);
            $sheet->setCellValue('I' . $rowNumber, $employee->no_hp);
            $sheet->setCellValue('J' . $rowNumber, $employee->agama);
            $sheet->setCellValue('K' . $rowNumber, $employee->pendidikan_terakhir);
            $sheet->setCellValue('L' . $rowNumber, $employee->status_pernikahan);
            $sheet->setCellValue('M' . $rowNumber, $employee->status_kerja);
            $sheet->setCellValue('N' . $rowNumber, $employee->no_rekening);
            $sheet->setCellValue('O' . $rowNumber, $employee->npwp);
            $sheet->setCellValue('P' . $rowNumber, $employee->id_jabatan);
            $sheet->setCellValue('Q' . $rowNumber, $employee->alamat);
            $sheet->setCellValue('R' . $rowNumber, Carbon::parse($employee->tgl_mulai)->format('Y-m-d'));
            $sheet->setCellValue('S' . $rowNumber, $employee->foto);
            $rowNumber++;
        }

        // Save file and return response
        $writer = new Xlsx($spreadsheet);
        $fileName = 'data-karyawan.xlsx';
        $temp_file = tempnam(sys_get_temp_dir(), $fileName);
        $writer->save($temp_file);

        return response()->download($temp_file, $fileName)->deleteFileAfterSend(true);
    }

    public function importDataKaryawan(Request $request)
    {
        try {
            $request->validate([
                'file' => 'required|mimes:xlsx,xls',
            ]);

            if ($request->hasFile('file')) {
                $file = $request->file('file')->getRealPath();
                $spreadsheet = IOFactory::load($file);
                $sheet = $spreadsheet->getActiveSheet();
                $rows = $sheet->toArray();
            }

            // Iterate through rows (skip header row)
            foreach (array_slice($rows, 1) as $row) {
                // Validate and convert data as needed
                $karyawanData = [
                    'nik' => $row[1],
                    'no_ktp' => $row[2],
                    'nama_lengkap' => $row[3],
                    'tgl_lahir' => $row[4],
                    'tempat_lahir' => $row[5],
                    'jenis_kelamin' => $row[6],
                    'email' => $row[7],
                    'no_hp' => $row[8],
                    'agama' => $row[9],
                    'pendidikan_terakhir' => $row[10],
                    'status_pernikahan' => $row[11],
                    'status_kerja' => $row[12],
                    'no_rekening' => $row[13],
                    'npwp' => $row[14],
                    'id_jabatan' => intval($row[15]),
                    'alamat' => $row[16],
                    'tgl_mulai' => $row[17],
                    'foto' => $row[18],
                ];
                Karyawan::create($karyawanData);
            }

            return redirect()->route('data-karyawan')->with('success', 'Data karyawans imported successfully.');
        } catch (\Exception $th) {
            return redirect()->route('data-karyawan')->with('error', 'Gagal import data karyawan. ');
        }
    }

    public function exportRekapAbsensi()
    {
        $absensis = Absensi::with('karyawan')->get();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'ID Rekap');
        $sheet->setCellValue('B1', 'ID Karyawan');
        $sheet->setCellValue('C1', 'Dari Tanggal');
        $sheet->setCellValue('D1', 'Sampai Tanggal');
        $sheet->setCellValue('E1', 'Total Lembur');
        $sheet->setCellValue('F1', 'Total Alpa');
        $sheet->setCellValue('G1', 'Total Hadir');
        $sheet->setCellValue('H1', 'Total Sakit');
        $sheet->setCellValue('I1', 'Total Izin');
        $sheet->setCellValue('J1', 'Status Validasi');

        $rowNumber = 2;

        foreach ($absensis as $absensi) {
            $sheet->setCellValue('A' . $rowNumber, $absensi->id_absensi);
            $sheet->setCellValue('B' . $rowNumber, $absensi->id_karyawan);
            $sheet->setCellValue('C' . $rowNumber, $absensi->dari_tanggal);
            $sheet->setCellValue('D' . $rowNumber, $absensi->sampai_tanggal);
            $sheet->setCellValue('E' . $rowNumber, $absensi->total_lembur);
            $sheet->setCellValue('F' . $rowNumber, $absensi->total_alpa);
            $sheet->setCellValue('G' . $rowNumber, $absensi->total_hadir);
            $sheet->setCellValue('H' . $rowNumber, $absensi->total_sakit);
            $sheet->setCellValue('I' . $rowNumber, $absensi->total_izin);
            $sheet->setCellValue('J' . $rowNumber, $absensi->status_validasi);
            $rowNumber++;
        }

        $writer = new Xlsx($spreadsheet);
        $fileName = 'rekap-absensi.xlsx';
        $temp_file = tempnam(sys_get_temp_dir(), $fileName);
        $writer->save($temp_file);
        return response()->download($temp_file, $fileName)->deleteFileAfterSend(true);
    }

    public function importRekapAbsensi(Request $request)
    {
        try {
            // Validasi file
            $request->validate([
                'file' => 'required|mimes:xlsx,xls',
            ]);

            // Mendapatkan file dan memuat spreadsheet
            if ($request->hasFile('file')) {
                $file = $request->file('file')->getRealPath();
                $spreadsheet = IOFactory::load($file);
                $sheet = $spreadsheet->getActiveSheet();
                $rows = $sheet->toArray();
            }

            // Iterate through rows (skip header row)
            foreach (array_slice($rows, 1) as $row) {
                // Validate and convert data as needed
                $absensiData = [
                    'id_absensi' => $row[0],
                    'id_karyawan' => $row[1],
                    'dari_tanggal' => $row[2],
                    'sampai_tanggal' => $row[3],
                    'total_lembur' => $row[4],
                    'total_alpa' => $row[5],
                    'total_hadir' => $row[6],
                    'total_sakit' => $row[7],
                    'total_izin' => $row[8],
                    'status_validasi' => $row[9],
                ];
                Absensi::create($absensiData);
            }


            // Redirect atau berikan respons sesuai kebutuhan
            return redirect()->back()->with('success', 'Data absensi berhasil diimport.');
        } catch (\Exception $th) {
            return redirect()->back()->with('error', 'Gagal mengimport data absensi, periksa kembali.');
        }
    }
}
