@extends('layouts.app')
@section('title', 'Connetic E-Modul')

@section('styles')
<style>
    .hero {
        position: relative; z-index: 1;
        min-height: 100vh;
        display: flex; flex-direction: column;
        align-items: center; justify-content: center;
        text-align: center;
        padding: 120px 24px 80px;
    }
    .hero-badge {
        display: inline-flex; align-items: center; gap: 8px;
        padding: 6px 16px;
        background: rgba(244,114,182,0.1);
        border: 1px solid rgba(244,114,182,0.2);
        border-radius: 999px;
        font-size: 13px; color: var(--pink-400); font-weight: 500;
        margin-bottom: 24px;
    }
    .hero h1 {
        font-size: clamp(36px, 5vw, 60px);
        font-weight: 800;
        line-height: 1.1;
        margin-bottom: 20px;
        background: linear-gradient(135deg, #fff 0%, var(--pink-300) 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }
    .hero p {
        font-size: 17px; color: var(--text-muted);
        max-width: 540px; line-height: 1.7;
        margin-bottom: 36px;
    }
    .hero-buttons { display: flex; gap: 12px; flex-wrap: wrap; justify-content: center; }

    .features {
        position: relative; z-index: 1;
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
        gap: 20px;
        max-width: 900px;
        margin: 0 auto 80px;
        padding: 0 24px;
    }
    .feature-card {
        padding: 28px;
        text-align: left;
    }
    .feature-icon {
        width: 44px; height: 44px;
        display: flex; align-items: center; justify-content: center;
        background: rgba(244,114,182,0.1);
        border-radius: 10px;
        font-size: 20px;
        margin-bottom: 16px;
    }
    .feature-card h3 { font-size: 16px; font-weight: 600; margin-bottom: 8px; }
    .feature-card p { font-size: 14px; color: var(--text-muted); line-height: 1.6; }
</style>
@endsection

@section('content')
<nav class="nav">
    <a href="/" class="nav-logo">✦ Connetic</a>
    <div class="nav-links">
        <a href="{{ route('panduan') }}">Panduan</a>
        <a href="{{ route('login') }}">Masuk</a>
        <a href="{{ route('register') }}" class="btn-primary" style="padding:8px 20px; font-size:13px;">Daftar</a>
    </div>
</nav>

<section class="hero">
    <div class="animate-in">
        <div class="hero-badge">🚀 Platform E-Modul Interaktif</div>
    </div>
    <h1 class="animate-in delay-1">Belajar Lebih Cerdas<br>dengan Connetic</h1>
    <p class="animate-in delay-2">
        Platform e-modul dan LKPD digital untuk mendukung pembelajaran interaktif.
        Akses materi, video, dan lembar kerja kapan saja.
    </p>
    <div class="hero-buttons animate-in delay-3">
        <a href="{{ route('register') }}" class="btn-primary">Mulai Sekarang →</a>
        <a href="{{ route('panduan') }}" class="btn-outline">Lihat Panduan</a>
    </div>
</section>

<div class="features">
    <div class="glass feature-card animate-in delay-1">
        <div class="feature-icon">📖</div>
        <h3>Materi Pembelajaran</h3>
        <p>Akses materi berupa teks dan video yang tersusun rapi per pertemuan.</p>
    </div>
    <div class="glass feature-card animate-in delay-2">
        <div class="feature-icon">📝</div>
        <h3>LKPD Digital</h3>
        <p>Kerjakan lembar kerja peserta didik langsung di platform secara interaktif.</p>
    </div>
    <div class="glass feature-card animate-in delay-3">
        <div class="feature-icon">📊</div>
        <h3>Pantau Progres</h3>
        <p>Lihat perkembangan belajarmu melalui dashboard yang informatif.</p>
    </div>
</div>
@endsection