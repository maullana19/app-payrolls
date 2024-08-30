<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Jabatan extends Model
{
    use HasFactory;

    protected $table = 'jabatan';

    public $timestamps = false;

    protected $primaryKey = 'id_jabatan';

    protected $fillable = [
        'id_departement',
        'nama_jabatan',
        'gaji_harian',
        'tunjangan_makan',
        'tunjangan_transport',
        'tunjangan_kesehatan',
        'tunjangan_lainnya',
        'bonus',
        'gross',
    ];

    public function departement()
    {
        return $this->belongsTo(Departement::class, 'id_departement');
    }
}
