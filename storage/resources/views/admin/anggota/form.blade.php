@extends('layouts.admin')

@section('title', $item->exists ? 'Edit Anggota' : 'Tambah Anggota')
@section('subtitle', 'Data anggota Ekstrakurikuler PKS')

@section('content')

    <div class="page-head">
        <div>
            <h1>{{ $item->exists ? 'Edit Anggota' : 'Tambah Anggota' }}</h1>
            <p>Anggota berstatus "Aktif" akan dihitung pada statistik beranda.</p>
        </div>

        <a href="{{ route('admin.anggota.index') }}" class="btn btn--light">← Kembali</a>
    </div>

    <form method="POST"
          action="{{ $item->exists ? route('admin.anggota.update', $item) : route('admin.anggota.store') }}"
          enctype="multipart/form-data">
        @csrf
        @if($item->exists)
            @method('PUT')
        @endif

        <div class="panel">
            <div class="panel__body">
                <div class="form-grid">

                    <div class="field @error('nama') has-error @enderror">
                        <label for="nama">Nama Lengkap <span class="req">*</span></label>
                        <input type="text" id="nama" name="nama" value="{{ old('nama', $item->nama) }}" required>
                        @error('nama')<span class="error">{{ $message }}</span>@enderror
                    </div>

                    <div class="field @error('nis') has-error @enderror">
                        <label for="nis">NIS</label>
                        <input type="text" id="nis" name="nis" value="{{ old('nis', $item->nis) }}">
                        @error('nis')<span class="error">{{ $message }}</span>@enderror
                    </div>

                    <div class="field @error('kelas') has-error @enderror">
                        <label for="kelas">Kelas <span class="req">*</span></label>
                        <input type="text" id="kelas" name="kelas" value="{{ old('kelas', $item->kelas) }}"
                               placeholder="XI BD 1" required>
                        @error('kelas')<span class="error">{{ $message }}</span>@enderror
                    </div>

                    <div class="field @error('angkatan') has-error @enderror">
                        <label for="angkatan">Angkatan <span class="req">*</span></label>
                        <input type="text" id="angkatan" name="angkatan" value="{{ old('angkatan', $item->angkatan) }}"
                               placeholder="2025" required>
                        @error('angkatan')<span class="error">{{ $message }}</span>@enderror
                    </div>

                    <div class="field">
                        <label for="jabatan">Jabatan</label>
                        <input type="text" id="jabatan" name="jabatan"
                               value="{{ old('jabatan', $item->jabatan ?: 'Anggota') }}">
                    </div>

                    <div class="field @error('status') has-error @enderror">
                        <label for="status">Status <span class="req">*</span></label>
                        <select id="status" name="status" required>
                            @foreach(\App\Models\Anggota::STATUS as $opsi)
                                <option value="{{ $opsi }}" @selected(old('status', $item->status) === $opsi)>{{ $opsi }}</option>
                            @endforeach
                        </select>
                        @error('status')<span class="error">{{ $message }}</span>@enderror
                    </div>

                    <div class="field field--full @error('foto') has-error @enderror">
                        <label for="foto">Foto</label>
                        <input type="file" id="foto" name="foto" accept="image/*" data-preview="#previewFoto">
                        <span class="hint">Opsional. JPG/PNG/WEBP maksimal 2 MB.</span>
                        <div class="preview">
                            <img id="previewFoto" src="{{ $item->foto ? asset($item->foto) : '' }}"
                                 alt="" style="{{ $item->foto ? '' : 'display:none;' }}">
                        </div>
                        @error('foto')<span class="error">{{ $message }}</span>@enderror
                    </div>

                </div>

                <div class="form-actions">
                    <a href="{{ route('admin.anggota.index') }}" class="btn btn--light">Batal</a>
                    <button type="submit" class="btn btn--primary">
                        {{ $item->exists ? 'Simpan Perubahan' : 'Simpan Anggota' }}
                    </button>
                </div>
            </div>
        </div>

    </form>

@endsection
