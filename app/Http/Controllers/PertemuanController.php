<?php

namespace App\Http\Controllers;

use App\Models\Pertemuan;
use App\Models\ActivityProgress;
use Illuminate\Support\Facades\Auth;

class PertemuanController extends Controller
{
    public function show($id)
    {
        $pertemuan = Pertemuan::with('aktivitas')->findOrFail($id);
        $userId = Auth::id();

        // Hitung progress
        $totalAktivitas = $pertemuan->aktivitas->count();
        $selesai = 0;

        foreach ($pertemuan->aktivitas as $akt) {
            $progress = ActivityProgress::where('user_id', $userId)
                ->where('aktivitas_id', $akt->id)
                ->first();

            $akt->is_completed = $progress && $progress->materi_completed && $progress->lkpd_completed;

            if ($akt->is_completed) $selesai++;
        }

        $progressPct = $totalAktivitas > 0 ? round(($selesai / $totalAktivitas) * 100) : 0;

        return view('pertemuan.show', compact('pertemuan', 'progressPct', 'selesai', 'totalAktivitas'));
    }
}