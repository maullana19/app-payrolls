<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cuti extends Model
{
    use HasFactory;

    protected $table = 'cuti';

    protected $primaryKey = 'id_cuti';

    protected $fillable = [
        'id_karyawan',
        'jenis_cuti',
        'tgl_mulai',
        'tgl_selesai',
        'status',
        'lama_cuti',
        'foto_cuti',
        'alasan_cuti',
    ];

    public function karyawan()
    {
        return $this->belongsTo(Karyawan::class, 'id_karyawan');
    }
}
