<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{
    protected $table = 'materi';
    protected $fillable = ['aktivitas_id', 'konten_teks', 'video_url'];

    public function aktivitas()
    {
        return $this->belongsTo(Aktivitas::class);
    }

    /**
     * Convert YouTube URL ke embed URL
     */
    public function getEmbedUrlAttribute(): string|null
    {
        if (!$this->video_url) return null;

        // Support youtube.com/watch?v= dan youtu.be/
        preg_match('/(?:youtube\.com\/watch\?v=|youtu\.be\/)([a-zA-Z0-9_-]+)/', $this->video_url, $matches);

        return isset($matches[1]) ? 'https://www.youtube.com/embed/' . $matches[1] : $this->video_url;
    }
}