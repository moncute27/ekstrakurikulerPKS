@extends('layouts.admin')

@section('title', $pengurus->exists ? 'Edit Pengurus' : 'Tambah Pengurus')
@section('subtitle', 'Struktur organisasi Ekstrakurikuler PKS')

@section('content')

    <div class="page-head">
        <div>
            <h1>{{ $pengurus->exists ? 'Edit Pengurus' : 'Tambah Pengurus' }}</h1>
            <p>Isi data pengurus yang akan ditampilkan pada halaman Struktur Organisasi.</p>
        </div>

        <a href="{{ route('admin.pengurus.index') }}" class="btn btn--light">← Kembali</a>
    </div>

    <form method="POST"
          action="{{ $pengurus->exists ? route('admin.pengurus.update', $pengurus) : route('admin.pengurus.store') }}"
          enctype="multipart/form-data">
        @csrf
        @if($pengurus->exists)
            @method('PUT')
        @endif

        <div class="panel">
            <div class="panel__body">
                <div class="form-grid">

                    <div class="field @error('nama') has-error @enderror">
                        <label for="nama">Nama Lengkap <span class="req">*</span></label>
                        <input type="text" id="nama" name="nama" value="{{ old('nama', $pengurus->nama) }}" required>
                        @error('nama')<span class="error">{{ $message }}</span>@enderror
                    </div>

                    <div class="field @error('jabatan') has-error @enderror">
                        <label for="jabatan">Jabatan <span class="req">*</span></label>
                        <input type="text" id="jabatan" name="jabatan" list="daftarJabatan"
                               value="{{ old('jabatan', $pengurus->jabatan) }}" required>
                        <datalist id="daftarJabatan">
                            <option value="Pembina"></option>
                            <option value="Pelatih"></option>
                            <option value="Ketua"></option>
                            <option value="Wakil Ketua"></option>
                            <option value="Sekretaris"></option>
                            <option value="Bendahara"></option>
                            <option value="Humas"></option>
                        </datalist>
                        @error('jabatan')<span class="error">{{ $message }}</span>@enderror
                    </div>

                    <div class="field">
                        <label for="periode">Periode</label>
                        <input type="text" id="periode" name="periode" value="{{ old('periode', $pengurus->periode) }}" placeholder="2025/2026">
                    </div>

                    <div class="field @error('urutan') has-error @enderror">
                        <label for="urutan">Urutan Tampil</label>
                        <input type="number" id="urutan" name="urutan" min="0" max="999"
                               value="{{ old('urutan', $pengurus->urutan ?? 0) }}">
                        <span class="hint">Angka lebih kecil tampil lebih dulu.</span>
                        @error('urutan')<span class="error">{{ $message }}</span>@enderror
                    </div>

                    <div class="field field--full @error('foto') has-error @enderror">
                        <label for="foto">Foto</label>
                        <input type="file" id="foto" name="foto" accept="image/*" data-preview="#previewFoto">
                        <span class="hint">Opsional. JPG/PNG/WEBP maksimal 2 MB.</span>
                        <div class="preview">
                            <img id="previewFoto" src="{{ $pengurus->foto ? asset($pengurus->foto) : '' }}"
                                 alt="" style="{{ $pengurus->foto ? '' : 'display:none;' }}">
                        </div>
                        @error('foto')<span class="error">{{ $message }}</span>@enderror
                    </div>

                </div>

                <div class="form-actions">
                    <a href="{{ route('admin.pengurus.index') }}" class="btn btn--light">Batal</a>
                    <button type="submit" class="btn btn--primary">
                        {{ $pengurus->exists ? 'Simpan Perubahan' : 'Simpan Pengurus' }}
                    </button>
                </div>
            </div>
        </div>

    </form>

@endsection
