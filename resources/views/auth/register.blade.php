@extends('layouts.app')
@section('title', 'Daftar — Connetic')

@section('styles')
<style>
    .auth-container {
        position: relative; z-index: 1;
        min-height: 100vh;
        display: flex; align-items: center; justify-content: center;
        padding: 24px;
    }
    .auth-card { width: 100%; max-width: 460px; padding: 40px 32px; }
    .auth-header { text-align: center; margin-bottom: 32px; }
    .auth-header a { text-decoration: none; }
    .auth-header h1 { font-size: 22px; font-weight: 700; margin-top: 12px; }
    .auth-header p { font-size: 14px; color: var(--text-muted); margin-top: 4px; }
    .form-group { margin-bottom: 16px; }
    .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; }
    .auth-link { text-align: center; font-size: 14px; color: var(--text-muted); margin-top: 24px; }
    .auth-link a { color: var(--pink-400); text-decoration: none; font-weight: 600; }
</style>
@endsection

@section('content')
<div class="auth-container">
    <div class="glass auth-card animate-in">
        <div class="auth-header">
            <a href="/" style="font-size:24px; font-weight:800; color:var(--pink-400);">✦ Connetic</a>
            <h1>Buat Akun Baru</h1>
            <p>Daftar untuk mulai mengakses e-modul</p>
        </div>

        <a href="{{ route('google.redirect') }}" class="btn-google">
            <svg width="18" height="18" viewBox="0 0 48 48"><path fill="#EA4335" d="M24 9.5c3.54 0 6.71 1.22 9.21 3.6l6.85-6.85C35.9 2.38 30.47 0 24 0 14.62 0 6.51 5.38 2.56 13.22l7.98 6.19C12.43 13.72 17.74 9.5 24 9.5z"/><path fill="#4285F4" d="M46.98 24.55c0-1.57-.15-3.09-.38-4.55H24v9.02h12.94c-.58 2.96-2.26 5.48-4.78 7.18l7.73 6c4.51-4.18 7.09-10.36 7.09-17.65z"/><path fill="#FBBC05" d="M10.53 28.59c-.48-1.45-.76-2.99-.76-4.59s.27-3.14.76-4.59l-7.98-6.19C.92 16.46 0 20.12 0 24c0 3.88.92 7.54 2.56 10.78l7.97-6.19z"/><path fill="#34A853" d="M24 48c6.48 0 11.93-2.13 15.89-5.81l-7.73-6c-2.15 1.45-4.92 2.3-8.16 2.3-6.26 0-11.57-4.22-13.47-9.91l-7.98 6.19C6.51 42.62 14.62 48 24 48z"/></svg>
            Daftar dengan Google
        </a>

        <div class="divider">atau isi manual</div>

        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="form-group">
                <label class="label">Nama Lengkap</label>
                <input type="text" name="full_name" class="input-field" placeholder="Nama lengkap" value="{{ old('full_name') }}" required>
                @error('full_name') <p class="error-text">{{ $message }}</p> @enderror
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="label">NIM / NIS</label>
                    <input type="text" name="nim" class="input-field" placeholder="Nomor induk" value="{{ old('nim') }}" required>
                    @error('nim') <p class="error-text">{{ $message }}</p> @enderror
                </div>
                <div class="form-group">
                    <label class="label">Asal Sekolah / Kampus</label>
                    <input type="text" name="school_name" class="input-field" placeholder="Nama institusi" value="{{ old('school_name') }}" required>
                    @error('school_name') <p class="error-text">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="form-group">
                <label class="label">Email</label>
                <input type="email" name="email" class="input-field" placeholder="nama@email.com" value="{{ old('email') }}" required>
                @error('email') <p class="error-text">{{ $message }}</p> @enderror
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="label">Password</label>
                    <input type="password" name="password" class="input-field" placeholder="Min. 8 karakter" required>
                    @error('password') <p class="error-text">{{ $message }}</p> @enderror
                </div>
                <div class="form-group">
                    <label class="label">Konfirmasi Password</label>
                    <input type="password" name="password_confirmation" class="input-field" placeholder="Ulangi password" required>
                </div>
            </div>

            <button type="submit" class="btn-primary" style="width:100%; margin-top:8px;">Daftar Sekarang</button>
        </form>

        <p class="auth-link">
            Sudah punya akun? <a href="{{ route('login') }}">Masuk di sini</a>
        </p>
    </div>
</div>
@endsection