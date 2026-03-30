@extends('layouts.app')
@section('title', 'Panduan — Connetic')

@section('styles')
<style>
    .panduan-page {
        position: relative; z-index: 1;
        max-width: 720px;
        margin: 0 auto;
        padding: 100px 24px 80px;
    }
    .panduan-page h1 {
        font-size: 32px; font-weight: 800; margin-bottom: 8px;
        background: linear-gradient(135deg, #fff, var(--pink-300));
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }
    .panduan-page > p { color: var(--text-muted); font-size: 15px; margin-bottom: 40px; }

    .step {
        display: flex; gap: 20px;
        margin-bottom: 32px;
    }
    .step-number {
        flex-shrink: 0;
        width: 40px; height: 40px;
        display: flex; align-items: center; justify-content: center;
        background: linear-gradient(135deg, var(--pink-500), var(--pink-700));
        border-radius: 10px;
        font-weight: 700; font-size: 16px;
    }
    .step-content h3 { font-size: 16px; font-weight: 600; margin-bottom: 6px; }
    .step-content p { font-size: 14px; color: var(--text-muted); line-height: 1.7; }

    .back-link {
        display: inline-flex; align-items: center; gap: 6px;
        color: var(--pink-400); text-decoration: none; font-size: 14px; font-weight: 500;
        margin-top: 20px;
    }
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

<div class="panduan-page">
    <h1 class="animate-in">Panduan Penggunaan</h1>
    <p class="animate-in delay-1">Ikuti langkah-langkah berikut untuk mulai menggunakan Connetic E-Modul.</p>

    <div class="step animate-in delay-1">
        <div class="step-number">1</div>
        <div class="step-content">
            <h3>Buat Akun</h3>
            <p>Daftar menggunakan email atau akun Google kamu. Isi data diri seperti nama, NIM, dan asal sekolah/kampus.</p>
        </div>
    </div>

    <div class="step animate-in delay-2">
        <div class="step-number">2</div>
        <div class="step-content">
            <h3>Akses Dashboard</h3>
            <p>Setelah login, kamu akan masuk ke dashboard utama. Di sini kamu bisa melihat daftar pertemuan yang tersedia.</p>
        </div>
    </div>

    <div class="step animate-in delay-3">
        <div class="step-number">3</div>
        <div class="step-content">
            <h3>Pilih Pertemuan</h3>
            <p>Klik salah satu pertemuan untuk melihat materi pembelajaran berupa teks atau video.</p>
        </div>
    </div>

    <div class="step animate-in">
        <div class="step-number">4</div>
        <div class="step-content">
            <h3>Kerjakan LKPD</h3>
            <p>Di setiap pertemuan terdapat LKPD (Lembar Kerja Peserta Didik) yang bisa dikerjakan langsung di platform.</p>
        </div>
    </div>

    <div class="step animate-in">
        <div class="step-number">5</div>
        <div class="step-content">
            <h3>Pantau Progres</h3>
            <p>Lihat perkembangan belajarmu di dashboard. Pastikan semua pertemuan dan LKPD sudah diselesaikan.</p>
        </div>
    </div>

    <a href="/" class="back-link">← Kembali ke Beranda</a>
</div>
@endsection