<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DataMasterController;
use App\Http\Controllers\ExcellController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PenggajianController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\TentangController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

// Authentication Routes
Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/loginProcess', [LoginController::class, 'loginProcess'])->name('login-process');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/registration', [RegisterController::class, 'showRegistrationForm'])->name('register');


Route::middleware(['auth'])->group(function () {
  // AdminRoute
  Route::get('/admin', [AdminController::class, 'index'])->name('admin');
  Route::get('/user_data', [AdminController::class, 'dataUser'])->name('data-user');
  Route::get('users/export', [ExcellController::class, 'exportUser'])->name('users.export');
  Route::post('users/import', [ExcellController::class, 'importUser'])->name('users.import');

  Route::post('/addUserProcess', [AdminController::class, 'addUserProcess'])->name('add-user-process');
  Route::put('/editUser/{id}', [AdminController::class, 'editUser'])->name('edit-user-process');
  Route::delete('/deleteUser/{id}', [AdminController::class, 'deleteUser'])->name('delete-process');
  // UserRoute
  Route::get('/profile', [UserController::class, 'index'])->name('profile');
  Route::post('/editUserProcess/{id}', [UserController::class, 'editUserProcess'])->name('update-process');

  // Search Route
  Route::get('/searchResults', [SearchController::class, 'searchResults'])->name('search-data');

  // Dashboard
  Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

  // Data Karyawan
  Route::get('/datamaster/data-karyawan', [DataMasterController::class, 'dataKaryawan'])->name('data-karyawan');
  Route::post('/datamaster/add-karyawan', [DataMasterController::class, 'tambahDataKaryawan'])->name('add-karyawan-process');
  Route::put('/datamaster/edit-karyawan/{id}', [DataMasterController::class, 'editKaryawanProcess'])->name('edit-karyawan-process');
  Route::delete('/delete-karyawan/{id}', [DataMasterController::class, 'hapusDataKaryawan'])->name('delete-karyawan');
  Route::get('/generatepdf/{id}', [DataMasterController::class, 'CetakDataKaryawanPDF'])->name('generatepdf-pegawai');
  Route::get('/data_karyawan/export', [ExcellController::class, 'exportDataKaryawan'])->name('data_karyawan.export');
  Route::post('/data_karyawan/import', [ExcellController::class, 'importDataKaryawan'])->name('data_karyawan.import');

  // Data Departemen
  Route::get('/datamaster/data-departemen', [DataMasterController::class, 'dataDepartement'])->name('data-departemen');
  Route::post('/datamaster/add-departemen', [DataMasterController::class, 'tambahDataDepartement'])->name('add-departemen-process');
  Route::get('/datamaster/form-edit-departemen/{id}', [DataMasterController::class, 'editFormDepartemen'])->name('form-edit-departemen');
  Route::put('/datamaster/edit-departemen/{id}', [DataMasterController::class, 'editDepartementProcess'])->name('edit-departemen-process');
  Route::delete('/delete-departemen/{id}', [DataMasterController::class, 'hapusDataDepartement'])->name('delete-departement');

  // Data Jabatan
  Route::get('/datamaster/data-jabatan', [DataMasterController::class, 'dataJabatan'])->name('data-jabatan');
  Route::post('/datamaster/add-jabatan', [DataMasterController::class, 'tambahDataJabatan'])->name('add-jabatan-process');
  Route::get('/datamaster/form-edit-jabatan/{id}', [DataMasterController::class, 'editFormJabatan'])->name('form-edit-jabatan');
  Route::put('/datamaster/edit-jabatan/{id}', [DataMasterController::class, 'editDataJabatan'])->name('edit-jabatan-process');
  Route::delete('/delete-jabatan/{id}', [DataMasterController::class, 'hapusDataJabatan'])->name('delete-jabatan');

  // Data Absensi
  Route::get('/datamaster/data-absensi', [DataMasterController::class, 'rekapanAbensi'])->name('data-absensi');
  Route::get('get-total-days', [DataMasterController::class, 'getTotalDays'])->name('get-total-days');
  Route::post('/absensi/validate_all', [DataMasterController::class, 'validateAllAbsensi'])->name('absensi.validate_all');
  Route::post('/datamaster/add-absensi', [DataMasterController::class, 'tambahAbsensi'])->name('add-absensi-process');
  Route::get('/datamaster/form-edit-absensi/{id}', [DataMasterController::class, 'editFormAbsensi'])->name('form-edit-absensi');
  Route::put('/datamaster/edit-absensi/{id}', [DataMasterController::class, 'editAbsensiProcess'])->name('edit-absensi-process');
  Route::delete('/delete-absensi/{id}', [DataMasterController::class, 'hapusAbsensi'])->name('delete-absensi');
  Route::get('/datamaster/data-absensi/export', [ExcellController::class, 'exportRekapAbsensi'])->name('data_absensi.export');
  Route::post('/datamaster/data-absensi/import', [ExcellController::class, 'importRekapAbsensi'])->name('data_absensi.import');

  // Data Potongan
  Route::get('/datamaster/potongan-gaji', [DataMasterController::class, 'potonganGaji'])->name('data-potongan');
  Route::post('/datamaster/add-potongan-gaji', [DataMasterController::class, 'tambahPotongan'])->name('add-potongan-process');
  Route::put('/datamaster/edit-potongan/{id}', [DataMasterController::class, 'editPotonganProcess'])->name('edit-potongan-process');
  Route::delete('/delete-potongan/{id}', [DataMasterController::class, 'hapusPotongan'])->name('delete-potongan');

  // Laporan
  Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan');
  Route::get('/laporan/data-gaji', [LaporanController::class, 'laporanGaji'])->name('data-gaji');
  Route::get('/laporan/cetak_slip_gaji/{id}', [LaporanController::class, 'cetakSlipGajiPdf'])->name('cetak-slip-gaji');
  Route::get('/laporan-gaji', [LaporanController::class, 'laporanGajiDetail'])->name('laporan.gaji.detail');
  Route::get('/laporan/gaji/cetak', [LaporanController::class, 'cetakLaporanGajiDetailPdf'])->name('cetak-laporan-gaji-detail');
  Route::get('/laporan/data-cuti', [LaporanController::class, 'dataCuti'])->name('data-cuti');
  Route::get('/laporan/form_cuti', [LaporanController::class, 'formCuti'])->name('form-cuti');
  Route::post('/laporan/form_cuti', [LaporanController::class, 'cutiProcess'])->name('proses-cuti');
  Route::get('/laporan/cetak_slip_cuti/{id}', [LaporanController::class, 'cetakSlipCutiPdf'])->name('cetak-slip-cuti');
  Route::put('/laporan/update_status_cuti/{id}', [LaporanController::class, 'editCutiProcess'])->name('update-status-cuti');
  Route::delete('/laporan/delete_cuti/{id}', [LaporanController::class, 'deleteCuti'])->name('delete-cuti');
  Route::get('/laporan-cuti', [LaporanController::class, 'laporanCutiDetail'])->name('laporan.cuti.detail');
  Route::get('/laporan/cuti/cetak', [LaporanController::class, 'cetakLaporanCutiDetailPdf'])->name('cetak-laporan-cuti-detail');


  // Route Penggajian
  Route::get('/penggajian', [PenggajianController::class, 'index'])->name('penggajian');
  Route::get('/payrolls/form_penggajian', [PenggajianController::class, 'formPenggajian'])->name('penggajian.form');
  Route::post('/payrolls/form_penggajian/{id}', [PenggajianController::class, 'prosesPenggajian'])->name('penggajian.proses');
  Route::delete('/payrolls/delete/{id}', [PenggajianController::class, 'destroy'])->name('penggajian.delete');

  // Tentang Perusahaan 
  Route::get('/tentang-perusahaan', [TentangController::class, 'index'])->name('tentang-perusahaans');
});

