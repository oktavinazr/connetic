@extends('layouts.dashboard')
@section('title', 'Profil — Connetic')

@section('styles')
<style>
    .profile-page { max-width: 560px; }

    .avatar-section {
        display: flex; align-items: center; gap: 20px;
        margin-bottom: 28px;
    }
    .avatar-preview {
        width: 80px; height: 80px;
        border-radius: 16px;
        background: linear-gradient(135deg, var(--pink-400), var(--pink-600));
        display: flex; align-items: center; justify-content: center;
        color: #fff; font-weight: 800; font-size: 28px;
        overflow: hidden; flex-shrink: 0;
        border: 3px solid var(--pink-100);
    }
    .avatar-preview img { width: 100%; height: 100%; object-fit: cover; }

    .avatar-info h3 { font-size: 14px; font-weight: 600; margin-bottom: 4px; }
    .avatar-info p { font-size: 12px; color: var(--text-muted); margin-bottom: 10px; }

    .btn-upload {
        display: inline-block;
        padding: 6px 14px;
        font-size: 12px; font-weight: 600;
        color: var(--pink-600);
        background: var(--pink-50);
        border: 1px solid var(--pink-200);
        border-radius: 8px;
        cursor: pointer;
        transition: all 0.2s;
    }
    .btn-upload:hover { background: var(--pink-100); }
    .file-input { display: none; }

    .form-card { padding: 28px; }
    .form-group { margin-bottom: 18px; }

    .label {
        display: block;
        font-size: 13px; font-weight: 600;
        color: var(--text-muted);
        margin-bottom: 6px;
    }
    .input-field {
        width: 100%; padding: 11px 14px;
        background: var(--bg);
        border: 1px solid var(--border);
        border-radius: 10px;
        color: var(--text);
        font-size: 14px;
        font-family: 'Inter', sans-serif;
        transition: border-color 0.2s;
        outline: none;
    }
    .input-field:focus { border-color: var(--pink-400); }

    .email-field {
        padding: 11px 14px;
        background: #f3f4f6;
        border: 1px solid var(--border);
        border-radius: 10px;
        font-size: 14px;
        color: var(--text-muted);
    }

    .btn-save {
        display: inline-flex; align-items: center; justify-content: center;
        padding: 11px 28px;
        background: linear-gradient(135deg, var(--pink-500), var(--pink-700));
        color: #fff; font-weight: 600; font-size: 14px;
        border: none; border-radius: 10px;
        cursor: pointer; transition: all 0.3s;
        font-family: 'Inter', sans-serif;
    }
    .btn-save:hover { transform: translateY(-1px); box-shadow: 0 6px 24px rgba(236,72,153,0.25); }

    .error-text { color: #ef4444; font-size: 12px; margin-top: 4px; }
</style>
@endsection

@section('content')
<div class="page-title">Profil Saya</div>
<div class="page-sub">Kelola informasi akun dan foto profil.</div>

<div class="profile-page">
    <form method="POST" action="{{ route('profile') }}" enctype="multipart/form-data">
        @csrf

        <div class="card form-card">
            {{-- Avatar Upload --}}
            <div class="avatar-section">
                <div class="avatar-preview" id="avatarPreview">
                    @if(Auth::user()->getAvatarUrl())
                        <img src="{{ Auth::user()->getAvatarUrl() }}" alt="" id="avatarImg">
                    @else
                        <span id="avatarInitial">{{ Auth::user()->getInitial() }}</span>
                    @endif
                </div>
                <div class="avatar-info">
                    <h3>Foto Profil</h3>
                    <p>JPG, PNG atau WebP. Maksimal 2MB.</p>
                    <label class="btn-upload">
                        Ganti Foto
                        <input type="file" name="avatar" accept="image/*" class="file-input" id="avatarInput">
                    </label>
                </div>
            </div>

            {{-- Form Fields --}}
            <div class="form-group">
                <label class="label">Nama Lengkap</label>
                <input type="text" name="full_name" class="input-field"
                    value="{{ old('full_name', $profile?->full_name) }}" required>
                @error('full_name') <p class="error-text">{{ $message }}</p> @enderror
            </div>

            <div class="form-group">
                <label class="label">NIM / NIS</label>
                <input type="text" name="nim" class="input-field"
                    value="{{ old('nim', $profile?->nim) }}" required>
                @error('nim') <p class="error-text">{{ $message }}</p> @enderror
            </div>

            <div class="form-group">
                <label class="label">Asal Sekolah / Kampus</label>
                <input type="text" name="school_name" class="input-field"
                    value="{{ old('school_name', $profile?->school_name) }}" required>
                @error('school_name') <p class="error-text">{{ $message }}</p> @enderror
            </div>

            <div class="form-group">
                <label class="label">Email</label>
                <div class="email-field">{{ Auth::user()->email }}</div>
            </div>

            <button type="submit" class="btn-save">Simpan Perubahan</button>
        </div>
    </form>
</div>

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
            let img = document.getElementById('avatarImg');

            if (initial) initial.style.display = 'none';

            if (!img) {
                img = document.createElement('img');
                img.id = 'avatarImg';
                img.style.cssText = 'width:100%;height:100%;object-fit:cover;';
                preview.appendChild(img);
            }
            img.src = ev.target.result;
        };
        reader.readAsDataURL(file);
    };
</script>
@endsection