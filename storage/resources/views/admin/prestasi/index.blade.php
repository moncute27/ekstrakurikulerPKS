@extends('layouts.admin')

@section('title', 'Kelola Prestasi')
@section('subtitle', 'Pencapaian Ekstrakurikuler PKS')

@section('content')

    <div class="page-head">
        <div>
            <h1>Kelola Prestasi</h1>
            <p>Total {{ $prestasi->total() }} prestasi tersimpan.</p>
        </div>

        <a href="{{ route('admin.prestasi.create') }}" class="btn btn--gold">+ Tambah Prestasi</a>
    </div>

    <div class="toolbar">
        <form method="GET" action="{{ route('admin.prestasi.index') }}">
            <input type="search" name="cari" value="{{ $cari }}" placeholder="Cari judul prestasi...">
            <button type="submit" class="btn btn--primary">Cari</button>
            @if($cari)
                <a href="{{ route('admin.prestasi.index') }}" class="btn btn--light">Reset</a>
            @endif
        </form>
    </div>

    <div class="panel">
        @if($prestasi->isEmpty())
            <div class="empty">
                <div class="empty__icon">🏆</div>
                <p>Belum ada data prestasi.</p>
            </div>
        @else
            <div class="table-scroll">
                <table class="data">
                    <thead>
                        <tr>
                            <th>Prestasi</th>
                            <th>Tingkat</th>
                            <th>Tahun</th>
                            <th>Penyelenggara</th>
                            <th style="text-align:right;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($prestasi as $item)
                            <tr>
                                <td class="cell-title" style="max-width:340px;">
                                    <strong>🏆 {{ $item->judul }}</strong>
                                    <small>{{ \Illuminate\Support\Str::limit($item->keterangan, 70) }}</small>
                                </td>
                                <td><span class="badge badge--gold">{{ $item->tingkat }}</span></td>
                                <td>{{ $item->tahun ?: '—' }}</td>
                                <td>{{ $item->penyelenggara ?: '—' }}</td>
                                <td>
                                    <div class="td-actions">
                                        <a href="{{ route('admin.prestasi.edit', $item) }}" class="btn btn--light btn-icon" title="Edit">✎</a>
                                        <form method="POST" action="{{ route('admin.prestasi.destroy', $item) }}"
                                              data-confirm="Hapus prestasi &quot;{{ $item->judul }}&quot;?">
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

            <div class="pagination-wrap">{{ $prestasi->links() }}</div>
        @endif
    </div>

@endsection
