<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;

    protected $table = 'absensi';

    protected $primaryKey = 'id_absensi';

    protected $fillable = [
        'id_karyawan',
        'dari_tanggal',
        'sampai_tanggal',
        'total_lembur',
        'total_alpa',
        'total_hadir',
        'total_sakit',
        'total_izin',
        'status_validasi',
    ];

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'id_karyawan');
    }

    public function penggajian()
    {
        return $this->hasMany(Penggajian::class, 'id_penggajian');
    }
}
