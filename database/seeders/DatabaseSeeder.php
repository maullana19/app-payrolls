<?php

namespace Database\Seeders;

use App\Models\Absensi;
use App\Models\Cuti;
use App\Models\Departement;
use App\Models\Jabatan;
use App\Models\Karyawan;
use App\Models\Penggajian;
use App\Models\Perusahaan;
use App\Models\Potongan;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {

        Role::create([
            'id_role' => 1,
            'name_role' => 'Administrator',
        ]);

        Role::create([
            'id_role' => 2,
            'name_role' => 'User',
        ]);

        User::create([
            'id_users' => 1,
            'name' => 'HR Manager',
            'email' => 'admin@example.com',
            'phone' => '08123456789',
            'position' => 'admin',
            'password' => bcrypt('123456789'),
            'image' => 'default.png',
            'id_role' => 1,
        ]);

        User::create([
            'id_users' => 2,
            'name' => 'User',
            'email' => 'user@example.com',
            'phone' => '08123456789',
            'position' => 'user',
            'password' => bcrypt('123456789'),
            'image' => 'default.png',
            'id_role' => 2,
        ]);

        Potongan::create([
            'id_potongan' => 1,
            'nama_potongan' => 'BPJS Kesehatan',
            'nominal' => 0.01,
        ]);

        Potongan::create([
            'id_potongan' => 2,
            'nama_potongan' => 'Jaminan Hari Tua (JHT)',
            'nominal' => 0.02,
        ]);

        Potongan::create([
            'id_potongan' => 3,
            'nama_potongan' => 'Jaminan Pensiun (JP)',
            'nominal' => 0.01,
        ]);

        Departement::create([
            'id_departement' => 1,
            'kode_dept' => '005',
            'nama_dept' => 'HR Operation',
            'desk_dept' => 'Rekrutmen, pelatihan, pengembangan karyawan, manajemen kinerja, dan kesejahteraan karyawan.',
        ]);

        Departement::create([
            'id_departement' => 2,
            'kode_dept' => '010',
            'nama_dept' => 'Finance Operation',
            'desk_dept' => 'Pembukuan, pelaporan keuangan, anggaran, analisis biaya, dan manajemen arus kas.',
        ]);

        Departement::create([
            'id_departement' => 3,
            'kode_dept' => '015',
            'nama_dept' => 'Production ',
            'desk_dept' => 'Mengelola seluruh proses produksi dari bahan mentah menjadi produk jadi.',
        ]);

        Departement::create([
            'id_departement' => 4,
            'kode_dept' => '020',
            'nama_dept' => 'Quality Control/Quality Assurance',
            'desk_dept' => 'Melakukan inspeksi dan pengujian produk, memantau proses untuk memastikan kualitas tetap terjaga, dan menangani masalah kualitas.',
        ]);


        Departement::create([
            'id_departement' => 5,
            'kode_dept' => '025',
            'nama_dept' => 'Logistics and Warehouse',
            'desk_dept' => 'Mengatur penerimaan bahan baku, penyimpanan, pengambilan bahan untuk produksi, serta pengiriman produk jadi ke pelanggan.',
        ]);

        Departement::create([
            'id_departement' => 6,
            'kode_dept' => '030',
            'nama_dept' => 'Marketing and Sales',
            'desk_dept' => 'Riset pasar, strategi pemasaran, kampanye promosi, dan manajemen penjualan.',
        ]);

        Jabatan::create([
            'id_jabatan' => 1,
            'id_departement' => 1,
            'nama_jabatan' => 'HR Staff',
            'gaji_harian' => 126000,
            'tunjangan_makan' => 23000,
            'tunjangan_transport' => 21000,
            'tunjangan_kesehatan' => 11000,
            'tunjangan_lainnya' => 0,
            'bonus' => 0,
            'gross' => 4706000,
        ]);

        Karyawan::create([
            'id_karyawan' => 1,
            'nik' => '123456',
            'no_ktp' => '123456789',
            'nama_lengkap' => 'KaryawanTesting',
            'tgl_lahir' => '1990-01-01',
            'tempat_lahir' => 'jakarta',
            'jenis_kelamin' => 'laki-laki',
            'email' => 'johndoe@examplecom',
            'no_hp' => '08123456789',
            'agama' => 'islam',
            'pendidikan_terakhir' => 's1',
            'status_pernikahan' => 'belum menikah',
            'status_kerja' => 'kontrak',
            'no_rekening' => '123456789',
            'npwp' => '123456789',
            'id_jabatan' => 1,
            'alamat' => 'Jakarta barat, cengkareng timur tegal alur',
            'tgl_mulai' => '2022-01-01',
            'foto' => 'default.png',
        ]);
    }
}
