@extends('layouts.dashboard')
@section('title', 'Pembelajaran — Connetic')

@section('styles')
<style>
    .learn-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 16px;
        margin-bottom: 40px;
    }
    .learn-card {
        padding: 28px 24px;
        text-align: center;
        transition: all 0.25s;
        cursor: default;
    }
    .learn-card:hover { box-shadow: 0 6px 28px rgba(0,0,0,0.06); transform: translateY(-2px); }

    .learn-icon {
        width: 52px; height: 52px;
        margin: 0 auto 16px;
        display: flex; align-items: center; justify-content: center;
        background: var(--pink-50);
        border-radius: 14px;
        font-size: 24px;
    }
    .learn-card h3 { font-size: 15px; font-weight: 700; margin-bottom: 8px; }
    .learn-card p { font-size: 13px; color: var(--text-muted); line-height: 1.6; }

    .section-label { font-size: 15px; font-weight: 700; margin-bottom: 6px; }
    .section-sub { font-size: 13px; color: var(--text-muted); margin-bottom: 20px; }

    /* Content blocks */
    .content-block { padding: 24px; margin-bottom: 16px; }
    .content-block h3 {
        font-size: 14px; font-weight: 700;
        color: var(--pink-600);
        margin-bottom: 10px;
        display: flex; align-items: center; gap: 8px;
    }
    .content-block p, .content-block li {
        font-size: 13px; color: var(--text-muted);
        line-height: 1.8;
    }
    .content-block ul {
        list-style: none; padding: 0;
    }
    .content-block ul li::before {
        content: '→';
        color: var(--pink-400);
        margin-right: 8px;
        font-weight: 600;
    }

    @media (max-width: 700px) {
        .learn-grid { grid-template-columns: 1fr; }
    }
</style>
@endsection

@section('content')
<div class="page-title">Pembelajaran</div>
<div class="page-sub">Informasi umum sebelum memulai pertemuan.</div>

<div class="learn-grid">
    <div class="card learn-card">
        <div class="learn-icon">🎯</div>
        <h3>Capaian Pembelajaran</h3>
        <p>Kompetensi yang akan dicapai setelah menyelesaikan seluruh modul</p>
    </div>
    <div class="card learn-card">
        <div class="learn-icon">🗺️</div>
        <h3>Alur Tujuan Pembelajaran</h3>
        <p>Tahapan pembelajaran yang akan dilalui dari awal hingga akhir</p>
    </div>
    <div class="card learn-card">
        <div class="learn-icon">📋</div>
        <h3>Kompetensi Awal</h3>
        <p>Pengetahuan dasar yang diperlukan sebelum memulai</p>
    </div>
</div>

{{-- Capaian Pembelajaran --}}
<div class="card content-block">
    <h3>🎯 Capaian Pembelajaran</h3>
    <p>
        Peserta didik mampu memahami konsep dasar jaringan komputer, meliputi model TCP/IP,
        pengalamatan IP, serta mampu mengonfigurasi dan menganalisis jaringan sederhana
        menggunakan protokol IPv4. Peserta didik juga diharapkan dapat menerapkan konsep
        subnetting dan memahami komunikasi data antar perangkat dalam jaringan.
    </p>
</div>

{{-- Alur Tujuan Pembelajaran --}}
<div class="card content-block">
    <h3>🗺️ Alur Tujuan Pembelajaran</h3>
    <ul>
        <li>Pertemuan 1 — Memahami konsep dasar TCP/IP dan fungsi setiap layer</li>
        <li>Pertemuan 2 — Mempelajari pengalamatan IP, subnet mask, dan kelas IP Address</li>
        <li>Pertemuan 3 — Memahami struktur, karakteristik, dan mekanisme IPv4</li>
    </ul>
</div>

{{-- Kompetensi Awal --}}
<div class="card content-block">
    <h3>📋 Kompetensi Awal</h3>
    <ul>
        <li>Memahami dasar-dasar perangkat keras komputer dan fungsi sistem operasi</li>
        <li>Mengenal konsep komunikasi data dan media transmisi</li>
        <li>Mampu mengoperasikan komputer dan mengakses internet</li>
        <li>Memahami konsep bilangan biner dan konversi bilangan</li>
    </ul>
</div>
@endsection