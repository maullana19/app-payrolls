<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    use HasFactory;

    public $timestamps = false;

    public $table = "karyawan";

    public $primaryKey = "id_karyawan";

    protected $fillable = [
        'nik',
        'no_ktp',
        'nama_lengkap',
        'tgl_lahir',
        'tempat_lahir',
        'jenis_kelamin',
        'email',
        'no_hp',
        'agama',
        'pendidikan_terakhir',
        'status_pernikahan',
        'status_kerja',
        'no_rekening',
        'npwp',
        'id_jabatan',
        'alamat',
        'tgl_mulai',
        'foto',
    ];

    public function jabatan()
    {
        return $this->belongsTo(Jabatan::class, 'id_jabatan');
    }


    public function absensi()
    {
        return $this->hasMany(Absensi::class, 'id_absensi');
    }
}
