<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use QCod\ImageUp\HasImageUploads;

class Lembur extends Model
{
    use HasImageUploads;

    protected $fillable = [
        'id_user', 'hadir', 'pulang', 'lamakerja', 'jam', 'harga', 'status', 'keterangan'
    ];



    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }
}
