<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Mobil;
use QCod\ImageUp\HasImageUploads;

class Absensi extends Model
{
    use HasImageUploads;

    protected $fillable = [
        'id_user', 'deskripsi', 'hadir', 'img_hadir', 'pulang', 'img_pulang', 'lat_hadir', 'long_hadir', 'lat_pulang', 'long_pulang',
    ];

    protected $hidden = [];

    protected static $imageFields = [
        'img_hadir' => [
            'width' => 480,
            'resize_image_quality' => 75,
            'path' => 'absensi',
        ],
        'img_pulang' => [
            'width' => 480,
            'resize_image_quality' => 75,
            'path' => 'absensi',
        ],
    ];

    public function user(){
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    public function mobil(){
        return $this->belongsTo(Mobil::class, 'id_mobil', 'id');
    }
}
