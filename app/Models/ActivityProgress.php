<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityProgress extends Model
{
    protected $table = 'activity_progress';
    protected $fillable = ['user_id', 'aktivitas_id', 'materi_completed', 'lkpd_completed'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function aktivitas()
    {
        return $this->belongsTo(Aktivitas::class);
    }
}