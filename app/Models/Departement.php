<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departement extends Model
{
    use HasFactory;

    protected $table = "departement";

    protected $primaryKey = "id_departement";

    protected $fillable = [
        'kode_dept',
        'nama_dept',
        'desk_dept'
    ];

    public $timestamps = false;

    public function jabatan()
    {
        return $this->hasMany(Jabatan::class);
    }
}
