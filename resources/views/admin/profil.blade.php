@extends('layouts.admin')

@section('title', 'Profil Ekskul')
@section('subtitle', 'Data ini tampil di halaman Profil, footer, dan header website')

@section('content')

    <div class="page-head">
        <div>
            <h1>Profil Ekstrakurikuler</h1>
            <p>Ubah identitas, visi, misi, serta kontak yang ditampilkan di website.</p>
        </div>

        <a href="{{ route('profil') }}" target="_blank" class="btn btn--light">Lihat Halaman ↗</a>
    </div>

    <form method="POST" action="{{ route('admin.profil.update') }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="panel" style="margin-bottom:1.2rem;">
            <div class="panel__head"><h3>Identitas</h3></div>
            <div class="panel__body">
                <div class="form-grid">

                    <div class="field @error('nama_ekskul') has-error @enderror">
                        <label for="nama_ekskul">Nama Ekstrakurikuler <span class="req">*</span></label>
                        <input type="text" id="nama_ekskul" name="nama_ekskul" value="{{ old('nama_ekskul', $detail->nama_ekskul) }}" required>
                        @error('nama_ekskul')<span class="error">{{ $message }}</span>@enderror
                    </div>

                    <div class="field @error('nama_sekolah') has-error @enderror">
                        <label for="nama_sekolah">Nama Sekolah <span class="req">*</span></label>
                        <input type="text" id="nama_sekolah" name="nama_sekolah" value="{{ old('nama_sekolah', $detail->nama_sekolah) }}" required>
                        @error('nama_sekolah')<span class="error">{{ $message }}</span>@enderror
                    </div>

                    <div class="field field--full">
                        <label for="deskripsi_singkat">Deskripsi Singkat</label>
                        <textarea id="deskripsi_singkat" name="deskripsi_singkat" rows="3">{{ old('deskripsi_singkat', $detail->deskripsi_singkat) }}</textarea>
                        <span class="hint">Tampil di bawah judul halaman Profil dan di footer.</span>
                    </div>

                </div>
            </div>
        </div>

        <div class="panel" style="margin-bottom:1.2rem;">
            <div class="panel__head"><h3>Sejarah, Visi &amp; Misi</h3></div>
            <div class="panel__body">
                <div class="form-grid">

                    <div class="field field--full">
                        <label for="sejarah">Sejarah / Tentang Kami</label>
                        <textarea id="sejarah" name="sejarah" rows="6">{{ old('sejarah', $detail->sejarah) }}</textarea>
                        <span class="hint">Pisahkan tiap paragraf dengan baris baru.</span>
                    </div>

                    <div class="field field--full">
                        <label for="visi">Visi</label>
                        <textarea id="visi" name="visi" rows="3">{{ old('visi', $detail->visi) }}</textarea>
                    </div>

                    <div class="field field--full">
                        <label for="misi">Misi</label>
                        <textarea id="misi" name="misi" rows="6">{{ old('misi', $detail->misi) }}</textarea>
                        <span class="hint">Tulis satu poin misi per baris.</span>
                    </div>

                </div>
            </div>
        </div>

        <div class="panel" style="margin-bottom:1.2rem;">
            <div class="panel__head"><h3>Kontak</h3></div>
            <div class="panel__body">
                <div class="form-grid">

                    <div class="field field--full">
                        <label for="alamat">Alamat</label>
                        <input type="text" id="alamat" name="alamat" value="{{ old('alamat', $detail->alamat) }}">
                    </div>

                    <div class="field @error('email') has-error @enderror">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email', $detail->email) }}">
                        @error('email')<span class="error">{{ $message }}</span>@enderror
                    </div>

                    <div class="field">
                        <label for="telepon">Telepon</label>
                        <input type="text" id="telepon" name="telepon" value="{{ old('telepon', $detail->telepon) }}">
                    </div>

                    <div class="field">
                        <label for="instagram">Instagram</label>
                        <input type="text" id="instagram" name="instagram" value="{{ old('instagram', $detail->instagram) }}" placeholder="@pks.smkn2purwakarta">
                    </div>

                </div>
            </div>
        </div>

        <div class="panel">
            <div class="panel__head"><h3>Gambar</h3></div>
            <div class="panel__body">
                <div class="form-grid">

                    <div class="field @error('logo') has-error @enderror">
                        <label for="logo">Logo</label>
                        <input type="file" id="logo" name="logo" accept="image/*" data-preview="#previewLogo">
                        <span class="hint">Format JPG/PNG/WEBP, maksimal 2 MB. Kosongkan bila tidak ingin mengganti.</span>
                        <div class="preview">
                            <img id="previewLogo" src="{{ asset($detail->logo ?: 'img/logo pks.jpeg') }}" alt="">
                        </div>
                        @error('logo')<span class="error">{{ $message }}</span>@enderror
                    </div>

                    <div class="field @error('foto_header') has-error @enderror">
                        <label for="foto_header">Foto Header</label>
                        <input type="file" id="foto_header" name="foto_header" accept="image/*" data-preview="#previewHeader">
                        <span class="hint">Gambar latar untuk hero beranda dan header halaman. Maksimal 4 MB.</span>
                        <div class="preview">
                            <img id="previewHeader" src="{{ asset($detail->foto_header ?: 'img/POTO PKS3.jpeg') }}" alt="">
                        </div>
                        @error('foto_header')<span class="error">{{ $message }}</span>@enderror
                    </div>

                </div>

                <div class="form-actions">
                    <a href="{{ route('admin.dashboard') }}" class="btn btn--light">Batal</a>
                    <button type="submit" class="btn btn--primary">Simpan Perubahan</button>
                </div>
            </div>
        </div>

    </form>

@endsection
