<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UnitKerja extends Model
{
    protected $table = 'unitkerja';

    protected $fillable = [
       'id_cabang', 'nama', 'alamat', 'phone', 'lat', 'long'
    ];

    public function cabang()
    {
        return $this->hasOne(Cabang::class, 'id', 'id_cabang');
    }
}
