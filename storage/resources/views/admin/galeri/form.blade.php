@extends('layouts.admin')

@section('title', $item->exists ? 'Edit Foto Galeri' : 'Tambah Foto Galeri')
@section('subtitle', 'Dokumentasi kegiatan PKS')

@section('content')

    <div class="page-head">
        <div>
            <h1>{{ $item->exists ? 'Edit Foto' : 'Tambah Foto' }}</h1>
            <p>Foto akan tampil di halaman Galeri dan sorotan beranda.</p>
        </div>

        <a href="{{ route('admin.galeri.index') }}" class="btn btn--light">← Kembali</a>
    </div>

    <form method="POST"
          action="{{ $item->exists ? route('admin.galeri.update', $item) : route('admin.galeri.store') }}"
          enctype="multipart/form-data">
        @csrf
        @if($item->exists)
            @method('PUT')
        @endif

        <div class="panel">
            <div class="panel__body">
                <div class="form-grid">

                    <div class="field @error('judul') has-error @enderror">
                        <label for="judul">Judul Foto <span class="req">*</span></label>
                        <input type="text" id="judul" name="judul" value="{{ old('judul', $item->judul) }}" required>
                        @error('judul')<span class="error">{{ $message }}</span>@enderror
                    </div>

                    <div class="field @error('tanggal') has-error @enderror">
                        <label for="tanggal">Tanggal Kegiatan</label>
                        <input type="date" id="tanggal" name="tanggal"
                               value="{{ old('tanggal', optional($item->tanggal)->format('Y-m-d')) }}">
                        @error('tanggal')<span class="error">{{ $message }}</span>@enderror
                    </div>

                    <div class="field field--full @error('keterangan') has-error @enderror">
                        <label for="keterangan">Keterangan</label>
                        <textarea id="keterangan" name="keterangan" rows="3" maxlength="500">{{ old('keterangan', $item->keterangan) }}</textarea>
                        @error('keterangan')<span class="error">{{ $message }}</span>@enderror
                    </div>

                    <div class="field field--full @error('gambar') has-error @enderror">
                        <label for="gambar">Gambar @if(! $item->exists)<span class="req">*</span>@endif</label>
                        <input type="file" id="gambar" name="gambar" accept="image/*"
                               data-preview="#previewGambar" @if(! $item->exists) required @endif>
                        <span class="hint">JPG/PNG/WEBP maksimal 4 MB.</span>
                        <div class="preview">
                            <img id="previewGambar" src="{{ $item->gambar ? asset($item->gambar) : '' }}"
                                 alt="" style="{{ $item->gambar ? '' : 'display:none;' }}">
                        </div>
                        @error('gambar')<span class="error">{{ $message }}</span>@enderror
                    </div>

                </div>

                <div class="form-actions">
                    <a href="{{ route('admin.galeri.index') }}" class="btn btn--light">Batal</a>
                    <button type="submit" class="btn btn--primary">
                        {{ $item->exists ? 'Simpan Perubahan' : 'Unggah Foto' }}
                    </button>
                </div>
            </div>
        </div>

    </form>

@endsection
