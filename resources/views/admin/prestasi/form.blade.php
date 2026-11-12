@extends('layouts.admin')

@section('title', $item->exists ? 'Edit Prestasi' : 'Tambah Prestasi')
@section('subtitle', 'Pencapaian Ekstrakurikuler PKS')

@section('content')

    <div class="page-head">
        <div>
            <h1>{{ $item->exists ? 'Edit Prestasi' : 'Tambah Prestasi' }}</h1>
            <p>Data ini tampil pada halaman Prestasi dan statistik beranda.</p>
        </div>

        <a href="{{ route('admin.prestasi.index') }}" class="btn btn--light">← Kembali</a>
    </div>

    <form method="POST"
          action="{{ $item->exists ? route('admin.prestasi.update', $item) : route('admin.prestasi.store') }}"
          enctype="multipart/form-data">
        @csrf
        @if($item->exists)
            @method('PUT')
        @endif

        <div class="panel">
            <div class="panel__body">
                <div class="form-grid">

                    <div class="field field--full @error('judul') has-error @enderror">
                        <label for="judul">Nama Prestasi <span class="req">*</span></label>
                        <input type="text" id="judul" name="judul" value="{{ old('judul', $item->judul) }}"
                               placeholder="Juara 1 PBB Terbaik" required>
                        @error('judul')<span class="error">{{ $message }}</span>@enderror
                    </div>

                    <div class="field @error('tingkat') has-error @enderror">
                        <label for="tingkat">Tingkat <span class="req">*</span></label>
                        <select id="tingkat" name="tingkat" required>
                            @foreach(\App\Models\Prestasi::TINGKAT as $tingkat)
                                <option value="{{ $tingkat }}" @selected(old('tingkat', $item->tingkat) === $tingkat)>
                                    {{ $tingkat }}
                                </option>
                            @endforeach
                        </select>
                        @error('tingkat')<span class="error">{{ $message }}</span>@enderror
                    </div>

                    <div class="field @error('tahun') has-error @enderror">
                        <label for="tahun">Tahun</label>
                        <input type="number" id="tahun" name="tahun" min="1990" max="2100"
                               value="{{ old('tahun', $item->tahun) }}">
                        @error('tahun')<span class="error">{{ $message }}</span>@enderror
                    </div>

                    <div class="field field--full">
                        <label for="penyelenggara">Penyelenggara</label>
                        <input type="text" id="penyelenggara" name="penyelenggara"
                               value="{{ old('penyelenggara', $item->penyelenggara) }}" placeholder="Kabupaten Purwakarta">
                    </div>

                    <div class="field field--full @error('keterangan') has-error @enderror">
                        <label for="keterangan">Keterangan</label>
                        <textarea id="keterangan" name="keterangan" rows="4">{{ old('keterangan', $item->keterangan) }}</textarea>
                        @error('keterangan')<span class="error">{{ $message }}</span>@enderror
                    </div>

                    <div class="field field--full @error('foto') has-error @enderror">
                        <label for="foto">Foto Dokumentasi</label>
                        <input type="file" id="foto" name="foto" accept="image/*" data-preview="#previewFoto">
                        <span class="hint">Opsional. JPG/PNG/WEBP maksimal 4 MB.</span>
                        <div class="preview">
                            <img id="previewFoto" src="{{ $item->foto ? asset($item->foto) : '' }}"
                                 alt="" style="{{ $item->foto ? '' : 'display:none;' }}">
                        </div>
                        @error('foto')<span class="error">{{ $message }}</span>@enderror
                    </div>

                </div>

                <div class="form-actions">
                    <a href="{{ route('admin.prestasi.index') }}" class="btn btn--light">Batal</a>
                    <button type="submit" class="btn btn--primary">
                        {{ $item->exists ? 'Simpan Perubahan' : 'Simpan Prestasi' }}
                    </button>
                </div>
            </div>
        </div>

    </form>

@endsection
