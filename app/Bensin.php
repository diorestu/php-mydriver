<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Mobil;
use QCod\ImageUp\HasImageUploads;

class Bensin extends Model
{
    use HasImageUploads;

    protected $fillable = [
        'id_user', 'id_mobil', 'km', 'harga', 'photos', 'keterangan', 'status', 'tanggal'
    ];

    protected $hidden = [];

    protected static $imageFields = [
        'photos' => [
            'width' => 640,
            'resize_image_quality' => 75,
            'path' => 'bensin',
        ],
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    public function mobil(){
        return $this->hasOne(Mobil::class, 'id', 'id_mobil');
    }
}
