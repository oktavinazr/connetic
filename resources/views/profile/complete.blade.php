@extends('layouts.app')
@section('title', 'Lengkapi Profil — Connetic')

@section('styles')
<style>
    .profile-container {
        position: relative; z-index: 1;
        min-height: 100vh;
        display: flex; align-items: center; justify-content: center;
        padding: 24px;
    }
    .profile-card { width: 100%; max-width: 460px; padding: 40px 32px; }
    .profile-header { text-align: center; margin-bottom: 32px; }
    .profile-header .icon-wrap {
        width: 64px; height: 64px; margin: 0 auto 16px;
        display: flex; align-items: center; justify-content: center;
        background: rgba(244,114,182,0.1);
        border: 1px solid rgba(244,114,182,0.2);
        border-radius: 16px;
        font-size: 28px;
    }
    .profile-header h1 { font-size: 22px; font-weight: 700; }
    .profile-header p { font-size: 14px; color: var(--text-muted); margin-top: 4px; }
    .form-group { margin-bottom: 16px; }

    /* Avatar upload */
    .avatar-upload {
        display: flex; flex-direction: column; align-items: center;
        margin-bottom: 24px;
    }
    .avatar-circle {
        width: 80px; height: 80px;
        border-radius: 50%;
        background: rgba(244,114,182,0.1);
        border: 2px dashed rgba(244,114,182,0.3);
        display: flex; align-items: center; justify-content: center;
        font-size: 32px;
        overflow: hidden;
        cursor: pointer;
        transition: all 0.2s;
    }
    .avatar-circle:hover { border-color: var(--pink-400); background: rgba(244,114,182,0.15); }
    .avatar-circle img { width: 100%; height: 100%; object-fit: cover; }
    .avatar-hint { font-size: 12px; color: var(--text-muted); margin-top: 8px; }
    .file-input { display: none; }

    .btn-primary {
        display: inline-flex; align-items: center; justify-content: center;
        padding: 12px 28px; width: 100%;
        background: linear-gradient(135deg, var(--pink-500), var(--pink-700));
        color: #fff; font-weight: 600; font-size: 14px;
        border: none; border-radius: 10px; cursor: pointer;
        transition: all 0.3s ease;
        margin-top: 8px;
    }
    .btn-primary:hover { transform: translateY(-2px); box-shadow: 0 8px 30px rgba(236,72,153,0.3); }
</style>
@endsection

@section('content')
<div class="profile-container">
    <div class="glass profile-card animate-in">
        <div class="profile-header">
            <div class="icon-wrap">👤</div>
            <h1>Lengkapi Profil Kamu</h1>
            <p>Isi data berikut sebelum mengakses e-modul</p>
        </div>

        <form method="POST" action="{{ route('profile.complete') }}" enctype="multipart/form-data">
            @csrf

            {{-- Avatar --}}
            <div class="avatar-upload">
                <label for="avatarInput">
                    <div class="avatar-circle" id="avatarPreview">
                        @if($profile?->avatar)
                            <img src="{{ str_starts_with($profile->avatar, 'http') ? $profile->avatar : asset('storage/'.$profile->avatar) }}" id="avatarImg" alt="">
                        @else
                            <span id="avatarPlaceholder">📷</span>
                        @endif
                    </div>
                </label>
                <span class="avatar-hint">Klik untuk upload foto (opsional)</span>
                <input type="file" name="avatar" accept="image/*" class="file-input" id="avatarInput">
                @error('avatar') <p class="error-text">{{ $message }}</p> @enderror
            </div>

            <div class="form-group">
                <label class="label">Nama Lengkap</label>
                <input type="text" name="full_name" class="input-field"
                    placeholder="Nama lengkap kamu"
                    value="{{ old('full_name', $profile?->full_name) }}" required>
                @error('full_name') <p class="error-text">{{ $message }}</p> @enderror
            </div>

            <div class="form-group">
                <label class="label">NIM / NIS</label>
                <input type="text" name="nim" class="input-field"
                    placeholder="Nomor induk mahasiswa/siswa"
                    value="{{ old('nim', $profile?->nim) }}" required>
                @error('nim') <p class="error-text">{{ $message }}</p> @enderror
            </div>

            <div class="form-group">
                <label class="label">Asal Sekolah / Kampus</label>
                <input type="text" name="school_name" class="input-field"
                    placeholder="Nama institusi pendidikan"
                    value="{{ old('school_name', $profile?->school_name) }}" required>
                @error('school_name') <p class="error-text">{{ $message }}</p> @enderror
            </div>

            <button type="submit" class="btn-primary">Simpan & Lanjut ke Dashboard →</button>
        </form>
    </div>
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
            const placeholder = document.getElementById('avatarPlaceholder');
            if (placeholder) placeholder.style.display = 'none';
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