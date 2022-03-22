<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    protected $table = "pegawai";
    protected $primaryKey = "id";
    protected $fillable = [
        'nama',
        'alamat',
        'tanggal_lahir',
        'jabatan',
        'tanggal_bergabung'
    ];
}
