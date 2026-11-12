@extends('backend.layout')

@section('title', 'Profil Admin')
@section('page_title', 'Profil Akun Admin')
@section('page_subtitle', 'Pengaturan akun, nama, username, dan keamanan kata sandi administrator')

@push('styles')
<style>
    .profile-admin-grid {
        display: grid;
        grid-template-columns: 1fr 2fr;
        gap: 25px;
    }

    @media (max-width: 900px) {
        .profile-admin-grid {
            grid-template-columns: 1fr;
        }
    }

    .profile-card {
        background: #ffffff;
        border-radius: 16px;
        padding: 30px 24px;
        border: 1px solid var(--pks-border);
        box-shadow: 0 4px 15px rgba(0,0,0,0.02);
        text-align: center;
    }

    .profile-avatar-big {
        width: 100px;
        height: 100px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--pks-navy) 0%, #152d4e 100%);
        color: #ffffff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 42px;
        margin: 0 auto 16px auto;
        border: 4px solid var(--pks-gold);
        box-shadow: 0 6px 18px rgba(217, 119, 6, 0.3);
    }

    .profile-card h3 {
        font-size: 18px;
        font-weight: 700;
        color: var(--pks-navy);
        margin: 0 0 4px 0;
    }

    .profile-card p {
        font-size: 13px;
        color: var(--pks-gray);
        margin: 0 0 16px 0;
    }

    .role-badge-pill {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        background: #fef2f2;
        color: var(--pks-red);
        border: 1px solid #fecaca;
        padding: 5px 14px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 700;
    }

    .info-list {
        margin-top: 25px;
        text-align: left;
        border-top: 1px solid #f1f5f9;
        padding-top: 20px;
    }

    .info-item {
        display: flex;
        justify-content: space-between;
        padding: 10px 0;
        border-bottom: 1px solid #f8fafc;
        font-size: 13px;
    }
    .info-item span:first-child { color: var(--pks-gray); }
    .info-item span:last-child { font-weight: 600; color: var(--pks-dark); }
</style>
@endpush

@section('content')

<div class="profile-admin-grid">
    <!-- LEFT: AVATAR & INFO -->
    <div class="profile-card">
        <div class="profile-avatar-big">
            <i class="fa-solid fa-user-shield"></i>
        </div>

        <h3>{{ $user->nama }}</h3>
        <p>&#64;{{ $user->username }}</p>

        <span class="role-badge-pill">
            <i class="fa-solid fa-award"></i> {{ $user->role ?? 'Administrator' }}
        </span>

        <div class="info-list">
            <div class="info-item">
                <span>Ekstrakurikuler</span>
                <span>PKS SMKN 2 Purwakarta</span>
            </div>
            <div class="info-item">
                <span>Email</span>
                <span>{{ $user->email ?? 'Belum diisi' }}</span>
            </div>
            <div class="info-item">
                <span>Status Akun</span>
                <span style="color: #059669;"><i class="fa-solid fa-circle-check"></i> Aktif</span>
            </div>
        </div>
    </div>

    <!-- RIGHT: EDIT FORM -->
    <div class="card-box" style="background: #ffffff; border-radius: 16px; padding: 28px; border: 1px solid var(--pks-border);">
        <h3 style="font-size: 16px; font-weight: 700; color: var(--pks-navy); margin-bottom: 20px; padding-bottom: 12px; border-bottom: 1px solid var(--pks-border);">
            <i class="fa-solid fa-user-gear" style="color: var(--pks-navy-light);"></i> Perbarui Informasi & Password
        </h3>

        <form action="{{ route('admin.admin-profile.update') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="nama">Nama Lengkap <span class="required">*</span></label>
                <input type="text" id="nama" name="nama" class="form-control" value="{{ old('nama', $user->nama) }}" required>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                <div class="form-group">
                    <label for="username">Username <span class="required">*</span></label>
                    <input type="text" id="username" name="username" class="form-control" value="{{ old('username', $user->username) }}" required>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" class="form-control" value="{{ old('email', $user->email) }}">
                </div>
            </div>

            <div style="margin: 25px 0 15px 0; padding-top: 15px; border-top: 1px dashed var(--pks-border);">
                <h4 style="font-size: 14px; font-weight: 700; color: var(--pks-red); margin-bottom: 6px;">
                    <i class="fa-solid fa-key"></i> Ganti Password
                </h4>
                <p style="font-size: 12px; color: var(--pks-gray); margin-bottom: 15px;">
                    Kosongkan bagian ini jika Anda tidak ingin mengganti password akun Anda saat ini.
                </p>
            </div>

            <div class="form-group">
                <label for="current_password">Password Saat Ini</label>
                <input type="password" id="current_password" name="current_password" class="form-control" placeholder="Masukkan password saat ini jika ingin ganti password">
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px;">
                <div class="form-group">
                    <label for="new_password">Password Baru</label>
                    <input type="password" id="new_password" name="new_password" class="form-control" placeholder="Minimal 6 karakter">
                </div>

                <div class="form-group">
                    <label for="new_password_confirmation">Konfirmasi Password Baru</label>
                    <input type="password" id="new_password_confirmation" name="new_password_confirmation" class="form-control" placeholder="Ketik ulang password baru">
                </div>
            </div>

            <div style="text-align: right; margin-top: 25px;">
                <button type="submit" class="btn-submit">
                    <i class="fa-solid fa-floppy-disk"></i> Simpan Perubahan Akun
                </button>
            </div>
        </form>
    </div>
</div>

@endsection
