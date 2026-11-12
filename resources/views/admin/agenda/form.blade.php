@extends('layouts.admin')

@section('title', $item->exists ? 'Edit Agenda' : 'Tambah Agenda')
@section('subtitle', 'Jadwal kegiatan Ekstrakurikuler PKS')

@section('content')

    <div class="page-head">
        <div>
            <h1>{{ $item->exists ? 'Edit Agenda' : 'Tambah Agenda' }}</h1>
            <p>Agenda dengan tanggal mendatang tampil di beranda dan halaman Agenda.</p>
        </div>

        <a href="{{ route('admin.agenda.index') }}" class="btn btn--light">← Kembali</a>
    </div>

    <form method="POST"
          action="{{ $item->exists ? route('admin.agenda.update', $item) : route('admin.agenda.store') }}">
        @csrf
        @if($item->exists)
            @method('PUT')
        @endif

        <div class="panel">
            <div class="panel__body">
                <div class="form-grid">

                    <div class="field field--full @error('judul') has-error @enderror">
                        <label for="judul">Nama Kegiatan <span class="req">*</span></label>
                        <input type="text" id="judul" name="judul" value="{{ old('judul', $item->judul) }}" required>
                        @error('judul')<span class="error">{{ $message }}</span>@enderror
                    </div>

                    <div class="field @error('tanggal') has-error @enderror">
                        <label for="tanggal">Tanggal <span class="req">*</span></label>
                        <input type="date" id="tanggal" name="tanggal"
                               value="{{ old('tanggal', optional($item->tanggal)->format('Y-m-d')) }}" required>
                        @error('tanggal')<span class="error">{{ $message }}</span>@enderror
                    </div>

                    <div class="field @error('waktu') has-error @enderror">
                        <label for="waktu">Waktu</label>
                        <input type="time" id="waktu" name="waktu"
                               value="{{ old('waktu', $item->waktu ? \Illuminate\Support\Carbon::parse($item->waktu)->format('H:i') : '') }}">
                        @error('waktu')<span class="error">{{ $message }}</span>@enderror
                    </div>

                    <div class="field field--full">
                        <label for="lokasi">Lokasi</label>
                        <input type="text" id="lokasi" name="lokasi" value="{{ old('lokasi', $item->lokasi) }}"
                               placeholder="Lapangan Upacara SMKN 2 Purwakarta">
                    </div>

                    <div class="field field--full @error('deskripsi') has-error @enderror">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea id="deskripsi" name="deskripsi" rows="4">{{ old('deskripsi', $item->deskripsi) }}</textarea>
                        @error('deskripsi')<span class="error">{{ $message }}</span>@enderror
                    </div>

                </div>

                <div class="form-actions">
                    <a href="{{ route('admin.agenda.index') }}" class="btn btn--light">Batal</a>
                    <button type="submit" class="btn btn--primary">
                        {{ $item->exists ? 'Simpan Perubahan' : 'Simpan Agenda' }}
                    </button>
                </div>
            </div>
        </div>

    </form>

@endsection
