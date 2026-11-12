@extends('layouts.admin')

@section('title', 'Kelola Berita')
@section('subtitle', 'Semua berita dan informasi kegiatan PKS')

@section('content')

    <div class="page-head">
        <div>
            <h1>Kelola Berita</h1>
            <p>Total {{ $berita->total() }} berita tersimpan di database.</p>
        </div>

        <a href="{{ route('admin.berita.create') }}" class="btn btn--gold">+ Tambah Berita</a>
    </div>

    <div class="toolbar">
        <form method="GET" action="{{ route('admin.berita.index') }}">
            <input type="search" name="cari" value="{{ $cari }}" placeholder="Cari judul atau penulis...">
            <button type="submit" class="btn btn--primary">Cari</button>
            @if($cari)
                <a href="{{ route('admin.berita.index') }}" class="btn btn--light">Reset</a>
            @endif
        </form>
    </div>

    <div class="panel">
        @if($berita->isEmpty())
            <div class="empty">
                <div class="empty__icon">📰</div>
                <p>Belum ada berita. Klik "Tambah Berita" untuk membuat yang pertama.</p>
            </div>
        @else
            <div class="table-scroll">
                <table class="data">
                    <thead>
                        <tr>
                            <th style="width:80px;">Foto</th>
                            <th>Judul</th>
                            <th>Kategori</th>
                            <th>Tanggal</th>
                            <th>Penulis</th>
                            <th>Status</th>
                            <th style="text-align:right;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($berita as $item)
                            <tr>
                                <td>
                                    @if($item->gambar)
                                        <img src="{{ asset($item->gambar) }}" alt="" class="thumb">
                                    @else
                                        <span class="thumb-empty">📰</span>
                                    @endif
                                </td>
                                <td class="cell-title" style="max-width:320px;">
                                    <strong>{{ $item->judul }}</strong>
                                    <small>{{ \Illuminate\Support\Str::limit($item->ringkasan, 70) }}</small>
                                </td>
                                <td><span class="badge badge--navy">{{ $item->kategori }}</span></td>
                                <td>{{ $item->tanggal?->translatedFormat('d M Y') }}</td>
                                <td>{{ $item->penulis }}</td>
                                <td>
                                    <span class="badge {{ $item->is_published ? 'badge--green' : 'badge--grey' }}">
                                        {{ $item->is_published ? 'Terbit' : 'Draf' }}
                                    </span>
                                </td>
                                <td>
                                    <div class="td-actions">
                                        @if($item->is_published)
                                            <a href="{{ route('berita.show', $item) }}" target="_blank" class="btn btn--light btn-icon" title="Lihat">👁</a>
                                        @endif
                                        <a href="{{ route('admin.berita.edit', $item) }}" class="btn btn--light btn-icon" title="Edit">✎</a>
                                        <form method="POST" action="{{ route('admin.berita.destroy', $item) }}"
                                              data-confirm="Hapus berita &quot;{{ $item->judul }}&quot;?">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn--danger btn-icon" title="Hapus">🗑</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="pagination-wrap">{{ $berita->links() }}</div>
        @endif
    </div>

@endsection
