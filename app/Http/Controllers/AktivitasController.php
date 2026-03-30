<?php

namespace App\Http\Controllers;

use App\Models\Aktivitas;
use App\Models\ActivityProgress;
use App\Models\LkpdSubmission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AktivitasController extends Controller
{
    /**
     * Halaman Materi
     */
    public function materi($id)
    {
        $aktivitas = Aktivitas::with(['materi', 'pertemuan'])->findOrFail($id);

        // Tandai materi sebagai dilihat
        ActivityProgress::updateOrCreate(
            ['user_id' => Auth::id(), 'aktivitas_id' => $aktivitas->id],
            ['materi_completed' => true]
        );

        return view('aktivitas.materi', compact('aktivitas'));
    }

    /**
     * Halaman LKPD
     */
    public function lkpd($id)
    {
        $aktivitas = Aktivitas::with('pertemuan')->findOrFail($id);

        // Cek apakah materi sudah dilihat
        $progress = ActivityProgress::where('user_id', Auth::id())
            ->where('aktivitas_id', $aktivitas->id)
            ->first();

        if (!$progress || !$progress->materi_completed) {
            return redirect()->route('aktivitas.materi', $aktivitas->id)
                ->with('warning', 'Baca materi terlebih dahulu.');
        }

        $submission = LkpdSubmission::where('user_id', Auth::id())
            ->where('aktivitas_id', $aktivitas->id)
            ->first();

        return view('aktivitas.lkpd', compact('aktivitas', 'submission'));
    }

    /**
     * Upload LKPD
     */
    public function uploadLkpd(Request $request, $id)
    {
        $aktivitas = Aktivitas::findOrFail($id);

        $request->validate([
            'file' => 'required|file|mimes:pdf,jpg,jpeg,png,doc,docx|max:10240',
        ]);

        $file = $request->file('file');
        $path = $file->store('lkpd/' . Auth::id(), 'public');

        LkpdSubmission::updateOrCreate(
            ['user_id' => Auth::id(), 'aktivitas_id' => $aktivitas->id],
            ['file_path' => $path, 'file_name' => $file->getClientOriginalName()]
        );

        // Tandai LKPD selesai
        ActivityProgress::updateOrCreate(
            ['user_id' => Auth::id(), 'aktivitas_id' => $aktivitas->id],
            ['lkpd_completed' => true]
        );

        return redirect()->route('pertemuan.show', $aktivitas->pertemuan_id)
            ->with('success', 'LKPD berhasil diupload!');
    }
}