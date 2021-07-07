<?php

namespace App;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use QCod\ImageUp\HasImageUploads;

class User extends Authenticatable
{
    use Notifiable;
    use HasImageUploads;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'roles', 'id_cabang', 'id_unit', 'password', 'photos'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    // protected static $imageFields = [
    //     'photos' => [
    //         'width' => 320,
    //         'height' => 320,
    //         'resize_image_quality' => 80,
    //         'path' => 'user',
    //         'crop' => true,

    //     ],
    // ];

    public function cabang(){
        return $this->hasOne(Cabang::class, 'id', 'id_cabang');
    }

    public function unitkerja()
    {
        return $this->hasOne(UnitKerja::class, 'id', 'id_unit');
    }
}
