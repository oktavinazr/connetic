<?php

namespace App\Http\Controllers;

use App\Models\Pertemuan;
use App\Models\ActivityProgress;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if (!$user->profile || !$user->profile->full_name || !$user->profile->nim) {
            return redirect()->route('profile.complete');
        }

        $userId = $user->id;
        $semuaPertemuan = Pertemuan::with('aktivitas')->orderBy('nomor')->get();

        $totalAktivitasSemua = 0;
        $totalSelesaiSemua = 0;
        $pertemuanSelesai = 0;

        $pertemuan = [];

        foreach ($semuaPertemuan as $pt) {
            $totalAkt = $pt->aktivitas->count();
            $selesaiAkt = 0;

            foreach ($pt->aktivitas as $akt) {
                $progress = ActivityProgress::where('user_id', $userId)
                    ->where('aktivitas_id', $akt->id)
                    ->first();

                if ($progress && $progress->materi_completed && $progress->lkpd_completed) {
                    $selesaiAkt++;
                }
            }

            $totalAktivitasSemua += $totalAkt;
            $totalSelesaiSemua += $selesaiAkt;

            $ptProgress = $totalAkt > 0 ? round(($selesaiAkt / $totalAkt) * 100) : 0;

            if ($ptProgress === 100) $pertemuanSelesai++;

            $status = 'terkunci';
            if ($ptProgress === 100) $status = 'selesai';
            elseif ($ptProgress > 0) $status = 'berlangsung';

            $pertemuan[] = [
                'id' => $pt->id,
                'nomor' => $pt->nomor,
                'judul' => $pt->judul,
                'deskripsi' => $pt->deskripsi,
                'progress' => $ptProgress,
                'status' => $status,
                'selesai' => $selesaiAkt,
                'total' => $totalAkt,
            ];
        }

        $progressTotal = $totalAktivitasSemua > 0
            ? round(($totalSelesaiSemua / $totalAktivitasSemua) * 100)
            : 0;

        $stats = [
            'pertemuan_selesai' => $pertemuanSelesai . '/' . count($semuaPertemuan),
            'aktivitas_selesai' => $totalSelesaiSemua . '/' . $totalAktivitasSemua,
            'rata_nilai' => '-',
            'progress_total' => $progressTotal,
        ];

        return view('dashboard', compact('pertemuan', 'stats'));
    }
}