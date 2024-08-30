<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penggajian extends Model
{
    use HasFactory;

    protected $table = 'penggajian';

    protected $primaryKey = 'id_penggajian';

    protected $fillable = [
        'id_absensi',
        'total_hari',
        'total_lembur',
        'gaji_kotor',
        'total_potongan',
        'total_gaji_bersih',
        'tgl_gaji',
    ];

    public function absensi()
    {
        return $this->belongsTo(Absensi::class, 'id_absensi');
    }
}
