<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use QCod\ImageUp\HasImageUploads;
use App\User;
use App\Mobil;

class Aktivitas extends Model
{
    use HasImageUploads;

    protected $fillable = [
        'id_user', 'id_mobil','km_awal', 'km_akhir', 'deskripsi', 'lat', 'long', 'photo', 'status', 'tanggal', 'customer', 'rating', 'komentar', 'cust_phone'
    ];

    protected static $imageFields = [
        'photo' => [
            'width' => 640,
            'resize_image_quality' => 75,
            'path' => 'aktivitas',
        ],
    ];


    protected $hidden = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }
    public function mobil()
    {
        return $this->belongsTo(Mobil::class, 'id_mobil', 'id');
    }
}
