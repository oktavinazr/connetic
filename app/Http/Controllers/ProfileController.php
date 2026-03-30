<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function showComplete()
    {
        $user = Auth::user();

        if ($user->profile && $user->profile->full_name && $user->profile->nim) {
            return redirect()->route('dashboard');
        }

        return view('profile.complete', [
            'profile' => $user->profile,
        ]);
    }

    public function storeComplete(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'nim' => 'required|string|max:50',
            'school_name' => 'required|string|max:255',
            'avatar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $user = Auth::user();
        $avatarPath = $user->profile?->avatar;

        if ($request->hasFile('avatar')) {
            // Hapus foto lama jika ada dan bukan URL external (Google)
            if ($avatarPath && !str_starts_with($avatarPath, 'http')) {
                Storage::disk('public')->delete($avatarPath);
            }
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
        }

        Profile::updateOrCreate(
            ['user_id' => $user->id],
            [
                'full_name' => $request->full_name,
                'nim' => $request->nim,
                'school_name' => $request->school_name,
                'avatar' => $avatarPath,
            ]
        );

        return redirect()->route('dashboard');
    }

    public function showProfile()
    {
        return view('profile.edit', [
            'profile' => Auth::user()->profile,
        ]);
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'nim' => 'required|string|max:50',
            'school_name' => 'required|string|max:255',
            'avatar' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $user = Auth::user();
        $profile = $user->profile;
        $avatarPath = $profile?->avatar;

        if ($request->hasFile('avatar')) {
            if ($avatarPath && !str_starts_with($avatarPath, 'http')) {
                Storage::disk('public')->delete($avatarPath);
            }
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
        }

        $profile->update([
            'full_name' => $request->full_name,
            'nim' => $request->nim,
            'school_name' => $request->school_name,
            'avatar' => $avatarPath,
        ]);

        return back()->with('success', 'Profil berhasil diperbarui!');
    }
}