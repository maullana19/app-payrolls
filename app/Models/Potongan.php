<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Potongan extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $table = 'potongan';

    protected $primaryKey = 'id_potongan';

    protected $fillable = [
        'nama_potongan',
        'nominal',
    ];

    public function potongan()
    {
        return $this->hasMany(Potongan::class, 'id_potongan');
    }
}
