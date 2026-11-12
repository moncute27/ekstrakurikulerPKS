@extends('layouts.admin')

@section('title', 'Kelola Galeri')
@section('subtitle', 'Dokumentasi foto kegiatan PKS')

@section('content')

    <div class="page-head">
        <div>
            <h1>Kelola Galeri</h1>
            <p>Total {{ $galeri->total() }} foto tersimpan.</p>
        </div>

        <a href="{{ route('admin.galeri.create') }}" class="btn btn--gold">+ Tambah Foto</a>
    </div>

    <div class="toolbar">
        <form method="GET" action="{{ route('admin.galeri.index') }}">
            <input type="search" name="cari" value="{{ $cari }}" placeholder="Cari judul foto...">
            <button type="submit" class="btn btn--primary">Cari</button>
            @if($cari)
                <a href="{{ route('admin.galeri.index') }}" class="btn btn--light">Reset</a>
            @endif
        </form>
    </div>

    <div class="panel">
        <div class="panel__body">
            @if($galeri->isEmpty())
                <div class="empty">
                    <div class="empty__icon">🖼️</div>
                    <p>Belum ada foto di galeri.</p>
                </div>
            @else
                <div class="media-grid">
                    @foreach($galeri as $item)
                        <div class="media-card">
                            <img src="{{ asset($item->gambar) }}" alt="{{ $item->judul }}" loading="lazy">

                            <div class="media-card__body">
                                <strong>{{ \Illuminate\Support\Str::limit($item->judul, 34) }}</strong>
                                <small>{{ $item->tanggal?->translatedFormat('d M Y') ?: 'Tanpa tanggal' }}</small>

                                <div class="media-card__actions">
                                    <a href="{{ route('admin.galeri.edit', $item) }}" class="btn btn--light btn--sm">Edit</a>
                                    <form method="POST" action="{{ route('admin.galeri.destroy', $item) }}"
                                          data-confirm="Hapus foto &quot;{{ $item->judul }}&quot;?">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn--danger btn--sm">Hapus</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        @if($galeri->hasPages())
            <div class="pagination-wrap">{{ $galeri->links() }}</div>
        @endif
    </div>

@endsection