Route::middleware(['user'])->group(function () {
  Route::get('/datamaster/data-departemen', [DataMasterController::class, 'dataDepartement'])->name('data-departemen');
  Route::post('/datamaster/add-departemen', [DataMasterController::class, 'tambahDataDepartement'])->name('add-departemen-process');
  Route::get('/datamaster/form-edit-departemen/{id}', [DataMasterController::class, 'editFormDepartemen'])->name('form-edit-departemen');
  Route::put('/datamaster/edit-departemen/{id}', [DataMasterController::class, 'editDepartementProcess'])->name('edit-departemen-process');
  Route::delete('/delete-departemen/{id}', [DataMasterController::class, 'hapusDataDepartement'])->name('delete-departement');

  // Data Jabatan
  Route::get('/datamaster/data-jabatan', [DataMasterController::class, 'dataJabatan'])->name('data-jabatan');
  Route::post('/datamaster/add-jabatan', [DataMasterController::class, 'tambahDataJabatan'])->name('add-jabatan-process');
  Route::get('/datamaster/form-edit-jabatan/{id}', [DataMasterController::class, 'editFormJabatan'])->name('form-edit-jabatan');
  Route::put('/datamaster/edit-jabatan/{id}', [DataMasterController::class, 'editDataJabatan'])->name('edit-jabatan-process');
  Route::delete('/delete-jabatan/{id}', [DataMasterController::class, 'hapusDataJabatan'])->name('delete-jabatan');

  // Data Absensi
  Route::get('/datamaster/data-absensi', [DataMasterController::class, 'rekapanAbensi'])->name('data-absensi');
  Route::get('get-total-days', [DataMasterController::class, 'getTotalDays'])->name('get-total-days');
  Route::post('/absensi/validate_all', [DataMasterController::class, 'validateAllAbsensi'])->name('absensi.validate_all');
  Route::post('/datamaster/add-absensi', [DataMasterController::class, 'tambahAbsensi'])->name('add-absensi-process');
  Route::get('/datamaster/form-edit-absensi/{id}', [DataMasterController::class, 'editFormAbsensi'])->name('form-edit-absensi');
  Route::put('/datamaster/edit-absensi/{id}', [DataMasterController::class, 'editAbsensiProcess'])->name('edit-absensi-process');
  Route::delete('/delete-absensi/{id}', [DataMasterController::class, 'hapusAbsensi'])->name('delete-absensi');
  Route::get('/datamaster/data-absensi/export', [ExcellController::class, 'exportRekapAbsensi'])->name('data_absensi.export');
  Route::post('/datamaster/data-absensi/import', [ExcellController::class, 'importRekapAbsensi'])->name('data_absensi.import');

  // Data Potongan
  Route::get('/datamaster/potongan-gaji', [DataMasterController::class, 'potonganGaji'])->name('data-potongan');
  Route::post('/datamaster/add-potongan-gaji', [DataMasterController::class, 'tambahPotongan'])->name('add-potongan-process');
  Route::put('/datamaster/edit-potongan/{id}', [DataMasterController::class, 'editPotonganProcess'])->name('edit-potongan-process');
  Route::delete('/delete-potongan/{id}', [DataMasterController::class, 'hapusPotongan'])->name('delete-potongan');

  Route::get('/penggajian', [PenggajianController::class, 'index'])->name('penggajian');
  Route::get('/payrolls/form_penggajian', [PenggajianController::class, 'formPenggajian'])->name('penggajian.form');
  Route::post('/payrolls/form_penggajian/{id}', [PenggajianController::class, 'prosesPenggajian'])->name('penggajian.proses');
  Route::delete('/payrolls/delete/{id}', [PenggajianController::class, 'destroy'])->name('penggajian.delete');

  Route::put('/laporan/update_status_cuti/{id}', [LaporanController::class, 'editCutiProcess'])->name('update-status-cuti');
  Route::delete('/laporan/delete_cuti/{id}', [LaporanController::class, 'destroyCuti'])->name('delete-cuti');
});
