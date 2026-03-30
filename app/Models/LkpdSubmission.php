<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LkpdSubmission extends Model
{
    protected $fillable = ['user_id', 'aktivitas_id', 'file_path', 'file_name'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function aktivitas()
    {
        return $this->belongsTo(Aktivitas::class);
    }
}