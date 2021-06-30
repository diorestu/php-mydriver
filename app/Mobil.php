<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use QCod\ImageUp\HasImageUploads;

class Mobil extends Model
{
    use HasImageUploads;

    protected $fillable = [
        'nama', 'plat', 'tipe', 'km', 'id_cabang', 'photos',
    ];

    protected static $imageFields = [
        'photos' => [
            'width' => 480,
            'resize_image_quality' => 75,
            'path' => 'mobil',
        ],
    ];

    public function cabang()
    {
        return $this->hasOne(Cabang::class, 'id', 'id_cabang');
    }
}
