<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pertemuan extends Model
{
    protected $table = 'pertemuan';
    protected $fillable = ['nomor', 'judul', 'deskripsi'];

    public function aktivitas()
    {
        return $this->hasMany(Aktivitas::class)->orderBy('nomor');
    }
}