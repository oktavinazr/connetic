@extends('layouts.dashboard')
@section('title', "LKPD: {$aktivitas->nama} — Connetic")

@section('styles')
<style>
    .breadcrumb {
        font-size: 12px; color: var(--text-muted); margin-bottom: 20px;
    }
    .breadcrumb a { color: var(--pink-500); text-decoration: none; }

    .lkpd-header { padding: 24px; margin-bottom: 20px; }
    .lkpd-header .tag {
        display: inline-block;
        font-size: 11px; font-weight: 600;
        padding: 3px 10px; border-radius: 6px;
        background: var(--pink-50); color: var(--pink-600);
        margin-bottom: 10px;
    }
    .lkpd-header h1 { font-size: 20px; font-weight: 700; }
    .lkpd-header p { font-size: 13px; color: var(--text-muted); margin-top: 4px; }

    /* Upload area */
    .upload-card { padding: 28px; margin-bottom: 20px; }
    .upload-card h3 { font-size: 15px; font-weight: 700; margin-bottom: 16px; }

    .upload-zone {
        border: 2px dashed var(--border);
        border-radius: 14px;
        padding: 40px 24px;
        text-align: center;
        transition: all 0.2s;
        cursor: pointer;
        position: relative;
    }
    .upload-zone:hover, .upload-zone.dragover {
        border-color: var(--pink-400);
        background: var(--pink-50);
    }
    .upload-zone .icon { font-size: 36px; margin-bottom: 12px; }
    .upload-zone .label { font-size: 14px; font-weight: 600; margin-bottom: 4px; }
    .upload-zone .hint { font-size: 12px; color: var(--text-muted); }
    .upload-zone input[type=file] {
        position: absolute; inset: 0; opacity: 0; cursor: pointer;
    }

    .file-preview {
        display: flex; align-items: center; gap: 12px;
        padding: 12px 16px;
        background: #f8f9fc;
        border-radius: 10px;
        margin-top: 16px;
    }
    .file-preview .file-icon { font-size: 24px; }
    .file-preview .file-info { flex: 1; }
    .file-preview .file-name { font-size: 13px; font-weight: 600; }
    .file-preview .file-size { font-size: 11px; color: var(--text-muted); }
    .file-preview .remove-file {
        font-size: 12px; color: #ef4444; cursor: pointer;
        background: none; border: none; font-weight: 600;
    }

    .btn-submit {
        display: inline-flex; align-items: center; gap: 8px;
        padding: 12px 28px; margin-top: 16px;
        background: linear-gradient(135deg, var(--pink-500), var(--pink-600));
        color: #fff; font-weight: 600; font-size: 14px;
        border: none; border-radius: 10px; cursor: pointer;
        font-family: 'Inter', sans-serif;
        transition: all 0.2s;
    }
    .btn-submit:hover { transform: translateY(-1px); box-shadow: 0 6px 20px rgba(236,72,153,0.25); }
    .btn-submit:disabled { opacity: 0.5; cursor: not-allowed; transform: none; box-shadow: none; }

    /* Already submitted */
    .submitted-card {
        padding: 28px; margin-bottom: 20px; text-align: center;
    }
    .submitted-card .check {
        width: 56px; height: 56px; margin: 0 auto 16px;
        display: flex; align-items: center; justify-content: center;
        background: #ecfdf5; border-radius: 50%;
        font-size: 24px;
    }
    .submitted-card h3 { font-size: 16px; font-weight: 700; color: #059669; margin-bottom: 4px; }
    .submitted-card p { font-size: 13px; color: var(--text-muted); }
    .submitted-card .file-info-box {
        display: inline-flex; align-items: center; gap: 8px;
        padding: 10px 18px; margin-top: 14px;
        background: #f8f9fc; border-radius: 10px;
        font-size: 13px; font-weight: 500;
    }

    .nav-bottom {
        display: flex; justify-content: space-between; align-items: center;
        margin-top: 8px;
    }
    .btn-back-outline {
        padding: 12px 24px;
        font-size: 14px; font-weight: 600;
        color: var(--text-muted); background: none;
        border: 1px solid var(--border); border-radius: 10px;
        text-decoration: none; transition: all 0.2s;
    }
    .btn-back-outline:hover { border-color: var(--pink-300); color: var(--pink-600); }

    .btn-done {
        display: inline-flex; align-items: center; gap: 8px;
        padding: 12px 24px;
        background: #059669; color: #fff;
        font-weight: 600; font-size: 14px;
        border: none; border-radius: 10px;
        text-decoration: none; transition: all 0.2s;
    }
    .btn-done:hover { background: #047857; }

    .error-text { color: #ef4444; font-size: 13px; margin-top: 8px; }
</style>
@endsection

@section('content')
<div class="breadcrumb">
    <a href="{{ route('dashboard') }}">Dashboard</a> ›
    <a href="{{ route('pertemuan.show', $aktivitas->pertemuan->id) }}">Pertemuan {{ $aktivitas->pertemuan->nomor }}</a> ›
    {{ $aktivitas->nama }} › LKPD
</div>

<div class="card lkpd-header">
    <span class="tag">📝 LKPD</span>
    <h1>{{ $aktivitas->nama }}</h1>
    <p>Upload lembar kerja untuk menyelesaikan aktivitas ini.</p>
</div>

@if($submission)
    {{-- Sudah upload --}}
    <div class="card submitted-card">
        <div class="check">✓</div>
        <h3>LKPD Sudah Diupload</h3>
        <p>Kamu telah menyelesaikan aktivitas ini.</p>
        <div class="file-info-box">
            📎 {{ $submission->file_name }}
        </div>
    </div>

    {{-- Upload ulang --}}
    <div class="card upload-card">
        <h3>Upload Ulang</h3>
        <form method="POST" action="{{ route('aktivitas.lkpd.upload', $aktivitas->id) }}" enctype="multipart/form-data">
            @csrf
            <div class="upload-zone" id="uploadZone">
                <input type="file" name="file" accept=".pdf,.jpg,.jpeg,.png,.doc,.docx" id="fileInput">
                <div class="icon">📄</div>
                <div class="label">Pilih file baru</div>
                <div class="hint">PDF, JPG, PNG, DOCX · Maks. 10MB</div>
            </div>
            @error('file') <p class="error-text">{{ $message }}</p> @enderror
            <div id="filePreview"></div>
            <button type="submit" class="btn-submit" id="submitBtn" disabled>Upload Ulang</button>
        </form>
    </div>

    <div class="nav-bottom">
        <a href="{{ route('aktivitas.materi', $aktivitas->id) }}" class="btn-back-outline">← Materi</a>
        <a href="{{ route('pertemuan.show', $aktivitas->pertemuan->id) }}" class="btn-done">Selesai ✓</a>
    </div>
@else
    {{-- Belum upload --}}
    <div class="card upload-card">
        <h3>Upload LKPD</h3>
        <form method="POST" action="{{ route('aktivitas.lkpd.upload', $aktivitas->id) }}" enctype="multipart/form-data">
            @csrf
            <div class="upload-zone" id="uploadZone">
                <input type="file" name="file" accept=".pdf,.jpg,.jpeg,.png,.doc,.docx" id="fileInput">
                <div class="icon">📁</div>
                <div class="label">Klik atau seret file ke sini</div>
                <div class="hint">PDF, JPG, PNG, DOCX · Maks. 10MB</div>
            </div>
            @error('file') <p class="error-text">{{ $message }}</p> @enderror
            <div id="filePreview"></div>
            <button type="submit" class="btn-submit" id="submitBtn" disabled>Upload & Selesaikan →</button>
        </form>
    </div>

    <div class="nav-bottom">
        <a href="{{ route('aktivitas.materi', $aktivitas->id) }}" class="btn-back-outline">← Materi</a>
    </div>
@endif

<script>
    const fileInput = document.getElementById('fileInput');
    const uploadZone = document.getElementById('uploadZone');
    const previewEl = document.getElementById('filePreview');
    const submitBtn = document.getElementById('submitBtn');

    fileInput.addEventListener('change', handleFile);

    // Drag & drop
    uploadZone.addEventListener('dragover', (e) => { e.preventDefault(); uploadZone.classList.add('dragover'); });
    uploadZone.addEventListener('dragleave', () => uploadZone.classList.remove('dragover'));
    uploadZone.addEventListener('drop', (e) => {
        e.preventDefault();
        uploadZone.classList.remove('dragover');
        fileInput.files = e.dataTransfer.files;
        handleFile();
    });

    function handleFile() {
        const file = fileInput.files[0];
        if (!file) return;

        if (file.size > 10 * 1024 * 1024) {
            alert('Ukuran file maksimal 10MB');
            fileInput.value = '';
            return;
        }

        const size = file.size < 1024 * 1024
            ? (file.size / 1024).toFixed(0) + ' KB'
            : (file.size / (1024 * 1024)).toFixed(1) + ' MB';

        previewEl.innerHTML = `
            <div class="file-preview">
                <span class="file-icon">📎</span>
                <div class="file-info">
                    <div class="file-name">${file.name}</div>
                    <div class="file-size">${size}</div>
                </div>
                <button type="button" class="remove-file" onclick="removeFile()">Hapus</button>
            </div>
        `;
        submitBtn.disabled = false;
    }

    function removeFile() {
        fileInput.value = '';
        previewEl.innerHTML = '';
        submitBtn.disabled = true;
    }
</script>
@endsection