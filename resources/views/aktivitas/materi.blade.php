@extends('layouts.dashboard')
@section('title', "Materi: {$aktivitas->nama} — Connetic")

@section('styles')
<style>
    .back-link {
        display: inline-flex; align-items: center; gap: 6px;
        font-size: 13px; font-weight: 500;
        color: var(--text-muted); text-decoration: none;
        margin-bottom: 20px; transition: color 0.2s;
    }
    .back-link:hover { color: var(--pink-600); }

    .breadcrumb {
        font-size: 12px; color: var(--text-muted); margin-bottom: 20px;
    }
    .breadcrumb a { color: var(--pink-500); text-decoration: none; }

    .materi-header {
        padding: 24px; margin-bottom: 20px;
    }
    .materi-header .tag {
        display: inline-block;
        font-size: 11px; font-weight: 600;
        padding: 3px 10px; border-radius: 6px;
        color: #fff; margin-bottom: 10px;
    }
    .materi-header h1 { font-size: 20px; font-weight: 700; }
    .materi-header p { font-size: 13px; color: var(--text-muted); margin-top: 4px; }

    .materi-content {
        padding: 28px; margin-bottom: 20px;
    }
    .materi-content h3 { font-size: 16px; font-weight: 700; margin-bottom: 12px; }
    .materi-content p { font-size: 14px; color: var(--text); line-height: 1.8; margin-bottom: 12px; }
    .materi-content strong { color: var(--pink-600); }

    .video-section {
        padding: 24px; margin-bottom: 24px;
    }
    .video-section h3 {
        font-size: 14px; font-weight: 700; margin-bottom: 14px;
        display: flex; align-items: center; gap: 8px;
    }
    .video-wrapper {
        position: relative;
        padding-bottom: 56.25%;
        height: 0; overflow: hidden;
        border-radius: 12px;
        background: #000;
    }
    .video-wrapper iframe {
        position: absolute;
        top: 0; left: 0;
        width: 100%; height: 100%;
        border: none; border-radius: 12px;
    }

    .nav-bottom {
        display: flex; justify-content: space-between; align-items: center;
        margin-top: 8px;
    }
    .btn-next {
        display: inline-flex; align-items: center; gap: 8px;
        padding: 12px 24px;
        background: linear-gradient(135deg, var(--pink-500), var(--pink-600));
        color: #fff; font-weight: 600; font-size: 14px;
        border: none; border-radius: 10px; cursor: pointer;
        text-decoration: none; transition: all 0.2s;
        font-family: 'Inter', sans-serif;
    }
    .btn-next:hover { transform: translateY(-1px); box-shadow: 0 6px 20px rgba(236,72,153,0.25); }

    .btn-back-outline {
        padding: 12px 24px;
        font-size: 14px; font-weight: 600;
        color: var(--text-muted); background: none;
        border: 1px solid var(--border); border-radius: 10px;
        text-decoration: none; transition: all 0.2s;
    }
    .btn-back-outline:hover { border-color: var(--pink-300); color: var(--pink-600); }
</style>
@endsection

@section('content')
<div class="breadcrumb">
    <a href="{{ route('dashboard') }}">Dashboard</a> ›
    <a href="{{ route('pertemuan.show', $aktivitas->pertemuan->id) }}">Pertemuan {{ $aktivitas->pertemuan->nomor }}</a> ›
    {{ $aktivitas->nama }}
</div>

<div class="card materi-header">
    <span class="tag" style="background: {{ $aktivitas->color }}">{{ $aktivitas->emoji }} Aktivitas {{ $aktivitas->nomor }}</span>
    <h1>{{ $aktivitas->nama }}</h1>
    <p>{{ $aktivitas->deskripsi }}</p>
</div>

{{-- Konten Teks --}}
@if($aktivitas->materi && $aktivitas->materi->konten_teks)
    <div class="card materi-content">
        {!! $aktivitas->materi->konten_teks !!}
    </div>
@endif

{{-- Video --}}
@if($aktivitas->materi && $aktivitas->materi->embed_url)
    <div class="card video-section">
        <h3>▶ Video Pembelajaran</h3>
        <div class="video-wrapper">
            <iframe
                src="{{ $aktivitas->materi->embed_url }}"
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                allowfullscreen>
            </iframe>
        </div>
    </div>
@endif

{{-- Navigation --}}
<div class="nav-bottom">
    <a href="{{ route('pertemuan.show', $aktivitas->pertemuan->id) }}" class="btn-back-outline">← Kembali</a>
    <a href="{{ route('aktivitas.lkpd', $aktivitas->id) }}" class="btn-next">Lanjut ke LKPD →</a>
</div>
@endsection