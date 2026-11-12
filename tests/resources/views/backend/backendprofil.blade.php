@extends('backend.layout')

@section('title', 'Kelola Profil PKS')
@section('page_title', 'Kelola Profil PKS')
@section('page_subtitle', 'Informasi identitas, visi, misi, dan sejarah Ekstrakurikuler PKS SMKN 2 Purwakarta')

@push('styles')
<style>
    .profile-form-grid {
        display: grid;
        grid-template-columns: 1fr 2.2fr;
        gap: 25px;
    }

    @media (max-width: 900px) {
        .profile-form-grid {
            grid-template-columns: 1fr;
        }
    }

    .box-card {
        background: #ffffff;
        border-radius: 16px;
        padding: 25px;
        border: 1px solid var(--pks-border);
        box-shadow: 0 4px 15px rgba(0,0,0,0.02);
    }

    .logo-preview-box {
        width: 140px;
        height: 140px;
        border-radius: 50%;
        margin: 0 auto 20px auto;
        border: 4px solid var(--pks-gold);
        box-shadow: 0 6px 18px rgba(217, 119, 6, 0.25);
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #f8fafc;
    }

    .logo-preview-box img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .file-input-wrapper {
        position: relative;
        text-align: center;
    }

    .btn-upload-label {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 9px 18px;
        background: #f1f5f9;
        border: 1.5px dashed #cbd5e1;
        border-radius: 8px;
        color: var(--pks-navy);
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        transition: 0.2s;
    }

    .btn-upload-label:hover {
        background: #e2e8f0;
        border-color: var(--pks-navy);
    }

    .file-input-wrapper input[type="file"] {
        display: none;
    }
</style>
@endpush

@section('content')

<form action="{{ route('admin.profil.update') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="profile-form-grid">
        <!-- LOGO & BADGE CARD -->
        <div class="box-card" style="text-align: center;">
            <h3 style="font-size: 16px; font-weight: 700; color: var(--pks-navy); margin-bottom: 20px;">
                <i class="fa-solid fa-shield-halved" style="color: var(--pks-gold);"></i> Lambang Resmi PKS
            </h3>

            <div class="logo-preview-box">
                <img id="previewImg" src="{{ asset($profil->logo ?? 'img/logo pks.jpeg') }}" alt="Logo PKS">
            </div>

            <p style="font-size: 12px; color: var(--pks-gray); line-height: 1.4; margin-bottom: 15px;">
                Format gambar: JPG, JPEG, PNG, WEBP.<br>Maksimal 2 MB.
            </p>

            <div class="file-input-wrapper">
                <label for="logoInput" class="btn-upload-label">
                    <i class="fa-solid fa-cloud-arrow-up"></i> Ganti Logo PKS
                </label>
                <input type="file" id="logoInput" name="logo" accept="image/*" onchange="previewFile(event)">
            </div>
        </div>

        <!-- DETAIL INFORMASI CARD -->
        <div class="box-card">
            <h3 style="font-size: 16px; font-weight: 700; color: var(--pks-navy); margin-bottom: 20px; padding-bottom: 10px; border-bottom: 1px solid var(--pks-border);">
                <i class="fa-solid fa-file-signature" style="color: var(--pks-red);"></i> Informasi Profil & Deskripsi
            </h3>

            <div class="form-group">
                <label for="judul">Judul Organisasi <span class="required">*</span></label>
                <input type="text" id="judul" name="judul" class="form-control" value="{{ old('judul', $profil->judul) }}" required>
            </div>

            <div class="form-group">
                <label for="isi">Deskripsi / Profil Lengkap <span class="required">*</span></label>
                <textarea id="isi" name="isi" class="form-control" rows="5" required>{{ old('isi', $profil->isi) }}</textarea>
            </div>

            <div class="form-group">
                <label for="visi">Visi PKS SMKN 2 Purwakarta</label>
                <textarea id="visi" name="visi" class="form-control" rows="3" placeholder="Masukkan visi organisasi...">{{ old('visi', $profil->visi) }}</textarea>
            </div>

            <div class="form-group">
                <label for="misi">Misi PKS SMKN 2 Purwakarta</label>
                <textarea id="misi" name="misi" class="form-control" rows="4" placeholder="Masukkan misi organisasi...">{{ old('misi', $profil->misi) }}</textarea>
            </div>

            <div class="form-group">
                <label for="sejarah">Sejarah Singkat PKS</label>
                <textarea id="sejarah" name="sejarah" class="form-control" rows="4" placeholder="Masukkan sejarah berdirinya PKS...">{{ old('sejarah', $profil->sejarah) }}</textarea>
            </div>

            <div style="text-align: right; margin-top: 25px;">
                <button type="submit" class="btn-submit">
                    <i class="fa-solid fa-floppy-disk"></i> Simpan Perubahan Profil
                </button>
            </div>
        </div>
    </div>
</form>

@push('scripts')
<script>
    function previewFile(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('previewImg').src = e.target.result;
            }
            reader.readAsDataURL(file);
        }
    }
</script>
@endpush

@endsection
