<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use QCod\ImageUp\HasImageUploads;

class CheckList extends Model
{
    use HasImageUploads;

    protected $fillable = [
        'id_user', 'id_mobil', 'masker', 'tisu', 'box', 'parfum', 'sanitizer', 'washed', 'keterangan', 'photos',
    ];

    protected $hidden = [];

    protected static $imageFields = [
        'photos' => [
            'width' => 480,
            'resize_image_quality' => 75,
            'path' => 'checklist',
        ],
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    public function mobil()
    {
        return $this->belongsTo(Mobil::class, 'id_mobil', 'id');
    }
}
