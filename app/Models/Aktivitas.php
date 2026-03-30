<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aktivitas extends Model
{
    protected $table = 'aktivitas';
    protected $fillable = ['pertemuan_id', 'nomor', 'nama', 'emoji', 'deskripsi', 'color'];

    public function pertemuan()
    {
        return $this->belongsTo(Pertemuan::class);
    }

    public function materi()
    {
        return $this->hasOne(Materi::class);
    }

    public function submissions()
    {
        return $this->hasMany(LkpdSubmission::class);
    }

    public function progress()
    {
        return $this->hasMany(ActivityProgress::class);
    }

    /**
     * Cek apakah aktivitas ini selesai untuk user tertentu
     */
    public function isCompletedBy($userId): bool
    {
        $progress = $this->progress()->where('user_id', $userId)->first();
        return $progress && $progress->materi_completed && $progress->lkpd_completed;
    }

    /**
     * Cek apakah materi sudah dilihat
     */
    public function isMateriCompletedBy($userId): bool
    {
        $progress = $this->progress()->where('user_id', $userId)->first();
        return $progress && $progress->materi_completed;
    }
}