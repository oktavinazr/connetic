@extends('layouts.dashboard')
@section('title', 'Profil — Connetic')

@section('styles')
<style>
    .profile-grid {
        display: grid;
        grid-template-columns: 280px 1fr;
        gap: 20px;
        align-items: start;
    }

    /* Left: Avatar card */
    .avatar-card {
        padding: 28px;
        display: flex; flex-direction: column;
        align-items: center; text-align: center;
    }
    .avatar-large {
        width: 96px; height: 96px;
        border-radius: 16px;
        background: #e5e7eb;
        display: flex; align-items: center; justify-content: center;
        color: #6b7280; font-weight: 800; font-size: 32px;
        overflow: hidden;
        margin-bottom: 16px;
    }
    .avatar-large img { width: 100%; height: 100%; object-fit: cover; }

    .avatar-name { font-size: 16px; font-weight: 700; margin-bottom: 2px; }
    .avatar-email { font-size: 12px; color: var(--text-muted); margin-bottom: 16px; }

    .btn-upload {
        display: inline-flex; align-items: center; gap: 6px;
        padding: 8px 18px;
        font-size: 12px; font-weight: 600;
        color: var(--text);
        background: #f3f4f6;
        border: 1px solid var(--border);
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.2s;
        font-family: 'Inter', sans-serif;
    }
    .btn-upload:hover { background: #e5e7eb; }
    .upload-hint { font-size: 11px; color: var(--text-muted); margin-top: 8px; }
    .file-input { display: none; }

    /* Right: Form card */
    .form-card { padding: 28px; }
    .form-title { font-size: 16px; font-weight: 700; margin-bottom: 4px; }
    .form-sub { font-size: 13px; color: var(--text-muted); margin-bottom: 24px; }

    .form-group { margin-bottom: 18px; }
    .label {
        display: block;
        font-size: 13px; font-weight: 600;
        color: var(--text-muted);
        margin-bottom: 6px;
    }
    .input-field {
        width: 100%; padding: 10px 14px;
        background: var(--bg);
        border: 1px solid var(--border);
        border-radius: 9px;
        color: var(--text);
        font-size: 14px;
        font-family: 'Inter', sans-serif;
        transition: border-color 0.2s;
        outline: none;
    }
    .input-field:focus { border-color: var(--pink-400); }

    .email-field {
        padding: 10px 14px;
        background: #f3f4f6;
        border: 1px solid var(--border);
        border-radius: 9px;
        font-size: 14px;
        color: var(--text-muted);
    }

    .form-actions {
        display: flex; justify-content: flex-end;
        padding-top: 8px;
    }
    .btn-save {
        padding: 10px 24px;
        background: linear-gradient(135deg, var(--pink-500), var(--pink-600));
        color: #fff; font-weight: 600; font-size: 13px;
        border: none; border-radius: 9px;
        cursor: pointer; transition: all 0.2s;
        font-family: 'Inter', sans-serif;
    }
    .btn-save:hover { transform: translateY(-1px); box-shadow: 0 4px 16px rgba(236,72,153,0.2); }

    .error-text { color: #ef4444; font-size: 12px; margin-top: 4px; }

    @media (max-width: 700px) {
        .profile-grid { grid-template-columns: 1fr; }
    }
</style>
@endsection

@section('content')
<div class="page-title">Profil Saya</div>
<div class="page-sub">Kelola informasi akun kamu.</div>

<form method="POST" action="{{ route('profile') }}" enctype="multipart/form-data">
    @csrf
    <div class="profile-grid">
        {{-- Left: Avatar --}}
        <div class="card avatar-card">
            <div class="avatar-large" id="avatarPreview">
                @if(Auth::user()->getAvatarUrl())
                    <img src="{{ Auth::user()->getAvatarUrl() }}" alt="" id="avatarImg">
                @else
                    <span id="avatarInitial">{{ Auth::user()->getInitial() }}</span>
                @endif
            </div>
            <div class="avatar-name">{{ Auth::user()->profile?->full_name ?? 'User' }}</div>
            <div class="avatar-email">{{ Auth::user()->email }}</div>
            <label class="btn-upload">
                📷 Ganti Foto
                <input type="file" name="avatar" accept="image/*" class="file-input" id="avatarInput">
            </label>
            <div class="upload-hint">JPG, PNG, WebP · Maks. 2MB</div>
            @error('avatar') <p class="error-text">{{ $message }}</p> @enderror
        </div>

        {{-- Right: Form --}}
        <div class="card form-card">
            <div class="form-title">Informasi Pribadi</div>
            <div class="form-sub">Perbarui data profil kamu di sini.</div>

            <div class="form-group">
                <label class="label">Nama Lengkap</label>
                <input type="text" name="full_name" class="input-field"
                    value="{{ old('full_name', $profile?->full_name) }}" required>
                @error('full_name') <p class="error-text">{{ $message }}</p> @enderror
            </div>

            <div class="form-group">
                <label class="label">NIS</label>
                <input type="text" name="nim" class="input-field"
                    value="{{ old('nim', $profile?->nim) }}" required>
                @error('nim') <p class="error-text">{{ $message }}</p> @enderror
            </div>

            <div class="form-group">
                <label class="label">Email</label>
                <div class="email-field">{{ Auth::user()->email }}</div>
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-save">Simpan Perubahan</button>
            </div>
        </div>
    </div>
</form>

<script>
    document.getElementById('avatarInput').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (!file) return;
        if (file.size > 2 * 1024 * 1024) {
            alert('Ukuran file maksimal 2MB');
            e.target.value = '';
            return;
        }
        const reader = new FileReader();
        reader.onload = function(ev) {
            const preview = document.getElementById('avatarPreview');
            const initial = document.getElementById('avatarInitial');
            if (initial) initial.style.display = 'none';
            let img = document.getElementById('avatarImg');
            if (!img) {
                img = document.createElement('img');
                img.id = 'avatarImg';
                img.style.cssText = 'width:100%;height:100%;object-fit:cover;';
                preview.appendChild(img);
            }
            img.src = ev.target.result;
        };
        reader.readAsDataURL(file);
    });
</script>
@endsection