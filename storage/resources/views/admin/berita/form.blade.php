@extends('layouts.admin')

@section('title', $berita->exists ? 'Edit Berita' : 'Tambah Berita')
@section('subtitle', 'Berita dan informasi kegiatan PKS')

@section('content')

    <div class="page-head">
        <div>
            <h1>{{ $berita->exists ? 'Edit Berita' : 'Tambah Berita' }}</h1>
            <p>Berita yang berstatus "Terbit" akan langsung tampil di halaman publik.</p>
        </div>

        <a href="{{ route('admin.berita.index') }}" class="btn btn--light">← Kembali</a>
    </div>

    <form method="POST"
          action="{{ $berita->exists ? route('admin.berita.update', $berita) : route('admin.berita.store') }}"
          enctype="multipart/form-data">
        @csrf
        @if($berita->exists)
            @method('PUT')
        @endif

        <div class="panel">
            <div class="panel__body">
                <div class="form-grid">

                    <div class="field field--full @error('judul') has-error @enderror">
                        <label for="judul">Judul Berita <span class="req">*</span></label>
                        <input type="text" id="judul" name="judul" value="{{ old('judul', $berita->judul) }}" required>
                        @error('judul')<span class="error">{{ $message }}</span>@enderror
                    </div>

                    <div class="field @error('kategori') has-error @enderror">
                        <label for="kategori">Kategori <span class="req">*</span></label>
                        <select id="kategori" name="kategori" required>
                            @foreach(\App\Models\Berita::KATEGORI as $kategori)
                                <option value="{{ $kategori }}" @selected(old('kategori', $berita->kategori) === $kategori)>
                                    {{ $kategori }}
                                </option>
                            @endforeach
                        </select>
                        @error('kategori')<span class="error">{{ $message }}</span>@enderror
                    </div>

                    <div class="field @error('tanggal') has-error @enderror">
                        <label for="tanggal">Tanggal <span class="req">*</span></label>
                        <input type="date" id="tanggal" name="tanggal"
                               value="{{ old('tanggal', optional($berita->tanggal)->format('Y-m-d')) }}" required>
                        @error('tanggal')<span class="error">{{ $message }}</span>@enderror
                    </div>

                    <div class="field @error('penulis') has-error @enderror">
                        <label for="penulis">Penulis <span class="req">*</span></label>
                        <input type="text" id="penulis" name="penulis" value="{{ old('penulis', $berita->penulis) }}" required>
                        @error('penulis')<span class="error">{{ $message }}</span>@enderror
                    </div>

                    <div class="field">
                        <label>Status Publikasi</label>
                        <label class="switch" style="padding-top:.5rem;">
                            <input type="checkbox" name="is_published" value="1"
                                   @checked(old('is_published', $berita->is_published ?? true))>
                            <span>Tampilkan di halaman publik</span>
                        </label>
                    </div>

                    <div class="field field--full @error('ringkasan') has-error @enderror">
                        <label for="ringkasan">Ringkasan</label>
                        <textarea id="ringkasan" name="ringkasan" rows="2" maxlength="500">{{ old('ringkasan', $berita->ringkasan) }}</textarea>
                        <span class="hint">Opsional — akan dibuat otomatis dari isi berita bila dikosongkan.</span>
                        @error('ringkasan')<span class="error">{{ $message }}</span>@enderror
                    </div>

                    <div class="field field--full @error('isi') has-error @enderror">
                        <label for="isi">Isi Berita <span class="req">*</span></label>
                        <textarea id="isi" name="isi" rows="10" required>{{ old('isi', $berita->isi) }}</textarea>
                        <span class="hint">Pisahkan tiap paragraf dengan baris baru.</span>
                        @error('isi')<span class="error">{{ $message }}</span>@enderror
                    </div>

                    <div class="field field--full @error('gambar') has-error @enderror">
                        <label for="gambar">Gambar Utama</label>
                        <input type="file" id="gambar" name="gambar" accept="image/*" data-preview="#previewGambar">
                        <span class="hint">JPG/PNG/WEBP maksimal 4 MB. Kosongkan bila tidak ingin mengganti.</span>
                        <div class="preview">
                            <img id="previewGambar" src="{{ $berita->gambar ? asset($berita->gambar) : '' }}"
                                 alt="" style="{{ $berita->gambar ? '' : 'display:none;' }}">
                        </div>
                        @error('gambar')<span class="error">{{ $message }}</span>@enderror
                    </div>

                </div>

                <div class="form-actions">
                    <a href="{{ route('admin.berita.index') }}" class="btn btn--light">Batal</a>
                    <button type="submit" class="btn btn--primary">
                        {{ $berita->exists ? 'Simpan Perubahan' : 'Terbitkan Berita' }}
                    </button>
                </div>
            </div>
        </div>

    </form>

@endsection
