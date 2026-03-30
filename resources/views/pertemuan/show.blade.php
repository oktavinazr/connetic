@extends('layouts.dashboard')
@section('title', "Pertemuan {$pertemuan->nomor} — Connetic")

@section('styles')
<style>
    .back-link {
        display: inline-flex; align-items: center; gap: 6px;
        font-size: 13px; font-weight: 500;
        color: var(--text-muted); text-decoration: none;
        margin-bottom: 20px; transition: color 0.2s;
    }
    .back-link:hover { color: var(--pink-600); }

    .pt-header {
        padding: 24px;
        margin-bottom: 10px;
        display: flex; align-items: center; gap: 18px;
    }
    .pt-num {
        width: 48px; height: 48px; flex-shrink: 0;
        display: flex; align-items: center; justify-content: center;
        background: linear-gradient(135deg, var(--pink-500), var(--pink-600));
        border-radius: 12px;
        color: #fff; font-weight: 800; font-size: 20px;
    }
    .pt-meta h1 { font-size: 18px; font-weight: 700; }
    .pt-meta p { font-size: 13px; color: var(--text-muted); margin-top: 2px; }

    .pt-progress {
        padding: 16px 24px; margin-bottom: 28px;
        display: flex; align-items: center; gap: 14px;
    }
    .pt-progress-label { font-size: 13px; font-weight: 600; white-space: nowrap; }
    .pt-progress-track {
        flex: 1; height: 6px; background: #f3f4f6;
        border-radius: 999px; overflow: hidden;
    }
    .pt-progress-fill {
        height: 100%;
        background: linear-gradient(90deg, var(--pink-400), var(--pink-600));
        border-radius: 999px; transition: width 0.8s ease;
    }
    .pt-progress-pct { font-size: 13px; font-weight: 700; color: var(--pink-600); }

    .section-label {
        font-size: 13px; font-weight: 700; color: var(--text-muted);
        text-transform: uppercase; letter-spacing: 0.5px;
        margin-bottom: 12px;
    }

    .akt-list { display: flex; flex-direction: column; gap: 6px; }

    .akt-card {
        display: flex; align-items: center; gap: 14px;
        padding: 14px 20px;
        transition: all 0.2s;
        text-decoration: none; color: inherit;
    }
    .akt-card:hover { box-shadow: 0 2px 16px rgba(0,0,0,0.05); }

    /* Status circle */
    .akt-status {
        width: 28px; height: 28px; flex-shrink: 0;
        display: flex; align-items: center; justify-content: center;
        border-radius: 50%;
        border: 2px solid #d1d5db;
        font-size: 12px;
        color: transparent;
        transition: all 0.3s;
    }
    .akt-status.done {
        border-color: var(--pink-500);
        background: var(--pink-500);
        color: #fff;
    }

    .akt-icon {
        width: 38px; height: 38px; flex-shrink: 0;
        display: flex; align-items: center; justify-content: center;
        border-radius: 10px; font-size: 17px;
    }

    .akt-body { flex: 1; min-width: 0; }
    .akt-name { font-size: 14px; font-weight: 600; }
    .akt-desc { font-size: 12px; color: var(--text-muted); margin-top: 1px; }

    .akt-arrow { color: #d1d5db; font-size: 16px; flex-shrink: 0; transition: color 0.2s; }
    .akt-card:hover .akt-arrow { color: var(--pink-500); }

    @media (max-width: 640px) {
        .pt-header { flex-direction: column; text-align: center; }
    }
</style>
@endsection

@section('content')
<a href="{{ route('dashboard') }}" class="back-link">← Dashboard</a>

<div class="card pt-header">
    <div class="pt-num">{{ $pertemuan->nomor }}</div>
    <div class="pt-meta">
        <h1>Pertemuan {{ $pertemuan->nomor }}: {{ $pertemuan->judul }}</h1>
        <p>{{ $pertemuan->deskripsi }}</p>
    </div>
</div>

<div class="card pt-progress">
    <span class="pt-progress-label">Progress</span>
    <div class="pt-progress-track">
        <div class="pt-progress-fill" style="width: {{ $progressPct }}%"></div>
    </div>
    <span class="pt-progress-pct">{{ $selesai }}/{{ $totalAktivitas }}</span>
</div>

<div class="section-label">Aktivitas · {{ $totalAktivitas }} tahap</div>

<div class="akt-list">
    @foreach($pertemuan->aktivitas as $akt)
        <a href="{{ route('aktivitas.materi', $akt->id) }}" class="card akt-card">
            <div class="akt-status {{ $akt->is_completed ? 'done' : '' }}">
                @if($akt->is_completed) ✓ @endif
            </div>
            <div class="akt-icon" style="background: {{ $akt->color }}15;">
                {{ $akt->emoji }}
            </div>
            <div class="akt-body">
                <div class="akt-name">{{ $akt->nama }}</div>
                <div class="akt-desc">{{ $akt->deskripsi }}</div>
            </div>
            <div class="akt-arrow">›</div>
        </a>
    @endforeach
</div>
@endsection