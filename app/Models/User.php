<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'email',
        'password',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    /**
     * Ambil URL avatar (support Google URL & local upload)
     */
    public function getAvatarUrl(): string|null
    {
        $avatar = $this->profile?->avatar;

        if (!$avatar) {
            return null;
        }

        // Jika sudah URL lengkap (dari Google OAuth)
        if (str_starts_with($avatar, 'http')) {
            return $avatar;
        }

        // Local file
        return asset('storage/' . $avatar);
    }

    /**
     * Inisial untuk fallback avatar
     */
    public function getInitial(): string
    {
        $name = $this->profile?->full_name ?? $this->email;
        return strtoupper(substr($name, 0, 1));
    }
}